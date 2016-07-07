<?php
  include('_header.inc.php');

  $view = $_GET['v']?$_GET['v']:'list';
  $key = empty($_GET['k'])?'#':$_GET['k'];
  $k = $key=='#'?'1-9':$key;
  $sql = "SELECT keycode, COUNT(keycode) AS num FROM $cfg->tbamov WHERE keycode REGEXP '^[$k]' GROUP BY keycode";
  debug($sql);
  $rs = $db->query($sql);
  while($r = $db->fetch_assoc($rs)) $group[$r['keycode']] = $r['num'];

  $char = range('A','Z');
  $char[] = '#';
  $sm->assign('views',array('list','thumb','detail'));
  $sm->assign('view',$view);
  $sm->assign('key',$key);
  $sm->assign('group',$group);
  $sm->assign('char',$char);
  $html = "group_view.html";

  $sm->display($html);

  include('_footer.inc.php');
?>