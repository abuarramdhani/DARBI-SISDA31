<?PHP
//Who are you?????? From where are you coming...hohohohoho
function getIp() {

        $ip = $_SERVER['REMOTE_ADDR'];
		
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {

            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {

            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }

        return $ip;
    }
$user_ip = getIp();

//$need_log is received from every file that call this proc_log.php.
if($need_log == true && $do_log == true) {

	//this is about the detail of what the admin does in every process
	//Dont let them undefined;
	$src_act_note	= !empty($act_note) ? $act_note : "";

	//include the the time function
	include("include/cur_date.php");
	$cur_date = cur_date();
	
	//yea, we need to know, who is the one that does everything..... right????
	$src_query_who	= "select name from user where id = '$id'";
	$query_who		= mysqli_query($mysql_connect, $src_query_who) or die("There is an error with mysql: ".mysql_error());
	$row_who		= mysqli_fetch_object($query_who);
	$who			= $row_who->name;
	
	//here we go baby....
	$src_query_log	= "insert into log (id_user,name, activity,act_note,url,user_ip, date) values ('$id','$who','$activity','$src_act_note','$url','$user_ip','$cur_date')";
	$query_log		= mysqli_query($mysql_connect, $src_query_log) or die("There is an error with mysql: ".mysql_error());	
}
?>