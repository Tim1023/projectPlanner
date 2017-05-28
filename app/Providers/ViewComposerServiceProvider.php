<?php

namespace ProgramPlanner\Providers;

use Illuminate\Routing\Controller;
use Illuminate\Support\ServiceProvider;
use ProgramPlanner\Models\UI\AdminSidebar;
use Illuminate\Support\Facades\Auth;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Navigation variables
        view()->composer('admin._navigation', function($view){
            $view->with('user', Auth::user());
            $view->with('signedIn', Auth::check());
        });

        view()->composer('admin._sidebar', function($view){
            $view->with('sidebarMenuList', AdminSidebar::createMenu());
            $controllerName = $this->getCurrentController();
            $view->with('activeSidebarMenuItem', $controllerName);
        });


    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    private function getCurrentController(){
        $action = app('request')->route()->getAction();
        $controller = class_basename($action['controller']);
        list($controller, $action) = explode('@', $controller);
        return $controller;
    }
}
