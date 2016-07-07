<?php

	require_once("bp_header.noout.inc.php");
	$db = new Database($cfg->dbhost,$cfg->dbuser,$cfg->dbpass,$cfg->dbname);

  $name = urldecode($_POST['name']);
  if(strpos($name," ")){
    list($fname,$lname) = explode(" ",$name);
  }else{
    $fname = $name;
  }

  $fname = ucfirst($fname);
	$lname = ucfirst($lname);

  $sql = "select id from $cfg->tbacts where (fname='$fname' and lname='$lname') or (fname='$lname' and lname='$fname')";
  $db->query($sql);
	if($db->affected_rows() > 0){
	  echo "FAIL;Duplicated name.";
	}else{
  	$sql = "insert into $cfg->tbacts set fname='$fname', lname='$lname', edit_date=NOW()";
  	if($db->query($sql)){
  		echo "OK;",$db->insert_id(),";$fname $lname";
  	}else{
  		echo "FAIL;can't insert database.";
  	}
	}

?>