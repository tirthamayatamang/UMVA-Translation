<?php

defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view');

 
class translateViewtranslate extends JView
{
   function display($tpl = null)
    {	
        $model = &$this->getModel();
		$source=$model->getSourceLanguage();
		$translation=$model->getTranslation();
		$pagination =$model->getPagination();
        $destination=$model->getDestinationLanguage();
		$intermediate=$model->getIntermediateLanguage();
		
		$this->assignRef('intermediate',$intermediate);
        $this->assignRef( 'translation', $translation );
		$this->assignRef( 'source', $source );
 		$this->assignRef( 'destination', $destination );
		$this->assignRef( 'pagination', $pagination );
		
        parent::display($tpl);
    }
}
?>
