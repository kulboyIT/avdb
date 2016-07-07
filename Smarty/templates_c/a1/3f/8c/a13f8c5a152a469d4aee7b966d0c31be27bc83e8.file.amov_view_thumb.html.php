<?php /* Smarty version Smarty-3.1.11, created on 2016-05-15 06:52:38
         compiled from "html\amov_view_thumb.html" */ ?>
<?php /*%%SmartyHeaderCode:100125738009635efd4-44977448%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a13f8c5a152a469d4aee7b966d0c31be27bc83e8' => 
    array (
      0 => 'html\\amov_view_thumb.html',
      1 => 1433586651,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '100125738009635efd4-44977448',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'page' => 0,
    'find' => 0,
    'view' => 0,
    'order' => 0,
    'limit' => 0,
    'sort' => 0,
    'lastpage' => 0,
    'orders' => 0,
    'sorts' => 0,
    'num' => 0,
    'pages' => 0,
    'views' => 0,
    'limits' => 0,
    'amovs' => 0,
    'mov' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_57380097153bf9_20553743',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57380097153bf9_20553743')) {function content_57380097153bf9_20553743($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include 'D:\\wamp\\www\\avdb\\Smarty\\libs\\plugins\\function.html_options.php';
?><head>
<script type="text/javascript">
	$(document).ready(function(){

		$(".cvd").click(function(){
			img = $("<img src='bp_picture.php?show="+$(this).attr('id')+"' title='"+$(this).attr('title')+"' />");
      img.load(function(){
        imgw = $(this).width();
        imgh = $(this).height();
        //alert(imgw+','+imgh)
        $("#topbox")
          .css("width",imgw)
          .css("height",imgh)
          .css("margin-left",(imgw/2)-imgw)
          .css("margin-top",(imgh/2)-imgh);
      });
			img.appendTo("#topbox");
      cap = $("<figcaption>"+$(this).attr('title')+"</figcaption>");
      cap.appendTo("#topbox");
			$("#backbox").show(1);
			$("#topbox").fadeIn(500);
		});

		$("#backbox").click(function(){
			$("#topbox").fadeOut(100,function(){
			  $("#topbox").html("");
			  $("#backbox").hide(1);
			});
		});

    $(".prevPage").click(function(){
      p = <?php echo $_smarty_tpl->tpl_vars['page']->value;?>
 - 1;
      if(p < 0) { p = 0; }
      redirect("?<?php echo $_smarty_tpl->tpl_vars['find']->value;?>
&v=<?php echo $_smarty_tpl->tpl_vars['view']->value;?>
&o=<?php echo $_smarty_tpl->tpl_vars['order']->value;?>
&l=<?php echo $_smarty_tpl->tpl_vars['limit']->value;?>
&r=<?php echo $_smarty_tpl->tpl_vars['sort']->value;?>
&p="+p);
    });

    $(".prevTenPage").click(function(){
      p = <?php echo $_smarty_tpl->tpl_vars['page']->value;?>
 - 10;
      if(p < 0) { p = 0; }
      redirect("?<?php echo $_smarty_tpl->tpl_vars['find']->value;?>
&v=<?php echo $_smarty_tpl->tpl_vars['view']->value;?>
&o=<?php echo $_smarty_tpl->tpl_vars['order']->value;?>
&l=<?php echo $_smarty_tpl->tpl_vars['limit']->value;?>
&r=<?php echo $_smarty_tpl->tpl_vars['sort']->value;?>
&p="+p);
    });

    $(".nextPage").click(function(){
      p = <?php echo $_smarty_tpl->tpl_vars['page']->value;?>
 + 1;
      if(p > <?php echo $_smarty_tpl->tpl_vars['lastpage']->value;?>
) { p = <?php echo $_smarty_tpl->tpl_vars['lastpage']->value;?>
; }
      redirect("?<?php echo $_smarty_tpl->tpl_vars['find']->value;?>
&v=<?php echo $_smarty_tpl->tpl_vars['view']->value;?>
&o=<?php echo $_smarty_tpl->tpl_vars['order']->value;?>
&l=<?php echo $_smarty_tpl->tpl_vars['limit']->value;?>
&r=<?php echo $_smarty_tpl->tpl_vars['sort']->value;?>
&p="+p);
    });

    $(".nextTenPage").click(function(){
      p = <?php echo $_smarty_tpl->tpl_vars['page']->value;?>
 + 10;
      if(p > <?php echo $_smarty_tpl->tpl_vars['lastpage']->value;?>
) { p = <?php echo $_smarty_tpl->tpl_vars['lastpage']->value;?>
; }
      redirect("?<?php echo $_smarty_tpl->tpl_vars['find']->value;?>
&v=<?php echo $_smarty_tpl->tpl_vars['view']->value;?>
&o=<?php echo $_smarty_tpl->tpl_vars['order']->value;?>
&l=<?php echo $_smarty_tpl->tpl_vars['limit']->value;?>
&r=<?php echo $_smarty_tpl->tpl_vars['sort']->value;?>
&p="+p);
    });

    $(".selPage").change(function(){
      p = $(this).val();
      redirect("?<?php echo $_smarty_tpl->tpl_vars['find']->value;?>
&v=<?php echo $_smarty_tpl->tpl_vars['view']->value;?>
&o=<?php echo $_smarty_tpl->tpl_vars['order']->value;?>
&l=<?php echo $_smarty_tpl->tpl_vars['limit']->value;?>
&r=<?php echo $_smarty_tpl->tpl_vars['sort']->value;?>
&p="+p);
    });

    $("#selView").change(function(){
      v = $(this).val();
      redirect("?<?php echo $_smarty_tpl->tpl_vars['find']->value;?>
&p=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
&l=<?php echo $_smarty_tpl->tpl_vars['limit']->value;?>
&r=<?php echo $_smarty_tpl->tpl_vars['sort']->value;?>
&o=<?php echo $_smarty_tpl->tpl_vars['order']->value;?>
&v="+v);
    });
  <?php if ($_smarty_tpl->tpl_vars['orders']->value!=''){?>
    $("#selOrder").change(function(){
      o = $(this).val();
      redirect("?<?php echo $_smarty_tpl->tpl_vars['find']->value;?>
&v=<?php echo $_smarty_tpl->tpl_vars['view']->value;?>
&p=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
&l=<?php echo $_smarty_tpl->tpl_vars['limit']->value;?>
&r=<?php echo $_smarty_tpl->tpl_vars['sort']->value;?>
&o="+o);
    });
  <?php }?>
  <?php if ($_smarty_tpl->tpl_vars['sorts']->value!=''){?>
    $("#selSort").change(function(){
      r = $(this).val();
      redirect("?<?php echo $_smarty_tpl->tpl_vars['find']->value;?>
&v=<?php echo $_smarty_tpl->tpl_vars['view']->value;?>
&p=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
&o=<?php echo $_smarty_tpl->tpl_vars['order']->value;?>
&l=<?php echo $_smarty_tpl->tpl_vars['limit']->value;?>
&r="+r);
    });
  <?php }?>
    $("#selLimit").change(function(){
      l = $(this).val();
      redirect("?<?php echo $_smarty_tpl->tpl_vars['find']->value;?>
&v=<?php echo $_smarty_tpl->tpl_vars['view']->value;?>
&p=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
&o=<?php echo $_smarty_tpl->tpl_vars['order']->value;?>
&r=<?php echo $_smarty_tpl->tpl_vars['sort']->value;?>
&l="+l);
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
		border: 0px;
		margin: 3px;
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

	#backbox {
		position: fixed;
		z-index: 15;
		top: 0px;
		left: 0px;
		width: 100%;
		height: 100%;
		opacity: 0.95;
		display: none;
		background-color: #999;
	}

	#topbox {
		position: fixed;
		z-index: 16;
    top: 50%;
    left: 50%;
    padding: 30px;
		display: none;
		background-color: #FFF;
		border-radius: 5px;
	}

  #pageNavi {
    padding: 5px 10px 5px 10px;
    text-align: center;
  }

</style>
</head>
<figure id="topbox"></figure>
<div id="backbox"></div>

<div id="pageNavi">

Result: <?php echo $_smarty_tpl->tpl_vars['num']->value;?>
 Movies
&nbsp;&nbsp;&nbsp;&nbsp;

<input type="button" class="prevTenPage" value="<<" />
<input type="button" class="prevPage" value="<" />
Page&nbsp;
<select class="selPage">
  <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['pages']->value,'selected'=>$_smarty_tpl->tpl_vars['page']->value),$_smarty_tpl);?>

</select>/<?php echo $_smarty_tpl->tpl_vars['lastpage']->value+1;?>

<input type="button" class="nextPage" value=">" />
<input type="button" class="nextTenPage" value=">>" />
&nbsp;&nbsp;&nbsp;

View&nbsp;
<select id="selView">
	<?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['views']->value,'selected'=>$_smarty_tpl->tpl_vars['view']->value),$_smarty_tpl);?>

</select>
&nbsp;&nbsp;&nbsp;
<?php if ($_smarty_tpl->tpl_vars['orders']->value!=''){?>
Order&nbsp;
<select id="selOrder">
	<?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['orders']->value,'selected'=>$_smarty_tpl->tpl_vars['order']->value),$_smarty_tpl);?>

</select>
&nbsp;&nbsp;&nbsp;
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['sorts']->value!=''){?>
Sort&nbsp;
<select id="selSort">
	<?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['sorts']->value,'selected'=>$_smarty_tpl->tpl_vars['sort']->value),$_smarty_tpl);?>

</select>
&nbsp;&nbsp;&nbsp;
<?php }?>
Display&nbsp;
<select id="selLimit">
	<?php echo smarty_function_html_options(array('output'=>$_smarty_tpl->tpl_vars['limits']->value,'values'=>$_smarty_tpl->tpl_vars['limits']->value,'selected'=>$_smarty_tpl->tpl_vars['limit']->value),$_smarty_tpl);?>

</select>
/Page
&nbsp;&nbsp;&nbsp;

</div>

<div>
<table class="atb" cellspacing="3">
<tr>
<?php  $_smarty_tpl->tpl_vars['mov'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['mov']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['amovs']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['mov']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['mov']->key => $_smarty_tpl->tpl_vars['mov']->value){
$_smarty_tpl->tpl_vars['mov']->_loop = true;
 $_smarty_tpl->tpl_vars['mov']->iteration++;
?>
<td class="color<?php echo $_smarty_tpl->tpl_vars['mov']->value['have'];?>
">
  <div class="thumbbox">
    <img class="cvd" src="bp_picture.php?thumb=<?php echo $_smarty_tpl->tpl_vars['mov']->value['cover'];?>
" id="<?php echo $_smarty_tpl->tpl_vars['mov']->value['cover'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['mov']->value['cvinfo'];?>
" />
    <a href="amovedit.php?i=<?php echo $_smarty_tpl->tpl_vars['mov']->value['id'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['mov']->value['code'];?>
</a>&nbsp;
    ( <?php echo $_smarty_tpl->tpl_vars['mov']->value['reldate'];?>
 )
  </div>
</td>
<?php if ($_smarty_tpl->tpl_vars['mov']->iteration%5==0){?></tr><tr><?php }?>
<?php } ?>
</tr>
</table>
</div>

<div id="pageNavi">

<input type="button" class="prevTenPage" value="<<" />
<input type="button" class="prevPage" value="<" />
Page&nbsp;
<select class="selPage">
  <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['pages']->value,'selected'=>$_smarty_tpl->tpl_vars['page']->value),$_smarty_tpl);?>

</select>/<?php echo $_smarty_tpl->tpl_vars['lastpage']->value+1;?>

<input type="button" class="nextPage" value=">" />
<input type="button" class="nextTenPage" value=">>" />

</div><?php }} ?>