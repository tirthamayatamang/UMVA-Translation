<?php 
	defined('_JEXEC') or die('restricted access');
	class Tabledevbank extends JTable
	{
	var $id=null;
	var $message_id=null;
	var $translated_msg=null;
		function __construct(&$db)
		{
		parent::__construct('#__umva_tbllangdevbank','id',$db);
		}
	}
	?>