<?PHP
session_start();

if(isset($_SESSION["id"]) && $_SESSION["privilege"] == "2") {

	$rubah		= $_POST["rubah"];		//echo $kelas."<br><br>";
	$tingkat	= mysql_real_escape_string(htmlspecialchars($_POST["tingkat"])); //echo $tingkat;
	$periode	= mysql_real_escape_string(htmlspecialchars($_POST["periode"])); //echo $periode;
	$nama_kelas	= mysql_real_escape_string(htmlspecialchars($_POST["nama_kelas"])); //echo $periode;
	
	$jumlah_kelas = count($rubah);
	
	//echo "<h1>".$jumlah_kelas."</h1>";
	
	for($i=0; $i <= $jumlah_kelas; $i++) {
	
		if(!isset($rubah[$i])) {
		
			$kkkkkk = "";
		
		} else { 
		
			$src_kelas = $rubah[$i];
			
			if($src_kelas != "") {
			
				$kelas_explode 	=  explode("-",$src_kelas);
				$kelas_siswa	= $kelas_explode[0]; //echo $kelas_siswa;
				$no_sisda		= $kelas_explode[1]; //echo $no_sisda."<br>";
				
				//Yea-yea-yea... come on baby.....
				$src_add_class		= "update siswa_finance set kelas = '$nama_kelas' where no_sisda ='$no_sisda' and tingkat = '$tingkat' and periode = '$periode'";
				//echo $src_add_class;
				$query_add_class	= mysqli_query($mysql_connect, $src_add_class);
				
				if($query_add_class) {
				
					$src_update_kelas_siswa 	= "update siswa set kelas = '$nama_kelas' where no_sisda = '$no_sisda'";
					$query_update_kelas_siswa	= mysqli_query($mysql_connect, $src_update_kelas_siswa) or die(mysql_error()); 
				
				}
			
			}
			
		}
	
	}
	
	
	if($query_add_class) {
		//---------------------------------------
		//here are variables that used in prog_log.php
		include_once("include/url.php");
		$activity	= "Add bank name";
		$url		= curPageURL();
		$id			= $_SESSION["id"];
		$need_log	= true;
		include_once("include/log.php");
		//---------------------------------------
		
		$redirect_path	= "";
		$redirect_icon	= "images/icon_true.png";
		$redirect_url	= "mainpage.php?pl=adm_kelas&kls=$nama_kelas&th=$periode";
		$redirect_text	= "Siswa untuk kelas ".$nama_kelas.", sudah didaftarkan";
		
		$need_redirect	= true;
		include_once ("include/redirect.php");
		
	} else { echo "Kelas gagal ditambahkan, hubungi administator"; }
	
} else { echo "Anda tidak dapat mengakses halaman ini, hubungin administrator"; }
?>