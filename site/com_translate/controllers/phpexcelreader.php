<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');
class translateControllerphpexcelreader extends JController
{
  
    function display()
    {
        parent::display();
    }
	
	
	function __constructor()
	{
		parent::__construct();
		$this->registerTask('readexcel' );
	}
	
	function readexcel()
	{
	  
	    $model = $this->getModel('phpexcelreader');
	    $file=JRequest::get('files');
	    $filename=$file['file']['name'];
		$ext=end(explode('.',$filename));
	
	    //$ext = pathinfo($filename, PATHINFO_EXTENSION);
		
	    require_once( JPATH_COMPONENT_ADMINISTRATOR.DS.'helpers'.DS.'excel_reader2.php' );
		
		$excel = new translatehelperphpexcelreader($file['file']['tmp_name']);
		$rows=$excel->rowcount();
		$cols=$excel->colcount();
		
		
		if($ext=='xls')
		{	
			if($cols !=3)
			{
				$msg="Invalid Excel Format";
			}
			else
			{
					if ($model->save())
					 {
						
						$msg = JText::_( 'inserted!' );
						
					 }
					 else 
					 {
						$msg = JText::_( 'Error in inserting');
					 }
			}
		}
		else
		{
			$msg=JText::_('is an invalid file type!');
		}
		
	$menu   =& JSite::getMenu();
  	$link='index.php?option=com_translate&view=phpexcelreader&layout=browse';
  	$item=$menu->getItems('link',$link);
  	$link=$link.'&Itemid='.$item[0]->id.
	'&controller=phpexcelreader';
 	$this->setRedirect($link, $msg);

		//$this->setRedirect('index.php?option=com_translate&controller=phpexcelreader&view=phpexcelreader&layout=browse',$msg);
	}
	
 
}


?>