<?PHP
include_once("../sisda-config.php");
$sender_no_sisda		= $_POST["no_sisda"]; 		//echo "sender_no_sisda: ".$sender_no_sisda."<br>";
$sender_nama_siswa		= $_POST["nama_siswa"];  	//echo "sender_nama_siswa: ".$sender_nama_siswa."<br>";
$sender_jenjang			= $_POST["jenjang"];  		//echo "sender_jenjang: ".$sender_jenjang."<br>";
$sender_tingkat			= $_POST["tingkat"];		//echo "sender_tingkat: ".$sender_tingkat."<br>";
$sender_periode			= $_POST["periode"];		//echo "sender_periode: ".$sender_periode."<br>";
$sender_page_num		= $_POST["page_num"]; 		//echo "sender_page_num: ".$sender_page_num."<br>";

$src_get_kelas = "select kelas from siswa_finance where no_sisda = '$sender_no_sisda' and periode = '$sender_periode'";
$query_get_kelas	= mysqli_query($mysql_connect, $src_get_kelas) or die(mysql_error());
$row_get_kelas		= mysql_fetch_array($query_get_kelas);
$get_kelas			= $row_get_kelas["kelas"];

//////////
$sum_nominal_all 			= "";
$sum_nominal_bima 			= "";
$sum_nominal_daful 			= "";
$sum_nominal_spp 			= "";
$sum_nominal_cat 			= "";
$sum_nominal_aj 			= "";
//////////
$nominal_tunggakan_bima		= "";
$nominal_tunggakan_daful	= "";

$nominal_tunggakan_jan_spp	= "";
$nominal_tunggakan_feb_spp	= "";
$nominal_tunggakan_mar_spp 	= "";
$nominal_tunggakan_apr_spp 	= "";
$nominal_tunggakan_may_spp	= "";
$nominal_tunggakan_jun_spp	= "";
$nominal_tunggakan_jul_spp	= "";
$nominal_tunggakan_aug_spp	= "";
$nominal_tunggakan_sep_spp	= "";
$nominal_tunggakan_oct_spp	= "";
$nominal_tunggakan_nov_spp	= "";
$nominal_tunggakan_dec_spp	= "";

$nominal_tunggakan_jan_cat	= "";
$nominal_tunggakan_feb_cat	= "";
$nominal_tunggakan_mar_cat 	= "";
$nominal_tunggakan_apr_cat 	= "";
$nominal_tunggakan_may_cat	= "";
$nominal_tunggakan_jun_cat	= "";
$nominal_tunggakan_jul_cat	= "";
$nominal_tunggakan_aug_cat	= "";
$nominal_tunggakan_sep_cat	= "";
$nominal_tunggakan_oct_cat	= "";
$nominal_tunggakan_nov_cat	= "";
$nominal_tunggakan_dec_cat	= "";

$nominal_tunggakan_jan_aj	= "";
$nominal_tunggakan_feb_aj	= "";
$nominal_tunggakan_mar_aj 	= "";
$nominal_tunggakan_apr_aj 	= "";
$nominal_tunggakan_may_aj	= "";
$nominal_tunggakan_jun_aj	= "";
$nominal_tunggakan_jul_aj	= "";
$nominal_tunggakan_aug_aj	= "";
$nominal_tunggakan_sep_aj	= "";
$nominal_tunggakan_oct_aj	= "";
$nominal_tunggakan_nov_aj	= "";
$nominal_tunggakan_dec_aj	= "";

//////////
$src_bulan_spp				= "";
$src_bulan_cat				= "";
$src_bulan_aj				= "";
$src_tahun_spp				= "";
$src_tahun_cat				= "";
$src_tahun_aj				= "";

///////////
$all_cur_ks					= "";

//$src_get_tunggakan 		= "select * from tunggakan no_sisda = '$sender_no_sisda' where status = '1'";
$src_get_tunggakan 		= "select * from tunggakan where no_sisda = '$sender_no_sisda' and status = '1' order by periode";
//echo $src_get_tunggakan ;
$query_get_tunggakan	= mysqli_query($mysql_connect, $src_get_tunggakan) or die(mysqli_query($mysql_connect, ));

//echo "num:". mysql_num_rows($query_get_tunggakan)."<br>";

