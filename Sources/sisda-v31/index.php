<?PHP
session_start();
if(!empty($_SESSION["id"]) and !empty($_SESSION["privilege"])) {
	
	//echo $_SESSION["privilege"]."wrewrwerwe";
	header("Location:mainpage.php");	
}
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
	$(document).ready(function(){
		$('div.examples').pngFix( );
	});
</script>

<!-- Chili the jQuery code highlighter plugin -->
<script type="text/javascript" src="pngFix/chili/chili.pack.js"></script>
<script id="setup" type="text/javascript">
ChiliBook.recipeFolder     = "pngFix/chili/";
ChiliBook.stylesheetFolder = "pngFix/chili/";
</script>

<SCRIPT language="JavaScript1.2" src="help_popup/main.js" type="text/javascript"></SCRIPT>
</head>

<body>
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
<?PHP include("style_head.php"); ?>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0"> 
	<tr> 
    	<td height="25"></td>
    </tr>
    <form name="login_member" method="post" action="engine.php?case=login"> 
	<tr> 
    	<td background="images/center_bg.jpg" align="center">
        	<table width="520" height="100" border="0" cellpadding="0" cellspacing="0"> 
            	<tr>
                	<td width="25"></td>
                </tr>
            </table>
        	<table width="520" height="270" border="0" cellpadding="0" cellspacing="0" background="images/bg_login_center.png">
                <tr>
                	<td valign="top">
                    <div id="container">
                        <div id="text_title_index"><span id="text_title_index1">Login member</span><BR>Sistem Informasi  - v3<br />Sekolah Islam Terpadu Darul Abidin</div>
                        <div id="logo"><img src="images/logo.png" /></div>
                        <div id="text_username">Username</div>
                        <div id="text_password">Password</div>
                        <div id="input_username"><input type="text" name="username" size="25"></div>
                        <div id="input_password"><input type="password" name="password" size="25"></div>
                        <div id="submit"><input type="submit" value="Submit" style="color:#ffffff; background-color:#0099FF;" onClick="return verification()"/><input type="reset" value="Reset" style="color:#ffffff; background-color:#0099FF;" /></div>
                        <div id="help"><a href="#" onMouseOver="stm(Text[1],Style[12])" onMouseOut="htm()"><img src="images/what_happen_aya_naon.jpg" border="0" /></a></div>
                        <div id="icon_1"><img src="images/icon_user.png"></div>
                        <div id="copyright_login">Copyright &copy; PT Berca Hardayaperkasa 2008<BR>www.berca.co.id</div>
                    </div>
                    </td>
                </tr>
            </table>
        </td> 
    </tr>
    </form>
    <tr> 
    	<td bgcolor="#333333"></td>
    </tr>
</table>
</body>
</html>
<SCRIPT type="text/javascript" >
function verification() 
{ 
	if(document.login_member.username.value == "")
	{
		alert('Username harus diisi');
		return false;
	}
	if(document.login_member.password.value == "")
	{
		alert('Password harus diisi');
		return false;
	}

return true;	
}
</SCRIPT>