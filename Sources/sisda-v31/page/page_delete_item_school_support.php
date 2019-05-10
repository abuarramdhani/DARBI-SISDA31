<?PHP
//The system need to know whether user already login or not.
//And yes you do, if you are the admin, you may access this page. Otherwise, let the page blank
if(isset($_SESSION["id"]) && ($_SESSION["privilege"] == "2")) {
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
    	<td colspan="3" height="10"></td>
    </tr>
	<tr height="25">
    	<td width="30"></td>
        <td id="text_title_page1" align="center">Edit Item School Support</td>
        <td width="30"></td>
    </tr>
    <tr>
    	<td></td>
    	<td height="10"><hr noshade="noshade" color="#666666" size="1" /></td>
        <td></td>
    </tr>
    <tr>
    	<td></td>
    	<td align="center">
        	<!---====================uhuh uh7h 8uh87 8h8n8hj un7================================-->
            <?PHP
			$src_get_schspt		= "select * from school_support";
			$query_get_schspt	= mysqli_query($mysql_connect, $src_get_schspt) or die (mysql_error());
			?>
			<form method="post" name="reg_adm_siswa" action="mainpage.php?pl=reg_adm_siswa_redirect">             
        	<table width="500" border="0" cellpadding="0" cellspacing="0">            	             
                <tr>
                	<td colspan="13" height="5"></td>
                </tr>
            	<tr height="30">                	
                	<td width="10" bgcolor="#999999"></td>
                    <td width="30" bgcolor="#999999" id="text_normal_white" align="left">No</td>
                    <td width="10" bgcolor="#999999"></td>
                    <td width="50" bgcolor="#999999" id="text_normal_white" align="left">Nama bank</td>
                    <td width="10" bgcolor="#999999"></td>
                    <td width="50" bgcolor="#999999" id="text_normal_white" align="left">Hapus</td>
                    <td width="" bgcolor="#999999"></td>
                </tr>
                <?PHP
				//$bg used to generate zebra background.
				$bg	="#ffffff";	
				
				//this is for row  number, you know...it starts from 0
				$i = 1;
				
				while($get_schspt = mysql_fetch_array($query_get_schspt)) {
				
				//In Deleting process (if user clidks the button). We have to ensure that system will delete the right id only. So we have to protect it
				//Because the id value will be sent via GET method.... bahaya man....
				
				//Ok then, $darby_key taken from sisda_config.php.... dont be ceblinger
				$token_schspt = substr(md5($get_schspt["id"].$darbi_key),0,15);
				?>
                <tr height="30">                	
                	<td bgcolor="<?PHP echo $bg; ?>"></td>
                    <td bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="left"><?= $i++; ?></td>
                    <td bgcolor="<?PHP echo $bg; ?>"></td>
                    <td bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="left"><?= $get_schspt["item"]; ?></td>
                    <td bgcolor="<?PHP echo $bg; ?>"></td>
                    <td bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="left"><input type="button" value="Hapus" onclick="window.location.href='engine.php?case=delete_item_school_support&id=<?= $get_schspt["id"]; ?>&token=<?= $token_schspt; ?>';" /></td>
                    <td bgcolor="<?PHP echo $bg; ?>"></td>
                </tr>
                <?PHP
					if($bg	== "#ffffff") {
						$bg	= "#f1f1f1";
					}
					else {
						$bg	= "#ffffff";
					}
				}
				?>
                <tr>
                	<td colspan="11" height="30"></td>
                </tr>
            </table>
           	</form>
         </td>
         <td></td>
     </tr>
</table>
<?PHP
} else {	
	
	header("location:index.php");
		
}
?>