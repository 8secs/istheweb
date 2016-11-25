<?php namespace Istheweb\Carousel\Components;

use Cms\Classes\ComponentBase;
use Illuminate\Support\Facades\Lang;
use Schema;
use Istheweb\Carousel\Models\Carousel as CarouselModel;

class Carousel extends ComponentBase
{

    public $carousel;

    public $carousels;

    public function componentDetails()
    {
        return [
            'name'        => 'istheweb.carousel::lang.components.carousel.name',
            'description' => 'istheweb.carousel::lang.components.carousel.description',
        ];
    }

    public function defineProperties()
    {
        return [
            'maxItems' => [
                'title'             => 'istheweb.carousel::lang.labels.maxItems',
                'description'       => 'istheweb.carousel::lang.descriptions.maxItems',
                'default'           => 20,
                'type'              => 'string',
                'validationPattern' => '^[0-9]+$',
            ],
            'itemId'   => [
                'title'             => 'istheweb.carousel::lang.labels.itemId',
                'description'       => 'istheweb.carousel::lang.descriptions.itemId',
                'default'           => '',
                'type'              => 'string',
                'validationPattern' => '^[0-9]+$',
            ],
            'orderBy'  => [
                'title'       => 'istheweb.carousel::lang.labels.orderBy',
                'description' => 'istheweb.carousel::lang.descriptions.orderBy',
                'type'        => 'dropdown',
                'default'     => 'id',
            ],
            'sort'     => [
                'title'       => 'istheweb.carousel::lang.labels.sort',
                'description' => 'istheweb.carousel::lang.descriptions.sort',
                'type'        => 'dropdown',
                'default'     => 'desc',
            ],
        ];
    }

    public function getSortOptions()
    {
        return [
            'desc' => Lang::get('istheweb.carousel::lang.labels.descending'),
            'asc'  => Lang::get('istheweb.carousel::lang.labels.ascending'),
        ];
    }

    public function onRun()
    {
        if (is_numeric($id = $this->property('itemId'))) {
            $this->carousel = $this->page['carousel'] = CarouselModel::whereId($id)
                ->with('slides')
                ->with('slides.image')
                ->with('slides.items')
                ->first();
        } else {
            $carousels = CarouselModel::published()
                ->orderBy($this->property('orderBy', 'id'), $this->property('sort', 'desc'))
                ->take($this->property('maxItems'))
                ->get();
            $this->carousels = $this->page['carousels'] = $carousels;
        }

    }

    public function getOrderByOptions()
    {
        $schema = Schema::getColumnListing('istheweb_carousel_carousels');
        foreach ($schema as $column) {
            $options[$column] = ucwords(str_replace('_', ' ', $column));
        }
        return $options;
    }

}