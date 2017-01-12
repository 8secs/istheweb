<?php namespace Istheweb\IsCorporate\Models;

/**
 * Client Model
 */
class Client extends Base
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'istheweb_iscorporate_clients';

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
        'budgets'       => 'Istheweb\IsCorporate\Models\Budget',
        'projects'       => 'Istheweb\IsCorporate\Models\Project',
    ];
    public $belongsTo = [
        'company'           => 'Istheweb\Connect\Models\Company'
    ];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

}