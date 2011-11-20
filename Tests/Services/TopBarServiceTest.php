<?php
namespace Ruian\TwitterBootstrapBundle\Tests\Services;

use Ruian\TwitterBootstrapBundle\Services\TopBarService;
use Ruian\TwitterBootstrapBundle\Model\TopBar;

class TopBarServiceTest extends \PHPUnit_Framework_TestCase
{
    public function testGenerate()
    {
        $topbar_array = array(
            'title'         => 'default bar',
            'title_route'   => 'RuianTwitterBootstrapBundle_test_alert_basic',
            'title_route_parameters' => array(
                'id' => 1,
            ),
            'nav' => array(
                'homepage' => array(
                    'name' => 'homepage',
                    'route' => '#',
                    'route_parameters' => array(),
                    'children' => array(),
                ),
            ),
        );
        $topbar_generate = TopBarService::generateTopBar($topbar_array);
        
        $this->assertTrue(($topbar_generate instanceof TopBar));
        $this->assertTrue(($topbar_generate->getTitle() === 'default bar'));
        $this->assertTrue(($topbar_generate->getRoute() === 'RuianTwitterBootstrapBundle_test_alert_basic'));
        $this->assertTrue((count($topbar_generate->getNav()->getChildren()) === 1));
    }
}