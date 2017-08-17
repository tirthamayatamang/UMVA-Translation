<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');

class translateControllerchooselanguage extends JController
{
	function display()
	{
		parent::display();
	}
	
	function __constructor()
	{
		parent::__construct();
		$this->registerTask('create_lang' );
		$this->registerTask('insertlangcode' );
	}
	
		function insertlangcode()
	{
		$data=JRequest::get('post');
		$lang_code=$data["lang_code"];
		$this->setRedirect( 'index.php?option=com_translate&controller=chooselanguage&view=chooselanguage&layout=createlanguage&lang_code='.$lang_code);
	}
	
	function create_lang()
	{
		$model=$this->getModel('chooselanguage');
		$data=JRequest::get('post');
		
	$lang_name=$data['lang_name'];
	$lang_code=$data['lang_code'];
	$db =& JFactory::getDBO(); 
	$codename="SELECT count(*) FROM `#__umva_tbllanguage` where lang_code='".$lang_code."' and lang_name='".$lang_name."'";
	
	$result=$db->setQuery($codename);
	 $ras=$db->loadResult();
	
	 if($ras>0)
	 {
	 $msg=JText::_('Already inserted.cannot insert again...');
		
	}
	else
	{
	if($model->insert())
		{
		
		
		$msg=JText::_('language inserted');
		
		}
		else
		{
		$msg=JText::_('unable to insert langauage');
		}
	
	}
	
	$menu   =& JSite::getMenu();
  	$link='index.php?option=com_translate&view=chooselanguage&layout=createlanguage';
  	$item=$menu->getItems('link',$link);
	
  	$link=$link.'&Itemid='.$item[0]->id.'&controller=chooselanguage';
 	$this->setRedirect($link, $msg);
		//$this->setRedirect('index.php?option=com_translate&controller=chooselanguage&view=chooselanguage&layout=createlanguage',$msg);
	}
	
	
}


?>