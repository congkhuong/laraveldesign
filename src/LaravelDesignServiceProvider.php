<?php namespace Congkhuong\LaravelDesign;

use Illuminate\Support\ServiceProvider;
use Congkhuong\LaravelDesign\Controllers\DesignerController;

class LaravelDesignServiceProvider extends ServiceProvider {

   /**
    * Bootstrap the application services.
    *
    * @return void
    */
   public function boot()
   {
      	$this->loadViewsFrom(__DIR__.'/views', 'laravelDesign');

      	$this->publishes([
	    	__DIR__.'/views' => base_path('resources/views/congkhuong/laravelDesign'),
		]);

      	//
		$this->publishes([
		    __DIR__.'/assets' => public_path('vendor/congkhuong'),
		], 'congkhuong');
   }

   /**
    * Register the application services.
    *
    * @return void
    */
   	public function register()
   	{
      	include __DIR__.'/routes.php';
      	$this->app->make('Congkhuong\LaravelDesign\Controllers\DesignerController');
   	}

}