<?php /* Smarty version Smarty-3.1.11, created on 2016-06-11 04:13:20
         compiled from "html\filesput_list.html" */ ?>
<?php /*%%SmartyHeaderCode:29159575b73c0c7e829-53432266%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '992d922380d65f88675accd9b10b7d522454da64' => 
    array (
      0 => 'html\\filesput_list.html',
      1 => 1408004881,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '29159575b73c0c7e829-53432266',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'store' => 0,
    'path' => 0,
    'actid' => 0,
    'dirs' => 0,
    'dir' => 0,
    'actress' => 0,
    'files' => 0,
    'file' => 0,
    'types' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_575b73c133f697_09336066',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_575b73c133f697_09336066')) {function content_575b73c133f697_09336066($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include 'D:\\wamp\\www\\avdb\\Smarty\\libs\\plugins\\function.html_options.php';
?><style type="text/css">
  .list {                                                  
    font-size: 14px;
    border: 0px;
    border-collapse: collapse;
    margin: 5px;
  }

  .list th,td {
    padding: 2px 5px 2px 5px;
    border: 1px #666666;
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

  input[type='text'], select {
    font-family : "Courier New","Lucida Console",Tahoma;
    font-size: 14px;
    margin: 0px;
    padding-left: 3px;
    border: 0;
    background: transparent;
  }

</style>

<script type="text/javascript">
  $(document).ready(function(){

    $("input[type='text']").focus(function(){
      $(this).css('background','#F7F7F7');
    });

    $("input[type='text']").blur(function(){
      $(this).css('background','transparent');
    });

    $("input[type='checkbox']").click(function(){
      $(this).parent().parent().toggleClass('cancle');
    });

  });
</script>

<form action="filesput.php" method="get">
  Store:<input type="text" name="store" value="<?php echo $_smarty_tpl->tpl_vars['store']->value;?>
" />&nbsp;
  Path:<input type="text" name="path" value="<?php echo $_smarty_tpl->tpl_vars['path']->value;?>
" />&nbsp;
  Actress:<input type="text" name="actid" value="<?php echo $_smarty_tpl->tpl_vars['actid']->value;?>
" />&nbsp;
  <input type="submit" name="submit" value="submit" />
</form>

<?php  $_smarty_tpl->tpl_vars['dir'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['dir']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['dirs']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['dir']->key => $_smarty_tpl->tpl_vars['dir']->value){
$_smarty_tpl->tpl_vars['dir']->_loop = true;
?>
<a href="filesput.php?store=<?php echo $_smarty_tpl->tpl_vars['store']->value;?>
&path=<?php echo $_smarty_tpl->tpl_vars['dir']->value;?>
&actid=<?php echo $_smarty_tpl->tpl_vars['actid']->value;?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['dir']->key;?>
</a>&nbsp;
<?php } ?>
<form action="filesput.php" method="post">
<?php echo $_smarty_tpl->tpl_vars['actress']->value;?>

<input type="hidden" name="store" value="<?php echo $_smarty_tpl->tpl_vars['store']->value;?>
" />
<input type="hidden" name="actid" value="<?php echo $_smarty_tpl->tpl_vars['actid']->value;?>
" />
<input type="hidden" name="path" value="<?php echo $_smarty_tpl->tpl_vars['path']->value;?>
" />  
<table class="list">
<tr>
  <th colspan="2">CODE</th>
  <th>EXTEN</th>
  <th>TYPE</th>
  <th>INFO</th>
  <th>DBINFO</th>
  <th>FILENAME</th>
</tr>
<?php  $_smarty_tpl->tpl_vars['file'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['file']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['files']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['file']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['file']->key => $_smarty_tpl->tpl_vars['file']->value){
$_smarty_tpl->tpl_vars['file']->_loop = true;
 $_smarty_tpl->tpl_vars['file']->iteration++;
?>
<tr class="<?php if ($_smarty_tpl->tpl_vars['file']->value['checked']=='chk'){?><?php echo $_smarty_tpl->tpl_vars['file']->value['ftype'];?>
<?php }else{ ?>cancle<?php }?>">
  <td>[<?php echo $_smarty_tpl->tpl_vars['file']->iteration;?>
]<input type="checkbox" name="fcheck[<?php echo $_smarty_tpl->tpl_vars['file']->iteration;?>
]" value="x" <?php if ($_smarty_tpl->tpl_vars['file']->value['checked']=='chk'){?>checked <?php }?>/></td>
  <td>
    <input type="text" name="fcode[<?php echo $_smarty_tpl->tpl_vars['file']->iteration;?>
]" id="txtCode" value="<?php echo $_smarty_tpl->tpl_vars['file']->value['fcode'];?>
" size="15"/>
  </td>
  <td>
    <input type="text" name="fext[<?php echo $_smarty_tpl->tpl_vars['file']->iteration;?>
]" id="txtExt" value="<?php echo $_smarty_tpl->tpl_vars['file']->value['fexten'];?>
" size="5"/>
  </td>
  <td>
    <?php echo smarty_function_html_options(array('name'=>"ftype[".((string)$_smarty_tpl->tpl_vars['file']->iteration)."]",'id'=>"ftype",'options'=>$_smarty_tpl->tpl_vars['types']->value,'selected'=>$_smarty_tpl->tpl_vars['file']->value['ftype']),$_smarty_tpl);?>

  </td>
  <td><?php echo $_smarty_tpl->tpl_vars['file']->value['finfo'];?>
</td>
  <td><?php echo $_smarty_tpl->tpl_vars['file']->value['dbinfo'];?>
</td>
  <td>
    <input type="text" name="fname[<?php echo $_smarty_tpl->tpl_vars['file']->iteration;?>
]" id="txtName" value="<?php echo $_smarty_tpl->tpl_vars['file']->value['fname'];?>
" size="60" />
  </td>
</tr>
<?php } ?>
</table>
<input type="submit" name="submit" value="Process" />
</form>
<?php }} ?>