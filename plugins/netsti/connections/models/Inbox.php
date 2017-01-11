<?php namespace NetSTI\Connections\Models;

// LIBRERIAS
use Model;
use ValidationException;
use NetSTI\Connections\Classes\Slack;

// CLASE
class Inbox extends Model{

	// VALIDACIONES
	use \October\Rain\Database\Traits\Validation;
	public $rules = [
	];

	// PROPIEDADES
	public $timestamps = true;
	protected $table = 'netsti_connections_inboxes';
	protected $primaryKey = 'id';
	protected $dates = [];
	protected $guarded = [];
	protected $jsonable = [];
	protected $fillable = ['name','email','phone','company','subject','message'];
	protected $visible = [];

	// RELACIONES
	public $hasOne = [];
	public $hasMany = [];
	public $belongsTo = [];
	public $belongsToMany = [];

	// FUCIONES
	public $morphTo = [];
	public $morphOne = [];
	public $morphMany = [];

	// ADJUNTOS Y ARCHIVOS
	public $attachOne = [];
	public $attachMany = [];

	// EVENTOS
	public function beforeCreate(){ }
	public function afterCreate(){
		Slack::push(
			'netsti.connections::lang.new_entry',
			["name" => $this->name, "email" => $this->email, "message" => $this->message],
			'netsti/connections/inboxes',
			':mailbox_with_mail:', 
			'netsti.connections::lang.menu.inboxes'
		);
	}

	public function beforeSave(){ }
	public function afterSave(){ }

	public function beforeValidate(){ }
	public function afterValidate(){ }

	public function beforeUpdate(){ }
	public function afterUpdate(){ }

	public function beforeDelete(){ }
	public function afterDelete(){ }

	public function beforeRestore(){ }
	public function afterRestore(){ }

	public function beforeFetch(){ }
	public function afterFetch(){ }
}