<?php
defined('_JEXEC') or die('restricted access');
require_once(JPATH_COMPONENT_ADMINISTRATOR.DS.'controller.php');
$controller=JRequest::getVar('controller','');

	$path = JPATH_COMPONENT_ADMINISTRATOR.DS.'controllers'.DS.$controller.'.php';

	
    if (file_exists($path)) 
	{
	 require_once $path;
    } 
	else
	{
        $controller = '';
    }
	$classname='translateController'.$controller;
	$controller=new $classname();
	$controller->execute(JREQUEST::getWord('task'));
	$controller->redirect();
	require_once(JPATH_COMPONENT_ADMINISTRATOR.DS.helpers.DS.'excel_reader2.php');


?>