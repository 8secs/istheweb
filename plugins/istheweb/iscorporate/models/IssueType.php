<?php namespace Istheweb\IsCorporate\Models;

use Model;

/**
 * IssueType Model
 */
class IssueType extends Model
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'istheweb_iscorporate_issue_types';

    /**
     * @var array
     */
    protected $fillable = ['name', 'description', 'is_active'];

    /**
     * @var array
     */
    public $attributeNames = [
        'name'        => 'istheweb.corporate::lang.fieds.name',
        'description' => 'istheweb.corporate::lang.fieds.description',
        'is_active'   => 'istheweb.corporate::lang.fieds.is_active'
    ];

    /**
     * @var array
     */
    public $rules = [
        'name'        => 'required|max:100',
        'description' => 'max:255',
        'is_active'   => 'boolean'
    ];

    /**
     * @var array
     */
    public $belongsToMany = [
        'tickets' => ['Istheweb\IsCorporate\Models\Issue']
    ];

    /**
     * @param $query
     * @return mixed
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

}