<?php
/**
 * boardAdminModel class
 * Board the module's admin model class
 *
 * @author NHN (developers@xpressengine.com)
 * @package /modules/board
 * @version 0.1
 */
class boardAdminModel extends board
{
	/**
	 * Initialization
	 * @return void
	 */
	function init()
	{
	}

	/**
	 * Get the board module admin simple setting page
	 * @return void
	 */
	public function getBoardAdminSimpleSetup($moduleSrl, $setupUrl)
	{
		if(!$moduleSrl)
		{
			return;
		}

		// default module info setting
		$oModuleModel = &getModel('module');
		$moduleInfo = $oModuleModel->getModuleInfoByModuleSrl($moduleSrl);
		if($moduleInfo)
		{
			Context::set('module_info', $moduleInfo);
		}

		// get document status list
		$oDocumentModel = &getModel('document');
		$documentStatusList = $oDocumentModel->getStatusNameList();
		Context::set('document_status_list', $documentStatusList);

		// set order target list
		foreach($this->order_target AS $key)
		{
			$order_target[$key] = Context::getLang($key);
		}
		$order_target['list_order'] = Context::getLang('document_srl');
		$order_target['update_order'] = Context::getLang('last_update');
		Context::set('order_target', $order_target);

		// for advanced language & url
		$oAdmin = &getClass('admin');
		Context::set('setupUrl', $setupUrl);

		$oTemplate = &TemplateHandler::getInstance();
		$html = $oTemplate->compile($this->module_path.'tpl/', 'board_setup_basic');

		return $html;
	}

}
/* End of file board.admin.model.php */
/* Location: ./modules/board/board.admin.model.php */
