<?php
namespace Ruian\TwitterBootstrapBundle\Model;

use Ruian\TwitterBootstrapBundle\Exceptions\StringException;
use Ruian\TwitterBootstrapBundle\Model\TopBarNav;

/**
* 
*/
class TopBar
{
    /**
     * String
     */
    protected $title;

    /**
     * String
     */
    protected $route;

    /**
     * Array
     */
    protected $route_parameters = array();

    /**
     * Ruian\TwitterBootstrapBundle\Model\TopBarNav
     */
    protected $nav;

    public function __construct()
    {
        $this->nav = new TopBarNav();
    }

    public function setTitle($title)
    {
        if (false === is_string($title)) {
            throw new StringException("Title must be a string.");
        }

        $this->title = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setRoute($route, $parameters = array())
    {
        $this->route= $route;
        $this->route_parameter = $parameters;
    }

    public function getRoute()
    {
        return $this->route;
    }

    public function getRouteParameters()
    {
        return $this->route_parameters;
    }

    public function addNav(TopBarNav $nav)
    {
        $this->nav->addChild($nav);
    }

    public function getNav()
    {
        return $this->nav;
    }
}