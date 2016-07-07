<?php
	class db_picture {
		var $mmetype;

		function db_picture($cfg){
			
			$this->dbhost = $cfg->dbhost;
			$this->dbuser = $cfg->dbuser;
			$this->dbpass = $cfg->dbpass;
			$this->dbname = $cfg->dbname;
			
			$this->tbpic = $cfg->tbpic;
			
			$this->mmetype = $cfg->mmeType;
			
			return $this->connect();
		}
		
		function connect(){
			$this->connection = mysql_connect($this->dbhost,$this->dbuser,$this->dbpass);
			if($this->connection){
				mysql_select_db($this->dbname,$this->connection);
				mysql_set_charset('utf8',$this->connection);
				
				return true;
			}
			return false;
		}

    function findPictureID($code,$cate,$inarray=false){
      $sql = "select id from $this->tbpic where code='$code' and cate='$cate'";
      //echo $sql.'<br/>';
      $result = mysql_query($sql,$this->connection);
      if(mysql_affected_rows($this->connection) > 0){
        while($rs = mysql_fetch_assoc($result)){
          if($inarray){
            $ret[] = $rs['id'];
          }else{
            $ret .= $rs['id'].',';
          }
        }
        if(!is_array($ret)) $ret = substr($ret,0,strlen($ret)-1);
        return $ret;
      }
      return false;
    }

    function getInfoById($pid,$inarray=false){
      if(empty($pid)) return false;

      $sql = "select width,height,length(picdata) as size from $this->tbpic where id='$pid'";
      if($rs = mysql_query($sql,$this->connection)){
        $ret = mysql_fetch_assoc($rs);
        if(!$inarray){
          $s = $this->byteprefix($ret['size']);
          $ret = "W$ret[width]xH$ret[height]($s)";
        }
        return $ret;
      }
    }
		
		function insertPicture($file,$code,$cate){
			if(empty($code)) return false;
      if(empty($cate)) return false;
			if(!file_exists($file)) return false;
			
			$fileinfo = pathinfo($file);
			$exten = $fileinfo['extension'];
			if(!array_key_exists(strtolower($exten),$this->mmetype)) return false;
			$filesize = filesize($file);
			$iminfo = getimagesize($file);

			$fp = fopen($file,'rb');
			$filedat = addslashes(fread($fp,$filesize));
      fclose($fp);

      $sql = "insert into $this->tbpic (code,cate,type,width,height,picdata,editdate) values('$code','$cate','$exten','$iminfo[0]','$iminfo[1]','$filedat',NOW())";
			if(mysql_query($sql,$this->connection)){
				return mysql_insert_id($this->connection);
			}
			return false;
		}

		function updatePicture($file,$id,$code='',$cate=''){
			if(empty($id)) return false;
			if(!file_exists($file)) return false;
			
			$fileinfo = pathinfo($file);
			$exten = $fileinfo['extension'];
			if(!array_key_exists(strtolower($exten),$this->mmetype)) return false;
			$filesize = filesize($file);
			$iminfo = getimagesize($file);
			
			$fp = fopen($file,'rb');
			$filedat = addslashes(fread($fp,$filesize));
      fclose($fp);
			
			$sql = "update $this->tbpic set type='$exten',width='$iminfo[0]',height='$iminfo[1]',picdata='$filedat',editdate=NOW()";
      if($code) $sql .= ",code='$code'";
      if($cate) $sql .= ",cate='$cate'";
      $sql .= " where id='$id'";
      //echo $sql.'<br/>';
			if(mysql_query($sql,$this->connection)){
				return $id;
			}
			return false;
		}
		
		function loadPicture($id){
			$query = "SELECT picname, picsize, picdata FROM $this->tbpic WHERE id = '$id'";
	
			if($result = mysql_query($query)){
				return mysql_fetch_array($result);
			}else{
				return false;	
			}
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
	}
?>