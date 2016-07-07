<?php /* Smarty version Smarty-3.1.11, created on 2016-07-06 20:26:48
         compiled from "html\viewjavlib.html" */ ?>
<?php /*%%SmartyHeaderCode:4756577d071808e8a0-60359041%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f0e1eadcdb74b388c82d451b8ed728d799322189' => 
    array (
      0 => 'html\\viewjavlib.html',
      1 => 1450604786,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4756577d071808e8a0-60359041',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'page' => 0,
    'va' => 0,
    'vl' => 0,
    'optView' => 0,
    'view' => 0,
    'pages' => 0,
    'movs' => 0,
    'mov' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_577d07185cb2b7_45284798',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_577d07185cb2b7_45284798')) {function content_577d07185cb2b7_45284798($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include 'D:\\wamp\\www\\avdb\\Smarty\\libs\\plugins\\function.html_options.php';
?><head>
<script type="text/javascript">
	$(document).ready(function(){

    $(".prevPage").click(function(){
      p = <?php echo $_smarty_tpl->tpl_vars['page']->value;?>
 - 1;
      if(p < 1) { p = 1; }
      redirect("<?php echo $_smarty_tpl->tpl_vars['va']->value;?>
"+p);
    });

    $(".prevTenPage").click(function(){
      p = <?php echo $_smarty_tpl->tpl_vars['page']->value;?>
 - 10;
      if(p < 1) { p = 1; }
      redirect("<?php echo $_smarty_tpl->tpl_vars['va']->value;?>
"+p);
    });

    $(".nextPage").click(function(){
      p = <?php echo $_smarty_tpl->tpl_vars['page']->value;?>
 + 1;
      if(p > 50) { p = 50; }
      redirect("<?php echo $_smarty_tpl->tpl_vars['va']->value;?>
"+p);
    });

    $(".nextTenPage").click(function(){
      p = <?php echo $_smarty_tpl->tpl_vars['page']->value;?>
 + 10;
      if(p > 50) { p = 50; }
      redirect("<?php echo $_smarty_tpl->tpl_vars['va']->value;?>
"+p);
    });

    $(".selPage").change(function(){
      p = $(this).val();
      redirect("<?php echo $_smarty_tpl->tpl_vars['va']->value;?>
"+p);
    });

    $(".selView").change(function(){
      v = $(this).val();
      redirect("?&v="+v);
    });

    $(".btplus").click(function(){
      c = $(this).prop('id');
      //alert(c);
      window.open('amovnew.php?submit=ADD&code='+c);
      $(this).css('visibility','hidden');
    });
    
    $("#btnJavlib").click(function(){
      url = "http://www.javlibrary.com/en/<?php echo $_smarty_tpl->tpl_vars['vl']->value;?>
&page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
";
      window.open(url,'_blank');
    });

  });

  function redirect(url){
	  window.location.replace(url);
  }

</script>
<style type="text/css">

	.atb {
    padding: 5px;
    border-radius: 5px;
	}

  .atb tr {

  }

  .atb td {
    padding: 5px;
    border-radius: 5px;
  }

  .atb td.color0 {
    background-color: #C9C9C9;
	}

	.atb td.color1 {
		background-color: #33FF66;
	}

  .atb td.color2 {
    background-color: #FFCC66;
  }

  .atb td.color3 {
    background-color: #FF1414;
  }

  .atb input, select {
    margin: 0px;
    padding-left: 3px;
    border: 0;
    background: transparent;
  }

  .atb a {
    text-decoration: none;
  }

	img {
		border: 0px
	}

  img.picv {
    margin: 3px;
  }

  img.btplus {
    margin-bottom: -2px;
  }

	a {
		color: #F00;
		cursor: hand;
	}

  .thumbbox {
    text-align: center;
    background-color: #FFFFFF;
    width: 216px;
    border-radius: 5px;
  }

</style>
</head>
<div>
View: <select class="selView">
<?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['optView']->value,'selected'=>$_smarty_tpl->tpl_vars['view']->value),$_smarty_tpl);?>

</select>
&nbsp;
Page:&nbsp;
<input type="button" class="prevPage" value="<<" />&nbsp;
<select class="selPage">
  <?php echo smarty_function_html_options(array('values'=>$_smarty_tpl->tpl_vars['pages']->value,'output'=>$_smarty_tpl->tpl_vars['pages']->value,'selected'=>$_smarty_tpl->tpl_vars['page']->value),$_smarty_tpl);?>

</select>&nbsp;
<input type="button" class="nextPage" value=">>" />&nbsp;
<input type="image" src="html/images/javlib_button.png" id="btnJavlib" />
</div>
<div>
<table class="atb" cellspacing="3">
<tr>
<?php  $_smarty_tpl->tpl_vars['mov'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['mov']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['movs']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['mov']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['mov']->key => $_smarty_tpl->tpl_vars['mov']->value){
$_smarty_tpl->tpl_vars['mov']->_loop = true;
 $_smarty_tpl->tpl_vars['mov']->iteration++;
?>
<td class="color<?php echo $_smarty_tpl->tpl_vars['mov']->value['have'];?>
">
  <div class="thumbbox">
    <img src="<?php echo $_smarty_tpl->tpl_vars['mov']->value['pic'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['mov']->value['title'];?>
" class="picv" /><br/>
    <?php if ($_smarty_tpl->tpl_vars['mov']->value['have']=='5'){?>
    <a href="http://www.javlibrary.com/en/vl_searchbyid.php?keyword=<?php echo $_smarty_tpl->tpl_vars['mov']->value['code'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['mov']->value['code'];?>
</a>
    <img src="html/images/plus1.gif" alt="ADD to Database" class="btplus" id="<?php echo $_smarty_tpl->tpl_vars['mov']->value['code'];?>
" />
    <?php }else{ ?>
    <a href="amovedit.php?i=<?php echo $_smarty_tpl->tpl_vars['mov']->value['dbid'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['mov']->value['code'];?>
</a>
    <?php }?>
  </div>
</td>
<?php if ($_smarty_tpl->tpl_vars['mov']->iteration%5==0){?></tr><tr><?php }?>
<?php } ?>
</tr>
</table>
</div>
<?php }} ?>