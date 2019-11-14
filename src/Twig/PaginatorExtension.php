<?php
/**
 * Created by PhpStorm.
 * User: pprusek
 * Date: 13.11.19
 * Time: 14:11
 */

namespace App\Twig;

use App\Paginator\Paginator;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use Twig\Environment;
use Twig\TwigFilter;

class PaginatorExtension extends AbstractExtension
{
    const NAME = 'paginator';

    /**
     * @return array
     */
    public function getFunctions()
    {

        return [
            new TwigFunction(
                $this->getName()."_render",
                [
                    $this,
                    "render",
                ],
                [
                    "is_safe" => ["html"],
                    "needs_environment" => true,
                ]
            )
        ];
    }



    public function render(Environment $env, Paginator $paginator, $template = 'extensions/paginator.html.twig')
    {
        return $env->render($template, $paginator->getPaginate());
    }

    /**
     * @return string
     */
    public function getName()
    {
        return self::NAME;
    }
}