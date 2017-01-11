<?php namespace NetSTI\Connections\Models;

// LIBRERIAS
use Model;
use ValidationException;
use NetSTI\Connections\Classes\Slack;

// CLASE
class Calendar extends Model{

	// VALIDACIONES
	use \October\Rain\Database\Traits\Validation;
	public $rules = [
		'name' => 'required|max:180|min:3',
	];

	public $attributeNames = [
		'name' => 'netsti.connections::lang.fields.name',
	];

	// TRASLATABLE
	public $implement = ['RainLab.Translate.Behaviors.TranslatableModel'];
	public $translatable = ['name'];

	// PROPIEDADES
	public $timestamps = false;
	protected $table = 'netsti_connections_calendars';
	protected $primaryKey = 'id';
	protected $dates = [];
	protected $guarded = [];
	protected $jsonable = [];
	protected $fillable = [];
	protected $visible = [];

	// RELACIONES
	public $hasOne = [];
	public $hasMany = [
		'events' => ['NetSTI\Connections\Models\Event'],
	];
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
			["name" => $this->name],
			'netsti/connections/calendars', 
			':spiral_calendar_pad:', 
			'netsti.connections::lang.menu.calendars'
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
			["name" => $this->name],
			'netsti/connections/calendars/update/'.$this->id, 
			':spiral_calendar_pad:', 
			'netsti.connections::lang.menu.calendars'
		);
	}

	public function beforeDelete(){ }
	public function afterDelete(){ }

	public function beforeRestore(){ }
	public function afterRestore(){ }

	public function beforeFetch(){ }
	public function afterFetch(){ }
}