while($row_get_tunggakan = mysql_fetch_array($query_get_tunggakan)) {

	$jenis_tunggakan = $row_get_tunggakan["jenis_tunggakan"];
	
	////// Daftar ulang
	if($jenis_tunggakan == "biaya_masuk") {
	
		$nominal_tunggakan_bima = $row_get_tunggakan["nominal_tunggakan"]; //echo "nominal_tunggakan_bima :".$nominal_tunggakan_bima."<br>";
		
		$sum_nominal_bima		= $sum_nominal_bima + $nominal_tunggakan_bima;
		
		if($nominal_tunggakan_bima != 0 ) {$sum_nominal_all = $sum_nominal_all + $nominal_tunggakan_bima; }
		
	}
	
	////// Biaya masuk	
	if($jenis_tunggakan == "daftar_ulang") {
	
		$nominal_tunggakan_daful = $row_get_tunggakan["nominal_tunggakan"];;
		
		$sum_nominal_daful = $sum_nominal_daful + $nominal_tunggakan_daful;
		
		if($nominal_tunggakan_daful != 0 ) { $sum_nominal_all = $sum_nominal_all + $nominal_tunggakan_daful; }
	
	}
	
	////// SPP	
	if($jenis_tunggakan == "spp") { 
	
		//echo "row_get_tunggakan[july]: ".substr($row_get_tunggakan["july"],0,1)."<br>";
		$cur_tahun_spp 		= substr($row_get_tunggakan["periode"],2,2)."-".substr($row_get_tunggakan["periode"],9,2); //echo "cur_tahun_spp: ".$cur_tahun_spp."<br>";
		$check_tahun_spp	= substr($src_tahun_spp,-6,5); //echo "check_tahun_spp: ".$check_tahun_spp."<br>";
		
		//ini ternyatakan nominal ks tersendiri misah sama komponen SPP
		//jadi nantinya di kurangin SPPnya sejumlah total KS
		$periode_ks		= $row_get_tunggakan["periode"];
		$src_get_cur_ks	= "select ks from siswa_finance where no_sisda = '$sender_no_sisda' and periode = '$periode_ks'";
		$query_get_cur_ks	= mysqli_query($mysql_connect, $src_get_cur_ks) or die(mysql_error());
		$row_get_cur_ks		= mysql_fetch_array($query_get_cur_ks);
		$nom_cur_ks			= $row_get_cur_ks["ks"]; //echo "nom_cur_ks: ".$nom_cur_ks."<br>";
		
	
		$nominal_tunggakan_jan_spp = substr($row_get_tunggakan["january"],2); //echo "nominal_tunggakan_jan_spp:".$nominal_tunggakan_jan_spp."<br>";
		$nominal_tunggakan_feb_spp = substr($row_get_tunggakan["february"],2);
		$nominal_tunggakan_mar_spp = substr($row_get_tunggakan["march"],2);
		$nominal_tunggakan_apr_spp = substr($row_get_tunggakan["april"],2);
		$nominal_tunggakan_may_spp = substr($row_get_tunggakan["may"],2);
		$nominal_tunggakan_jun_spp = substr($row_get_tunggakan["june"],2);
		$nominal_tunggakan_jul_spp = substr($row_get_tunggakan["july"],2);
		$nominal_tunggakan_aug_spp = substr($row_get_tunggakan["august"],2);
		$nominal_tunggakan_sep_spp = substr($row_get_tunggakan["september"],2);
		$nominal_tunggakan_oct_spp = substr($row_get_tunggakan["october"],2);
		$nominal_tunggakan_nov_spp = substr($row_get_tunggakan["november"],2);
		$nominal_tunggakan_dec_spp = substr($row_get_tunggakan["december"],2);
		
		
		
		if(substr($row_get_tunggakan["january"],0,1) == 2 || substr($row_get_tunggakan["january"],0,1) == 1) { 
			$sum_nominal_all 	= ($sum_nominal_all + $nominal_tunggakan_jan_spp);
			$sum_nominal_spp	= ($sum_nominal_spp + $nominal_tunggakan_jan_spp) - $nom_cur_ks; 
			$src_bulan_spp 		= $src_bulan_spp."jan, "; 
			$all_cur_ks			= $all_cur_ks + $nom_cur_ks; //echo "ks jan ";
		}
		if(substr($row_get_tunggakan["february"],0,1) == 2 || substr($row_get_tunggakan["february"],0,1) == 1) { 
			$sum_nominal_all 	= ($sum_nominal_all + $nominal_tunggakan_feb_spp);
			$sum_nominal_spp	= ($sum_nominal_spp + $nominal_tunggakan_feb_spp) - $nom_cur_ks; 
			$src_bulan_spp 		= $src_bulan_spp."feb, "; 
			$all_cur_ks			= $all_cur_ks + $nom_cur_ks; //echo "ks feb ";
		}
		if(substr($row_get_tunggakan["march"],0,1) == 2 || substr($row_get_tunggakan["march"],0,1) == 1) { 
			$sum_nominal_all 	= ($sum_nominal_all + $nominal_tunggakan_mar_spp); 
			$sum_nominal_spp	= ($sum_nominal_spp + $nominal_tunggakan_mar_spp) - $nom_cur_ks;
			$src_bulan_spp 		= $src_bulan_spp."mar, ";
			$all_cur_ks			= $all_cur_ks + $nom_cur_ks; //echo "ks mar ";
		}
		if(substr($row_get_tunggakan["april"],0,1) == 2 || substr($row_get_tunggakan["april"],0,1) == 1) { 
			$sum_nominal_all 	= ($sum_nominal_all + $nominal_tunggakan_apr_spp);
			$sum_nominal_spp	= ($sum_nominal_spp + $nominal_tunggakan_apr_spp) - $nom_cur_ks;  
			$src_bulan_spp 		= $src_bulan_spp."apr, ";
			$all_cur_ks			= $all_cur_ks + $nom_cur_ks; //echo "ks apr ";
		}
		if(substr($row_get_tunggakan["may"],0,1) == 2 || substr($row_get_tunggakan["may"],0,1) == 1) { 
			$sum_nominal_all 	= ($sum_nominal_all + $nominal_tunggakan_may_spp); 
			$sum_nominal_spp	= ($sum_nominal_spp + $nominal_tunggakan_may_spp) - $nom_cur_ks;
			$src_bulan_spp 		= $src_bulan_spp."mei, ";
			$all_cur_ks			= $all_cur_ks + $nom_cur_ks; //echo "ks may ";
		}
		if(substr($row_get_tunggakan["june"],0,1) == 2 || substr($row_get_tunggakan["june"],0,1) == 1) { 
			$sum_nominal_all 	= ($sum_nominal_all + $nominal_tunggakan_jun_spp); 
			$sum_nominal_spp	= ($sum_nominal_spp + $nominal_tunggakan_jun_spp) - $nom_cur_ks;
			$src_bulan_spp 		= $src_bulan_spp."jun, "; 
			$all_cur_ks			= $all_cur_ks + $nom_cur_ks; //echo "ks jun ";
		}
		if(substr($row_get_tunggakan["july"],0,1) == 2 || substr($row_get_tunggakan["july"],0,1) == 1 ) { 
			$sum_nominal_all 	= ($sum_nominal_all + $nominal_tunggakan_jul_spp); 
			$sum_nominal_spp	= ($sum_nominal_spp + $nominal_tunggakan_jul_spp) - $nom_cur_ks;
			$src_bulan_spp 		= $src_bulan_spp."jul, "; 
			$all_cur_ks			= $all_cur_ks + $nom_cur_ks; //echo "ks jul ";
		}
		if(substr($row_get_tunggakan["august"],0,1) == 2 || substr($row_get_tunggakan["august"],0,1) == 1) { 
			$sum_nominal_all 	= ($sum_nominal_all + $nominal_tunggakan_aug_spp); 
			$sum_nominal_spp	= ($sum_nominal_spp + $nominal_tunggakan_aug_spp) - $nom_cur_ks;
			$src_bulan_spp 		= $src_bulan_spp."agu, "; 
			$all_cur_ks			= $all_cur_ks + $nom_cur_ks; //echo "ks aug ";
		}
		if(substr($row_get_tunggakan["september"],0,1) == 2 || substr($row_get_tunggakan["september"],0,1) == 1) { 
			$sum_nominal_all 	= ($sum_nominal_all + $nominal_tunggakan_sep_spp); 
			$sum_nominal_spp	= ($sum_nominal_spp + $nominal_tunggakan_sep_spp) - $nom_cur_ks;
			$src_bulan_spp 		= $src_bulan_spp."sep, "; 
			$all_cur_ks			= $all_cur_ks + $nom_cur_ks; //echo "ks sep ";
		}
		if(substr($row_get_tunggakan["october"],0,1) == 2 || substr($row_get_tunggakan["october"],0,1) == 1) { 
			$sum_nominal_all 	= ($sum_nominal_all + $nominal_tunggakan_oct_spp); 
			$sum_nominal_spp	= ($sum_nominal_spp + $nominal_tunggakan_oct_spp) - $nom_cur_ks;
			$src_bulan_spp 		= $src_bulan_spp."okt, "; 
			$all_cur_ks			= $all_cur_ks + $nom_cur_ks; //echo "ks oct ";
		}
		if(substr($row_get_tunggakan["november"],0,1) == 2 || substr($row_get_tunggakan["november"],0,1) == 1) { 
			$sum_nominal_all 	= ($sum_nominal_all + $nominal_tunggakan_nov_spp); 
			$sum_nominal_spp	= ($sum_nominal_spp + $nominal_tunggakan_nov_spp) - $nom_cur_ks;
			$src_bulan_spp 		= $src_bulan_spp."nov, ";
			$all_cur_ks			= $all_cur_ks + $nom_cur_ks;  //echo "ks nov ";
		}
		if(substr($row_get_tunggakan["december"],0,1) == 2 || substr($row_get_tunggakan["december"],0,1) == 1) { 
			$sum_nominal_all 	= ($sum_nominal_all + $nominal_tunggakan_dec_spp); 
			$sum_nominal_spp	= ($sum_nominal_spp + $nominal_tunggakan_dec_spp) - $nom_cur_ks;
			$src_bulan_spp 		= $src_bulan_spp."des, "; 
			$all_cur_ks			= $all_cur_ks + $nom_cur_ks; //echo "ks dec ";
		}
		
		if(
		
			substr($row_get_tunggakan["january"],0,1) 	== 2 || substr($row_get_tunggakan["january"],0,1) == 1 ||
			substr($row_get_tunggakan["february"],0,1) 	== 2 || substr($row_get_tunggakan["february"],0,1) == 1 ||
			substr($row_get_tunggakan["march"],0,1) 	== 2 || substr($row_get_tunggakan["march"],0,1) == 1 ||
			substr($row_get_tunggakan["april"],0,1) 	== 2 || substr($row_get_tunggakan["april"],0,1) == 1 ||
			substr($row_get_tunggakan["may"],0,1) 		== 2 || substr($row_get_tunggakan["may"],0,1) == 1 ||
			substr($row_get_tunggakan["june"],0,1) 		== 2 || substr($row_get_tunggakan["june"],0,1) == 1 ||
			substr($row_get_tunggakan["july"],0,1) 		== 2 || substr($row_get_tunggakan["july"],0,1) == 1 ||
			substr($row_get_tunggakan["august"],0,1) 	== 2 || substr($row_get_tunggakan["august"],0,1) == 1 ||
			substr($row_get_tunggakan["september"],0,1) == 2 || substr($row_get_tunggakan["september"],0,1) == 2 ||
			substr($row_get_tunggakan["october"],0,1) 	== 2 || substr($row_get_tunggakan["october"],0,1) == 1 ||
			substr($row_get_tunggakan["november"],0,1) 	== 2 || substr($row_get_tunggakan["november"],0,1) == 1 ||
			substr($row_get_tunggakan["december"],0,1) 	== 2 || substr($row_get_tunggakan["december"],0,1) == 1
			
		) {
		
			//echo "hahahah";
			 if($check_tahun_spp != $cur_tahun_spp) { $src_tahun_spp = $src_tahun_spp.$cur_tahun_spp.","; }
		
		}
	
	}
	
	////// Catering	
	if($jenis_tunggakan == "catering") {
	
		$cur_tahun_cat 		= substr($row_get_tunggakan["periode"],2,2)."-".substr($row_get_tunggakan["periode"],9,2);
		$check_tahun_cat	= substr($src_tahun_cat,-6,5);
	
		$nominal_tunggakan_jan_cat = substr($row_get_tunggakan["jan_cataj"],2);
		$nominal_tunggakan_feb_cat = substr($row_get_tunggakan["feb_cataj"],2);
		$nominal_tunggakan_mar_cat = substr($row_get_tunggakan["mar_cataj"],2);
		$nominal_tunggakan_apr_cat = substr($row_get_tunggakan["apr_cataj"],2);
		$nominal_tunggakan_may_cat = substr($row_get_tunggakan["may_cataj"],2);
		$nominal_tunggakan_jun_cat = substr($row_get_tunggakan["jun_cataj"],2);
		$nominal_tunggakan_jul_cat = substr($row_get_tunggakan["jul_cataj"],2);
		$nominal_tunggakan_aug_cat = substr($row_get_tunggakan["aug_cataj"],2);
		$nominal_tunggakan_sep_cat = substr($row_get_tunggakan["sep_cataj"],2);
		$nominal_tunggakan_oct_cat = substr($row_get_tunggakan["oct_cataj"],2);
		$nominal_tunggakan_nov_cat = substr($row_get_tunggakan["nov_cataj"],2);
		$nominal_tunggakan_dec_cat = substr($row_get_tunggakan["dec_cataj"],2);
		
		if(substr($row_get_tunggakan["jan_cataj"],0,1) == 2 || substr($row_get_tunggakan["jan_cataj"],0,1) == 1) { 
			$sum_nominal_all 	= $sum_nominal_all + $nominal_tunggakan_jan_cat; 
			$sum_nominal_cat	= $sum_nominal_cat + $nominal_tunggakan_jan_cat;
			$src_bulan_cat 		= $src_bulan_cat."jan, "; 
		}
		if(substr($row_get_tunggakan["feb_cataj"],0,1) == 2 || substr($row_get_tunggakan["feb_cataj"],0,1) == 1) { 
			$sum_nominal_all 	= $sum_nominal_all + $nominal_tunggakan_feb_cat; 
			$sum_nominal_cat	= $sum_nominal_cat + $nominal_tunggakan_feb_cat;
			$src_bulan_cat 	= $src_bulan_cat."feb, "; 
		}
		if(substr($row_get_tunggakan["mar_cataj"],0,1) == 2 || substr($row_get_tunggakan["mar_cataj"],0,1) == 1) { 
			$sum_nominal_all 	= $sum_nominal_all + $nominal_tunggakan_mar_cat;
			$sum_nominal_cat	= $sum_nominal_cat + $nominal_tunggakan_mar_cat; 
			$src_bulan_cat 		= $src_bulan_cat."mar, "; 
		}
		if(substr($row_get_tunggakan["apr_cataj"],0,1) == 2 || substr($row_get_tunggakan["apr_cataj"],0,1) == 1) { 
			$sum_nominal_all 	= $sum_nominal_all + $nominal_tunggakan_apr_cat; 
			$sum_nominal_cat	= $sum_nominal_cat + $nominal_tunggakan_apr_cat;
			$src_bulan_cat 		= $src_bulan_cat."apr, "; 
		}
		if(substr($row_get_tunggakan["may_cataj"],0,1) == 2 || substr($row_get_tunggakan["may_cataj"],0,1) == 1) { 
			$sum_nominal_all 	= $sum_nominal_all + $nominal_tunggakan_may_cat; 
			$sum_nominal_cat	= $sum_nominal_cat + $nominal_tunggakan_may_cat;
			$src_bulan_cat = $src_bulan_cat."mei, "; 
		}
		if(substr($row_get_tunggakan["jun_cataj"],0,1) == 2 || substr($row_get_tunggakan["jun_cataj"],0,1) == 1) { 
			$sum_nominal_all 	= $sum_nominal_all + $nominal_tunggakan_jun_cat; 
			$sum_nominal_cat	= $sum_nominal_cat + $nominal_tunggakan_jun_cat;
			$src_bulan_cat 		= $src_bulan_cat."jun, "; 
		}
		if(substr($row_get_tunggakan["jul_cataj"],0,1) == 2 || substr($row_get_tunggakan["jul_cataj"],0,1) == 1) { 
			$sum_nominal_all 	= $sum_nominal_all + $nominal_tunggakan_jul_cat; 
			$sum_nominal_cat	= $sum_nominal_cat + $nominal_tunggakan_jul_cat;
			$src_bulan_cat 		= $src_bulan_cat."jul, "; 
		}
		if(substr($row_get_tunggakan["aug_cataj"],0,1) == 2 || substr($row_get_tunggakan["aug_cataj"],0,1) == 1) { 
			$sum_nominal_all 	= $sum_nominal_all + $nominal_tunggakan_aug_cat;
			$sum_nominal_cat	= $sum_nominal_cat + $nominal_tunggakan_aug_cat; 
			$src_bulan_cat 		= $src_bulan_cat."agu, "; 
		}
		if(substr($row_get_tunggakan["sep_cataj"],0,1) == 2 || substr($row_get_tunggakan["sep_cataj"],0,1) == 1) { 
			$sum_nominal_all 	= $sum_nominal_all + $nominal_tunggakan_sep_cat; 
			$sum_nominal_cat	= $sum_nominal_cat + $nominal_tunggakan_sep_cat;
			$src_bulan_cat 		= $src_bulan_cat."sep, "; 
		}
		if(substr($row_get_tunggakan["oct_cataj"],0,1) == 2 || substr($row_get_tunggakan["oct_cataj"],0,1) == 1) { 
			$sum_nominal_all 	= $sum_nominal_all + $nominal_tunggakan_oct_cat; 
			$sum_nominal_cat	= $sum_nominal_cat + $nominal_tunggakan_oct_cat;
			$src_bulan_cat 		= $src_bulan_cat."okt, "; 
		}
		if(substr($row_get_tunggakan["nov_cataj"],0,1) == 2 || substr($row_get_tunggakan["nov_cataj"],0,1) == 1) { 
			$sum_nominal_all 	= $sum_nominal_all + $nominal_tunggakan_nov_cat; 
			$sum_nominal_cat	= $sum_nominal_cat + $nominal_tunggakan_nov_cat;
			$src_bulan_cat 		= $src_bulan_cat."nov, "; 
		}
		if(substr($row_get_tunggakan["dec_cataj"],0,1) == 2 || substr($row_get_tunggakan["dec_cataj"],0,1) == 1) { 
			$sum_nominal_all 	= $sum_nominal_all + $nominal_tunggakan_dec_cat; 
			$sum_nominal_cat	= $sum_nominal_cat + $nominal_tunggakan_dec_cat;
			$src_bulan_cat 		= $src_bulan_cat."des, "; 
		}
		
		if(
		
			substr($row_get_tunggakan["jan_cataj"],0,1) == 2 || substr($row_get_tunggakan["jan_cataj"],0,1) == 1 ||
			substr($row_get_tunggakan["feb_cataj"],0,1) == 2 || substr($row_get_tunggakan["feb_cataj"],0,1) == 1 ||
			substr($row_get_tunggakan["mar_cataj"],0,1) == 2 || substr($row_get_tunggakan["mar_cataj"],0,1) == 1 ||
			substr($row_get_tunggakan["apr_cataj"],0,1) == 2 || substr($row_get_tunggakan["apr_cataj"],0,1) == 1 ||
			substr($row_get_tunggakan["may_cataj"],0,1) == 2 || substr($row_get_tunggakan["may_cataj"],0,1) == 1 ||
			substr($row_get_tunggakan["jun_cataj"],0,1) == 2 || substr($row_get_tunggakan["jun_cataj"],0,1) == 1 ||
			substr($row_get_tunggakan["jul_cataj"],0,1) == 2 || substr($row_get_tunggakan["jul_cataj"],0,1) == 1 ||
			substr($row_get_tunggakan["aug_cataj"],0,1) == 2 || substr($row_get_tunggakan["aug_cataj"],0,1) == 1 ||
			substr($row_get_tunggakan["sep_cataj"],0,1) == 2 || substr($row_get_tunggakan["sep_cataj"],0,1) == 1 ||
			substr($row_get_tunggakan["oct_cataj"],0,1) == 2 || substr($row_get_tunggakan["oct_cataj"],0,1) == 1 ||
			substr($row_get_tunggakan["nov_cataj"],0,1) == 2 || substr($row_get_tunggakan["nov_cataj"],0,1) == 1 ||
			substr($row_get_tunggakan["dec_cataj"],0,1) == 2 || substr($row_get_tunggakan["dec_cataj"],0,1) == 1
			
		) {
		
			 if($check_tahun_cat != $cur_tahun_cat) { $src_tahun_cat = $src_tahun_cat.$cur_tahun_cat.","; }
		
		}
	
	}
	
	////// antar jemput	
	if($jenis_tunggakan == "antar_jemput") {
	
		$cur_tahun_aj 	= substr($row_get_tunggakan["periode"],2,2)."-".substr($row_get_tunggakan["periode"],9,2);
		$check_tahun_aj	= substr($src_tahun_aj,-6,5);
	
		$nominal_tunggakan_jan_aj = substr($row_get_tunggakan["jan_cataj"],2);
		$nominal_tunggakan_feb_aj = substr($row_get_tunggakan["feb_cataj"],2);
		$nominal_tunggakan_mar_aj = substr($row_get_tunggakan["mar_cataj"],2);
		$nominal_tunggakan_apr_aj = substr($row_get_tunggakan["apr_cataj"],2);
		$nominal_tunggakan_may_aj = substr($row_get_tunggakan["may_cataj"],2);
		$nominal_tunggakan_jun_aj = substr($row_get_tunggakan["jun_cataj"],2);
		$nominal_tunggakan_jul_aj = substr($row_get_tunggakan["jul_cataj"],2);
		$nominal_tunggakan_aug_aj = substr($row_get_tunggakan["aug_cataj"],2);
		$nominal_tunggakan_sep_aj = substr($row_get_tunggakan["sep_cataj"],2);
		$nominal_tunggakan_oct_aj = substr($row_get_tunggakan["oct_cataj"],2);
		$nominal_tunggakan_nov_aj = substr($row_get_tunggakan["nov_cataj"],2);
		$nominal_tunggakan_dec_aj = substr($row_get_tunggakan["dec_cataj"],2);
		
		if(substr($row_get_tunggakan["jan_cataj"],0,1) == 2 || substr($row_get_tunggakan["jan_cataj"],0,1) == 1) { 
			$sum_nominal_all 	= $sum_nominal_all + $nominal_tunggakan_jan_aj; 
			$sum_nominal_aj 	= $sum_nominal_aj + $nominal_tunggakan_jan_aj;
			$src_bulan_aj 		= $src_bulan_aj."jan, "; 
		}
		if(substr($row_get_tunggakan["feb_cataj"],0,1) == 2 || substr($row_get_tunggakan["feb_cataj"],0,1) == 1) { 
			$sum_nominal_all 	= $sum_nominal_all + $nominal_tunggakan_feb_aj; 
			$sum_nominal_aj 	= $sum_nominal_aj + $nominal_tunggakan_feb_aj;
			$src_bulan_aj 		= $src_bulan_aj."feb, "; 
		}
		if(substr($row_get_tunggakan["mar_cataj"],0,1) == 2 || substr($row_get_tunggakan["mar_cataj"],0,1) == 1) { 
			$sum_nominal_all 	= $sum_nominal_all + $nominal_tunggakan_mar_aj; 
			$sum_nominal_aj 	= $sum_nominal_aj + $nominal_tunggakan_mar_aj;
			$src_bulan_aj 		= $src_bulan_aj."mar, "; 
		}
		if(substr($row_get_tunggakan["apr_cataj"],0,1) == 2 || substr($row_get_tunggakan["apr_cataj"],0,1) == 1) { 
			$sum_nominal_all 	= $sum_nominal_all + $nominal_tunggakan_apr_aj; 
			$sum_nominal_aj 	= $sum_nominal_aj + $nominal_tunggakan_apr_aj;
			$src_bulan_aj 		= $src_bulan_aj."apr, "; 
		}
		if(substr($row_get_tunggakan["may_cataj"],0,1) == 2 || substr($row_get_tunggakan["may_cataj"],0,1) == 1) { 
			$sum_nominal_all 	= $sum_nominal_all + $nominal_tunggakan_may_aj; 
			$sum_nominal_aj 	= $sum_nominal_aj + $nominal_tunggakan_may_aj;
			$src_bulan_aj 		= $src_bulan_aj."mei, "; 
		}
		if(substr($row_get_tunggakan["jun_cataj"],0,1) == 2 || substr($row_get_tunggakan["jun_cataj"],0,1) == 1) { 
			$sum_nominal_all 	= $sum_nominal_all + $nominal_tunggakan_jun_aj;
			$sum_nominal_aj 	= $sum_nominal_aj + $nominal_tunggakan_jun_aj; 
			$src_bulan_aj 		= $src_bulan_aj."jun, "; 
		}
		if(substr($row_get_tunggakan["jul_cataj"],0,1) == 2 || substr($row_get_tunggakan["jul_cataj"],0,1) == 1) { 
			$sum_nominal_all 	= $sum_nominal_all + $nominal_tunggakan_jul_aj; 
			$sum_nominal_aj 	= $sum_nominal_aj + $nominal_tunggakan_jul_aj;
			$src_bulan_aj 		= $src_bulan_aj."jul, "; 
		}
		if(substr($row_get_tunggakan["aug_cataj"],0,1) == 2 || substr($row_get_tunggakan["aug_cataj"],0,1) == 1) { 
			$sum_nominal_all 	= $sum_nominal_all + $nominal_tunggakan_aug_aj; 
			$sum_nominal_aj 	= $sum_nominal_aj + $nominal_tunggakan_aug_aj;
			$src_bulan_aj 		= $src_bulan_aj."agu, "; 
		}
		if(substr($row_get_tunggakan["sep_cataj"],0,1) == 2 || substr($row_get_tunggakan["sep_cataj"],0,1) == 1) { 
			$sum_nominal_all 	= $sum_nominal_all + $nominal_tunggakan_sep_aj; 
			$sum_nominal_aj 	= $sum_nominal_aj + $nominal_tunggakan_sep_aj;
			$src_bulan_aj = $src_bulan_aj."sep, "; 
		}
		if(substr($row_get_tunggakan["oct_cataj"],0,1) == 2 || substr($row_get_tunggakan["oct_cataj"],0,1) == 1) { 
			$sum_nominal_all 	= $sum_nominal_all + $nominal_tunggakan_oct_aj;
			$sum_nominal_aj 	= $sum_nominal_aj + $nominal_tunggakan_oct_aj; 
			$src_bulan_aj 		= $src_bulan_aj."okt, "; 
		}
		if(substr($row_get_tunggakan["nov_cataj"],0,1) == 2 || substr($row_get_tunggakan["nov_cataj"],0,1) == 1) { 
			$sum_nominal_all 	= $sum_nominal_all + $nominal_tunggakan_nov_aj; 
			$sum_nominal_aj 	= $sum_nominal_aj + $nominal_tunggakan_nov_aj;
			$src_bulan_aj 		= $src_bulan_aj."nov, "; 
		}
		if(substr($row_get_tunggakan["dec_cataj"],0,1) == 2 || substr($row_get_tunggakan["dec_cataj"],0,1) == 1) { 
			$sum_nominal_all 	= $sum_nominal_all + $nominal_tunggakan_dec_aj; 
			$sum_nominal_aj 	= $sum_nominal_aj + $nominal_tunggakan_dec_aj;
			$src_bulan_aj 		= $src_bulan_aj."des, "; 
		}
		
		if(
		
			substr($row_get_tunggakan["jan_cataj"],0,1) == 2 || substr($row_get_tunggakan["jan_cataj"],0,1) == 1 ||
			substr($row_get_tunggakan["feb_cataj"],0,1) == 2 || substr($row_get_tunggakan["feb_cataj"],0,1) == 1 ||
			substr($row_get_tunggakan["mar_cataj"],0,1) == 2 || substr($row_get_tunggakan["mar_cataj"],0,1) == 1 ||
			substr($row_get_tunggakan["apr_cataj"],0,1) == 2 || substr($row_get_tunggakan["apr_cataj"],0,1) == 1 ||
			substr($row_get_tunggakan["may_cataj"],0,1) == 2 || substr($row_get_tunggakan["may_cataj"],0,1) == 1 ||
			substr($row_get_tunggakan["jun_cataj"],0,1) == 2 || substr($row_get_tunggakan["jun_cataj"],0,1) == 1 ||
			substr($row_get_tunggakan["jul_cataj"],0,1) == 2 || substr($row_get_tunggakan["jul_cataj"],0,1) == 1 ||
			substr($row_get_tunggakan["aug_cataj"],0,1) == 2 || substr($row_get_tunggakan["aug_cataj"],0,1) == 1 ||
			substr($row_get_tunggakan["sep_cataj"],0,1) == 2 || substr($row_get_tunggakan["sep_cataj"],0,1) == 1 ||
			substr($row_get_tunggakan["oct_cataj"],0,1) == 2 || substr($row_get_tunggakan["oct_cataj"],0,1) == 1 ||
			substr($row_get_tunggakan["nov_cataj"],0,1) == 2 || substr($row_get_tunggakan["nov_cataj"],0,1) == 1 ||
			substr($row_get_tunggakan["dec_cataj"],0,1) == 2 || substr($row_get_tunggakan["dec_cataj"],0,1) == 1
			
		) {
		
			 if($check_tahun_aj != $cur_tahun_aj) { $src_tahun_aj = $src_tahun_aj.$cur_tahun_aj.","; }
		
		}
	
	}

}

