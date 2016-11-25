<?php namespace Istheweb\Faq\Models;

use Model;

/**
 * Category Model
 */
class Category extends Model
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'istheweb_faq_categories';

    public $rules = [
        'title' => 'required',
        'lang' => 'string',
    ];
    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = ['title'];

    /**
     * @var array Relations
     */
    public $hasMany = [
        'question' => 'Istheweb\Faq\Models\Question'
    ];
    public $timestamps = false;

}