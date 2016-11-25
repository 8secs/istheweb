<?php namespace Istheweb\Faq;

use Backend;
use System\Classes\PluginBase;

/**
 * Faq Plugin Information File
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
            'name'        => 'Faq',
            'description' => 'No description provided yet...',
            'author'      => 'Istheweb',
            'icon'        => 'icon-comments'
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
            'Istheweb\Faq\Components\Ask' => 'Ask',
            'Istheweb\Faq\Components\FaqList' => 'FaqList',
            'Istheweb\Faq\Components\Featured' => 'Featured',
            'Istheweb\Faq\Components\Last' => 'LastFaqs',
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
            'istheweb.faq.access_faq' => [
                'tab' => 'Faq',
                'label' => 'Access and manage Faq'
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
            'faq' => [
                'label'       => 'istheweb.faq::lang.plugin.name',
                'url'         => Backend::url('istheweb/faq/questions'),
                'icon'        => 'icon-comments',
                'permissions' => ['istheweb.faq.*'],

                'sideMenu'    => [
                    'questions' => [
                        'label' => 'istheweb.faq::lang.questions.menu_label',
                        'icon'        => 'icon-question-circle',
                        'url'         => Backend::url('istheweb/faq/questions'),
                        'permissions' => ['istheweb.faq.*']

                    ],
                    'categories' => [
                        'label' => 'istheweb.faq::lang.categories.menu_label',
                        'icon'        => 'icon-list-ul',
                        'url'         => Backend::url('istheweb/faq/categories'),
                        'permissions' => ['istheweb.faq.*']
                    ]
                ]
            ]
        ];
    }

    public function registerMailTemplates()
    {
        return [
            'istheweb.faq::mail.replied' => 'User notification about question being answered',
            'istheweb.faq::mail.asked'  => 'Notification about new question being asked'
        ];
    }

}
