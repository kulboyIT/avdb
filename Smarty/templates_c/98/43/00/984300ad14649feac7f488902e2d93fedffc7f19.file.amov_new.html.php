<?php /* Smarty version Smarty-3.1.11, created on 2016-07-02 08:03:00
         compiled from "html\amov_new.html" */ ?>
<?php /*%%SmartyHeaderCode:1748157775914e99d26-56499725%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '984300ad14649feac7f488902e2d93fedffc7f19' => 
    array (
      0 => 'html\\amov_new.html',
      1 => 1433586307,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1748157775914e99d26-56499725',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_57775914f0f041_64894307',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57775914f0f041_64894307')) {function content_57775914f0f041_64894307($_smarty_tpl) {?><script type="text/javascript">
	$(document).ready(function(){
    $('#txtCode').keyup(function(){
      val = $(this).val();
      if(val == null || val == ''){
        $('#btnSubmit').attr('disabled',true);
      }else{
        $('#btnSubmit').attr('disabled',false);
      }
    });
  });
</script>
<form action="amovnew.php" method="get">
  CODE: 
  <input type="text" name="code" id="txtCode" value="" />
  <input type="submit" name="submit" id="btnSubmit" value="ADD" disabled />
  <input type="checkbox" name="manual" value="MANUAL" />Manual?
</form><?php }} ?>