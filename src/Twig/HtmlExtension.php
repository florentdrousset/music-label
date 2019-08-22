<?php


namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class HtmlExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('figure', [$this, 'figureFilter']),
        ];
    }

    public function figureFilter($imgName, $caption = "ceci est une image") {
        $tagBeginning = '<figure> <img src="/img/';
        $tagMiddle = ' " style="width: 18rem;"><figcaption>';
        $tagEnd = '</figcaption> </figure>';

        $result = $tagBeginning . $imgName . $tagMiddle . $caption . $tagEnd;
        return $result;
    }
}