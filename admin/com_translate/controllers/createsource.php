<?php
defined('_JEXEC')or die('restricted access');
jimport('joomla.application.componenet.controller');

class translateControllercreatesource extends translateController
{
	function display()
	{
	parent::display();
	}
	
	function __constructor()
	{
	parent::__constructor();
	$this->registerTask('createsource');
	}
	
	function createsource()
	{
	$data=JRequest::get('post');
	$model=$this->getModel('createsource');
	if($model->createsource())
	{
	$msg="new source created";
	}
	else
	{
	$msg="unable to create source";
	}
	$this->setRedirect('index.php?option=com_translate&view=createsource&layout=createsource',$msg);
	}
}