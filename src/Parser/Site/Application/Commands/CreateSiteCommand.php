<?php

namespace App\Parser\Site\Application\Command;

use Symfony\Component\Validator\Constraints;

/**
 * Create new site.
 *
 * @property string $name        Project name.
 * @property string $description Description.
 */
class CreateSiteCommand
{
    /**
     * @Constraints\NotBlank()
     * @Constraints\Length(max = "25")
     */
    public $name;

    /**
     * @Constraints\Length(max = "100")
     */
    public $url;
}