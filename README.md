TwitterBootstrapBundle
======================

#How to install ?

##Add theses lines into your deps

```
[RuianTwitterBootstrapBundle]
    git=git://github.com/ruian/TwitterBootstrapBundle.git
    version=origin/master
    target=/bundles/Ruian/TwitterBootstrapBundle

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
#app/autoload.php
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
#app/AppKernel.php
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


##Example
```
#Ruian/DemoBundle/Resources/view/new.html.twig
<!DOCTYPE html>
<html>
<head>
    <title>New article</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('bundles/ruiantwitterbootstrap/css/bootstrapv2.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('bundles/ruiantwitterbootstrap/css/bootstrapv2-responsive.css') }}">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="offset2 span8">
                
                {% include 'RuianTwitterBootstrapBundle:Alert:bootstrap_v2.html.twig' %}

                {% form_theme form_view 'RuianTwitterBootstrapBundle:Form:bootstrap_v2.html.twig' %}
                <form novalidate class="form-horizontal well" method="post" action="{{ path('RuianDemoBundle_new') }}">
                    {{ form_widget(form_view) }}
                    <div class="well">
                        <input type="submit" value="Save" class="btn" />
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{ asset('bundles/ruiandemo/js/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('bundles/ruiantwitterbootstrap/js/bootstrapv2.js') }}"></script>
</body>
</html>
```

```
#Ruian/DemoBundle/Controller/ArticleController.php
/**
 * Controller used for Article
 *
 * @author jgalenski
 */
class ArticleController extends Controller
{
    # some code ...

    public function newAction()
    {
        $entity = new Article();
        $form = $this->createForm(new ArticleType(), $entity);
        
        $request = $this->get('request');
        if ('POST' === $request->getMethod()) {
            $form->bindRequest($request);
            if (true === $form->isValid()) {
                $em = $this->get('doctrine.orm.default_entity_manager');
                $em->persist($entity);
                $em->flush();

                $this->setFlashSuccess('Congratulation, your article has been saved.');
                return $this->redirect($this->generateUrl('RuianDemoBundle_new'));
            } else {
                $this->setFlashError('Warning, your article can\'t be saved due to some errors.');
            }
        }

        return $this->render('RuianDemoBundle:Article:new.html.twig', array(
            'form_view' => $form->createView(),
        ));
    }

    protected function setFlashSuccess($message)
    {
        $this->get('session')->setFlash('alert-success', $message);
    }

    protected function setFlashError($message)
    {
        $this->get('session')->setFlash('alert-error', $message);
    }

    # some code ...
}

```