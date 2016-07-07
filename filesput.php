<?php
  include('_header.inc.php');

  $html = 'filesput_list.html';

  if($_GET['path']){
    $path = $_GET['path'];
    $store = $_GET['store'];
    $actid = $_GET['actid'];
    $actress = 'Actress: '.$fnc->getActrsName($actid).'<br/>';

    $vdotype = array('avi','mp4','wmv','mpg','flv','mkv','ram','rm','rmvb','rv','asf','divx','ogm','ts','dat','m4v');
	  $imgtype = array('jpg','png','bmp','gif','jpeg');

    $path = str_replace('\\','/',$path);
    $path = str_replace('//','/',$path);
    if(substr($path,-1,1) != '/') $path .= '/';
    debug($path);

    $pdb = new db_picture($cfg);

    if(is_dir($path)){
      $dh = opendir($path);
      while(false !== ($filename = readdir($dh))){
        unset($file);
        if($filename != "." && $filename != ".."){
          if(is_dir($path.$filename)){
            $dirs[$filename] = $path.$filename;
          }else{
            $info = pathinfo($filename);
            $file['fname'] = $info['basename'];
            $file['fexten'] = strtolower($info['extension']);
            $file['fcode'] = $fnc->substr_code($info['filename']);
            $file['checked'] = 'chk';
            if(in_array(strtolower($info['extension']),$vdotype)){
              $file['ftype'] = 'vdo';
              $file['finfo'] = "<a href='comparevdo.php?store=$store&file=$path$filename' target='_blank'>detail</a>";
              $sql = "select id from $cfg->tbavdo where code='$file[fcode]'";
              debug($sql);
              $rs = $db->query($sql);
              if($db->affected_rows() > 0){
                $file['dbinfo'] = "<a href='comparevdo.php?store=$store&file=$path$filename' target='_blank'>compare</a>";
                $file['checked'] = 'no';
              }
            }else{
              $file['ftype'] = strpos($info['filename'],'_s')?'ss':'cv';
              $finfo = getimagesize($path.$info['basename']);
              $fsize = $fnc->byteprefix(filesize($path.$info['basename']));
              if(strpos($fsize,'MB') > 0) $file['checked'] = 'no';
              if($file['ftype'] == 'ss') $file['checked'] = 'no';
              $file['finfo'] = "W$finfo[0]xH$finfo[1]($fsize)";
              if($pid = $pdb->findPictureID($file['fcode'],$file['ftype'])){
                debug('picture in db: '.$pid);
                $file['dbinfo'] = $pdb->getInfoById($pid);
                $file['checked'] = 'no';
              }
            }
            $files[] = $file;
          }
        }
      }
    }
    //debug($files);

    $sm->assign('store',$store);
    $sm->assign('path',$path);
    $sm->assign('actid',$actid);
    $sm->assign('actress',$actress);
    $sm->assign('dirs',$dirs);
    $sm->assign('files',$files);
    $sm->assign('types',array('cv'=>'cv','ss'=>'ss','vdo'=>'vdo'));
  }

  if($_POST['submit'] == "Process"){
    $path = $_POST['path'];
    $collpath = substr($path,0,strpos($path,':')).":/Collection/";
    if(!is_dir($collpath)) mkdir($collpath,0775,true);
    $rmpath = substr($path,0,strpos($path,':')).":/Removed/";
    if(!is_dir($rmpath)) mkdir($rmpath,0775,true);

    $store = $_POST['store'];
    $actid = $_POST['actid'];
    $fcode = $_POST['fcode'];
    $ftype = $_POST['ftype'];
    $fname = $_POST['fname'];
    $fext = $_POST['fext'];
    $fcheck = $_POST['fcheck'];

    $pdb = new db_picture($cfg);

    debug("path: $path, store: $store, actid: $actid");
    //debug($fcode);
    //debug($fname);
    //debug($ftype);
    foreach($ftype as $k => $type){
      $code = $fcode[$k];
      $key = substr($code,0,strpos($code,'-'));
      $filename = $fname[$k];
      $exten = $fext[$k];
      $file = $path.$filename;
      unset($frs,$command,$set,$set2,$where,$insertresult,$pid,$title);
      $frs['fcode'] = $code;
      $frs['ffile'] = $file;
      $frs['ftype'] = $type;
      $npath = $collpath."$key/";
      if(!is_dir($npath)) mkdir($npath,0775,true);
      if(!is_dir($rmpath.$key.'/')) mkdir($rmpath.$key.'/');

      $insertresult = 'fail';

      //debug("fcheck[$k] = $fcheck[$k]");
      $stime = microtime(true);
      if($fcheck[$k]){

        if($type == 'cv' or $type == 'ss'){

          if($pid = $pdb->findPictureID($code,$type)){
            if($pid = $pdb->updatePicture($file,$pid)){
              $insertresult = 'ok';
              $frs['filemsg'] = "update database (PICID: $pid)";
            }else{
              $frs['filemsg'] = "<span style='background-color: red'>can't update database</span>";
            }
          }else{
            if($pid = $pdb->insertPicture($file,$code,$type)){
              $insertresult = 'ok';
              $frs['filemsg'] = "insert picture to database (PICID: $pid)";
            }else{
              $frs['filemsg'] = "<span style='background-color: red'>can't insert picture to database</span>";
            }
          }

        }else{

          $vdo = $fnc->getVdoInfo($file);
          $sql = "insert into $cfg->tbavdo (code,filename,store,duration,filesize,format,resolution,overall,bitrate,framerate,aspect,editdate) ".
                  "values ('$code','$filename','$store','$vdo[Duration]','$vdo[Filesize]','$vdo[Format]','$vdo[Width]x$vdo[Height]','$vdo[Overall]','$vdo[Bitrate]','$vdo[Framerate]','$vdo[Aspect]',NOW())";
          debug($sql);
          if($db->query($sql)){
            $vid = $db->insert_id();
            $insertresult = 'ok';
            $frs['filemsg'] = "insert video info (AVDOID: $vid)";
          }else{
            $frs['filemsg'] = "<span style='background-color: red'>can't insert video to database</span>";
          }

        }

      }else{
        $frs['filemsg'] = "<span style='color: red'>this file cancled by user</span>";
        $frs['ftype'] = 'cancle';
        $refile = $rmpath.$key.'/'.$filename;
        rename($file,$refile);
      }

      if($insertresult == 'ok'){

        $sql = "select id from $cfg->tbamov where code='$code'";
        $rs = $db->query($sql);
        if($db->affected_rows() > 0){
          $aid = $db->fetch_result($rs);
          $command = 'update';
          $where = " where id='$aid'";
        }else{
          $command = 'insert into';
          $javlib = "http://www.javlibrary.com/en/vl_searchbyid.php?keyword=$code";
          if($mov = $fnc->getJavLib($javlib)){
            $title = $mov['title'];
            $set2 = ",title2='$mov[actress_name]',genre='$mov[genre]',studio='$mov[studio]',label='$mov[label]',reldate='$mov[reldate]',actress='$mov[actress]',javlib='$mov[javlib]'";
          }
        }
        $set = " $cfg->tbamov set code='$code',region='3',keycode='$key',edit_date=NOW()";
        if(!empty($actid)) $set .= ",actress='[$actid]'";
        if($type == 'cv'){
          $set .= ",cover='$pid'";
          if(empty($title) && strpos($filename,' ')){
            $p = strpos($filename,' ');
            $title = substr($filename,$p+1);
            $title = str_replace('.'.$exten,'',$title);
          }
          $title = addslashes($title);
          $set .= ",title='$title'";
          $refile = $npath.$code.'.'.$exten;
          rename($file,$refile);
        }
        if($type == 'vdo'){
          $set .= ",have='1'";
          $refile = $npath.$filename;
          rename($file,$refile);
        }
        if($type == 'ss'){
          $refile = $rmpath.$key.'/'.$filename;
          rename($file,$refile);
        }
        $sql = $command.$set.$set2.$where;
        debug($sql);
        if($db->query($sql)){
          if($command == 'insert into') $aid = $db->insert_id();
          $frs['amovmsg'] = " and $command amov (AMOVID: $aid)";
        }else{
          $frs['amovmsg'] = " <span style='background-color: red'>but can't $command amov</span> ".$db->error();
        }

      }
      $etime = microtime(true);
      $time = round($etime - $stime,2);
      $times += $time;
      $frs['time'] = '('.$time.'s)';
      $out[] = $frs;
    }
    $sm->assign('times',$times);
    rmdir($path);
    $sm->assign('out',$out);
    $html = "filesput_result.html";
  }

  //$html = 'blank_page.html';
  $sm->display($html);

  include('_footer.inc.php');
?>