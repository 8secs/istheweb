<?php namespace Istheweb\Shop\FormWidgets;

use Backend\Classes\FormWidgetBase;
use Istheweb\Shop\Models\Variant;

/**
 * OrderItemVariant Form Widget
 */
class OrderItemVariant extends FormWidgetBase
{
    use \Backend\Traits\FormModelWidget;

    /**
     * {@inheritDoc}
     */
    protected $defaultAlias = 'istheweb_shop_order_item_variant';

    /**
     * {@inheritDoc}
     */
    public function init()
    {
    }

    /**
     * {@inheritDoc}
     */
    public function render()
    {
        $this->prepareVars();
        return $this->makePartial('orderitemvariant');
    }

    /**
     * Prepares the form widget view data
     */
    public function prepareVars()
    {
        $this->vars['name'] = $this->formField->getName();
        $this->vars['value'] = $this->getLoadValue();
        $this->vars['model'] = $this->model;

        $this->vars['variants'] = $this->getVariants();

    }

    protected function getVariants(){
        $variants =Variant::all()->lists('id', 'name');
        return $variants;
    }

    /**
     * {@inheritDoc}
     */
    public function loadAssets()
    {
        $this->addCss('css/orderitemvariant.css', 'Istheweb.Shop');
        $this->addJs('js/orderitemvariant.js', 'Istheweb.Shop');
    }

    /**
     * {@inheritDoc}
     */
    public function getSaveValue($value)
    {
        return $value;
    }

}
