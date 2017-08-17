<?php
defined('_JEXEC')or die('restricted access');
jimport('joomla.application.component.view');

class translateViewmanagesource extends JView
{

	function display($tlp=null)
	{
	$model=$this->getModel('managesource');
	$source=$model->getsourcelanguage();
	$lang_name=$model->getlangname();
	$this->assignRef('source',$source);
	$this->assignRef('lang_name',$lang_name);
	parent::display($tlp);
	}

} 
 
?>