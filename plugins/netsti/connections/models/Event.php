<?php namespace NetSTI\Connections\Models;

// LIBRERIAS
use Str;
use Html;
use Model;
use ValidationException;
use NetSTI\Connections\Classes\Slack;

// CLASE
class Event extends Model{

	// VALIDACIONES
	use \October\Rain\Database\Traits\Validation;
	public $rules = [
		'name' => 'required|max:180|min:3',
		'calendar' => 'required',
		'start_date' => 'required',
		'end_date' => 'required'
	];

	public $attributeNames = [
		'name' => 'netsti.connections::lang.fields.name',
		'calendar' => 'netsti.connections::lang.fields.calendar',
		'start_date' => 'netsti.connections::lang.fields.start_date',
		'end_date' => 'netsti.connections::lang.fields.end_date'
	];

	// TRASLATABLE
	public $implement = ['RainLab.Translate.Behaviors.TranslatableModel'];
	public $translatable = ['name'];

	// PROPIEDADES
	public $timestamps = false;
	protected $table = 'netsti_connections_events';
	protected $primaryKey = 'id';
	protected $dates = ['start_date','end_date'];
	protected $appends = ['summary'];
	protected $guarded = [];
	protected $jsonable = [];
	protected $fillable = [];
	protected $visible = [];

	// RELACIONES
	public $hasOne = [];
	public $hasMany = [];
	public $belongsTo = [
		'calendar' => ['NetSTI\Connections\Models\Calendar']
	];
	public $belongsToMany = [];

	// FUCIONES
	public $morphTo = [];
	public $morphOne = [];
	public $morphMany = [];

	// ADJUNTOS Y ARCHIVOS
	public $attachOne = [
		'featured' => ['System\Models\File'],
	];
	public $attachMany = [
		'pictures' => ['System\Models\File'],
	];

	// EVENTOS
	public function beforeCreate(){ }
	public function afterCreate(){
		Slack::push(
			'netsti.connections::lang.new_entry',
			[
				"name" => $this->name, 
				"calendar" => $this->calendar->name,
				"start_date" => $this->start_date,
				"end_date" => $this->end_date
			],
			'netsti/connections/events',
			':clock2:', 
			'netsti.connections::lang.menu.events'
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
			[
				"name" => $this->name, 
				"calendar" => $this->calendar->name,
				"start_date" => $this->start_date,
				"end_date" => $this->end_date
			],
			'netsti/connections/events/update/'.$this->id,
			':clock2:', 
			'netsti.connections::lang.menu.events'
		);
	}

	public function beforeDelete(){ }
	public function afterDelete(){ }

	public function beforeRestore(){ }
	public function afterRestore(){ }

	public function beforeFetch(){ }
	public function afterFetch(){ }

	public function getSummaryAttribute(){
		$more = '<!-- more -->';
		if (strpos($this->description, $more) !== false) {
			$parts = explode($more, $this->description);
			return array_get($parts, 0);
		}

		return Str::limit(Html::strip($this->description), 200);
	}
}