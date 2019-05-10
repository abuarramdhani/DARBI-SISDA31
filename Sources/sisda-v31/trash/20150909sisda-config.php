<?PHP
//The values of this parameters are taken from xammp with default setting. You may change them as the webserver setting that you use. 
$username	= "root";
$password	= "";
$host		= "localhost";
$db			= "sisda31";

//Year when this system starts
/////////////////////////////////////////////////////////////////////////////
/////  ONCE YOU DEFINE THE STARTING YEAR, YOU MAY NOT CHANGE IT AT ALL //////
/////  OR OUR DATA WILL BE DAMAGE                                      //////
/////  (despite it has been protected in our database,                 //////
/////  and won't be happen, InsyaALlah.                                //////
/////  Except you delete the table, hmmmm....itu namanya maksa cilaka) ////// 	
/////  BUT, DON'T EVEN THINK ABOUT.....................  			   //////
/////////////////////////////////////////////////////////////////////////////
$starting_year	= 2013;

//the connection code, you know...
$mysql_connect		= mysql_connect($host,$username,$password);
$mysql_select_db	= mysql_select_db($db,$mysql_connect);

//this is the key that used for generate user password.... keep it unique, buddy,....
//once you state the value, you have to keep it during this application running.
$darbi_key	= "similikitiB4l4B4l4";

//Logging system run or stop
//Set 'true' for run
//Set 'false' for stop
$do_log = true;

//This path is where your sisda data placed in your server.
//Dont forget to use "/" in the end of the path
$darbi_url = "http://192.168.1.247/sisda-v31/";
?>
