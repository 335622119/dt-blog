<?php
require_once('../../../init.php');
$DB = MySql::getInstance();
$action = $_GET[action];
$id = $_GET[id];
$typee = $_GET[typee];
if (!is_numeric($id)){
echo "请不要捣乱，谢谢！";
exit;
}
if($action=="show"){
	$sql = $DB->query("Select * From ".DB_PREFIX."cgz_xinqing Where id='$id'");
		$info = $DB->fetch_array($sql);
		if($info == false){
			$query = "Insert into ".DB_PREFIX."cgz_xinqing (id)values('$id')";
			$result = $DB->query($query);
			echo "0,0,0,0,0";
		}else{
			echo "$info[mood1],$info[mood2],$info[mood3],$info[mood4],$info[mood5]";
		 }
}else{ 
	if($action == "mood"){ 
		if($typee == "mood1"){
			$query = "Update ".DB_PREFIX."cgz_xinqing set mood1=mood1+1 where id='$id'";
			$result=$DB->query($query);
		}
		if($typee == "mood2"){
			$query = "Update ".DB_PREFIX."cgz_xinqing set mood2=mood2+1 where id='$id'";
			$result = $DB->query($query);
		}
		if($typee == "mood3"){
			$query = "Update ".DB_PREFIX."cgz_xinqing set mood3=mood3+1 where id='$id'";
			$result = $DB->query($query);
		}
		if($typee == "mood4"){
			$query = "Update ".DB_PREFIX."cgz_xinqing set mood4=mood4+1 where id='$id'";
			$result = $DB->query($query);
		}
		if($typee == "mood5"){
			$query = "Update ".DB_PREFIX."cgz_xinqing set mood5=mood5+1 where id='$id'";
			$result = $DB->query($query);
		}
		$sql = $DB->query("Select * From ".DB_PREFIX."cgz_xinqing Where id='$id'");
		$info = $DB->fetch_array($sql);
		echo "$info[mood1],$info[mood2],$info[mood3],$info[mood4],$info[mood5]";
	}else{
		echo "0,0,0,0,0";
	}
}
?>