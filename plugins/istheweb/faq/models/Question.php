<?php namespace Istheweb\Faq\Models;

use Model;

/**
 * Question Model
 */
class Question extends Model
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'istheweb_faq_questions';

    public $rules = [
        'category_id' => 'integer|required',
        'is_approved' => 'boolean',
        'is_featured' => 'boolean',
        'answer' => ''
    ];

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = ['text', 'answer'];

    /**
     * @var array Relations
     */
    public $belongsTo = [
        'category' => 'Istheweb\Faq\Models\Category'
    ];

    public $attachOne = [
        'picture' => ['System\Models\File'],
    ];

}