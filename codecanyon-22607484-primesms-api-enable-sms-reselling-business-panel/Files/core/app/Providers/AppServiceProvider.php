<?php

namespace App\Providers;

use App\GeneralSetting;
use App\Social;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        if(Schema::hasTable('general_settings')) {
            $general = GeneralSetting::first();
            $color = $general->base_color;
            if ($color[0] == '#') {
                $color = substr($color, 1);
            }
            if (strlen($color) == 6) {
                list($r, $g, $b) = array($color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5]);
            } elseif (strlen($color) == 3) {
                list($r, $g, $b) = array($color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2]);
            } else {
                return false;
            }
            $r = hexdec($r);
            $g = hexdec($g);
            $b = hexdec($b);
            $r = $r - 25;
            $g = $r - 25;
            $rgb = 'rgba('.$r. ',' .$g .',' .$b. ',' . 0.7.')';
            view()->share(compact('general', 'rgb'));
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
