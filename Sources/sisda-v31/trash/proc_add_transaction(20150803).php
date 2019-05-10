<?PHP
session_start();

if(isset($_SESSION["id"]) && $_SESSION["privilege"] == "2") {

	///////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////
	//////////////////////////ALL VARIABLES////////////////////////////
	///////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////
	
	$who_operator		= $_POST["who_operator"];
	$who_operator_enc 	= mysql_real_escape_string($who_operator);
	
	//-------> student data and transfer method
	
	$no_sisda 							= $_POST["no_sisda"];
	$no_sisda_enc						= mysql_real_escape_string($no_sisda);
	
	$nama_siswa							= $_POST["nama_siswa"];
	$nama_siswa_enc						= mysql_real_escape_string($nama_siswa);
	
	$kelas								= $_POST["kelas"];
	$kelas_enc							= mysql_real_escape_string($kelas);
	
	$jenjang							= $_POST["jenjang"];
	$jenjang_enc						= mysql_real_escape_string($jenjang);
	
	$tingkat							= $_POST["tingkat"];
	$tingkat_enc						= mysql_real_escape_string($tingkat);
	
	$tanggal_transaksi					= $_POST["tahun_transaksi"]."-".$_POST["bulan_transaksi"]."-".$_POST["tanggal_transaksi"];
	$tanggal_transaksi_enc				= mysql_real_escape_string($tanggal_transaksi);
	
	$teknik_pembayaran					= $_POST["teknik_pembayaran"];
	$teknik_pembayaran_enc				= mysql_real_escape_string($teknik_pembayaran);
	
	///////////////////////////////
	
	$cur_year_trans		= date("Y");
	$cur_month_trans	= strtolower(date("F"));
	
	if($cur_month_trans == "january" || $cur_month_trans == "february" || $cur_month_trans == "march" || $cur_month_trans == "april" || $cur_month_trans == "may" || $cur_month_trans == "june") {	
	
		$periode_trans	= ($cur_year_trans-1)." - ".$cur_year_trans;
		
	} else if ($cur_month_trans == "july" || $cur_month_trans == "august" || $cur_month_trans == "september" || $cur_month_trans == "october" || $cur_month_trans == "november" || $cur_month_trans == "december") {
		
		$periode_trans	= $cur_year_trans." - ".($cur_year_trans+1);
		
	}
	
	///////////////////////////////
	
	if($teknik_pembayaran == "transfer") {
	
		if(!empty($_POST["tanggal_transfer"]) && !empty($_POST["bulan_transfer"]) && !empty($_POST["tahun_transfer"]) && !empty($_POST["bank_tujuan"])) {	
			
			$tanggal_transfer		= $_POST["tahun_transfer"]."-".$_POST["bulan_transfer"]."-".$_POST["tanggal_transfer"];
			$tanggal_transfer_enc	= mysql_real_escape_string($tanggal_transfer);
			
			$bank_tujuan			= $_POST["bank_tujuan"];
			$bank_tujuan_enc		= mysql_real_escape_string($bank_tujuan);	
			
			$if_transfer_item	= ",tanggal_transfer, bank_tujuan";
			$if_transfer_value	= ",'$tanggal_transfer_enc','$bank_tujuan_enc'";
			
		} else {
		
			echo "Data bank tujuan atau tanggal transfer tidak lengkap";
			
		}
		
	} else if ($teknik_pembayaran == "tunai") {
	
		$tanggal_transfer_enc			= "";
		$bank_tujuan_enc				= "";
		
		$if_transfer_item				= "";
		$if_transfer_value				= "";
		
	}
	
	$student_pay	= mysql_real_escape_string($_POST["bayar"]);
	
	/////////////////////////////////////
	/////////// parity check/////////////
	/////////////////////////////////////
	$tgl_trs	= date("dmY");   // 01122014 
	$hour_trs	= date("siH");   // 123757
	
	$chk_d		= substr($tgl_trs,0,2); //tanngal
	$chk_m		= substr($tgl_trs,2,2); //bulan
	$chk_s		= substr($hour_trs,0,2); //detik
	$chk_i		= substr($hour_trs,2,2); //menit
	$chk_1		= substr($no_sisda_enc,6,2); //2014000123
	$chk_2		= substr($no_sisda_enc,8,6); //2014000123
	$chk_front	= substr($no_sisda_enc,4,6);
	$md5_hour	= strtoupper(substr(md5($hour_trs),0,10));
	
	$oe_d = $chk_d % 2; if($oe_d == 0) { $oddeven_d = "A"; } else { $oddeven_d = "B"; }
	$oe_m = $chk_m % 2; if($oe_m == 0) { $oddeven_m = "C"; } else { $oddeven_m = "D"; }
	$oe_s = $chk_s % 2; if($oe_s == 0) { $oddeven_s = "E"; } else { $oddeven_s = "F"; }
	$oe_i = $chk_i % 2; if($oe_i == 0) { $oddeven_i = "G"; } else { $oddeven_i = "H"; }
	$oe_1 = $chk_1 % 2; if($oe_1 == 0) { $oddeven_1 = "I"; } else { $oddeven_1 = "J"; }
	$oe_2 = $chk_2 % 2; if($oe_2 == 0) { $oddeven_2 = "K"; } else { $oddeven_2 = "L"; }
	
	//-ini dia--
	$src_no_kwintansi		= $chk_front."-".$md5_hour."-".$oddeven_d.$oddeven_m.$oddeven_s.$oddeven_i.$oddeven_1.$oddeven_2;
	$tanggal_transaksi_enc 	= substr($tgl_trs,4,4)."-".substr($tgl_trs,2,2)."-".substr($tgl_trs,0,2)." ".substr($hour_trs,4,2).":".substr($hour_trs,2,2).":".substr($hour_trs,0,2);
	
	/////////////////////////////////////
	
	
	///////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////
	////////////////////////--DAFTAR ULANG--///////////////////////////
	///////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////
	
	//If only there is at least one value filled in Daftar Ulang section, we proccess the data to database.
	//if $_POST["subtotal_daful"] empty or 0, it means all of Daftar Ulang fields are empty.
	//And we do not need to do something with this
	//The same thing goes to other sections
	
	if(!empty($_POST["subtotal_daful"]) && $_POST["subtotal_daful"] != 0) {
	
		$tahun_daftar_ulang_enc	= mysql_real_escape_string($_POST["year_daftar_ulang"]);
		
		if($tahun_daftar_ulang_enc != "") {
	
			$subtotal_daful_for_send			= mysql_real_escape_string($_POST["subtotal_daful"]);
			$subtotal_daful_enc					= mysql_real_escape_string($_POST["subtotal_daful"]);
			
			$tahun_bayar_berikut_daful			= empty($_POST["tahun_bayar_berikut_daful"]) ? 0 : $_POST["tahun_bayar_berikut_daful"];
			$bulan_bayar_berikut_daful			= empty($_POST["bulan_bayar_berikut_daful"]) ? 0 : $_POST["bulan_bayar_berikut_daful"];
			$tanggal_bayar_berikut_daful		= empty($_POST["tanggal_bayar_berikut_daful"]) ? 0 : $_POST["tanggal_bayar_berikut_daful"];
			
			$src_tanggal_bayar_berikut_daful	= $tahun_bayar_berikut_daful."-".$bulan_bayar_berikut_daful."-".$tanggal_bayar_berikut_daful;
			$tanggal_bayar_berikut_daful_enc	= mysql_real_escape_string($src_tanggal_bayar_berikut_daful);
			
			$subtotal_daful						= $_POST["subtotal_daful"];
			$subtotal_daful_enc					= mysql_real_escape_string($subtotal_daful);
			
			$src_get_tunggakan_daful	= "select nominal_tunggakan, nom_kegiatan, nom_peralatan, nom_seragam from tunggakan where no_sisda = '$no_sisda_enc' and periode = '$tahun_daftar_ulang_enc' and jenis_tunggakan = 'daftar_ulang'";
			$query_get_tunggakan_daful	= mysqli_query($mysql_connect, $src_get_tunggakan_daful) or die(mysql_error());
			$row_get_tunggakan_daful	= mysql_fetch_array($query_get_tunggakan_daful);
			
			//We have to fullfil the daful data sequentially, from kegiatan, peralatan, seragam.
			$exist_db_daful_kegiatan	= $row_get_tunggakan_daful["nom_kegiatan"];
			$exist_db_daful_peralatan	= $row_get_tunggakan_daful["nom_peralatan"];
			$exist_db_daful_seragam		= $row_get_tunggakan_daful["nom_seragam"];
			
			//echo "<h1>exixt kegiatan:".$exist_db_daful_kegiatan." hehe</h1>";
			if($exist_db_daful_kegiatan != 0) {
			
				if($subtotal_daful_enc == $exist_db_daful_kegiatan ) {
				
					$cur_db_daful_kegiatan	= 0;
					$transk_daful_kegiatan	= $exist_db_daful_kegiatan;
					$subtotal_daful_enc		= 0;
					//echo "<h1>exixt peralatan:aaa</h1>";
				
				} else if($subtotal_daful_enc > $exist_db_daful_kegiatan){
				
					$cur_db_daful_kegiatan	= 0;
					$transk_daful_kegiatan	= $exist_db_daful_kegiatan;
					$subtotal_daful_enc		= $subtotal_daful_enc - $exist_db_daful_kegiatan;
					//echo "<h1>exixt peralatan:bbb</h1>";
					
				} else if($subtotal_daful_enc < $exist_db_daful_kegiatan){
				
					$cur_db_daful_kegiatan	= $exist_db_daful_kegiatan - $subtotal_daful_enc;
					$transk_daful_kegiatan	= $cur_db_daful_kegiatan;
					$subtotal_daful_enc		= 0;
					//echo "<h1>exixt peralatan:ccc</h1>";
					
				}
				
			} else {
			
				$cur_db_daful_kegiatan	= 0;
				$transk_daful_kegiatan	= 0;
				
			}
			
			//echo "<h1>exixt peralatan:".$exist_db_daful_peralatan." hehe</h1>";
			//echo "<h1>subtotal daful:".$subtotal_daful_enc." hehe</h1>";
			if($exist_db_daful_peralatan != 0) {
			
				if($subtotal_daful_enc	!= 0) {
				
					if($subtotal_daful_enc == $exist_db_daful_peralatan ) {
				
						$cur_db_daful_peralatan	= 0;
						$transk_daful_peralatan	= $exist_db_daful_peralatan;
						$subtotal_daful_enc		= 0;
						//echo "<h1>exixt peralatan:ddd</h1>";
					
					} else if($subtotal_daful_enc > $exist_db_daful_peralatan){
					
						$cur_db_daful_peralatan	= 0;
						$transk_daful_peralatan	= $exist_db_daful_peralatan;
						$subtotal_daful_enc		= $subtotal_daful_enc - $exist_db_daful_peralatan;
						//echo "<h1>exixt peralatan:eee</h1>";
						
					} else if($subtotal_daful_enc < $exist_db_daful_peralatan){
					
						$cur_db_daful_peralatan	= $exist_db_daful_peralatan - $subtotal_daful_enc;
						$transk_daful_peralatan	= $subtotal_daful_enc;
						$subtotal_daful_enc		= 0;
						//echo "<h1>exixt peralatan:fff</h1>";
						
					}
					
				} else {
				
					$cur_db_daful_peralatan = $exist_db_daful_peralatan;
					$transk_daful_peralatan = 0;
					
				}
				
			} else {
			
				$cur_db_daful_peralatan	= 0;
				$transk_daful_peralatan = 0;
			
			}
			
			if($exist_db_daful_seragam != 0) {
			
				if($subtotal_daful_enc	!= 0) {
				
					if($subtotal_daful_enc == $exist_db_daful_seragam ) {
				
						$cur_db_daful_seragam	= 0;
						$transk_daful_seragam	= $exist_db_daful_seragam;
						$subtotal_daful_enc		= 0;
						//echo "<h1>exixt peralatan:ggg</h1>";
					
					} else if($subtotal_daful_enc > $exist_db_daful_seragam){
					
						$cur_db_daful_seragam	= 0;
						$transk_daful_seragam	= $exist_db_daful_seragam;
						$subtotal_daful_enc		= $subtotal_daful_enc - $exist_db_daful_seragam;
						//echo "<h1>exixt peralatan:hhh</h1>";
						
					} else if($subtotal_daful_enc < $exist_db_daful_seragam){
					
						$cur_db_daful_seragam	= $exist_db_daful_seragam - $subtotal_daful_enc;
						$transk_daful_seragam	= $subtotal_daful_enc;
						$subtotal_daful_enc		= 0;
						//echo "<h1>exixt peralatan:lll</h1>";
						
					}
					
				} else {
				
					$cur_db_daful_seragam = $exist_db_daful_seragam;
					$transk_daful_seragam = 0;
				}
			}
			
			
			
			$last_arrear_daful		= $row_get_tunggakan_daful["nominal_tunggakan"];
			$current_errear_daful	= $last_arrear_daful - (mysql_real_escape_string($subtotal_daful));
			
			//ini ya, yayasan akan unya hutang ke ortu murid jadinya klo ternyata, ke nominal yang tertulis oleh operator lebih ebsar dari tanggihan tunggakannya.
			//sebenernya bisa di counter sih,.. cuma ngerjainnya gak ke waktuan euy.....
			if($current_errear_daful <= 0) {
				
				$cur_status_daful = 0;
				
			} else {
			
				$cur_status_daful = 1;
			
			}
			
			$src_update_tunggakan_daful		= "
												update tunggakan set 
												status				= '$cur_status_daful',
												nominal_tunggakan 	= '$current_errear_daful',
												nom_kegiatan 		= '$cur_db_daful_kegiatan',
												nom_peralatan 		= '$cur_db_daful_peralatan',
												nom_seragam 		= '$cur_db_daful_seragam' 
												
												where  
												
												no_sisda = '$no_sisda_enc'												
												and periode = '$tahun_daftar_ulang_enc' 
												and jenis_tunggakan = 'daftar_ulang'
												";
												
			$query_update_tunggakan_daful	= mysqli_query($mysql_connect, $src_update_tunggakan_daful) or die(mysql_error());
			
			if($query_update_tunggakan_daful) {
		
				$src_input_daful	= "insert into transaksi (
										no_sisda, 
										no_trs,
										kasir,
										tanggal_transaksi,
										periode,
										nama_siswa,
										jenjang,
										tingkat,
										kelas,
										teknik_pembayaran, 
										kegiatan_daful,
										peralatan_daful,
										seragam_daful,
										tanggal_bayar_berikut_daful,
										jenis_transaksi
										$if_transfer_item
										) values (
										'$no_sisda_enc', 
										'$src_no_kwintansi',
										'$who_operator_enc',
										'$tanggal_transaksi_enc',
										'$periode_trans',
										'$nama_siswa_enc',
										'$jenjang_enc',
										'$tingkat_enc',
										'$kelas_enc',
										'$teknik_pembayaran_enc',								
										'$transk_daful_kegiatan',
										'$transk_daful_peralatan',
										'$transk_daful_seragam',
										'$tanggal_bayar_berikut_daful_enc',
										'daftar_ulang'
										$if_transfer_value
										)";
										
				$query_input_daful	= mysqli_query($mysql_connect, $src_input_daful) or die(mysql_error());
				
				if($query_input_daful)  {
				
					$daful_succeed = "okeh";
					$daful_message = "";
					
				} else {
				
					$daful_succeed = "gagal";
					$daful_message = "[Untuk dicatat: Kasus transaksi daftar ulang jenis <b>1</b>]<br> Update table transaksi untuk daftar ulang tidak berhasil";
				
				}
			
			} else {
			
				$daful_succeed = "gagal";
				$daful_message = "[Untuk dicatat: Kasus transaksi daftar ulang jenis <b>2</b>]<br> Update table tunggakan untuk daftar ulang tidak berhasil";			
			
			}
			
		} else {
		
			$daful_succeed = "gagal";
			$daful_message = "[Untuk dicatat: Kasus transaksi daftar ulang jenis <b>3</b>]<br>Tahun pembayaran untuk Daftar ulang tidak dipilih, proses tidak dapat dilanjutkan";
			
		}
		
	} //owned by: if(!empty($_POST["subtotal_daful"]) && $_POST["subtotal_daful"] != 0) {
	
	//---------------------------//
	//--------END OF DAFUL-------//
	//---------------------------//
	
	
	///////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////
	//////////////////////////BIAYA MASUK//////////////////////////////
	///////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////
	if(!empty($_POST["subtotal_bima"]) && $_POST["subtotal_bima"] != 0) {
	
		$subtotal_bima_for_send				= mysql_real_escape_string($_POST["subtotal_bima"]);
	
		$pengembangan_bima					= empty($_POST["pengembangan_bima"]) ? 0 : $_POST["pengembangan_bima"];
		$pengembangan_bima_enc				= mysql_real_escape_string($pengembangan_bima);
		
		$kegiatan_bima						= empty($_POST["kegiatan_bima"]) ? 0 : $_POST["kegiatan_bima"];
		$kegiatan_bima_enc					= mysql_real_escape_string($kegiatan_bima);
		
		$peralatan_bima						= empty($_POST["peralatan_bima"]) ? 0 : $_POST["peralatan_bima"];
		$peralatan_bima_enc					= mysql_real_escape_string($peralatan_bima);
		
		$seragam_bima						= empty($_POST["seragam_bima"]) ? 0 : $_POST["seragam_bima"];
		$seragam_bima_enc					= mysql_real_escape_string($seragam_bima);
		
		$paket_bima							= empty($_POST["paket_bima"]) ? 0 : $_POST["paket_bima"];
		$paket_bima_enc						= mysql_real_escape_string($paket_bima);
		
		$spp_juli_bima						= empty($_POST["spp_juli_bima"]) ? 0 : $_POST["spp_juli_bima"];
		$spp_juli_bima_enc					= mysql_real_escape_string($spp_juli_bima);
		
		$tahap_bima							= empty($_POST["tahap_bima"]) ? 0 : $_POST["tahap_bima"];
		$tahap_bima_enc						= mysql_real_escape_string($tahap_bima);
		
		$lucil_bima							= empty($_POST["lucil_bima"]) ? 0 : $_POST["lucil_bima"];
		$lucil_bima_enc						= mysql_real_escape_string($lucil_bima);
		
		/*$tahun_bayar_berikut_bima			= empty($_POST["tahun_bayar_berikut_bima"]) ? 0 : $_POST["tahun_bayar_berikut_bima"];
		$bulan_bayar_berikut_bima			= empty($_POST["bulan_bayar_berikut_bima"]) ? 0 : $_POST["bulan_bayar_berikut_bima"];
		$tanggal_bayar_berikut_bima			= empty($_POST["tanggal_bayar_berikut_bima"]) ? 0 : $_POST["tanggal_bayar_berikut_bima"];
		
		$src_tanggal_bayar_berikut_bima		= $_POST["tahun_bayar_berikut_bima"]."-".$_POST["bulan_bayar_berikut_bima"]."-".$_POST["tanggal_bayar_berikut_bima"];
		$tanggal_bayar_berikut_bima_enc		= mysql_real_escape_string($src_tanggal_bayar_berikut_bima);*/
		
		//$kekurangan_bima					= $_POST["kekurangan_bima"];
		//$kekurangan_bima_enc				= mysql_real_escape_string($kekurangan_bima);
	
		$subtotal_bima						= $_POST["subtotal_bima"];
		$subtotal_bima_enc					= mysql_real_escape_string($subtotal_bima);
		
		$src_get_tunggakan_bima		= "
										select 
										nominal_tunggakan,
										nom_pengembangan,
										nom_kegiatan,
										nom_peralatan,
										nom_seragam,
										nom_paket
										from 
										tunggakan where no_sisda = '$no_sisda_enc' and 
										jenis_tunggakan = 'biaya_masuk'
										";
										
		$query_get_tunggakan_bima	= mysqli_query($mysql_connect, $src_get_tunggakan_bima) or die(mysql_error());
		$row_get_tunggakan_bima		= mysql_fetch_array($query_get_tunggakan_bima);
		
		//We have to fullfil the bima data sequentially, from pengembangan, kegiatan, peralatan, seragam, paket.
		//Jadi idenya gini,... itu di tabel TUNGGAKAN kelima item di atas akan di catat nominal yang seharusnya dibayar
		//berdasarkan data dari DB biaya masuk pas registrasi
		//Nah.. jumlah itu secara berurutan akan berkurang hingga = 0, bersamaan dengan jumlah pembayaran yang dilakukan oleh siswa.
		//Misal:
		//nom_pengembangan = Rp 15.000,- & nom_kegiatan =  Rp 12.500,-
		//Pembayaran ke-1 = Rp 20.000,-
		//Maka dari hasil pembayaran itu terjadi perubahan di tabel TUNGGAKAN
		//nom_pengembangan = 0 (tercukupi dari 15000-20000, sisa 5000)
		//nom_kegiatan = 7500 (12500 - sisa 5000)
		//Dan begitu seterusnya hingga seluruhnya bernilai 0, dan itu berarti lunas.
		
		$exist_db_bima_pengembangan	= $row_get_tunggakan_bima["nom_pengembangan"];
		$exist_db_bima_kegiatan		= $row_get_tunggakan_bima["nom_kegiatan"];
		$exist_db_bima_peralatan	= $row_get_tunggakan_bima["nom_peralatan"];
		$exist_db_bima_seragam		= $row_get_tunggakan_bima["nom_seragam"];
		$exist_db_bima_paket		= $row_get_tunggakan_bima["nom_paket"];
		
		//echo "<h1>exixt pengembangan:".$exist_db_bima_pengembangan." hehe</h1>";
		
		//Masih ada sisi tunggakan untuk item pengembangan
		if($exist_db_bima_pengembangan != 0) {
		
			//JIka jumlah dibayar sama dengan jumlah pengembangan di tabel tunggakan
			if($subtotal_bima_enc == $exist_db_bima_pengembangan ) {
			
				$cur_db_bima_pengembangan	= 0;
				$transk_bima_pengembangan	= $exist_db_bima_pengembangan;
				$subtotal_bima_enc			= 0;
				//echo "<h1>exixt pengembangan:aaa</h1>";
			
			} else if($subtotal_bima_enc > $exist_db_bima_pengembangan){
			
				$cur_db_bima_pengembangan	= 0;
				$transk_bima_pengembangan	= $exist_db_bima_pengembangan;
				$subtotal_bima_enc			= $subtotal_bima_enc - $exist_db_bima_pengembangan;
				//echo "<h1>exixt pengembangan:bbb</h1>";
				
			} else if($subtotal_bima_enc < $exist_db_bima_pengembangan){
			
				$cur_db_bima_pengembangan	= $exist_db_bima_pengembangan - $subtotal_bima_enc;
				$transk_bima_pengembangan	= $subtotal_bima_enc;
				$subtotal_bima_enc			= 0;
				//echo "<h1>exixt pengembangan:ccc</h1>";
				
			}
			
		} else {
		
			$cur_db_bima_pengembangan	= 0;
			$transk_bima_pengembangan	= 0;
			
		}
		
		//echo "<h1>exixt pengembangan:".$exist_db_bima_pengembangan." hehe</h1>";
		//echo "<h1>subtotal bima:".$subtotal_bima_enc." hehe</h1>";
		if($exist_db_bima_kegiatan != 0) {
		
			if($subtotal_bima_enc	!= 0) {
			
				if($subtotal_bima_enc == $exist_db_bima_kegiatan ) {
			
					$cur_db_bima_kegiatan	= 0;
					$transk_bima_kegiatan	= $exist_db_bima_kegiatan;
					$subtotal_bima_enc		= 0;
					//echo "<h1>exixt kegiatan:ddd</h1>";
				
				} else if($subtotal_bima_enc > $exist_db_bima_kegiatan){
				
					$cur_db_bima_kegiatan	= 0;
					$transk_bima_kegiatan	= $exist_db_bima_kegiatan;
					$subtotal_bima_enc		= $subtotal_bima_enc - $exist_db_bima_kegiatan;
					//echo "<h1>exixt kegiatan:eee</h1>";
					
				} else if($subtotal_bima_enc < $exist_db_bima_kegiatan){
				
					$cur_db_bima_kegiatan	= $exist_db_bima_kegiatan - $subtotal_bima_enc;
					$transk_bima_kegiatan	= $subtotal_bima_enc;
					$subtotal_bima_enc		= 0;
					//echo "<h1>exixt kegiatan:fff</h1>";
					
				}
				
			} else {
			
				$cur_db_bima_kegiatan = $exist_db_bima_kegiatan;
				$transk_bima_kegiatan = 0;
				
			}
			
		} else {
		
			$cur_db_bima_kegiatan = 0;
			$transk_bima_kegiatan = 0;
		
		}
		
		//echo "<h1>exixt kegiatan:".$exist_db_bima_kegiatan." hehe</h1>";
		//echo "<h1>subtotal bima:".$subtotal_bima_enc." hehe</h1>";
		if($exist_db_bima_peralatan != 0) {
		
			if($subtotal_bima_enc	!= 0) {
			
				if($subtotal_bima_enc == $exist_db_bima_peralatan ) {
			
					$cur_db_bima_peralatan	= 0;
					$transk_bima_peralatan	= $exist_db_bima_peralatan;
					$subtotal_bima_enc		= 0;
					//echo "<h1>exixt peralatan:ddd</h1>";
				
				} else if($subtotal_bima_enc > $exist_db_bima_peralatan){
				
					$cur_db_bima_peralatan	= 0;
					$transk_bima_peralatan	= $exist_db_bima_peralatan;
					$subtotal_bima_enc		= $subtotal_bima_enc - $exist_db_bima_peralatan;
					//echo "<h1>exixt peralatan:eee</h1>";
					
				} else if($subtotal_bima_enc < $exist_db_bima_peralatan){
				
					$cur_db_bima_peralatan	= $exist_db_bima_peralatan - $subtotal_bima_enc;
					$transk_bima_peralatan	= $subtotal_bima_enc;
					$subtotal_bima_enc		= 0;
					//echo "<h1>exixt peralatan:fff</h1>";
					
				}
				
			} else {
			
				$cur_db_bima_peralatan = $exist_db_bima_peralatan;
				$transk_bima_peralatan = 0;
				
			}
			
		} else {
		
			$cur_db_bima_peralatan	= 0;
			$transk_bima_peralatan = 0;
		
		}
		
		//echo "<h1>exixt seragam:".$exist_db_bima_seragam." hehe</h1>";
		//echo "<h1>subtotal bima:".$subtotal_bima_enc." hehe</h1>";
		if($exist_db_bima_seragam != 0) {
		
			if($subtotal_bima_enc	!= 0) {
			
				if($subtotal_bima_enc == $exist_db_bima_seragam ) {
			
					$cur_db_bima_seragam	= 0;
					$transk_bima_seragam	= $exist_db_bima_seragam;
					$subtotal_bima_enc		= 0;
					//echo "<h1>exixt seragam:ddd</h1>";
				
				} else if($subtotal_bima_enc > $exist_db_bima_seragam){
				
					$cur_db_bima_seragam	= 0;
					$transk_bima_seragam	= $exist_db_bima_seragam;
					$subtotal_bima_enc		= $subtotal_bima_enc - $exist_db_bima_seragam;
					//echo "<h1>exixt seragam:eee</h1>";
					
				} else if($subtotal_bima_enc < $exist_db_bima_seragam){
				
					$cur_db_bima_seragam	= $exist_db_bima_seragam - $subtotal_bima_enc;
					$transk_bima_seragam	= $subtotal_bima_enc;
					$subtotal_bima_enc		= 0;
					//echo "<h1>exixt seragam:fff</h1>";
					
				}
				
			} else {
			
				$cur_db_bima_seragam = $exist_db_bima_seragam;
				$transk_bima_seragam = 0;
				
			}
			
		} else {
		
			$cur_db_bima_seragam	= 0;
			$transk_bima_seragam = 0;
		
		}
		
		if($exist_db_bima_paket != 0) {
			
			if($subtotal_bima_enc	!= 0) {
			
				if($subtotal_bima_enc == $exist_db_bima_paket ) {
			
					$cur_db_bima_paket	= 0;
					$transk_bima_paket	= $exist_db_bima_paket;
					$subtotal_bima_enc		= 0;
					//echo "<h1>exixt paket:ggg</h1>";
				
				} else if($subtotal_bima_enc > $exist_db_bima_paket){
				
					$cur_db_bima_paket	= 0;
					$transk_bima_paket	= $exist_db_bima_paket;
					$subtotal_bima_enc	= $subtotal_bima_enc - $exist_db_bima_paket;
					//echo "<h1>exixt paket:hhh</h1>";
					
				} else if($subtotal_bima_enc < $exist_db_bima_paket){
				
					$cur_db_bima_paket	= $exist_db_bima_paket - $subtotal_bima_enc;
					$transk_bima_paket	= $subtotal_bima_enc;
					$subtotal_bima_enc		= 0;
					//echo "<h1>exixt paket:lll</h1>";
					
				}
			} else {
			
				$cur_db_bima_paket = $exist_db_bima_paket;
				$transk_bima_paket = 0;
			}
		} else {
		
			$cur_db_bima_paket = 0;
			$transk_bima_paket = 0;
		
		}
		
		$last_arrear_bima		= $row_get_tunggakan_bima["nominal_tunggakan"];
		$current_arrear_bima 	= $last_arrear_bima - $subtotal_bima;
		
		if($current_arrear_bima <= 0) {
				
			$cur_status_bima = 0;
			
		} else {
		
			$cur_status_bima = 1;
		
		}
		
		$src_update_tunggakan_bima		= 	"
											update tunggakan set 
											nominal_tunggakan 	= '$current_arrear_bima',
											nom_pengembangan	= '$cur_db_bima_pengembangan',
											nom_kegiatan 		= '$cur_db_bima_kegiatan',
											nom_peralatan 		= '$cur_db_bima_peralatan',
											nom_seragam 		= '$cur_db_bima_seragam',
											nom_paket	 		= '$cur_db_bima_paket',  
											status				= '$cur_status_bima'
											where  
											no_sisda = '$no_sisda_enc' and 
											jenis_tunggakan = 'biaya_masuk'
											";
											
		$query_update_tunggakan_bima	= mysqli_query($mysql_connect, $src_update_tunggakan_bima) or die($src_update_tunggakan_bima);
		
		if($query_update_tunggakan_bima) {
		
			$src_input_bima	= "insert into transaksi (
									no_sisda,
									no_trs,
									kasir,
									tanggal_transaksi,
									periode, 
									nama_siswa,
									jenjang,
									tingkat,
									kelas,
									teknik_pembayaran,
									pengembangan_bima,
									kegiatan_bima,
									peralatan_bima,
									seragam_bima,
									paket_bima,
									spp_juli_bima,
									tahap_bima,
									lucil_bima,
									jenis_transaksi
									$if_transfer_item
									) values (
									'$no_sisda_enc',
									'$src_no_kwintansi',
									'$who_operator_enc',
									'$tanggal_transaksi_enc',
									'$periode_trans', 
									'$nama_siswa_enc',
									'$jenjang_enc',
									'$tingkat_enc',
									'$kelas_enc',
									'$teknik_pembayaran_enc',
									'$transk_bima_pengembangan',
									'$transk_bima_kegiatan',
									'$transk_bima_peralatan',
									'$transk_bima_seragam',
									'$transk_bima_paket',
									'$spp_juli_bima_enc',
									'$tahap_bima_enc',
									'$lucil_bima_enc',
									'bima' 
									$if_transfer_value
									)";
									
			$query_input_bima	= mysqli_query($mysql_connect, $src_input_bima) or die(mysql_error());
			
			if($query_input_bima) {
			
				$bima_succeed 	= "okeh";;
				$bima_message	= "";
				
			} else {
			
				$bima_succeed = "gagal";
				$bima_message = "[Untuk dicatat: Kasus transaksi biaya masuk jenis <b>1</b>]<br>Update table <b>Transaksi untuk Biaya Masuk</b> tidak berhasil";
				
			}
			
		} else {
		
			$bima_succeed = "gagal";
			$bima_message = "[Untuk dicatat: Kasus transaksi biaya masuk jenis <b>2</b>]<br> Update table <b>Tunggakan untuk Biaya Masuk</b> tidak berhasil";
		
		}
		
	} //owned by: if(!empty($_POST["subtotal_bima"]) && $_POST["subtotal_bima"] != 0) {
	
	//---------------------------//
	//--------END OF BIMA -------//
	//---------------------------//
	
	
	///////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////
	////////////////////////////--SPP--////////////////////////////////
	///////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////
	
	//Related files to the cases below (tunggakan in SPP, ect) ++++++++++++++++++++++++++
	//////////////////////////////////////////////////////////////////////////////
	////////Please check -> include/define_month_spp.php executed in proc_login.php///////
	////////Please check -> include/check_spp_arrear.php executed in proc_login.php///////
	////////Please check -> page/proc_reg_adm_siswa.php///////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////
	
	if(!empty($_POST["subtotal_spp"]) && $_POST["subtotal_spp"] != 0) {
	
		//$src_year_spp						= empty($_POST["year_spp"]) ? 0 : $_POST["year_spp"];
		//$year_spp							= substr($src_year_spp,0,11);
		//$year_spp_enc						= mysql_real_escape_string($year_spp);
		
		$bulan_spp							= empty($_POST["bulan_spp"]) ? 0 : $_POST["bulan_spp"];	
		//$bulan_spp_enc					= mysql_real_escape_string($bulan_spp);
		$bulan_spp_enc						= $bulan_spp;
		
		$spp_spp							= empty($_POST["spp_spp"]) ? 0 : $_POST["spp_spp"];
		$spp_spp_enc						= mysql_real_escape_string($spp_spp);
		
		$ks_spp								= empty($_POST["ks_spp"]) ? 0 : $_POST["ks_spp"];
		$ks_spp_enc							= mysql_real_escape_string($ks_spp);
		
		$nom_spp							= $_POST["nom_spp"];
		$nom_spp_enc						= mysql_real_escape_string($nom_spp);
						
		$subtotal_spp						= $_POST["subtotal_spp"];
		$subtotal_spp_enc					= mysql_real_escape_string($subtotal_spp);
	
		/////--------------------------------------------------------//////
		//Yo-Yo-Yo..... look at what happen here...
		//we are going to work in many conditions with SPP, it's why you will find so many proccess here.
		//i hope it's not confusing you.....qqackkk-qackkkk-qackkkk, kamal juragan kambing garut KW5
		//Okay......			
		
		//we are working in SPP- SPP- SPP- SPP
		/////////////////////////////////////
		//bon ambil dulu data dari database si fulan ini, cocokin yang udah bayarnya yang mana?
		///ngertikan??????????????????????  ---> GAK NGERTI>>>hehehe (Gila Xampeyan)
		//jangan khawatir.... itu $year_spp_enc gak mungkin dobel... soalnya dah di counter, admin gak bakal input 2 tahun pelajaran yang berbeda di formnya... 
		$src_cur_month_val		= "select * from tunggakan where no_sisda = '$no_sisda_enc' and jenis_tunggakan = 'spp' and (status = '1' || status = '2') order by id";
		
		$query_cur_month_val	= mysqli_query($mysql_connect, $src_cur_month_val) or die(mysql_error());
		//$num					= mysql_num_rows($query_cur_month_val);
		
		
		$ifirst = 0;
		$all_month_checked	= "";
		
		while($row_available_payment = mysql_fetch_array($query_cur_month_val)) {
			
			$src_year_db_spp	= $row_available_payment["periode"]; 
			$year_spp_auto		= substr($src_year_db_spp,0,4).substr($src_year_db_spp,7,4);
			
			$arrear_spp_july = substr($row_available_payment["july"],0,1);
			
			if($arrear_spp_july == 0 || $arrear_spp_july == 1 || $arrear_spp_july == 2 || $arrear_spp_july == 3) {
				
				$sta_spp_auto_jul = substr($row_available_payment["july"],0,1);
				$nom_spp_auto_jul = substr($row_available_payment["july"],2);
				$ifirst++;
				
				if($ifirst == 1) { $first_month_payment = "jul-".$year_spp_auto; }
				$all_month_checked = $all_month_checked."jul-".$year_spp_auto."-".$sta_spp_auto_jul."-".$nom_spp_auto_jul.",";
				
			}
			
			$arrear_spp_august = substr($row_available_payment["august"],0,1);
			if($arrear_spp_august == 0 || $arrear_spp_august == 1 || $arrear_spp_august == 2 || $arrear_spp_august == 3) { 
				
				$sta_spp_auto_aug = substr($row_available_payment["august"],0,1);
				$nom_spp_auto_aug = substr($row_available_payment["august"],2);
				$ifirst++;
				
				if($ifirst == 1) { $first_month_payment = "aug-".$year_spp_auto; }
				$all_month_checked = $all_month_checked."aug-".$year_spp_auto."-".$sta_spp_auto_aug."-".$nom_spp_auto_aug.",";

			}
			
			$arrear_spp_september = substr($row_available_payment["september"],0,1);
			if($arrear_spp_september == 0 || $arrear_spp_september == 1 || $arrear_spp_september == 2 || $arrear_spp_september == 3) {
				
				$sta_spp_auto_sep = substr($row_available_payment["september"],0,1);
				$nom_spp_auto_sep = substr($row_available_payment["september"],2);
				$ifirst++;
				
				if($ifirst == 1) { $first_month_payment = "sep-".$year_spp_auto; }
				$all_month_checked = $all_month_checked."sep-".$year_spp_auto."-".$sta_spp_auto_sep."-".$nom_spp_auto_sep.",";
			
			}
			
			$arrear_spp_october = substr($row_available_payment["october"],0,1);
			if($arrear_spp_october == 0 || $arrear_spp_october == 1 || $arrear_spp_october == 2 || $arrear_spp_october == 3) { 
				
				$sta_spp_auto_oct = substr($row_available_payment["october"],0,1);
				$nom_spp_auto_oct = substr($row_available_payment["october"],2);
				$ifirst++;
				
				if($ifirst == 1) { $first_month_payment = "oct-".$year_spp_auto; }
				$all_month_checked = $all_month_checked."oct-".$year_spp_auto."-".$sta_spp_auto_oct."-".$nom_spp_auto_oct.",";
			
			}
			
			$arrear_spp_november = substr($row_available_payment["november"],0,1);
			if($arrear_spp_november == 0 || $arrear_spp_november == 1 || $arrear_spp_november == 2 || $arrear_spp_november == 3) { 
				
				$sta_spp_auto_nov = substr($row_available_payment["november"],0,1);
				$nom_spp_auto_nov = substr($row_available_payment["november"],2);
				$ifirst++;
				
				if($ifirst == 1) { $first_month_payment = "nov-".$year_spp_auto; }
				$all_month_checked = $all_month_checked."nov-".$year_spp_auto."-".$sta_spp_auto_nov."-".$nom_spp_auto_nov.",";

			}
			
			$arrear_spp_december = substr($row_available_payment["december"],0,1);
			if($arrear_spp_december == 0 || $arrear_spp_december == 1 || $arrear_spp_december == 2 || $arrear_spp_december == 3) { 
				
				$sta_spp_auto_dec = substr($row_available_payment["december"],0,1);
				$nom_spp_auto_dec = substr($row_available_payment["december"],2);
				$ifirst++;
				
				if($ifirst == 1) { $first_month_payment = "dec-".$year_spp_auto; }
				$all_month_checked = $all_month_checked."dec-".$year_spp_auto."-".$sta_spp_auto_dec."-".$nom_spp_auto_dec.",";

			}
			
			$arrear_spp_january = substr($row_available_payment["january"],0,1);
			if($arrear_spp_january == 0 || $arrear_spp_january == 1 || $arrear_spp_january == 2 || $arrear_spp_january == 3) { 
				
				$sta_spp_auto_jan = substr($row_available_payment["january"],0,1);
				$nom_spp_auto_jan = substr($row_available_payment["january"],2);
				$ifirst++;
				
				if($ifirst == 1) { $first_month_payment = "jan-".$year_spp_auto; }
				$all_month_checked = $all_month_checked."jan-".$year_spp_auto."-".$sta_spp_auto_jan."-".$nom_spp_auto_jan.",";

			}
			
			$arrear_spp_february = substr($row_available_payment["february"],0,1);
			if($arrear_spp_february == 0 || $arrear_spp_february == 1 || $arrear_spp_february == 2 || $arrear_spp_february == 3) { 
				
				$sta_spp_auto_feb = substr($row_available_payment["february"],0,1);
				$nom_spp_auto_feb = substr($row_available_payment["february"],2);
				$ifirst++;
				
				if($ifirst == 1) { $first_month_payment = "feb-".$year_spp_auto; }
				$all_month_checked = $all_month_checked."feb-".$year_spp_auto."-".$sta_spp_auto_feb."-".$nom_spp_auto_feb.",";

			}
			
			$arrear_spp_march = substr($row_available_payment["march"],0,1);
			if($arrear_spp_march == 0 || $arrear_spp_march == 1 || $arrear_spp_march == 2 || $arrear_spp_march == 3) { 
				
				$sta_spp_auto_mar = substr($row_available_payment["march"],0,1);
				$nom_spp_auto_mar = substr($row_available_payment["march"],2);
				$ifirst++;
				
				if($ifirst == 1) { $first_month_payment = "mar-".$year_spp_auto; }
				$all_month_checked = $all_month_checked."mar-".$year_spp_auto."-".$sta_spp_auto_mar."-".$nom_spp_auto_mar.",";

			} 
			
			$arrear_spp_april = substr($row_available_payment["april"],0,1);
			if($arrear_spp_april == 0 || $arrear_spp_april == 1 || $arrear_spp_april == 2 || $arrear_spp_april == 3) { 
				
				$sta_spp_auto_apr = substr($row_available_payment["april"],0,1);
				$nom_spp_auto_apr = substr($row_available_payment["april"],2);
				$ifirst++;
				
				if($ifirst == 1) { $first_month_payment = "apr-".$year_spp_auto; }
				$all_month_checked = $all_month_checked."apr-".$year_spp_auto."-".$sta_spp_auto_apr."-".$nom_spp_auto_apr.",";

			}
			
			$arrear_spp_may = substr($row_available_payment["may"],0,1);
			if($arrear_spp_may == 0 || $arrear_spp_may == 1 || $arrear_spp_may == 2 || $arrear_spp_may == 3) { 
				
				$sta_spp_auto_may = substr($row_available_payment["may"],0,1);
				$nom_spp_auto_may = substr($row_available_payment["may"],2);
				$ifirst++;
				
				if($ifirst == 1) { $first_month_payment = "may-".$year_spp_auto; }
				$all_month_checked = $all_month_checked."may-".$year_spp_auto."-".$sta_spp_auto_may."-".$nom_spp_auto_may.",";

			}
			
			$arrear_spp_june = substr($row_available_payment["june"],0,1);
			if($arrear_spp_june == 0 || $arrear_spp_june == 1 || $arrear_spp_june == 2 || $arrear_spp_june == 3) { 
			
				$sta_spp_auto_jun = substr($row_available_payment["june"],0,1);
				$nom_spp_auto_jun = substr($row_available_payment["june"],2);
				$ifirst++;
				
				if($ifirst == 1) { $first_month_payment = "jun-".$year_spp_auto; }
				$all_month_checked = $all_month_checked."jun-".$year_spp_auto."-".$sta_spp_auto_jun."-".$nom_spp_auto_jun.",";

			}
		
		}
		
		$count_bulan_spp = count($bulan_spp); 
		
		$first_month_paid = $bulan_spp[0]; 
		$first_month_paid_checked = substr($first_month_paid,0,12); 
		
		//echo "first_month_payment: ".$first_month_payment."<br>";
		//echo "all_month_checked: ".$all_month_checked."<br>";
		//echo "first_month_paid_checked: ".$first_month_paid_checked."<br>";
		
		$src_nama_bulan_diinput	= $bulan_spp;
		$nama_bulan_diinput		= implode($src_nama_bulan_diinput,',');
		
		//echo $nama_bulan_diinput;
		
		//echo "[".$all_month_checked."]<br>";
		//echo "[".$nama_bulan_diinput."]<br>";
		
		if($first_month_payment == $first_month_paid_checked) {
		
			if(strstr($all_month_checked,$nama_bulan_diinput) != false) {
			
				$src_total_ks 			= "";
				$src_total_ict			= "";
				$src_total_elearning	= "";
				$src_total_spp			= "";
				
				$total_month_spp_transk = "";
				
				for($i=0; $i < $count_bulan_spp; $i++) {
				
					$src_cur_pay = $bulan_spp[$i];
				
					if(substr($src_cur_pay,0,3) == "jul") { $cur_month_pay = "july"; }
					if(substr($src_cur_pay,0,3) == "aug") { $cur_month_pay = "august"; }
					if(substr($src_cur_pay,0,3) == "sep") { $cur_month_pay = "september"; }
					if(substr($src_cur_pay,0,3) == "oct") { $cur_month_pay = "october"; }
					if(substr($src_cur_pay,0,3) == "nov") { $cur_month_pay = "november"; }
					if(substr($src_cur_pay,0,3) == "dec") { $cur_month_pay = "december"; }
					if(substr($src_cur_pay,0,3) == "jan") { $cur_month_pay = "january"; }
					if(substr($src_cur_pay,0,3) == "feb") { $cur_month_pay = "february"; }
					if(substr($src_cur_pay,0,3) == "mar") { $cur_month_pay = "march"; }
					if(substr($src_cur_pay,0,3) == "apr") { $cur_month_pay = "april"; }
					if(substr($src_cur_pay,0,3) == "may") { $cur_month_pay = "may"; }
					if(substr($src_cur_pay,0,3) == "jun") { $cur_month_pay = "june"; }
					
					$total_month_spp_transk = $total_month_spp_transk.$cur_month_pay.", ";
					
					$cur_year_pay_spp 	= substr($src_cur_pay,4,4)." - ".substr($src_cur_pay,8,4);
					$cur_sta_pay_spp	= substr($src_cur_pay,13,1);
					$cur_nom_pay_spp	= substr($src_cur_pay,15);
					
					$src_get_detail_spp		= "select spp,ict,elearning,ks from siswa_finance where no_sisda = '$no_sisda_enc' and periode = '$cur_year_pay_spp'";
					$query_get_detail_spp	= mysqli_query($mysql_connect, $src_get_detail_spp) or die(mysql_error());
					$row_get_detail_spp		= mysql_fetch_array($query_get_detail_spp);
					
					$share_spp			= $row_get_detail_spp["spp"];
					$share_ict			= $row_get_detail_spp["ict"];
					$share_elearning	= $row_get_detail_spp["elearning"];
					$share_ks			= $row_get_detail_spp["ks"];
					
					
					//////////////
					if($cur_nom_pay_spp <= $share_ks) {
					
						$new_share_ks			= $cur_nom_pay_spp;
						$new_share_ict			= 0;
						$new_share_elearning	= 0;
						$new_share_spp			= 0;
						
					} else {
					
						$new_nom_pay_spp = $cur_nom_pay_spp - $share_ks;
						$new_share_ks	 = $share_ks;
						
					}
					//////////////
					if($new_nom_pay_spp <= $share_ict) {
					
						$new_share_ict			= $new_nom_pay_spp;
						$new_share_elearning	= 0;
						$new_share_spp			= 0;
					
					} else {
					
						$new_nom_pay_spp = $new_nom_pay_spp - $share_ict;
						$new_share_ict	 = $share_ict;
					
					}
					//////////////
					if($new_nom_pay_spp <= $share_elearning) {
					
						$new_share_elearning = $new_nom_pay_spp;
						$new_share_spp		 = 0;
						
					} else {
					
						$new_share_spp = $new_nom_pay_spp - $share_elearning;
						$new_share_elearning   = $share_elearning;
					}
					
					//echo "ks[".$new_share_ks."]-[share_ks=".$share_ks."]<br>";
					//echo "ict[".$new_share_ict."]-[share_ict=".$share_ict."]<br>";
					//echo "elearning[".$new_share_elearning."]-[share_elearning=".$share_elearning."]<br>";
					//echo "spp[".$new_share_spp."]-[share_spp=".$share_spp."]<br><br>";
					
					$src_total_ks 			= $src_total_ks + $new_share_ks; 
					$src_total_ict			= $src_total_ict + $new_share_ict;
					$src_total_elearning	= $src_total_elearning + $new_share_elearning;
					$src_total_spp			= $src_total_spp + $new_share_spp;
					
					
					if($cur_sta_pay_spp == 0)  { $sta_val_paid_spp = "7-". $cur_nom_pay_spp; $have_plus_spp = "have_plus = '1',"; $have_minus_spp = ""; } //have paid before the month of payment come 
					if($cur_sta_pay_spp == 1)  { $sta_val_paid_spp = "5-". $cur_nom_pay_spp;  $have_plus_spp = ""; $have_minus_spp = ""; } //have paid on time 
					if($cur_sta_pay_spp == 2)  { $sta_val_paid_spp = "6-". $cur_nom_pay_spp; $have_plus_spp = ""; $have_minus_spp = "have_minus = '1',"; } //have paid late 
					
					
					//echo $src_cur_pay."<br>";
					//echo $cur_year_pay_spp."<br>";
					//echo $cur_sta_pay_spp."<br>";
					//echo $cur_nom_pay_spp."<br><br>";
					
					$src_update_sta_nom_spp = "update tunggakan set $have_plus_spp $have_minus_spp $cur_month_pay = '$sta_val_paid_spp' where no_sisda = '$no_sisda_enc' and periode = '$cur_year_pay_spp' and jenis_tunggakan = 'spp'";
					$query_update_sta_nom_spp = mysqli_query($mysql_connect, $src_update_sta_nom_spp) or die(mysql_error());
					//$src_update_sta_nom_spp; echo "<br>";
					
					//echo $all_month_checked."</br>";
					//echo $nama_bulan_diinput."</br>";
					
					if($query_update_sta_nom_spp) {
					
						//We need to check whether all errears has been paid by students, if so we have to turn the field tunggakan to 0 (no arrear)
						//All field values has to be equal with 4,5,6 or 7 to make the status 0
						$src_check_status_spp 	= "select july,august,september,october,november,december,january,february,march,april,may,june from tunggakan where no_sisda = '$no_sisda' and periode = '$cur_year_pay_spp' and jenis_tunggakan = 'spp'";
						$query_check_status_spp = mysqli_query($mysql_connect, $src_check_status_spp) or die(mysql_error());	
						$row_check_status_spp	= mysql_fetch_array($query_check_status_spp);					
						
						$val_jul_exp	= explode("-",$row_check_status_spp["july"]); 		$val_jul_sta = $val_jul_exp[0]; //echo "<h1>july".$val_jul_sta."</h1>";
						$val_aug_exp	= explode("-",$row_check_status_spp["august"]); 	$val_aug_sta = $val_aug_exp[0]; //echo "<h1>aug".$val_aug_sta."</h1>";
						$val_sep_exp	= explode("-",$row_check_status_spp["september"]); 	$val_sep_sta = $val_sep_exp[0]; //echo "<h1>sep".$val_sep_sta."</h1>";
						$val_oct_exp	= explode("-",$row_check_status_spp["october"]); 	$val_oct_sta = $val_oct_exp[0]; //echo "<h1>oct".$val_oct_sta."</h1>";
						$val_nov_exp	= explode("-",$row_check_status_spp["november"]); 	$val_nov_sta = $val_nov_exp[0]; //echo "<h1>nov".$val_nov_sta."</h1>";
						$val_dec_exp	= explode("-",$row_check_status_spp["december"]); 	$val_dec_sta = $val_dec_exp[0]; //echo "<h1>dec".$val_dec_sta."</h1>";
						$val_jan_exp	= explode("-",$row_check_status_spp["january"]); 	$val_jan_sta = $val_jan_exp[0]; //echo "<h1>jan".$val_jan_sta."</h1>";
						$val_feb_exp	= explode("-",$row_check_status_spp["february"]); 	$val_feb_sta = $val_feb_exp[0]; //echo "<h1>feb".$val_feb_sta."</h1>";
						$val_mar_exp	= explode("-",$row_check_status_spp["march"]); 		$val_mar_sta = $val_mar_exp[0]; //echo "<h1>mar".$val_mar_sta."</h1>";
						$val_apr_exp	= explode("-",$row_check_status_spp["april"]); 		$val_apr_sta = $val_apr_exp[0]; //echo "<h1>apr".$val_apr_sta."</h1>";
						$val_may_exp	= explode("-",$row_check_status_spp["may"]); 		$val_may_sta = $val_may_exp[0]; //echo "<h1>may".$val_may_sta."</h1>";
						$val_jun_exp	= explode("-",$row_check_status_spp["june"]); 		$val_jun_sta = $val_jun_exp[0]; //echo "<h1>jun".$val_jun_sta."</h1>";
													
						if(
							($val_jul_sta == 4 || $val_jul_sta == 5 || $val_jul_sta == 6 || $val_jul_sta == 7) and
							($val_aug_sta == 4 || $val_aug_sta == 5 || $val_aug_sta == 6 || $val_aug_sta == 7) and
							($val_sep_sta == 4 || $val_sep_sta == 5 || $val_sep_sta == 6 || $val_sep_sta == 7) and
							($val_oct_sta == 4 || $val_oct_sta == 5 || $val_oct_sta == 6 || $val_oct_sta == 7) and
							($val_nov_sta == 4 || $val_nov_sta == 5 || $val_nov_sta == 6 || $val_nov_sta == 7) and
							($val_dec_sta == 4 || $val_dec_sta == 5 || $val_dec_sta == 6 || $val_dec_sta == 7) and
							($val_jan_sta == 4 || $val_jan_sta == 5 || $val_jan_sta == 6 || $val_jan_sta == 7) and
							($val_feb_sta == 4 || $val_feb_sta == 5 || $val_feb_sta == 6 || $val_feb_sta == 7) and
							($val_mar_sta == 4 || $val_mar_sta == 5 || $val_mar_sta == 6 || $val_mar_sta == 7) and
							($val_apr_sta == 4 || $val_apr_sta == 5 || $val_apr_sta == 6 || $val_apr_sta == 7) and
							($val_may_sta == 4 || $val_may_sta == 5 || $val_may_sta == 6 || $val_may_sta == 7) and
							($val_jun_sta == 4 || $val_jun_sta == 5 || $val_jun_sta == 6 || $val_jun_sta == 7) 
						) {
						
							$src_zero_spp_status	= "update tunggakan set status = '0' where no_sisda = '$no_sisda' and periode = '$cur_year_pay_spp' and jenis_tunggakan = 'spp'";
							$query_zero_spp_status	= mysqli_query($mysql_connect, $src_zero_spp_status) or die(mysql_error());
							
							if(!$query_zero_spp_status) { 
							
								$spp_succeed = "gagal";
								$spp_message = "[Untuk dicatat: Kasus transaksi SPP jenis <b>5</b>]<br>Query update status pada table tunggakan gagal dilakukan<br> Hubungi admin Sisda";
				
							}
						
						} else {
						
							$src_zero_spp_status	= "update tunggakan set status = '1' where no_sisda = '$no_sisda' and periode = '$cur_year_pay_spp' and jenis_tunggakan = 'spp'";
							$query_zero_spp_status	= mysqli_query($mysql_connect, $src_zero_spp_status) or die(mysql_error());
							
							if(!$query_zero_spp_status) { 
							
								$spp_succeed = "gagal";
								$spp_message = "[Untuk dicatat: Kasus transaksi SPP jenis <b>4</b>]<br>Query update status pada table tunggakan gagal dilakukan<br> Hubungi admin Sisda";
				
							}
						
						}
					
					
					} else {
					
						$spp_succeed = "gagal";
						$spp_message = "[Untuk dicatat: Kasus transaksi SPP jenis <b>3</b>]<br>Query update pembayaran pada table tunggakan gagal dilakukan<br> Hubungi admin Sisda";
				
					
					}
				
				}
			
				$total_ks 			= $src_total_ks;
				$total_ict 			= $src_total_ict;
				$total_elearning 	= $src_total_elearning;
				$total_spp 			= $src_total_spp;
				
				$spp_no_ks			= $total_ict+$total_elearning+$total_spp;
				
				$src_input_spp	= "insert into transaksi (
									no_sisda, 
									no_trs,
									kasir,
									tanggal_transaksi,
									periode,
									nama_siswa,
									jenjang,
									tingkat,
									kelas, 
									teknik_pembayaran,
									jumlah_bulan_spp,
									bulan_spp,
									spp_spp,
									ict_spp,
									elearning_spp,
									ks_spp,
									jenis_transaksi
									$if_transfer_item
									) values (
									'$no_sisda_enc',
									'$src_no_kwintansi',
									'$who_operator_enc',
									'$tanggal_transaksi_enc',
									'$periode_trans', 
									'$nama_siswa_enc',
									'$jenjang_enc',
									'$tingkat_enc',
									'$kelas_enc',
									'$teknik_pembayaran_enc',
									'$count_bulan_spp',
									'$total_month_spp_transk',
									'$total_spp',
									'$total_ict',
									'$total_elearning',
									'$total_ks',
									'spp' 
									$if_transfer_value
									)";
									
				$query_input_spp = mysqli_query($mysql_connect, $src_input_spp) or die(mysql_error());
				//echo $src_input_spp."<br>";
				
				if($query_input_spp) {
				
					$spp_succeed 	= "okeh";;
					$spp_message	= "";
				
				}
				
			} else {
				
				$spp_succeed = "gagal";
				$spp_message = "[Untuk dicatat: Kasus transaksi SPP jenis <b>1</b>]<br>Bulan pembayaran SPP yang diizinkan secara berurutan adalah $all_month_checked anda melakukan pembayaran untuk $nama_bulan_diinput";
				
			}
		
		} else {  
		
			$src_first_month_error 	= substr($first_month_paid,0,3);
			$first_year_error		= substr($first_month_paid,4,4)." - ".substr($first_month_paid,8,4);
			
			$src_first_month_allowed	= substr($first_month_payment,0,3);
			$first_year_allowed			= substr($first_month_payment,4,4)." - ".substr($first_month_payment,8,4); 
		
			if($src_first_month_allowed == "jul") { $first_month_allowed = "Juli ".$first_year_allowed; }
			if($src_first_month_allowed == "aug") { $first_month_allowed = "Agustus ".$first_year_allowed; }
			if($src_first_month_allowed == "sep") { $first_month_allowed = "September ".$first_year_allowed; }
			if($src_first_month_allowed == "oct") { $first_month_allowed = "Oktober ".$first_year_allowed; }
			if($src_first_month_allowed == "nov") { $first_month_allowed = "November ".$first_year_allowed; }
			if($src_first_month_allowed == "dec") { $first_month_allowed = "Desember ".$first_year_allowed; }
			if($src_first_month_allowed == "jan") { $first_month_allowed = "Januari ".$first_year_allowed; }
			if($src_first_month_allowed == "feb") { $first_month_allowed = "Februari ".$first_year_allowed; }
			if($src_first_month_allowed == "mar") { $first_month_allowed = "Maret ".$first_year_allowed; }
			if($src_first_month_allowed == "apr") { $first_month_allowed = "April ".$first_year_allowed; }
			if($src_first_month_allowed == "may") { $first_month_allowed = "Mei ".$first_year_allowed; }
			if($src_first_month_allowed == "jun") { $first_month_allowed = "Juni ".$first_year_allowed; }
			
			if($src_first_month_error == "jul") { $first_month_error = "Juli ".$first_year_error; }
			if($src_first_month_error == "aug") { $first_month_error = "Agustus ".$first_year_error; }
			if($src_first_month_error == "sep") { $first_month_error = "September ".$first_year_error; }
			if($src_first_month_error == "oct") { $first_month_error = "Oktober ".$first_year_error; }
			if($src_first_month_error == "nov") { $first_month_error = "November ".$first_year_error; }
			if($src_first_month_error == "dec") { $first_month_error = "Desember ".$first_year_error; }
			if($src_first_month_error == "jan") { $first_month_error = "Januari ".$first_year_error; }
			if($src_first_month_error == "feb") { $first_month_error = "Februari ".$first_year_error; }
			if($src_first_month_error == "mar") { $first_month_error = "Maret ".$first_year_error; }
			if($src_first_month_error == "apr") { $first_month_error = "April ".$first_year_error; }
			if($src_first_month_error == "may") { $first_month_error = "Mei ".$first_year_error; }
			if($src_first_month_error == "jun") { $first_month_error = "Juni ".$first_year_error; }
		
			$spp_succeed = "gagal";
			$spp_message = "[Kasus transaksi SPP jenis <b>2</b>]<br>Bulan pembayaran SPP yang harus pertama kali dibayar adalah <b>$first_month_allowed</b> anda melakukan pembayaran untuk <b>$first_month_error </b>";
			//echo $spp_error_message;
		
		}
		
			
	} //owned by: if(!empty($_POST["subtotal_spp"]) && $_POST["subtotal_spp"] != 0) {
	
	//echo $spp_succeed;
	//echo $spp_message;
	//---------------------------//
	//-------- END OF SPP -------//
	//---------------------------//	
	
	
	///////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////
	////////////////////////////--CATERING--///////////////////////////
	///////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////
	
	//Related files to the cases below (tunggakan in catering, ect) ++++++++++++++++++++++++++
	//////////////////////////////////////////////////////////////////////////////
	////////Please check -> include/define_month_spp.php executed in proc_login.php///////
	////////Please check -> include/check_spp_arrear.php executed in proc_login.php///////
	////////Please check -> page/proc_reg_adm_siswa.php///////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////
	
	if(!empty($_POST["subtotal_catering"]) && $_POST["subtotal_catering"] != 0) {
		
		$bulan_catering						= empty($_POST["bulan_catering"]) ? 0 : $_POST["bulan_catering"];	
		//$bulan_spp_enc					= mysql_real_escape_string($bulan_spp);
		$bulan_catering_enc					= $bulan_catering;
		
		$nom_catering						= $_POST["catering"];
		$nom_catering_enc					= mysql_real_escape_string($nom_catering);
						
		$subtotal_catering					= $_POST["subtotal_catering"];
		$subtotal_catering_enc				= mysql_real_escape_string($subtotal_catering);
	
		/////--------------------------------------------------------//////
		//Yo-Yo-Yo..... look at what happen here...
		//we are going to work in many conditions with catering, it's why you will find so many proccess here.
		//i hope it's not confusing you.....qqackkk-qackkkk-qackkkk, kamal juragan kambing garut KW5
		//Okay......			
		
		//we are working in catering
		/////////////////////////////////////
		//bon ambil dulu data dari database si fulan ini, cocokin yang udah bayarnya yang mana?
		///ngertikan??????????????????????  ---> GAK NGERTI>>>hehehe (Gila Xampeyan)
		//jangan khawatir.... itu $year_spp_enc gak mungkin dobel... soalnya dah di counter, admin gak bakal input 2 tahun pelajaran yang berbeda di formnya... 
		$src_cur_month_val_catering		= "select * from tunggakan where no_sisda = '$no_sisda_enc' and jenis_tunggakan = 'catering' and (status = '1' || status = '2') order by id";		
		$query_cur_month_val_catering	= mysqli_query($mysql_connect, $src_cur_month_val_catering) or die(mysql_error());
		//$num					= mysql_num_rows($query_cur_month_val_catering);
		
		
		///XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX///
		///XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX///
		///XXXXXXXXXXXXXXXXXXXXXXXX    CARA INI SALAH   XXXXXXXXXXXXXXXXXXXXXXXX///
		///XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX///
		///XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX///
		$src_get_provider_catering		= "select catering from siswa_finance where no_sisda = '$no_sisda_enc'";
		$query_get_provider_catering	= mysqli_query($mysql_connect, $src_get_provider_catering) or die(mysql_error());
		$get_provider_catering			= mysql_fetch_array($query_get_provider_catering);
		$provider_catering				= $get_provider_catering["catering"];
		///XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX///
		
		
		$ifirst_catering = 0;
		$all_month_checked_catering	= "";
		
		while($row_available_payment_catering = mysql_fetch_array($query_cur_month_val_catering)) {
			
			$src_year_db_catering	= $row_available_payment_catering["periode"]; 
			$year_catering_auto		= substr($src_year_db_catering,0,4).substr($src_year_db_catering,7,4);
			
			$arrear_catering_july = substr($row_available_payment_catering["jul_cataj"],0,1);
			
			if($arrear_catering_july == 0 || $arrear_catering_july == 1 || $arrear_catering_july == 2 || $arrear_catering_july == 3) {
				
				$sta_catering_auto_jul = substr($row_available_payment_catering["jul_cataj"],0,1);
				$nom_catering_auto_jul = substr($row_available_payment_catering["jul_cataj"],2);
				$ifirst_catering++;
				
				if($ifirst_catering == 1) { $first_month_catering_payment = "jul-".$year_catering_auto; }
				$all_month_checked_catering = $all_month_checked_catering."jul-".$year_catering_auto."-".$sta_catering_auto_jul."-".$nom_catering_auto_jul.",";
				
			}
			
			$arrear_catering_august = substr($row_available_payment_catering["aug_cataj"],0,1);
			if($arrear_catering_august == 0 || $arrear_catering_august == 1 || $arrear_catering_august == 2 || $arrear_catering_august == 3) { 
				
				$sta_catering_auto_aug = substr($row_available_payment_catering["aug_cataj"],0,1);
				$nom_catering_auto_aug = substr($row_available_payment_catering["aug_cataj"],2);
				$ifirst_catering++;
				
				if($ifirst_catering == 1) { $first_month_catering_payment = "aug-".$year_catering_auto; }
				$all_month_checked_catering = $all_month_checked_catering."aug-".$year_catering_auto."-".$sta_catering_auto_aug."-".$nom_catering_auto_aug.",";

			}
			
			$arrear_catering_september = substr($row_available_payment_catering["sep_cataj"],0,1);
			if($arrear_catering_september == 0 || $arrear_catering_september == 1 || $arrear_catering_september == 2 || $arrear_catering_september == 3) {
				
				$sta_catering_auto_sep = substr($row_available_payment_catering["sep_cataj"],0,1);
				$nom_catering_auto_sep = substr($row_available_payment_catering["sep_cataj"],2);
				$ifirst_catering++;
				
				if($ifirst_catering == 1) { $first_month_catering_payment = "sep-".$year_catering_auto; }
				$all_month_checked_catering = $all_month_checked_catering."sep-".$year_catering_auto."-".$sta_catering_auto_sep."-".$nom_catering_auto_sep.",";
			
			}
			
			$arrear_catering_october = substr($row_available_payment_catering["oct_cataj"],0,1);
			if($arrear_catering_october == 0 || $arrear_catering_october == 1 || $arrear_catering_october == 2 || $arrear_catering_october == 3) { 
				
				$sta_catering_auto_oct = substr($row_available_payment_catering["oct_cataj"],0,1);
				$nom_catering_auto_oct = substr($row_available_payment_catering["oct_cataj"],2);
				$ifirst_catering++;
				
				if($ifirst_catering == 1) { $first_month_catering_payment = "oct-".$year_catering_auto; }
				$all_month_checked_catering = $all_month_checked_catering."oct-".$year_catering_auto."-".$sta_catering_auto_oct."-".$nom_catering_auto_oct.",";
			
			}
			
			$arrear_catering_november = substr($row_available_payment_catering["nov_cataj"],0,1);
			if($arrear_catering_november == 0 || $arrear_catering_november == 1 || $arrear_catering_november == 2 || $arrear_catering_november == 3) { 
				
				$sta_catering_auto_nov = substr($row_available_payment_catering["nov_cataj"],0,1);
				$nom_catering_auto_nov = substr($row_available_payment_catering["nov_cataj"],2);
				$ifirst_catering++;
				
				if($ifirst_catering == 1) { $first_month_catering_payment = "nov-".$year_catering_auto; }
				$all_month_checked_catering = $all_month_checked_catering."nov-".$year_catering_auto."-".$sta_catering_auto_nov."-".$nom_catering_auto_nov.",";

			}
			
			$arrear_catering_december = substr($row_available_payment_catering["dec_cataj"],0,1);
			if($arrear_catering_december == 0 || $arrear_catering_december == 1 || $arrear_catering_december == 2 || $arrear_catering_december == 3) { 
				
				$sta_catering_auto_dec = substr($row_available_payment_catering["dec_cataj"],0,1);
				$nom_catering_auto_dec = substr($row_available_payment_catering["dec_cataj"],2);
				$ifirst_catering++;
				
				if($ifirst_catering == 1) { $first_month_catering_payment = "dec-".$year_catering_auto; }
				$all_month_checked_catering = $all_month_checked_catering."dec-".$year_catering_auto."-".$sta_catering_auto_dec."-".$nom_catering_auto_dec.",";

			}
			
			$arrear_catering_january = substr($row_available_payment_catering["jan_cataj"],0,1);
			if($arrear_catering_january == 0 || $arrear_catering_january == 1 || $arrear_catering_january == 2 || $arrear_catering_january == 3) { 
				
				$sta_catering_auto_jan = substr($row_available_payment_catering["jan_cataj"],0,1);
				$nom_catering_auto_jan = substr($row_available_payment_catering["jan_cataj"],2);
				$ifirst_catering++;
				
				if($ifirst_catering == 1) { $first_month_catering_payment = "jan-".$year_catering_auto; }
				$all_month_checked_catering = $all_month_checked_catering."jan-".$year_catering_auto."-".$sta_catering_auto_jan."-".$nom_catering_auto_jan.",";

			}
			
			$arrear_catering_february = substr($row_available_payment_catering["feb_cataj"],0,1);
			if($arrear_catering_february == 0 || $arrear_catering_february == 1 || $arrear_catering_february == 2 || $arrear_catering_february == 3) { 
				
				$sta_catering_auto_feb = substr($row_available_payment_catering["feb_cataj"],0,1);
				$nom_catering_auto_feb = substr($row_available_payment_catering["feb_cataj"],2);
				$ifirst_catering++;
				
				if($ifirst_catering == 1) { $first_month_catering_payment = "feb-".$year_catering_auto; }
				$all_month_checked_catering = $all_month_checked_catering."feb-".$year_catering_auto."-".$sta_catering_auto_feb."-".$nom_catering_auto_feb.",";

			}
			
			$arrear_catering_march = substr($row_available_payment_catering["mar_cataj"],0,1);
			if($arrear_catering_march == 0 || $arrear_catering_march == 1 || $arrear_catering_march == 2 || $arrear_catering_march == 3) { 
				
				$sta_catering_auto_mar = substr($row_available_payment_catering["mar_cataj"],0,1);
				$nom_catering_auto_mar = substr($row_available_payment_catering["mar_cataj"],2);
				$ifirst_catering++;
				
				if($ifirst_catering == 1) { $first_month_catering_payment = "mar-".$year_catering_auto; }
				$all_month_checked_catering = $all_month_checked_catering."mar-".$year_catering_auto."-".$sta_catering_auto_mar."-".$nom_catering_auto_mar.",";

			} 
			
			$arrear_catering_april = substr($row_available_payment_catering["apr_cataj"],0,1);
			if($arrear_catering_april == 0 || $arrear_catering_april == 1 || $arrear_catering_april == 2 || $arrear_catering_april == 3) { 
				
				$sta_catering_auto_apr = substr($row_available_payment_catering["apr_cataj"],0,1);
				$nom_catering_auto_apr = substr($row_available_payment_catering["apr_cataj"],2);
				$ifirst_catering++;
				
				if($ifirst_catering == 1) { $first_month_catering_payment = "apr-".$year_catering_auto; }
				$all_month_checked_catering = $all_month_checked_catering."apr-".$year_catering_auto."-".$sta_catering_auto_apr."-".$nom_catering_auto_apr.",";

			}
			
			$arrear_catering_may = substr($row_available_payment_catering["may_cataj"],0,1);
			if($arrear_catering_may == 0 || $arrear_catering_may == 1 || $arrear_catering_may == 2 || $arrear_catering_may == 3) { 
				
				$sta_catering_auto_may = substr($row_available_payment_catering["may_cataj"],0,1);
				$nom_catering_auto_may = substr($row_available_payment_catering["may_cataj"],2);
				$ifirst_catering++;
				
				if($ifirst_catering == 1) { $first_month_catering_payment = "may-".$year_catering_auto; }
				$all_month_checked_catering = $all_month_checked_catering."may-".$year_catering_auto."-".$sta_catering_auto_may."-".$nom_catering_auto_may.",";

			}
			
			$arrear_catering_june = substr($row_available_payment_catering["jun_cataj"],0,1);
			if($arrear_catering_june == 0 || $arrear_catering_june == 1 || $arrear_catering_june == 2 || $arrear_catering_june == 3) { 
			
				$sta_catering_auto_jun = substr($row_available_payment_catering["jun_cataj"],0,1);
				$nom_catering_auto_jun = substr($row_available_payment_catering["jun_cataj"],2);
				$ifirst_catering++;
				
				if($ifirst_catering == 1) { $first_month_catering_payment = "jun-".$year_catering_auto; }
				$all_month_checked_catering = $all_month_checked_catering."jun-".$year_catering_auto."-".$sta_catering_auto_jun."-".$nom_catering_auto_jun.",";

			}
		
		}
		
		$count_bulan_catering = count($bulan_catering); 
		
		$first_month_catering_paid = $bulan_catering[0]; 
		$first_month_catering_paid_checked = substr($first_month_catering_paid,0,12); 
		
		//echo $first_month_catering_payment."<br>";
		//echo $all_month_checked_catering."<br>";
		
		$src_nama_bulan_catering_diinput	= $bulan_catering;
		$nama_bulan_catering_diinput		= implode($src_nama_bulan_catering_diinput,',');
		
		//echo $nama_bulan_catering_diinput;
		
		//echo "[".$all_month_checked_catering."]<br>";
		//echo "[".$nama_bulan_catering_diinput."]<br>";
		
		if($first_month_catering_payment == $first_month_catering_paid_checked) {
		
			if(strstr($all_month_checked_catering,$nama_bulan_catering_diinput) != false) {
			
				$total_month_catering_transk = "";
				
				for($i=0; $i < $count_bulan_catering; $i++) {
				
					$src_cur_pay_catering = $bulan_catering[$i];
				
					if(substr($src_cur_pay_catering,0,3) == "jul") { $cur_month_pay_catering = "jul_cataj"; $month_catering_transk = "July, "; }
					if(substr($src_cur_pay_catering,0,3) == "aug") { $cur_month_pay_catering = "aug_cataj"; $month_catering_transk = "August, "; }
					if(substr($src_cur_pay_catering,0,3) == "sep") { $cur_month_pay_catering = "sep_cataj"; $month_catering_transk = "September, "; }
					if(substr($src_cur_pay_catering,0,3) == "oct") { $cur_month_pay_catering = "oct_cataj"; $month_catering_transk = "October, "; }
					if(substr($src_cur_pay_catering,0,3) == "nov") { $cur_month_pay_catering = "nov_cataj"; $month_catering_transk = "November, "; }
					if(substr($src_cur_pay_catering,0,3) == "dec") { $cur_month_pay_catering = "dec_cataj"; $month_catering_transk = "December, "; }
					if(substr($src_cur_pay_catering,0,3) == "jan") { $cur_month_pay_catering = "jan_cataj"; $month_catering_transk = "January, "; }
					if(substr($src_cur_pay_catering,0,3) == "feb") { $cur_month_pay_catering = "feb_cataj"; $month_catering_transk = "February, "; }
					if(substr($src_cur_pay_catering,0,3) == "mar") { $cur_month_pay_catering = "mar_cataj"; $month_catering_transk = "March, "; }
					if(substr($src_cur_pay_catering,0,3) == "apr") { $cur_month_pay_catering = "apr_cataj"; $month_catering_transk = "April, "; }
					if(substr($src_cur_pay_catering,0,3) == "may") { $cur_month_pay_catering = "may_cataj"; $month_catering_transk = "May, "; }
					if(substr($src_cur_pay_catering,0,3) == "jun") { $cur_month_pay_catering = "jun_cataj"; $month_catering_transk = "June, "; }
					
					$cur_year_pay_catering 	= substr($src_cur_pay_catering,4,4)." - ".substr($src_cur_pay_catering,8,4);
					$cur_sta_pay_catering	= substr($src_cur_pay_catering,13,1);
					$cur_nom_pay_catering	= substr($src_cur_pay_catering,15);
					
					if($cur_sta_pay_catering == 0)  { $sta_val_paid_catering = "7-". $cur_nom_pay_catering; $have_plus_catering = "have_plus = '1',"; $have_minus_catering = ""; } //have paid before the month of payment come 
					if($cur_sta_pay_catering == 1)  { $sta_val_paid_catering = "5-". $cur_nom_pay_catering; $have_plus_catering = ""; $have_minus_catering = ""; } //have paid on time 
					if($cur_sta_pay_catering == 2)  { $sta_val_paid_catering = "6-". $cur_nom_pay_catering; $have_plus_catering = ""; $have_minus_catering = "have_minus = '1',"; } //have paid late 
					
					$total_month_catering_transk = $total_month_catering_transk.$month_catering_transk;
					
					//echo $src_cur_pay_catering."<br>";
					//echo $cur_year_pay_catering."<br>";
					//echo $cur_sta_pay_catering."<br>";
					//echo $cur_nom_pay_catering."<br><br>";
					
					$src_update_sta_nom_catering = "update tunggakan set $have_plus_catering $have_minus_catering $cur_month_pay_catering = '$sta_val_paid_catering' where no_sisda = '$no_sisda_enc' and periode = '$cur_year_pay_catering' and jenis_tunggakan = 'catering'";
					$query_update_sta_nom_catering = mysqli_query($mysql_connect, $src_update_sta_nom_catering) or die(mysql_error());
					//$src_update_sta_nom_catering; echo "<br>";
					
					//echo $all_month_checked_catering."</br>";
					//echo $nama_bulan_catering_diinput."</br>";
					
					if($query_update_sta_nom_catering) {
					
						//We need to check whether all errears has been paid by students, if so we have to turn the field tunggakan to 0 (no arrear)
						//All field values has to be equal with 4,5,6 or 7 to make the status 0
						$src_check_status_catering 	= "select jul_cataj,aug_cataj,sep_cataj,oct_cataj,nov_cataj,dec_cataj,jan_cataj,feb_cataj,mar_cataj,apr_cataj,may_cataj,jun_cataj from tunggakan where no_sisda = '$no_sisda' and periode = '$cur_year_pay_catering' and jenis_tunggakan = 'catering'";
						$query_check_status_catering = mysqli_query($mysql_connect, $src_check_status_catering) or die(mysql_error());	
						$row_check_status_catering	= mysql_fetch_array($query_check_status_catering);					
						
						$val_jul_exp_catering = explode("-",$row_check_status_catering["jul_cataj"]); 	$val_jul_sta_catering = $val_jul_exp_catering[0]; //echo "<h1>july".$val_jul_sta."</h1>";
						$val_aug_exp_catering = explode("-",$row_check_status_catering["aug_cataj"]); 	$val_aug_sta_catering = $val_aug_exp_catering[0]; //echo "<h1>aug".$val_aug_sta."</h1>";
						$val_sep_exp_catering = explode("-",$row_check_status_catering["sep_cataj"]); 	$val_sep_sta_catering = $val_sep_exp_catering[0]; //echo "<h1>sep".$val_sep_sta."</h1>";
						$val_oct_exp_catering = explode("-",$row_check_status_catering["oct_cataj"]); 	$val_oct_sta_catering = $val_oct_exp_catering[0]; //echo "<h1>oct".$val_oct_sta."</h1>";
						$val_nov_exp_catering = explode("-",$row_check_status_catering["nov_cataj"]); 	$val_nov_sta_catering = $val_nov_exp_catering[0]; //echo "<h1>nov".$val_nov_sta."</h1>";
						$val_dec_exp_catering = explode("-",$row_check_status_catering["dec_cataj"]); 	$val_dec_sta_catering = $val_dec_exp_catering[0]; //echo "<h1>dec".$val_dec_sta."</h1>";
						$val_jan_exp_catering = explode("-",$row_check_status_catering["jan_cataj"]); 	$val_jan_sta_catering = $val_jan_exp_catering[0]; //echo "<h1>jan".$val_jan_sta."</h1>";
						$val_feb_exp_catering = explode("-",$row_check_status_catering["feb_cataj"]); 	$val_feb_sta_catering = $val_feb_exp_catering[0]; //echo "<h1>feb".$val_feb_sta."</h1>";
						$val_mar_exp_catering = explode("-",$row_check_status_catering["mar_cataj"]); 	$val_mar_sta_catering = $val_mar_exp_catering[0]; //echo "<h1>mar".$val_mar_sta."</h1>";
						$val_apr_exp_catering = explode("-",$row_check_status_catering["apr_cataj"]); 	$val_apr_sta_catering = $val_apr_exp_catering[0]; //echo "<h1>apr".$val_apr_sta."</h1>";
						$val_may_exp_catering = explode("-",$row_check_status_catering["may_cataj"]); 	$val_may_sta_catering = $val_may_exp_catering[0]; //echo "<h1>may".$val_may_sta."</h1>";
						$val_jun_exp_catering = explode("-",$row_check_status_catering["jun_cataj"]); 	$val_jun_sta_catering = $val_jun_exp_catering[0]; //echo "<h1>jun".$val_jun_sta."</h1>";
													
						/*if(
							($val_jul_sta_catering == 0 || $val_jul_sta_catering == 4 || $val_jul_sta_catering == 5 || $val_jul_sta_catering == 6 || $val_jul_sta_catering == 7) and
							($val_aug_sta_catering == 0 || $val_aug_sta_catering == 4 || $val_aug_sta_catering == 5 || $val_aug_sta_catering == 6 || $val_aug_sta_catering == 7) and
							($val_sep_sta_catering == 0 || $val_sep_sta_catering == 4 || $val_sep_sta_catering == 5 || $val_sep_sta_catering == 6 || $val_sep_sta_catering == 7) and
							($val_oct_sta_catering == 0 || $val_oct_sta_catering == 4 || $val_oct_sta_catering == 5 || $val_oct_sta_catering == 6 || $val_oct_sta_catering == 7) and
							($val_nov_sta_catering == 0 || $val_nov_sta_catering == 4 || $val_nov_sta_catering == 5 || $val_nov_sta_catering == 6 || $val_nov_sta_catering == 7) and
							($val_dec_sta_catering == 0 || $val_dec_sta_catering == 4 || $val_dec_sta_catering == 5 || $val_dec_sta_catering == 6 || $val_dec_sta_catering == 7) and
							($val_jan_sta_catering == 0 || $val_jan_sta_catering == 4 || $val_jan_sta_catering == 5 || $val_jan_sta_catering == 6 || $val_jan_sta_catering == 7) and
							($val_feb_sta_catering == 0 || $val_feb_sta_catering == 4 || $val_feb_sta_catering == 5 || $val_feb_sta_catering == 6 || $val_feb_sta_catering == 7) and
							($val_mar_sta_catering == 0 || $val_mar_sta_catering == 4 || $val_mar_sta_catering == 5 || $val_mar_sta_catering == 6 || $val_mar_sta_catering == 7) and
							($val_apr_sta_catering == 0 || $val_apr_sta_catering == 4 || $val_apr_sta_catering == 5 || $val_apr_sta_catering == 6 || $val_apr_sta_catering == 7) and
							($val_may_sta_catering == 0 || $val_may_sta_catering == 4 || $val_may_sta_catering == 5 || $val_may_sta_catering == 6 || $val_may_sta_catering == 7) and
							($val_jun_sta_catering == 0 || $val_jun_sta_catering == 4 || $val_jun_sta_catering == 5 || $val_jun_sta_catering == 6 || $val_jun_sta_catering == 7) 
						) {
						
							$src_zero_catering_status	= "update tunggakan set status = '0' where no_sisda = '$no_sisda' and periode = '$cur_year_pay_catering' and jenis_tunggakan = 'catering'";
							$query_zero_catering_status	= mysqli_query($mysql_connect, $src_zero_catering_status) or die(mysql_error());
							
							if(!$query_zero_catering_status) { 
							
								$catering_error = "okeh";;
								$catering_error_message = "[Kasus transaksi Catering jenis <b>4</b>]<br>Query update status pada table tunggakan gagal dilakukan<br> Hubungi admin Sisda";
				
							}
						
						}*/
					
						if(
							($val_jul_sta_catering != 1 and $val_jul_sta_catering != 2) and
							($val_aug_sta_catering != 1 and $val_aug_sta_catering != 2) and
							($val_sep_sta_catering != 1 and $val_sep_sta_catering != 2) and
							($val_oct_sta_catering != 1 and $val_oct_sta_catering != 2) and
							($val_nov_sta_catering != 1 and $val_nov_sta_catering != 2) and
							($val_dec_sta_catering != 1 and $val_dec_sta_catering != 2) and
							($val_jan_sta_catering != 1 and $val_jan_sta_catering != 2) and
							($val_feb_sta_catering != 1 and $val_feb_sta_catering != 2) and
							($val_mar_sta_catering != 1 and $val_mar_sta_catering != 2) and
							($val_apr_sta_catering != 1 and $val_apr_sta_catering != 2) and
							($val_may_sta_catering != 1 and $val_may_sta_catering != 2) and
							($val_jun_sta_catering != 1 and $val_jun_sta_catering != 2) 
						) {
						
							$src_zero_catering_status	= "update tunggakan set status = '0' where no_sisda = '$no_sisda' and periode = '$cur_year_pay_catering' and jenis_tunggakan = 'catering'";
							$query_zero_catering_status	= mysqli_query($mysql_connect, $src_zero_catering_status) or die(mysql_error());
						
						} else {
						
							$src_zero_catering_status	= "update tunggakan set status = '1' where no_sisda = '$no_sisda' and periode = '$cur_year_pay_catering' and jenis_tunggakan = 'catering'";
							$query_zero_catering_status	= mysqli_query($mysql_connect, $src_zero_catering_status) or die(mysql_error());
						
						}
					
					}
				
				}
				
				$src_input_catering	= "insert into transaksi (
									no_sisda,
									no_trs,
									kasir,
									tanggal_transaksi,
									periode, 
									nama_siswa,
									jenjang,
									tingkat,
									kelas, 
									teknik_pembayaran,
									jumlah_bulan_catering,
									bulan_catering,
									jenis_transaksi,
									catering,
									penyedia_catering
									$if_transfer_item
									) values (
									'$no_sisda_enc',
									'$src_no_kwintansi',
									'$who_operator_enc', 
									'$tanggal_transaksi_enc',
									'$periode_trans',
									'$nama_siswa_enc',
									'$jenjang_enc',
									'$tingkat_enc',
									'$kelas_enc',
									'$teknik_pembayaran_enc',
									'$count_bulan_catering',
									'$total_month_catering_transk',
									'catering',
									'$subtotal_catering_enc',
									'$provider_catering' 
									$if_transfer_value
									)";
									
				$query_input_catering = mysqli_query($mysql_connect, $src_input_catering) or die(mysql_error());
				//echo $src_input_catering."<br>";
				
				if($query_input_catering) {
				
					$catering_succeed = "okeh";
					$catering_message = "";
				
				}
				
			} else {
				
				$catering_succeed = "gagal";
				$catering_message = "[Kasus transaksi catering jenis <b>1</b>]<br>Bulan pembayaran Catering yang diizinkan secara berurutan adalah $all_month_checked_catering anda melakukan pembayaran untuk $nama_bulan_catering_diinput";
				
			}
		
		} else {  
		
			$src_first_month_catering_error = substr($first_month_catering_paid,0,3);
			$first_year_catering_error		= substr($first_month_catering_paid,4,4)." - ".substr($first_month_catering_paid,8,4);
			
			$src_first_month_catering_allowed	= substr($first_month_catering_payment,0,3);
			$first_year_catering_allowed		= substr($first_month_catering_payment,4,4)." - ".substr($first_month_catering_payment,8,4); 
		
			if($src_first_month_catering_allowed == "jul") { $first_month_catering_allowed = "Juli ".$first_year_catering_allowed; }
			if($src_first_month_catering_allowed == "aug") { $first_month_catering_allowed = "Agustus ".$first_year_catering_allowed; }
			if($src_first_month_catering_allowed == "sep") { $first_month_catering_allowed = "September ".$first_year_catering_allowed; }
			if($src_first_month_catering_allowed == "oct") { $first_month_catering_allowed = "Oktober ".$first_year_catering_allowed; }
			if($src_first_month_catering_allowed == "nov") { $first_month_catering_allowed = "November ".$first_year_catering_allowed; }
			if($src_first_month_catering_allowed == "dec") { $first_month_catering_allowed = "Desember ".$first_year_catering_allowed; }
			if($src_first_month_catering_allowed == "jan") { $first_month_catering_allowed = "Januari ".$first_year_catering_allowed; }
			if($src_first_month_catering_allowed == "feb") { $first_month_catering_allowed = "Februari ".$first_year_catering_allowed; }
			if($src_first_month_catering_allowed == "mar") { $first_month_catering_allowed = "Maret ".$first_year_catering_allowed; }
			if($src_first_month_catering_allowed == "apr") { $first_month_catering_allowed = "April ".$first_year_catering_allowed; }
			if($src_first_month_catering_allowed == "may") { $first_month_catering_allowed = "Mei ".$first_year_catering_allowed; }
			if($src_first_month_catering_allowed == "jun") { $first_month_catering_allowed = "Juni ".$first_year_catering_allowed; }
			
			if($src_first_month_catering_error == "jul") { $first_month_catering_error = "Juli ".$first_year_catering_error; }
			if($src_first_month_catering_error == "aug") { $first_month_catering_error = "Agustus ".$first_year_catering_error; }
			if($src_first_month_catering_error == "sep") { $first_month_catering_error = "September ".$first_year_catering_error; }
			if($src_first_month_catering_error == "oct") { $first_month_catering_error = "Oktober ".$first_year_catering_error; }
			if($src_first_month_catering_error == "nov") { $first_month_catering_error = "November ".$first_year_catering_error; }
			if($src_first_month_catering_error == "dec") { $first_month_catering_error = "Desember ".$first_year_catering_error; }
			if($src_first_month_catering_error == "jan") { $first_month_catering_error = "Januari ".$first_year_catering_error; }
			if($src_first_month_catering_error == "feb") { $first_month_catering_error = "Februari ".$first_year_catering_error; }
			if($src_first_month_catering_error == "mar") { $first_month_catering_error = "Maret ".$first_year_catering_error; }
			if($src_first_month_catering_error == "apr") { $first_month_catering_error = "April ".$first_year_catering_error; }
			if($src_first_month_catering_error == "may") { $first_month_catering_error = "Mei ".$first_year_catering_error; }
			if($src_first_month_catering_error == "jun") { $first_month_catering_error = "Juni ".$first_year_catering_error; }
		
			$catering_succeed = "gagal";
			$catering_message = "[Kasus transaksi Catering jenis <b>2</b>]<br>Bulan pembayaran Catering yang harus pertama kali dibayar adalah <b>$first_month_catering_allowed</b> anda melakukan pembayaran untuk <b>$first_month_catering_error </b>";
			//echo $catering_error_message;
		
		}
		
			
	} //owned by: if(!empty($_POST["subtotal_catering"]) && $_POST["subtotal_catering"] != 0) {
	
	
	//--------------------------------//
	//-------- END OF CATERING -------//
	//--------------------------------//	
	
	
	///////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////
	//////////////////////////--ANTAR JEMPUT--/////////////////////////
	///////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////
	
	//Related files to the cases below (tunggakan in antar jemput, ect) ++++++++++++++++++++++++++
	//////////////////////////////////////////////////////////////////////////////
	////////Please check -> include/define_month_spp.php executed in proc_login.php///////
	////////Please check -> include/check_spp_arrear.php executed in proc_login.php///////
	////////Please check -> page/proc_reg_adm_siswa.php///////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////
	
	if(!empty($_POST["subtotal_antar_jemput"]) && $_POST["subtotal_antar_jemput"] != 0) {
		
		$bulan_antar_jemput			= empty($_POST["bulan_antar_jemput"]) ? 0 : $_POST["bulan_antar_jemput"];	
		
		$bulan_antar_jemput_enc		= $bulan_antar_jemput;
		
		$nom_antar_jemput			= $_POST["antar_jemput"];
		$nom_antar_jemput_enc		= mysql_real_escape_string($nom_antar_jemput);
						
		$subtotal_antar_jemput		= $_POST["subtotal_antar_jemput"];
		$subtotal_antar_jemput_enc	= mysql_real_escape_string($subtotal_antar_jemput);
	
		/////--------------------------------------------------------//////
		//Yo-Yo-Yo..... look at what happen here...
		//we are going to work in many conditions with antar_jemput, it's why you will find so many proccess here.
		//i hope it's not confusing you.....qqackkk-qackkkk-qackkkk, kamal juragan kambing garut KW5
		//Okay......			
		
		//we are working in Antar Jemput
		/////////////////////////////////////
		//bon ambil dulu data dari database si fulan ini, cocokin yang udah bayarnya yang mana?
		///ngertikan??????????????????????  ---> GAK NGERTI>>>hehehe (Gila Xampeyan)
		//jangan khawatir.... itu $year_spp_enc gak mungkin dobel... soalnya dah di counter, admin gak bakal input 2 tahun pelajaran yang berbeda di formnya... 
		$src_cur_month_val_antar_jemput		= "select * from tunggakan where no_sisda = '$no_sisda_enc' and jenis_tunggakan = 'antar_jemput' and (status = '1' || status = '2') order by id";
		$query_cur_month_val_antar_jemput	= mysqli_query($mysql_connect, $src_cur_month_val_antar_jemput) or die(mysql_error());
		//$num					= mysql_num_rows($query_cur_month_val_antar_jemput);
		
		
		///XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX///
		///XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX///
		///XXXXXXXXXXXXXXXXXXXXXXXX    CARA INI SALAH   XXXXXXXXXXXXXXXXXXXXXXXX///
		///XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX///
		///XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX///
		$src_get_provider_antar_jemput		= "select antar_jemput from siswa_finance where no_sisda = '$no_sisda_enc'";
		$query_get_provider_antar_jemput	= mysqli_query($mysql_connect, $src_get_provider_antar_jemput) or die(mysql_error());
		$get_provider_antar_jemput			= mysql_fetch_array($query_get_provider_antar_jemput);
		$provider_antar_jemput				= $get_provider_antar_jemput["antar_jemput"];
		///XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX///
		
		
		$ifirst_antar_jemput = 0;
		$all_month_checked_antar_jemput	= "";
		
		while($row_available_payment_antar_jemput = mysql_fetch_array($query_cur_month_val_antar_jemput)) {
			
			$src_year_db_antar_jemput	= $row_available_payment_antar_jemput["periode"]; 
			$year_antar_jemput_auto		= substr($src_year_db_antar_jemput,0,4).substr($src_year_db_antar_jemput,7,4);
			
			$arrear_antar_jemput_july = substr($row_available_payment_antar_jemput["jul_cataj"],0,1);
			
			if($arrear_antar_jemput_july == 0 || $arrear_antar_jemput_july == 1 || $arrear_antar_jemput_july == 2 || $arrear_antar_jemput_july == 3) {
				
				$sta_antar_jemput_auto_jul = substr($row_available_payment_antar_jemput["jul_cataj"],0,1);
				$nom_antar_jemput_auto_jul = substr($row_available_payment_antar_jemput["jul_cataj"],2);
				$ifirst_antar_jemput++;
				
				if($ifirst_antar_jemput == 1) { $first_month_antar_jemput_payment = "jul-".$year_antar_jemput_auto; }
				$all_month_checked_antar_jemput = $all_month_checked_antar_jemput."jul-".$year_antar_jemput_auto."-".$sta_antar_jemput_auto_jul."-".$nom_antar_jemput_auto_jul.",";
				
			}
			
			$arrear_antar_jemput_august = substr($row_available_payment_antar_jemput["aug_cataj"],0,1);
			if($arrear_antar_jemput_august == 0 || $arrear_antar_jemput_august == 1 || $arrear_antar_jemput_august == 2 || $arrear_antar_jemput_august == 3) { 
				
				$sta_antar_jemput_auto_aug = substr($row_available_payment_antar_jemput["aug_cataj"],0,1);
				$nom_antar_jemput_auto_aug = substr($row_available_payment_antar_jemput["aug_cataj"],2);
				$ifirst_antar_jemput++;
				
				if($ifirst_antar_jemput == 1) { $first_month_antar_jemput_payment = "aug-".$year_antar_jemput_auto; }
				$all_month_checked_antar_jemput = $all_month_checked_antar_jemput."aug-".$year_antar_jemput_auto."-".$sta_antar_jemput_auto_aug."-".$nom_antar_jemput_auto_aug.",";

			}
			
			$arrear_antar_jemput_september = substr($row_available_payment_antar_jemput["sep_cataj"],0,1);
			if($arrear_antar_jemput_september == 0 || $arrear_antar_jemput_september == 1 || $arrear_antar_jemput_september == 2 || $arrear_antar_jemput_september == 3) {
				
				$sta_antar_jemput_auto_sep = substr($row_available_payment_antar_jemput["sep_cataj"],0,1);
				$nom_antar_jemput_auto_sep = substr($row_available_payment_antar_jemput["sep_cataj"],2);
				$ifirst_antar_jemput++;
				
				if($ifirst_antar_jemput == 1) { $first_month_antar_jemput_payment = "sep-".$year_antar_jemput_auto; }
				$all_month_checked_antar_jemput = $all_month_checked_antar_jemput."sep-".$year_antar_jemput_auto."-".$sta_antar_jemput_auto_sep."-".$nom_antar_jemput_auto_sep.",";
			
			}
			
			$arrear_antar_jemput_october = substr($row_available_payment_antar_jemput["oct_cataj"],0,1);
			if($arrear_antar_jemput_october == 0 || $arrear_antar_jemput_october == 1 || $arrear_antar_jemput_october == 2 || $arrear_antar_jemput_october == 3) { 
				
				$sta_antar_jemput_auto_oct = substr($row_available_payment_antar_jemput["oct_cataj"],0,1);
				$nom_antar_jemput_auto_oct = substr($row_available_payment_antar_jemput["oct_cataj"],2);
				$ifirst_antar_jemput++;
				
				if($ifirst_antar_jemput == 1) { $first_month_antar_jemput_payment = "oct-".$year_antar_jemput_auto; }
				$all_month_checked_antar_jemput = $all_month_checked_antar_jemput."oct-".$year_antar_jemput_auto."-".$sta_antar_jemput_auto_oct."-".$nom_antar_jemput_auto_oct.",";
			
			}
			
			$arrear_antar_jemput_november = substr($row_available_payment_antar_jemput["nov_cataj"],0,1);
			if($arrear_antar_jemput_november == 0 || $arrear_antar_jemput_november == 1 || $arrear_antar_jemput_november == 2 || $arrear_antar_jemput_november == 3) { 
				
				$sta_antar_jemput_auto_nov = substr($row_available_payment_antar_jemput["nov_cataj"],0,1);
				$nom_antar_jemput_auto_nov = substr($row_available_payment_antar_jemput["nov_cataj"],2);
				$ifirst_antar_jemput++;
				
				if($ifirst_antar_jemput == 1) { $first_month_antar_jemput_payment = "nov-".$year_antar_jemput_auto; }
				$all_month_checked_antar_jemput = $all_month_checked_antar_jemput."nov-".$year_antar_jemput_auto."-".$sta_antar_jemput_auto_nov."-".$nom_antar_jemput_auto_nov.",";

			}
			
			$arrear_antar_jemput_december = substr($row_available_payment_antar_jemput["dec_cataj"],0,1);
			if($arrear_antar_jemput_december == 0 || $arrear_antar_jemput_december == 1 || $arrear_antar_jemput_december == 2 || $arrear_antar_jemput_december == 3) { 
				
				$sta_antar_jemput_auto_dec = substr($row_available_payment_antar_jemput["dec_cataj"],0,1);
				$nom_antar_jemput_auto_dec = substr($row_available_payment_antar_jemput["dec_cataj"],2);
				$ifirst_antar_jemput++;
				
				if($ifirst_antar_jemput == 1) { $first_month_antar_jemput_payment = "dec-".$year_antar_jemput_auto; }
				$all_month_checked_antar_jemput = $all_month_checked_antar_jemput."dec-".$year_antar_jemput_auto."-".$sta_antar_jemput_auto_dec."-".$nom_antar_jemput_auto_dec.",";

			}
			
			$arrear_antar_jemput_january = substr($row_available_payment_antar_jemput["jan_cataj"],0,1);
			if($arrear_antar_jemput_january == 0 || $arrear_antar_jemput_january == 1 || $arrear_antar_jemput_january == 2 || $arrear_antar_jemput_january == 3) { 
				
				$sta_antar_jemput_auto_jan = substr($row_available_payment_antar_jemput["jan_cataj"],0,1);
				$nom_antar_jemput_auto_jan = substr($row_available_payment_antar_jemput["jan_cataj"],2);
				$ifirst_antar_jemput++;
				
				if($ifirst_antar_jemput == 1) { $first_month_antar_jemput_payment = "jan-".$year_antar_jemput_auto; }
				$all_month_checked_antar_jemput = $all_month_checked_antar_jemput."jan-".$year_antar_jemput_auto."-".$sta_antar_jemput_auto_jan."-".$nom_antar_jemput_auto_jan.",";

			}
			
			$arrear_antar_jemput_february = substr($row_available_payment_antar_jemput["feb_cataj"],0,1);
			if($arrear_antar_jemput_february == 0 || $arrear_antar_jemput_february == 1 || $arrear_antar_jemput_february == 2 || $arrear_antar_jemput_february == 3) { 
				
				$sta_antar_jemput_auto_feb = substr($row_available_payment_antar_jemput["feb_cataj"],0,1);
				$nom_antar_jemput_auto_feb = substr($row_available_payment_antar_jemput["feb_cataj"],2);
				$ifirst_antar_jemput++;

				
				if($ifirst_antar_jemput == 1) { $first_month_antar_jemput_payment = "feb-".$year_antar_jemput_auto; }
				$all_month_checked_antar_jemput = $all_month_checked_antar_jemput."feb-".$year_antar_jemput_auto."-".$sta_antar_jemput_auto_feb."-".$nom_antar_jemput_auto_feb.",";

			}
			
			$arrear_antar_jemput_march = substr($row_available_payment_antar_jemput["mar_cataj"],0,1);
			if($arrear_antar_jemput_march == 0 || $arrear_antar_jemput_march == 1 || $arrear_antar_jemput_march == 2 || $arrear_antar_jemput_march == 3) { 
				
				$sta_antar_jemput_auto_mar = substr($row_available_payment_antar_jemput["mar_cataj"],0,1);
				$nom_antar_jemput_auto_mar = substr($row_available_payment_antar_jemput["mar_cataj"],2);
				$ifirst_antar_jemput++;
				
				if($ifirst_antar_jemput == 1) { $first_month_antar_jemput_payment = "mar-".$year_antar_jemput_auto; }
				$all_month_checked_antar_jemput = $all_month_checked_antar_jemput."mar-".$year_antar_jemput_auto."-".$sta_antar_jemput_auto_mar."-".$nom_antar_jemput_auto_mar.",";

			} 
			
			$arrear_antar_jemput_april = substr($row_available_payment_antar_jemput["apr_cataj"],0,1);
			if($arrear_antar_jemput_april == 0 || $arrear_antar_jemput_april == 1 || $arrear_antar_jemput_april == 2 || $arrear_antar_jemput_april == 3) { 
				
				$sta_antar_jemput_auto_apr = substr($row_available_payment_antar_jemput["apr_cataj"],0,1);
				$nom_antar_jemput_auto_apr = substr($row_available_payment_antar_jemput["apr_cataj"],2);
				$ifirst_antar_jemput++;
				
				if($ifirst_antar_jemput == 1) { $first_month_antar_jemput_payment = "apr-".$year_antar_jemput_auto; }
				$all_month_checked_antar_jemput = $all_month_checked_antar_jemput."apr-".$year_antar_jemput_auto."-".$sta_antar_jemput_auto_apr."-".$nom_antar_jemput_auto_apr.",";

			}
			
			$arrear_antar_jemput_may = substr($row_available_payment_antar_jemput["may_cataj"],0,1);
			if($arrear_antar_jemput_may == 0 || $arrear_antar_jemput_may == 1 || $arrear_antar_jemput_may == 2 || $arrear_antar_jemput_may == 3) { 
				
				$sta_antar_jemput_auto_may = substr($row_available_payment_antar_jemput["may_cataj"],0,1);
				$nom_antar_jemput_auto_may = substr($row_available_payment_antar_jemput["may_cataj"],2);
				$ifirst_antar_jemput++;
				
				if($ifirst_antar_jemput == 1) { $first_month_antar_jemput_payment = "may-".$year_antar_jemput_auto; }
				$all_month_checked_antar_jemput = $all_month_checked_antar_jemput."may-".$year_antar_jemput_auto."-".$sta_antar_jemput_auto_may."-".$nom_antar_jemput_auto_may.",";

			}
			
			$arrear_antar_jemput_june = substr($row_available_payment_antar_jemput["jun_cataj"],0,1);
			if($arrear_antar_jemput_june == 0 || $arrear_antar_jemput_june == 1 || $arrear_antar_jemput_june == 2 || $arrear_antar_jemput_june == 3) { 
			
				$sta_antar_jemput_auto_jun = substr($row_available_payment_antar_jemput["jun_cataj"],0,1);
				$nom_antar_jemput_auto_jun = substr($row_available_payment_antar_jemput["jun_cataj"],2);
				$ifirst_antar_jemput++;
				
				if($ifirst_antar_jemput == 1) { $first_month_antar_jemput_payment = "jun-".$year_antar_jemput_auto; }
				$all_month_checked_antar_jemput = $all_month_checked_antar_jemput."jun-".$year_antar_jemput_auto."-".$sta_antar_jemput_auto_jun."-".$nom_antar_jemput_auto_jun.",";

			}
		
		}
		
		$count_bulan_antar_jemput = count($bulan_antar_jemput); 
		
		$first_month_antar_jemput_paid = $bulan_antar_jemput[0]; 
		$first_month_antar_jemput_paid_checked = substr($first_month_antar_jemput_paid,0,12); 
		
		//echo $first_month_antar_jemput_payment."<br>";
		//echo $all_month_checked_antar_jemput."<br>";
		
		$src_nama_bulan_antar_jemput_diinput	= $bulan_antar_jemput;
		$nama_bulan_antar_jemput_diinput		= implode($src_nama_bulan_antar_jemput_diinput,',');
		
		//echo $nama_bulan_antar_jemput_diinput;
		
		//echo "[".$all_month_checked_antar_jemput."]<br>";
		//echo "[".$nama_bulan_antar_jemput_diinput."]<br>";
		
		if($first_month_antar_jemput_payment == $first_month_antar_jemput_paid_checked) {
		
			if(strstr($all_month_checked_antar_jemput,$nama_bulan_antar_jemput_diinput) != false) {
			
				$total_month_antar_jemput_transk = "";
				
				for($i=0; $i < $count_bulan_antar_jemput; $i++) {
				
					$src_cur_pay_antar_jemput = $bulan_antar_jemput[$i];
				
					if(substr($src_cur_pay_antar_jemput,0,3) == "jul") { $cur_month_pay_antar_jemput = "jul_cataj"; $month_antar_jemput_transk = "July, "; }
					if(substr($src_cur_pay_antar_jemput,0,3) == "aug") { $cur_month_pay_antar_jemput = "aug_cataj"; $month_antar_jemput_transk = "August, "; }
					if(substr($src_cur_pay_antar_jemput,0,3) == "sep") { $cur_month_pay_antar_jemput = "sep_cataj"; $month_antar_jemput_transk = "September, "; }
					if(substr($src_cur_pay_antar_jemput,0,3) == "oct") { $cur_month_pay_antar_jemput = "oct_cataj"; $month_antar_jemput_transk = "October, "; }
					if(substr($src_cur_pay_antar_jemput,0,3) == "nov") { $cur_month_pay_antar_jemput = "nov_cataj"; $month_antar_jemput_transk = "November, "; }
					if(substr($src_cur_pay_antar_jemput,0,3) == "dec") { $cur_month_pay_antar_jemput = "dec_cataj"; $month_antar_jemput_transk = "December, "; }
					if(substr($src_cur_pay_antar_jemput,0,3) == "jan") { $cur_month_pay_antar_jemput = "jan_cataj"; $month_antar_jemput_transk = "January, "; }
					if(substr($src_cur_pay_antar_jemput,0,3) == "feb") { $cur_month_pay_antar_jemput = "feb_cataj"; $month_antar_jemput_transk = "February, "; }
					if(substr($src_cur_pay_antar_jemput,0,3) == "mar") { $cur_month_pay_antar_jemput = "mar_cataj"; $month_antar_jemput_transk = "March, "; }
					if(substr($src_cur_pay_antar_jemput,0,3) == "apr") { $cur_month_pay_antar_jemput = "apr_cataj"; $month_antar_jemput_transk = "April, "; }
					if(substr($src_cur_pay_antar_jemput,0,3) == "may") { $cur_month_pay_antar_jemput = "may_cataj"; $month_antar_jemput_transk = "May, "; }
					if(substr($src_cur_pay_antar_jemput,0,3) == "jun") { $cur_month_pay_antar_jemput = "jun_cataj"; $month_antar_jemput_transk = "June, "; }
					
					$cur_year_pay_antar_jemput 	= substr($src_cur_pay_antar_jemput,4,4)." - ".substr($src_cur_pay_antar_jemput,8,4);
					$cur_sta_pay_antar_jemput	= substr($src_cur_pay_antar_jemput,13,1);
					$cur_nom_pay_antar_jemput	= substr($src_cur_pay_antar_jemput,15);
					
					if($cur_sta_pay_antar_jemput == 0)  { $sta_val_paid_antar_jemput = "7-". $cur_nom_pay_antar_jemput; $have_plus_antar_jemput = "have_plus = '1',"; $have_minus_antar_jemput = ""; } //have paid before the month of payment come 
					if($cur_sta_pay_antar_jemput == 1)  { $sta_val_paid_antar_jemput = "5-". $cur_nom_pay_antar_jemput; $have_plus_antar_jemput = ""; $have_minus_antar_jemput = ""; } //have paid on time 
					if($cur_sta_pay_antar_jemput == 2)  { $sta_val_paid_antar_jemput = "6-". $cur_nom_pay_antar_jemput; $have_plus_antar_jemput = ""; $have_minus_antar_jemput = "have_minus = '1',"; } //have paid late 
					
					$total_month_antar_jemput_transk = $total_month_antar_jemput_transk.$month_antar_jemput_transk;
					
					//echo $src_cur_pay_antar_jemput."<br>";
					//echo $cur_year_pay_antar_jemput."<br>";
					//echo $cur_sta_pay_antar_jemput."<br>";
					//echo $cur_nom_pay_antar_jemput."<br><br>";
					
					$src_update_sta_nom_antar_jemput = "update tunggakan set $have_plus_antar_jemput $have_minus_antar_jemput $cur_month_pay_antar_jemput = '$sta_val_paid_antar_jemput' where no_sisda = '$no_sisda_enc' and periode = '$cur_year_pay_antar_jemput' and jenis_tunggakan = 'antar_jemput'";
					$query_update_sta_nom_antar_jemput = mysqli_query($mysql_connect, $src_update_sta_nom_antar_jemput) or die(mysql_error());
					//$src_update_sta_nom_antar_jemput; echo "<br>";
					
					//echo $all_month_checked_antar_jemput."</br>";
					//echo $nama_bulan_antar_jemput_diinput."</br>";
					
					if($query_update_sta_nom_antar_jemput) {
					
						//We need to check whether all errears has been paid by students, if so we have to turn the field tunggakan to 0 (no arrear)
						//All field values has to be equal with 4,5,6 or 7 to make the status 0
						$src_check_status_antar_jemput 	= "select jul_cataj,aug_cataj,sep_cataj,oct_cataj,nov_cataj,dec_cataj,jan_cataj,feb_cataj,mar_cataj,apr_cataj,may_cataj,jun_cataj from tunggakan where no_sisda = '$no_sisda' and periode = '$cur_year_pay_antar_jemput' and jenis_tunggakan = 'antar_jemput'";
						$query_check_status_antar_jemput = mysqli_query($mysql_connect, $src_check_status_antar_jemput) or die(mysql_error());	
						$row_check_status_antar_jemput	= mysql_fetch_array($query_check_status_antar_jemput);					
						
						$val_jul_exp_antar_jemput = explode("-",$row_check_status_antar_jemput["jul_cataj"]); 	$val_jul_sta_antar_jemput = $val_jul_exp_antar_jemput[0]; //echo "<h1>july".$val_jul_sta."</h1>";
						$val_aug_exp_antar_jemput = explode("-",$row_check_status_antar_jemput["aug_cataj"]); 	$val_aug_sta_antar_jemput = $val_aug_exp_antar_jemput[0]; //echo "<h1>aug".$val_aug_sta."</h1>";
						$val_sep_exp_antar_jemput = explode("-",$row_check_status_antar_jemput["sep_cataj"]); 	$val_sep_sta_antar_jemput = $val_sep_exp_antar_jemput[0]; //echo "<h1>sep".$val_sep_sta."</h1>";
						$val_oct_exp_antar_jemput = explode("-",$row_check_status_antar_jemput["oct_cataj"]); 	$val_oct_sta_antar_jemput = $val_oct_exp_antar_jemput[0]; //echo "<h1>oct".$val_oct_sta."</h1>";
						$val_nov_exp_antar_jemput = explode("-",$row_check_status_antar_jemput["nov_cataj"]); 	$val_nov_sta_antar_jemput = $val_nov_exp_antar_jemput[0]; //echo "<h1>nov".$val_nov_sta."</h1>";
						$val_dec_exp_antar_jemput = explode("-",$row_check_status_antar_jemput["dec_cataj"]); 	$val_dec_sta_antar_jemput = $val_dec_exp_antar_jemput[0]; //echo "<h1>dec".$val_dec_sta."</h1>";
						$val_jan_exp_antar_jemput = explode("-",$row_check_status_antar_jemput["jan_cataj"]); 	$val_jan_sta_antar_jemput = $val_jan_exp_antar_jemput[0]; //echo "<h1>jan".$val_jan_sta."</h1>";
						$val_feb_exp_antar_jemput = explode("-",$row_check_status_antar_jemput["feb_cataj"]); 	$val_feb_sta_antar_jemput = $val_feb_exp_antar_jemput[0]; //echo "<h1>feb".$val_feb_sta."</h1>";
						$val_mar_exp_antar_jemput = explode("-",$row_check_status_antar_jemput["mar_cataj"]); 	$val_mar_sta_antar_jemput = $val_mar_exp_antar_jemput[0]; //echo "<h1>mar".$val_mar_sta."</h1>";
						$val_apr_exp_antar_jemput = explode("-",$row_check_status_antar_jemput["apr_cataj"]); 	$val_apr_sta_antar_jemput = $val_apr_exp_antar_jemput[0]; //echo "<h1>apr".$val_apr_sta."</h1>";
						$val_may_exp_antar_jemput = explode("-",$row_check_status_antar_jemput["may_cataj"]); 	$val_may_sta_antar_jemput = $val_may_exp_antar_jemput[0]; //echo "<h1>may".$val_may_sta."</h1>";
						$val_jun_exp_antar_jemput = explode("-",$row_check_status_antar_jemput["jun_cataj"]); 	$val_jun_sta_antar_jemput = $val_jun_exp_antar_jemput[0]; //echo "<h1>jun".$val_jun_sta."</h1>";
													
						if(
							($val_jul_sta_antar_jemput != 1 and $val_jul_sta_antar_jemput != 2) and
							($val_aug_sta_antar_jemput != 1 and $val_aug_sta_antar_jemput != 2) and
							($val_sep_sta_antar_jemput != 1 and $val_sep_sta_antar_jemput != 2) and
							($val_oct_sta_antar_jemput != 1 and $val_oct_sta_antar_jemput != 2) and
							($val_nov_sta_antar_jemput != 1 and $val_nov_sta_antar_jemput != 2) and
							($val_dec_sta_antar_jemput != 1 and $val_dec_sta_antar_jemput != 2) and
							($val_jan_sta_antar_jemput != 1 and $val_jan_sta_antar_jemput != 2) and
							($val_feb_sta_antar_jemput != 1 and $val_feb_sta_antar_jemput != 2) and
							($val_mar_sta_antar_jemput != 1 and $val_mar_sta_antar_jemput != 2) and
							($val_apr_sta_antar_jemput != 1 and $val_apr_sta_antar_jemput != 2) and
							($val_may_sta_antar_jemput != 1 and $val_may_sta_antar_jemput != 2) and
							($val_jun_sta_antar_jemput != 1 and $val_jun_sta_antar_jemput != 2) 
						) {
						
							$src_zero_antar_jemput_status	= "update tunggakan set status = '0' where no_sisda = '$no_sisda' and periode = '$cur_year_pay_antar_jemput' and jenis_tunggakan = 'antar_jemput'";
							$query_zero_antar_jemput_status	= mysqli_query($mysql_connect, $src_zero_antar_jemput_status) or die(mysql_error());
						
						} else {
						
							$src_zero_antar_jemput_status	= "update tunggakan set status = '1' where no_sisda = '$no_sisda' and periode = '$cur_year_pay_antar_jemput' and jenis_tunggakan = 'antar_jemput'";
							$query_zero_antar_jemput_status	= mysqli_query($mysql_connect, $src_zero_antar_jemput_status) or die(mysql_error());
						
						}
					
					
					} else {
					
						$antar_jemput_succeed = "gagal";
						$antar_jemput_message = "[Kasus transaksi antar_jemput jenis <b>3</b>]<br>Query update pembayaran pada table tunggakan gagal dilakukan<br> Hubungi admin Sisda";
				
					
					}
				
				}
				
				$src_input_antar_jemput	= "insert into transaksi (
									no_sisda, 
									no_trs,
									kasir,
									tanggal_transaksi,
									periode,
									nama_siswa,
									jenjang,
									tingkat,
									kelas,
									teknik_pembayaran,
									jumlah_bulan_antar_jemput,
									bulan_antar_jemput,
									jenis_transaksi,
									antar_jemput,
									supir
									$if_transfer_item
									) values (
									'$no_sisda_enc',
									'$src_no_kwintansi',
									'$who_operator_enc',
									'$tanggal_transaksi_enc',
									'$periode_trans', 
									'$nama_siswa_enc',
									'$jenjang_enc',
									'$tingkat_enc',
									'$kelas_enc',
									'$teknik_pembayaran_enc',
									'$count_bulan_antar_jemput',
									'$total_month_antar_jemput_transk',
									'antar_jemput',
									'$subtotal_antar_jemput_enc',
									'$provider_antar_jemput' 
									$if_transfer_value
									)";
									
				$query_input_antar_jemput = mysqli_query($mysql_connect, $src_input_antar_jemput) or die(mysql_error());
				//echo $src_input_antar_jemput."<br>";
				
				if($query_input_antar_jemput) {
				
					$antar_jemput_succeed = "okeh";
					$antar_jemput_message = "";
				
				}
				
			} else {
				
				$antar_jemput_succeed = "gagal";
				$antar_jemput_message = "[Kasus transaksi antar_jemput jenis <b>1</b>]<br>Bulan pembayaran antar_jemput yang diizinkan secara berurutan adalah $all_month_checked_antar_jemput anda melakukan pembayaran untuk $nama_bulan_antar_jemput_diinput<br> Transaksi pembayaran antar_jemput tidak berhasil";
				
			}
		
		} else {  
		
			$src_first_month_antar_jemput_error = substr($first_month_antar_jemput_paid,0,3);
			$first_year_antar_jemput_error		= substr($first_month_antar_jemput_paid,4,4)." - ".substr($first_month_antar_jemput_paid,8,4);
			
			$src_first_month_antar_jemput_allowed	= substr($first_month_antar_jemput_payment,0,3);
			$first_year_antar_jemput_allowed		= substr($first_month_antar_jemput_payment,4,4)." - ".substr($first_month_antar_jemput_payment,8,4); 
		
			if($src_first_month_antar_jemput_allowed == "jul") { $first_month_antar_jemput_allowed = "Juli ".$first_year_antar_jemput_allowed; }
			if($src_first_month_antar_jemput_allowed == "aug") { $first_month_antar_jemput_allowed = "Agustus ".$first_year_antar_jemput_allowed; }
			if($src_first_month_antar_jemput_allowed == "sep") { $first_month_antar_jemput_allowed = "September ".$first_year_antar_jemput_allowed; }
			if($src_first_month_antar_jemput_allowed == "oct") { $first_month_antar_jemput_allowed = "Oktober ".$first_year_antar_jemput_allowed; }
			if($src_first_month_antar_jemput_allowed == "nov") { $first_month_antar_jemput_allowed = "November ".$first_year_antar_jemput_allowed; }
			if($src_first_month_antar_jemput_allowed == "dec") { $first_month_antar_jemput_allowed = "Desember ".$first_year_antar_jemput_allowed; }
			if($src_first_month_antar_jemput_allowed == "jan") { $first_month_antar_jemput_allowed = "Januari ".$first_year_antar_jemput_allowed; }
			if($src_first_month_antar_jemput_allowed == "feb") { $first_month_antar_jemput_allowed = "Februari ".$first_year_antar_jemput_allowed; }
			if($src_first_month_antar_jemput_allowed == "mar") { $first_month_antar_jemput_allowed = "Maret ".$first_year_antar_jemput_allowed; }
			if($src_first_month_antar_jemput_allowed == "apr") { $first_month_antar_jemput_allowed = "April ".$first_year_antar_jemput_allowed; }
			if($src_first_month_antar_jemput_allowed == "may") { $first_month_antar_jemput_allowed = "Mei ".$first_year_antar_jemput_allowed; }
			if($src_first_month_antar_jemput_allowed == "jun") { $first_month_antar_jemput_allowed = "Juni ".$first_year_antar_jemput_allowed; }
			
			if($src_first_month_antar_jemput_error == "jul") { $first_month_antar_jemput_error = "Juli ".$first_year_antar_jemput_error; }
			if($src_first_month_antar_jemput_error == "aug") { $first_month_antar_jemput_error = "Agustus ".$first_year_antar_jemput_error; }
			if($src_first_month_antar_jemput_error == "sep") { $first_month_antar_jemput_error = "September ".$first_year_antar_jemput_error; }
			if($src_first_month_antar_jemput_error == "oct") { $first_month_antar_jemput_error = "Oktober ".$first_year_antar_jemput_error; }
			if($src_first_month_antar_jemput_error == "nov") { $first_month_antar_jemput_error = "November ".$first_year_antar_jemput_error; }
			if($src_first_month_antar_jemput_error == "dec") { $first_month_antar_jemput_error = "Desember ".$first_year_antar_jemput_error; }
			if($src_first_month_antar_jemput_error == "jan") { $first_month_antar_jemput_error = "Januari ".$first_year_antar_jemput_error; }
			if($src_first_month_antar_jemput_error == "feb") { $first_month_antar_jemput_error = "Februari ".$first_year_antar_jemput_error; }
			if($src_first_month_antar_jemput_error == "mar") { $first_month_antar_jemput_error = "Maret ".$first_year_antar_jemput_error; }
			if($src_first_month_antar_jemput_error == "apr") { $first_month_antar_jemput_error = "April ".$first_year_antar_jemput_error; }
			if($src_first_month_antar_jemput_error == "may") { $first_month_antar_jemput_error = "Mei ".$first_year_antar_jemput_error; }
			if($src_first_month_antar_jemput_error == "jun") { $first_month_antar_jemput_error = "Juni ".$first_year_antar_jemput_error; }
		
			$antar_jemput_succeed = "gagal";
			$antar_jemput_message = "[Kasus transaksi antar_jemput jenis <b>2</b>]<br>Bulan pembayaran antar_jemput yang harus pertama kali dibayar adalah <b>$first_month_antar_jemput_allowed</b> anda melakukan pembayaran untuk <b>$first_month_antar_jemput_error </b>";
			//echo $antar_jemput_error_message;
		
		}
		
			
	} //owned by: if(!empty($_POST["subtotal_antar_jemput"]) && $_POST["subtotal_antar_jemput"] != 0) {
	
	
	//------------------------------------//
	//-------- END OF Antar Jemput -------//
	//------------------------------------//	
	
	///////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////
	//////////////////////////RUMAH BERBAGI////////////////////////////
	///////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////
	if(!empty($_POST["subtotal_ruba"]) && $_POST["subtotal_ruba"] != 0) {
	
		$zakat_mal_ruba						= empty($_POST["zakat_mal_ruba"]) ? 0 : $_POST["zakat_mal_ruba"];
		$zakat_mal_ruba_enc					= mysql_real_escape_string($zakat_mal_ruba);
		
		$zakat_profesi_ruba					= empty($_POST["zakat_profesi_ruba"]) ? 0 : $_POST["zakat_profesi_ruba"];
		$zakat_profesi_ruba_enc				= mysql_real_escape_string($zakat_profesi_ruba);
		
		$infaq_sho_ruba						= empty($_POST["infaq_sho_ruba"]) ? 0 : $_POST["infaq_sho_ruba"];
		$infaq_sho_ruba_enc					= mysql_real_escape_string($infaq_sho_ruba);
		
		$wakaf_ruba							= empty($_POST["wakaf_ruba"]) ? 0 : $_POST["wakaf_ruba"];
		$wakaf_ruba_enc						= mysql_real_escape_string($wakaf_ruba);
		
		$zakat_fitrah_ruba					= empty($_POST["zakat_fitrah_ruba"]) ? 0 : $_POST["zakat_fitrah_ruba"];
		$zakat_fitrah_ruba_enc				= mysql_real_escape_string($zakat_fitrah_ruba);
		
		$fidyah_ruba						= empty($_POST["fidyah_ruba"]) ? 0 : $_POST["fidyah_ruba"];
		$fidyah_ruba_enc					= mysql_real_escape_string($fidyah_ruba);
		
		$baksos_ramadhan_ruba				= empty($_POST["baksos_ramadhan_ruba"]) ? 0 : $_POST["baksos_ramadhan_ruba"];
		$baksos_ramadhan_ruba_enc			= mysql_real_escape_string($baksos_ramadhan_ruba);
		
		$qurban_ruba						= empty($_POST["qurban_ruba"]) ? 0 : $_POST["qurban_ruba"];
		$qurban_ruba_enc					= mysql_real_escape_string($qurban_ruba);
		
		$subtotal_ruba						= $_POST["subtotal_ruba"];
		$subtotal_ruba_enc					= mysql_real_escape_string($subtotal_ruba);
	
	
		$src_input_ruba	= "insert into transaksi (
								no_sisda,
								no_trs,
								kasir,
								tanggal_transaksi,
								periode, 
								nama_siswa,
								jenjang,
								tingkat,
								kelas,
								teknik_pembayaran,
								zakat_mal_ruba,
								zakat_profesi_ruba,
								infaq_sho_ruba,
								wakaf_ruba,
								zakat_fitrah_ruba,
								fidyah_ruba,
								baksos_ramadhan_ruba,
								qurban_ruba,
								jenis_transaksi 
								$if_transfer_item
								) values (
								'$no_sisda_enc', 
								'$src_no_kwintansi',
								'$who_operator_enc',
								'$tanggal_transaksi_enc',
								'$periode_trans',
								'$nama_siswa_enc',
								'$jenjang_enc',
								'$tingkat_enc',
								'$kelas_enc',
								'$teknik_pembayaran_enc',
								'$zakat_mal_ruba_enc',
								'$zakat_profesi_ruba_enc',
								'$infaq_sho_ruba_enc',
								'$wakaf_ruba_enc',
								'$zakat_fitrah_ruba_enc',
								'$fidyah_ruba_enc',
								'$baksos_ramadhan_ruba_enc',
								'$qurban_ruba_enc',
								'rumah_berbagi'
								$if_transfer_value 
								)";
		$query_input_ruba	= mysqli_query($mysql_connect, $src_input_ruba) or die(mysql_error());
		
		if($query_input_ruba) {
		
			$ruba_succeed 	= "okeh";;
			$ruba_message	= "";
			
		
		} else {
		
			$ruba_succeed = "gagal";
			$ruba_message = "[Kasus transaksi Rumah Berbagi jenis <b>1</b>]<br>Proses input data ke tabel transaksi tidak berhasil";
			
		
		}
	}
	
	//-------------------------------------//
	//-------- END OF Rumah Berbagi -------//
	//-------------------------------------//	
	
	///////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////
	////////////////////////--SCHOOL SUPPORT--/////////////////////////
	///////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////
	if(!empty($_POST["subtotal_schspt"]) && $_POST["subtotal_schspt"] != 0) {
	
		$nama_item_schspt					= $_POST["nama_addition_item_schspt"];
		$nama_item_schspt_enc				= mysql_real_escape_string($nama_item_schspt);
		//echo "nama_item".$nama_item_schspt."<br>";
		
		$nominal_item_schspt				= $_POST["nominal_addition_item_schspt"];
		$nominal_item_schspt_enc			= mysql_real_escape_string($nominal_item_schspt);
		//echo "nominal_item".$nominal_item_schspt."<br>";
		
		$subtotal_schspt					= $_POST["subtotal_schspt"];
		$subtotal_schspt_enc				= mysql_real_escape_string($subtotal_schspt);
		//echo "subtotal".$subtotal_schspt."<br>";
	
		//Before we work further, there are four conditions that we have to take care
		//1. All school support item that sent by the form are empty
		//--> So we do not need to insert any data to table transaction
		
		//2. One or more school support item that sent by the form are not empty (being filled)
		//--> We need to insert the data to table transaction
		
		//3. Additional school support item and it value that sent by the form is empty
		//--> We do not need to insert any data to table school support
		
		//4. Additional school support item and it value that sent by the form is not empty (being filled)
		//--> We need to insert item name to table school support
		
		//Then here we go.......	
		
		//take all data in school_support table
		$src_get_schspt		= "select * from school_support";
		$query_get_schspt	= mysqli_query($mysql_connect, $src_get_schspt) or die(mysql_error());
		$num_get_schspt		= mysql_num_rows($query_get_schspt);
			
		//What i'm doing here is i need to put the result of this array (mysql_fetch_array) in one variable.
		
		//define this variable as 0, So when i used it in looping process, it starts from 1
		$i_sch_sup 	= 1;
		
		//this item formation is needed for printing process
		$src_sch_item_printing = "";
		
		//define $array as array
		$array = array();
		$array_item = array();
		
		while($get_schspt	= mysql_fetch_array($query_get_schspt)) {		
			$cur_i_sch_sup	= $i_sch_sup++;
		
			//Define the array as the post variable that received from transaction page
			$chk_zero_sch_sup = empty($_POST["sch_sup_".$cur_i_sch_sup."_schspt"]) ? 0 : $_POST["sch_sup_".$cur_i_sch_sup."_schspt"];
			//$array[] = $_POST["sch_sup_".$cur_i_sch_sup."_schspt"];	
			$array[] = $chk_zero_sch_sup;
			
			if($chk_zero_sch_sup == "") {
			
				$src_get_item = "";
				
			} else {
			
				$src_get_item = $get_schspt["item_lwr"];
				$src_sch_item_printing = $src_sch_item_printing.$src_get_item.",";
				
			}
			
			$array_item[] = $src_get_item;
			
			//echo "nom_item:".$chk_zero_sch_sup."<br>";
			//echo "item:".$src_get_item."<br>";
		}	
		
		//There are two condition with additional school support item.
		//Those are:
		//1. item name and nominal is not empty
		//2. item name and nominal is empty			
		if(!empty($nominal_item_schspt_enc) && !empty($nama_item_schspt_enc)) {
		
			//We put the additional school support item in the end of part of $school_support
			//We implode the result with comma(,)	
			
			if($num_get_schspt == 0) {	
			
				$school_support 	= $nominal_item_schspt;
				$all_item 			= $nama_item_schspt_enc;
				$sch_item_printing 	= $nama_item_schspt_enc;
			
			} else {
			
				$school_support 	= implode(",", $array).",".$nominal_item_schspt; 
				$all_item 			= implode(",",$array_item).",".$nama_item_schspt_enc; 
				$sch_item_printing 	= $src_sch_item_printing.$nama_item_schspt_enc; 
			}
			
			//We have to ensure that the first character of each word is uppercase.
			//That's what we need when we want to display this item name in a form.
			$item_schspt = ucwords($nama_item_schspt_enc);
			
			//we have to change all string as lowercase and change every space to underscore
			//That's what we need when we want to use it in php process
			$item_schspt_lwr = strtolower(str_replace(" ","_",$nama_item_schspt_enc));
			
			//kay...kay...get up... shake your arm... get up..... yippiiiii.....
			//you know buddy, we got to add the new item to database school_support.
			// As we need to use it again in next process.
			$src_insert_schspt		= "insert into school_support (item,item_lwr) values ('$item_schspt','$item_schspt_lwr')";	
			$query_insert_schspt	= mysqli_query($mysql_connect, $src_insert_schspt) or die ("There is an error with mysql: ".mysql_error());
		
		} else {
		
			//$school_support without additional item
			$school_support = implode(",", $array); 
			
			$all_item = implode(",",$array_item); 
			//echo "all_item=".$all_item."<br>";
			
			$sch_item_printing = $src_sch_item_printing;
			
		}
		
		//echo "school_support:  ".$school_support."<br>";
		//echo "all_item:  ".$all_item."<br>";
		//echo "sch_item_printing:  ".$sch_item_printing."<br>";
			
		$src_input_schspt	= "insert into transaksi (
								no_sisda, 
								no_trs,
								kasir,
								tanggal_transaksi,
								periode,
								nama_siswa,
								jenjang,
								tingkat,
								kelas, 
								teknik_pembayaran, 
								jenis_transaksi, 
								school_support,
								item_school_support
								$if_transfer_item
								) values (
								'$no_sisda_enc',
								'$src_no_kwintansi',
								'$who_operator_enc',
								'$tanggal_transaksi_enc',
								'$periode_trans',
								'$nama_siswa_enc',
								'$jenjang_enc',
								'$tingkat_enc',
								'$kelas_enc',
								'$teknik_pembayaran_enc',
								'school_support',
								'$school_support',
								'$all_item'
								$if_transfer_value
								)";
								
		$query_input_schspt	= mysqli_query($mysql_connect, $src_input_schspt) or die(mysql_error());
		
		if($query_input_schspt) {
		
			$schspt_succeed = "okeh";
			$schspt_message = "";
		
		} else {
		
			$schspt_succeed = "gagal";
			$schspt_message = "[Kasus transaksi Rumah Berbagi jenis <b>1</b>]<br>Proses input data ke tabel transaksi tidak berhasil";
		
		}
	}
	
	//-------------------------------//
	//-------- school Support -------//
	//-------------------------------//	
	
	//echo "spp_succeed=".$spp_succeed;
	
	if(empty($daful_succeed) && empty($bima_succeed) && empty($spp_succeed) && empty($catering_succeed) && empty($antar_jemput_succeed) && empty($ruba_succeed) && empty($schspt_succeed)) {
	
		$redirect_path	= "";
		$redirect_icon	= "images/icon_false.png";
		$redirect_url	= "mainpage.php?pl=transaction&no=$no_sisda_enc";
		$redirect_text	= "Tidak ada data yang diisi dalam form";
		
		$need_redirect	= true;
		//include_once ("include/redirect.php");
		
		//echo "no_response";
	} else {
	
		//---------------------------------------
		//here are variables that used in prog_log.php
		include_once("include/url.php");
		$activity	= "Insert data transaction";
		$url		= curPageURL();
		$id			= $_SESSION["id"];
		$need_log	= true;
		include_once("include/log.php");
		//---------------------------------------
		
		//What is your name brother???? i wanna say Assalamualaikum with your beautiful name  :)
		$id_user		= $_SESSION["id"];
		$src_name		= "select name from user where id='$id_user'"; 
		$query_name		= mysqli_query($mysql_connect, $src_name) or die("There is an error with mysql: ".mysql_error());
		$row_name		= mysql_fetch_array($query_name);

		
		$sender_unit					= $jenjang_enc;
		$sender_kasir					= $who_operator_enc;
		$sender_no_kwitansi				= $src_no_kwintansi;
		$sender_tanggal					= $tanggal_transaksi_enc;
		$sender_no_sisda				= $no_sisda_enc;
		$sender_nama					= $nama_siswa_enc;
		$sender_kelas					= $kelas_enc;
		$sender_student_pay				= $student_pay;
		//////////
		$sender_bima					= empty($subtotal_bima_for_send) ? "" : $subtotal_bima_for_send; 					//echo "sender_bima: ".$sender_bima."<br>";
		$sender_bima_succeed			= empty($bima_succeed) ? "" : $bima_succeed;										//echo "sender_bima_succeed: ".$sender_bima_succeed."<br>";
		$sender_bima_message			= empty($bima_message) ? "" : $bima_message;										//echo "sender_bima_message: ".$sender_bima_message."<br><br>";
		
		//////////
		$sender_daful					= empty($subtotal_daful_for_send) ? "" : $subtotal_daful_for_send;					//echo "sender_daful: ".$sender_daful."<br>";
		$sender_daful_succeed			= empty($daful_succeed) ? "" : $daful_succeed;										//echo "sender_daful_succeed: ".$sender_daful_succeed."<br>";
		$sender_daful_message			= empty($daful_message) ? "" : $daful_message;										//echo "sender_daful_message: ".$sender_daful_message."<br><br>";
		//////////
		
		$sender_ks						= empty($total_ks) ? "" : $total_ks;												//echo "total_ks: ".$total_ks."<br>";
		$sender_spp						= empty($spp_no_ks) ? "" : $spp_no_ks;												//echo "sender_spp: ".$sender_spp."<br>";
		//$sender_spp					= empty($subtotal_spp_enc) ? "" : $subtotal_spp_enc;								echo "sender_spp: ".$sender_spp."<br>";
		$sender_spp_bulan				= empty($total_month_spp_transk) ? "" : $total_month_spp_transk;					//echo "sender_spp_bulan: ".$sender_spp_bulan."<br>";
		$sender_spp_succeed				= empty($spp_succeed) ? "" : $spp_succeed;											//echo "sender_spp_succeed: ".$sender_spp_succeed."<br>";
		$sender_spp_message				= empty($spp_message) ? "" : $spp_message;											//echo "sender_spp_message: ".$sender_spp_message."<br><br>";
		//////////
		$sender_catering				= empty($subtotal_catering_enc) ? "" : $subtotal_catering_enc; 						//echo "sender_catering: ". $sender_catering."<br>";
		$sender_catering_bulan			= empty($total_month_catering_transk) ? "" : $total_month_catering_transk; 			//echo "sender_catering_bulan: ". $sender_catering_bulan."<br>";
		$sender_catering_succeed		= empty($catering_succeed) ? "" : $catering_succeed; 								//echo "sender_catering_succeed: ". $sender_catering_succeed."<br>";
		$sender_catering_message		= empty($catering_message) ? "" : $catering_message; 								//echo "sender_catering_message: ". $sender_catering_message."<br><br>";
		//////////
		$sender_antar_jemput			= empty($subtotal_antar_jemput_enc) ? "" : $subtotal_antar_jemput_enc;				//echo "sender_antar_jemput: ". $sender_antar_jemput."<br>";
		$sender_antar_jemput_bulan		= empty($total_month_antar_jemput_transk) ? "" : $total_month_antar_jemput_transk;	//echo "sender_antar_jemput_bulan: ". $sender_antar_jemput_bulan."<br>";	
		$sender_antar_jemput_succeed	= empty($antar_jemput_succeed) ? "" : $antar_jemput_succeed;						//echo "sender_antar_jemput_succeed: ". $sender_antar_jemput_succeed."<br>";
		$sender_antar_jemput_message	= empty($antar_jemput_message) ? "" : $antar_jemput_message;						//echo "sender_antar_jemput_message: ". $sender_antar_jemput_message."<br><br>";
		//////////
		$sender_zakat_mall				= empty($zakat_mal_ruba_enc) ? "" : "Zakat mall, ";
		$sender_zakat_profesi			= empty($zakat_profesi_ruba_enc) ? "" : "Zakat_profesi, ";
		$sender_infaq_shodaqoh			= empty($infaq_sho_ruba_enc) ? "" : "Infaq shodaqoh, ";
		$sender_wakaf					= empty($wakaf_ruba_enc) ? "" : "Wakaf, ";
		$sender_zakat_fitrah			= empty($zakat_fitrah_ruba_enc) ? "" : "Zakat fitrah, ";
		$sender_fidyah					= empty($fidyah_ruba_enc) ? "" : "Fidyah, ";
		$sender_baksos_ramadhan			= empty($baksos_ramadhan_ruba_enc) ? "" : "Baksos Ramadhan, ";
		$sender_qurban					= empty($qurban_ruba_enc) ? "" : "Qurban, ";
		
		$sender_ruba					= empty($subtotal_ruba_enc) ? "" : $subtotal_ruba_enc;
		$sender_ruba_item				= $sender_zakat_mall.$sender_zakat_profesi.$sender_infaq_shodaqoh.$sender_wakaf.$sender_zakat_fitrah.$sender_fidyah.$sender_baksos_ramadhan.$sender_qurban;
		$sender_ruba_succeed			= empty($ruba_succeed) ? "" : $ruba_succeed;
		$sender_ruba_message			= empty($ruba_message) ? "" : $ruba_message;
		
		///////////	
		$sender_schspt					= empty($subtotal_schspt_enc) ? "" : $subtotal_schspt_enc;	//echo "sender_schspt: ". $sender_schspt."<br>";
		$sender_schspt_item				= empty($sch_item_printing) ? "" : $sch_item_printing;						//echo "sender_schspt_item: ". $sender_schspt_item."<br>";
		$sender_schspt_succeed			= empty($schspt_succeed) ? "" : $schspt_succeed;			//echo "sender_schspt_succeed: ". $sender_schspt_succeed."<br>";
		$sender_schspt_message			= empty($schspt_message) ? "" : $schspt_message;			//echo "sender_schspt_message: ". $sender_schspt_message."<br><br>";
?>
		<form name="send_transaksi" method="post" action="page/page_cetak_kwitansi_transaksi.php">
        
        <input type="hidden" name="sender_unit" value="<?= $sender_unit; ?>" />
        <input type="hidden" name="sender_kasir" value="<?= $sender_kasir; ?>" />
        <input type="hidden" name="sender_no_kwitansi" value="<?= $sender_no_kwitansi; ?>" />
        <input type="hidden" name="sender_tanggal" value="<?= $sender_tanggal; ?>" />
        <input type="hidden" name="sender_no_sisda" value="<?= $sender_no_sisda; ?>" />
        <input type="hidden" name="sender_nama" value="<?= $sender_nama; ?>" />
        <input type="hidden" name="sender_kelas" value="<?= $sender_kelas; ?>" />
        <input type="hidden" name="sender_student_pay" value="<?= $sender_student_pay; ?>" />
        
        <input type="hidden" name="sender_bima" value="<?= $sender_bima; ?>" />
        <input type="hidden" name="sender_bima_succeed" value="<?= $sender_bima_succeed; ?>" />
        <input type="hidden" name="sender_bima_message" value="<?= $sender_bima_message; ?>" />
        
        <input type="hidden" name="sender_daful" value="<?= $sender_daful; ?>" />
        <input type="hidden" name="sender_daful_succeed" value="<?= $sender_daful_succeed; ?>" />
        <input type="hidden" name="sender_daful_message" value="<?= $sender_daful_message; ?>" />
        
        <input type="hidden" name="sender_spp" value="<?= $sender_spp; ?>" />
        <input type="hidden" name="sender_ks" value="<?= $sender_ks; ?>" />
        <input type="hidden" name="sender_spp_bulan" value="<?= $sender_spp_bulan; ?>" />
        <input type="hidden" name="sender_spp_succeed" value="<?= $sender_spp_succeed; ?>" />
        <input type="hidden" name="sender_spp_message" value="<?= $sender_spp_message; ?>" />
        
        <input type="hidden" name="sender_catering" value="<?= $sender_catering; ?>" />
        <input type="hidden" name="sender_catering_bulan" value="<?= $sender_catering_bulan; ?>" />
        <input type="hidden" name="sender_catering_succeed" value="<?= $sender_catering_succeed; ?>" />
        <input type="hidden" name="sender_catering_message" value="<?= $sender_catering_message; ?>" />
        
        <input type="hidden" name="sender_antar_jemput" value="<?= $sender_antar_jemput; ?>" />
        <input type="hidden" name="sender_antar_jemput_bulan" value="<?= $sender_antar_jemput_bulan; ?>" />
        <input type="hidden" name="sender_antar_jemput_succeed" value="<?= $sender_antar_jemput_succeed; ?>" />
        <input type="hidden" name="sender_antar_jemput_message" value="<?= $sender_antar_jemput_message; ?>" />
        
        <input type="hidden" name="sender_ruba" value="<?= $sender_ruba; ?>" />
        <input type="hidden" name="sender_ruba_item" value="<?= $sender_ruba_item; ?>" />
        <input type="hidden" name="sender_ruba_succeed" value="<?= $sender_ruba_succeed; ?>" />
        <input type="hidden" name="sender_ruba_message" value="<?= $sender_ruba_message; ?>" />
        
        <input type="hidden" name="sender_schspt" value="<?= $sender_schspt; ?>" />
        <input type="hidden" name="sender_schspt_item" value="<?= $sender_schspt_item; ?>" />
        <input type="hidden" name="sender_schspt_succeed" value="<?= $sender_schspt_succeed; ?>" />
        <input type="hidden" name="sender_schspt_message" value="<?= $sender_schspt_message; ?>" />
        
        </form>
        
        <script type="text/javascript" language="javascript">
		document.send_transaksi.submit();
		</script>
<?PHP		
		/*		
		$redirect_path	= "";
		$redirect_icon	= "images/icon_true.png";
		$redirect_url	= "mainpage.php?pl=transaction_src_idsisda";
		$redirect_text	= "Transaksi berhasil dilakukan";
		
		$need_redirect	= true;
		include_once ("include/redirect.php");
		*/
?>



<?PHP
		
	}	
	

} else { //owned by: if(isset($_SESSION["id"]) && $_SESSION["privilege"] == "2") {

	echo "<center>Silakan lakukan proses login, Anda belum login</center>";
	
	//header("location:index.php");
}

?>