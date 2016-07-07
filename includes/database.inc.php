<?php
#
# class for db conn.
#
class Database{

	function Database($host="",$user="", $pass="",$name=""){      
		$this->selected = false;
		$this->host = $host?$host:$dbhost;
		$this->name = $name?$name:$dbname;
		$this->user = $user?$user:$dbuser;
		$this->pass = $pass?$pass:$dbpass;
		if($this->host=="" && $this->name=="" && $this->user==""){
			return false;
		}
		
		if($this->initial()){
			return $this;
		}
		return false;
	}


	// for get connection for host, user-name, password and db-name
	function initial(){
		//echo "<br>Database->initial()";
		if(($this->fd = $this->connect())){
			if(($this->result = $this->select_db($this->name)))
				return($this->result);
		}
		return(false);
	}

    // Make connection to database server with user name and password.
    //  Return file descriptor of the connection.
	function connect(){
		//echo "<br>Database->connect()";
		$this->fd = mysql_connect($this->host, $this->user, $this->pass);
		$this->query('SET CHARACTER SET utf8');
		$this->query('SET NAMES utf8');
		//$this->set_charset('utf8');
		return($this->fd);
	}
	
	function set_charset($charset){
		mysql_set_charset($charset,$this->fd);
	}

    // Deinitial database section
    //  Close existing connection from database server.
	function deinitial(){
		//echo "<br>Database->deinitial()";
		mysql_close($this->fd);
		return(true);
	}

	function select_db($name=""){
		//echo "<br>Database->select_db($name)";
		if($this->fd==0){
			$this->selected = false;
			return false;
		}
		$this->name = $name!="" ? $name : $this->name;
		$this->result = mysql_select_db($this->name, $this->fd);
		if(!$this->result){
			echo "<br>".mysql_errno($this->fd).":".mysql_error($this->fd);
			$this->selected = false;
			return false;
		}
		$this->selected = true;
		return $this->result;
	}

	function query($sql, $debug=false){
		//echo "<br>Database->query($sql)";
		$this->squery = $sql;
		$this->result = mysql_query($this->squery, $this->fd);
		//echo "<br>".$this->result;
		if(!$this->result){
			echo "<br>Database Error: ".mysql_errno().":".mysql_error();
			return false;
		}
		$this->affected_rows();
		return $this->result;
	}

	function fetch_array($result=0){
		if($result)
			$this->rec = mysql_fetch_array($result);
		else
			$this->rec = mysql_fetch_array($this->result);
		return $this->rec;
	}
	 
	function fetch_assoc($result=0){
		if($result)
			$this->rec = mysql_fetch_assoc($result);
		else
			$this->rec = mysql_fetch_assoc($this->result);
		return $this->rec;
	}
	 
	function fetch_result($result=0,$field=0,$row=0){
		if($result)
			return mysql_result($result,$row,$field);
		else
			return mysql_result($this->result,$row,$field);
	}

	function insert_id(){
		return mysql_insert_id($this->fd);
	}

	function affected_rows(){
		$this->count = mysql_affected_rows($this->fd);//result);
		return $this->count;
	}

  function error(){
    $msg = "Error(".mysql_errno($this->fd)."): ".mysql_error($this-fd);
    return $msg;
  }

	function data_seek($p=0){
		if($this->count > 0)
			mysql_data_seek($this->result, $p);
		return;
	}

	// Lock database
	function lock($key, $time=0){
		$lock_key = $key!='' ? $key : '_DB_LOCKER_';
		$lock_time = $time!=0 ? $time : 10;
		$sql = " SELECT GET_LOCK('$lock_key', $lock_time);";
		$this->result = mysql_query($sql, $this->fd);
		if($this->result){
			if($this->affected_rows())
				return($lock_key);
		}
		//echo "<br>".mysql_errno($this->fd).":".mysql_error($this->fd);
		return(false);
	}

	// Unlock database
	function unlock($key){
		$lock_key = $key!='' ? $key : '_DB_LOCKER_';
		$sql = " SELECT RELEASE_LOCK('$lock_key');";
		$this->result = mysql_query($sql, $this->fd);
		if($this->result){
			if($this->affected_rows())
				return($lock_key);
		}
		//echo "<br>".mysql_errno($this->fd).":".mysql_error($this->fd);
		return(false);
	}

	
	function close(){
		mysql_close($this->fd);
	}

}

?>