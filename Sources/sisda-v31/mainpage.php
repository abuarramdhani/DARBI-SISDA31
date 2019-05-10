<?PHP
session_start();

if(isset($_SESSION["id"])) {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
<title>Sistem Informasi Sekolah Islam Terpadu Darul Abidin - v3</title>
<link media="screen" type="text/css" rel="stylesheet" href="style.css">

<script type="text/javascript" src="pngFix/jquery-1.3.2.min.js"></script>
	<script type="text/javascript" src="pngFix/pluginpage.js"></script>

	<script type="text/javascript" src="pngFix/jquery.pngFix.pack.js"></script>
	
<script type="text/javascript">
//iMa-8Mei2019
//with the original '$', it cannot be read as a function, entah knp gt
//solve with create no var define no conflict

var $jq = jQuery.noConflict();
	$jq(document).ready(function(){
		$jq('div.examples').pngFix( );
	});
</script>

<!-- Chili the jQuery code highlighter plugin -->
<script type="text/javascript" src="pngFix/chili/chili.pack.js"></script>
<script id="setup" type="text/javascript">
ChiliBook.recipeFolder     = "pngFix/chili/";
ChiliBook.stylesheetFolder = "pngFix/chili/";
</script>

<SCRIPT language="JavaScript1.2" src="help_popup/main.js" type="text/javascript"></SCRIPT>

<script type="text/javascript" src="menu/stmenu.js"></script>
</head>

<body>
<div id="main_contaciner">
<DIV id="TipLayer" style="visibility:hidden;position:absolute;z-index:1000;top:-100;"></DIV>
<SCRIPT language="JavaScript1.2" src="help_popup/style.js" type="text/javascript"></SCRIPT>   
<style media="screen" type="text/css">
#punya_button
{
	width:250px;
	height:40px;
	font-family:Verdana;
	font-size:14px;
	font-weight:bold;
}
#data_error
{
	font-family:Verdana;
	font-size:14px;
	font-weight:bold;
	color:#FF0000;
}
</style> 
<?PHP 
//let's make a good connection for our life..... muaaach
include ("sisda-config.php");

//We have to use this file to generate the dynamic background.
include_once("style_head.php");

//What is your name brother???? i wanna say Assalamualaikum with your beautiful name  :)
$id_user		= $_SESSION["id"];
$src_name		= "select name,privilege from user where id='$id_user'"; 
$query_name		= mysqli_query($mysql_connect, $src_name) or die("There is an error with mysql: ".mysql_error());
$row_name		= mysqli_fetch_array($query_name, MYSQLI_ASSOC);

$src_check_arrear	= "select distinct no_sisda from tunggakan where status != '0'";
$query_check_arrear	= mysqli_query($mysql_connect, $src_check_arrear) or die("terjadi kesalahan:".mysql_error());
$num_check_arrear	= mysqlI_num_rows($query_check_arrear);
?>
<div id="static_header">
<table width="100%" height="25" border="0" cellpadding="0" cellspacing="0" bgcolor="#000000">
	<tr>
    	<td width="40" height="25"></td>
        <td align="left"><span id="logout">Tunggakan: <span id="arrear"><?PHP echo $num_check_arrear; ?></span></span></td>
    	<td align="right"><span id="logout"><?PHP echo $row_name['name']; ?> | <a href="engine.php?case=logout">Logout</a></span>&nbsp;&nbsp;&nbsp;</td>
    	<td width="40"></td>
    </tr>
</table>
</div>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
    	<td height="30" colspan="5"></td>
    </tr>
    <tr>
    	<td width="40" height="20"></td>
        <td width="20"><img src="images/border_mp_top_left.png" /></td>
    	<td background="images/border_mp_top_center.png"></td>
        <td width="20"><img src="images/border_mp_top_right.png" /></td>
        <td width="40"></td>
    </tr>
    <tr>
    	<td width="40" height="400"></td>
        <td width="20" background="images/border_mp_middle_left.png"></td>
    	<td background="images/border_mp_middle_center.png" valign="top">
        	<table width="100%" border="0" cellpadding="0" cellspacing="0">
            	<tr>
                	<td colspan="6" height="5"></td>
                </tr>
            	<tr>
                	<td width="10"></td>
                    <td width="40"><img src="images/logo_main.png" /></td>
                    <td width="20"></td>
                    <td>
                    	<table width="100%" border="0" cellpadding="0" cellspacing="0">
                        	<tr>
                                <td align="left"><?PHP include("menu/menu_".$row_name["privilege"].".php"); ?></td>
                                <td background="images/bg_menu_center.png" width="100%">&nbsp;</td>
                                <td width="20"><img src="images/bg_menu_right.png" /></td>
                            </tr>
                        </table>
                    </td>
                    <td width="10"></td>
                </tr>
            </table>
            <table width="100%" height="300" border="0" cellpadding="0" cellspacing="0" >
            	<tr>
                	<td colspan="6" height="5" align="center" <?PHP if(isset($_GET["pl"])) {?>valign="top"<?PHP } ?>>
                    <?PHP
					//lp = loading page hahahahahahaha...:))
					if(!isset($_GET["pl"])) {
					?>
                    <span id="text_welcome">Assalamualaikum <?PHP echo ucwords($row_name["name"]); ?><br />Selamat datang kembali</span>
                    <?PHP
					} else {
						if($_GET["pl"] != "") {
							if(file_exists("page/page_".$_GET["pl"].".php")) {
								include("page/page_".$_GET["pl"].".php");
							}
						}
					}
					?>
                    </td>
                </tr>
            </table>
        </td>
        <td width="20" background="images/border_mp_middle_right.png"></td>
        <td width="40"></td>
    </tr>
    <tr>
    	<td width="40" height="20"></td>
        <td width="20"><img src="images/border_mp_bottom_left.png" /></td>
    	<td background="images/border_mp_bottom_center.png"></td>
        <td width="20"><img src="images/border_mp_bottom_right.png" /></td>
        <td width="40"></td>
    </tr>
    <tr>
    	<td width="40" height="20"></td>
    	<td height="25" colspan="3" align="right">
        	<table cellpadding="0" cellspacing="0" border="0">
            	<tr>
                    <td id="footer" align="right"><b>SIT Darul Abidin</b><br />Jl. Karet Hijau No. 29 Beji Timur - Depok<br />Telp:(021) 77200857 - Fax:(021)77202272</td>
                    <td width="5"></td>
                    <td width="20"><img src="images/icon_logo_black_small.png" /></td>
                </tr>
                <tr>
                	<td height="20" colspan="3"></td>
                </tr>
            </table>
        </td>
        <td width="40" height="20"></td>
    </tr>
</table>
</div>
</body>
</html>
<?PHP
} else {
	header("location:index.php");
}
?>
