+<?php
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.model');

class translateModelchooselanguage extends JModel
{
	function selectcodes()
	{
	 $db =& JFactory::getDBO();
	 $codes="SELECT * FROM `#__umva_tblcodes` order by lang_code asc";

	 return $this->_getList($codes);
	}
	
	function getlangname()
	{
	$db =& JFactory::getDBO();
	$lang_code=JRequest::getVar('lang_code');
	$lang_code=trim($lang_code);
	$querylang_code="select lang_name from `#__umva_tblcodes` where lang_code='".$lang_code."'";
	$db->setQuery($querylang_code);
	return $db->loadResult();

	}
	
	function insert()
	{
	$row=& $this->getTable('chooselanguage');
	$data=JRequest::get('post');
	$lang_name=strtolower($data['lang_name']);
	$lang_code=strtolower($data['lang_code']);
	$lang_code= str_replace('-',"",$lang_code);
	
		if (!$row->bind($data))
		{
        $this->setError($this->_db->getErrorMsg());
        return false;
		}

    
    	if (!$row->check()) 
		{
        $this->setError($this->_db->getErrorMsg());
        return false;
    	}
 
    
    	if (!$row->store())
		 {
        $this->setError($this->_db->getErrorMsg());
        return false;
   		 }
		
		
		$db =& JFactory::getDBO(); 
		$sourcequery="SELECT name FROM `#__umva_tblsource`";
		$db->setQuery($sourcequery);
		$getsource = $db->loadResultArray();
		
		for($i=0,$n=count($getsource);$i<$n;$i++)
		{
				$query="SELECT count(*) FROM `#__umva_tbllangdev".$getsource[$i]."`";
				$db->setQuery($query);
				$count = $db->loadResult();
				
				if($count>0)
				{
					$tablename='#__umva_tbllang'.$lang_code.$getsource[$i];
					$query= "CREATE TABLE `".$tablename ."`
					 (
					 id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,message_id int,
					 translated_msg TEXT(500) NOT NULL,
					 PRIMARY KEY  (id)
					 ) ";
					 
					$db->setQuery($query);
					 $db->query();
					
					 $query1="INSERT INTO `".$tablename."`(message_id) select message_id from `#__umva_tbllangdev".str_replace("-","",$getsource[$i])."`";
					
					 $db->setQuery($query1);
					 $db->query();
					 
					
					 
					 
					 $filename = JPATH_COMPONENT_ADMINISTRATOR.DS.'tables'.DS.$lang_code.$getsource[$i].'.php';
					 	if(!file_exists($filename))
						 {
							$f=fopen("$filename","w");
							fwrite($f,'<?php 
							defined(\'_JEXEC\') or die(\'Restricted access\');
							class Table'.$lang_code.$getsource[$i]. ' extends JTable
				{
				  
					var $id = null;
					var $message_id = null;
					var $translated_msg=null;
					function __construct( &$db ) {
						parent::__construct(\''.$tablename.'\', \'id\', $db);
					}
				}
							
							?>');
							fclose($f);
						 }
				}	
		 }
	  return true;
	
 	}
   		 
	
}


?>