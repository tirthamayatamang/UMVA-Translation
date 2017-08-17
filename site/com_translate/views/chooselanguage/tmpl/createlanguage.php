<?php
defined('_JEXEC') or die('Restricted access'); 
?>

<form name="adminForm" id='adminForm' method="post" action="index.php">
<div class="left_part">
		
			<div class="wrapper">
				<div class="ih-left">
					<div class="ih-right">
						<div class="ih-bg">
							<h2><?php echo JText::_( 'Create Language' ); ?></h2>
						</div>
					</div>
				</div>
				<div class="i-mid">
				<p><label> <?php echo JText::_( 'Code' ); ?></label>
<select name="lang_code" id="lang_code" onchange="submitbutton('insertlangcode')">
	<?php
	
	for($i=0,$n=count($this->codes);$i<$n;$i++)
 	 { 
  	$code=& $this->codes[$i];
	if(trim($_REQUEST['lang_code'])==trim($code->lang_code))
	{

	?>
	<option value="<?php echo $code->lang_code?>" selected="selected"><?php echo $code->lang_code;?></option>
	<?php }else{?><option value="<?php echo $code->lang_code;?>"><?php echo $code->lang_code; ?></option>
		  <?php
		  }
   
    }
    ?>
	</select>
	</p>
	<p><label><?php echo JText::_( 'Language' ); ?></label><input name="lang_name" type="text" value="<?php echo $this->lang_name;?>" class="inputbox"></p>
	
	<p><input name="btncreate" type="button" value="ADD" onClick="submitbutton('create_lang');" class="smallbutton"></p>
					
					
					<br class="clr" />
				</div>
			   <div class="ib-left">
			   		<div class="ib-right">
						<div class="ib-bg">
						</div>
					</div>
			   </div>
			</div>
</div>


  <input type="hidden" name="option" value="com_translate">
  <input type="hidden" name="controller" value="chooselanguage" />
  <input type="hidden" name="view" value="chooselanguage"/>
  <input type="hidden" name="task" value="">
  <input type="hidden" name="layout" value="createlanguage" />
  
  
</form>

