<?php
defined('_jEXEC')or('restricted access');
?>
<form name="adminForm" id='adminForm' method="post" action="index.php">
<div class="left_part">
		
			<div class="wrapper">
				<div class="ih-left">
					<div class="ih-right">
						<div class="ih-bg">
							<h2><?php echo JText::_( 'Create Source' ); ?></h2>
						</div>
					</div>
				</div>
				<div class="i-mid">
				<p><label><?php echo JText::_( 'Source Name' ); ?></label><input name="name" type="text" class="inputbox"></p>
				<p><label> <?php echo JText::_( 'Language' ); ?></label>
<select name="lang_code" id="lang_code">
	<?php
	
	for($i=0,$n=count($this->language);$i<$n;$i++)
 	 { 
  	$getlang=& $this->language[$i];
	if(trim($_REQUEST['lang_code'])==trim($getlang->lang_code))
	{

	?>
	<option value="<?php echo $getlang->lang_code?>" selected="selected"><?php echo $getlang->lang_name;?></option>
	<?php }else{?><option value="<?php echo $getlang->lang_code;?>"><?php echo $getlang->lang_name; ?></option>
		  <?php
		  }
   
    }
    ?>
	</select>
	</p>
	
	
	<p><input name="btncreate" type="button" value="ADD" onclick="submitbutton('createsource');" class="smallbutton"></p>
					
					
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
  <input type="hidden" name="controller" value="createsource" />
  <input type="hidden" name="view" value="createsource"/>
  <input type="hidden" name="task" value="">
  <input type="hidden" name="layout" value="createsource" />
</form>