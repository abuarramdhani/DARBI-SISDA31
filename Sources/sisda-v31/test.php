<form name="ggg" method="post" action="#">
<input type="radio" name="plipli" value="wowow"  /><input type="radio" name="plipli" value="wiwiw" />
<input type="submit" value="kirim coy" onclick="return verification()">
</form>
<SCRIPT type="text/javascript" >
function verification() 
{ 
	if(document.ggg.plipli.checked)
	{
		alert('Field "Nama siswa" tidak boleh kosong');
		return false;
	}	
	if(document.ggg.sfsdfs.value == "")
	{
		alert('Field "Nama siswa" tidak boleh kosong');
		return false;
	}	
	
return true;	
}
</SCRIPT>
<?PHP
//sandy said: the values of this parameters are taken from xammp with default setting. You may change them as the webserver setting that you use. 
$username	= "root";
$password	= "";
$host		= "localhost";
$db			= "sisda31";

//the connection code, you know...
$mysql_connect		= mysql_connect($host,$username,$password);
$mysql_select_db	= mysql_select_db($db,$mysql_connect);

//this is the key that used for generate user password.... keep it unique, buddy,....
//once you state the value, you have to keep it during this application running.
$darbi_key	= "similikitiB4l4B4l4";



/*$src_select	= "select * from set_spp order by jenjang,periode";
$query_select	= mysqli_query($mysql_connect, $src_select) or die(mysql_error());

$i = 0;

while($row_select	= mysql_fetch_array($query_select)) {
	$i++;
	echo "$i---".$row_select["jenjang"]."---".$row_select["periode"]."---".$row_select["spp"]."<br>";
}*/


include_once("include/check_date_error.php");
include_once("include/define_month_spp.php");
include_once("include/check_spp_arrear.php");
/*
$go = mysqli_query($mysql_connect, "select * from tunggakan where periode = '2013 - 2014'");
while($wht = mysql_fetch_array($go)) {
	echo $wht["id"]."---";
	echo $wht["no_sisda"]."---";
 echo $wht["jenis_tunggakan"]."---";
 echo $wht["march"]."---";
 echo $wht["periode"]."<br>";
  
}

echo mysql_num_rows($go);*/

/*
$src_2_con		= 	"
						update cataj set nominal = Case when name = 'Amanda' then '11' when name = 'Endar' then '22' end where name = 'Amanda' or name = 'Endar';

					";
$query_2_con	= mysqli_query($mysql_connect, $src_2_con) or die(mysql_error());
*/

?>
