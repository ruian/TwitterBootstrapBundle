<?php

namespace Ruian\TwitterBootstrapBundle\Exceptions;

use Exception;

class TopBarException extends Exception
{
    public function __constructor($message)
    {
        parent::__construct($message);
    }
}