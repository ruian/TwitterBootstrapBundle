<?php
namespace Ruian\TwitterBootstrapBundle\Exception;

use Exception;

class TwitterBootstrapVersionException extends Exception
{
    
    function __construct($message)
    {
        parent::__construct($message);
    }
}