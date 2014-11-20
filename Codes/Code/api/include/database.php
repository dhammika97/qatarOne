<?php
/**
 * @author Dhammika Gunaratne
 * @email dhammika97@gmail.com
 * @copyright 2011
 */
class database{

private $db_host = "localhost";
private $db_user = "root";
private $db_pass = "";
private $db_name = "quatarone";

//require_once 'Config.php';

private $con = false;
private $results = array();
private $insertid ;
private $json;
private $numrows;

	function __construct(){
		$this->connect();	
	}

	function connect(){
		if(!$this->con){
			$myconn = mysql_connect($this->db_host,$this->db_user,$this->db_pass);
			if($myconn){
				$select_db = mysql_select_db($this->db_name,$myconn);
				if($select_db){
					$this->con = true;
					return true;
				}else{
					return false;	
				}
			}else{
				return false;
			}
		}else{
			return true;	
		}
	}
	
	
	function disconnect(){
		if($this->con){
			if(@mysql_close($myconn)){
				$this->con = false;
				return true;
			}else{
				return false;	
			}
		}
	}
	
	
	function select($table,$rows,$where,$order,$limit){
		$q = 'select '.$rows.' from '.$table;
		if($where!=""){
			$q .= ' where '.$where;
		}
		if($order!=""){
			$q .= ' order by '.$order;
		}
		if($limit!=""){
			$q .= ' limit '.$limit;
		}
		//echo $q;
		$query = mysql_query($q);
		$numRows = mysql_num_rows($query);
		$this->numrows = $numRows;
		if($numRows){
			for($i=0; $i<$numRows; $i++){
				$r= mysql_fetch_array($query);
				$key = array_keys($r);
				for($x=0; $x<count($key); $x++){
					if($numRows > 1){
						$this->results[$i][$key[$x]] = $r[$key[$x]];
					} else if ($numRows < 1){
						$this->results = null;
					} else{
						$this->results[$key[$x]] = $r[$key[$x]];	
					}
				}
			}
		}else{
			return false;	
		}
		mysql_free_result($query);
		$this->disconnect();
	}
	
	function selectJson($table,$rows,$where,$order,$limit){
		$q = 'select '.$rows.' from '.$table;
		if($where!=""){
			$q .= ' where '.$where;
		}
		if($order!=""){
			$q .= ' order by '.$order;
		}
		if($limit!=""){
			$q .= ' limit '.$limit;
		}
		$query = mysql_query($q);
		$numRows = mysql_num_rows($query);
		$this->numrows = $numRows;
		if($numRows){
			while($row=mysql_fetch_assoc($query)){
				$show[] = $row;	
			}
			$this->json = json_encode($show);
		}
		
		mysql_free_result($query);
		$this->disconnect();
	}
	
	function getJson(){
		return $this->json;	
	}
	
	function getNumRows(){
		return $this->numrows;
	}
	
	function getResults(){
		return $this->results;
	}
	
	function getInsertId(){
		return $this->insertid;
	}
	
	
	function insert($table,$values,$rows){
		$insert = "insert into ".$table;
		if($rows != ""){
			$insert .= " (".$rows.")";
		}
		if($values != ""){
			$insert .= " values (".$values.");";
		}
		$ins = mysql_query($insert);
		$this->insertid = mysql_insert_id();
		if($ins){
			return true;
		}else{
			return false;	
		}
		$this->disconnect();
	}
	
	
	
	function delete($table,$where){
		if($where != ""){
			$del = 'delete from '.$table.' where '.$where;
		}else{
			$del = 'delete '.$table;
		}
		$delete = mysql_query($del);
		if($delete){
			return true;
		}else{
			return false;
		}
		$this->disconnect();
	}
	
	
	
	public function update($table,$rows,$where){
        $update = 'update '.$table.' set ';
		$keys = array_keys($rows);
		for($i=0; $i<count($rows); $i++){
			if(is_string($rows[$keys[$i]])){
				$update .= $keys[$i].'="'.$rows[$keys[$i]].'"';
			}else{
				$update .= $keys[$i].'='.$rows[$keys[$i]];
			}
			if($i != count($rows)-1){
				$update .= ',';
			}
		}
		$update .= ' where '.$where;
		if($up = mysql_query($update)){
			return true;	
		}else{
			return false;	
		}
		$this->disconnect();
    }
	
	
	function tableExists($table){
		$tablesInDb = @mysql_query('show tables from '.$this->db_name.' like "'.$table.'"')	;
		if($tablesInDb){
			if(mysql_num_rows($tablesInDb)==1){
				return true;
			}else{
				return false;
			}
		}
	}	
	
}
?>
