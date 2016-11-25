<?php namespace Istheweb\Slider\Models;

use Carbon\Carbon;
use Model;

/**
 * Slide Model
 */
class Slide extends Model
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'istheweb_slider_slides';

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
    public $hasMany = [];
    public $belongsTo = [
        'slider'        => 'Istheweb\Slider\Models\Slider',
    ];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [
        'image' => 'System\Models\File'
    ];
    public $attachMany = [];

    public function beforeSave()
    {
        $postSlide = post('Slide');
        if(strlen($postSlide['published_at']) == 0) $this->published_at = Carbon::now();

    }

    public function afterDelete()
    {
        if($this->image){
            $this->image->delete();
        }
    }
}