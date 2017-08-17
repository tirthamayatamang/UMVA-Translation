<?php 
	defined('_JEXEC') or die('restricted access');
	class Tabledevclient extends JTable
	{
	var $id=null;
	var $message_id=null;
	var $translated_msgs=null;
		function __construct(&$db)
		{
		parent::__construct('#__umva_tbllangdevclient','id',$db);
		}
	}
	?>