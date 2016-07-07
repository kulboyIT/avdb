<?php /* Smarty version Smarty-3.1.11, created on 2016-07-06 20:26:29
         compiled from "html\actrs_view.html" */ ?>
<?php /*%%SmartyHeaderCode:21330577d070541d5a6-63632377%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3c67c3dbe1949c806366feb5e8f7e9fe8254711a' => 
    array (
      0 => 'html\\actrs_view.html',
      1 => 1433640069,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '21330577d070541d5a6-63632377',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'actr' => 0,
    'opt_nation' => 0,
    'opt_follow' => 0,
    'opt_score' => 0,
    'movs' => 0,
    'mov' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_577d0705bbb5b3_27565395',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_577d0705bbb5b3_27565395')) {function content_577d0705bbb5b3_27565395($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include 'D:\\wamp\\www\\avdb\\Smarty\\libs\\plugins\\function.html_options.php';
?><head>
<script src="simpleUpload.min.js"></script>
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

    $("input[type='text']").focus(function(){
      $(this).css('background','#F7F7F7');
    });

    $("input[type='text']").blur(function(){
      $(this).css('background','transparent');
    });

    $('#upFull').simpleUpload({
      url: 'bp_uploadactrs.php?a=<?php echo $_smarty_tpl->tpl_vars['actr']->value['id'];?>
&t=full',
      trigger: '#btnUpFull',
      types: ['jpg', 'jpeg', 'png'],
      size: 1024,
      success: function(res){
        //alert(res);
        r = res.split(";");
        if(r[0] == 'OK'){
          img = $("<img class='full' src='bp_picture.php?actrf="+r[1]+"' />");
          $("#imgFull").empty();
          $("#imgFull").append(img);
        }else{
          alert(r[1]);
        }
      },
      error: function(erro){
        if(error.type == 'fileType') alert('Invalid File Type.');
      }
    });

    $('#upThumb').simpleUpload({
      url: 'bp_uploadactrs.php?a=<?php echo $_smarty_tpl->tpl_vars['actr']->value['id'];?>
&t=thumb',
      trigger: '#btnUpThumb',
      types: ['jpg', 'jpeg', 'png'],
      size: 1024,
      success: function(res){
        //alert(res);
        r = res.split(";");
        if(r[0] == 'OK'){
          img = $("<img class='thumb' src='bp_picture.php?actrt="+r[1]+"' />");
          $("#imgThumb").empty();
          $("#imgThumb").append(img);
        }else{
          alert(r[1]);
        }
      },
      error: function(erro){
        if(error.type == 'fileType') alert('Invalid File Type.');
      }
    });

    $("#btnJavlib").click(function(){
      //url = 'http://www.javlibrary.com/en/vl_star.php?&mode=2&s=<?php echo $_smarty_tpl->tpl_vars['actr']->value['javlibcode'];?>
';
      url = 'viewjavlib.php?v=star&a=<?php echo $_smarty_tpl->tpl_vars['actr']->value['javlibcode'];?>
';
      window.open(url,'_blank');
    });

    $("#star").click(function(){
      url = 'http://www.javlibrary.com/en/vl_star.php?&mode=2&s=<?php echo $_smarty_tpl->tpl_vars['actr']->value['javlibcode'];?>
';
      window.open(url,'_blank');
    });

    $('#btnClose').click(function(){
      window.close();
    });

    $('#btnViewList').click(function(){
      redirect('amov.php?v=list&ac=<?php echo $_smarty_tpl->tpl_vars['actr']->value['id'];?>
');
    });

    $('#btnViewDetail').click(function(){
      redirect('amov.php?v=detail&ac=<?php echo $_smarty_tpl->tpl_vars['actr']->value['id'];?>
');
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

  .atb a {
    text-decoration: none;
  }

  .actrs {
    padding: 5px;
    border-radius: 5px;
    background-color: #0906A7;
  }

  .actrs td {
    padding: 5px;
    border-radius: 5px;
    background-color: #FFFFFF;
  }

  .actrs input, select {
    font-family: "Open Sans", "Helvetica Neue", Helvetica, Arial, Sans-Serif;
    margin: 0px;
    padding-left: 3px;
    border: 0;
    background: transparent;
  }

  input[type="button"],input[type="submit"] {
    padding-left: 6px;
    color: #800000;
    background: -webkit-linear-gradient(#C0C0C0,#A3A3A3);
    border-radius: 3px;
  }

	img {
		border: 0px;
		margin: 3px;
	}

  img.thumb {
    width: 150px;
    height: 150px;
  }

  img.full {
    width: 150px;
    height: 300px;
  }

  #star {
    border: 0px;
    margin-bottom: -5px;
    width: 20px;
    height: 20px;
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

  #btnFind {
    margin-left: -7px;
  }

</style>
</head>
<figure id="topbox"></figure>
<div id="backbox"></div>

<div>
<form action="bp_actrsave.php?id=<?php echo $_smarty_tpl->tpl_vars['actr']->value['id'];?>
" method="post" target="frmHidden">
<table class="actrs" cellspacing="3">
<tr>
  <td rowspan="9" width="160" id="imgFull"><img class="full" src="bp_picture.php?actrf=<?php echo $_smarty_tpl->tpl_vars['actr']->value['id'];?>
" /></td>
  <td width="500">ID: <?php echo $_smarty_tpl->tpl_vars['actr']->value['id'];?>
</td>
  <td rowspan="6" width="160" id="imgThumb"><img class="thumb" src="bp_picture.php?actrt=<?php echo $_smarty_tpl->tpl_vars['actr']->value['id'];?>
" /></td>
</tr>
<tr>
  <td>Name:
    <input type="text" name="fname" value="<?php echo $_smarty_tpl->tpl_vars['actr']->value['fname'];?>
" placeholder="First name" size="15" />-
    <input type="text" name="lname" value="<?php echo $_smarty_tpl->tpl_vars['actr']->value['lname'];?>
" placeholder="Last name" size="15" />-
    <input type="text" name="jname" value="<?php echo $_smarty_tpl->tpl_vars['actr']->value['jname'];?>
" placeholder="Japan name" size="15" />
  </td>
</tr>
<tr>
  <td>
    JavLib CODE: <input type="text" name="javlibcode" value="<?php echo $_smarty_tpl->tpl_vars['actr']->value['javlibcode'];?>
" />
    <input type="image" src="html/images/javlib_button.png" id="btnJavlib" />
  </td>
</tr>
<tr>
  <td>Age: <?php echo $_smarty_tpl->tpl_vars['actr']->value['age'];?>
&nbsp;&nbsp;&nbsp;&nbsp;Birthdate: <input type="date" name="birthdate" value="<?php echo $_smarty_tpl->tpl_vars['actr']->value['birthdate'];?>
" /></td>
</tr>
<tr>
  <td>
    Nation: <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['opt_nation']->value,'name'=>"nation",'selected'=>$_smarty_tpl->tpl_vars['actr']->value['nation']),$_smarty_tpl);?>

  </td>
</tr>
<tr>
  <td>Size: <input type="text" name="size" value="<?php echo $_smarty_tpl->tpl_vars['actr']->value['size'];?>
" /></td>
</tr>
<tr>
<td>Thumb:
      <input type="file" name="upThumb" id="upThumb" title="W250 x H250" />
      <input type="button" id="btnUpThumb" value="UP" />
  </td>
  <td>
    <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['opt_follow']->value,'name'=>"follow",'selected'=>$_smarty_tpl->tpl_vars['actr']->value['follow']),$_smarty_tpl);?>

    <?php if ($_smarty_tpl->tpl_vars['actr']->value['follow']==1){?><img src="html/images/star.jpg" alt="Follow her!" id="star" /><?php }?>
  </td>
</tr>
<tr>
  <td>Full:
      <input type="file" name="upFull" id="upFull" title="W250 x H500" />
      <input type="button" id="btnUpFull" value="UP" />
  </td>
  <td><?php echo $_smarty_tpl->tpl_vars['actr']->value['movies'];?>
 Movie(s)</td>
</tr>
<tr>
  <td>
    <input type="submit" name="submit" value="SAVE" />
    <input type="button" id="btnDelete" value="DELETE" />
    <input type="button" id="btnClose" value="CLOSE" />
    <input type="button" id="btnViewList" value="List her Movies" />
    <input type="button" id="btnViewDetail" value="Detail her Movies" />
  </td>
  <td>Score: <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['opt_score']->value,'name'=>"score",'selected'=>$_smarty_tpl->tpl_vars['actr']->value['score']),$_smarty_tpl);?>
</td>
</tr>
</table>
</form>
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
    <img class="cvd" src="bp_picture.php?thumb=<?php echo $_smarty_tpl->tpl_vars['mov']->value['cover'];?>
" id="<?php echo $_smarty_tpl->tpl_vars['mov']->value['cover'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['mov']->value['cvinfo'];?>
" /><br/>
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
<iframe frameborder="0" style="width: 1000px; height: 0px" name="frmHidden"></iframe><?php }} ?>