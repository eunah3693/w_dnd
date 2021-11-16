<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'https://dndlifecare.com/api/*',
        'https://dev.dndlifecare.com/api/*',
        'http://localhost/api/*'
    ];
}
