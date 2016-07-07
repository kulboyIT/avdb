<?php
  include('_header.inc.php');

  $search = "";
  if($_GET['na']){
    $search .= " (fname like '$_GET[na]%' or lname like '$_GET[na]%')";
    $find .= "&na=".$_GET['na'];
  }
  if($_GET['fo']){
    $search .= " follow = '1'";
    $find .= "&fo=".$_GET['fo'];
  }

  if(!empty($search)) $search = "where".$search;

  $sql = "select id,fname,lname,javlibcode,birthdate,size,movies,follow from $cfg->tbacts $search";
  debug($sql);

  $db->query($sql);
  $num = $db->affected_rows();
  debug($num);

  $order = empty($_GET['o'])?'fname':$_GET['o'];
  $sort = empty($_GET['r'])?'asc':$_GET['r'];
  $page = empty($_GET['p'])?'0':$_GET['p'];

  if($num > 0){
  	$pages = $fnc->page_max($num,15);
  	$lastpage = count($pages) - 1;
  	$page = ($page>$lastpage)?$lastpage:$page;
  	$start = $fnc->start_row($page,15);

  	$sql .= " order by $order $sort limit $start,15";
  	debug($sql);
  	if($rs = $db->query($sql)){
  		while($r = $db->fetch_assoc($rs)){
        $r['name'] = $r['fname'].' '.$r['lname'];
				$r['age'] = date("Y") - date("Y",strtotime($r['birthdate']));
  			$actrs[] = $r;
  		}
  		$sm->assign("num",$num);
  		$sm->assign("page",$page);
      $sm->assign("pages",$pages);
  		$sm->assign("lastpage",$lastpage);
  		$sm->assign("order",$order);
  		$sm->assign("sort",$sort);
  		$sm->assign("actrs",$actrs);
  	}
  }
  $sm->assign("find",$find);
  $sm->assign("orders",array("id"=>"ID","fname"=>"Name","birthdate"=>"Birth Date","movies"=>"Movie(s)","edit_date"=>"Update"));
  $sm->assign("sorts",array('asc'=>'Less than(Older)','desc'=>'More than(Later)'));

  $html = "actrs_list.html";

  $sm->display($html);

  include('_footer.inc.php');
?>