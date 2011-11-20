<div class="container">
    <ul class="breadcrumb">
<?php foreach ($breadcrumb->getItems() as $item): ?>
        <li class="<?php echo !$view['ruian.twitterbootstrap.breadcrumb']->isActive($item->getRoute())?:'active' ?>">
            <a href="<?php echo $view['router']->generate($item->getRoute(), $item->getRouteParameters()) ?>"><?php echo $item->getName() ?></a>
<?php if($breadcrumb->getItems()->getLast() !== $item): ?>
            <span class="divider">/</span>
<?php endif; ?>
        </li>
<?php endforeach ?>
    </ul>
</div>