<?php namespace Istheweb\Shop\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Istheweb\Shop\Models\Attribute;
use Istheweb\Shop\Models\AttributeValue;
use Istheweb\Shop\Models\OptionValue;
use Istheweb\Shop\Models\Product;
use Istheweb\Shop\Models\Variant;

/**
 * Products Back-end Controller
 */
class Products extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController',
        'Backend.Behaviors.RelationController',

    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';
    public $relationConfig = 'config_relation.yaml';

    public function __construct()
    {
        //dd($this->vars);
        parent::__construct();

        $this->vars['attributes'] = Attribute::getAllAtributes();

        BackendMenu::setContext('Istheweb.Shop', 'shop', 'products');
    }


    public function onRelationButtonCreate(){
        $relation_field = post('_relation_field');
        //dd($relation_field);
        if($relation_field == 'attributeValues'){

        }else if($relation_field == 'variants'){
            $this->getOptions(true);
        }

        return parent::onRelationButtonCreate();
    }

    public function onRelationManageCreate(){
        $relation_field = post('_relation_field');

        if($relation_field == 'variants')
        {
            $product = Product::with('options')->find($this->params[0]);
            $variant = new Variant();
            $name = $product->name;
            $options = array();

            $postVariant = post('Variant');
            $variant->code = $postVariant['code'];
            $variant->product = $product;
            $variant->name = $name;
            $variant->available_on = $postVariant['available_on'];
            $variant->available_until = $postVariant['available_until'];
            $variant->pricing_calculator = $postVariant['pricing_calculator'];
            $variant->pricing_configuration = "";
            $variant->price = $postVariant['price'];
            $variant->on_hold = 0;
            $variant->on_hand = $postVariant['on_hand'] ?: 0;
            $variant->tracked = $postVariant['tracked'] ? 1 : 0;
            $variant->width = $postVariant['width'] ?: 0;
            $variant->height = $postVariant['height'] ?: 0;
            $variant->depth = $postVariant['depth'] ?: 0;
            $variant->weight = $postVariant['weight'] ?: 0;
            $variant->save();

            foreach ($product->options as $key => $value){
                $option = OptionValue::find(post($value->code));
                $options[] = $option;
                $name .= " - ".$option->value;
                $variant->optionsValues()->attach($option);
            }
        }
    }


    public function onRelationClickViewList()
    {
        $this->getOptions(false);
        if(post('_relation_field') != 'options')
            return parent::onRelationClickViewList();
        else
            return Redirect::refresh();
    }

    protected function getOptions($isNew = true)
    {
        if($this->params){
            $product = Product::find($this->params[0]);

            if(!$isNew){
                $variants = $product->variants;
                $variants_arr = array();
                foreach($variants as $variant){
                    $v = Variant::with('optionsValues')->find($variant->id);
                    foreach($v->optionsValues as $opt){
                        $variants_arr[] = $opt->id;
                    }
                }
                $this->vars['variants'] = $variants_arr;
            }

            $this->vars['options'] = $product->options;
            $option_values = array();
            foreach($product->options as $option){
                $values = OptionValue::where('option_id', $option->id)->get();
                $option_values[$option->name] = $values;
            }
            $this->vars['values'] = $option_values;
        }
    }

}