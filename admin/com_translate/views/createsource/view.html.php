<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view');

class translateViewcreatesource extends JView
{
   function display($tpl = null)
    {
   $model=& $this->getModel();
   $language= $model->getlangname();
   $this->assignRef('language',$language);
   parent::display($tpl);
    }
}
?>
