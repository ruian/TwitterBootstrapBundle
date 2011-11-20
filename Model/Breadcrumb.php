<?php

namespace Ruian\TwitterBootstrapBundle\Model;

/**
* 
*/
class Breadcrumb
{
    /**
     * Ruian\TwitterBootstrapBundle\Model\ItemsCollection
     */
    protected $items;

    public function __construct()
    {
        $this->items = new BreadcrumbItemsCollection();
    }

    public function getItems()
    {
        return $this->items;
    }

    public function addItem(BreadcrumbItem $item)
    {
        $this->items[] = $item;
    }
}