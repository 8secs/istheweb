<?php namespace Istheweb\Slider;

use Backend;
use System\Classes\PluginBase;

/**
 * Slider Plugin Information File
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
            'name'        => 'istheweb.slider::lang.plugin.name',
            'description' => 'istheweb.slider::lang.plugin.description',
            'author'      => 'Andres Rangel',
            'icon'        => 'icon-caret-square-o-right',
        ];
    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return [
            'Istheweb\Slider\Components\Slider' => 'Slider',
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
            '\Istheweb\Slider\Components\Slider' => 'Slider'
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
            'istheweb.slider.access_slider' => [
                'label' => 'istheweb.slider::lang.slider.list_title',
                'tab'   => 'istheweb.slider::lang.plugin.name',
            ],
            'istheweb.slider.access_slides' => [
                'label' => 'istheweb.slider::lang.slide.list_title',
                'tab'   => 'istheweb.slider::lang.plugin.name',
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

        return [
            'slider' => [
                'label'       => 'Slider',
                'url'         => Backend::url('istheweb/slider/slides'),
                'icon'        => 'icon-caret-square-o-right',
                'permissions' => ['istheweb.slider.*'],
                'order'       => 500,
                'sideMenu'    => [
                    'slider' => [
                        'label'       => 'istheweb.slider::lang.sliders.menu_label',
                        'icon'        => 'icon-caret-square-o-right',
                        'url'         => Backend::url('istheweb/slider/sliders'),
                        'permissions' => ['istheweb.slider.access_slider'],
                        'description' => 'istheweb.slider::lang.slider.description',
                    ],
                    'slides' => [
                        'label'       => 'istheweb.slider::lang.slides.menu_label',
                        'icon'        => 'icon-sliders',
                        'url'         => Backend::url('istheweb/slider/slides'),
                        'permissions' => ['istheweb.slider.access_slides'],
                        'description' => 'istheweb.slider::lang.slides.description',
                    ],
                ],
            ],
        ];
    }

    public function registerMarkupTags()
    {
        return [
            'filters' => [
                'hex2rgb'  => [$this, 'hex2rgb']
            ]
        ];
    }

    public function register()
    {
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

    public function hex2rgb($hex){
        $hex = str_replace("#", "", $hex);

        if(strlen($hex) == 3) {
            $r = hexdec(substr($hex,0,1).substr($hex,0,1));
            $g = hexdec(substr($hex,1,1).substr($hex,1,1));
            $b = hexdec(substr($hex,2,1).substr($hex,2,1));
        } else {
            $r = hexdec(substr($hex,0,2));
            $g = hexdec(substr($hex,2,2));
            $b = hexdec(substr($hex,4,2));
        }
        $rgb = array($r, $g, $b);
        return implode(",", $rgb); // returns the rgb values separated by commas
    }


    public function startPage($page = 'slides')
    {
        $user = BackendAuth::getUser();
        $permissions = array_reverse(array_keys($this->registerPermissions()));

        if (!isset($user->permissions['superuser']) && $user->hasAccess('istheweb.slider.*')) {
            foreach ($permissions as $access) {
                if ($user->hasAccess($access)) {
                    $page = explode('_', $access)[1];
                }
            }
        }
        return $page;
    }

}
