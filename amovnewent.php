<?php
  include('_header.inc.php');

  $search = "where $cfg->tbamov.code = $cfg->tbavdo.code and have > 0";
  if($_GET['st']){
    $search .= " and $cfg->tbavdo.store = '$_GET[st]'";
    $find .= "&st=".$_GET['st'];
  }

  $sql = "select $cfg->tbamov.* from $cfg->tbamov,$cfg->tbavdo $search";
  debug($sql);

  $db->query($sql);
  $num = $db->affected_rows();
  debug($num);

  $page = empty($_GET['p'])?'0':$_GET['p'];
  $ipp = empty($_GET['l'])?$cfg->ipp:$_GET['l'];
  $view = empty($_GET['v'])?'list':$_GET['v'];

  if($num > 0){
  	$pages = $fnc->page_max($num,$ipp);
  	$lastpage = count($pages) - 1;
  	$page = ($page>$lastpage)?$lastpage:$page;
  	$start = $fnc->start_row($page,$ipp);

  	$sql .= " group by $cfg->tbamov.code order by editdate desc limit $start,$ipp";
  	debug($sql);
  	if($rs = $db->query($sql)){
  		while($r = $db->fetch_assoc($rs)){
  		  if($view=='list'){
          $r['region'] = $cfg->optRegion[$r['region']];
          if($r['actress'] != ''){
            unset($actrss);
      			$actrs = explode(",",str_replace(array("[","]"),"",$r['actress']));
      			foreach($actrs as $actr){
              $actrss .= "<a href='actrsview.php?a=$actr' target='_blank'>".$fnc->getActrsName($actr).'</a>, ';
      			}
            $r['actress'] = $actrss;
          }
  		  }

        if(!empty($r['cover'])) $r['cvinfo'] = $fnc->getdbImgInfo($r['cover']);
  			$amovs[] = $r;
  		}

  		$sm->assign("amovs",$amovs);
  	}
  }

  $sm->assign("num",$num);
  $sm->assign("page",$page);
  $sm->assign("pages",$pages);
  $sm->assign("lastpage",$lastpage);
  $sm->assign("view",$view);
  $sm->assign("limit",$ipp);
  $sm->assign("find",$find);
  $sm->assign("limits",range(10,60,10));
  $sm->assign("views",array('list'=>'List','thumb'=>'Thumb'));

  $html = "amov_view_$view.html";

  $sm->display($html);

  include('_footer.inc.php');
?>