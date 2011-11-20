<?php

namespace Ruian\TwitterBoostrapBundle\Exception;

use Exception;

class AlertTypeException extends Exception
{
    public function __constructor($message)
    {
        parent::__construct($message);
    }
}