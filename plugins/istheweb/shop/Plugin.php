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

    public $require = ['RainLab.Location', 'RainLab.User', 'Istheweb.IsPdf'];

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
                    'categories'     => [
                        'label'       => 'istheweb.shop::lang.categories.menu_label',
                        'icon'        => 'icon-cubes',
                        'url'         => Backend::url('istheweb/shop/categories'),
                        'permissions' => ['istheweb.shop.access_categories'],
                        'group'       => 'istheweb.shop::lang.sidebar.catalog',
                        'description' => 'istheweb.shop::lang.category.description',
                    ],
                    'attributes'     => [
                        'label'       => 'istheweb.shop::lang.attributes.menu_label',
                        'icon'        => 'icon-filter',
                        'url'         => Backend::url('istheweb/shop/attributes'),
                        'permissions' => ['istheweb.shop.access_attributes'],
                        'group'       => 'istheweb.shop::lang.sidebar.catalog',
                        'description' => 'istheweb.shop::lang.attributes.description',
                    ],
                    'options'     => [
                        'label'       => 'istheweb.shop::lang.options.menu_label',
                        'icon'        => 'icon-diamond',
                        'url'         => Backend::url('istheweb/shop/options'),
                        'permissions' => ['istheweb.shop.access_options'],
                        'group'       => 'istheweb.shop::lang.sidebar.catalog',
                        'description' => 'istheweb.shop::lang.options.description',
                    ],
                    'currencies'     => [
                        'label'       => 'istheweb.shop::lang.currencies.menu_label',
                        'icon'        => 'icon-money',
                        'url'         => Backend::url('istheweb/shop/currencies'),
                        'permissions' => ['istheweb.shop.access_currency'],
                        'group'       => 'istheweb.shop::lang.sidebar.localization',
                        'description' => 'istheweb.shop::lang.currencies.description',
                    ],
                    'zones'     => [
                        'label'       => 'istheweb.shop::lang.zones.menu_label',
                        'icon'        => 'icon-globe',
                        'url'         => Backend::url('istheweb/shop/zones'),
                        'permissions' => ['istheweb.shop.access_zones'],
                        'group'       => 'istheweb.shop::lang.sidebar.localization',
                        'description' => 'istheweb.shop::lang.zone.description',
                    ],
                    'taxrates'     => [
                        'label'       => 'istheweb.shop::lang.tax_rates.menu_label',
                        'icon'        => 'icon-gavel',
                        'url'         => Backend::url('istheweb/shop/taxrates'),
                        'permissions' => ['istheweb.shop.access_tax_rates'],
                        'group'       => 'istheweb.shop::lang.sidebar.localization',
                        'description' => 'istheweb.shop::lang.tax_rate.description',
                    ],
                    'taxcatgories'     => [
                        'label'       => 'istheweb.shop::lang.tax_categories.menu_label',
                        'icon'        => 'icon-briefcase',
                        'url'         => Backend::url('istheweb/shop/taxcategories'),
                        'permissions' => ['istheweb.shop.access_tax_categories'],
                        'group'       => 'istheweb.shop::lang.sidebar.localization',
                        'description' => 'istheweb.shop::lang.tax_category.description',
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
            'istheweb.shop.access_categories'     => [
                'label' => 'istheweb.shop::lang.category.list_title',
                'tab'   => 'istheweb.shop::lang.plugin.name',
            ],
            'istheweb.shop.access_attributes'     => [
                'label' => 'istheweb.shop::lang.attribute.list_title',
                'tab'   => 'istheweb.shop::lang.plugin.name',
            ],
            'istheweb.shop.access_options'     => [
                'label' => 'istheweb.shop::lang.option.list_title',
                'tab'   => 'istheweb.shop::lang.plugin.name',
            ],
            'istheweb.shop.access_currency'     => [
                'label' => 'istheweb.shop::lang.currency.list_title',
                'tab'   => 'istheweb.shop::lang.plugin.name',
            ],
            'istheweb.shop.access_zones'     => [
                'label' => 'istheweb.shop::lang.zones.list_title',
                'tab'   => 'istheweb.shop::lang.plugin.name',
            ],
            'istheweb.shop.access_tax_rates'     => [
                'label' => 'istheweb.shop::lang.tax_rates.list_title',
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

    // SETTINGS
    public function registerSettings(){
        return [
            /*'slack'           => [
                'label'       => 'istheweb.connect::lang.slack',
                'description' => 'istheweb.connect::lang.slack_description',
                'icon'        => 'icon-slack',
                'class'       => 'Istheweb\Connect\Models\SlackSettings',
                'category'    => 'istheweb.connect::lang.manage',
                'order'       => 101,
                'keywords'    => 'crm customer relationship management slack'
            ],*/
            'shop' => [
                'label'       => 'istheweb.shop::lang.plugin.name',
                'description' => 'istheweb.shop::lang.plugin.config_description',
                'icon'        => 'icon-shopping-bag',
                'class'       => 'Istheweb\Shop\Models\ShopSettings',
                'category'    => 'istheweb.connect::lang.manage',
                'order'       => 105,
                'keywords'    => 'shop relationship sell mail'
            ]
        ];
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
        /*
         * Register menu items for the RainLab.Pages plugin
        */
        Event::listen('pages.menuitem.listTypes', function() {
            return [
                'product-category'       => 'istheweb.shop::lang.menuitem.product_category',
                'all-product-categories' => 'istheweb.shop::lang.menuitem.all_product_categories'
            ];
        });

        Event::listen('pages.menuitem.getTypeInfo', function($type) {
            if ($type == 'product-category' || $type == 'all-product-categories') {
                return ProductCategory::getMenuTypeInfo($type);
            }
        });

        Event::listen('pages.menuitem.resolveItem', function($type, $item, $url, $theme) {
            if ($type == 'product-category' || $type == 'all-product-categories') {
                return ProductCategory::resolveMenuItem($item, $url, $theme);
            }
        });
    }
}
