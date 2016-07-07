<?php

	require_once("bp_header.noout.inc.php");

  $aid = $_GET['a'];
  $target = $_GET['t'];
  $uppath = "ACTRESS/";

	if(is_uploaded_file($_FILES["upFull"]['tmp_name'][0])){
	  $file = $uppath.$_FILES["upFull"]["name"][0];
	  if (file_exists($file)) unlink($file);
    if(move_uploaded_file($_FILES["upFull"]["tmp_name"][0],$file)) $upsuccess = true;
  }

  if(is_uploaded_file($_FILES["upThumb"]['tmp_name'][0])){
	  $file = $uppath.$_FILES["upThumb"]["name"][0];
	  if (file_exists($file)) unlink($file);
    if(move_uploaded_file($_FILES["upThumb"]["tmp_name"][0],$file)) $upsuccess = true;
  }

  if($upsuccess){
    $fileinfo = pathinfo($file);
  	$exten = $fileinfo['extension'];
  	if(!array_key_exists(strtolower($exten),$cfg->mmeType)) die("FAIL;invalid file type.");
  	$filesize = filesize($file);
  	$iminfo = getimagesize($file);

  	$fp = fopen($file,'rb');
  	$filedat = addslashes(fread($fp,$filesize));
    fclose($fp);

    $db = new Database($cfg->dbhost,$cfg->dbuser,$cfg->dbpass,$cfg->dbname);
  	$sql = "update $cfg->tbacts set $target='$filedat' where id='$aid'";
    if($db->query($sql)){
      echo "OK;$aid";
    }else{
      echo "FAIL;update database fail.";
    }
  }else{
    echo "FAIL;upload file fail.";
  }

?>
