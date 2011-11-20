<?php

namespace Ruian\TwitterBootstrapBundle\Model;

use Ruian\TwitterBootstrapBundle\Interfaces\NavigationInterface;
/**
* 
*/
class TopBarNav
{
    /**
     * Ruian\TwitterBootstrapBundle\Model\TopBarNav
     */
    protected $parent;

    /**
     * Array
     */
    protected $children = array();

    /**
     * String
     */
    protected $name;

    /**
     * String
     */
    protected $route;

    /**
     * array
     */
    protected $route_parameters = array();

    public function setParent(TopBarNav $parent)
    {
        $this->parent = $parent;
    }

    public function getParent()
    {
        return $this->parent;
    }

    public function hasChildren()
    {
        if (0 === count($this->children)) {
            return false;
        }

        return true;
    }

    public function addChild(TopBarNav $child)
    {
        $this->children[] = $child;
    }

    public function getChildren()
    {
        return $this->children;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setRoute($route, $parameters = array())
    {
        $this->route = $route;
        $this->route_parameters = $parameters;
    }

    public function getRoute()
    {
        return $this->route;
    }

    public function getRouteParameters()
    {
        return $this->route_parameters;
    }
}