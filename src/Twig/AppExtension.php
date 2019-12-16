<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AppExtension extends AbstractExtension
{

    public function getFilters()
    {
        return [new TwigFilter('getUrlFilter', [$this, 'getUrlFilter'])];
    }

    public function getUrlFilter($url): string
    {
        if (!preg_match("/https?:\/\/~/", $url)) {
            $url = "/uploads/images/" . $url;
        }
        return $url;
    }

    public function getName()
    {
        return 'getUrlFilter';
    }
}
