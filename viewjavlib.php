<?php
  include('_header.inc.php');

  $view = $_GET['v']?$_GET['v']:'newrelease';
  $page = $_GET['p']?$_GET['p']:'1';

  if($view=='key'){
    $vl = "vl_searchbyid.php?&keyword=$_GET[k]";
    $va = "?v=$view&k=$_GET[k]&p=";
  }elseif($view=='star'){
    $vl = "vl_$view.php?s=$_GET[a]&mode=2";
    $va = "?v=$view&a=$_GET[a]&p=";
    $actid = $fnc->getActrsId('',$_GET['a']);
  }else{
    $vl = "vl_$view.php?";
    $va = "?v=$view&p=";
  }

  $getfrom = urldecode("http://www.javlibrary.com/en/$vl"."&page=$page");

  debug("GET URL: ".$getfrom);

  if($cont = file_get_contents($getfrom)){

    $lines = explode(chr(13),$cont);

    foreach($lines as $line){
      if(strpos($line,'class="video"')){
        $vlns = trim(strip_tags($line,'<div><img>'));
        break;
			}
		}
    $vlns = array_filter(explode('<div class="video"',$vlns));
    foreach($vlns as $ln){
      $l = trim(strip_tags($ln,'<img>'));

      $code = substr($l,0,strpos($l,'<'));
      $mov['code'] = substr($code,strpos($code,'>')+1);

      $pic = substr($l,strpos($l,'<'));
      $pic = substr($pic,0,strpos($pic,'>')+1);
      preg_match('/(alt|title|src)=("[^"]*")/i',$pic, $img);
			$mov['pic'] = str_replace('"','',$img[2]);

      $mov['dbid'] = $fnc->getdbMov($mov['code']);
      debug($mov['dbid']);
      if($mov['dbid']){
        $mov['have'] = $fnc->getdbMov($mov['code'],'have');
        if($view == 'star'){
          $dbmsg = "$mov[code]: Update actress -> ";
          if($fnc->setMovActrs($mov['dbid'],$actid)){
            $dbmsg .= 'OK';
          }else{
            $dbmsg .= 'FAIL';
          }
        }
        debug($dbmsg);
      }else{
        $mov['have'] = '5';
      }

      //echo "$mov[code] \n<br/> $mov[pic] \n<br/>";
      $movs[] = $mov;
    }

  }

  $optView = array("update"=>'New Comments',"newrelease"=>'New Releases',"newentries"=>'New Entries',"mostwanted"=>'Most Wanted',"bestrated"=>'Best Rated');
  $sm->assign('optView',$optView);
  $sm->assign('pages',range(1,50));
  $sm->assign('view',$view);
  $sm->assign('vl',$vl);
  $sm->assign('va',$va);
  $sm->assign('page',$page);
  $sm->assign('movs',$movs);

  $sm->display('viewjavlib.html');

  include('_footer.inc.php');
?>
