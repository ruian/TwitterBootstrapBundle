<?php

namespace Ruian\TwitterBootstrapBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Ruian\TwitterBootstrapBundle\Model\TopBar;
use Ruian\TwitterBootstrapBundle\Model\TopBarNav;
use Ruian\TwitterBootstrapBundle\Model\Breadcrumb;
use Ruian\TwitterBootstrapBundle\Model\BreadcrumbItem;

class TestController extends Controller
{
    
    public function alertBasicAction()
    {
        return $this->render('RuianTwitterBootstrapBundle:Test:alert_basic.html.php');
    }

    public function alertBlockAction()
    {
        return $this->render('RuianTwitterBootstrapBundle:Test:alert_block.html.php');
    }

    public function breadcrumbAction()
    {
        $breadcrumb = new Breadcrumb();
        $item = new BreadcrumbItem();
        $item->setName('foo');
        $item->setRoute('RuianTwitterBootstrapBundle_test_breadcrumb', array());
        $breadcrumb->addItem($item);

        $item = new BreadcrumbItem();
        $item->setName('bar');
        $item->setRoute('RuianTwitterBootstrapBundle_test_top_bar', array());
        $breadcrumb->addItem($item);
        
        return $this->render('RuianTwitterBootstrapBundle:Test:breadcrumb.html.php', array(
            'breadcrumb' => $breadcrumb,
        ));
    }

    public function topBarAction()
    {

        $topbar = new TopBar();
        $topbar->setTitle('foo <small>ob</small> bar');
        $topbar->setRoute('RuianTwitterBootstrapBundle_test_top_bar');
        $homepage = new TopBarNav();
        $homepage->setName('Homepage');
        $homepage->setRoute('RuianTwitterBootstrapBundle_test_top_bar', array());
        $homepage->setParent($topbar->getNav());
        $topbar->addNav($homepage);

        $breadcrumb = new TopBarNav();
        $breadcrumb->setName('Breadcrumb page');
        $breadcrumb->setRoute('RuianTwitterBootstrapBundle_test_breadcrumb', array());
        $breadcrumb->setParent($topbar->getNav());
        $topbar->addNav($breadcrumb);

        $parent = new TopBarNav();
        $parent->setName('test parent');
        $parent->setRoute('RuianTwitterBootstrapBundle_test_breadcrumb', array());
        $parent->setParent($topbar->getNav());

        $child = new TopBarNav();
        $child->setParent($parent);
        $child->setName('test child');
        $child->setRoute('RuianTwitterBootstrapBundle_test_breadcrumb', array());

        $parent->addChild($child);
        $topbar->addNav($parent);

        return $this->render('RuianTwitterBootstrapBundle:Test:top_bar.html.php', array(
            'topbar' => $topbar,
        ));
    }
}
