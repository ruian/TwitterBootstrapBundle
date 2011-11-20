<?php

namespace Ruian\TwitterBootstrapBundle\Helper;

use Ruian\TwitterBootstrapBundle\Model\Breadcrumb;
use Ruian\TwitterBootstrapBundle\Model\Item;

use Symfony\Component\Templating\Helper\Helper;

/**
* 
*/
class BreadcrumbHelper extends Helper
{
    
    /**
     * Symfony\Bundle\FrameworkBundle\Templating\DelegatingEngine
     */
    protected $templating;

    /**
     * Template engine twig || php
     */
    protected $engine;

    /**
     * Symfony\Component\HttpFoundation\Request
     */
    protected $request;

    /**
     * 
     */
    public function __construct($templating, $engine, $request)
    {
        $this->templating = $templating;
        $this->engine = $engine;
        $this->request = $request;
    }

    /**
     * Render the partial with the html breadcrumb
     * @return $template
     */
    public function render($breadcrumb)
    {
        return $this->templating->render('RuianTwitterBootstrapBundle:default:_breadcrumb.html.' . $this->engine, array(
            'breadcrumb' => $breadcrumb,
        ));
    }

    /**
     * know if item is active and return 'active' or null
     * @param string $route
     * @return boolean
     */
    public function isActive($route)
    {
        if ($this->request->attributes->get('_route') == $route) {
            return true;
        } 

        return false;
    }

    /**
     * 
     */
    public function getName()
    {
        return 'ruian.helper.breadcrumb';
    }
}