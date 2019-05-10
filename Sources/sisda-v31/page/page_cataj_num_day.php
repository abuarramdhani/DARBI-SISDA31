<?PHP
//The system need to know whether user already login or not.
//And yes you do, if you are the admin, you may access this page. Otherwise, let the page blank
if(isset($_SESSION["id"]) && ($_SESSION["privilege"] == "2")) {
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
    	<td colspan="3" height="30"></td>
    </tr>
	<tr height="25">
    	<td width="30"></td>
        <td id="text_title_page1" align="center">Setting jumlah hari Catering dan Antar Jemput</td>
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
            <form name="add_cataj" method="post" action="engine.php?case=add_cataj_num_day">
            <table width="600" border="0" cellpadding="0" cellspacing="0">
            	<tr>
                    <td align="left" id="text_normal_black">
                    <select name="month" style="weight:100px; height:25px; font-size:14px;">
                    <option value="" style="color:#FF6600;">Bulan</option>
                    <option value="1">Januari</option>
                    <option value="2">Februari</option>
                    <option value="3">Maret</option>
                    <option value="4">April</option>
                    <option value="5">Mei</option>
                    <option value="6">Juni</option>
                    <option value="7">Juli</option>
                    <option value="8">Agustus</option>
                    <option value="9">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
					</select>
                    </td>
                </tr>
                <tr>
                	<td align="left" id="text_normal_black">
					<select name="periode" style="weight:100px; height:25px; font-size:14px;">
                    <option value="" style="color:#FF6600">Tahun ajaran</option>
					<?PHP include("include/education_year_cataj.php"); ?>
                    </select>
                    </td>
                </tr>
                <tr>
                	<td align="left">
                    <select name="catering_num_day" style="weight:100px; height:25px; font-size:14px;">
                    <option value="" style="color:#FF6600">Jumlah hari Catering</option>
                    <option value="0">Tidak ada catering</option>
                    <?PHP
					for($i=1; $i<32; $i++) {
					?>
                    <option value="<?= $i; ?>"><?= $i; ?> hari</option>
                    <?PHP
					}
					?>
                    </select>
                    </td>
               </tr>
               <tr>
                    <td align="left">
                    <select name="antar_jemput_num_day" style="weight:100px; height:25px; font-size:14px;">
                    <option value="" style="color:#FF6600">Jumlah hari antar jemput</option>
                    <option value="0">Tidak ada antar jemput</option>
                    <option value="1">kurang sepuluh hari</option>
                    <option value="2">1 bulan penuh</option>
                    </select>
                    </td>
                </tr>                
                <tr>
                	<td><input type="submit" value="Tambahkan Jumlah Hari Catering/Antar Jemput" onClick="return verification()" style="width:350px; height:40px; font-size:14px; color:#FFFFFF; background-color:#336699;"/> <img src="images/what_happen_aya_naon.jpg" border="0" onMouseOver="stm(Text[3],Style[12])" onMouseOut="htm()" /></td>
                </tr>
            </table>
            <table width="100%">
            	<tr>
                	<td height="30"><hr noshade="noshade" size="1" color="#999999" /></td>
                </tr>
            </table>
            </form>
            <?PHP
			$src_get_cataj		= "select * from cataj_num_day";
			$query_get_cataj	= mysqli_query($mysql_connect, $src_get_cataj) or die (mysql_error());
			
			$num_get_cataj		= mysql_num_rows($query_get_cataj);
			
			if($num_get_cataj != 0) {
			?>
			<form method="post" name="edit_cataj" action="mainpage.php?pl=del_cataj">             
        	<table width="800" border="0" cellpadding="0" cellspacing="0">            	             
                <tr>
                	<td colspan="13" height="5"></td>
                </tr>
            	<tr height="30">                	
                	<td width="10" bgcolor="#999999"></td>
                    <td width="10" bgcolor="#999999" id="text_normal_white" align="left">No</td>
                    <td width="30" bgcolor="#999999"></td>
                    <td width="100" bgcolor="#999999" id="text_normal_white" align="left">Tahun Ajaran</td>
                    <td width="30" bgcolor="#999999"></td>
                    <td width="" bgcolor="#999999" id="text_normal_white" align="left">Bulan</td>
                    <td width="30" bgcolor="#999999"></td>
                    <td width="150" bgcolor="#999999" id="text_normal_white" align="left">Jumlah hari catering</td>
                    <td width="30" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white" align="left">Jumlah hari antar jemput</td>
                    <td width="30" bgcolor="#999999"></td>
                    <td width="50" bgcolor="#999999" id="text_normal_white" align="left">Rubah</td>
                    <td width="10" bgcolor="#999999"></td>
                </tr>
                <?PHP
				//$bg used to generate zebra background.
				$bg	="#ffffff";	
				
				//this is for row  number, you know...it starts from 0
				$i = 1;
				
				while($get_cataj = mysql_fetch_array($query_get_cataj)) {
				
				//In Deleting process (if user clidks the button). We have to ensure that system will delete the right id only. So we have to protect it
				//Because the id value will be sent via GET method.... bahaya man....
				
				//Ok then, $darby_key taken from sisda_config.php.... dont be ceblinger
				$token_bank = substr(md5($get_cataj["id"].$darbi_key),0,15);
				?>
                <tr height="30">                	
                	<td bgcolor="<?PHP echo $bg; ?>"></td>
                    <td bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="left"><?= $i++; ?></td>
                    <td bgcolor="<?PHP echo $bg; ?>"></td>
                    <td bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="left"><?= $get_cataj["periode"]; ?></td>
                    <td bgcolor="<?PHP echo $bg; ?>"></td>
                    <td bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="left"><?php
					if($get_cataj["month"] == 1) { echo "Januari"; }  
                    if($get_cataj["month"] == 2) { echo "Februari"; }  
					if($get_cataj["month"] == 3) { echo "Maret"; }  
					if($get_cataj["month"] == 4) { echo "April"; }  
					if($get_cataj["month"] == 5) { echo "Mei"; } 
					if($get_cataj["month"] == 6) { echo "Juni"; } 
					if($get_cataj["month"] == 7) { echo "July"; } 
					if($get_cataj["month"] == 8) { echo "Agustus"; } 
					if($get_cataj["month"] == 9) { echo "September"; } 
					if($get_cataj["month"] == 10) { echo "Oktober"; } 
					if($get_cataj["month"] == 11) { echo "November"; } 
					if($get_cataj["month"] == 12) { echo "Desember"; } 
					?></td>
                    <td bgcolor="<?PHP echo $bg; ?>"></td>
                    <td bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="left"><?= $get_cataj["catering"]; ?> hari</td>
                    <td bgcolor="<?PHP echo $bg; ?>"></td>
                    <td bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="left">
					<?PHP
					if($get_cataj["antar_jemput"] == 2) { echo "1 bulan penuh"; } 
					if($get_cataj["antar_jemput"] == 1) { echo "kurang dari 10 hari"; } 
					if($get_cataj["antar_jemput"] == 0) { echo "Tidak ada antar jemput"; } 
					?></td>
                    <td bgcolor="<?PHP echo $bg; ?>"></td>
                    <td bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="left">Rubah</td>
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
            <?PHP
			}
			?>
         </td>
         <td></td>
     </tr>
</table>
<?PHP
} else {	
	
	header("location:index.php");
		
}
?>
<SCRIPT LANGUAGE="JavaScript">
function checkIt(evt)
{
    evt = (evt) ? evt : window.event
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
    {
        alert ( "Hanya boleh diisi dengan angka." );
        return false
    }
    status = ""
    return true
}
</SCRIPT>

<SCRIPT type="text/javascript" >
function verification() { 

	if(document.add_cataj.month.value == "") {
		alert('Field "bulan" tidak boleh kosong');
		return false;
	}
	
	if(document.add_cataj.periode.value == "") {
		alert('Field "Tahun ajaran" tidak boleh kosong');
		return false;
	}
	
	if(document.add_cataj.catering_num_day.value == "") {
	
		if(document.add_cataj.antar_jemput_num_day.value == "") {
		
			alert('Silakan pilih jumlah hari untuk catering atau antar jemput');
			return false;
		}
	}
	
	return true;	
}
</SCRIPT>