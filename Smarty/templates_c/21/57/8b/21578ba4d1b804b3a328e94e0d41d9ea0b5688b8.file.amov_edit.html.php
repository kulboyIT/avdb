<?php /* Smarty version Smarty-3.1.11, created on 2016-07-06 20:29:34
         compiled from "html\amov_edit.html" */ ?>
<?php /*%%SmartyHeaderCode:4888577d07be6449d7-01047204%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '21578ba4d1b804b3a328e94e0d41d9ea0b5688b8' => 
    array (
      0 => 'html\\amov_edit.html',
      1 => 1411805989,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4888577d07be6449d7-01047204',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'mov' => 0,
    'opt_have' => 0,
    'opt_region' => 0,
    'opt_score' => 0,
    'actr' => 0,
    'vdo' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_577d07bf17b9e1_66259260',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_577d07bf17b9e1_66259260')) {function content_577d07bf17b9e1_66259260($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include 'D:\\wamp\\www\\avdb\\Smarty\\libs\\plugins\\function.html_options.php';
?><head>
<script src="simpleUpload.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		
		$("#backbox").click(function(){
			$("#topbox").fadeOut(100,function(){
			  $("#topbox").html("");
			  $("#backbox").hide(1);
			});
		});

    $("#inName").keyup(function(){
      var val = $(this).val();
      if(val.length > 1){
        $(".loader").css('display','inline-block');
        val = encodeURIComponent(val);
        $("#selList").load('bp_searchavname.php?result=edit&search='+val,function(res,status,xhr){
          //alert(xhr.statusText+'\n'+res);
          $(this).css('display','block');
          $(".loader").css('display','none');
        });
      }else{
        $("#selList").css('display','none');
        $(".loader").css('display','none');
      }
    });

    $("#btAdd").click(function(){
      val = $("#inName").val();
      if(val == null || val == ''){
        alert("Plese input name");
      }else{
        val = encodeURIComponent(val);
        $.post("bp_addavname.php",{name: val},function(res){
          r = res.split(";");
          if(r[0] == 'OK'){
            nameAdd(r[1],r[2]);
            $("#inName").val("");
          }else{
            alert(r[1]);
          }
        });
      }
    });

    $("#btnEditCode").click(function(){
      code = prompt("Edit Movie Code","<?php echo $_smarty_tpl->tpl_vars['mov']->value['code'];?>
");
      if(code != "" && code != null){
        //alert(code);
        $("#newcode").val(code);
        $("#frmMain").prop("action","bp_editcode.php");
        $("#frmMain").submit();
      }
    });

    $("input[type='text']").focus(function(){
      $(this).css('background','#F7F7F7');
    });

    $("input[type='text']").blur(function(){
      $(this).css('background','transparent');
    });

    $('#upCover').simpleUpload({
      url: 'bp_uploadcover.php?amovid=<?php echo $_smarty_tpl->tpl_vars['mov']->value['id'];?>
',
      trigger: '#btnUpCover',
      types: ['jpg', 'jpeg', 'png'],
      size: 1024,
      success: function(cid){
        //alert(cid);
        img = $("<img src='bp_picture.php?coverm="+cid+"' id='"+cid+"' />");
        $("#imgCover").empty();
        $("#imgCover").append(img);
        img.addClass('cvd');
      },
      error: function(erro){
        if(error.type == 'fileType') alert('Invalid File Type.');
      }
    });

    $('#btnClose').click(function(){
      window.close();
    });

    $('#btnUpdate').click(function(){
      redirect('amovupdate.php?i=<?php echo $_smarty_tpl->tpl_vars['mov']->value['id'];?>
');
    });

    $("#btnJavlib").click(function(){
      <?php if ($_smarty_tpl->tpl_vars['mov']->value['javlib']==''){?>
      url = "http://www.javlibrary.com/en/vl_searchbyid.php?keyword=<?php echo $_smarty_tpl->tpl_vars['mov']->value['code'];?>
";
      <?php }else{ ?>
      url = "<?php echo $_smarty_tpl->tpl_vars['mov']->value['javlib'];?>
";
      <?php }?>
      window.open(url,'_blank');
    });

	});

  $(document).on('click','.cvd',function(){
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

  function nameAdd(val,name){
    act = $('<div id="'+val+'" class="actsname"><div>'+name+'</div><span class="actsremove">x</span></div>');
    act.append('<input type="hidden" name="actress[]" value="'+val+'" />');
    act.appendTo("#actsframe");
    $("#selList").css('display','none');
    $("#inName").val("");
  }

  function redirect(url){
	  window.location.replace(url);
  }

</script>
<style type="text/css">
	#frmMain {
	  width: 1000px;
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

	img {
		border: 0px;
		margin: 0px;
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

  #inName {
    width: 200px;
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

  .vdolist {
    border-collapse: collapse;
    border: 1px solid #6E6E6E;
    margin: 5px;
  }

  .vdolist td {
    font-size: 14px;
    border: 1px solid #6E6E6E;
  }

  span {
    color: #0C17E9;
    margin: 5px;
    padding: 5px;
  }

  #actsframe {
    width: 300px;
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
    width: 230px;
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

<div>

<form class="color<?php echo $_smarty_tpl->tpl_vars['mov']->value['have'];?>
" id="frmMain" method="post" action="bp_amovsave.php" target="frmHidden">
  <input type="hidden" name="newcode" id="newcode" value="" />
  <input type="hidden" name="code" value="<?php echo $_smarty_tpl->tpl_vars['mov']->value['code'];?>
" />
	<table class="atb" cellspacing="3">
  <tr>
  	<td colspan="2">Title: <input type="text" name="title" value="<?php echo $_smarty_tpl->tpl_vars['mov']->value['title'];?>
" size="100" /></td>
  </tr>
  <tr>
  	<td colspan="2">Title2: <input type="text" name="title2" value="<?php echo $_smarty_tpl->tpl_vars['mov']->value['title2'];?>
" size="100" /></td>
  </tr>
  <tr>
    <td rowspan="11" id="imgCover">
      <img class="cvd" src="bp_picture.php?coverm=<?php echo $_smarty_tpl->tpl_vars['mov']->value['cover'];?>
" id="<?php echo $_smarty_tpl->tpl_vars['mov']->value['cover'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['mov']->value['cvinfo'];?>
" />
    </td>
  	<td width="400">
      Code: <?php echo $_smarty_tpl->tpl_vars['mov']->value['code'];?>

      <input type="image" src="html/images/b_edit.png" id="btnEditCode" />
      <input type="image" src="html/images/javlib_button.png" id="btnJavlib" />
    </td>
  </tr>
  <tr>
    <td>
      ID: <?php echo $_smarty_tpl->tpl_vars['mov']->value['id'];?>
<input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['mov']->value['id'];?>
" />
      (Update: <?php echo $_smarty_tpl->tpl_vars['mov']->value['edit_date'];?>
)
    </td>
  </tr>
  <tr>
    <td>Genre: <input type="text" value="<?php echo $_smarty_tpl->tpl_vars['mov']->value['genre'];?>
" name="genre" /></td>
  </tr>
  <tr>
    <td>Studio: <input type="text" value="<?php echo $_smarty_tpl->tpl_vars['mov']->value['studio'];?>
" name="studio" /></td>
  </tr>
  <tr>
    <td>Label: <input type="text" value="<?php echo $_smarty_tpl->tpl_vars['mov']->value['label'];?>
" name="label" /></td>
  </tr>
  <tr>
    <td>Status: <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['opt_have']->value,'name'=>"have",'selected'=>$_smarty_tpl->tpl_vars['mov']->value['have']),$_smarty_tpl);?>
</td>
  </tr>
  <tr>
    <td>Region: <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['opt_region']->value,'name'=>"region",'selected'=>$_smarty_tpl->tpl_vars['mov']->value['region']),$_smarty_tpl);?>
</td>
  </tr>
  <tr>
  	<td>Release: <input type="date" name="reldate" value="<?php echo $_smarty_tpl->tpl_vars['mov']->value['reldate'];?>
" /></td>
  </tr>
  <tr>
    <td>Score: <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['opt_score']->value,'name'=>"score",'selected'=>$_smarty_tpl->tpl_vars['mov']->value['score']),$_smarty_tpl);?>
</td>
  </tr>
  <tr>
    <td>Cover:
      <input type="file" name="upCover" id="upCover" />
      <input type="button" id="btnUpCover" value="UP" />
    </td>
  </tr>
  <tr>
    <td>
      <input type="submit" name="submit" value="SAVE" />
      <input type="button" id="btnDelete" value="DELETE" />
      <input type="button" id="btnClose" value="CLOSE" />
      <input type="button" id="btnUpdate" value="UPDATE" />
    </td>
  </tr>
  <tr>
    <td><span>Detail</span>
      <textarea name="detail" cols="70" rows="8"><?php echo $_smarty_tpl->tpl_vars['mov']->value['detail'];?>
</textarea>
    </td>
    <td>
    	<span>Actress</span><br/>
      <div id="actsframe">
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
      <input type="text" id="inName" value="" size="18"/>
      <div class="actslist" id="selList"></div>
      <input type="button" value="+" id="btAdd" />
      <img src="html/images/loader.gif" class="loader"/>
    </td>
  </tr>
  <tr><td colspan="2">
    <div style="padding: 8px;">
      <span><?php echo count($_smarty_tpl->tpl_vars['mov']->value['vdos']);?>
 Video File(s)</span>
    </div>
    <table class="vdolist">
      <tr>
        <td></td>
        <td width="100">Filename</td>
        <td width="60">Store</td>
        <td width="60">Duration</td>
        <td width="70">Filesize</td>
        <td width="120">Format</td>
        <td width="80">Resolution</td>
        <td width="90">V-bitrate</td>
        <td width="90">OverAll</td>
        <td width="90">Framerate</td>
        <td width="50">Ratio</td>
      </tr>
      <?php  $_smarty_tpl->tpl_vars['vdo'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['vdo']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['mov']->value['vdos']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['vdo']->key => $_smarty_tpl->tpl_vars['vdo']->value){
$_smarty_tpl->tpl_vars['vdo']->_loop = true;
?>
      <tr>
        <td>
          <img class="rmvdoinfo" src="html/images/housecall_no.gif" alt="Remove Video Info" id="<?php echo $_smarty_tpl->tpl_vars['vdo']->value['id'];?>
" />
        </td>
        <td><?php echo $_smarty_tpl->tpl_vars['vdo']->value['filename'];?>
</td>
        <td><?php echo $_smarty_tpl->tpl_vars['vdo']->value['store'];?>
</td>
        <td><?php echo $_smarty_tpl->tpl_vars['vdo']->value['duration'];?>
</td>
        <td><?php echo $_smarty_tpl->tpl_vars['vdo']->value['filesize'];?>
</td>
        <td><?php echo $_smarty_tpl->tpl_vars['vdo']->value['format'];?>
</td>
        <td><?php echo $_smarty_tpl->tpl_vars['vdo']->value['resolution'];?>
</td>
        <td><?php echo $_smarty_tpl->tpl_vars['vdo']->value['bitrate'];?>
</td>
        <td><?php echo $_smarty_tpl->tpl_vars['vdo']->value['overall'];?>
</td>
        <td><?php echo $_smarty_tpl->tpl_vars['vdo']->value['framerate'];?>
</td>
        <td><?php echo $_smarty_tpl->tpl_vars['vdo']->value['aspect'];?>
</td>
      </tr>
      <?php }
if (!$_smarty_tpl->tpl_vars['vdo']->_loop) {
?>
      <tr><td colspan="11">NO VIDEO FILE</td></tr>
      <?php } ?>
    </table>
  </td></tr>
  </table>

</form>

</div>
<iframe frameborder="0" style="width: 1000px; height: 0px" name="frmHidden"></iframe>
<?php }} ?>