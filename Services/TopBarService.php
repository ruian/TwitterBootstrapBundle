<?php

namespace Ruian\TwitterBootstrapBundle\Services;

use Ruian\TwitterBootstrapBundle\Model\TopBar;
use Ruian\TwitterBootstrapBundle\Model\TopBarNav;
use Ruian\TwitterBootstrapBundle\Exceptions\TopBarException;

/**
* 
*/
class TopBarService
{
    /**
     * Array
     */
    protected $topbars;

    public function __construct($container)
    {
        $this->topbars = $container->getParameter('ruian.twitterbootstrap.topbars');
    }

    /**
     * Get topbar from config.yml
     * @param string $key
     * @return TopBar
     */
    public function getTopBar($key)
    {
        if (false === array_key_exists($key, $this->topbars)) {
            throw new TopBarException("This topbar is not configurate.");
        }

        $TopBar = $this->generateTopBar($this->topbars[$key]);

        return $TopBar;
    }

    /**
     * Convert an array topbar to a new TopBar instance
     * @param array $topbar_array
     * @return TopBar
     */
    static public function generateTopBar($topbar_array)
    {
        $TopBar = new TopBar();
        
        $TopBar->setTitle($topbar_array['title']);
        $TopBar->setRoute($topbar_array['title_route'], $topbar_array['title_route_parameters']);

        foreach ($topbar_array['nav'] as $nav) {
            $TopBarNav = new TopBarNav();
            $TopBarNav->setName($nav['name']);
            $TopBarNav->setRoute($nav['route'], $nav['route_parameters']);

            if (count($nav['children']) > 0) {
                foreach ($nav['children'] as $child) {
                    $TopBarNavChild = new TopBarNav();
                    $TopBarNavChild->setName($child['name']);
                    $TopBarNavChild->setRoute($child['route'], $child['route_parameters']);
                    $TopBarNavChild->setParent($TopBarNav);
                    $TopBarNav->addChild($TopBarNavChild);
                }
            }

            $TopBar->addNav($TopBarNav);
        }
        return $TopBar;
    }
}
