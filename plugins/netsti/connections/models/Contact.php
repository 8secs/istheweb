<?php namespace NetSTI\Connections\Models;

// LIBRERIAS
use Model;
use ValidationException;
use NetSTI\Connections\Classes\Slack;

// CLASE
class Contact extends Model{

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
	protected $table = 'netsti_connections_contacts';
	protected $primaryKey = 'id';
	protected $dates = [];
	protected $guarded = [];
	protected $jsonable = [];
	protected $fillable = [];
	protected $visible = [];

	// RELACIONES
	public $hasOne = [];
	public $hasMany = [];
	public $belongsTo = [
		'company' => ['NetSTI\Connections\Models\Company']
	];
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
			["name" => $this->name, "email" => $this->email],
			'netsti/connections/contacts',
			':telephone_receiver:', 
			'netsti.connections::lang.menu.contacts'
		);
	}

	public function beforeSave(){ }
	public function afterSave(){ }

	public function beforeValidate(){ }
	public function afterValidate(){ }

	public function beforeUpdate(){ }
	public function afterUpdate(){
		Slack::push(
			'netsti.connections::lang.update_entry',
			["name" => $this->name, "email" => $this->email],
			'netsti/connections/contacts/update/'.$this->id,
			':telephone_receiver:', 
			'netsti.connections::lang.menu.contacts'
		);
	}

	public function beforeDelete(){ }
	public function afterDelete(){ }

	public function beforeRestore(){ }
	public function afterRestore(){ }

	public function beforeFetch(){ }
	public function afterFetch(){ }
}