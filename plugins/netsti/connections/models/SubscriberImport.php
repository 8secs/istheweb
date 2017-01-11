<?php namespace NetSTI\Connections\Models;

// LIBRERIAS
use Backend\Models\ImportModel;
use NetSTI\Connections\Models\Subscriber as ObjectModel;

// IMPORT
class SubscriberImport extends ImportModel{

	// VALIDACIONES
	public $rules = [
		'name' => 'required|max:180|min:3',
		'email' => 'required|email|unique:netsti_connections_contacts'
	];

	// IMPORT METHOD
	public function importData($results, $sessionKey = null){
		foreach ($results as $row => $data) {

			try {
				$record = new ObjectModel;
				$record->fill($data);
				$record->save();

				$this->logCreated();
			}
			catch (\Exception $ex) {
				$this->logError($row, $ex->getMessage());
			}

		}
	}
}