<?php

defined( '_JEXEC' ) or die( 'Restricted access' );
 
jimport( 'joomla.application.component.view');

 
class translateViewphpexcelreader extends JView
{
   function display($tpl = null)
    {
        $model=&$this->getModel();
		$language=$model->getlanguage();
		$source=$model->getsource();
		$this->assignRef('source',$source);
		$this->assignRef('language',$language);
		parent::display($tpl);
		
    }
}
?>