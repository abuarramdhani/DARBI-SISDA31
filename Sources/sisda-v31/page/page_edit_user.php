<?PHP
//Yes you do, if you are the admin, you may access this page. Otherwise, let the page blank
if($_SESSION["privilege"] == "1") {

$id	= $_GET["id"];

$src_user_data		= "select * from user where id='$id'";
$query_user_data	= mysqli_query($mysql_connect, $src_user_data) or die ("There is an error with mysql: ".mysql_error());
$get_user_data		= 
?>
<!-- i dont think that i should give many comments here, hope you understand the script step by step -->
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
    	<td colspan="3" height="10"></td>
    </tr>
	<tr height="25">
    	<td width="30"></td>
        <td id="text_title_page1" align="center">User Management</td>
        <td width="30"></td>
    </tr>
    <tr>
    	<td></td>
    	<td height="10"><hr noshade="noshade" color="#666666" size="1" /></td>
        <td></td>
    </tr>
    <tr>
    	<td></td>
    	<td>
        	<!---====================uhuh uh7h 8uh87 8h8n8hj un7================================-->
        	<form method="post" name="add_user" action="engine.php?case=add_user">
        	<table width="100%" border="0" cellpadding="0" cellspacing="0">
            	<tr height="45">
                    <td width="200" id="text_normal_black" colspan="4"><b>Daftarkan user baru</b><br /> Seluruh field harus dilengkapi</td>
                </tr>
            	<tr height="20">
                	<td width="10" bgcolor="#cccccc"></td>
                    <td width="200" bgcolor="#cccccc" id="text_normal_black">Nama</td>
                    <td width="5"></td>
                    <td><input type="text" name="name" size="35" /></td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr height="20">
                	<td width="10" bgcolor="#cccccc"></td>
                    <td width="200" bgcolor="#cccccc" id="text_normal_black">Username</td>
                    <td width="5"></td>
                    <td><input type="text" name="username" size="35" /></td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr height="20">
                	<td width="10" bgcolor="#cccccc"></td>
                    <td width="200" bgcolor="#cccccc" id="text_normal_black">Password</td>
                    <td width="5"></td>
                    <td><input type="password" name="password1" size="35" /></td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr height="20">
                	<td width="10" bgcolor="#cccccc"></td>
                    <td width="200" bgcolor="#cccccc" id="text_normal_black">Password (conf)</td>
                    <td width="5"></td>
                    <td><input type="password" name="password2" size="35" /></td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr height="20">
                	<td width="10" bgcolor="#cccccc"></td>
                    <td width="200" bgcolor="#cccccc" id="text_normal_black">Hak akses</td>
                    <td width="5"></td>
                    <td>
                    	<select name="privilege">
                        <option value="">Pilih</option>
                        <option value="1">Admin</option>
                        <option value="2">Admin Finance</option>
                        <option value="3">Finance</option>
                        <option value="4">Kepegawaian</option>
                        <option value="5">TK</option>
                        <option value="6">SD</option>
                        <option value="7">SMP</option>
                        <option value="8">ICT</option>
                        <option value="8">Yayasan</option>
                        </select>
                    </td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr height="20">
                	<td width="10" bgcolor="#cccccc"></td>
                    <td width="200" bgcolor="#cccccc" id="text_normal_black">Status aktif</td>
                    <td width="5"></td>
                    <td>
                    	<select name="status">
                        <option value="0">Aktif</option>
                        <option value="1">Non Aktif</option>
                        </select>
                    </td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr height="20">
                	<td width="10"></td>  
                    <td width="200"></td>
                    <td width="5"></td>                  
                    <td colspan="3"><!-- the verification function returned here, in submit button, check the whole script below --><input type="submit" value="Daftarkan user" onClick="return verification()"/><input type="reset" value="Kosongkan" /></td>
                </tr>
            </table>            
            </form>
		</td>
     </tr>
</table>
<?PHP
}
?>