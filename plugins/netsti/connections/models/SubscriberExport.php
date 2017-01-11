<?php namespace NetSTI\Connections\Models;

// LIBRERIAS
use Backend\Models\ExportModel;
use NetSTI\Connections\Models\Subscriber as ObjectModel;

// EXPORT
class SubscriberExport extends ExportModel{
	public function exportData($columns, $sessionKey = null)
	{
		$records = ObjectModel::all();
		$records->each(function($record) use ($columns) {
			$record->addVisible($columns);
		});
		return $records->toArray();
	}
}