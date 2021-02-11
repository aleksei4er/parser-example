<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Crawler;

use Symfony\Component\DomCrawler\Crawler;

abstract class SymfonyCrawlerProxy
{
    /**
     * 
     * @param Crawler $crawler 
     * @return void 
     */
    public function __construct(private Crawler $crawler) {}

    /**
     * Proxy all methods to the crawler
     *
     * @param string $name
     * @param array $args
     * @return mixed
     */
    public function __call(string $name, array $args): mixed
    {
        if (method_exists($this->crawler, $name)) {
            return $this->crawler->$name(...$args);
        }
    }
}
