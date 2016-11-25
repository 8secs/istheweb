<?php namespace Istheweb\Mailgun;

use Backend;
use System\Classes\PluginBase;

/**
 * Mailgun Plugin Information File
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
            'name'        => 'istheweb.mailgun::lang.plugin.name',
            'description' => 'istheweb.mailgun::lang.plugin.description',
            'author'      => 'Andres Rangel',
            'icon'        => 'icon-envelope'
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
     * @return array
     */
    public function boot()
    {

    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return [
            'Istheweb\Mailgun\Components\ManageMailList' => 'ManageMailList',
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return []; // Remove this line to activate

        return [
            'istheweb.mailgun.some_permission' => [
                'tab' => 'Mailgun',
                'label' => 'Some permission'
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return []; // Remove this line to activate

        return [
            'mailgun' => [
                'label'       => 'Mailgun',
                'url'         => Backend::url('istheweb/mailgun/mycontroller'),
                'icon'        => 'icon-leaf',
                'permissions' => ['istheweb.mailgun.*'],
                'order'       => 500,
            ],
        ];
    }

}
