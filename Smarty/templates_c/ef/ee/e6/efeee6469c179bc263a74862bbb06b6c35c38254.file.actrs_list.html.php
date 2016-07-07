<?php /* Smarty version Smarty-3.1.11, created on 2016-07-06 20:16:58
         compiled from "html\actrs_list.html" */ ?>
<?php /*%%SmartyHeaderCode:27690577d04cad0a876-55875748%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'efeee6469c179bc263a74862bbb06b6c35c38254' => 
    array (
      0 => 'html\\actrs_list.html',
      1 => 1463203892,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '27690577d04cad0a876-55875748',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'page' => 0,
    'find' => 0,
    'order' => 0,
    'sort' => 0,
    'lastpage' => 0,
    'num' => 0,
    'pages' => 0,
    'orders' => 0,
    'sorts' => 0,
    'actrs' => 0,
    'actr' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_577d04cb65a088_68874344',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_577d04cb65a088_68874344')) {function content_577d04cb65a088_68874344($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include 'D:\\wamp\\www\\avdb\\Smarty\\libs\\plugins\\function.html_options.php';
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

    $("#prevPage").click(function(){
      p = <?php echo $_smarty_tpl->tpl_vars['page']->value;?>
 - 1;
      if(p < 0) { p = 0; }
      redirect("?<?php echo $_smarty_tpl->tpl_vars['find']->value;?>
&o=<?php echo $_smarty_tpl->tpl_vars['order']->value;?>
&r=<?php echo $_smarty_tpl->tpl_vars['sort']->value;?>
&p="+p);
    });

    $("#prevTenPage").click(function(){
      p = <?php echo $_smarty_tpl->tpl_vars['page']->value;?>
 - 10;
      if(p < 0) { p = 0; }
      redirect("?<?php echo $_smarty_tpl->tpl_vars['find']->value;?>
&o=<?php echo $_smarty_tpl->tpl_vars['order']->value;?>
&r=<?php echo $_smarty_tpl->tpl_vars['sort']->value;?>
&p="+p);
    });

    $("#nextPage").click(function(){
      p = <?php echo $_smarty_tpl->tpl_vars['page']->value;?>
 + 1;
      if(p > <?php echo $_smarty_tpl->tpl_vars['lastpage']->value;?>
) { p = <?php echo $_smarty_tpl->tpl_vars['lastpage']->value;?>
; }
      redirect("?<?php echo $_smarty_tpl->tpl_vars['find']->value;?>
&o=<?php echo $_smarty_tpl->tpl_vars['order']->value;?>
&r=<?php echo $_smarty_tpl->tpl_vars['sort']->value;?>
&p="+p);
    });

    $("#nextTenPage").click(function(){
      p = <?php echo $_smarty_tpl->tpl_vars['page']->value;?>
 + 10;
      if(p > <?php echo $_smarty_tpl->tpl_vars['lastpage']->value;?>
) { p = <?php echo $_smarty_tpl->tpl_vars['lastpage']->value;?>
; }
      redirect("?<?php echo $_smarty_tpl->tpl_vars['find']->value;?>
&o=<?php echo $_smarty_tpl->tpl_vars['order']->value;?>
&r=<?php echo $_smarty_tpl->tpl_vars['sort']->value;?>
&p="+p);
    });

    $("#selPage").change(function(){
      p = $(this).val();
      redirect("?<?php echo $_smarty_tpl->tpl_vars['find']->value;?>
&o=<?php echo $_smarty_tpl->tpl_vars['order']->value;?>
&r=<?php echo $_smarty_tpl->tpl_vars['sort']->value;?>
&p="+p);
    });

    $("#selOrder").change(function(){
      o = $(this).val();
      redirect("?<?php echo $_smarty_tpl->tpl_vars['find']->value;?>
&p=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
&r=<?php echo $_smarty_tpl->tpl_vars['sort']->value;?>
&o="+o);
    });

    $("#selSort").change(function(){
      r = $(this).val();
      redirect("?<?php echo $_smarty_tpl->tpl_vars['find']->value;?>
&p=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
&o=<?php echo $_smarty_tpl->tpl_vars['order']->value;?>
&r="+r);
    });

    $("#btnAFind").click(function(){
      f = $("#Afind").val();
      redirect("?na="+f);
    });

    $("#Afind").keyup(function(){
      var val = $(this).val();
      if(val.length > 1){
        val = encodeURIComponent(val);
        x = $(this).offset().left;
        y = $(this).offset().bottom;
        $("#selList").css("left",x).css("top",y);
        $("#selList").load('bp_searchavname.php?result=edit&search='+val,function(res,status,xhr){
          //alert(xhr.statusText+'\n'+res);
          $(this).css('display','block');
        });
      }else{
        $("#selList").css('display','none');
      }
    });

    $(".star").click(function(){
      url = 'http://www.javlibrary.com/en/vl_star.php?&mode=2&s='+$(this).attr('id');
      window.open(url,'_blank');
    });

	});

  function nameAdd(id,notuse){
    $("#selList").css('display','none');
    $("#find").val("");
    url = "actrsview.php?a="+id;
    window.open(url,"_blank");
  }

  function redirect(url){
	  window.location.replace(url);
  }

</script>
<style type="text/css">

	.atb {
	  background-color: #33FF66;
    padding: 5px;
    border-radius: 5px;
	}

  .atb tr {
    height: 30px;
  }

  .atb td {
    background-color: #FFFFFF;
    padding: 0px 5px 0px 5px;
    border-radius: 5px;
  }

  .atb a {
    text-decoration: none;
  }

	img {
		border: 0px;
		margin: 3px;
    width: 130px;
    height: 130px;
	}

  img.star {
    border: 0px;
    margin-bottom: -5px;
    width: 20px;
    height: 20px;
  }

	a {
		color: #F00;
		cursor: hand;
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

  #btnAFind {
    margin-left: -7px;
  }

  #nameList {
    width: 250px;
    background: transparent;
    margin-bottom: 5px;
  }

  .loader {
    width: 16px;
    height: 16px;
    margin-bottom: -4px;
    display: none;
  }

  .actslist {
    position: absolute;
    display: none;
    border-left: 1px solid #808080;
    border-right: 1px solid #808080;
    border-bottom: 1px solid #808080;
    z-index: 1;
    height: 140px;
    overflow-y: scroll;
    background-color: #FFFFFF;
    width: 170px;
  }

  .actslist ul {
    margin: 0;
    padding: 0;
    list-style: none;
  }

  .actslist li {
    display: block;
    clear: both;
    width: 150px;
    background-color: #FFFFFF;
    color: #474747;
    padding: .2em .3em;
  }

  .actslist a {
    display: block;
    text-decoration: none;
    color: #474747;
    text-align: left;
    border-radius: 4px;
    padding-left: 4px;
  }

  .actslist a:hover{
    color: #474747;
    background-color: #C9C9C9;
    background-image: none;
  }

</style>
</head>
<figure id="topbox"></figure>
<div id="backbox"></div>

<div id="pageNavi">

Result: <?php echo $_smarty_tpl->tpl_vars['num']->value;?>
 Actress in DB
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<input type="button" id="prevTenPage" value="<<" />
<input type="button" id="prevPage" value="<" />
Page&nbsp;
<select id="selPage">
  <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['pages']->value,'selected'=>$_smarty_tpl->tpl_vars['page']->value),$_smarty_tpl);?>

</select>/<?php echo $_smarty_tpl->tpl_vars['lastpage']->value+1;?>

<input type="button" id="nextPage" value=">" />
<input type="button" id="nextTenPage" value=">>" />
&nbsp;&nbsp;&nbsp;

Order&nbsp;
<select id="selOrder">
	<?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['orders']->value,'selected'=>$_smarty_tpl->tpl_vars['order']->value),$_smarty_tpl);?>

</select>
&nbsp;&nbsp;&nbsp;

Sort&nbsp;
<select id="selSort">
	<?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['sorts']->value,'selected'=>$_smarty_tpl->tpl_vars['sort']->value),$_smarty_tpl);?>

</select>
&nbsp;&nbsp;&nbsp;

<input type="text" value="" id="Afind" />
<div class="actslist" id="selList"></div>
<input type="button" value="FIND" id="btnAFind" />

</div>

<div>
<table border="0">
<tr>
<?php  $_smarty_tpl->tpl_vars['actr'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['actr']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['actrs']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['actr']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['actr']->key => $_smarty_tpl->tpl_vars['actr']->value){
$_smarty_tpl->tpl_vars['actr']->_loop = true;
 $_smarty_tpl->tpl_vars['actr']->iteration++;
?>
<td>
  <table class="atb" cellspacing="3">
  <tr>
  	<td rowspan="4" width="140"><img src="bp_picture.php?actrt=<?php echo $_smarty_tpl->tpl_vars['actr']->value['id'];?>
" /></td>
  	<td width="200">
      <a href="actrsview.php?a=<?php echo $_smarty_tpl->tpl_vars['actr']->value['id'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['actr']->value['name'];?>
</a>
      <?php if ($_smarty_tpl->tpl_vars['actr']->value['follow']==1){?><img src="html/images/star.jpg" class="star" alt="Follow her!" id="<?php echo $_smarty_tpl->tpl_vars['actr']->value['javlibcode'];?>
" /><?php }?>
    </td>
  </tr>
  <tr>
  	<td colspan="3">Age: <?php echo $_smarty_tpl->tpl_vars['actr']->value['age'];?>
 [<?php echo $_smarty_tpl->tpl_vars['actr']->value['birthdate'];?>
]</td>
  </tr>
  <tr>
    <td><?php echo $_smarty_tpl->tpl_vars['actr']->value['size'];?>
</td>
  </tr>
  <tr>
    <td><?php echo $_smarty_tpl->tpl_vars['actr']->value['movies'];?>
 Movie(s)</td>
  </tr>
  </table>
</td>
<?php if ($_smarty_tpl->tpl_vars['actr']->iteration%3==0){?></tr><tr><?php }?>
<?php } ?>
</tr>
</table>
</div>
<?php }} ?>