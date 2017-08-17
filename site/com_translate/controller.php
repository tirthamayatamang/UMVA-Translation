<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');
class translateController extends JController
{
  
    function display()
    {
        parent::display();
    }
	
	function __constructor()
	{
		parent::__construct();
	

		$this->registerTask('save' );
		$this->registerTask('submitlang');
		$this->registerTask('download');
	}
	
	function submitlang()
	{
		$data=JRequest::get('post');
		$source=$data["source"];
		$intermediate=$data["intermediate"];
		$destination=$data["destination"];
		$limit = JRequest::getVar('limit', 0, '', 'int');
		$menu   =& JSite::getMenu();
		$link='index.php?option=com_translate&view=translate&layout=form';
		
		$item=$menu->getItems('link',$link);
	
		$link=$link.'&Itemid='.$item[1]->id.'&controller=translate&langSource='.$source.'&langIntermediate='.$intermediate.'&langDestination='.$destination.'&limit='.$limit; 
		$this->setRedirect($link);
		
	}
	
	function download()
	{
		
	$model=$this->getModel('translate');
	
		if($model->downloadxml())
		{
		echo $_xml;
		}
	
	}

	function save()
	{	
		$data=JRequest::get('post');
		$source=$data["source"];
		$intermediate=$data["intermediate"];
		$destination=$data["destination"];
		$limit = JRequest::getVar('limit', 0, '', 'int');

	 	$model = $this->getModel('translate');
 
			if ($model->save())
			 {
				$msg = JText::_( 'translated message Saved!' );
				
				
			 }
			 else 
			 {
				$msg = JText::_( 'Error Saving translated message' );
			 }

	$menu   =& JSite::getMenu();
  	$link='index.php?option=com_translate&view=translate&layout=form';
  	$item=$menu->getItems('link',$link);
  	$link=$link.'&Itemid='.$item[1]->id.
	'&controller=translate&langSource='.$source.'&langIntermediate='.$intermediate.'&langDestination='.$destination.'&limit='.$limit; 
 	$this->setRedirect($link, $msg);
		
	}
	
 
}
?>
