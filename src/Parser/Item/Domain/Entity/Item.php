<?php

namespace App\Parser\Item\Domain\Entity;

use App\Parser\Site\Domain\Entity\Site;
use Doctrine\ORM\Mapping;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\JoinColumn;
use App\Shared\Domain\Aggregate\AggregateRoot;
use Symfony\Component\Validator\Constraints;

/**
 * @Mapping\Table(name="parser_item")
 * @Mapping\Entity(repositoryClass="App\Parser\Item\Infrastructure\Doctrine\DoctrineItemRepository")
 */
class Item extends AggregateRoot
{
    /**
     * @Mapping\Id
     * @Mapping\GeneratedValue(strategy="AUTO")
     * @Mapping\Column(name="id", type="bigint", unique=true)
     */
    private $id;

    /**
     * @JoinColumn(name="site_id", referencedColumnName="id")
     * @ManyToOne(targetEntity="App\Parser\Site\Domain\Entity\Site", inversedBy="items")
     * @var Site
     */
    private $site;

    /**
     * @var string
     * 
     * @Constraints\Unique
     * @Mapping\Column(name="href", length=500, nullable=false)
     */
    private $href;

    /**
     * @Mapping\Column(name="data", type="json", nullable=false)
     */
    private $data;

    /**
     * 
     * @param Site $site 
     * @return $this 
     */
    public function setSite(Site $site)
    {
        $this->site = $site;

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
     * @param string $data 
     * @return Item 
     */
    public function setData(string $data): self
    {
        $this->data = $data;

        return $this;
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
     * @return Item 
     */
    public function setHref(string $href): self
    {
        $this->href = $href;

        return $this;
    }

    /**
     * 
     * @return string 
     */
    public function getHref(): string
    {
        return $this->href;
    }
}
