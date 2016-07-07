<?php /* Smarty version Smarty-3.1.11, created on 2016-07-06 20:29:35
         compiled from ".\themes\main.html" */ ?>
<?php /*%%SmartyHeaderCode:8561577d07bf1b88e9-17960228%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1b6dae91cc5750cb0942909316a1d77c3e8c57a9' => 
    array (
      0 => '.\\themes\\main.html',
      1 => 1435163019,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8561577d07bf1b88e9-17960228',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'DEBUG_MESSAGE' => 0,
    'BODY_CONTENT' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_577d07bf3a00e3_70140612',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_577d07bf3a00e3_70140612')) {function content_577d07bf3a00e3_70140612($_smarty_tpl) {?><!DOCTYPE html>
<html>
  <head>
    <title><?php echo @HEAD_TITLE;?>
</title>
    <meta charset="utf-8">
    <script src="jquery-2.1.0.min.js"></script>
    <script src="<?php echo @THEMES;?>
/script.js"></script>
    <link href="<?php echo @THEMES;?>
/styles.css" rel="stylesheet">
    <link href="<?php echo @THEMES;?>
/main.css" rel="stylesheet">
    <script type="text/javascript">
      $(document).ready(function(){
        $("#btnSearch").click(function(){
          f = $("#search").val();
          redirect("amov.php?ct="+f);
        });
      });
    </script>
  </head>
  <body>
    <?php if ($_smarty_tpl->tpl_vars['DEBUG_MESSAGE']->value){?>
    <details id="debug">
      <summary>!!!DEBUG MODE!!!</summary>
      <?php echo $_smarty_tpl->tpl_vars['DEBUG_MESSAGE']->value;?>

    </details>
    <?php }?>

    <div id="container" style="width: 1200px; margin:0 auto;">

      <div id="header">
        <h1><?php echo @WEB_TITLE;?>
</h1>
        <div class="searchbox">
          <img src="<?php echo @THEMES;?>
/images/find_r.jpg" alt="Search Movie from CODE and TITLE" />
          <input type="text" value="" id="search" />
          <input type="button" value="FIND" id="btnSearch" />
        </div>
        <div id='cssmenu'>
          <ul>
           <li class='active'><a href='#'><span>Home</span></a></li>
           <li class='has-sub'><a href='#'><span>AV Movies</span></a>
              <ul>
                 <li><a href='amov.php?v=list'><span>List</span></a></li>
                 <li><a href='amov.php?v=thumb'><span>Thumb</span></a></li>
                 <li><a href='amov.php?v=detail'><span>Detail</span></a></li>
                 <li><a href='amovnewent.php'><span>New Entries</span></a></li>
                 <li class='last'><a href='group.php'><span>Group</span></a></li>
              </ul>
           </li>
					 <li class='has-sub'><a href='#'><span>Store</span></a>
						 <ul>
							<li><a href='amovstore.php?st=HDX01'><span>HDX01</span></a></li>
							<li><a href='amovstore.php?st=HDX02'><span>HDX02</span></a></li>
							<li><a href='amovstore.php?st=HDX03'><span>HDX03</span></a></li>
							<li><a href='amovstore.php?st=HDX04'><span>HDX04</span></a></li>
							<li><a href='amovstore.php?st=HDX05'><span>HDX05</span></a></li>
							<li class='last'><a href='amovstore.php?st=HDX06'><span>HDX06</span></a></li>
						</ul>
					 </li>
           <li class='has-sub'><a href='#'><span>AV Actress</span></a>
              <ul>
                 <li><a href='actrs.php'><span>List</span></a></li>
                 <li class='last'><a href='actrs.php?fo=1'><span>Following</span></a></li>
              </ul>
           </li>
           <li class='has-sub'><a href='#'><span>Tools</span></a>
              <ul>
                 <li><a href='amovnew.php' target='_blank'><span>Add Movie</span></a></li>
                 <li><a href='viewjavlib.php' target='_blank'><span>View JAVLIB</span></a></li> 
                 <li><a href='filesput.php'><span>Import Movies</span></a></li>
                 <li class='last'><a href='actrsupdatemovies.php'><span>Update Actress Movies</span></a></li>
              </ul>
           </li>
           <li class='last'><a href='#'><span>About</span></a></li>
        </ul>
      </div>

      </div>

      <div id="content">
        <?php echo $_smarty_tpl->tpl_vars['BODY_CONTENT']->value;?>

      </div>

      <div id="footer">
        <p align="center">Powered By LuZeFer</p>
      </div>

    </div>

  </body>
</html>
<?php }} ?>