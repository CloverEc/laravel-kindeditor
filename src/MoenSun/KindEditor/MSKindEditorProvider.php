<?php
/**
 * Created by Bane.Shi.
 * Copyright MoenSun
 * User: Bane.Shi
 * Date: 16/7/26
 * Time: 12:47
 */

namespace MoenSun\KindEditor;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class MSKindEditorProvider extends ServiceProvider
{

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$configPath = __DIR__."/../../../config/mskindeditor.php";
		$this->mergeConfigFrom($configPath, 'mskindeditor');
	}

	public function boot(){
		$configPath = __DIR__."/../../../config/mskindeditor.php";

		$this->publishes([$configPath => $this->getConfigPath()],'config');

		$routeConfig = [
			'namespace' => 'MoenSun\KindEditor\Controllers',
		];

		$this->getRouter()->group($routeConfig,function($router){
			$router->any('mslaravel-kindeditor',["uses"=>"Controller@kindeditor"]);
		});
	}

	protected function getRouter()
	{
		return $this->app['router'];
	}

	public function getConfigPath(){
		return config_path("mskindeditor.php");
	}
	protected function publishConfig($configPath)
	{
		$this->publishes([$configPath => config_path('mskindeditor.php')], 'config');
	}
}