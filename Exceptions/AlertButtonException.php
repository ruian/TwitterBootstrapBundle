<?php

namespace Ruian\TwitterBoostrapBundle\Exception;

use Exception;

class AlertButtonException extends Exception
{
    public function __constructor($message)
    {
        parent::__construct($message);
    }
}