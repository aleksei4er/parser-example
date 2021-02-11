<?php

namespace App\Parser\Item\Application\Query;

/**
 * Fetch data query.
 *
 * @property string $siteName
 */
final class FetchDataQuery
{
    /**
     * 
     * @param string $siteName 
     * @return void 
     */
    public function __construct(private string $siteName) {}

    /**
     * 
     * @return string 
     */
    public function getSiteName(): string
    {
        return $this->siteName;
    }
}