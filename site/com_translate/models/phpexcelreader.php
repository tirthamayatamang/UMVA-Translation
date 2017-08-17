<?php 
defined( '_JEXEC' ) or die( 'Restricted access' );
 
jimport( 'joomla.application.component.model' );

require_once( JPATH_COMPONENT_ADMINISTRATOR.DS.'helpers'.DS.'excel_reader2.php' );



class translateModelphpexcelreader extends JModel
{
  
    function get()
    {
        return 'translation part is undergoing';
    }
	
	function getlanguage()
	{
	$query="select * from `#__umva_tbllanguage`";
	return $this->_getList($query);
	}
	
	function getsource()
	{
	$query="SELECT * from `#__umva_tblsource`";
	return $this->_getList($query);
	}
	
	function save()
	{
	  $data=JRequest::get('post');
	  $source=$data['source'];
	  $language=$data['lang_code'];	
	  $language=strtolower($language);
	  $language=str_replace('-','',$language);
	  $source=strtolower($source);
      $clientfile=$language.$source;
	  $file=JRequest::get('files');
	  $tmpname=$file["file"]["tmp_name"];
	  
	  $tblname="__umva_tbllangdev".$source;
	  $row =& $this->getTable($clientfile);
		
		$data = new translatehelperphpexcelreader("$tmpname");
		$sheet=$data->sheets[0];
		
			for($i=1,$n=$sheet['numRows'];$i<=$n;$i++)
			{	
				$db =& JFactory::getDBO();
				
				$sqlmessage="select message_id from ".$tblname." where translated_msg='".$sheet['cells'][$i][2]."' and id=$i";
			
				$db->setQuery( $sqlmessage );
				$msg = $db->loadResult();
			
				$d['id']=$i;
				$d['message_id']=$msg;
				$d['translated_msg']=$sheet['cells'][$i][3];
				
				if( mb_detect_encoding($d['translated_msg'],"UTF-8, iso-8859-1")!="UTF-8" )
					{
	
					$d['translated_msg']=iconv("iso-8859-1","utf-8",$d['translated_msg']); 
					}
				
				
				if($d['translated_msg']=="")
				{
				$d['translated_msg']='';
				}
				
				
				
				if (!$row->bind($d))
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
				 
			}
			
			$sqlupdate="UPDATE `#__umva_tbllanguage` SET is_translated=1 where lang_code='".$language
	."'";
		
			$db->setQuery( $sqlupdate );
			$db->query();
			return true;
	}
	
}
?>
