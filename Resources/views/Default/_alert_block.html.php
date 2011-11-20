<div class="alert-message block-message <?php echo $type ?> fade in" data-alert="alert">
    <a class="close" href="#">×</a>
    <p>
    <?php echo $content ?>
    </p>
    <div class="alert-actions">
<?php foreach ($buttons as $button): ?>
    <?php echo $view['ruian.twitterbootstrap.alert']->renderButton($button) ?>
<?php endforeach ?>
    </div>
</div>