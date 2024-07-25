<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Services\CustomerServiceImpl;
use App\Http\Interfaces\CustomerService;
use App\Http\Services\ProductServiceImpl;
use App\Http\Interfaces\ProductService;
use App\Http\Services\IndentServiceImpl;
use App\Http\Interfaces\IndentService;
use App\Http\Services\LocationServiceImpl;
use App\Http\Interfaces\LocationService;
use App\Http\Services\ProductTypeServiceImpl;
use App\Http\Interfaces\ProductTypeService;
use App\Http\Services\CityServiceImpl;
use App\Http\Interfaces\CityService;
use App\Http\Services\StateServiceImpl;
use App\Http\Interfaces\StateService;
use App\Http\Interfaces\CountryService;
use App\Http\Services\CountryServiceImpl;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
		$this->app->bind(CustomerService::class, CustomerServiceImpl::class);
        $this->app->bind(ProductService::class, ProductServiceImpl::class);
        $this->app->bind(ProductTypeService::class,ProductTypeServiceImpl::class);
        $this->app->bind(IndentService::class, IndentServiceImpl::class);
        $this->app->bind(LocationService::class, LocationServiceImpl::class);
        $this->app->bind(CityService::class, CityServiceImpl::class);
        $this->app->bind(StateService::class, StateServiceImpl::class);
        $this->app->bind(CountryService::class, CountryServiceImpl::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
