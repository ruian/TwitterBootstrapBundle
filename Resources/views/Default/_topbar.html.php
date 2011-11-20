<div class="topbar" data-scrollspy="scrollspy" data-dropdown="dropdown">
    <div class="topbar-inner">
        <div class="container">
            <h2>
            <a class="brand" href="<?php echo $view['router']->generate($topbar->getRoute(), $topbar->getRouteParameters()) ?>"><?php echo $topbar->getTitle() ?></a>
            </h2>
            <ul class="nav">
<?php foreach ($topbar->getNav()->getChildren() as $nav): ?>
<?php if ($nav->hasChildren()): ?>
                <li class="dropdown">
                    <a class="dropdown-toggle" href="<?php echo $view['router']->generate($nav->getRoute(), $nav->getRouteParameters()) ?>"><?php echo $nav->getName() ?></a>
                    <ul class="dropdown-menu">
<?php foreach ($nav->getChildren() as $children): ?>
                        <li class="<?php echo !$view['ruian.twitterbootstrap.topbar']->isActive($children->getRoute()) ?: 'active' ?>">
                            <a href="<?php echo $view['router']->generate($children->getRoute(), $children->getRouteParameters()) ?>"><?php echo $children->getName() ?></a>
                        </li>                    
<?php endforeach ?>
                    </ul>
                </li>
                <?php else: ?>
                <li class="<?php echo !$view['ruian.twitterbootstrap.topbar']->isActive($nav->getRoute())?: 'active' ?>">
                    <a href="<?php echo $view['router']->generate($nav->getRoute(), $nav->getRouteParameters()) ?>"><?php echo $nav->getName() ?></a>
                </li>                    
<?php endif ?>
<?php endforeach ?>
            </ul>
        </div>
    </div>
</div>
