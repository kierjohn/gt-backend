<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        //

        'api/tasks',
        'api/users',
        'api/tasks/*',
        'api/users/*',
        'api/login'
    ];

    protected function shouldPassThrough($request)
    {
        foreach ($this->except as $route) {
            if ($request->is($route) && in_array($request->method(), ['POST', 'PUT', 'PATCH', 'DELETE'])) {
                return true;
            }
        }

        return parent::shouldPassThrough($request);
    }
}
