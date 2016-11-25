<?php namespace Istheweb\Slider\Models;

use Carbon\Carbon;
use Model;

/**
 * Slider Model
 */
class Slider extends Model
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'istheweb_slider_sliders';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [
        'slides'        => 'Istheweb\Slider\Models\Slide',

    ];
    public $belongsTo = [];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [

    ];
    public $attachMany = [];

    public function beforeSave()
    {
        $postSlider = post('Slider');
        if(strlen($postSlider['published_at']) == 0) $this->published_at = Carbon::now();
    }

}