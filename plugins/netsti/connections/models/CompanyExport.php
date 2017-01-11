<?php namespace NetSTI\Connections\Models;

// LIBRERIAS
use Backend\Models\ExportModel;
use NetSTI\Connections\Models\Company as ObjectModel;

// CLASE
class CompanyExport extends ExportModel{

	// EXPORT METHOD
	public function exportData($columns, $sessionKey = null)
	{
		$records = ObjectModel::all();
		$records->each(function($record) use ($columns) {
			$record->addVisible($columns);
		});
		return $records->toArray();
	}
}