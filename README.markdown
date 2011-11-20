TwitterBootstrapBundle
===================

* [Installation](#installation)
* [Alert basic](#alert-basic)
* [Alert block](#alert-block)
* [Breadcrumb](#breadcrumb)
* [Top bar](#topbar)
* [Assets](#assets)

<a name="installation"></a>

## Installation

### Step 1) Get the bundle

First, grab the RuianTwitterBootstrapBundle :

Add the following lines to your  `deps` file and then run `php bin/vendors
install`:

```
[RuianTwitterBootstrapBundle]
    git=git://github.com/ruian/RuianTwitterBootstrapBundle.git
    target=bundles/Ruian/TwitterBootstrapBundle
```

### Step 2) Register the namespaces

Add the following two namespace entries to the `registerNamespaces` call
in your autoloader:

``` php
<?php
// app/autoload.php
$loader->registerNamespaces(array(
    // ...
    'Ruian' => __DIR__.'/../vendor/bundles',
    // ...
));
```

### Step 3) Register the bundle

To start using the bundle, register it in your Kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Ruian\TwitterBootstrapBundle\RuianTwitterBootstrapBundle(),
    );
    // ...
)
```

### Step 4) Configure the bundle


```yaml
# app/config/config.yml
ruian_twitter_bootstrap:
    engine: php  # set to twig if you want tu use twig
```

Add the routing

```yaml
# app/config/routing.yml
ruian_twitter_bootstrap:
    resource: "@RuianTwitterBootstrapBundle/Resources/config/routing.yml"
```

<a name="alert-basic"></a>

## Create a basic alert
in your view add this line:

``` php
<?php echo $view['ruian.twitterbootstrap.alert']->renderBasic('Your alert message here!', 'error') ?>
```

<a name="alert-block"></a>

## Create a block alert
in your view add this line:

``` php
<?php echo $view['ruian.twitterbootstrap.alert']->renderBlock('Your alert message here!', 'error', array(
    'btn_1' => array(
        'name' => 'Button 1',
        'route' => 'Your route from routing.yml',
        'route_param' => array(),
        'class' => 'Some class if you want',
    )
)) ?>
```

<a name="breadcrumb"></a>
## Insert Breadcrumb
In your Controller:

``` php
        #namespace ....
        use Ruian\TwitterBootstrapBundle\Model\Breadcrumb;
        use Ruian\TwitterBootstrapBundle\Model\Item;
        #....Action()
        $breadcrumb = new Breadcrumb();
        $item = new BreadcrumbItem();
        $item->setName('Homepage');
        $item->setRoute('RuianTwitterBootstrapBundle_test_breadcrumb', array());
        $breadcrumb->addItem($item);
        
        return $this->render('RuianTwitterBootstrapBundle:Test:breadcrumb.html.php', array(
            'breadcrumb' => $breadcrumb,
        ));
```
In your view:

``` php
<?php echo $view['ruian.twitterbootstrap.breadcrumb']->render($breadcrumb) ?>
```

<a name="topbar"></a>

## Insert Topbar
In your Controller:

``` php
        #namespace ....
        use Ruian\TwitterBootstrapBundle\Model\TopBar;
        use Ruian\TwitterBootstrapBundle\Model\TopBarNav;
        #....Action()
        $topbar = new TopBar();
        $topbar->setTitle('My website');
        $topbar->setRoute('Your Route from routing.yml');
        $homepage = new TopBarNav();
        $homepage->setName('Homepage');
        $homepage->setRoute('RuianTwitterBootstrapBundle_test_top_bar', array());
        $homepage->setParent($topbar->getNav());
        $topbar->addNav($homepage);
        
        return $this->render('RuianTwitterBootstrapBundle:Test:topbar.html.php', array(
            'topbar' => $topbar,
        ));
```
In your view:

``` php
<?php echo $view['ruian.twitterbootstrap.topbar']->render($topbar) ?>
```

Or if you prefer you can set a whole list of topbar in config.yml

```yaml
ruian_twitter_bootstrap:
    engine: php
    topbars:
        default_bar:
            key: default_bar
            title: default bar
            title_route: RuianTwitterBootstrapBundle_test_alert_basic
            title_route_parameters: { id: 1 }
            nav:
                homepage:
                    key: homepage
                    name: homepage
                    route: RuianTwitterBootstrapBundle_test_alert_basic
                    route_parameters: {id: 2}
                parent:
                    key: parent
                    name: parent container
                    route: RuianTwitterBootstrapBundle_test_alert_basic
                    route_parameters: {id: 3}
                    children:
                        child:
                            key: child
                            name: child
                            route: RuianTwitterBootstrapBundle_test_alert_basic
        admin_bar:
            key: admin_bar
            title: admin bar
            title_route: RuianTwitterBootstrapBundle_test_alert_basic
```

In your controller you can access to it :

```php
        #....Action()
        $topbar = $this->get('ruian.twitterbootstrap.topbar')->getTopBar('default_bar');
        
        return $this->render('RuianTwitterBootstrapBundle:Test:topbar.html.php', array(
            'topbar' => $topbar,
        ));
```

In your view:

``` php
<?php echo $view['ruian.twitterbootstrap.topbar']->render($topbar) ?>
```

or

``` php
<?php echo $view['ruian.twitterbootstrap.topbar']->render('default_bar') ?>
```

<a name="assets"></a>

## Stylesheets and Javascripts

Do not forget to add assets at your layout.

```
@RuianTwitterBootstrapBundle/Resources/public/css/bootstrap.css
@RuianTwitterBootstrapBundle/Resources/public/js/jquery.js
@RuianTwitterBootstrapBundle/Resources/public/js/bootstrap-alerts.js
@RuianTwitterBootstrapBundle/Resources/public/js/bootstrap-buttons.js
@RuianTwitterBootstrapBundle/Resources/public/js/bootstrap-dropdown.js
@RuianTwitterBootstrapBundle/Resources/public/js/bootstrap-modal.js
@RuianTwitterBootstrapBundle/Resources/public/js/bootstrap-popover.js
@RuianTwitterBootstrapBundle/Resources/public/js/bootstrap-scrollspy.js
@RuianTwitterBootstrapBundle/Resources/public/js/bootstrap-tabs.js
@RuianTwitterBootstrapBundle/Resources/public/js/bootstrap-twipsy.js
```
