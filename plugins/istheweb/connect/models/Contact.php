<?php namespace Istheweb\Connect\Models;

use Model;

/**
 * Contact Model
 */
class Contact extends Model
{

    // VALIDACIONES
    use \October\Rain\Database\Traits\Validation;
    public $rules = [
        'name' => 'required|max:180|min:3',
        'email' => 'required|email|unique:netsti_connections_contacts'
    ];

    public $attributeNames = [
        'name' => 'netsti.connections::lang.fields.name',
        'email' => 'netsti.connections::lang.fields.email'
    ];

    // PROPIEDADES
    public $timestamps = false;
    public $table = 'istheweb_connect_contacts';
    protected $primaryKey = 'id';
    protected $dates = [];
    protected $guarded = [];
    protected $jsonable = [];
    protected $fillable = [];
    protected $visible = [];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [
        'company' => ['Istheweb\Connect\Models\Company']
    ];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

}