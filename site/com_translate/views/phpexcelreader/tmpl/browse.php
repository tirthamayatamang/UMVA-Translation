<?php defined('_JEXEC') or die('Restricted access');
?>

<form name="adminForm" action="" method="post" enctype="multipart/form-data" id="frm">
<div class="left_part">
		
			<div class="wrapper">
				<div class="ih-left">
					<div class="ih-right">
						<div class="ih-bg">
							<h2><?php echo JText::_( 'Upload Excel' ); ?></h2>
						</div>
					</div>
				</div>
				<div class="i-mid">
							<p><label> <?php echo JText::_( 'Choose Source' );
 ?></label>
<select name="source" id="source">
	<?php
	for($i=0,$n=count($this->source);$i<$n;$i++)
 	 { 
	
  	$source=& $this->source[$i];
	
	if(trim($_REQUEST['source'])==trim($source->name))
	{

	?>
	<option value="<?php echo $source->name?>" selected="selected"><?php echo $source->name;?></option>
	<?php }else{?><option value="<?php echo $source->name;?>"><?php echo $source->name; ?></option>
		  <?php
		  }
   
    }
    ?>
	</select>
	</p>
				<p><label> <?php echo JText::_( 'Choose target' ); 
	 ?></label>
<select name="lang_code" id="lang_code">
	<?php
	
	for($i=0,$n=count($this->language);$i<$n;$i++)
 	 { 
	
  	$language=& $this->language[$i];
	if(trim($_REQUEST['language'])==trim($code->lang_code))
	{

	?>
	<option value="<?php echo $language->lang_code?>" selected="selected"><?php echo $language->lang_name;?></option>
	<?php }else{?><option value="<?php echo $language->lang_code;?>"><?php echo $language->lang_name; ?></option>
		  <?php
		  }
   
    }
    ?>
	</select>
	</p>
				<input name="file" type="file" />
<input type="submit" name="submit" value="SUBMIT" onclick="javascript:submitbutton('readexcel')" class="smallbutton"/>
					
					
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
	
<input type="hidden" name="task" value="" />
<input type="hidden" name="option" value="com_translate" />
<input type="hidden" name="controller" value="phpexcelreader" />

	</form>