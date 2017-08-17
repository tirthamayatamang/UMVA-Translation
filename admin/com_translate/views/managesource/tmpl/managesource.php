<?php
defined('_JEXEC')or die('restricted access');

?>

<form action="index.php" method="post" name="adminForm" id="adminForm" enctype="multipart/form-data">
<?php echo JText::_('Select Source');?>
<select name="source" id="source">

<?php for($i=0,$n=count($this->source);$i<$n;$i++)
{
$sourcelanguage=&$this->source[$i];

if(trim($_REQUEST['source'])==trim($sourcelanguage->name))
{
?>
<option value="<?php echo $sourcelanguage->name?>" selected="selected"><?php echo $sourcelanguage->name?></option>
<?php 
}
else
{
?>
<option value="<?php echo $sourcelanguage->name?>"><?php echo $sourcelanguage->name?></option>
<?php
}
}
?>

</select>
<?php echo JText::_('Select Language');?>
<select name="lang_code" id="lang_code">

<?php for($i=0,$n=count($this->lang_name);$i<$n;$i++)
{
$lang=&$this->lang_name[$i];

if(trim($_REQUEST['lang_code'])==trim($lang->lang_code))
{
?>
<option value="<?php echo $lang->lang_code?>" selected="selected"><?php echo $lang->lang_name?></option>
<?php 
}
else
{
?>
<option value="<?php echo $lang->lang_code?>"><?php echo $lang->lang_name?></option>
<?php
}
}
?>

</select>
<?php echo JText::_('Upload Source');?>
<input name="upload" type="file"/>
<input name="btnupload" type="button" value="SUBMIT" onclick="submitbutton('upload_source')"/>
<input type="hidden" name="option" value="com_translate" />
<input type="hidden" name="controller" value="managesource" />
<input type="hidden" name="view" value="managesource" />
<input type="hidden" name="layout" value="managesource" />
<input type="hidden" name="task" value="" />
</form>