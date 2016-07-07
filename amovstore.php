<?php
  include('_header.inc.php');

	$store = strtoupper($_GET['st']);
	$find = "st=$store";
	$sql = "SELECT * FROM $cfg->tbamov, (SELECT CODE FROM $cfg->tbavdo WHERE store='$store' GROUP BY CODE) AS avdo WHERE $cfg->tbamov.code = avdo.code";
  debug($sql);

  $db->query($sql);
  $num = $db->affected_rows();
  debug($num);

  $order = empty($_GET['o'])?'reldate':$_GET['o'];
  $sort = empty($_GET['r'])?'desc':$_GET['r'];
  $page = empty($_GET['p'])?'0':$_GET['p'];
  $ipp = empty($_GET['l'])?$cfg->ipp:$_GET['l'];
  $view = empty($_GET['v'])?'list':$_GET['v'];

  if($num > 0){
  	$pages = $fnc->page_max($num,$ipp);
  	$lastpage = count($pages) - 1;
  	$page = ($page>$lastpage)?$lastpage:$page;
  	$start = $fnc->start_row($page,$ipp);

  	$sql .= " order by $order $sort limit $start,$ipp";
  	debug($sql);
  	if($rs = $db->query($sql)){
  		while($r = $db->fetch_assoc($rs)){
  		  if($view=='list') $r['region'] = $cfg->optRegion[$r['region']];

        if($view != 'thumb' && $r['actress'] != ""){
          unset($actrss);
    			$actrs = explode(",",str_replace(array("[","]"),"",$r['actress']));
    			foreach($actrs as $actr){
    			  if($view=='list'){
              $actrss .= "<a href='actrsview.php?a=$actr' target='_blank'>".$fnc->getActrsName($actr).'</a>, ';
    			  }else{
              $actrss[$actr] = $fnc->getActrsName($actr);
    			  }
    			}
          $r['actress'] = $actrss;
    		}

        if($view=='detail') $r['vdo'] = $fnc->getAvdoCount($r['code']);

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
  $sm->assign("order",$order);
  $sm->assign("sort",$sort);
  $sm->assign("limit",$ipp);
  $sm->assign("find",$find);
  $sm->assign("opt_region",$cfg->optRegion);
  $sm->assign("opt_have",$cfg->optHave);
  $sm->assign("opt_uncen",$cfg->optUncen);
  $sm->assign("opt_score",range(0,10));
  $sm->assign("views",array('list'=>'List','thumb'=>'Thumb','detail'=>'Detail'));
  $sm->assign("orders",array("id"=>"ID","code"=>"Code","title"=>"Title","reldate"=>"Release Date","edit_date"=>"Update"));
  $sm->assign("sorts",array('asc'=>'Less than(Older)','desc'=>'More than(Later)'));
  $sm->assign("limits",range(10,60,10));

  $html = "amov_view_$view.html";

  $sm->display($html);

  include('_footer.inc.php');
?>