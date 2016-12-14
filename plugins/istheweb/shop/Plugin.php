<?php namespace Istheweb\Shop;

use Backend;
use BackendMenu;
use Backend\Facades\BackendAuth;
use App;
use Event;
use Illuminate\Foundation\AliasLoader;
use Istheweb\Shop\Models\Category as ProductCategory;
use System\Classes\PluginBase;
use RainLab\User\Models\User as UserModel;
use RainLab\User\Controllers\Users as UserController;
use RainLab\Location\Models\Country;
use RainLab\Location\Models\State;
use Istheweb\Shop\Models\Address;
use Istheweb\Shop\Models\Customer;

/**
 * Shop Plugin Information File
 */
class Plugin extends PluginBase
{

    public $require = ['RainLab.Location', 'RainLab.User', 'Renatio.DynamicPDF'];

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'istheweb.shop::lang.plugin.name',
            'description' => 'istheweb.shop::lang.plugin.description',
            'author'      => 'Andres Rangel',
            'icon'        => 'icon-shopping-cart',
        ];
    }

    public function registerNavigation()
    {
        return [
            'shop' => [
                'label'       => 'istheweb.shop::lang.plugin.name',
                'url'         => Backend::url('istheweb/shop/'. $this->startPage()),
                'icon'        => 'icon-shopping-cart',
                'permissions' => ['istheweb.shop.*'],
                'order'       => 500,

                'sideMenu'    => [

                    'products'     => [
                        'label'       => 'istheweb.shop::lang.products.menu_label',
                        'icon'        => 'icon-rocket',
                        'url'         => Backend::url('istheweb/shop/products'),
                        'permissions' => ['istheweb.shop.access_products'],
                        'group'       => 'istheweb.shop::lang.sidebar.catalog',
                        'description' => 'istheweb.shop::lang.product.description',
                    ],
                    'attributes'     => [
                        'label'       => 'istheweb.shop::lang.attributes.menu_label',
                        'icon'        => 'icon-cubes',
                        'url'         => Backend::url('istheweb/shop/attributes'),
                        'permissions' => ['istheweb.shop.access_attributes'],
                        'group'       => 'istheweb.shop::lang.sidebar.catalog',
                        'description' => 'istheweb.shop::lang.attributes.description',
                    ],
                    'options'     => [
                        'label'       => 'istheweb.shop::lang.options.menu_label',
                        'icon'        => 'icon-cubes',
                        'url'         => Backend::url('istheweb/shop/options'),
                        'permissions' => ['istheweb.shop.access_options'],
                        'group'       => 'istheweb.shop::lang.sidebar.catalog',
                        'description' => 'istheweb.shop::lang.options.description',
                    ]
                ],
            ],
        ];
    }

    public function startPage($page = 'projects')
    {
        $user = BackendAuth::getUser();
        $permissions = array_reverse(array_keys($this->registerPermissions()));

        if (!isset($user->permissions['superuser']) && $user->hasAccess('istheweb.shop.*')) {
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

            'istheweb.shop.access_products'     => [
                'label' => 'istheweb.shop::lang.product.list_title',
                'tab'   => 'istheweb.shop::lang.plugin.name',
            ],
            'istheweb.shop.create_products'     => [
                'label' => 'istheweb.shop::lang.product.create_title',
                'tab'   => 'istheweb.shop::lang.plugin.name',
            ],
            'istheweb.shop.delete_products'     => [
                'label' => 'istheweb.shop::lang.product.delete_title',
                'tab'   => 'istheweb.shop::lang.plugin.name',
            ],
            'istheweb.shop.access_attributes'     => [
                'label' => 'istheweb.shop::lang.attribute.list_title',
                'tab'   => 'istheweb.shop::lang.plugin.name',
            ],
            'istheweb.shop.access_options'     => [
                'label' => 'istheweb.shop::lang.option.list_title',
                'tab'   => 'istheweb.shop::lang.plugin.name',
            ]
        ];
    }

    public function registerComponents()
    {
        return [

        ];
    }

    public function registerFormWidgets()
    {
        return [
            'Istheweb\Shop\FormWidgets\ProductVariantOptions'  => [
                'label' => 'istheweb.shop::lang.product.options',
                'code'  => 'product_variant_options'
            ],
            'Istheweb\Shop\FormWidgets\ProductAttributeValues'  => [
                'label' => 'istheweb.shop::lang.product.attributes',
                'code'  => 'product_attribute_options'
            ]
        ];
    }

    public function registerSettings()
    {
        return[];

    }

    public function registerMailTemplates()
    {
        return [

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

        ];
    }

    public function register()
    {
        BackendMenu::registerContextSidenavPartial('Istheweb.Shop', 'shop', 'plugins/istheweb/shop/partials/_sidebar.htm');
        set_exception_handler([$this, 'handleException']);
    }

    /**
     * Workaround to resolve
     * TypeError: Argument 1 passed to October\Rain\Foundation\Exception\Handler::report() must be an instance of Exception
     * This error is fixed by octobercms/library@83888f4
     * witch Fixes seg fault (infinite loop) when using remember()
     * but while it's not in dev-master branch we use this workaround function
     * @param $e Exception
     */
    public function handleException($e)
    {
        if (! $e instanceof Exception) {
            $e = new \Symfony\Component\Debug\Exception\FatalThrowableError($e);
        }

        $handler = $this->app->make('Illuminate\Contracts\Debug\ExceptionHandler');
        $handler->report($e);

        if ($this->app->runningInConsole()) {
            $handler->renderForConsole(new ConsoleOutput, $e);
        } else {
            $handler->render($this->app['request'], $e)->send();
        }
    }

    public function boot()
    {


    }
}
