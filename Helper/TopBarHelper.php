<?php

namespace Ruian\TwitterBootstrapBundle\Helper;

use Symfony\Component\Templating\Helper\Helper;
use Ruian\TwitterBootstrapBundle\Model\TopBar;
use Ruian\TwitterBootstrapBundle\Exceptions\TopBarException;

/**
* 
*/
class TopBarHelper extends Helper
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
     * Ruian\TwitterBootstrapBundle\Services\TopBarService
     */
    protected $topbarService;

    /**
     * Symfony\Component\HttpFoundation\Request
     */
    protected $request;

    function __construct($container)
    {
        $this->templating = $container->get('templating');
        $this->engine = $container->getParameter('ruian.twitterbootstrap.engine');
        $this->topbarService = $container->get('ruian.twitterbootstrap.topbar');
        $this->request = $container->get('request');
    }

    /**
     * Render the partial _top_bar
     * @return $template
     * @param mixed $topbar
     */
    public function render($topbar)
    {
        if (true === is_string($topbar)) {
            $topbar = $this->topbarService->getTopBar($topbar);
        }

        if (false === ($topbar instanceof TopBar)) {
            throw new TopBarException("\$topbar must be an instance of Ruian\TwitterBootstrapBundle\Modem\TopBar");
            
        }

        return $this->templating->render('RuianTwitterBootstrapBundle:default:_topbar.html.' . $this->engine, array(
            'topbar' => $topbar,
        ));
    }

    /**
     * know if item is active and return true or false
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

    public function getName()
    {
        return 'ruian.helper.topbar';
    }
}