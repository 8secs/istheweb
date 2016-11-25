<?php namespace Istheweb\Slider\Components;

use Cms\Classes\ComponentBase;
use GuzzleHttp\Client;
use Istheweb\Slider\Models\Slide;
use Istheweb\Slider\Models\Slider as SliderModel;
use Illuminate\Support\Facades\Lang;
use Schema;

class Slider extends ComponentBase
{
    /**
     * @var 
     */
    public $slider;
    
    public $sliders;

    protected $tweetURL;

    public $tweetContent;

    public $selectedSlide;

    public function componentDetails()
    {
        return [
            'name'        => 'istheweb.slider::lang.components.slider.name',
            'description' => 'istheweb.slider::lang.components.slider.description'
        ];
    }

    public function defineProperties()
    {
        return [
            'itemId'   => [
                'title'             => 'istheweb.slider::lang.labels.itemId',
                'description'       => 'istheweb.slider::lang.descriptions.itemId',
                'default'           => '',
                'type'              => 'string',
                'validationPattern' => '^[0-9]+$',
            ],
            'orderBy'  => [
                'title'       => 'istheweb.slider::lang.labels.orderBy',
                'description' => 'istheweb.slider::lang.descriptions.orderBy',
                'type'        => 'dropdown',
                'default'     => 'id',
            ],
            'sort'     => [
                'title'       => 'istheweb.slider::lang.labels.sort',
                'description' => 'istheweb.slider::lang.descriptions.sort',
                'type'        => 'dropdown',
                'default'     => 'desc',
            ],
            'slideWidth' => [
                'title'       => 'istheweb.slider::lang.labels.slider_width',
                'description' => 'istheweb.slider::lang.descriptions.sliderWidth',
            ],
            'minSlides' => [
                'title'       => 'istheweb.slider::lang.labels.min_slides',
                'description' => 'istheweb.slider::lang.descriptions.minSlides',
            ],
            'maxSlides' => [
                'title'       => 'istheweb.slider::lang.labels.max_slides',
                'description' => 'istheweb.slider::lang.descriptions.maxSlides',
            ],
            'slideMargin' => [
                'title'       => 'istheweb.slider::lang.labels.slide_margin',
                'description' => 'istheweb.slider::lang.descriptions.slideMargin',
            ],
        ];
    }

    public function onRun()
    {
        $this->prepareVars();
    }

    public function prepareVars()
    {
        $this->slideWidth = $this->page['slideWidth'] = $this->property('slideWidth');
        $this->minSlides = $this->page['minSlides'] = $this->property('minSlides');
        $this->maxSlides = $this->page['maxSlides'] = $this->property('maxSlides');
        $this->slideMargin = $this->page['slideMargin'] = $this->property('slideMargin');

        //$this->tweetURL = 'https://api.twitter.com/1/statuses/oembed.json?url=';
        $this->tweetURL = 'https://publish.twitter.com/oembed?url=';

        if (is_numeric($id = $this->property('itemId'))) {
            $this->slider = $this->page['slider'] = SliderModel::whereId($id)
                ->first();

        }
    }

    public function getSortOptions()
    {
        return [
            'desc' => Lang::get('istheweb.slider::lang.labels.descending'),
            'asc'  => Lang::get('istheweb.slider::lang.labels.ascending'),
        ];
    }

    public function getOrderByOptions()
    {
        $schema = Schema::getColumnListing('istheweb_slider_sliders');
        foreach ($schema as $column) {
            $options[$column] = ucwords(str_replace('_', ' ', $column));
        }
        return $options;
    }

    public function onSliderChange(){
        $id = post('id');
        if(!$id) return false;
        $this->selectedSlide = Slide::find($id);
        if(!$this->selectedSlide) return false;
        $url = $this->selectedSlide->url;
        if(!$url) return false;
        $this->tweetContent = $url;
        return $this->tweetContent;
    }

    protected function getEmbedTweet($url){
        //return json_decode(file_get_contents($this->tweetURL . $url));
        $client = new Client();
        $res = $client->get($this->tweetURL.$url);

        return $res;
    }
}