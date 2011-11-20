<?php

namespace Ruian\TwitterBoostrapBundle\Exception;

use Exception;

class StringException extends Exception
{
    public function __constructor($message)
    {
        parent::__construct($message);
    }
}