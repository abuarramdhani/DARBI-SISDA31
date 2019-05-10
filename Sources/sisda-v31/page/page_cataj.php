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
        <td id="text_title_page1" align="center">Setting biaya Catering dan Antar Jemput</td>
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
            <form name="add_cataj" method="post" action="engine.php?case=add_cataj">
            <table border="0" cellpadding="0" cellspacing="0">
            	<tr>
                	<td align="left" id="text_normal_black">Type layanan</td>
                    <td width="10">&nbsp;</td>
                	<td>
                    <select name="type">
                    <option value="">pilih</option>
                    <option value="Catering">Catering</option>
                    <option value="Antar Jemput">Antar Jemput</option>
                    </select>
                    </td>
                </tr>
            	<tr>
                	<td align="left" id="text_normal_black">Nama penyedia layanan</td>
                    <td></td>
                    <td align="left" id="text_normal_black"><input type="text" name="name" size="25" /></td>
                </tr>
                <tr>
                	<td align="left" id="text_normal_black">Opsi</td>
                    <td></td>
                    <td align="left" id="text_normal_black"><input type="text" name="opsi" size="25" /></td>
                </tr>
                <tr>
                	<td align="left" id="text_normal_black">Nominal (dalam rupiah)</td>
                    <td></td>
                    <td align="left" id="text_normal_black"><input type="text" name="nominal" size="25" onkeypress="return checkIt(event)"/></td>
                </tr>
                <tr>
                	<td></td>
                    <td></td>
                	<td><input type="submit" value="Tambahkan Catering/Antar Jemput" onClick="return verification()"/></td>
                </tr>
            </table>
            <table width="100%">
            	<tr>
                	<td height="30"><hr noshade="noshade" size="1" color="#999999" /></td>
                </tr>
            </table>
            </form>
            <?PHP
			$src_get_cataj		= "select * from cataj";
			$query_get_cataj	= mysqli_query($mysql_connect, $src_get_cataj) or die (mysql_error());
			
			$num_get_cataj		= mysql_num_rows($query_get_cataj);
			
			if($num_get_cataj != 0) {
			?>
			<form method="post" name="edit_cataj" action="mainpage.php?pl=del_cataj">             
        	<table width="600" border="0" cellpadding="0" cellspacing="0">            	             
                <tr>
                	<td colspan="13" height="5"></td>
                </tr>
            	<tr height="30">                	
                	<td width="10" bgcolor="#999999"></td>
                    <td width="10" bgcolor="#999999" id="text_normal_white" align="left">No</td>
                    <td width="30" bgcolor="#999999"></td>
                    <td width="100" bgcolor="#999999" id="text_normal_white" align="left">type</td>
                    <td width="30" bgcolor="#999999"></td>
                    <td width="" bgcolor="#999999" id="text_normal_white" align="left">nama</td>
                    <td width="30" bgcolor="#999999"></td>
                    <td width="50" bgcolor="#999999" id="text_normal_white" align="left">opsi</td>
                    <td width="30" bgcolor="#999999"></td>
                    <td width="100" bgcolor="#999999" id="text_normal_white" align="left">nominal</td>
                    <td width="30" bgcolor="#999999"></td>
                    <td width="50" bgcolor="#999999" id="text_normal_white" align="left">Delete</td>
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
                    <td bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="left"><?= $get_cataj["type"]; ?></td>
                    <td bgcolor="<?PHP echo $bg; ?>"></td>
                    <td bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="left"><?= $get_cataj["name"]; ?></td>
                    <td bgcolor="<?PHP echo $bg; ?>"></td>
                    <td bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="left"><?= $get_cataj["opsi"]; ?></td>
                    <td bgcolor="<?PHP echo $bg; ?>"></td>
                    <td bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="left">Rp. <?= $get_cataj["nominal"]; ?></td>
                    <td bgcolor="<?PHP echo $bg; ?>"></td>
                    <td bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="left">Delete</td>
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

	if(document.add_cataj.type.value == "") {
		alert('Field "Tipe layanan" tidak boleh kosong');
		return false;
	}
	if(document.add_cataj.name.value == "") {
		alert('Field "Nama penyedia layanan" tidak boleh kosong');
		return false;
	}
	if(document.add_cataj.nominal.value == "") {
		alert('Field "Nominal" tidak boleh kosong');
		return false;
	}
	
	return true;	
}
</SCRIPT>