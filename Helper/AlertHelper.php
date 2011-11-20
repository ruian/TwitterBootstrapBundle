<?php

namespace Ruian\TwitterBootstrapBundle\Helper;

use Symfony\Component\Templating\Helper\Helper;
use Ruian\TwitterBoostrapBundle\Exceptions\AlertTypeException;

/**
* 
*/
class AlertHelper extends Helper
{
    /**
     * Template service
     */
    protected $templating;

    /**
     * Template engine twig || php
     */
    protected $engine;

    /**
     * 
     */
    public function __construct($container)
    {
        $this->templating = $container->get('templating');
        $this->engine = $container->getParameter('ruian.twitterbootstrap.engine');
    }

    /**
     * Render the partial _alert_block
     * @return $template
     * @param string $content 
     * @param string $type  warning || error || success || info
     * @param array $buttons  (button_1 => array('name' => 'foo', 'route' => 'bar', 'route_param' => array(), 'class' => ''))
     */
    public function renderBlock($content, $type = 'warning', $buttons = array())
    {
        $this->testType($type);

        return $this->templating->render('RuianTwitterBootstrapBundle:default:_alert_block.html.' . $this->engine, array(
            'type'      => $type,
            'content'   => $content,
            'buttons'   => $buttons,
        ));
    }

    /**
     * Render the partial _alert_basic
     * @return $template
     * @param string $content
     * @param string $type  warning || error || success || info
     */
    public function renderBasic($content, $type = 'warning')
    {
        $this->testType($type);

        return $this->templating->render('RuianTwitterBootstrapBundle:default:_alert_basic.html.' . $this->engine, array(
            'type'      => $type,
            'content'   => $content,
        ));
    }

    /**
     * Render the partial _alert_button
     * @return $template
     * @param array $button
     */
    public function renderButton(array $button)
    {
        if (false === array_key_exists('route', $button) || false === array_key_exists('name', $button)) {
            throw new AlertButtonException('There is some missing attributes. Route and Name are necessary.');
        }

        if (false === array_key_exists('class', $button)) {
            $button['class'] = null;
        }

        if (false === array_key_exists('route_param', $button)) {
            $button['route_param'] = array();
        }

        return $this->templating->render('RuianTwitterBootstrapBundle:default:_alert_button.html.' . $this->engine, array(
            'route'         => $button['route'],
            'route_param'   => $button['route_param'],
            'name'          => $button['name'],
            'class'         => $button['class'],
        ));
    }

    public function getName()
    {
        return 'ruian.helper.alert';
    }

    /**
     * Test if the type is right
     */
    private function testType($type)
    {
        if (false === in_array($type, array('warning', 'error', 'success', 'info'))) {
            throw new AlertTypeException($type.' is not a right type. use warning, error, success, info');
        }
    }
}