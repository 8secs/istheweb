<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 13/06/16
 * Time: 18:58
 */

namespace Istheweb\Corporate\Components;

use Cms\Classes\ComponentBase;
use Illuminate\Support\Facades\Lang;

class Component extends ComponentBase
{

    public function componentDetails()
    {
    }

    public function defineProperties()
    {
        return [
            'maxItems' => [
                'title'             => 'istheweb.corporate::lang.labels.maxItems',
                'description'       => 'istheweb.corporate::lang.descriptions.maxItems',
                'default'           => 20,
                'type'              => 'string',
                'validationPattern' => '^[0-9]+$',
            ],
            'itemId'   => [
                'title'             => 'istheweb.corporate::lang.labels.itemId',
                'description'       => 'istheweb.corporate::lang.descriptions.itemId',
                'default'           => '',
                'type'              => 'string',
                'validationPattern' => '^[0-9]+$',
            ],
            'orderBy'  => [
                'title'       => 'istheweb.corporate::lang.labels.orderBy',
                'description' => 'istheweb.corporate::lang.descriptions.orderBy',
                'type'        => 'dropdown',
                'default'     => 'id',
            ],
            'sort'     => [
                'title'       => 'istheweb.corporate::lang.labels.sort',
                'description' => 'istheweb.corporate::lang.descriptions.sort',
                'type'        => 'dropdown',
                'default'     => 'desc',
            ],
        ];
    }

    public function getSortOptions()
    {
        return [
            'desc' => Lang::get('istheweb.corporate::lang.labels.descending'),
            'asc'  => Lang::get('istheweb.corporate::lang.labels.ascending'),
        ];
    }
}