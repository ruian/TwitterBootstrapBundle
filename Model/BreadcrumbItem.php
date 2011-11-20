<?php

namespace Ruian\TwitterBootstrapBundle\Model;

/**
* 
*/
class BreadcrumbItem
{
    /**
     * String
     */
    protected $route;

    /**
     * Array
     */
    protected $route_parameters = array();

    /**
     * String
     */
    protected $name;

    function __construct($name = null, $route = null, $parameters = array())
    {
        if (null !== $name && false === is_string($name)) {
            throw new StringException("\$name must be a string");
        } else if(null !== $name) {
            $this->name = $name;
        }

        if (null !== $route && false === is_string($route)) {
            throw new StringException("\$route must be a string");
        } else if(null !== $route) {
            $this->route = $route;
            $this->route_parameters = $parameters;
        }
    }

    /**
     * 
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * 
     */
    public function setRoute($route, $parameters = array())
    {
        $this->route = $route;
        $this->route_parameters = $parameters;
    }

    /**
     * 
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * 
     */
    public function getRouteParameters()
    {
        return $this->route_parameters;
    }
}