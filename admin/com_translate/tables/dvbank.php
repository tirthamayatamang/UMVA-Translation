<?php 
								defined('_JEXEC') or die('Restricted access');
								class Tabledvbank extends JTable
									 {
					  
								var $id = null;
								var $message_id = null;
								var $translated_msg=null;
									function __construct( &$db )
										 {
											parent::__construct('jos_umva_tbllangdvbank', 'id', $db);
										 }
									}
								
								?>