<?php 
			defined('_JEXEC') or die('Restricted access');
			class Tablerubank extends JTable
{
  
    var $id = null;
    var $message_id = null;
	var $translated_msg=null;
	function __construct( &$db ) {
        parent::__construct('#__umva_tbllangrubank', 'id', $db);
    }
}
			
			?>