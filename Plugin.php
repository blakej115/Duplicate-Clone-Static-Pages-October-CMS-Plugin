<?php namespace BlakeJones\DuplicateCloneStaticPages;

use Backend;
use System\Classes\PluginBase;

/**
 * Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Duplicate/Clone Static Pages',
            'description' => 'No description provided yet...',
            'author'      => 'BlakeJones',
            'icon'        => 'icon-leaf'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Boot method, called right before the request route.
     *
     * @return void
     */
    public function boot()
    {
        Event::listen('backend.page.beforeDisplay', function($controller, $action, $params) {
            $controller->addJs('/plugins/xeor/duplicate/assets/js/duplicate.js');
        });
    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return []; // Remove this line to activate

        return [
            'BlakeJones\DuplicateCloneStaticPages\Components\MyComponent' => 'myComponent',
        ];
    }

    /**
     * Registers any backend permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return []; // Remove this line to activate

        return [
            'blakejones.duplicateclonestaticpages.some_permission' => [
                'tab' => 'DuplicateCloneStaticPages',
                'label' => 'Some permission'
            ],
        ];
    }

    /**
     * Registers backend navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return []; // Remove this line to activate

        return [
            'duplicateclonestaticpages' => [
                'label'       => 'DuplicateCloneStaticPages',
                'url'         => Backend::url('blakejones/duplicateclonestaticpages/mycontroller'),
                'icon'        => 'icon-leaf',
                'permissions' => ['blakejones.duplicateclonestaticpages.*'],
                'order'       => 500,
            ],
        ];
    }
}
