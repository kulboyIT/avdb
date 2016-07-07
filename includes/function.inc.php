<?php

  class Functioner {
		
		var $int_timeProbe;

    function Functioner($cfg){
      $this->dbhost = $cfg->dbhost;
      $this->dbuser = $cfg->dbuser;
      $this->dbpass = $cfg->dbpass;
      $this->dbname = $cfg->dbname;
      $this->tbamov = $cfg->tbamov;
      $this->tbacts = $cfg->tbacts;
      $this->tbpic = $cfg->tbpic;
      $this->tbavdo = $cfg->tbavdo;
			$this->debug = $cfg->debug;
    }

	  function my_connect(){
		  $my = mysql_connect($this->dbhost,$this->dbuser,$this->dbpass);
		  if($my){
			  mysql_select_db($this->dbname,$my);
			  mysql_query("set character set utf8",$my);
			  return $my;
		  }
      return false;
	  }

    function getdbMov($code,$field='id'){
      $sql = "select $field from $this->tbamov where code='$code'";
      $my = $this->my_connect();
      $rs = mysql_query($sql,$my);
      if(mysql_affected_rows($my) > 0){
        return mysql_result($rs,0);
      }else{
        return false;
      }
    }
    
    function setMovActrs($mid,$aid){
      if(empty($mid)||empty($aid)) return false;
      $my = $this->my_connect();
      if($rs = mysql_query("select code,actress from $this->tbamov where id = '$mid'",$my)){
        $r = mysql_fetch_assoc($rs);
        $dbaid = explode(',',$r['actress']);
        if(in_array("[$aid]",$dbaid)){
          return true;
        }else{
          $dbaid[] = "[$aid]";
          $dbaid = array_filter($dbaid);
          $naid = implode(',',$dbaid);
          return mysql_query("update $this->tbamov set actress = '$naid' where id = '$mid'",$my);
        }
      }else{
        return false;
      }
    }

    function getActrsName($acid){
      $sql = "select fname,lname from $this->tbacts where id='$acid'";
      $my = $this->my_connect();
      $rs = mysql_query($sql,$my);
      $r = mysql_fetch_assoc($rs);
      return $r['fname']." ".$r['lname'];
    }

    function getActrsId($name,$javkey=''){
      $my = $this->my_connect();
      if($javkey){
        $sql = "select id from $this->tbacts where javlibcode = '$javkey' order by id";
        $rs = mysql_query($sql,$my);
      }
      if(mysql_affected_rows($my) <= 0){
        list($n1,$n2) = split(' ',$name);
        $sql = "select id from $this->tbacts where (fname='$n1' and lname='$n2') or (fname='$n2' and lname='$n1') order by id";
        $rs = mysql_query($sql,$my);
      }
      if(mysql_affected_rows($my) > 0){
        return mysql_result($rs,0);
      }else{
        return false;
      }
    }

  	function getdbImgInfo($id,$inArr=false){
  		$sql = "select width, height, length(picdata) as picsize from $this->tbpic where id='$id'";
      $my = $this->my_connect();
  		$rs = mysql_query($sql,$my);
  		if(mysql_affected_rows($my) > 0){
  			$img = mysql_fetch_assoc($rs);
  			$img['picsize'] = $this->byteprefix($img['picsize']);
  			if(!$inArr) $img = $img['width'].'x'.$img['height'].' ('.$img['picsize'].')';
  			return $img;
  		}else{
  			return false;
  		}
  	}

    function getRemoteImgInfo($url,$inArr=true){
      $exten = pathinfo($url, PATHINFO_EXTENSION);
      list($width, $height) = getimagesize($url);
      $headers = get_headers($url);
      foreach($headers as $header){
        if(strpos($header,'-Length:')) $size = str_replace('Content-Length: ','',$header);
        if(strpos($header,'-Type:')) $mtype = str_replace('Content-Type: ','',$header);
      }
      if($inArr){
        return array('width'=>$width,'height'=>$height,'size'=>$size,'exten'=>$exten,'mime'=>$mtype);
      }else{
        $size = $this->byteprefix($size);
        return "$exten($mtype), $size (W$width".'x'."H$height)";
      }
    }

    function getAvdoCount($code,$count=true){
      $sql = "select id from $this->tbavdo where code = '$code'";
      $my = $this->my_connect();
      if($rs = mysql_query($sql,$my)){
        if($count){
          return mysql_affected_rows($my);
        }else{
          return mysql_fetch_assoc($rs);
        }
      }else{
        return false;
      }
    }

    function getVdoInfo($file,$unit=false){
      if(!file_exists('mediainfo.exe') || !file_exists('mediainfo.dll')) die("can't find mediainfo library.");
      if(!file_exists($file)) die("can't find file: $file");
      $cmd = "mediainfo.exe --Inform=file://mediainfo.tpl $file";
      //echo $cmd;
      $ret = false;
      if($out = shell_exec($cmd)){
        $out = explode("\n",$out);
        foreach($out as $line){
          list($k,$v) = explode("=",$line);
          if($k == 'Duration'){
            list($h,$m,$s) = explode(":",$v);
            $v = ($h*60)+$m;
            if($unit) $v .= " min";
          }
          $ret[$k] = $v;
        }
      }else{
        echo "getVdoInfo error: $result<br/>";
      }
      return $ret;
    }

    function getJavLib($from){
      $cont = file_get_contents($from);

      $lines = explode(chr(13),$cont);
      $key = 'NONE';
			$capture = false;
      foreach($lines as $line){
				if(strpos($line,'Start of Content')) $capture = true;
        //if(strpos($line,'rel="canonical"')){
        //  preg_match('/(href)=("[^"]*")/i',$line, $jav_url);
        //  $mov['javlib'] = trim(str_replace('"','',$jav_url[2]));
        //}
				if($capture){
					if(strpos($line,'id="video_title"')){
						$mov['title'] = trim(strip_tags($line));
						$javlib = trim(strip_tags($line,'<a>'));
						preg_match('/(href)=("[^"]*")/i',$javlib, $jav_url);
						$mov['javlib'] = trim(str_replace('"','',$jav_url[2]));
					}
					if(strpos($line,'video_jacket_img')){
						$img_tag = trim(strip_tags($line,'<img>'));
						preg_match('/(alt|title|src)=("[^"]*")/i',$img_tag, $img);
						$mov['img_url'] = str_replace('"','',$img[2]);
					}
					if($key != 'NONE'){
						if($key != 'actress_name' && $key != 'genre'){
							$mov[$key] = trim(str_replace('&nbsp;','',strip_tags($line)));
						}else{
							$tags = trim(strip_tags($line,'<a>'));
							$tags = split('</a>',$tags);
							$dat = array();
							foreach($tags as $tag){
								if(!empty($tag)){
									preg_match('/(href)=("[^"]*")/i',$tag, $c);
									$code = str_replace(array('vl_star.php?s=','vl_genre.php?g=','"'),'',$c[2]);
									$tag = substr($tag,strpos($tag,'>')+1);
									$dat[$code] = trim($tag);
								}
							}
							$mov[$key] = $dat;
						}
						$key = 'NONE';
					}
					if(strpos($line,'ID:')) $key = 'code';
					if(strpos($line,'Release Date:')) $key = 'reldate';
					if(strpos($line,'Length:')) $key = 'length';
					if(strpos($line,'Maker:')) $key = 'studio';
					if(strpos($line,'Label:')) $key = 'label';
					if(strpos($line,'Genre(s):')) $key = 'genre';
					if(strpos($line,'Cast:')) $key = 'actress_name';
					if(strpos($line,'User Comments')) break;
				}
      }
      if(empty($mov)){
        return false;
      }else{
        $mov['title'] = str_replace($mov['code'],'',$mov['title']);
        if(!empty($mov['actress_name'])){
          $actress = array();
          foreach($mov['actress_name'] as $javkey=>$act){
            $aid = $this->getActrsId($act,$javkey);
            if($aid){
              $actress[] = "[$aid]";
            }else{
              if(!empty($javkey)){
                echo "$act, $javkey: ";
                $aid = $this->addActress($act,$javkey,true);
                $actress[] = "[$aid]";
              }
            }
          }
          $mov['actress_name'] = implode(',',$mov['actress_name']);
          $mov['actress'] = implode(',',$actress);
        }
        if(!empty($mov['genre'])) $mov['genre'] = implode(',',$mov['genre']);
        return $mov;
      }
    }
    
    function addActress($name,$javkey='',$swapname=false){
      if(empty($name)) return false;
      if(strpos($name," ")){
        list($fname,$lname) = explode(" ",$name);
        if($swapname){
          $tmp = $fname;
          $fname = $lname;
          $lname = $tmp;
        }
      }else{
        $fname = $name;
      }
      $fname = ucfirst($fname);
      $lname = ucfirst($lname);
      
      $my = $this->my_connect();
      $sql = "select id from $this->tbacts where (fname='$fname' and lname='$lname') or (fname='$lname' and lname='$fname')";
      if(!empty($javkey)) $sql .= " or javlibcode = '$javkey'";
      $rs = mysql_query($sql);
      if(mysql_affected_rows($my) > 0){
        echo 'dubpicate<br/>';
        return false;
      }else{
        $sql = "insert into $this->tbacts set fname='$fname', lname='$lname', javlibcode='$javkey', edit_date=NOW()";
        if(mysql_query($sql,$my)){
          $aid = mysql_insert_id($my);
          echo "insert ok -> $aid<br/>";
          return $aid;
        }else{
          echo "insert fail [$sql]<br/>";
          return false;
        }
      }
    }

    function substr_code($str){
      $codepatt = "^[A-Z0-9]*-[A-Z0-9]*[^a-z_.]";
      if(ereg($codepatt,$str,$regs)){
        return trim($regs[0]);
      }
      return false;
    }

  	function page_max($num,$rpp){
  		$pages = array();
  		$n = 0;
  		while ($num > 0){
  			$num = $num - $rpp;
  			$pages[$n] = $n+1;
  			$n++;
  		}
  		return($pages);
  	}

  	function start_row($page,$ipp){
  		$r = $page * $ipp;
  		return($r);
  	}

  	function date_th($date,$time=true){
  		if(!is_numeric($date)){
  			$date = strtotime($date);
  		}
  		$arr_date = getdate($date);
  		$day = $arr_date['mday'];
  		switch($arr_date['mon']){
  			case '1':
  				 $month = "มกราคม";
  				 break;
  			case '2':
  				 $month = "กุมภาพันธ์";
  				 break;
  			case '3':
  				 $month = "มีนาคม";
  				 break;
  			case '4':
  				 $month = "เมษายน";
  				 break;
  			case '5':
  				 $month = "พฤษภาคม";
  				 break;
  			case '6':
  				 $month = "มิถุนายน";
  				 break;
  			case '7':
  				 $month = "กรกฎาคม";
  				 break;
  			case '8':
  				 $month = "สิงหาคม";
  				 break;
  			case '9':
  				 $month = "กันยายน";
  				 break;
  			case '10':
  				 $month = "ตุลาคม";
  				 break;
  			case '11':
  				 $month = "พฤศจิกายน";
  				 break;
  			case '12':
  				 $month = "ธันวาคม";
  				 break;
  		}
  		$year = $arr_date['year'] + 543;
  		$hour = (strlen($arr_date['hours'])<2)?'0'.$arr_date['hours']:$arr_date['hours'];
  		$min = (strlen($arr_date['minutes'])<2)?'0'.$arr_date['minutes']:$arr_date['minutes'];
  		$result = $day.' '.$month.' '.$year;
  		if($time) $result .= ' '.$hour.':'.$min.' น.';
  		return $result;
  	}

  	function scanx($scanpath,$debug=false){
  		$vdotype = array('avi','mp4','wmv','mpg','flv','mkv','rm','rmvb');
  		$imgtype = array('jpg','png','bmp','gif','jpeg');

  		if(!is_dir($scanpath)) die('Can\'t find '.$scanpath);

  		$dh = opendir($scanpath);
  		while (false !== ($filename = readdir($dh))) {
  			if($filename != "." && $filename != ".."){
  				//debug($filename);
  				$fileinfo = pathinfo($filename);
  				$bname = $fileinfo['basename'];
  				$fname = $fileinfo['filename'];
  				$exten = $fileinfo['extension'];
  				//debug("$bname, $fname, $exten");
  				if(in_array($exten,$vdotype)){
  					$movs[$fname]['vdo'] = $bname;
  					//debug('This file is Video type.');
  				}else{
  					if(false !== ($p = strpos($fname,"_"))){
  						$code = substr($fname,0,$p);
  						$movs[$code]['ss'] = $bname;
  						//debug('This file is ScreenShot type.');
  					}else{
  						if(false !== ($p = strpos($fname," "))){
  							$code = substr($fname,0,$p);
  						}else{
  							$code = $fname;
  						}
  						$movs[$code]['cv'] = $bname;
  						//debug('This file is Cover type.');
  					}
  				}
  			}
  		}
  		return $movs;
  	}
	
  	# recursively remove a directory
  	function rrmdir($dir) {
      foreach(glob($dir . '/*') as $file) {
          if(is_dir($file))
              rrmdir($file);
          else
              unlink($file);
      }
      rmdir($dir);
  	}
	
  	function byteprefix($byte){
  		$unit = 'B';
      $tb = pow(1024,4);
  		$gb = pow(1024,3);
  		$mb = pow(1024,2);
      if($byte >= $tb){
  			$byte = round($byte/$tb,2);
  			$unit = 'TB';
  		}
  		if($byte >= $gb){
  			$byte = round($byte/$gb,2);
  			$unit = 'GB';
  		}
  		if($byte >= $mb){
  			$byte = round($byte/$mb,2);
  			$unit = 'MB';
  		}
  		if($byte >= 1024){
  			$byte = round($byte/1024);
  			$unit = 'KB';
  		}
      return $byte.$unit;
  	}
		
		function timeProbeStart(){
			$this->int_timeProbe = microtime(true);
		}
		
		function timeProbe($msg){
			$ex_time = microtime(true) - $this->int_timeProbe;
			if($this->debug) echo "$ex_time : $msg <br/>";
		}

  }
	
?>