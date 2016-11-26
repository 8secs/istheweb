<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 25/11/16
 * Time: 13:15
 */

namespace Istheweb\Shop\Models;

use October\Rain\Database\Model as BaseModel;
use Sylius\Component\Product\Model\DateRange;


class Model extends BaseModel
{
    public $implement = ['@RainLab.Translate.Behaviors.TranslatableModel'];

    public $translatable = ['name', 'slug', 'caption', 'description', 'meta_keywords', 'meta_description', 'short_description'];

    protected $dates = ['published_at'];

    protected $guarded = ['*'];

    public function scopePublished($query)
    {
        return $query->where('published_at', '<', date('Y-m-d H:i:s'));
    }




}