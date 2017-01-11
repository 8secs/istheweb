<?php namespace NetSTI\Connections\Controllers;

// LIBRERIAS
use Lang;
use Flash;
use BackendMenu;
use Backend\Classes\Controller;
use NetSTI\Connections\Models\Inbox;
use NetSTI\Connections\Models\Contact;
use NetSTI\Connections\Models\Company;

// CONTROLADOR
class Inboxes extends Controller{

	// PROPRIEDADES
	public $implement = [
		'Backend\Behaviors\ListController', 
		'Backend\Behaviors\FormController',
		'Backend\Behaviors\ImportExportController',
		'NetSTI\Connections\Behaviors\DeleteList',
		'NetSTI\Connections\Behaviors\ModalContext'
	];
	
	public $listConfig = 'config_list.yaml';
	public $formConfig = 'config_form.yaml';
	public $importExportConfig = 'config_migration.yaml';

	public $requiredPermissions = [
		'netsti.connections.inboxes' 
	];

	public function __construct()
	{
		parent::__construct();
		BackendMenu::setContext('NetSTI.Connections', 'connections', 'inboxes');
	}

	// METODOS
	public function listInjectRowClass($record, $definition = null){
		if ($record->status != 0)
			return 'safe disabled';
	}

	public function index_onArchive(){
		if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {

			foreach ($checkedIds as $itemId) {
				if (!$item = Inbox::find($itemId))
					continue;

				$item->status = 1;
				$item->save();
			}

			Flash::success(Lang::get('netsti.connections::lang.archive_msj'));
		} else {
			Flash::error(Lang::get('netsti.connections::lang.archive_error'));
		}

		return $this->listRefresh();
	}

	public function index_onConvertContact(){
		if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {

			foreach ($checkedIds as $itemId) {
				if (!$item = Inbox::find($itemId))
					continue;

				$contact = new Contact();
				$contact->name = $item->name;
				$contact->email = $item->email;
				$contact->phone = $item->phone;

				if($item->company){
					$company = new Company();
					$company->name = $item->company;
					$company->save();

					$contact->company_id = $company->id;
				}

				$contact->save();

				$item->status = 1;
				$item->save();
			}

			Flash::success(Lang::get('netsti.connections::lang.inbox.convert_msj'));
		} else {
			Flash::error(Lang::get('netsti.connections::lang.inbox.convert_error'));
		}

		return $this->listRefresh();
	}

	public function index_onConvertCompany(){
		if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {

			foreach ($checkedIds as $itemId) {
				if (!$item = Inbox::find($itemId))
					continue;

				if($item->company){
					$company = new Company();
					$company->name = $item->company;
					$company->email = $item->email;
					$company->phone = $item->phone;
					$company->save();
				}else{
					Flash::error(Lang::get('netsti.connections::lang.inbox.convert_error'));
				}

				$item->status = 1;
				$item->save();
			}

			Flash::success(Lang::get('netsti.connections::lang.inbox.convert_msj'));
		} else {
			Flash::error(Lang::get('netsti.connections::lang.inbox.convert_error'));
		}

		return $this->listRefresh();
	}
}