/*
echo "sum_nominal_all: ".$sum_nominal_all."<br>";
echo "sum_nominal_bima: ".$sum_nominal_bima."<br>";
echo "sum_nominal_daful: ".$sum_nominal_daful."<br>";
echo "sum_nominal_spp: ".$sum_nominal_spp."<br>";
echo "sum_nominal_cat: ".$sum_nominal_cat."<br>";
echo "sum_nominal_aj: ".$sum_nominal_aj."<br>";
echo "src_bulan_spp: ".$src_bulan_spp."<br>";
echo "src_bulan_cat; ".$src_bulan_cat."<br>";
echo "src_bulan_aj: ".$src_bulan_aj."<br>";
echo "src_tahun_spp: ".$src_tahun_spp."<br>";
echo "src_tahun_cat: ".$src_tahun_cat."<br>";
echo "src_tahun_aj: ".$src_tahun_aj."<br>";
echo "all_cur_ks: ".$all_cur_ks."<br>";
*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon">
<title>Sistem Informasi Sekolah Islam Terpadu Darul Abidin - v3</title>
<link media="screen" type="text/css" rel="stylesheet" href="../style.css">
</head>
<body>
<table width="1045" border="0" cellpadding="0" cellspacing="0">
	<tr>
    	<td>
        	<table width="512" border="0" cellpadding="0" cellspacing="0">
            	<tr>
                	<td width="40" id="text_normal_black"><img src="../images/icon_logo_black_small.png" /></td>
                    <td id="text_normal_black">Sekolah Islam Terpadu Darul Abidin</td>
                </tr>
                <tr>
                	<td colspan="2"><hr noshade="noshade" size="1" /></td>
                </tr>
                <tr>
                	<td colspan="2" id="text_normal_black" align="center" height="35"><span style="font-size:16px;">SLIP TAGIHAN SIT DARUL ABIDIN</span></td>
                </tr>
            </table>
            <table width="512" border="0" cellpadding="0" cellspacing="0">
            	<tr height="30">
                	<td width="100" id="text_normal_black">Nama siswa</td>
                    <td width="10" id="text_normal_black">:</td>
                    <td id="text_normal_black"><?= $sender_nama_siswa; ?> | <?= $sender_no_sisda; ?></td>
                </tr>
                <tr height="20">
                	<td id="text_normal_black">Kelas</td>
                    <td id="text_normal_black">:</td>
                    <td id="text_normal_black"><b><?= $get_kelas; ?></b></td>
                </tr>
                <tr height="20">
                	<td colspan="3">&nbsp;</td>
                </tr>
             </table>
             <table width="512" border="0" cellpadding="0" cellspacing="0">
            	<tr height="30">
                	<td width="40" id="text_normal_black">No</td>
                    <td width="250" id="text_normal_black">Uraian</td>
                    <td id="text_normal_black">Jumlah</td>
                </tr>
                <?PHP
				////////////////////////////////////////////////////////
				///////////////////////// SPP //////////////////////////
				////////////////////////////////////////////////////////
				if($sum_nominal_spp == 0 || $sum_nominal_spp == "") {
				?>
                <tr height="20">
                	<td id="text_normal_black">1</td>
                    <td id="text_normal_black">SPP</td>
                    <td id="text_normal_black">0</td>
                </tr>
                <?PHP
				} else {
				?>
                <tr height="20">
                	<td id="text_normal_black">1</td>
                    <td id="text_normal_black">SPP [<?= $src_bulan_spp."/".$src_tahun_spp; ?>] </td>
                    <td id="text_normal_black">Rp <?= number_format($sum_nominal_spp,0,",",".").",-"; ?></td>
                </tr>
                <?PHP
				}
				
				////////////////////////////////////////////////////////
				///////////////////////// KS ///////////////////////////
				////////////////////////////////////////////////////////
				if($all_cur_ks == 0 || $all_cur_ks == "") {
				?>
                <tr height="20">
                	<td id="text_normal_black">2</td>
                    <td id="text_normal_black">Komite Sekolah</td>
                    <td id="text_normal_black">0</td>
                </tr>
                <?PHP
				} else {
				?>
                <tr height="20">
                	<td id="text_normal_black">2</td>
                    <td id="text_normal_black">Komite Sekolah</td>
                    <td id="text_normal_black">Rp <?= number_format($all_cur_ks,0,",",".").",-"; ?></td>
                </tr>
                <?PHP
				}
				
				////////////////////////////////////////////////////////
				////////////////////// catering ////////////////////////
				////////////////////////////////////////////////////////
				if($sum_nominal_cat == 0 || $sum_nominal_cat == "") {
				?>
                <tr height="20">
                	<td id="text_normal_black">3</td>
                    <td id="text_normal_black">Catering</td>
                    <td id="text_normal_black">0</td>
                </tr>
                <?PHP
				} else {
				?>
                <tr height="20">
                	<td id="text_normal_black">3</td>
                    <td id="text_normal_black">Catering [<?= $src_bulan_cat."/".$src_tahun_cat; ?>]</td>
                    <td id="text_normal_black">Rp <?= number_format($sum_nominal_cat,0,",",".").",-"; ?></td>
                </tr>
                <?PHP
				}
				
				////////////////////////////////////////////////////////
				//////////////////// Antar Jemput //////////////////////
				////////////////////////////////////////////////////////
				if($sum_nominal_aj == 0 || $sum_nominal_aj == "") {
				?>
                <tr height="20">
                	<td id="text_normal_black">4</td>
                    <td id="text_normal_black">Jemputan</td>
                    <td id="text_normal_black">0</td>
                </tr>
                <?PHP
				} else {
				?>
                <tr height="20">
                	<td id="text_normal_black">4</td>
                    <td id="text_normal_black">Jemputan [<?= $src_bulan_aj."/".$src_tahun_aj; ?>]</td>
                    <td id="text_normal_black">Rp <?= number_format($sum_nominal_aj,0,",",".").",-"; ?></td>
                </tr>
                <?PHP
				}
								
				////////////////////////////////////////////////////////
				//////////////////// Antar Jemput //////////////////////
				////////////////////////////////////////////////////////
				if($sum_nominal_bima == 0 || $sum_nominal_bima == "") {
				?>
                <tr height="20">
                	<td id="text_normal_black">5</td>
                    <td id="text_normal_black">PMB</td>
                    <td id="text_normal_black">0</td>
                </tr>
                <?PHP
				} else {
				?>
                <tr height="20">
                	<td id="text_normal_black">5</td>
                    <td id="text_normal_black">PMB</td>
                    <td id="text_normal_black">Rp <?= number_format($sum_nominal_bima,0,",",".").",-"; ?></td>
                </tr>
                <?PHP
				}				
								
				////////////////////////////////////////////////////////
				//////////////////// Antar Jemput //////////////////////
				////////////////////////////////////////////////////////
				if($sum_nominal_daful == 0 || $sum_nominal_daful == "") {
				?>
                <tr height="20">
                	<td id="text_normal_black">6</td>
                    <td id="text_normal_black">Daftar Ulang</td>
                    <td id="text_normal_black">0</td>
                </tr>
                <?PHP
				} else {
				?>
                <tr height="20">
                	<td id="text_normal_black">6</td>
                    <td id="text_normal_black">Daftar Ulang</td>
                    <td id="text_normal_black">Rp <?= number_format($sum_nominal_daful,0,",",".").",-"; ?></td>
                </tr>
                 <?PHP
				}				
								
				////////////////////////////////////////////////////////
				//////////////////// Antar Jemput //////////////////////
				////////////////////////////////////////////////////////
				if($sum_nominal_all == 0 || $sum_nominal_all == "") {
				?>
                <tr height="30">
                    <td id="text_normal_black" colspan="2"><b>Jumlah harus dibayar</b></td>
                    <td id="text_normal_black"><b>0</b></td>
                </tr>
                <?PHP
				} else {
				?>
                 <tr height="30">
                    <td id="text_normal_black" colspan="2"><b>Jumlah harus dibayar</b></td>
                    <td id="text_normal_black"><b>Rp <?= number_format($sum_nominal_all,0,",",".").",-"; ?></b></td>
                </tr>
                <?PHP
				}
				?>
             </table>
             <table width="512" border="0" cellpadding="0" cellspacing="0">
             	<tr>
                	<td colspan="2"><hr noshade="noshade" size="1" /></td>
                </tr>
                <tr height="20">
                	<td id="text_normal_black" align="center">Pembayar</td>
                    <td id="text_normal_black" align="center">Depok,............<br />Penerima</td>
                 </tr>
            </table>
        </td>
        <td width="21" background="../images/batas_kwitansi.png" valign="bottom"><input type="button" value="." onclick="window.location.href='<?= $darbi_url; ?>mainpage.php?pl=tagihan';" style="background-color:#FFFFFF;"  /></td>
        <td>
        	<table width="512" border="0" cellpadding="0" cellspacing="0">
            	<tr>
                	<td width="40" id="text_normal_black"><img src="../images/icon_logo_black_small.png" /></td>
                    <td id="text_normal_black">Sekolah Islam Terpadu Darul Abidin</td>
                </tr>
                <tr>
                	<td colspan="2"><hr noshade="noshade" size="1" /></td>
                </tr>
                <tr>
                	<td colspan="2" id="text_normal_black" align="center" height="35"><span style="font-size:16px;">SLIP TAGIHAN SIT DARUL ABIDIN</span></td>
                </tr>
            </table>
            <table width="512" border="0" cellpadding="0" cellspacing="0">
            	<tr height="30">
                	<td width="100" id="text_normal_black">Nama siswa</td>
                    <td width="10" id="text_normal_black">:</td>
                    <td id="text_normal_black"><?= $sender_nama_siswa; ?> | <?= $sender_no_sisda; ?></td>
                </tr>
                <tr height="20">
                	<td id="text_normal_black">Kelas</td>
                    <td id="text_normal_black">:</td>
                    <td id="text_normal_black"><b><?= $get_kelas; ?></b></td>
                </tr>
                <tr height="20">
                	<td colspan="3">&nbsp;</td>
                </tr>
             </table>
             <table width="512" border="0" cellpadding="0" cellspacing="0">
            	<tr height="30">
                	<td width="40" id="text_normal_black">No</td>
                    <td width="250" id="text_normal_black">Uraian</td>
                    <td id="text_normal_black">Jumlah</td>
                </tr>
                <?PHP
				////////////////////////////////////////////////////////
				///////////////////////// SPP //////////////////////////
				////////////////////////////////////////////////////////
				if($sum_nominal_spp == 0 || $sum_nominal_spp == "") {
				?>
                <tr height="20">
                	<td id="text_normal_black">1</td>
                    <td id="text_normal_black">SPP</td>
                    <td id="text_normal_black">0</td>
                </tr>
                <?PHP
				} else {
				?>
                <tr height="20">
                	<td id="text_normal_black">1</td>
                    <td id="text_normal_black">SPP [<?= $src_bulan_spp."/".$src_tahun_spp; ?>] </td>
                    <td id="text_normal_black">Rp <?= number_format($sum_nominal_spp,0,",",".").",-"; ?></td>
                </tr>
                <?PHP
				}
				
				////////////////////////////////////////////////////////
				///////////////////////// KS ///////////////////////////
				////////////////////////////////////////////////////////
				if($all_cur_ks == 0 || $all_cur_ks == "") {
				?>
                <tr height="20">
                	<td id="text_normal_black">2</td>
                    <td id="text_normal_black">Komite Sekolah</td>
                    <td id="text_normal_black">0</td>
                </tr>
                <?PHP
				} else {
				?>
                <tr height="20">
                	<td id="text_normal_black">2</td>
                    <td id="text_normal_black">Komite Sekolah</td>
                    <td id="text_normal_black">Rp <?= number_format($all_cur_ks,0,",",".").",-"; ?></td>
                </tr>
                <?PHP
				}
				
				////////////////////////////////////////////////////////
				////////////////////// catering ////////////////////////
				////////////////////////////////////////////////////////
				if($sum_nominal_cat == 0 || $sum_nominal_cat == "") {
				?>
                <tr height="20">
                	<td id="text_normal_black">3</td>
                    <td id="text_normal_black">Catering</td>
                    <td id="text_normal_black">0</td>
                </tr>
                <?PHP
				} else {
				?>
                <tr height="20">
                	<td id="text_normal_black">3</td>
                    <td id="text_normal_black">Catering [<?= $src_bulan_cat."/".$src_tahun_cat; ?>]</td>
                    <td id="text_normal_black">Rp <?= number_format($sum_nominal_cat,0,",",".").",-"; ?></td>
                </tr>
                <?PHP
				}
				
				////////////////////////////////////////////////////////
				//////////////////// Antar Jemput //////////////////////
				////////////////////////////////////////////////////////
				if($sum_nominal_aj == 0 || $sum_nominal_aj == "") {
				?>
                <tr height="20">
                	<td id="text_normal_black">4</td>
                    <td id="text_normal_black">Jemputan</td>
                    <td id="text_normal_black">0</td>
                </tr>
                <?PHP
				} else {
				?>
                <tr height="20">
                	<td id="text_normal_black">4</td>
                    <td id="text_normal_black">Jemputan [<?= $src_bulan_aj."/".$src_tahun_aj; ?>]</td>
                    <td id="text_normal_black">Rp <?= number_format($sum_nominal_aj,0,",",".").",-"; ?></td>
                </tr>
                <?PHP
				}
								
				////////////////////////////////////////////////////////
				//////////////////// Antar Jemput //////////////////////
				////////////////////////////////////////////////////////
				if($sum_nominal_bima == 0 || $sum_nominal_bima == "") {
				?>
                <tr height="20">
                	<td id="text_normal_black">5</td>
                    <td id="text_normal_black">PMB</td>
                    <td id="text_normal_black">0</td>
                </tr>
                <?PHP
				} else {
				?>
                <tr height="20">
                	<td id="text_normal_black">5</td>
                    <td id="text_normal_black">PMB</td>
                    <td id="text_normal_black">Rp <?= number_format($sum_nominal_bima,0,",",".").",-"; ?></td>
                </tr>
                <?PHP
				}				
								
				////////////////////////////////////////////////////////
				//////////////////// Antar Jemput //////////////////////
				////////////////////////////////////////////////////////
				if($sum_nominal_daful == 0 || $sum_nominal_daful == "") {
				?>
                <tr height="20">
                	<td id="text_normal_black">6</td>
                    <td id="text_normal_black">Daftar Ulang</td>
                    <td id="text_normal_black">0</td>
                </tr>
                <?PHP
				} else {
				?>
                <tr height="20">
                	<td id="text_normal_black">6</td>
                    <td id="text_normal_black">Daftar Ulang</td>
                    <td id="text_normal_black">Rp <?= number_format($sum_nominal_daful,0,",",".").",-"; ?></td>
                </tr>
                <?PHP
				}
				
								
				////////////////////////////////////////////////////////
				//////////////////// Antar Jemput //////////////////////
				////////////////////////////////////////////////////////
				if($sum_nominal_all == 0 || $sum_nominal_all == "") {
				?>
                <tr height="30">
                    <td id="text_normal_black" colspan="2"><b>Jumlah harus dibayar</b></td>
                    <td id="text_normal_black"><b>0</b></td>
                </tr>
                <?PHP
				} else {
				?>
                 <tr height="30">
                    <td id="text_normal_black" colspan="2"><b>Jumlah harus dibayar</b></td>
                    <td id="text_normal_black"><b>Rp <?= number_format($sum_nominal_all,0,",",".").",-"; ?></b></td>
                </tr>
                <?PHP
				}
				?>
             </table>
             <table width="512" border="0" cellpadding="0" cellspacing="0">
                <tr>
                	<td colspan="2"><hr noshade="noshade" size="1" /></td>
                </tr>
                <tr height="20">
                	<td id="text_normal_black" align="center">Pembayar</td>
                    <td id="text_normal_black" align="center">Depok,............<br />Penerima</td>
                 </tr>
            </table>
        </td>
    </tr>
</table>
<table width="1045" border="0" cellpadding="0" cellspacing="0">
	<tr height="20">
    	<td></td>
    </tr>
</table>
</body>
</html>