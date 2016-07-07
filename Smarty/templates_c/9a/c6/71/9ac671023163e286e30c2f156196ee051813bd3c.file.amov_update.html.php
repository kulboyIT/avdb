<?php /* Smarty version Smarty-3.1.11, created on 2016-07-06 20:28:39
         compiled from "html\amov_update.html" */ ?>
<?php /*%%SmartyHeaderCode:17408577d078766b4d8-31417898%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9ac671023163e286e30c2f156196ee051813bd3c' => 
    array (
      0 => 'html\\amov_update.html',
      1 => 1430987443,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17408577d078766b4d8-31417898',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'mov' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_577d07877d8ed3_27770450',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_577d07877d8ed3_27770450')) {function content_577d07877d8ed3_27770450($_smarty_tpl) {?><script type="text/javascript">
	$(document).ready(function(){
    $('#btnCancel').click(function(){
      window.location.replace('amovedit.php?i=<?php echo $_smarty_tpl->tpl_vars['mov']->value['id'];?>
');
    });

    $('.rdoUpdate').change(function(){
      if($('input[name="upby"]:checked').val()){
        $('#btnSubmit').attr('disabled',false);
      }else{
        $('#btnSubmit').attr('disabled',true);
      }
    })
  });
</script>
<form action="amovupdate.php?i=<?php echo $_smarty_tpl->tpl_vars['mov']->value['id'];?>
" method="post" enctype="multipart/form-data">
Update from?<br/>
  <input type="radio" name="upby" class="rdoUpdate" value="CODE" />
  CODE:&nbsp;<input type="text" name="code" id="upCode" value="<?php echo $_smarty_tpl->tpl_vars['mov']->value['code'];?>
" /><br/>
  <input type="radio" name="upby" class="rdoUpdate" value="URL" />
  URL:&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="url" id="upUrl" value="<?php echo $_smarty_tpl->tpl_vars['mov']->value['javlib'];?>
" size="65" /><br/>
  <input type="radio" name="upby" class="rdoUpdate" value="FILE" />
  FILE:&nbsp;&nbsp;&nbsp;&nbsp;<input type="file" name="file" id="upFile" /><br/>
	<input type="checkbox" name="upcover" value="UPCOVER" /> Update Cover.<br/>
  <input type="submit" name="submit" value="SUBMIT" id="btnSubmit" disabled />
  <input type="button" value="CANCEL" id="btnCancel" />
</form><?php }} ?>