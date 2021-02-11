<?php

namespace App\Parser\Site\Domain\Entity;

use Doctrine\ORM\Mapping;
use Doctrine\ORM\Mapping\OneToMany;
use App\Shared\Domain\Aggregate\AggregateRoot;

/**
 * @Mapping\Table(name="parser_site")
 * @Mapping\Entity(repositoryClass="App\Parser\Site\Infrastructure\Doctrine\DoctrineSiteRepository")
 */
class Site extends AggregateRoot
{
    /**
     * @Mapping\Id
     * @Mapping\GeneratedValue(strategy="AUTO")
     * @Mapping\Column(name="id", type="bigint", unique=true)
     */
    private $id;

    /**
     * @OneToMany(targetEntity="App\Parser\Item\Domain\Entity\Item", mappedBy="item")
     */
    private $items;

    /**
     * @var string
     * 
     * @Mapping\Column(name="title", length=255, nullable=false)
     */
    private $title;

    /**
     * 
     * @param string $title 
     * @return Site 
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * 
     * @return string 
     */
    public function getTitle(): string
    {
        return $this->title;
    }
}
