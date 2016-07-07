<?php
  include('_header.inc.php');

  $id = $_GET['i'];

  $sql = "select * from $cfg->tbamov where id = '$id'";
  debug($sql);

	if($rs = $db->query($sql)){
		$r = $db->fetch_assoc($rs);
    if($r['actress']!=""){
      unset($actrss);
			$actrs = explode(",",str_replace(array("[","]"),"",$r['actress']));
			foreach($actrs as $actr){
				$actrss[$actr] = $fnc->getActrsName($actr);
			}
      $r['actress'] = $actrss;
		}
    if(!empty($r['cover'])) $r['cvinfo'] = $fnc->getdbImgInfo($r['cover']);

    $sql = "select * from $cfg->tbavdo where code = '$r[code]'";
    debug($sql);
    $rs = $db->query($sql);
    if($db->affected_rows() > 0){
      while($v = $db->fetch_assoc($rs)){ $vs[] = $v; }
      $r['vdos'] = $vs;
    }

		$sm->assign("mov",$r);
	}

  $sm->assign("opt_region",$cfg->optRegion);
  $sm->assign("opt_have",$cfg->optHave);
  $sm->assign("opt_uncen",$cfg->optUncen);
  $sm->assign("opt_score",range(0,10));    ;

  $html = "amov_edit.html";

  $sm->display($html);

  include('_footer.inc.php');
?>