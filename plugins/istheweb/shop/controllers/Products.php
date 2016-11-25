<?php namespace Istheweb\Shop\Controllers;

use Carbon\Carbon;
use Istheweb\Shop\Models\AttributeItem;
use Istheweb\Shop\Models\Product;
use BackendMenu;
use Backend\Classes\Controller;
use Illuminate\Support\Facades\Lang;
use Istheweb\Shop\Models\ProductVariant;
use October\Rain\Support\Facades\Flash;
use Redirect;

/**
 * Products Back-end Controller
 */
class Products extends Controller
{
    public $requiredPermissions = ['istheweb.shop.access_products'];

    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController',
        'Backend.Behaviors.RelationController',
        'Backend.Behaviors.ImportExportController',
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';
    public $relationConfig = 'config_relation.yaml';
    public $importExportConfig = 'config_import_export.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Istheweb.Shop', 'shop', 'products');
    }

    public function onRelationManageCreate(){

        dd(post());
        $relation_field = post('_relation_field');
        $session_key = post('_session_key');

        $productId = $this->params[0];
        $product = Product::find($productId);


        if($relation_field == 'product_variants'){
            $productVariant = post('ProductVariant');
            $attributes = $productVariant['attribute_items'];

            $variant = new ProductVariant();
            $variant->product()->associate($product);
            $variant->name = $productVariant['name'];
            $variant->caption = $productVariant['caption'];
            $variant->description = $productVariant['description'];
            //$variant->published_at = Carbon::now();
            $variant->save();

            $items = [];
            foreach($attributes as $key => $value){
                foreach($value as $k => $v){
                    if($k == 'items'){
                        $item = AttributeItem::find($v);

                        $items->product_variants()->associate($variant);
                        $items[] = $item;
                        $variant->attribute_items()->attach($item);
                    }
                }
            }

            return $items;
            Flash::success('El producto variado se ha creado correctamente');

            return Redirect::refresh();

        }

    }

    public function onRelationManageUpdate()
    {
        $relation_field = post('_relation_field');
        $session_key = post('_session_key');

        $productId = $this->params[0];
        $product = Product::find($productId);


        if($relation_field == 'product_variants'){
            $productVariant = post('ProductVariant');
            //dd($productVariant);
            $attributes = $productVariant['attribute_items'];

            $variant = ProductVariant::find(post('manage_id'));
            $variant->product()->associate($product);
            $variant->name = $productVariant['name'];
            $variant->caption = $productVariant['caption'];
            $variant->description = $productVariant['description'];
            //$variant->published_at = Carbon::now();
            $variant->save();

            $items = [];
            foreach($attributes as $key => $value){
                foreach($value as $k => $v){
                    if($k == 'items'){
                        $item = AttributeItem::find($v);
                        //$item->attribute()->associate()
                        $items[] = $item;
                        $variant->attribute_items()->attach($item);
                    }
                }
            }

            Flash::success('El producto variado se ha creado correctamente');

            return Redirect::refresh();

        }
    }


    /**
     * Deleted checked products.
     */
    public function index_onDelete()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {

            foreach ($checkedIds as $productId) {
                if (!$product = Product::find($productId)) {
                    continue;
                }

                $product->delete();
            }

            Flash::success(Lang::get('istheweb.shop::lang.products.delete_selected_success'));
        } else {
            Flash::error(Lang::get('istheweb.shop::lang.products.delete_selected_empty'));
        }

        return $this->listRefresh();
    }
}