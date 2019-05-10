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
        <td id="text_title_page1" align="center">Edit Nominal (Special case)</td>
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
            <table width="500" border="0" cellpadding="0" cellspacing="0">
            	<tr>
                    <td align="left" height="30"></td>
                </tr>	
                <tr>
                    <td align="center">
                    <button name="SPP" style="width:300px; height:30px; font-size:16px; background-color:#006666; color:#FFFFFF;" value="Edit nominal SPP" onclick="window.location.href='?pl=edit_nominal_special_case_spp';">Edit nominal SPP</button><br />
                   	</td>
                </tr>
                <tr>
                    <td align="left" height="5"></td>
                </tr>
                <tr>
                    <td align="center">
                    <button name="catering" style="width:300px; height:30px; font-size:16px; background-color:#006666; color:#FFFFFF;" value="Edit nominal Catering" onclick="window.location.href='?pl=edit_nominal_special_case_catering';">Edit nominal Catering</button><br />
                    </td>
                </tr>
                <tr>
                    <td align="left" height="5"></td>
                </tr>
                <tr>
                    <td align="center">
                    <button name="antar_jemput" style="width:300px; height:30px; font-size:16px; background-color:#006666; color:#FFFFFF;" value="Edit nominal Antar Jemput" onclick="window.location.href='?pl=edit_nominal_special_case_antar_jemput';">Edit nominal Antar Jemput</button>
                    </td>
                </tr>
                <tr>
                    <td align="left" height="30"></td>
                </tr>
            </table>
         </td>
         <td></td>
     </tr>
</table>
<?PHP
} else {	
	
	header("location:index.php");
		
}
?>