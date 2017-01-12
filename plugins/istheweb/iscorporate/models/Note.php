<?php namespace Istheweb\IsCorporate\Models;

use Model;

/**
 * Note Model
 */
class Note extends Model
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'istheweb_iscorporate_notes';

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
    public $belongsTo = [];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

}