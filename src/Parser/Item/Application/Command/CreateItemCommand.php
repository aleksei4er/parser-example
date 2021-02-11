<?php

namespace App\Parser\Item\Application\Command;

use App\Parser\Site\Domain\Entity\Site;
use App\Shared\Domain\CQRS\CommandInterface;
use Symfony\Component\Validator\Constraints;

final class CreateItemCommand implements CommandInterface
{
    public function __construct(Site $site, array $array) {
        $this
            ->setSite($site)
            ->setHref($array['href'])
            ->setData(json_encode($array))
            ->setH1($array['h1'] ?? null)
            ->setContent($array['content'] ?? null)
            ->setImage($array['image'] ?? null);

    }

    #[Constraints\NotBlank]
    private $h1;

    #[Constraints\NotBlank]
    private $content;

    //#[Constraints\Url]
    private $image;

    /**
     * 
     * @return string 
     */
    public function getHref(): string
    {
        return $this->href;
    }

    /**
     * 
     * @return string 
     */
    public function getData(): string
    {
        return $this->data;
    }

    /**
     * 
     * @param string $href 
     * @return CreateItemCommand 
     */
    public function setHref(string $href): self
    {
        $this->href = $href;

        return $this;
    }

    /**
     * 
     * @param string $data 
     * @return CreateItemCommand 
     */
    public function setData(string $data): self
    {
        $this->data = $data;

        return $this;
    }

    /**
     * 
     * @return Site 
     */
    public function getSite(): Site
    {
        return $this->site;
    }

    /**
     * 
     * @param Site $site 
     * @return CreateItemCommand 
     */
    public function setSite(Site $site): self
    {
        $this->site = $site;

        return $this;
    }

    /**
     * 
     * @param string|null $h1 
     * @return CreateItemCommand 
     */
    public function setH1(string | null $h1): self
    {
        $this->h1 = $h1;

        return $this;
    }

    /**
     * 
     * @param string|null $content 
     * @return CreateItemCommand 
     */
    public function setContent(string | null $content): self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * 
     * @param string|null $image 
     * @return CreateItemCommand 
     */
    public function setImage(string | null $image): self
    {
        $this->image = $image;

        return $this;
    }
}