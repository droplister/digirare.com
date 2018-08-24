<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Application;
use Illuminate\Contracts\Encryption\Encrypter;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * Constructor (Helps Use Config Value)
     * 
     * @param  Application  $app
     * @param  Encrypter  $encrypter
     * @return void
     */
    public function __construct(Application $app, Encrypter $encrypter) {
        parent::__construct($app, $encrypter);

        $this->except = [
          config('digirare.telegram_webook'),
        ];
    }
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
    ];
}
