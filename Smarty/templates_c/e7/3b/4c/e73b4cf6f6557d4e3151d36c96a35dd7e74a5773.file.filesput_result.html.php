<?php /* Smarty version Smarty-3.1.11, created on 2016-06-11 04:11:47
         compiled from "html\filesput_result.html" */ ?>
<?php /*%%SmartyHeaderCode:12772575b736339fd87-06688435%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e73b4cf6f6557d4e3151d36c96a35dd7e74a5773' => 
    array (
      0 => 'html\\filesput_result.html',
      1 => 1408004889,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12772575b736339fd87-06688435',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'out' => 0,
    'file' => 0,
    'times' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_575b73635bed89_23470183',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_575b73635bed89_23470183')) {function content_575b73635bed89_23470183($_smarty_tpl) {?><style type="text/css">
  .list {                                                  
    font-size: 13px;
    border: 0px;
    border-collapse: collapse;
  }

  .cv {
    background-color: #00FF00;
  }

  .ss {
    background-color: #00FFFF;
  }

  .vdo {
    background-color: #FFFF00;
  }

  .cancle {
    background-color: #CCCCCC;
  }

</style>

<table class="list">
<?php  $_smarty_tpl->tpl_vars['file'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['file']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['out']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['file']->key => $_smarty_tpl->tpl_vars['file']->value){
$_smarty_tpl->tpl_vars['file']->_loop = true;
?>
<tr class="<?php echo $_smarty_tpl->tpl_vars['file']->value['ftype'];?>
">
  <td>Code: <?php echo $_smarty_tpl->tpl_vars['file']->value['fcode'];?>
</td>
  <td>Path: <?php echo $_smarty_tpl->tpl_vars['file']->value['ffile'];?>
</td>
  <td>Result: <?php echo $_smarty_tpl->tpl_vars['file']->value['filemsg'];?>
<?php echo $_smarty_tpl->tpl_vars['file']->value['amovmsg'];?>
<?php echo $_smarty_tpl->tpl_vars['file']->value['time'];?>
</td>
</tr>
<?php } ?>
</table>
Total: <?php echo $_smarty_tpl->tpl_vars['times']->value;?>
 sec&nbsp;
<input type="button" value="CLOSE" onclick="window.close()" /><?php }} ?>