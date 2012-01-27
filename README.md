TwitterBootstrapBundle
======================

#How to install ?

##Add theses lines into your deps

```
[RuianTwitterBootstrapBundle]
    git=git://github.com/ruian/TwitterBootstrapBundle.git
    version=v2

[TwitterBootstrap1]
    git=git://github.com/twitter/bootstrap.git
    target=/twitter/bootstrap/v1/
    version=origin/master

[TwitterBootstrap2]
    git=git://github.com/twitter/bootstrap.git
    target=/twitter/bootstrap/v2/
    version=origin/2.0-wip

[lessphp]
    git=git://github.com/leafo/lessphp.git
    target=/lessphp/
    version=origin/master
```

##Add autoloading

```
$loader->registerNamespaces(array(
    #...
    'Ruian' => __DIR__.'/../vendor/bundles',
));

 #some code...

 // Add support for lessc
require  __DIR__.'/../vendor/lessphp/lessc.inc.php';

```

##Register this bundle

```
$bundles = array(
    #...
    new Ruian\TwitterBootstrapBundle\RuianTwitterBootstrapBundle(),
);
```

##Update and install all the deps

```
./bin/vendors update
or
./bin/vendors install --reinstall
```

#How to use it ?

##Init and compile twitter-bootstrap from source
Remplace VERSION by the supported version you want, v1 or v2

```
php5 app/console twitter-bootstrap:clear
php5 app/console twitter-bootstrap:compile VERSION
php5 app/console assets:install web/
```

##Add your bootstrap to your layout
Remplace VERSION by the supported version you want, v1 or v2

```
<!DOCTYPE html>
<html>
<head>
    <title>Twitter Bootstrap</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('bundles/ruiantwitterbootstrap/css/bootstrapVERSION.css') }}">
</head>
<body>
    <!-- Some code -->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('bundles/ruiantwitterbootstrap/js/bootstrapVERSION.js') }}"></script>
</body>
</html>
```

##Use bootstrap form style
Remplace VERSION by the supported version you want, v1 or v2

```
{% form_theme form_view 'RuianTwitterBootstrapBundle:Form:bootstrap_VERSION.html.twig' %}
```