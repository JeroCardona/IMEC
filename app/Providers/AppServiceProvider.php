<?php

namespace App\Providers;

use App\Interfaces\ReportGeneratorInterface;
use App\Interfaces\SearchInterface;
use App\Utils\PDFReportGenerator;
use App\Utils\Search;
use App\Utils\TXTReportGenerator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

        Schema::defaultStringLength(191);

        $this->app->bind(SearchInterface::class, Search::class);

        $this->app->bind(ReportGeneratorInterface::class, function ($app) {
            return $app->make(PdfReportGenerator::class);
        });

        $this->app->bind(ReportGeneratorInterface::class, function ($app) {
            return $app->make(TxtReportGenerator::class);
        });

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
