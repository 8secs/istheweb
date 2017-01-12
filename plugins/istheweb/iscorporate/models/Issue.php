<?php namespace Istheweb\IsCorporate\Models;


/**
 * Issue Model
 */
class Issue extends Base
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'istheweb_iscorporate_issues';

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
        'client'            => 'Istheweb\IsCorporate\Models\Client',
        'resource'          => 'Istheweb\IsCorporate\Models\Employee',
        'creator'           => 'Backend\Models\User'
    ];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

}