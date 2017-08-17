<?php
// no direct access
 defined('_JEXEC') or die('Restricted access');
 jimport('joomla.html.toolbar');
 
 class translatehelpertoolbar extends JObject
 {        
        function getToolbar() {
 
 
             $bar = & JToolBar::getInstance('toolbar');
                
                return $bar;
 
        }
	
 
 }
?>