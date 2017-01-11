<?php namespace Istheweb\Corporate;

use App;
use Backend;
use BackendMenu;
use Backend\Facades\BackendAuth;
use Backend\Models\User as UserModel;
use Istheweb\Corporate\Controllers\Empleados as EmpleadosController;
use Istheweb\Corporate\Models\Empleado as EmpleadoModel;
use System\Classes\PluginBase;

/**
 * Corporate Plugin Information File
 */
class Plugin extends PluginBase
{

    public $require = ['RainLab.Location'];

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'istheweb.corporate::lang.plugin.name',
            'description' => 'istheweb.corporate::lang.plugin.description',
            'author'      => 'Andres Rangel',
            'icon'        => 'icon-building',
        ];
    }

    public function registerNavigation()
    {
        return [
            'corporate' => [
                'label'       => 'istheweb.corporate::lang.plugin.name',
                'url'         => Backend::url('istheweb/corporate/'. $this->startPage()),
                'icon'        => 'icon-building',
                'permissions' => ['istheweb.corporate.*'],
                'order'       => 500,

                'sideMenu'    => [
                    'employees'    => [
                        'label'       => 'istheweb.corporate::lang.employees.menu_label',
                        'icon'        => 'icon-user',
                        'url'         => Backend::url('istheweb/corporate/employees'),
                        'permissions' => ['istheweb.corporate.access_employees'],
                        'group'       => 'istheweb.corporate::lang.sidebar.team',
                        'description' => 'istheweb.corporate::lang.employee.description',

                    ],
                    'empleados'    => [
                        'label'       => 'istheweb.corporate::lang.employees.menu_label',
                        'icon'        => 'icon-user',
                        'url'         => Backend::url('istheweb/corporate/empleados'),
                        'permissions' => ['istheweb.corporate.access_employees'],
                        'group'       => 'istheweb.corporate::lang.sidebar.team',
                        'description' => 'istheweb.corporate::lang.employee.description',

                    ],
                    'roles'        => [
                        'label'       => 'istheweb.corporate::lang.roles.menu_label',
                        'icon'        => 'icon-briefcase',
                        'url'         => Backend::url('istheweb/corporate/roles'),
                        'permissions' => ['istheweb.corporate.access_employees'],
                        'group'       => 'istheweb.corporate::lang.sidebar.team',
                        'description' => 'istheweb.corporate::lang.role.description',
                    ],
                    'projects'     => [
                        'label'       => 'istheweb.corporate::lang.projects.menu_label',
                        'icon'        => 'icon-wrench',
                        'url'         => Backend::url('istheweb/corporate/projects'),
                        'permissions' => ['istheweb.corporate.access_projects'],
                        'group'       => 'istheweb.corporate::lang.sidebar.projects',
                        'description' => 'istheweb.corporate::lang.project.description',
                    ],
                    'project_categories'     => [
                        'label'       => 'istheweb.corporate::lang.project_categories.menu_label',
                        'icon'        => 'icon-server',
                        'url'         => Backend::url('istheweb/corporate/projectcategories'),
                        'permissions' => ['istheweb.corporate.access_project_categories'],
                        'group'       => 'istheweb.corporate::lang.sidebar.projects',
                        'description' => 'istheweb.corporate::lang.project_category.description',
                    ],
                    'services'     => [
                        'label'       => 'istheweb.corporate::lang.services.menu_label',
                        'icon'        => 'icon-cogs',
                        'url'         => Backend::url('istheweb/corporate/services'),
                        'permissions' => ['istheweb.corporate.access_services'],
                        'group'       => 'istheweb.corporate::lang.sidebar.projects',
                        'description' => 'istheweb.corporate::lang.service.description',
                    ],
                    'technologies'     => [
                        'label'       => 'istheweb.corporate::lang.technologies.menu_label',
                        'icon'        => 'icon-empire',
                        'url'         => Backend::url('istheweb/corporate/technologies'),
                        'permissions' => ['istheweb.corporate.access_technologies'],
                        'group'       => 'istheweb.corporate::lang.sidebar.projects',
                        'description' => 'istheweb.corporate::lang.technology.description',
                    ],
                    'galleries'    => [
                        'label'       => 'istheweb.corporate::lang.galleries.menu_label',
                        'icon'        => 'icon-photo',
                        'url'         => Backend::url('istheweb/corporate/galleries'),
                        'permissions' => ['istheweb.corporate.access_galleries'],
                        'group'       => 'istheweb.corporate::lang.sidebar.media',
                        'description' => 'istheweb.corporate::lang.gallery.description',
                    ],
                    'testimonials' => [
                        'label'       => 'istheweb.corporate::lang.testimonials.menu_label',
                        'icon'        => 'icon-comment',
                        'url'         => Backend::url('istheweb/corporate/testimonials'),
                        'permissions' => ['istheweb.corporate.access_testimonials'],
                        'group'       => 'istheweb.corporate::lang.sidebar.clients',
                        'description' => 'istheweb.corporate::lang.testimonial.description',
                    ],
                ],
            ],
        ];
    }

    public function startPage($page = 'projects')
    {
        $user = BackendAuth::getUser();
        $permissions = array_reverse(array_keys($this->registerPermissions()));

        if (!isset($user->permissions['superuser']) && $user->hasAccess('istheweb.corporate.*')) {
            foreach ($permissions as $access) {
                if ($user->hasAccess($access)) {
                    $page = explode('_', $access)[1];
                }
            }
        }
        //print_r($page);
        return $page;
    }

    public function registerPermissions()
    {
        return [
            'istheweb.corporate.access_employees'    => [
                'label' => 'istheweb.corporate::lang.employee.list_title',
                'tab'   => 'istheweb.corporate::lang.plugin.name',
            ],
            'istheweb.corporate.access_projects'     => [
                'label' => 'istheweb.corporate::lang.project.list_title',
                'tab'   => 'istheweb.corporate::lang.plugin.name',
            ],
            'istheweb.corporate.access_services'     => [
                'label' => 'istheweb.corporate::lang.service.list_title',
                'tab'   => 'istheweb.corporate::lang.plugin.name',
            ],
            'istheweb.corporate.access_technologies'     => [
                'label' => 'istheweb.corporate::lang.technologies.list_title',
                'tab'   => 'istheweb.corporate::lang.plugin.name',
            ],
            'istheweb.corporate.access_project_categories'      => [
                'label' => 'istheweb.corporate::lang.project_categories.list_title',
                'tab'   => 'istheweb.corporate::lang.plugin.name',
            ],
            'istheweb.corporate.access_galleries'    => [
                'label' => 'istheweb.corporate::lang.gallery.list_title',
                'tab'   => 'istheweb.corporate::lang.plugin.name',
            ],
            'istheweb.corporate.access_testimonials' => [
                'label' => 'istheweb.corporate::lang.testimonial.list_title',
                'tab'   => 'istheweb.corporate::lang.plugin.name',
            ],
            'istheweb.corporate.access_company'      => [
                'label' => 'istheweb.corporate::lang.company.list_title',
                'tab'   => 'istheweb.corporate::lang.plugin.name',
            ],
        ];
    }

    public function registerComponents()
    {
        return [
            'Istheweb\Corporate\Components\Employees'               => 'Employees',
            'Istheweb\Corporate\Components\Projects'                => 'Projects',
            'Istheweb\Corporate\Components\Project'                 => 'Project',
            'Istheweb\Corporate\Components\ProjectCategories'       => 'ProjectCategories',
            'Istheweb\Corporate\Components\Services'                => 'Services',
            'Istheweb\Corporate\Components\Galleries'               => 'Galleries',
            'Istheweb\Corporate\Components\Company'                 => 'Company',
            'Istheweb\Corporate\Components\Testimonials'            => 'Testimonials',
        ];
    }

    /**
     * Register snippets with the RainLab.Pages plugin.
     *
     * @return array
     * @see https://octobercms.com/plugin/rainlab-pages
     */
    public function registerPageSnippets()
    {
        return [
            //'Istheweb\Corporate\Components\Projects'                => 'Projects',
        ];
    }

    public function registerSettings()
    {
        return [
            'company' => [
                'label'       => 'istheweb.corporate::lang.plugin.name',
                'description' => 'istheweb.corporate::lang.settings.description',
                'category'    => 'system::lang.system.categories.system',
                'icon'        => 'icon-building-o',
                'class'       => 'Istheweb\Corporate\Models\Company',
                'order'       => 500,
                'keywords'    => 'istheweb.corporate::lang.settings.label',
                'permissions' => ['istheweb.corporate.access_company'],
            ],
        ];
    }

    public function register()
    {
        BackendMenu::registerContextSidenavPartial('Istheweb.Corporate', 'corporate', 'plugins/istheweb/corporate/partials/_sidebar.htm');
    }

    public function boot(){
        UserModel::extend(function ($model) {
            $model->hasOne['empleado'] = ['Istheweb\Corporate\Models\Empleado'];
        });


        if(!App::runningInBackend()) {
            return;
        }
    }

}
