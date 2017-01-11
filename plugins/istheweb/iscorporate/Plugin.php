<?php namespace Istheweb\IsCorporate;

use App;
use Backend;
use BackendMenu;
use Event;
use Istheweb\IsCorporate\Models\ProjectType;
use System\Classes\PluginBase;
use Backend\Facades\BackendAuth;
use Backend\Models\User as UserModel;

/**
 * IsCorporate Plugin Information File
 */
class Plugin extends PluginBase
{

    public $require = ['Renatio.DynamicPDF', 'Istheweb.Connect'];

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'istheweb.iscorporate::lang.plugin.name',
            'description' => 'istheweb.iscorporate::lang.plugin.description',
            'author'      => 'Andres Rangel',
            'icon'        => 'icon-building',
        ];
    }

    public function boot(){
        UserModel::extend(function ($model) {
            $model->hasOne['empleado'] = ['Istheweb\IsCorporate\Models\Employee'];
        });

        /*
         * Register menu items for the RainLab.Pages plugin
        */
        Event::listen('pages.menuitem.listTypes', function() {
            return [
                'project-type'       => 'istheweb.iscorporate::lang.menuitem.project_type',
                'all-project-types' => 'istheweb.iscorporate::lang.menuitem.all_project_types'
            ];
        });

        Event::listen('pages.menuitem.getTypeInfo', function($type) {
            if ($type == 'project-type' || $type == 'all-project-types') {
                return ProjectType::getMenuTypeInfo($type);
            }
        });

        Event::listen('pages.menuitem.resolveItem', function($type, $item, $url, $theme) {
            if ($type == 'project-type' || $type == 'all-project-types') {
                return ProjectType::resolveMenuItem($item, $url, $theme);
            }
        });


        if(!App::runningInBackend()) {
            return;
        }
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {
        BackendMenu::registerContextSidenavPartial('Istheweb.IsCorporate',
            'iscorporate',
            'plugins/istheweb/iscorporate/partials/_sidebar.htm');
    }

    public function registerFormWidgets()
    {
        return [
            'Istheweb\IsCorporate\FormWidgets\ProjectVariantOptions'  => [
                'label' => 'istheweb.iscorporate::lang.project.options',
                'code'  => 'project_variant_options'
            ],
            'Istheweb\IsCorporate\FormWidgets\ProjectCompany'  => [
                'label' => 'istheweb.iscorporate::lang.project.company',
                'code'  => 'project_company'
            ]
        ];
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
            'Istheweb\IsCorporate\Components\MyComponent' => 'myComponent',
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {

        return [
            'istheweb.iscorporate.access_employees'    => [
                'label' => 'istheweb.iscorporate::lang.employee.list_title',
                'tab'   => 'istheweb.iscorporate::lang.plugin.name',
            ],
            'istheweb.iscorporate.access_clients'    => [
                'label' => 'istheweb.iscorporate::lang.client.list_title',
                'tab'   => 'istheweb.iscorporate::lang.plugin.name',
            ],
            'istheweb.iscorporate.access_budgets'    => [
                'label' => 'istheweb.iscorporate::lang.budget.list_title',
                'tab'   => 'istheweb.iscorporate::lang.plugin.name',
            ],
            'istheweb.iscorporate.access_providers'    => [
                'label' => 'istheweb.iscorporate::lang.provider.list_title',
                'tab'   => 'istheweb.iscorporate::lang.plugin.name',
            ],
            'istheweb.iscorporate.access_projects'     => [
                'label' => 'istheweb.iscorporate::lang.project.list_title',
                'tab'   => 'istheweb.iscorporate::lang.plugin.name',
            ],
            'istheweb.iscorporate.create_projects'     => [
                'label' => 'istheweb.iscorporate::lang.project.create_title',
                'tab'   => 'istheweb.iscorporate::lang.plugin.name',
            ],
            'istheweb.iscorporate.delete_projects'     => [
                'label' => 'istheweb.iscorporate::lang.project.delete_title',
                'tab'   => 'istheweb.iscorporate::lang.plugin.name',
            ],
            'istheweb.iscorporate.access_project_types'     => [
                'label' => 'istheweb.iscorporate::lang.project_type.list_title',
                'tab'   => 'istheweb.iscorporate::lang.plugin.name',
            ],
            'istheweb.iscorporate.access_options'     => [
                'label' => 'istheweb.iscorporate::lang.option.list_title',
                'tab'   => 'istheweb.iscorporate::lang.plugin.name',
            ]
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return [
            'iscorporate' => [
                'label'       => 'IsCorporate',
                'url'         => Backend::url('istheweb/iscorporate/'. $this->startPage()),
                'icon'        => 'icon-building',
                'permissions' => ['istheweb.iscorporate.*'],
                'order'       => 500,

                'sideMenu'    => [

                    'clients'        => [
                        'label'       => 'istheweb.iscorporate::lang.clients.menu_label',
                        'icon'        => 'icon-university',
                        'url'         => Backend::url('istheweb/iscorporate/clients'),
                        'permissions' => ['istheweb.iscorporate.access_employees'],
                        'group'       => 'istheweb.iscorporate::lang.sidebar.clients',
                        'description' => 'istheweb.iscorporate::lang.client.description',
                    ],
                    'budgets'        => [
                        'label'       => 'istheweb.iscorporate::lang.budgets.menu_label',
                        'icon'        => 'icon-bullseye',
                        'url'         => Backend::url('istheweb/iscorporate/budgets'),
                        'permissions' => ['istheweb.iscorporate.access_budgets'],
                        'group'       => 'istheweb.iscorporate::lang.sidebar.clients',
                        'description' => 'istheweb.iscorporate::lang.budget.description',
                    ],
                    'projects'     => [
                        'label'       => 'istheweb.iscorporate::lang.projects.menu_label',
                        'icon'        => 'icon-rocket',
                        'url'         => Backend::url('istheweb/iscorporate/projects'),
                        'permissions' => ['istheweb.iscorporate.access_projects'],
                        'group'       => 'istheweb.iscorporate::lang.sidebar.catalog',
                        'description' => 'istheweb.iscorporate::lang.project.description',
                    ],
                    'project_types'     => [
                        'label'       => 'istheweb.iscorporate::lang.project_types.menu_label',
                        'icon'        => 'icon-cubes',
                        'url'         => Backend::url('istheweb/iscorporate/projecttypes'),
                        'permissions' => ['istheweb.iscorporate.access_project_types'],
                        'group'       => 'istheweb.iscorporate::lang.sidebar.catalog',
                        'description' => 'istheweb.iscorporate::lang.project_type.description',
                    ],
                    'options'     => [
                        'label'       => 'istheweb.iscorporate::lang.options.menu_label',
                        'icon'        => 'icon-diamond',
                        'url'         => Backend::url('istheweb/iscorporate/projectoptions'),
                        'permissions' => ['istheweb.iscorporate.access_options'],
                        'group'       => 'istheweb.iscorporate::lang.sidebar.catalog',
                        'description' => 'istheweb.iscorporate::lang.option.description',
                    ],
                    'employees'    => [
                        'label'       => 'istheweb.iscorporate::lang.employees.menu_label',
                        'icon'        => 'icon-user',
                        'url'         => Backend::url('istheweb/iscorporate/employees'),
                        'permissions' => ['istheweb.iscorporate.access_employees'],
                        'group'       => 'istheweb.iscorporate::lang.sidebar.team',
                        'description' => 'istheweb.iscorporate::lang.employee.description',

                    ],
                    'roles'        => [
                        'label'       => 'istheweb.iscorporate::lang.roles.menu_label',
                        'icon'        => 'icon-briefcase',
                        'url'         => Backend::url('istheweb/iscorporate/roles'),
                        'permissions' => ['istheweb.iscorporate.access_employees'],
                        'group'       => 'istheweb.iscorporate::lang.sidebar.team',
                        'description' => 'istheweb.iscorporate::lang.role.description',
                    ],
                    'providers'        => [
                        'label'       => 'istheweb.iscorporate::lang.providers.menu_label',
                        'icon'        => 'icon-code-fork',
                        'url'         => Backend::url('istheweb/iscorporate/providers'),
                        'permissions' => ['istheweb.iscorporate.access_providers'],
                        'group'       => 'istheweb.iscorporate::lang.sidebar.providers',
                        'description' => 'istheweb.iscorporate::lang.provider.description',
                    ]
                ]
            ],
        ];
    }

    public function startPage($page = 'clients')
    {
        $user = BackendAuth::getUser();
        $permissions = array_reverse(array_keys($this->registerPermissions()));

        if (!isset($user->permissions['superuser']) && $user->hasAccess('istheweb.iscorporate.*')) {
            foreach ($permissions as $access) {
                if ($user->hasAccess($access)) {
                    $page = explode('_', $access)[1];
                }
            }
        }
        //print_r($page);
        return $page;
    }

}
