<?php
	require_once("bp_header.noout.inc.php");
	if($cfg->hidePicture) exit;
	$db = new Database($cfg->dbhost,$cfg->dbuser,$cfg->dbpass,$cfg->dbname);

	if(isset($_GET['show'])) {
	// if id is set then get the file with the id from database

		$query = "SELECT picdata FROM $cfg->tbpic WHERE id = '$_GET[show]'";
		$rs = $db->query($query) or die('Error, query failed');
		echo $db->fetch_result($rs);
		exit;
	}

	if(isset($_GET['covers'])){
		$query = "SELECT picdata,width,height FROM $cfg->tbpic WHERE id = '$_GET[covers]'";
		$rs = $db->query($query) or die('Error, query failed');
		$im = $db->fetch_assoc($rs);
		$nw = 300;
		$per = $im['width'] / $nw;
		$nh = $im['height'] / $per;

		$ims = imagecreatefromstring($im['picdata']);
		$imd = imagecreatetruecolor($nw,$nh);
		imagecopyresized($imd, $ims, 0, 0, 0, 0, $nw, $nh, $im['width'], $im['height']);
		imagepng($imd);
		exit;
	}

	if(isset($_GET['coverm'])){
		$query = "SELECT picdata,width,height FROM $cfg->tbpic WHERE id = '$_GET[coverm]'";
		$rs = $db->query($query) or die('Error, query failed');
		$im = $db->fetch_assoc($rs);
		$nw = 600;
		$per = $im['width'] / $nw;
		$nh = $im['height'] / $per;

		$ims = imagecreatefromstring($im['picdata']);
		$imd = imagecreatetruecolor($nw,$nh);
		imagecopyresized($imd, $ims, 0, 0, 0, 0, $nw, $nh, $im['width'], $im['height']);
		imagepng($imd);
		exit;
	}

	if(isset($_GET['coverl'])){
		$query = "SELECT picdata,width,height FROM $cfg->tbpic WHERE id = '$_GET[coverl]'";
		$rs = $db->query($query) or die('Error, query failed');
		$im = $db->fetch_assoc($rs);
		$nw = 800;
		$per = $im['width'] / $nw;
		$nh = $im['height'] / $per;

		$ims = imagecreatefromstring($im['picdata']);
		$imd = imagecreatetruecolor($nw,$nh);
		imagecopyresized($imd, $ims, 0, 0, 0, 0, $nw, $nh, $im['width'], $im['height']);
		imagepng($imd);
		exit;
	}

	if(isset($_GET['thumb'])){
		$query = "SELECT picdata,width,height FROM $cfg->tbpic WHERE id = '$_GET[thumb]'";
		$rs = $db->query($query) or die('Error, query failed');
		$im = $db->fetch_assoc($rs);
		$nw = 210;
		$per = $im['width'] / $nw;
		$nh = $im['height'] / $per;

		$ims = imagecreatefromstring($im['picdata']);
		$imd = imagecreatetruecolor($nw,$nh);
		imagecopyresized($imd, $ims, 0, 0, 0, 0, $nw, $nh, $im['width'], $im['height']);
		imagepng($imd);
		exit;
	}

	if(isset($_GET['list'])){
		$query = "SELECT picdata,width,height FROM $cfg->tbpic WHERE id = '$_GET[list]'";
		$rs = $db->query($query) or die('Error, query failed');
		$im = $db->fetch_assoc($rs);
		$nw = 125;
		$per = $im['width'] / $nw;
		$nh = $im['height'] / $per;

		$ims = imagecreatefromstring($im['picdata']);
		$imd = imagecreatetruecolor($nw,$nh);
		imagecopyresized($imd, $ims, 0, 0, 0, 0, $nw, $nh, $im['width'], $im['height']);
		imagepng($imd);
		exit;
	}

	if(isset($_GET['actrf'])) {
		$query = "SELECT full FROM $cfg->tbacts WHERE id = '$_GET[actrf]'";
		$rs = $db->query($query) or die('Error, query failed');
		echo $db->fetch_result($rs);
		exit;
	}

	if(isset($_GET['actrt'])) {
		$query = "SELECT thumb FROM $cfg->tbacts WHERE id = '$_GET[actrt]'";
		$rs = $db->query($query) or die('Error, query failed');
		echo $db->fetch_result($rs);
		exit;
	}

?>