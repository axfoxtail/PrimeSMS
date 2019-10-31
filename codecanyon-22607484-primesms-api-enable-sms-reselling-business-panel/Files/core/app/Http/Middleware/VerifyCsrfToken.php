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
        'newComment',
        'reviewNew',
        '/ipnpaypal','/ipncoin','/ipncoinpaybtc','/ipnperfect','/ipnskrill','/ipnstripe','/ipncoinpayeth','ipncoinpaybch','ipncoinpaydash','ipncoinpaydoge','ipncoinpayltc',
        'download/product',
        'deleteScreenshot',
        'user/getPack',
        'user/getPackDetails',
        'admin/testAPI',
        'admin/customerInfo',
        'admin/productDeatils',
    ];
}
