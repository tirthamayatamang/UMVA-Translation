<?php
defined('_JEXEC')or die('restricted access');
require_once(JPATH_COMPONENT_ADMINISTRATOR.DS.helpers.DS.'excel_reader2.php');

class translateModelmanagesource extends JModel
{
	function getsourcelanguage()
	{
	$query="SELECT * FROM `#__umva_tblsource`";
	return $this->_getList($query);
	}
	function getlangname()
	{
		
	$query="SELECT * FROM `#__umva_tblcodes` order by lang_name asc";
	return $this->_getList($query);
	
	} 
	
	function upload()
	{
	$posteddata=JRequest::get('post');
	$source=$posteddata['source'];
	$source=strtolower($source);
	$source=str_replace('-','',$source);
	$lang_code=$posteddata['lang_code'];
	$lang_code=strtolower(str_replace('-','',$lang_code));
	$srctblfile='dev'.$source;
	$srctbl='jos_umva_tbllangdev'.$source;
	$file=JRequest::get('files');
	$tmp=$file['upload']['tmp_name'];
	$data=new translatehelperphpexcelreader($tmp);
	$countrows=$data->rowcount();

	$sheet=$data->sheets[0];
	
	$row=&$this->getTable($srctblfile);

		for($i=1,$n=$countrows;$i<=$n;$i++)
		{
			$d['id']='';
			$d['message_id']=$sheet['cells'][$i][1];
			$d['translated_msg']=$sheet['cells'][$i][2];
		
		
			if(mb_detect_encoding($d['translated_msg'],"iso-8859-1,UTF-8")!="UTF-8")
			{
				$d['translated_msg']=iconv("iso-8859-1","UTF-8",$d['translated_msg']);
			}
			if($d['translated_msg']=="")
			{
				$d['translated_msg']='';
			}
		
			if(!$row->bind($d))
			{
			$this->setError($this->_db->getErrorMsg());
			return false;
			}
		
			if(!$row->check())
			{
			$this->setError($this->_db->getErrorMsg());
			return false;
			}
				
			if(!$row->store())
			{
			$this->setError($this->_db->getErrorMsg());
			return false;
			}
	}	
	    $db =& JFactory::getDBO();
		$tablelist=$db->getTableList();
	
		

	    $clientlanguage="SELECT lang_code FROM `#__umva_tbllanguage`";
		$db->setQuery($clientlanguage);
		$clientlanguage = $db->loadResultArray();
		
		
		for($i=0,$n=count($clientlanguage);$i<$n;$i++)
		{
		$status=1;
		$clienttbl='jos_umva_tbllang'.$clientlanguage[$i].$source;
		$clienttblfile=$clientlanguage[$i].$source;
		//$clienttbl='jos_umva_tbllangnebank';
			    for($j=0,$t=count($tablelist);$j<$t;$j++)
				{
					//print($clienttbl);print('----');print($tablelist[$j]);print('<br />');
					if($clienttbl==$tablelist[$j])
					{
					$status=0;
					}
					
				}
		       if($status==1)
			   {
			
					 $createclienttbl= "CREATE TABLE `".$clienttbl ."`
					 (
					 id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,message_id int,
					 translated_msg TEXT(500) NOT NULL,
					 PRIMARY KEY  (id)
					 ) ";
					 $db->setQuery($createclienttbl);
					 $db->query();
			
					 $insertclienttbl="INSERT INTO `".$clienttbl."`(message_id) select message_id from `".$srctbl."`";
					 $db->setQuery($insertclienttbl);
					 $db->query();
					 
					
			 
			 
					 $filename = JPATH_COMPONENT_ADMINISTRATOR.DS.'tables'.DS.$clienttblfile.'.php';
					 if(!file_exists($filename))
						 {
								$f=fopen("$filename","w");
								fwrite($f,'<?php 
								defined(\'_JEXEC\') or die(\'Restricted access\');
								class Table'.$clienttblfile. ' extends JTable
									 {
					  
								var $id = null;
								var $message_id = null;
								var $translated_msg=null;
									function __construct( &$db )
										 {
											parent::__construct(\''.$clienttbl.'\', \'id\', $db);
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