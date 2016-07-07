<?php

  $_sm = new Smarty();
  $_sm->template_dir = THEMES;
  $_sm->config_dir = THEMES;
  $_sm->compile_check	= false;
  $_sm->force_compile	= true;
  $_sm->use_sub_dirs = true;
  $_sm->compile_dir = ROOT."/Smarty/templates_c";
  $_sm->cache_dir	= ROOT."/Smarty/cache";
  $_sm->left_delimiter = '<%';
  $_sm->right_delimiter = '%>';

  //$_sm->assign('NAVI_MENU',$_sm->fetch('html/menu_navi.html'));

  // receive content from page
  global $_work_space;

  $_work_space = ob_get_contents();
  ob_end_clean();//ob_end_flush();

  if($cfg->debug) $_sm->assign('DEBUG_MESSAGE',$debug_msg);

  // SHOW ALL HTML
  $_sm->assign ('BODY_CONTENT' , $_work_space );
  $_sm->display("main.html");

?>