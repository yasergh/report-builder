<?php
/**
  * This file is part of consoletvs/invoice-maker.
  *
  * (c) Erik Campobadal <soc@erik.cat>
  *
  * For the full copyright and license information, please view the LICENSE
  * file that was distributed with this source code.
  */

namespace Snono\ReportBuilder\Builder;

use Illuminate\Support\ServiceProvider;

/**
 * This is the InvoicesServiceProvider class.
 *
 * @author Erik Campobadal <soc@erik.cat>
 */
class InvoicesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/Templates', 'report-builder');

        $this->publishes([
            __DIR__ . '/Templates' => resource_path('views/vendor/report-builder'),
            __DIR__ . '/Config/reports.php' => config_path('reports.php'),
        ], 'invoice-maker');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/Config/reports.php', 'report-builder'
        );
    }
}
