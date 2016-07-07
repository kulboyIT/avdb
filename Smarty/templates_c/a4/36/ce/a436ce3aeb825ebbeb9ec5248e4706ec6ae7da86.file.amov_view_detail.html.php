<?php /* Smarty version Smarty-3.1.11, created on 2015-12-17 05:02:01
         compiled from "html\amov_view_detail.html" */ ?>
<?php /*%%SmartyHeaderCode:12232567233b9e16463-13835798%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a436ce3aeb825ebbeb9ec5248e4706ec6ae7da86' => 
    array (
      0 => 'html\\amov_view_detail.html',
      1 => 1411859183,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12232567233b9e16463-13835798',
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
    'num' => 0,
    'pages' => 0,
    'views' => 0,
    'orders' => 0,
    'sorts' => 0,
    'limits' => 0,
    'amovs' => 0,
    'mov' => 0,
    'opt_region' => 0,
    'actr' => 0,
    'opt_have' => 0,
    'opt_score' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_567233bb0b5481_57524403',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_567233bb0b5481_57524403')) {function content_567233bb0b5481_57524403($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include 'D:\\wamp\\www\\avdb\\Smarty\\libs\\plugins\\function.html_options.php';
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

    $(".selacts").keyup(function(){
      var val = $(this).val();
      var id = $(this).attr('id');
      if(val.length > 1){
        $('#'+id+' .loader').css('display','inline-block');
        reqName = $('#'+id+' .actslist');
        val = encodeURIComponent(val);
        reqName.load('bp_searchavname.php?search='+val+'&sid='+id,function(res,status,xhr){
          //alert(xhr.statusText+'\n'+res);
          $(this).css('display','block');
          $('#'+id+' .loader').css('display','none');
        });
      }else{
        $('#'+id+' .actslist').css('display','none');
        $('#'+id+' .loader').css('display','none');
      }
    });

    $(".btAdd").click(function(){
      id = $(this).attr('id');
      val = $('#'+id+' .selacts').val();
      if(val == null || val == ""){
        alert('Plese input name');
      }else{
        val = encodeURIComponent(val);
        $.post("bp_addavname.php",{name: val},function(res){
          r = res.split(";");
          if(r[0] == 'OK'){
            nameAdd(id,r[1],r[2]);
            $('#'+id+' .selacts').val("");
          }else{
            alert(r[1]);
          }
        });
      }
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

    $("#selOrder").change(function(){
      o = $(this).val();
      redirect("?<?php echo $_smarty_tpl->tpl_vars['find']->value;?>
&v=<?php echo $_smarty_tpl->tpl_vars['view']->value;?>
&p=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
&l=<?php echo $_smarty_tpl->tpl_vars['limit']->value;?>
&r=<?php echo $_smarty_tpl->tpl_vars['sort']->value;?>
&o="+o);
    });

    $("#selSort").change(function(){
      r = $(this).val();
      redirect("?<?php echo $_smarty_tpl->tpl_vars['find']->value;?>
&v=<?php echo $_smarty_tpl->tpl_vars['view']->value;?>
&p=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
&o=<?php echo $_smarty_tpl->tpl_vars['order']->value;?>
&l=<?php echo $_smarty_tpl->tpl_vars['limit']->value;?>
&r="+r);
    });

    $("#selLimit").change(function(){
      l = $(this).val();
      redirect("?<?php echo $_smarty_tpl->tpl_vars['find']->value;?>
&v=<?php echo $_smarty_tpl->tpl_vars['view']->value;?>
&p=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
&o=<?php echo $_smarty_tpl->tpl_vars['order']->value;?>
&r=<?php echo $_smarty_tpl->tpl_vars['sort']->value;?>
&l="+l);
    });

    $("input[type='text']").focus(function(){
      $(this).css('background','#F7F7F7');
    });

    $("input[type='text']").blur(function(){
      $(this).css('background','transparent');
    });

    $(".btnJavlib").click(function(){
      c = $(this).val();
      url = "http://www.javlibrary.com/en/vl_searchbyid.php?keyword="+c;
      window.open(url,'_blank');
    });

	});

  $(document).on('mouseover','.actsname',function(){
    $(this).children("span").show();
  });

  $(document).on('mouseout','.actsname',function(){
    $(this).children("span").hide();
  });

  $(document).on('dblclick','.actsname',function(){
    id = $(this).attr('id');
    url = "actrsview.php?a="+id;
    window.open(url,'_blank');
  });

  $(document).on('click','.actsremove',function(){
    $(this).parent().remove();
  });

  function nameAdd(id,val,name){
    act = $('<div id="'+val+'" class="actsname"><div>'+name+'</div><span class="actsremove">x</span></div>');
    act.append('<input type="hidden" name="actress[]" value="'+val+'" />');
    act.appendTo('#'+id+' .actsframe');
    $('#'+id+' .actslist').css('display','none');
    $('#'+id+' .selacts').val("");
  }

  function redirect(url){
	  window.location.replace(url);
  }

</script>
<style type="text/css">
	form {
		padding: 5px;
		margin: 10px;
    border-radius: 5px;
	}

  .color0 {
    background-color: #C9C9C9;
	}

	.color1 {
		background-color: #33FF66;
	}

  .color2 {
    background-color: #FFCC66;
  }

  .color3 {
    background-color: #FF1414;
  }

	.atb {
    padding: 5px;
	}

  .atb tr {
    height: 30px;
  }

  .atb td {
    background-color: #FFFFFF;
    padding: 0px 5px 0px 5px;
    border-radius: 5px;
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
    display: inline-block;
    text-align: center;
  }

  input[type="button"],input[type="submit"] {
    padding-left: 6px;
    color: #800000;
    background: -webkit-linear-gradient(#C0C0C0,#A3A3A3);
    border-radius: 3px;
  }

  .loader {
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

  .actsframe {
    width: 250px;
    height: 120px;
    overflow-y: scroll;
    overflow-x: hidden;
    border: 0px;
    margin: 0px;
    padding: 5px;
  }

  .actsname {
    display: block;
    border: 0px;
    margin: 0px;
    padding: 0px;
  }

  .actsname div {
    color: #0E1838;
    padding: 0px;
    padding-left: 10px;
    width: 200px;
    border: 1px solid #FFFFFF;
    display: inline-block;
  }

  .actsname div:hover {
    color: #7A0000;
    cursor: pointer;
    border: 1px solid #CCCCCC;
    border-radius: 8px;
  }

  .actsname span {
    cursor: pointer;
    padding: 0px;
    display: none;
  }

  .btnJavlib {
    margin: 0px;
    padding: 0px;
  }

  ::-webkit-scrollbar {
    width: 12px;
  }

  ::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    border-radius: 10px;
  }

  ::-webkit-scrollbar-thumb {
    border-radius: 10px;
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.5);
  }

</style>
</head>
<figure id="topbox"></figure>
<div id="backbox"></div>

<div id="pageNavi">

Result: <?php echo $_smarty_tpl->tpl_vars['num']->value;?>
 Movies
&nbsp;&nbsp;&nbsp;

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

Display&nbsp;
<select id="selLimit">
	<?php echo smarty_function_html_options(array('output'=>$_smarty_tpl->tpl_vars['limits']->value,'values'=>$_smarty_tpl->tpl_vars['limits']->value,'selected'=>$_smarty_tpl->tpl_vars['limit']->value),$_smarty_tpl);?>

</select>
/Page
&nbsp;&nbsp;&nbsp;

</div>

<div>

<?php  $_smarty_tpl->tpl_vars['mov'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['mov']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['amovs']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['mov']->key => $_smarty_tpl->tpl_vars['mov']->value){
$_smarty_tpl->tpl_vars['mov']->_loop = true;
?>
<form class="color<?php echo $_smarty_tpl->tpl_vars['mov']->value['have'];?>
" id="<?php echo $_smarty_tpl->tpl_vars['mov']->value['id'];?>
" method="post" action="bp_amovsave.php" target="frmHidden">
	<table class="atb" cellspacing="3">
  <tr>
  	<td rowspan="6"><img class="cvd" src="bp_picture.php?covers=<?php echo $_smarty_tpl->tpl_vars['mov']->value['cover'];?>
" id="<?php echo $_smarty_tpl->tpl_vars['mov']->value['cover'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['mov']->value['cvinfo'];?>
" /></td>
  	<td>
      Code: <a href="amovedit.php?i=<?php echo $_smarty_tpl->tpl_vars['mov']->value['id'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['mov']->value['code'];?>
</a>&nbsp;
      <input type="image" class="btnJavlib" value="<?php echo $_smarty_tpl->tpl_vars['mov']->value['code'];?>
" src="html/images/javlib_button.png" />
    </td>
    <td>ID: <?php echo $_smarty_tpl->tpl_vars['mov']->value['id'];?>
<input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['mov']->value['id'];?>
" /></td>
    <td>Region: <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['opt_region']->value,'name'=>"region",'selected'=>$_smarty_tpl->tpl_vars['mov']->value['region']),$_smarty_tpl);?>
</td>
    <td rowspan="5">
    	Actress<br />
      <div id="<?php echo $_smarty_tpl->tpl_vars['mov']->value['id'];?>
" class="actsframe">
      <?php if ($_smarty_tpl->tpl_vars['mov']->value['actress']!=''){?>
    	<?php  $_smarty_tpl->tpl_vars['actr'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['actr']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['mov']->value['actress']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['actr']->key => $_smarty_tpl->tpl_vars['actr']->value){
$_smarty_tpl->tpl_vars['actr']->_loop = true;
?>
    		<div id="<?php echo $_smarty_tpl->tpl_vars['actr']->key;?>
" class="actsname">
          <div><?php echo $_smarty_tpl->tpl_vars['actr']->value;?>
</div>
          <span class="actsremove">x</span>
          <input type="hidden" name="actress[]" value="<?php echo $_smarty_tpl->tpl_vars['actr']->key;?>
" />
        </div>
    	<?php } ?>
    	<?php }?>
      </div>
      <input type="text" class="selacts" id="<?php echo $_smarty_tpl->tpl_vars['mov']->value['id'];?>
" value="" size="20"/>
      <div class="actslist" id="<?php echo $_smarty_tpl->tpl_vars['mov']->value['id'];?>
"></div>
      <input type="button" value="+" class="btAdd" id="<?php echo $_smarty_tpl->tpl_vars['mov']->value['id'];?>
" />
      <img src="html/images/loader.gif" class="loader" id="<?php echo $_smarty_tpl->tpl_vars['mov']->value['id'];?>
"/>
    </td>
  </tr>
  <tr>
  	<td colspan="3">Title: <input type="text" name="title" value="<?php echo $_smarty_tpl->tpl_vars['mov']->value['title'];?>
" size="50" /></td>
  </tr>
  <tr>
  	<td colspan="3">Title2: <input type="text" name="title2" value="<?php echo $_smarty_tpl->tpl_vars['mov']->value['title2'];?>
" size="50" /></td>
  </tr>
  <tr>
    <td colspan="3">Genre: <input type="text" name="genre" value="<?php echo $_smarty_tpl->tpl_vars['mov']->value['genre'];?>
" size="50" /></td>
  </tr>
  <tr>
  	<td>Studio: <input type="text" value="<?php echo $_smarty_tpl->tpl_vars['mov']->value['studio'];?>
" name="studio" size="10" /></td>
    <td>Label: <input type="text" value="<?php echo $_smarty_tpl->tpl_vars['mov']->value['label'];?>
" name="label" size="10" /></td>
    <td>Release: <input type="date" name="reldate" value="<?php echo $_smarty_tpl->tpl_vars['mov']->value['reldate'];?>
" /></td>
  </tr>
  <tr>
    <td>Status: <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['opt_have']->value,'name'=>"have",'selected'=>$_smarty_tpl->tpl_vars['mov']->value['have']),$_smarty_tpl);?>
</td>
    <td>Score: <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['opt_score']->value,'name'=>"score",'selected'=>$_smarty_tpl->tpl_vars['mov']->value['score']),$_smarty_tpl);?>
</td>
    <td>File: <?php echo $_smarty_tpl->tpl_vars['mov']->value['vdo'];?>
 Movie(s)</td>
    <td>&nbsp;
      <img src="html/images/save.png" id="btSave" />&nbsp;
      <img src="html/images/lock.png" id="btLock" />&nbsp;
      <img src="html/images/cancel.png" id="btCancel" />&nbsp;
      <input type="submit" name="submit" value="SAVE" />
    </td>
  </tr>
  </table>
</form>
<?php } ?>

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

</div>

<iframe frameborder="0" style="width: 1000px; height: 0px" name="frmHidden"></iframe>


<?php }} ?>