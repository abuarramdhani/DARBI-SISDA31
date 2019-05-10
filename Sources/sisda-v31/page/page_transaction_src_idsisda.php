<?PHP
//Yes you do, if you are the admin, you may access this page. Otherwise, let the page blank
if(isset($_SESSION["id"]) && ($_SESSION["privilege"] == "2")) {

	?>
<!-- i dont think that i should give many comments here, hope you understand the script step by step -->
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
    	<td colspan="3" height="10"></td>
    </tr>
	<tr height="25">
    	<td width="30"></td>
        <td id="text_title_page1" align="center">Transaksi</td>
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
        	<?PHP
        	if(!empty($_POST["no_sisda"]) || !empty($_POST["tingkat"]) || !empty($_POST["nama_siswa"])) {
	
                $src_sisda 		= empty($_POST["no_sisda"]) ? "" : $_POST["no_sisda"];
                $src_tingkat   	= empty($_POST["tingkat"]) ? "" : $_POST["tingkat"];
                $nama_siswa 	= empty($_POST["nama_siswa"]) ? "" : $_POST["nama_siswa"];
				
				echo $src_sisda;
                
                $src_get_data_siswa		= "select * from siswa where no_sisda = '$src_sisda' and nama_siswa like '%$nama_siswa%' and tingkat like '%$src_tingkat%'";
                $query_get_data_siswa	= mysqli_query($mysql_connect, $src_get_data_siswa) or die("terjadi kesalahan: ".mysql_error());
				
				echo $num = mysql_num_rows($query_get_data_siswa);
				echo $src_get_data_siswa;
             ?>
            <table border="0" cellpadding="0" cellspacing="0">            	
            	<tr height="45">
                    <td id="text_normal_black" colspan="7">No</td>
                </tr> 
             <?PHP  
			 	$i1 = 0; 
				while($row_get_data_siswa = mysql_fetch_array($query_get_data_siswa)) {
			?>		
				<tr>
                	<td><?= $row_get_data_siswa["no_sisda"]; ?></td>
                    <td><?= $row_get_data_siswa["nama_siswa"]; ?></td>
                    <td><?= $row_get_data_siswa["tingkat"]; ?></td>
                    <td><?= $row_get_data_siswa["no_sisda"]; ?></td>
                    <td><?= $row_get_data_siswa["no_sisda"]; ?></td>
                    <td></td>
                    <td></td>
                </tr>	
			<?PHP		
				}
			?>
            	<tr>
                	<td height="5" bgcolor="#ffffff" colspan="7"></td>
                </tr>
            </table>
			<?PHP
            }
			?>  
        	<!---====================uhuh uh7h 8uh87 8h8n8hj un7================================-->
            <table border="0" cellpadding="0" cellspacing="0">            	
            	<tr height="45">
                    <td id="text_normal_black" colspan="7"><input type="button" value="Lihat seluruh siswa" onclick="javascript:void window.open('popup.php?pl=chk_no_sisda','','width=700,height=500,toolbar=0,location=0,status=0,scrollbars=0,resizable=0,left=0,top=0'); return false;" style="width:300px; height:40px; background-color:#336666; color:#FFFFFF;" /></td>
                </tr>
            </table>
            <form id="form" method="post" action="mainpage.php?pl=transaction" style="padding:0px; ">
            <?PHP //<form id="form" method="post" action="#" style="padding:0px; "> ?>
        	<table border="0" cellpadding="0" cellspacing="0">            	
            	<tr height="30">
                    <td id="text_normal_black" colspan="7">Silakan masukan <b>nama siswa</b> yang akan melakukan transaksi pembayaran</td>
                </tr>
                <tr>
                	<td height="5" bgcolor="#ffffff" colspan="7"></td>
                </tr>
                <tr>
                	<td width="5" bgcolor="#ffffff"></td>
                	<td height="10" colspan="5" bgcolor="#f1f1f1">&nbsp;</td>
                    <td width="5" bgcolor="#ffffff"></td>
                </tr>
            	<tr height="20">
                	<td width="5" bgcolor="#ffffff"></td>
                	<td width="10" bgcolor="#f1f1f1"></td>
                    <td bgcolor="#f1f1f1" id="text_normal_black" align="right"></td>
                    <td width="5" bgcolor="#f1f1f1"></td>
                    <td bgcolor="#f1f1f1" align="center">
                    <link media="screen" type="text/css" rel="stylesheet" href="global_style/auto_suggest_form.css">
                    <script type="text/javascript" src="global_js/jquery_1.3.2.js"></script>
                    <script type="text/javascript" src="global_js/auto_suggest_form_id_sisda.js"></script>
                        
                    <div id="suggest">
                    <input type="text" size="25" name="no_sisda" value="" id="sisda_id" onkeyup="suggest(this.value);" onblur="fill();" class="" placeholder="Nama siswa" style="width:300px; height:35px;" />                         
                    <div class="suggestionsBox" id="suggestions" style="display: none; padding:0px;"> <!--<img src="arrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />-->
                        <div class="suggestionList" id="suggestionsList" style="padding:0px;"> &nbsp; </div>
                    </div>
                    </div>
                    <span style="height:10px;"></span>
                    </td>
                    <td width="10" bgcolor="#f1f1f1"></td>
                    <td width="5" bgcolor="#ffffff"></td>
                </tr>
                <tr height="10">
                	<td width="5" bgcolor="#ffffff"></td>
                	<td width="10" bgcolor="#f1f1f1"></td>
                    <td colspan="3" bgcolor="#f1f1f1"><hr size="1" noshade="noshade" /></td>
                    <td width="10" bgcolor="#f1f1f1"></td>
                    <td width="5" bgcolor="#ffffff"></td>
                </tr>
                <tr height="20">
                	<td width="5" bgcolor="#ffffff"></td>
                	<td width="10" bgcolor="#f1f1f1"></td>  
                    <td bgcolor="#f1f1f1"></td>
                    <td width="5" bgcolor="#f1f1f1"></td>                  
                    <td bgcolor="#f1f1f1" align="center"><!-- the verification function returned here, in submit button, check the whole script below --><input type="submit" value="Lakukan transaksi" onClick="return verification()" style="width:208px; height:35px;"/><input type="reset" value="Kosongkan" style="width:100px; height:35px;"/></td>
                	<td width="10" bgcolor="#f1f1f1"></td>
                    <td width="5" bgcolor="#ffffff"></td>
                </tr>
                <tr>
                	<td width="5" bgcolor="#ffffff"></td>
                	<td height="10" colspan="5" bgcolor="#f1f1f1">&nbsp;</td>
                    <td width="5" bgcolor="#ffffff"></td>
                </tr>
                <tr>
                	<td height="5" bgcolor="#ffffff" colspan="7"></td>
                </tr>
            </table> 
            </form>
            <span style="height:40px;">&nbsp;</span>
            <form name="transaction_chk_error" method="post" action="mainpage.php?pl=transaction_chk_error" style="padding:0px; ">
            <?PHP //<form id="form" method="post" action="#" style="padding:0px; "> ?>
        	<table border="0" cellpadding="0" cellspacing="0">            	
            	<tr height="30">
                    <td id="text_normal_black" colspan="7">Silakan masukan <b style="color:#990000;">no sisda</b> siswa yang tidak dapat melakukan transaksi pembayaran</td>
                </tr>
                <tr>
                	<td height="5" bgcolor="#ffffff" colspan="7"></td>
                </tr>
                <tr>
                	<td width="5" bgcolor="#ffffff"></td>
                	<td height="10" colspan="5" bgcolor="#996666">&nbsp;</td>
                    <td width="5" bgcolor="#ffffff"></td>
                </tr>
            	<tr height="20">
                	<td width="5" bgcolor="#ffffff"></td>
                	<td width="10" bgcolor="#996666"></td>
                    <td bgcolor="#996666" id="text_normal_black" align="right"></td>
                    <td width="5" bgcolor="#996666"></td>
                    <td bgcolor="#996666" align="center">
                    <input type="text" size="25" name="no_sisda" value=""/>  
                    </td>
                    <td width="10" bgcolor="#996666"></td>
                    <td width="5" bgcolor="#ffffff"></td>
                </tr>
                <tr height="10">
                	<td width="5" bgcolor="#ffffff"></td>
                	<td width="10" bgcolor="#996666"></td>
                    <td colspan="3" bgcolor="#996666"><hr size="1" noshade="noshade" /></td>
                    <td width="10" bgcolor="#996666"></td>
                    <td width="5" bgcolor="#ffffff"></td>
                </tr>
                <tr height="20">
                	<td width="5" bgcolor="#ffffff"></td>
                	<td width="10" bgcolor="#996666"></td>  
                    <td bgcolor="#996666"></td>
                    <td width="5" bgcolor="#996666"></td>                  
                    <td bgcolor="#996666" align="center"><!-- the verification function returned here, in submit button, check the whole script below --><input type="submit" value="Periksa data keuangan siswa" onClick="return verification2()" style="width:208px; height:35px;"/><input type="reset" value="Kosongkan" style="width:100px; height:35px;"/></td>
                	<td width="10" bgcolor="#996666"></td>
                    <td width="5" bgcolor="#ffffff"></td>
                </tr>
                <tr>
                	<td width="5" bgcolor="#ffffff"></td>
                	<td height="10" colspan="5" bgcolor="#996666">&nbsp;</td>
                    <td width="5" bgcolor="#ffffff"></td>
                </tr>
                <tr>
                	<td height="5" bgcolor="#ffffff" colspan="7"></td>
                </tr>
            </table> 
            </form>
		</td>
        <td></td>
     </tr>
     <tr>
    	<td colspan="3" height="10"></td>
    </tr>
</table>
<?PHP
}
?>
<SCRIPT type="text/javascript" >
function verification() 
{ 
	if(document.select_no_sisda.no_sisda.value == "")
	{
		alert('Nomor sisda harus diisi');
		return false;
	}

return true;	
}

function verification2() 
{ 
	if(document.transaction_chk_error.no_sisda.value == "")
	{
		alert('Nomor sisda harus diisi');
		return false;
	}

return true;	
}
</SCRIPT>