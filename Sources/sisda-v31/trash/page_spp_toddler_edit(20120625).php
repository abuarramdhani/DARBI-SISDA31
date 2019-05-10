<?PHP
//The system need to know whether user already login or not.
//And yes you do, if you are the admin, you may access this page. Otherwise, let the page blank
if(isset($_SESSION["id"]) && $_SESSION["privilege"] == "2") {
?>
    <!-- i dont think that i should give many comments here, hope you understand the script step by step -->
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td colspan="3" height="10"></td>
        </tr>
        <tr height="25">
            <td width="30"></td>
            <td id="text_title_page1" align="center"><h2 style="padding:0px;">--- TODDLER ---</h2>Pengaturan Nominal SPP, ICT dan pembayaran lainnya per periode</td>
            <td width="30"></td>
        </tr>
        <tr>
            <td></td>
            <td height="10"><hr noshade="noshade" color="#666666" size="1" /></td>
            <td></td>
        </tr>
        <tr>        
            <td colspan="3" height="20"></td>
        </tr>
    </table>
    <?PHP
	$the_periode	= htmlspecialchars($_GET["per"]);
	$the_level		= "toddler";
	
	$the_periode_enc	= mysql_real_escape_string($the_periode);
	$the_level_enc		= mysql_real_escape_string($the_level);
	
	$src_get_spp	= "select * from set_spp where periode = '$the_periode_enc' and level = '$the_level_enc'";
	$query_get_spp	= mysqli_query($mysql_connect, $src_get_spp) or die("There is an error with mysql: ".mysql_error());
	?>
	<form method="post" name="set_spp" action="engine.php?case=spp_toddler_edit">
    <table width="100%" border="0" cellpadding="0" cellspacing="0" >
    	<tr>
            <td width="30"></td>
            <td>
                <table width="100%" border="1" cellpadding="0" cellspacing="0" id="text_normal_white" style="text-align:center;">
                    <tr height="25" bgcolor="#333333">
                        <td colspan="5">Tahun pelajaran: <input type="text" size="10" readonly="readonly" name="period" value="<?PHP echo $the_periode; ?>" /><input type="hidden" name="level" value="toddler" /></td>
                    </tr>
                    <tr height="25" bgcolor="#333333" id="text_normal_white">
                        <td>Jenjang</td>
                        <td>Keterangan</td>
                        <td>SPP</td>
                        <td>ICT</td>
                        <td>Komite sekolah</td>
                    </tr>
					<?PHP
					//let's check the discount period for every level
					// here we go
					
					//level 1
					$lev1_1_min_period	= 	substr($the_periode,-9,2);
					$lev1_1_max_period	=	substr($the_periode,-2,2);
					
					//here is the form fields going
					$i = 1;
                    while($row_get_spp	= mysql_fetch_array($query_get_spp)) {
						////////////////////////////////////////////////////////////////////////////////////////////////////////
						if($row_get_spp["jenjang"] == 1) {
							if($row_get_spp["ket_disc"] == ($lev1_1_min_period.$lev1_1_max_period) && $row_get_spp["item_byr"] == "spp") {
					?>
                                <tr height="25" bgcolor="#83736c">
                                    <td rowspan="5">Kelas 1</td>
                                    <td><?PHP echo $lev1_1_min_period."-".$lev1_1_max_period; ?></td>
                                    <td><?PHP if($row_get_spp["item_byr"] == "spp") { ?><input type="text" size="10" name="1-per1-spp" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP
							}
							if($row_get_spp["ket_disc"] == ($lev1_1_min_period.$lev1_1_max_period) && $row_get_spp["item_byr"] == "ict") {
					?>                
                                    <td><?PHP if($row_get_spp["item_byr"] == "ict") { ?><input type="text" size="10" name="1-per1-ict" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP
							}
							if($row_get_spp["ket_disc"] == ($lev1_1_min_period.$lev1_1_max_period) && $row_get_spp["item_byr"] == "add") {
					?>                
                                    <td><?PHP if($row_get_spp["item_byr"] == "add") { ?><input type="text" size="10" name="1-per1-add" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                                </tr>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == "angu" && $row_get_spp["item_byr"] == "spp") {
					?>
                    			<tr height="25" bgcolor="#83736c">
                                    <td>Anak guru</td>
                                    <td><?PHP if($row_get_spp["item_byr"] == "spp") { ?><input type="text" size="10" name="1-angu-spp" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP
							}
							if($row_get_spp["ket_disc"] == "angu" && $row_get_spp["item_byr"] == "ict") {
					?>								               
                                    <td><?PHP if($row_get_spp["item_byr"] == "ict") { ?><input type="text" size="10" name="1-angu-ict" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP
							}
							if($row_get_spp["ket_disc"] == "angu" && $row_get_spp["item_byr"] == "add") {
					?>
                                    <td><?PHP if($row_get_spp["item_byr"] == "add") { ?><input type="text" size="10" name="1-angu-add" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                                </tr>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == "dis1" && $row_get_spp["item_byr"] == "spp") {
					?>
                                <tr height="25" bgcolor="#83736c">
                                    <td>Discount khusus 1</td>
                                    <td><?PHP if($row_get_spp["item_byr"] == "spp") { ?><input type="text" size="10" name="1-dis1-spp" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == "dis1" && $row_get_spp["item_byr"] == "ict") {
					?>                
                                    <td><?PHP if($row_get_spp["item_byr"] == "ict") { ?><input type="text" size="10" name="1-dis1-ict" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == "dis1" && $row_get_spp["item_byr"] == "add") {
					?>
                                    <td><?PHP if($row_get_spp["item_byr"] == "add") { ?><input type="text" size="10" name="1-dis1-add" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                                </tr>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == "dis2" && $row_get_spp["item_byr"] == "spp") {
					?>
                    			<tr height="25" bgcolor="#83736c">
                                    <td>Discount khusus 2</td>
                                    <td><?PHP if($row_get_spp["item_byr"] == "spp") { ?><input type="text" size="10" name="1-dis2-spp" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == "dis2" && $row_get_spp["item_byr"] == "ict") {
					?>                
                                    <td><?PHP if($row_get_spp["item_byr"] == "ict") { ?><input type="text" size="10" name="1-dis2-ict" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == "dis2" && $row_get_spp["item_byr"] == "add") {
					?>                
                                    <td><?PHP if($row_get_spp["item_byr"] == "add") { ?><input type="text" size="10" name="1-dis2-add" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                                </tr>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == "dis3" && $row_get_spp["item_byr"] == "spp") {
					?>
                    			<tr height="25" bgcolor="#83736c">
                                    <td>Discount khusus 3</td>
                                    <td><?PHP if($row_get_spp["item_byr"] == "spp") { ?><input type="text" size="10" name="1-dis3-spp" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == "dis3" && $row_get_spp["item_byr"] == "ict") {
					?>                
                                    <td><?PHP if($row_get_spp["item_byr"] == "ict") { ?><input type="text" size="10" name="1-dis3-ict" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == "dis3" && $row_get_spp["item_byr"] == "add") {
					?>               
                                    <td><?PHP if($row_get_spp["item_byr"] == "add") { ?><input type="text" size="10" name="1-dis3-add" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                                </tr>
                    <?PHP		
							}
						}
                    }
                    ?>
                    <tr height="60" bgcolor="#333333">
                        <td colspan="5" align="center"><input style="background:#006699; color:#FFFFFF; width:200px; height:45px;" type="submit" value="Simpai nilai SPP" onClick="return verification()"/> <input type="button" value="Batal dan kembali" onClick="document.location='mainpage.php?pl=spp_toddler_setting'" /></td>
                    </tr>
    			</table>
            </td>
            <td width="30"></td>
        </tr>
        <tr>
        	<td colspan="3" height="20"></td>
        </tr>
    </table>
</form>
<?PHP
}
?>
<!-- sandy said: form verifiation start form here buddy...:)-->
<SCRIPT type="text/javascript" >
function verification() 
{ 
	if(document.set_spp.period.value == "")
	{
		alert('Anda harus memilih Tahun Pelajaran untuk melengkapi form isian SPP');
		return false;
	}
	
return true;	
}
</SCRIPT>

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