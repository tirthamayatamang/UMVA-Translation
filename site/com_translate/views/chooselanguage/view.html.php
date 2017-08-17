<?php 
defined('_JEXEC')or die('Restricted access');
jimport('joomla.application.component.view');

class translateViewchooselanguage extends JView
{
	function display($tpl=null)
	{
	$model = &$this->getModel();
	$codes=$model->selectcodes();
	$lang_name=$model->getlangname();

	$this->assignRef( 'codes', $codes );
	$this->assignRef( 'lang_name', $lang_name );
	parent::display($tpl);
	}
}

?>