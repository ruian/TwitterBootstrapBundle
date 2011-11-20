<?php

namespace Ruian\TwitterBootstrapBundle\Model;

use Iterator, ArrayAccess;

/**
* 
*/
class BreadcrumbItemsCollection implements Iterator, ArrayAccess
{
    /**
     * Array
     */
    protected $container = array();

    /**
     * Integer
     */
    protected $position = 0;

    /**
     * Integer
     */
    protected $container_count = -1;
    
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
        $this->container_count++;
    }
    
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }
    
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
        $this->container_count--;
    }
    
    public function offsetGet($offset)
    {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }

    public function get($offset)
    {
        return $this->offsetGet($offset);
    }

    public function getLast()
    {
        return $this->container[$this->container_count];
    }

    public function set($offset, $value)
    {
        $this->offsetSet($offset, $value);
    }

    public function add($value)
    {
        $this->container[] = $value;
    }

    public function rewind()
    {
        $this->position = 0;
    }

    public function current()
    {
        return $this->container[$this->position];
    }

    public function key()
    {
        return $this->position;
    }

    public function next()
    {
        ++$this->position;
    }

    public function valid()
    {
        return isset($this->container[$this->position]);
    }
}