<?php 
								defined('_JEXEC') or die('Restricted access');
								class Tablefrauxel extends JTable
									 {
					  
								var $id = null;
								var $message_id = null;
								var $translated_msg=null;
									function __construct( &$db )
										 {
											parent::__construct('jos_umva_tbllangfrauxel', 'id', $db);
										 }
									}
								
								?>