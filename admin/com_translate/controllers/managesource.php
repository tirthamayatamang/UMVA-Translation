<?php
defined('_JEXEC')or die('restricted access');
jimport('joomla.application.componenet.controller');

class translateControllermanagesource extends translateController
{
	function display()
	{
	parent::display();
	}
	
	function __constructor()
	{
	parent::__constructor();
	$this->registerTask('upload_source');
	}
	
	function upload_source()
	{
	$data=JRequest::get('post');
	$model=$this->getModel('managesource');
	if($model->upload())
	{
	$msg="source data uploaded";
	}
	else
	{
	$msg="unable to upload source data";
	}
	$this->setRedirect('index.php?option=com_translate&view=managesource&layout=managesource',$msg);
	}
}