<?php
  include('_header.inc.php');

  $fnc->timeProbeStart();

  if($_GET['submit'] == 'ADD'){
    $code = strtoupper(trim($_GET['code']));
    $keycode = substr($code,0,strpos($code,'-'));
    $sql = "select id from $cfg->tbamov where code='$code'";
    $rs = $db->query($sql);
    if($db->affected_rows() > 0){
      debug('this movie is in database.');
      $id = $db->fetch_result($rs);
    }else{
			
      $fnc->timeProbe("Add new movie $code ");
			
      if($_GET['manual']=='MANUAL'){
        debug('user select manual add.');
        $sql = "insert into $cfg->tbamov (code,region,cover,reldate,have,score,keycode,edit_date) values ('$code','3','1','2000-01-01','0','5','$keycode',NOW())";
        if($db->query($sql)){
          $id = $db->insert_id();
        }
      }else{
        debug('get detail on javlibrary.');
        $javlib = "http://www.javlibrary.com/en/vl_searchbyid.php?keyword=$code";

        $fnc->timeProbe("Start geting... $javlib ");

        if($mov = $fnc->getJavLib($javlib)){

          $fnc->timeProbe('Get DONE ');

          $cover_id = '1';

          $fnc->timeProbe('find pic in DB ');

          $sql = "select id from $cfg->tbpic where code='$code' and cate='cv'";
          $rs = $db->query($sql);
          if($db->affected_rows() > 0){

            $fnc->timeProbe('found cover in db ');

            $cover_id = $db->fetch_result();
          }else{

            $fnc->timeProbe('not found cover in db ');

            if(!empty($mov['img_url'])){

              $fnc->timeProbe("collect info $mov[img_url] ");

              $exten = pathinfo($mov['img_url'], PATHINFO_EXTENSION);
              list($width, $height) = getimagesize($mov['img_url']);
              $content = addslashes(file_get_contents($mov['img_url']));
              $sql = "insert into $cfg->tbpic (code,cate,type,width,height,picdata,editdate) values('$code','cv','$exten','$width','$height','$content',NOW())";
              //debug($sql);

              $fnc->timeProbe("inserting image to DB ");

              if($db->query($sql)){
                $cover_id = $db->insert_id();

                $fnc->timeProbe("insert image DONE ");

              }
            }
          }
          if(!empty($mov['actress_name'])) $title2 = $mov['actress_name'];
          $title = addslashes($mov['title']);
          $sql = "insert into $cfg->tbamov (code,title,title2,region,actress,genre,studio,label,cover,reldate,have,score,keycode,edit_date,javlib) values ('$code','$title','$title2','3','$mov[actress]','$mov[genre]','$mov[studio]','$mov[label]','$cover_id','$mov[reldate]','0','5','$keycode',NOW(),'$mov[javlib]')";
        }else{

          $fnc->timeProbe('Get FAIL ');

          $sql = "insert into $cfg->tbamov (code,region,cover,reldate,have,score,keycode,edit_date) values ('$code','3','1','2000-01-01','0','5','$keycode',NOW())";
        }
        debug($sql);
        if($db->query($sql)) $id = $db->insert_id();

        $fnc->timeProbe('insert new movie DONE ');

      }
    }
    header("location: amovedit.php?i=$id");
    echo "<a href='amovedit.php?i=$id'>NEXT</a>";
  }

  $html = "amov_new.html";
  $sm->display($html);

  include('_footer.inc.php');
?>