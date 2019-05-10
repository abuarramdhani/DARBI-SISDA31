<?PHP
//$need_log is received from every file that call this proc_log.php.
if($need_log == true) {

	//include the the time function
	include("include/cur_date.php");
	$cur_date = cur_date();
	
	//here we go baby....
	$src_query_log	= "insert into log (id_user,activity,url,date) values ('$id','$activity','$url','$cur_date')";
	$query_log		= mysqli_query($mysql_connect, $src_query_log) or die("There is an error with mysql: ".mysql_error());	
}
?>