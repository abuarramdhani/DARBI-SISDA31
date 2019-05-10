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
        <td id="text_title_page1" align="center">Kelas</td>
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
			$src_get_kelas		= "select * from kelas";
			$query_get_kelas	= mysqli_query($mysql_connect, $src_get_kelas) or die (mysql_error());
			
			$cur_month	= strtolower(date("F"));
			$cur_year	= date("Y");
			
			if($cur_month == "january" || $cur_month == "february" || $cur_month == "march" || $cur_month == "april" || $cur_month == "may" || $cur_month == "june") {	
	
				$edu_year0	= ($cur_year-2)." - ".($cur_year-1);	
				$edu_year1	= ($cur_year-1)." - ".($cur_year);		
				$edu_year2	= ($cur_year)." - ".($cur_year+1);
					
				$show0	= ($cur_year-2)." - ".($cur_year-1)." ke ".($cur_year-1)." - ".($cur_year);	
				$show1	= ($cur_year-1)." - ".($cur_year)." ke ".($cur_year)." - ".($cur_year+1);
				$show2	= ($cur_year)." - ".($cur_year+1)." ke ".($cur_year+1)." - ".($cur_year+2);
				
				$check0	= ($cur_year-1)." - ".($cur_year);
				$check1	= ($cur_year)." - ".($cur_year+1);
				$check2	= ($cur_year+1)." - ".($cur_year+2);
				
			} else if ($cur_month == "july" || $cur_month == "august" || $cur_month == "september" || $cur_month == "october" || $cur_month == "november" || $cur_month == "december") {	
				$edu_year0	= ($cur_year-1)." - ".($cur_year);		
				$edu_year1	= ($cur_year)." - ".($cur_year+1);		
				$edu_year2	= ($cur_year+1)." - ".($cur_year+2);	
				
				$show0	= ($cur_year-1)." - ".($cur_year)." ke ".($cur_year)." - ".($cur_year+1);
				$show1	= ($cur_year)." - ".($cur_year+1)." ke ".($cur_year+1)." - ".($cur_year+2);
				$show2	= ($cur_year+2)." - ".($cur_year+2)." ke ".($cur_year+1)." - ".($cur_year+3);
				
				$check0	= ($cur_year)." - ".($cur_year+1);
				$check1	= ($cur_year+1)." - ".($cur_year+2);
				$check2	= ($cur_year+1)." - ".($cur_year+3);
					
			}
			?>          
        	<table width="600" border="0" cellpadding="0" cellspacing="0">            	             
                <tr>
                	<td colspan="3" height="5"></td>
                </tr>
                <tr height="30">                	
                	<td align="center"><button style="width:250px; height:45px; text-align:left; left:30px; background-color:#006699; color:#ffffff;" onclick="window.location='?pl=adm_kelas&th=<?= $check0; ?>';">Siswa yang belum mendapat kelas <br />[<?= $check0; ?>] </button></td>
                	<td width="30">&nbsp;</td>
                    <td align="center"><button style="width:250px; height:45px; text-align:left; left:30px; background-color:#006699; color:#ffffff;" onclick="window.location='?pl=adm_kelas&th=<?= $check1; ?>';">Siswa yang belum mendapat kelas <br />[<?= $check1; ?>]</button></td>
                </tr>
                <tr>
                	<td colspan="3" height="10">&nbsp;</td>
                </tr>
                <form method="post" action="?pl=adm_kelas">
                <?PHP
				$i = 1;
				
				while($get_kelas = mysql_fetch_array($query_get_kelas)) {
				
				//In Deleting process (if user clidks the button). We have to ensure that system will delete the right id only. So we have to protect it
				//Because the id value will be sent via GET method.... bahaya man....
				?>
                <tr height="30">                	
                	<td align="center"><input type="submit" name="manage_kelas" value="[<?= $check0; ?>] <?= $get_kelas["nama_kelas"]; ?>" style="width:250px; height:35px; text-align:left; left:30px;"></td>
                	<td width="30">&nbsp;</td>
                    <td align="center"><input type="submit" name="manage_kelas" value="[<?= $check1; ?>] <?= $get_kelas["nama_kelas"]; ?>" style="width:250px; height:35px; text-align:left; left:30px;"></td>
                </tr>
                <?PHP
				}
				?>
                </form>
                <tr>
                	<td colspan="3" height="30"></td>
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