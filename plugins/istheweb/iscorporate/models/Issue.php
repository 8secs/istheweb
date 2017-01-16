<?php namespace Istheweb\IsCorporate\Models;

use October\Rain\Database\Traits\SoftDelete;
use October\Rain\Database\Traits\Purgeable;
use October\Rain\Database\Traits\Validation;


/**
 * Issue Model
 */
class Issue extends Base
{
    use Validation;
    use SoftDelete;
    use Purgeable;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'istheweb_iscorporate_issues';

    /**
     * @var array
     */
    public $implement = [
        'Istheweb.IsCorporate.Behaviors.IssueModel'
    ];

    /**
     * @var array
     */
    protected $fillable = ['subject', 'type', 'content', 'name_contact', 'surname_contact'];

    /**
     * @var array
     */
    public $attributeNames = [
        'subject' => 'istheweb.iscorporate::lang.fields.subject',
        'type'    => 'istheweb.iscorporate::lang.fields.type',
        'content' => 'istheweb.iscorporate::lang.fields.content'
    ];

    /**
     * @var array
     */
    public $rules = [
        'subject' => 'required|max:255',
        'type'    => 'required',
        'content' => 'required'
    ];

    /**
     * @var array
     */
    public $purgeable = ['ticket_toolbar', 'ticket_messages', 'reply'];

    /**
     * @var array
     */
    protected $dates = ['status_updated_at'];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [
        'client'            => 'Istheweb\IsCorporate\Models\Client',
        'resource'          => 'Istheweb\IsCorporate\Models\Employee',
        'creator'           => 'Backend\Models\User',
        'status'            => 'Istheweb\IsCorporate\Models\IssueStatus',
        'type'              => ['Istheweb\IsCorporate\Models\IssueType', 'scope' => 'active'],
    ];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [
        'messages' => ['Istheweb\IsCorporate\Models\IssueMessage', 'name' => 'messageable']
    ];
    public $attachOne = [];

    /**
     * @var array
     */
    public $attachMany = [
        'attachments' => ['System\Models\File', 'public' => false]
    ];

    /**
     * @param string $value
     */
    public function setContentAttribute($value)
    {
        $this->attributes['content'] = strip_tags(trim($value));
    }

    /**
     * @return void
     */
    public function beforeCreate()
    {
        $this->setDefaults();
    }

    /**
     * @return void
     */
    public function afterCreate()
    {
        Event::fire('issue.afterCreate', [$this]);
    }

    /**
     * @return void
     */
    public function afterDelete()
    {
        $this->deleteAttachments();
    }

    /**
     * @param $query
     */
    public function scopeClosed($query)
    {
        $query->where('is_closed', true);
    }

    /**
     * @param $query
     */
    public function scopeOpened($query)
    {
        $query->where('is_closed', false);
    }

    /**
     * @param $fields
     * @param null $context
     */
    public function filterFields($fields, $context = null)
    {
        if ($this->isAllowedToUpdate($context)) {
            foreach ($fields as $field) {
                $field->disabled = true;
            }
        }
    }

}