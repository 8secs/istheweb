<?php namespace Istheweb\Connect\Models;

use Model;

/**
 * Calendar Model
 */
class Calendar extends Model
{
    // VALIDACIONES
    use \October\Rain\Database\Traits\Validation;
    public $rules = [
        'name' => 'required|max:180|min:3',
    ];

    public $attributeNames = [
        'name' => 'istheweb.connect::lang.fields.name',
    ];

    // TRASLATABLE
    public $implement = ['RainLab.Translate.Behaviors.TranslatableModel'];
    public $translatable = ['name'];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'istheweb_connect_calendars';

    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $guarded = [];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [
        'events' => ['Istheweb\Connect\Models\Event'],
    ];
    public $belongsTo = [];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

}