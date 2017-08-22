<?php namespace Wooxo\CommandLockRedis;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
class CommandLockRedisServiceProvider extends ServiceProvider {

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
		$this->publishes(['wooxo/command-lock-redis']);
		$this->app->booting(function()
		{
            $loader = AliasLoader::getInstance();
            $loader->alias('CommandLockRedis', 'Wooxo\CommandLockRedis\CommandLockRedis');
		});
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
		return array();
	}

}
