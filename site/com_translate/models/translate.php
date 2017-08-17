<?php 
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.model' );
jimport( 'joomla.document.xml.xml' );

class translateModeltranslate extends JModel
{	var $_data;
	var $_total = null;
    var $_pagination = null;
	var $_tblSource;
	
  
	 function __construct()
 	 {
        parent::__construct();
 		global $mainframe, $option;
		$limit = $mainframe->getUserStateFromRequest('global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int');
        $limitstart = JRequest::getVar('limitstart', 0, '', 'int');
 		$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0);
 
        $this->setState('limit', $limit);
        $this->setState('limitstart', $limitstart);
  	}

    function get()
    {
        return 'translation part is undergoing';
    }
	

	function _buildQuery()
	{
	$query = 'SELECT * FROM `jos_umva_tbllanguage`';
	return $query;
	}
	
	function getDestinationLanguage()
    {
        // Lets load the data if it doesn't already exist
			if (empty( $this->_data ))
			{
				$query = $this->_buildQuery();
				$this->_data = $this->_getList( $query );
			}
	 
			return $this->_data;
    }
	
	function getSourceLanguage()
	{
	$query = 'SELECT * FROM `jos_umva_tblsource`';
	return $this->_getList($query);
	}
	
	function getIntermediateLanguage()
	{
	$query = 'SELECT * FROM `jos_umva_tbllanguage` where is_translated=1';
	return $this->_getList($query);
	}
	
	function getTranslation()
	{
	$source=strtolower(JRequest::getVar('langSource'));
	$this->tblSource='#__umva_tbllangdev'.$source;
	$this->tblSource=str_replace('-',"",$this->tblSource);
	$tblInt=strtolower(JRequest::getVar('langIntermediate'));
	$tblIntermediate='#__umva_tbllang'.$tblInt;
	$tblIntermediate=str_replace('-',"",$tblIntermediate);
	$tblIntermediate=$tblIntermediate.$source;
	
	$tblDestination=strtolower(JRequest::getVar('langDestination'));
	$tblDestination='#__umva_tbllang'.$tblDestination;
    $tblDestination=str_replace('-',"",$tblDestination);
	$tblDestination=$tblDestination.$source;
	
	
	
	if($tblInt!="")
	{
	
	$query='SELECT s.message_id as id,d.message_id as message_id,s.translated_msg as sourcemsg,i.translated_msg as intermediatemsg,d.translated_msg as destinationmsg FROM `'.$this->tblSource.'` as s LEFT JOIN `'.$tblIntermediate.'` as i ON s.message_id=i.message_id LEFT JOIN `'.$tblDestination.'` as d ON i.message_id=d.message_id';
 return $this->_getList($query,$this->getState('limitstart'), $this->getState('limit'));
	}
	else
	{
	$query='SELECT s.message_id as id,d.message_id as message_id,s.translated_msg as sourcemsg,d.translated_msg as destinationmsg from `'.$this->tblSource.'` as s LEFT JOIN `'.$tblDestination.'` as d ON s.message_id=d.message_id';
	return $this->_getList($query,$this->getState('limitstart'), $this->getState('limit'));
	
	}
	
	}
	
	
	function getTotal()
  {
     $tbl=$this->tblSource;
	 if(empty($tbl))
	 {
	if (empty($this->_total)) {
   			$query="select * from `".$tbl ."`";
			$this->_total = $this->_getListCount($query);    
        }
        return $this->_total;
		}
		
  }
  
  function getPagination()
  {
        
        if (empty($this->_pagination)) {
            jimport('joomla.html.pagination');
            $this->_pagination = new JPagination($this->getTotal(), $this->getState('limitstart'), $this->getState('limit') );
        }
        return $this->_pagination;
  }


	function downloadxml()
	{
	  $data = JRequest::get( 'post' );
	 
	  $tblDestination=$data["destination"];
	  $tblInt=$data["intermediate"];
	  $source=$data["source"];
	
	 
	  $tblSource='#__umva_tbllangdev'.$source;
	  $tblSource=str_replace('-',"",$tblSource);
	 
	  
	  $tblIntermediate='#__umva_tbllang'.$tblInt;
	  $tblIntermediate=str_replace('-',"",$tblIntermediate);
	  $tblIntermediate=$tblIntermediate.$source;
	  
	  $tblDestination='#__umva_tbllang'.$tblDestination;
      $tblDestination=str_replace('-',"",$tblDestination);
	  $tblDestination=$tblDestination.$source;
	 
		$db =& JFactory::getDBO();
			if($tblInt!="")
				{
			  $query='SELECT s.message_id as id,d.message_id as message_id,s.translated_msg as sourcemsg,i.translated_msg as intermediatemsg,d.translated_msg as destinationmsg FROM `'.$tblSource.'` as s LEFT JOIN `'.$tblIntermediate.'` as i ON s.message_id=i.message_id LEFT JOIN `'.$tblDestination.'` as d ON i.message_id=d.message_id';
				 }
			  else
			 	 {
		 $query='SELECT s.message_id as id,d.message_id as message_id,s.translated_msg as sourcemsg,d.translated_msg as destinationmsg from `'.$tblSource.'` as s LEFT JOIN `'.$tblDestination.'` as d ON s.message_id=d.message_id';
			 
			 	 }
	
	
	 $db->setQuery($query);
     $rows = $db->loadAssocList();
	
	$root=$_SERVER['DOCUMENT_ROOT'];

	header("Content-type: application/octet-stream");
    header("Content-Disposition: attachment; filename=\"messages.".$data["destination"].".xml\"");
	header("Content-type: text/xml");
	$_xml ="<?xml version=\"1.0\"?>\r\n";
	$_xml .="<xliff version=\"1.0\">\r\n";
 	$_xml .="<file datatype=\"plaintext\" original=\"messages\" date=\"" . date("d/m/y : H:i:s", time())."\" product-name=\"messages\" source-language=\"EN\" target-language=\"".$data['destination']."\">\r\n";
	$_xml .="<body>\r\n";
	 for($i=0,$n=count($rows);$i<$n;$i++)
		 {
			$row=$rows[$i];
			if($row['sourcemsg']=='<<')
			{
			$row['sourcemsg']='&lt;&lt;';
			$row['destinationmsg']='&lt;&lt;';
			}
			if($row['sourcemsg']=='<')
			{
			$row['sourcemsg']='&lt;';
			$row['destinationmsg']='&lt;';
			}
			if($row['sourcemsg']=='>>')
			{
			$row['sourcemsg']='&gt;&gt;';
			$row['destinationmsg']='&gt;&gt;';
			}
			if($row['sourcemsg']=='>')
			{
			$row['sourcemsg']='&gt;';
			$row['destinationmsg']='&gt;';
			}
			if($row['sourcemsg']=='&nbsp;')
			{
			$row['sourcemsg']='&amp;nbsp;';
			$row['destinationmsg']='&amp;nbsp;';
			}
		
	
		
		  $_xml .="\t<trans-unit id=\"".$row['message_id']."\">\r\n";
		  $_xml .="\t\t<source>".$row['sourcemsg']."</source>\r\n";
		  $_xml .="\t\t<target>".$row['destinationmsg']."</target>\r\n";
		  $_xml .="\t</trans-unit>\r\n";
		 }
	  $_xml .="</body>\r\n";
	  $_xml .="</file>\r\n";
	  $_xml .="</xliff>";
	
		echo $_xml;
		die();
	}
	
	
	function save()
	{

      $data = JRequest::get( 'post' );
	  $tblSrc=$data["source"];
	  $tblDestination=$data["destination"];
	  $tblDestination=str_replace('-',"",$tblDestination);
	  $db =& JFactory::getDBO();
	  
	  $tbl=$tblDestination.$tblSrc;
	  $row =& $this->getTable($tbl);
     
   		for($i=0,$n=count($data['ids']);$i<$n;$i++)
		{
		$dat['translated_msg']=trim($data['translated_msgs'][$i]);
		$dat['message_id']=$data['message_ids'][$i];
		$dat['id']=$i+1;
		
		if (!$row->bind($dat))
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
		
         $query= "update #__umva_tbllanguage SET is_translated=1 where lang_code='".$tblDestination."'";
		 $db->setQuery($query);
		 $db->query();
		return true;

	}

}
?>
