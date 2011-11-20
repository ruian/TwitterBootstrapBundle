<html>
<head>
    <title></title>
<?php foreach($view['assetic']->stylesheets(array(
    '@RuianTwitterBootstrapBundle/Resources/public/css/bootstrap.css',
), array(
    '?yui_css'
), array(
    'output' => 'css/test_all.css'
)) as $url): ?>
        <link rel="stylesheet" type="text/css" href="<?php echo $url ?>" />
<?php endforeach ?>
</head>
<body>
<?php echo $view['ruian.twitterbootstrap.alert']->renderBlock('lorem') ?>
<?php echo $view['ruian.twitterbootstrap.alert']->renderBlock('ipsum', 'success', array(
    'button_1' => array(
        'name' => 'button_foo',
        'route' => 'RuianTwitterBootstrapBundle_test_alert_block',
        'class' => 'class_test'
    )
)) ?>

<?php foreach ($view['assetic']->javascripts(array(
    '@RuianTwitterBootstrapBundle/Resources/public/js/jquery.js',
    '@RuianTwitterBootstrapBundle/Resources/public/js/bootstrap-alerts.js',
    '@RuianTwitterBootstrapBundle/Resources/public/js/bootstrap-buttons.js',
    '@RuianTwitterBootstrapBundle/Resources/public/js/bootstrap-dropdown.js',
    '@RuianTwitterBootstrapBundle/Resources/public/js/bootstrap-modal.js',
    '@RuianTwitterBootstrapBundle/Resources/public/js/bootstrap-popover.js',
    '@RuianTwitterBootstrapBundle/Resources/public/js/bootstrap-scrollspy.js',
    '@RuianTwitterBootstrapBundle/Resources/public/js/bootstrap-tabs.js',
    '@RuianTwitterBootstrapBundle/Resources/public/js/bootstrap-twipsy.js',
), array(
    '?yui_js'
), array(
    'output' => 'js/test_all.js'
)) as $url): ?>
    <script type="text/javascript" src="<?php echo $url ?>"></script>
<?php endforeach; ?>
</body>
</html>