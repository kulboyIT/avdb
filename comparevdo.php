<?php
  include('_header.inc.php');
	$db = new Database($cfg->dbhost,$cfg->dbuser,$cfg->dbpass,$cfg->dbname);

  $file = $_GET['file'];
  $store = $_GET['store'];
  echo "file= $file<br/>";
  $pathinfo = pathinfo($file);
  $code = $fnc->substr_code($pathinfo['filename']);

  $key = array('KEY','Filename','Store','Duration','Filesize','Format','Resolution','Overall','Bitrate','Framerate','Aspect');
  $finfo = $fnc->getVdoInfo($file);
  foreach($key as $k){
    if($k == 'KEY'){
      $infos[$k][0] = 'FILE';
    }elseif($k == 'Filename'){
      $infos[$k][0] = $pathinfo['basename'];
    }elseif($k == 'Store'){
      $infos[$k][0] = $store;
    }elseif($k == 'Resolution'){
      $infos[$k][0] = $finfo['Width'].'x'.$finfo['Height'];
    }else{
      $infos[$k][0] = $finfo[$k];
    }
  }

  $sql = "select filename as Filename,store as Store,duration as Duration,filesize as Filesize,format as Format,resolution as Resolution".
          ",overall as Overall,bitrate as Bitrate,framerate as Framerate,aspect as Aspect from $cfg->tbavdo where code='$code'";
  //echo $sql;
  $rs = $db->query($sql);
  if($db->affected_rows() > 0){
    $i = 1;
    while($f = $db->fetch_assoc($rs)){
      foreach($key as $k){
        if($k == 'KEY'){
          $infos[$k][$i] = "DB$i";
        }else{
          $infos[$k][$i] = $f[$k];
        }
      }
      $i++;
    }
  }

  echo "CODE: $code<br/><table style='border: 1px solid;' cellpadding='3' cellspacing='3'>";
  foreach($infos as $k => $line){
    echo '<tr><td>'.$k.'</td>';
    foreach($line as $v){
      echo '<td>'.$v.'</td>';
    }
    echo '</tr>';
  }
  echo '</table>';

  include("_footer.inc.php");

?>