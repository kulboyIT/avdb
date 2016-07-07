<?php /* Smarty version Smarty-3.1.11, created on 2016-04-22 17:30:20
         compiled from "html\group_view.html" */ ?>
<?php /*%%SmartyHeaderCode:25577571a438c255231-16354918%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3c81486568d86fc2ea5abe6e3cf2aa7aba7d722e' => 
    array (
      0 => 'html\\group_view.html',
      1 => 1430979968,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '25577571a438c255231-16354918',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'char' => 0,
    'key' => 0,
    'chr' => 0,
    'views' => 0,
    'view' => 0,
    'group' => 0,
    'g' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_571a438c4f1254_82187343',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_571a438c4f1254_82187343')) {function content_571a438c4f1254_82187343($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include 'D:\\wamp\\www\\avdb\\Smarty\\libs\\plugins\\function.html_options.php';
?><head>
<script type="text/javascript">
	$(document).ready(function(){

    $(".active").click(function(){
      k = $(this).html();
      v = $("select[name=view]").val();
      url = 'group.php?v='+v+'&k='+k;
      redirect(url);
    });

    $(".tabbody div").click(function(){
      g = $(this).attr('id');
      v = $("select[name=view]").val();
      url = 'amov.php?v='+v+'&ct='+g+'-';
      window.open(url,'_blank');
    });

	});

  function redirect(url){
	  window.location.replace(url);
  }

</script>
<style type="text/css">
  .tabheader {
    margin: 0px;
    padding: 5px 5px 0px 5px;
    border: 0px;
  }

  .tabheader tr {
    margin: 0px;
  }

  .tabheader td.active {
    width: 30px;
    border-radius: 8px 8px 0px 0px;
    border: 2px solid #0510A6;
    margin: 0px;
    text-align: center;
  }

  .tabheader td.active:hover {
    background-color: #F2EF7C;
    color: #A03522;
    cursor: pointer;
  }

  .tabheader td.current {
    width: 30px;
    border-radius: 8px 8px 0px 0px;
    border: 2px solid #B31F0F;
    border-bottom: 0px;
    margin: 0px;
    text-align: center;
  }

  .tabbody {
    border: 2px solid #0510A6;
    border-top: 0px;
    padding: 5px;
    border-radius: 0px 0px 12px 12px;
    margin-top: -4px;
    padding-top: 10px;
    z-index: -1;
  }

  .tabbody div {
    width: 120px;
    border-radius: 12px;
    border: 1px solid #10CC06;
    text-align: center;
    display: inline-block;
    margin: 2px;
    padding: 3px 0px 3px 0px;
  }

  .tabbody div:hover {
    background-color: #0819D1;
    color: #E9E9AA;
    cursor: pointer;
  }

</style>
</head>

<table class="tabheader">
  <tr>
  <?php  $_smarty_tpl->tpl_vars['chr'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['chr']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['char']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['chr']->key => $_smarty_tpl->tpl_vars['chr']->value){
$_smarty_tpl->tpl_vars['chr']->_loop = true;
?>
  <?php if ($_smarty_tpl->tpl_vars['key']->value==$_smarty_tpl->tpl_vars['chr']->value){?><td class="current"><?php }else{ ?><td class="active"><?php }?><?php echo $_smarty_tpl->tpl_vars['chr']->value;?>
</td>
  <?php } ?>
  <td>View: <?php echo smarty_function_html_options(array('name'=>"view",'output'=>$_smarty_tpl->tpl_vars['views']->value,'values'=>$_smarty_tpl->tpl_vars['views']->value,'selected'=>$_smarty_tpl->tpl_vars['view']->value),$_smarty_tpl);?>
</td>
  </tr>
</table>

<div class="tabbody">
<?php  $_smarty_tpl->tpl_vars['g'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['g']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['group']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['g']->key => $_smarty_tpl->tpl_vars['g']->value){
$_smarty_tpl->tpl_vars['g']->_loop = true;
?><div id="<?php echo $_smarty_tpl->tpl_vars['g']->key;?>
"><?php echo $_smarty_tpl->tpl_vars['g']->key;?>
<br/>(<?php echo $_smarty_tpl->tpl_vars['g']->value;?>
 Movies)</div><?php } ?>
</div><?php }} ?>