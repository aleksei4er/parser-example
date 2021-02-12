<?php

namespace App\Parser\Item\Infrastructure\Strategy;

use Doctrine\Common\Collections\ArrayCollection;
use App\Parser\Item\Domain\Contracts\ItemParserInterface;
use App\Parser\Item\Domain\Contracts\SiteStrategyInterface;
use App\Shared\Infrastructure\HttpClient\ClientServiceInterface;

class RbcStrategy implements SiteStrategyInterface
{
    /**
     * 
     * @param ClientServiceInterface $http 
     * @param ItemParserInterface $crawler 
     * @return void 
     */
    public function __construct(private ClientServiceInterface $http, private ItemParserInterface $crawler) {}

    /**
     * Load the list of article urls
     *
     * @return ArrayCollection
     */
    public function loadUrls(): ArrayCollection
    {
        $response = $this->http->request('GET', 'https://www.rbc.ru/');

        $this->crawler->add($response->getContent());
        
        $blocks = $this->crawler
            ->filterXPath('//div[@class="js-news-feed-list"]/a')
            ->extract(['href']);

        return new ArrayCollection($blocks);
    }

    /**
     * Load the full article data
     *
     * @param string $url
     * @return array
     */
    public function loadData(string $url): array
    {
        try {
            sleep(1);
            $response = $this->http->request('GET', $url);

            $this->crawler->clear();

            $this->crawler->add($response->getContent());
    
            $article = $this->crawler->filterXPath('//div[contains(@class, "article__content")]');
    
            $contents = $article->filterXPath('.//div[@itemprop="articleBody"]/p')
                ->each(fn($node) => $node->outerHtml());
            
            $image = $article->filterXPath('.//div[@class="article__main-image__wrap"]/img');

            return [
                'h1' => $article->filterXPath('.//h1')->text(),
                'content' => implode("\n", $contents),
                'image' => $image->count() ? $image->attr('src') : null,
            ];
        } catch (\Throwable $e) {
            return [];
        }
    }
}
