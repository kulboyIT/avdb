<?php
  include('_header.inc.php');

  $search = "";
  if($_GET['ct']){
    $search .= " (code like '$_GET[ct]%' or title like '$_GET[ct]%')";
    $find .= "&ct=".$_GET['ct'];
  }
  if($_GET['co']){
    if(!empty($search)) $search .= " and";
    $search .= " code like '$_GET[co]%'";
    $find .= "&co=".$_GET['co'];
  }
  if($_GET['ac']){
    if(!empty($search)) $search .= " and";
    $search .= " actress like '%[$_GET[ac]]%'";
    $find .= "&ac=".$_GET['ac'];
  }

  $display = empty($_GET['d'])?'0':$_GET['d'];
  if($display == '1'){
    if(!empty($search)) $search .= " and";
    $search .= "have != '2' and javlib is null";
  }

  if(!empty($search)) $search = "where".$search;

  $sql = "select id,code,actress,have,javlib from $cfg->tbamov $search";
  debug($sql);

  $db->query($sql);
  $num = $db->affected_rows();
  debug($num);

  $page = empty($_GET['p'])?'0':$_GET['p'];
  $force = $_GET['update'];

  if($num > 0){
  	$pages = $fnc->page_max($num,30);
  	$lastpage = count($pages) - 1;
  	$page = ($page>$lastpage)?$lastpage:$page;
  	$start = $fnc->start_row($page,30);

  	$sql .= " order by id limit $start,30";
  	debug($sql);
  	if($rs = $db->query($sql)){
  		while($r = $db->fetch_assoc($rs)){
  		  $code = $r['code'];
  		  if(empty($r['javlib']) || $update == 'FORCE'){
          if($r['actress']!=""){
            $r['actress'] = explode(",",$r['actress']);
          }else{
            $r['actress'] = array();
          }

          $javlib = "http://www.javlibrary.com/en/vl_searchbyid.php?keyword=$code";
          debug('get detail on javlibrary: '.$javlib);
          $cont = file_get_contents($javlib);

          $lines = explode(chr(13),$cont);
          $key != 'NONE';
          $mov = array();
          $jav_url = '';
          $title = '';
          $title2 = '';
          foreach($lines as $line){
            if(strpos($line,'rel="canonical"')){
              preg_match('/(href)=("[^"]*")/i',$line, $jav_url);
              $jav_url = trim(str_replace('"','',$jav_url[2]));
            }
            if(strpos($line,'id="video_title"')){
              $title = trim(str_replace($code,'',strip_tags($line)));
            }
            if($key != 'NONE'){
              if($key != 'actress' && $key != 'genre'){
                $mov[$key] = trim(str_replace('&nbsp;','',strip_tags($line)));
              }else{
                $tags = trim(strip_tags($line,'<a>'));
                $tags = split('</a>',$tags);
                $dat = '';
                foreach($tags as $tag){
                  if(!empty($tag)){
                    $tag = substr($tag,strpos($tag,'>')+1);
                    $dat .= trim($tag).',';
                  }
                }
                $mov[$key] = substr($dat,0,-1);
              }
              $key = 'NONE';
            }
            //if(strpos($line,'ID:')) $key = 'code';
            if(strpos($line,'Release Date:')) $key = 'reldate';
            if(strpos($line,'Maker:')) $key = 'studio';
            if(strpos($line,'Label:')) $key = 'label';
            if(strpos($line,'Genre(s):')) $key = 'genre';
            if(strpos($line,'Cast:')) $key = 'actress';
          }
          if(!empty($jav_url)){
            $actress = array();
            if(!empty($mov['actress'])){
              debug($mov['actress']);
              $title2 = $mov['actress'];
              $acts = split(',',$mov['actress']);
              foreach($acts as $act){
                $aid = $fnc->getActrsId($act);
                if($aid) $actress[] = "[$aid]";
              }
            }
            $actress = array_merge($r['actress'],$actress);
            $actress = array_unique($actress);
            $mov['actress'] = implode(',',$actress);
            $title = addslashes($title);
            $sql = "update $cfg->tbamov set title='$title',title2='$title2',actress='$mov[actress]',genre='$mov[genre]',studio='$mov[studio]',label='$mov[label]',reldate='$mov[reldate]',javlib='$jav_url',edit_date=NOW() where id='$r[id]'";
            debug($sql);
            if($db->query($sql)){
              $mov['result'] = '<span>Update database SUCCESS.</span>';
            }else{
              $mov['result'] = "<span class='error'>Update database FAIL: </span><span class='msg'>$db->error()</span>";
            }
            $mov['id'] = $r['id'];
            $mov['have'] = $r['have'];
            $mov['code'] = $code;
            $mov['title'] = $title;
            $mov['title2'] = $title2;
            $mov['javlib'] = $jav_url;
          }else{
            $mov['id'] = $r['id'];
            $mov['have'] = $r['have'];
            $mov['code'] = $code;
            $mov['notfound'] = 'NOTFOUND';
            $mov['result'] = '<span class="msg">Not found movie in JAV LIBRARY.</span>';
          }
          //sleep(rand(1,6));
  		  }else{
          $mov['id'] = $r['id'];
          $mov['have'] = $r['have'];
          $mov['code'] = $code;
          $mov['notfound'] = 'NOTFOUND';
          $mov['result'] = '<span class="msg">Allready get from JAV LIBRARY.</span>';
  		  }
        $movs[] = $mov;
  		}
      $sm->assign('movs',$movs);
  	}
		$sm->assign("num",$num);
		$sm->assign("page",$page);
    $sm->assign("pages",$pages);
    $sm->assign("display",$display);
    $sm->assign("displays",array('Display all','Hidden allready get'));
		$sm->assign("lastpage",$lastpage);
  }

  $sm->assign("find",$find);

  $html = "amov_view_getjavlib.html";

  $sm->display($html);

  include('_footer.inc.php');
?>