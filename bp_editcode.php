<?php
  require_once("bp_header.noout.inc.php");

  $db = new Database($cfg->dbhost,$cfg->dbuser,$cfg->dbpass,$cfg->dbname);

  $sql = "select id from $cfg->tbamov where code='$_POST[newcode]'";
  $rs = $db->query($sql);
  if($db->affected_rows() > 0){
    $id = $db->fetch_result($rs);
    $result = "Duplicate CODE on movie id($id).";
  }else{
    $sql = "select id from $cfg->tbpic where code='$_POST[code]'";
    $db->query($sql);
    if($db->affected_rows() > 0){
      $sql = "update $cfg->tbpic set code='$_POST[newcode]' where code='$_POST[code]'";
      echo "$sql <br/>";
      if($db->query($sql)){
        $result .= "update $cfg->tbpic ok.\\n";
      }else{
        $result .= "update $cfg->tbpic fail.\\n";
      }
    }

    $sql = "select id from $cfg->tbavdo where code='$_POST[code]'";
    $db->query($sql);
    if($db->affected_rows() > 0){
      $sql = "update $cfg->tbavdo set code='$_POST[newcode]' where code='$_POST[code]'";
      echo "$sql <br/>";
      if($db->query($sql)){
        $result .= "update $cfg->tbavdo ok.\\n";
      }else{
        $result .= "update $cfg->tbavdo fail.\\n";
      }
    }

    $key = substr($_POST['newcode'],0,strpos($_POST['newcode'],'-'));
    $sql = "update $cfg->tbamov set code='$_POST[newcode]',keycode='$key' where id='$_POST[id]'";
    echo "$sql <br/>";
    if($db->query($sql)){
      $result .= "update $cfg->tbamov ok.\\n";
    }else{
      $result .= "update $cfg->tbamov fail.\\n";
    }
  }
  echo $result;
  echo "<script>alert('$result');</script>";

?>