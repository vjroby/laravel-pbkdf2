<?php

namespace Vjroby\LaravelPbkdf2;

use Illuminate\Support\ServiceProvider;

class LaravelPbkdf2ServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('vjroby/laravel-pbkdf2','vjroby-laravel-pbkdf2');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return ['vjroby-laravel-pbkdf2'];
	}

}
