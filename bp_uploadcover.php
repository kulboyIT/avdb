<?php

	require_once("bp_header.noout.inc.php");

  $fp = fopen("log.txt",'a');
  fwrite($fp,'['.date("Y-m-d h:i:s")."] Start Script.".PHP_EOL);
  //fwrite($fp,'['.date("Y-m-d h:i:s")."] ".print_r($_FILES).PHP_EOL);

	if(is_uploaded_file($_FILES["upCover"]['tmp_name'][0])){
	  $db = new Database($cfg->dbhost,$cfg->dbuser,$cfg->dbpass,$cfg->dbname);
    $sql = "select code,cover from $cfg->tbamov where id = '$_GET[amovid]'";
    fwrite($fp,'['.date("Y-m-d h:i:s")."] SQL: $sql".PHP_EOL);
    $r = $db->fetch_assoc($db->query($sql));
    $code = $r['code'];
    $cover = $r['cover'];
    fwrite($fp,'['.date("Y-m-d h:i:s")."] Result: $code,$cover".PHP_EOL);
    $uppath = "COVER/";

	  $file = $uppath.$_FILES["upCover"]["name"][0];
	  if (file_exists($file)) unlink($file);
    move_uploaded_file($_FILES["upCover"]["tmp_name"][0],$file);
    fwrite($fp,'['.date("Y-m-d h:i:s")."] File: $file".PHP_EOL);
		$pdb = new db_picture($cfg);
		if($cover > 10){
      fwrite($fp,'['.date("Y-m-d h:i:s")."] Method: Update Picture.".PHP_EOL);
			$pdb->updatePicture($file,$cover);
		}else{
		  fwrite($fp,'['.date("Y-m-d h:i:s")."] Method: Insert Picture.".PHP_EOL);
			$cover = $pdb->insertPicture($file,$code,'cv');
			$sql = "update $cfg->tbamov set cover='$cover',edit_date=NOW() where id='$_GET[amovid]'";
			$db->query($sql);
		}
    echo $cover;
  }

  fwrite($fp,'['.date("Y-m-d h:i:s")."] End Script.".PHP_EOL);
  fclose($fp);
?>
