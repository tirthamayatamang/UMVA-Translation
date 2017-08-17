<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
require_once( JPATH_COMPONENT.DS.'controller.php' );


if($controller = JRequest::getWord('controller')) {

    $path = JPATH_COMPONENT.DS.'controllers'.DS.$controller.'.php';
	
    if (file_exists($path)) {
	
        require_once $path;
    } else {
        $controller = '';
    }
}


// Create the controller
$classname    = 'translateController'.$controller;

$controller   = new $classname( );
 
// Perform the Request task
$controller->execute( JRequest::getWord( 'task' ) );
 
// Redirect if set by the controller
$controller->redirect();

jimport('joomla.application.component.helper');

?>