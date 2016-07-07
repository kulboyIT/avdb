<?php
	require_once("bp_header.noout.inc.php");
	$db = new Database($cfg->dbhost,$cfg->dbuser,$cfg->dbpass,$cfg->dbname);

	$search = trim(htmlentities($_GET['search']));
  $sid = trim(htmlentities($_GET['sid']));
	$avs = array();

	if(strpos($search," ") === false){
		$sql = "select id,fname,lname from actrs where fname like '$search%' order by fname,lname";
		if($rs = $db->query($sql)){
			while($r = $db->fetch_assoc($rs)){
				$avs[$r['id']] = $r['fname']." ".$r['lname'];
			}
		}
		$sql = "select id,fname,lname from actrs where lname like '$search%' order by fname,lname";
		if($rs = $db->query($sql)){
			while($r = $db->fetch_assoc($rs)){
				if(!array_key_exists($r['id'],$avs)){
					$avs[$r['id']] = $r['fname']." ".$r['lname'];
				}
			}
		}
	}else{
		list($fname,$lname) = explode(" ",$search);
		$sql = "select id,fname,lname from actrs where (fname='$fname' and lname like '$lname%') or (fname like '$lname%' and lname='$fname') order by fname,lname";
		if($rs = $db->query($sql)){
			while($r = $db->fetch_assoc($rs)){
				$avs[$r['id']] = $r['fname']." ".$r['lname'];
			}
		}
	}

	echo "<ul>";
	if($avs){
		foreach($avs as $id => $name){
			if($_GET['result']=='edit'){
			  echo "<li><a onclick=\"nameAdd('$id','$name')\" href='#nomove'>$name</a></li>";
			}else{
        //echo "<li><a id='$sid' value='$id' onclick='sel(this)' href='#nomove'>$name</a></li>";
        echo "<li><a onclick=\"nameAdd('$sid','$id','$name')\" href='#nomove'>$name</a></li>";
			}
		}
	}else{
		echo "<li><i>&nbsp;-- not found --&nbsp;</i></li>";
	}
	echo "</ul>";
	$db->close();

?>