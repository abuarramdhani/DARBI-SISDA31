<?PHP
//sandy said: used id member already login
if($need_redirect) {	
	header("refresh:3; url=".$darbi_url.$redirect_url);
?>
<html>
<head>
<link media="screen" type="text/css" rel="stylesheet" href="<?PHP echo $redirect_path; ?>style.css">
<link rel="shortcut icon" href="<?PHP echo $redirect_path; ?>logo_icon.png">
</head>

<CENTER>
<BODY leftmargin="0" rightmargin="0" topmargin="0" bottommargin="0">
<?PHP include("style_head.php"); ?>
<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0" >
    <tr>
        <td align="center">
            <table width="520" border="0" cellpadding="0" cellspacing="0" background="images/bg_login_center.png">            	
            	<tr>
                	<td height="10" colspan="3"></td>
                </tr>
                <tr>
                	<td height="70"></td>
                    <td><img src="<?PHP echo $redirect_path; ?>images/logo.png"></td>
                    <td></td>
                </tr>
                <tr>
                	<td height="40" colspan="3" valign="bottom" align="center"><IMG src="<?PHP echo $redirect_path.$redirect_icon; ?>"></td>
                </tr>
                <tr>
                    <td height="110" width="30"></td>
                    <td id="text_redirect" align="center" valign="center"><?PHP echo $redirect_text; ?></td>
                    <td width="30"></td>
                </tr>
                <tr>
                	<td height="30" colspan="3" align="center" id="text_redirect"><A href="<?PHP echo $redirect_path.$redirect_url; ?>">klik disini jika Anda tidak berpindah kehalaman berikutnya</A></td>
                </tr>
                <tr>
                	<td height="10" colspan="3"></td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</BODY>
</CENTER>
</html>
<?PHP	
}
?>