<script src="http://www.google.com/jsapi?key=AIzaSyA5m1Nc8ws2BbmPRwKu5gFradvD_hgq6G0" type="text/javascript"></script>
    <script type="text/javascript">
   
    google.load("language", "1");
	
	function loadlang(msg,targetbox)
	{
		var targetlanguage=document.getElementById('destination').value;
	var sourcelanguage=document.getElementById('source').value;
	sourcelanguage=sourcelanguage.substring(0,2);
	var text = msg;
   google.language.translate(text,sourcelanguage, targetlanguage, function(result) {
        var translated = document.getElementById(targetbox);
		
        if (result.translation) {
          translated.innerHTML = result.translation;
        }
      });
	}
	  
   
    
    </script>
<?php
//$doc=&JFactory::getDocument();
//$doc->addScript('includes/js/joomla.javascript.js');
defined('_JEXEC') or die('Restricted access');
 ?>
<form name="adminForm" method="post" action="index.php">
<table cellpadding="" cellspacing="0">
	<thead>
		<tr>
			<th><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->source ); ?>);" /></th>
			<th align="left"><?php echo JText::_('S.NO');?></th>
			<th align="left"><?php echo JText::_('Source'); ?></th>
			<th align="left"><?php echo JText::_('Indermediate'); ?></th>
			<th align="left"><?php echo JText::_('Target'); ?></th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td></td>
			<td></td>
			<td>
				<select name="source" class="select" id="source">
				<option value="0">CHOOSE</option>
				<?php
				foreach ($this->source as &$row)
					{
						if(trim($_REQUEST['langSource'])==trim($row->name))
						{
							?>
							  <option value="<?php echo $row->name;?>" selected="selected"><?php echo $row->name; ?></option>
							  <?php
							  }
							  else
							  {
							  ?>
							  <option value="<?php echo $row->name;?>"><?php echo $row->name; ?></option>
							  <?php
							  }
				   
					}
					?>
	  			</select>     
			</td>
			<td>
			        <select name="intermediate" class="select">
					<option value="">CHOOSE</option>
		
		
          <?php
	
    foreach ($this->intermediate as &$row)
    {
	if(trim($_REQUEST['langIntermediate'])==trim($row->lang_code))
	{
        ?>
          <option value="<?php echo $row->lang_code;?>" selected="selected"><?php echo $row->lang_name; ?></option>
          <?php
		  }else{?><option value="<?php echo $row->lang_code;?>"><?php echo $row->lang_name; ?></option>
		  <?php
		  }
   
    }
    ?>
        </select></td>
		
    <td>
        <select name="destination" class="select" id="destination">
		<option value="0">CHOOSE</option>
			
          <?php

    foreach ($this->destination as &$row)
    {if(trim($_REQUEST['langDestination'])==trim($row->lang_code))
	{
        ?>
          <option value="<?php echo $row->lang_code;?>" selected="selected"><?php echo $row->lang_name; ?></option>
          <?php
		 }else{?><option value="<?php echo $row->lang_code;?>"><?php echo $row->lang_name; ?></option>
		 <?php
		 }
	
    }
    ?>
      
	  </select></td>
	  
		<td><input type="button" name="btnlang" value="CHOOSE LANGUAGES" onclick="submitbutton('submitlang')" class="smallbutton"/>
		</td>	
		</tr>
		<?php
	$k=0;
	for($i=0,$n=count($this->translation);$i<$n;$i++)
	  { 
	 $data=& $this->translation[$i];
	 $checked= JHTML::_( 'grid.id', $i, $data->id );
		  ?>
		 <tr class="row<?php echo $k;?>">
			<td><?php echo $checked;?></td>
			<td><?php echo $data->id;?></td>
			<td><?php print($data->sourcemsg);?></td>
			<td><?php print($data->intermediatemsg);?></td>
			<td><textarea name="translated_msgs[]" rows=3 cols="51" id="translated_msgs<?php echo $i ?>"> <?php echo trim($data->destinationmsg);?></textarea></td>
			<td><input type="button" name="automatic" value=" Automatic Translation" onclick="loadlang('<?php echo addslashes($data->sourcemsg); ?>','translated_msgs<?php echo $i ?>')"/>
			<input type="hidden" name="ids[]" value="<?php print($data->id)?>" />
			<input type="hidden" name="message_ids[]" value="<?php print($data->id)?>" /></td>
		  </tr>
		   <?php
		   $k=1-$k;
		}
		?>
		
	<tr><td colspan="6"><input name="btnsave" type="button" value="SAVE" onclick="submitbutton('save')" class="smallbutton"/>
	<input name="btndownload" type="button" value="DOWNLOAD" onclick="submitbutton('download')" class="smallbutton"/></td></tr>
	</tbody>
<tfoot>
<tr><td colspan="6"><?php echo $this->pagination->getListFooter(); ?>   </td></tr></tfoot> 
</table>

<input type="hidden" name="task" value="submitlang" />
<input type="hidden" name="option" value="com_translate" />
<input type="hidden" name="controller" value="translate"/>
<input type="hidden" name="view" value="translate" />
<input type="hidden" name="layout" value="form" />
<input type="hidden" name="Itemid" value="2" />
</form>



