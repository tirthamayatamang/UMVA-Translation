<?php
defined('_JEXEC') or die('Restricted access');
class Tablechooselanguage extends JTable
{
  
    var $lang_id = null;
    var $lang_code = null;
	var $lang_name=null;
	
    function __construct( &$db ) {
        parent::__construct('#__umva_tbllanguage', 'lang_id', $db);
    }
}
?>