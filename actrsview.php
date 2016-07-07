<?php
  include('_header.inc.php');

  $sql = "select id,fname,lname,jname,javlibcode,nation,birthdate,movies,score,size,follow from $cfg->tbacts where id = '$_GET[a]'";
  debug($sql);

  $rs = $db->query($sql);

  if($db->affected_rows() > 0){
    $actr = $db->fetch_assoc($rs);
    $actr['name'] = $actr['fname'].' '.$actr['lname'];
		$actr['age'] = date("Y") - date("Y",strtotime($actr['birthdate']));

    $sql = "select id,code,cover,have,reldate from $cfg->tbamov where actress like '%[$_GET[a]]%' order by reldate desc";
    $rs = $db->query($sql);
    $movies = $db->affected_rows();
    if($movies > 0){
      while($r = $db->fetch_assoc($rs)){
        if(!empty($r['cover'])) $r['cvinfo'] = $fnc->getdbImgInfo($r['cover']);
        $movs[] = $r;
      }
      $sm->assign("movs",$movs);
    }

    if($actr['movies'] != $movies){
      $sql = "update $cfg->tbacts set movies = '$movies' where id = '$_GET[a]'";
      debug($sql);
      $db->query($sql);
      $actr['movies'] = $movies;
    }
    $sm->assign("actr",$actr);
  }
  $sm->assign("opt_nation",$cfg->optRegion);
  $sm->assign("opt_score",range(0,10));
  $sm->assign("opt_follow",array('UNFOLLOW','FOLLOW'));

  $html = "actrs_view.html";

  $sm->display($html);

  include('_footer.inc.php');
?>