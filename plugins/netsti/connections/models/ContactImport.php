<?php namespace NetSTI\Connections\Models;

// LIBRERIAS
use Backend\Models\ImportModel;
use NetSTI\Connections\Models\Company;
use NetSTI\Connections\Models\Contact as ObjectModel;

// CLASE
class ContactImport extends ImportModel{

	// VALIDACIONES
	public $rules = [
		'name' => 'required|max:180|min:3',
		'email' => 'required|email|unique:netsti_connections_contacts'
	];

	public $belongsTo = [
		'company_all' => ['NetSTI\Connections\Models\Company']
	];

	// IMPORT METHOD
	public function importData($results, $sessionKey = null){
		foreach ($results as $row => $data) {

			try {
				if(array_key_exists('company', $data))
					$company = Company::where('name', 'like', $data['company'])->first();			

				if(array_key_exists('company_email', $data))
					$company_email = $data['company_email'];
				else
					$company_email = $data['email'];

				if(array_key_exists('company', $data))
					if(!count($company))
						$company = Company::create([ 'name'=> $data['company'], 'email' => $company_email ]);

				$record = new ObjectModel;
				$record->fill($data);
				if(array_key_exists('company', $data))
					$record->company = $company;
				if($this->company_import)
					$record->company = $this->company_all;
				$record->save();

				$this->logCreated();
			}
			catch (\Exception $ex) {
				$this->logError($row, $ex->getMessage());
			}

		}
	}
}