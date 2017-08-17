<?php
defined('_JEXEC') or die('Restricted access');
class Tablecreatesource extends JTable
{
  
    var $id = null;
    var $name = null;
	var $lang_code=null;
	
    function __construct( &$db )
	{
        parent::__construct('#__umva_tblsource', 'id', $db);
    }
}
?>