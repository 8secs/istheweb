<?php namespace Istheweb\IsCorporate\Models;

/**
 * Report Model
 */
class Report extends Base
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'istheweb_iscorporate_reports';

    /**
     * @var array Fillable fields
     */
    protected $fillable = [ 'hours', 'minutes', 'comments'];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [
        'variant'       => 'Istheweb\IsCorporate\Models\Variant',
        //'employee'      => 'Istheweb\IsCorporate\Models\Employee',
        'project'       => 'Istheweb\IsCorporate\Models\Project',
    ];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];


}