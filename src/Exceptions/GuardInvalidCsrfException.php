<?php

declare(strict_types=1);

namespace App\Exceptions;

use RuntimeException;

class GuardInvalidCsrfException extends RuntimeException
{
    /** @var int */
    protected $code = 400;

    /** @var string */
    protected $message = 'Invalid CSRF token.';
}
