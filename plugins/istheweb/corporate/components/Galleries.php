<?php namespace Istheweb\Corporate\Components;

use Istheweb\Corporate\Models\Gallery;
use Illuminate\Support\Facades\Schema;

class Galleries extends Component
{

    public $gallery;

    public $galleries;

    public function componentDetails()
    {
        return [
            'name'        => 'istheweb.corporate::lang.components.galleries.name',
            'description' => 'istheweb.corporate::lang.components.galleries.description',
        ];
    }

    public function onRun()
    {
        if (is_numeric($id = $this->property('itemId'))) {
            $this->gallery = $this->page['gallery'] = Gallery::whereId($id)->with('pictures')->first();
        } else {
            $galleries = Gallery::published()
                ->with('pictures')
                ->orderBy($this->property('orderBy', 'id'), $this->property('sort', 'desc'))
                ->take($this->property('maxItems'))
                ->get();
            $this->galleries = $this->page['galleries'] = $galleries;
        }
    }

    public function getOrderByOptions()
    {
        $schema = Schema::getColumnListing('andresrangel_coorporation_galleries');
        foreach ($schema as $column) {
            $options[$column] = ucwords(str_replace('_', ' ', $column));
        }
        return $options;
    }

}