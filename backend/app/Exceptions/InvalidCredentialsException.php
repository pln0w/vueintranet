<?php namespace App\Exceptions;

use Exception;
use Throwable;

class InvalidCredentialsException extends Exception
{
    protected $message = 'Invalid credentials';

    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($this->message, 0, null);
    }

}