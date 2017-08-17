<?php
defined('_jEXEC')or('restricted access');
jimport('joomla.application.component.model');

class translateModelcreatesource extends JModel
{
	function display()
	{
	parent::display();
	}
	
	function getlangname()
	{
		
	$query="SELECT * FROM `#__umva_tblcodes` order by lang_name asc";
	return $this->_getList($query);
	
	}
	
	function createsource()
	{
	$row=&$this->getTable('createsource');
	$data=JRequest::get('post');
	$source=$data["name"];
	$source=strtolower(str_replace('-','',$source));
	$lang_code=$data["lang_code"];
	$lang_code=strtolower(str_replace('-','',$lang_code));

	
			 if (!$row->bind($data)) {
				$this->setError($this->_db->getErrorMsg());
				return false;
			}
		 
			
			if (!$row->check()) {
				$this->setError($this->_db->getErrorMsg());
				return false;
			}
		 
		
			if (!$row->store()) {
				$this->setError($this->_db->getErrorMsg());
				return false;
			}
	
	$db =& JFactory::getDBO();	 
	$querysource="CREATE TABLE `jos_umva_tbllangdev".$source."` (id int auto_increment not null,message_id int not null,translated_msg text(500) not null, primary key(id))";
	$db->setQuery($querysource);
	$db->query();
	
	$file=JPATH_COMPONENT_ADMINISTRATOR.DS.'tables'.DS.'dev'.$source.'.php';


	if(!file_exists($file))
	{
	$fp=fopen("$file","w");
	
	fwrite($fp,'<?php 
	defined(\'_JEXEC\') or die(\'restricted access\');
	class Tabledev'.$source.' extends JTable
	{
	var $id=null;
	var $message_id=null;
	var $translated_msg=null;
		function __construct(&$db)
		{
		parent::__construct(\'#__umva_tbllangdev'.$source.'\',\'id\',$db);
		}
	}
	?>');
	fclose($fp);
	}
	return true;
	}
}
?>
