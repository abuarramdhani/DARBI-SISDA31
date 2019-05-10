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
	
	$daful_succeed = "";
	//echo "subtotal_daful: ".$_POST["subtotal_daful"];
	
	if(!empty($_POST["subtotal_daful"]) && $_POST["subtotal_daful"] != 0) {
	
		
	
		$tahun_daftar_ulang_enc	= mysql_real_escape_string($_POST["year_daftar_ulang"]);
		
		if($tahun_daftar_ulang_enc != "") {
	
			$subtotal_daful_for_send	= mysql_real_escape_string($_POST["subtotal_daful"]);
			$subtotal_daful_enc			= mysql_real_escape_string($_POST["subtotal_daful"]);
			
			$subtotal_daful				= $_POST["subtotal_daful"];
			$subtotal_daful_enc			= mysql_real_escape_string($subtotal_daful);
			
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
			
				$go_proc_daful	= "ok";		
				$go_item_daful	= "
										daful,
										kegiatan_daful,
										peralatan_daful,
										seragam_daful,
										";
				$go_value_daful	= "														
										'1',
										'$transk_daful_kegiatan',
										'$transk_daful_peralatan',
										'$transk_daful_seragam',
										";
			
			} else {
			
				$daful_succeed = "gagal";
				$daful_message = "[Untuk dicatat: Kasus transaksi daftar ulang jenis <b>2</b>]<br> Update table tunggakan untuk daftar ulang tidak berhasil";			
			
				$go_proc_daful	= "gak ok";		
				$go_item_daful	= "";
				$go_value_daful	= "";
			}
			
		} else {
		
			$daful_succeed = "gagal";
			$daful_message = "[Untuk dicatat: Kasus transaksi daftar ulang jenis <b>3</b>]<br>Tahun pembayaran untuk Daftar ulang tidak dipilih, proses tidak dapat dilanjutkan";
			
			$go_proc_daful	= "gak ok";		
			$go_item_daful	= "";
			$go_value_daful	= "";
		
		}
		
	} else { //owned by: if(!empty($_POST["subtotal_daful"]) && $_POST["subtotal_daful"] != 0) { 
	
		$go_proc_daful	= "gak ok";		
		$go_item_daful	= "";
		$go_value_daful	= "";
			
	}
	
	//---------------------------//
	//--------END OF DAFUL-------//
	//---------------------------//
	
	
	///////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////
	//////////////////////////BIAYA MASUK//////////////////////////////
	///////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////
	if(!empty($_POST["subtotal_bima"]) && $_POST["subtotal_bima"] != 0) {
	
		$bima_succeed = "";
	
		$subtotal_bima_for_send				= mysql_real_escape_string($_POST["subtotal_bima"]);
	
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
										jenis_tunggakan = 'biaya_masuk' and
										status = '1'
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
											jenis_tunggakan = 'biaya_masuk' and 
											status = '1'
											";
											
		$query_update_tunggakan_bima	= mysqli_query($mysql_connect, $src_update_tunggakan_bima) or die(mysql_error());
		
		if($query_update_tunggakan_bima) {
		
			$go_proc_bima	= "ok";	
				
			$go_item_bima	= "
								bima,
								pengembangan_bima,
								kegiatan_bima,
								peralatan_bima,
								seragam_bima,
								paket_bima,
								";
			$go_value_bima	= "
								'1',
								'$transk_bima_pengembangan',
								'$transk_bima_kegiatan',
								'$transk_bima_peralatan',
								'$transk_bima_seragam',
								'$transk_bima_paket',
								";
			
		} else {
		
			$bima_succeed = "gagal";
			$bima_message = "[Untuk dicatat: Kasus transaksi biaya masuk jenis <b>2</b>]<br> Update table <b>Tunggakan untuk Biaya Masuk</b> tidak berhasil";
		
			$go_proc_bima	= "gak ok";	
			$go_item_bima	= "";
			$go_value_bima	= "";
		}
		
		//echo "bbb";
		
	} else { //owned by: if(!empty($_POST["subtotal_bima"]) && $_POST["subtotal_bima"] != 0) {
	
		$go_proc_bima	= "gak ok";	
		$go_item_bima	= "";
		$go_value_bima	= "";
	
	}
	
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
	
	//echo "<br>subtotal: ".$_POST["subtotal_spp"]."<br>";
	if(!empty($_POST["subtotal_spp"]) && $_POST["subtotal_spp"] != 0 && !empty($_POST["bulan_spp"])) {
	
		//$src_year_spp						= empty($_POST["year_spp"]) ? 0 : $_POST["year_spp"];
		//$year_spp							= substr($src_year_spp,0,11);
		//$year_spp_enc						= mysql_real_escape_string($year_spp);
		
		//all data payment for spp is in $bulan_spp value
		$bulan_spp							= empty($_POST["bulan_spp"]) ? 0 : $_POST["bulan_spp"];
		
		$count_bulan_spp = count($bulan_spp);
		//echo "<br>count_bulan_spp:".$count_bulan_spp."<br>";
		
		//Kite enolin dulu boss............
		$updated_value_spp			= 0;
		$updated_value_ks			= 0;
		$updated_value_elearning	= 0;
		$updated_value_ict			= 0;
		
		$src_total_tahun_spp		= "";
		$src_total_bulan_spp		= "";
		$src_jumlah_bulan_spp		= 0;
		
	
		for($i=0; $i < $count_bulan_spp; $i++) {
		
			$part_spp = explode("-",$bulan_spp[$i]);
			
			$get_nominal_spp 	= $part_spp[3];
			$get_prefix_spp		= $part_spp[2];
			$get_year_spp		= $part_spp[1];
			$get_month_spp		= $part_spp[0];
			
			//echo "<br>nom per bulan:".$get_nominal_spp."<br>";
			//Tahunnya jugalah....
			$new_update_year_spp = substr($get_year_spp,0,4)." - ".substr($get_year_spp,4,4);
			
			//kita butuh informasi detail dari masing-masing komponen pembayaran SPP, yaitu SPP, KS, E-learning dan ICT
			//karena nanti di DB transaksi, harus dipecah ke dalam 4 item itu
			$src_get_detail_spp		= "select spp,ict,elearning,ks from siswa_finance where no_sisda = '$no_sisda_enc' and periode = '$new_update_year_spp'";
			$query_get_detail_spp	= mysqli_query($mysql_connect, $src_get_detail_spp) or die(mysql_error());
			$row_get_detail_spp		= mysql_fetch_array($query_get_detail_spp);
			
			$share_ks 			= $row_get_detail_spp["ks"];
			$share_ict			= $row_get_detail_spp["ict"];
			$share_elearning	= $row_get_detail_spp["elearning"];
			$share_spp			= $row_get_detail_spp["spp"];
			
			//////////////
			if($get_nominal_spp <= $share_ks) {
			
				$new_share_ks			= $get_nominal_spp;
				$new_share_ict			= 0;
				$new_share_elearning	= 0;
				$new_share_spp			= 0;
				
			} else {
			
				$new_nom_pay_spp = $get_nominal_spp - $share_ks;
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
			
			//kita update dulu status tunggakan di tabel tunggakan sesuai dengan prefix terakhir mereka
			//Tapi sebelumnya bos, periapkan dulu prefixnya
			if($get_prefix_spp == 0) {$new_update_pref_spp = 7; } //Bayar sebelum waktunya
			if($get_prefix_spp == 1) {$new_update_pref_spp = 5; } //Bayar on time
			if($get_prefix_spp == 2) {$new_update_pref_spp = 6; } //Bayar telah
			if($get_prefix_spp == 3) {$new_update_pref_spp = 5; } //Bayar on time (special case)
			
			//Juga bulan yang mau di updatenya
			if($get_month_spp == "jul") { $new_update_month_spp = "july"; }
			if($get_month_spp == "aug") { $new_update_month_spp = "august"; }
			if($get_month_spp == "sep") { $new_update_month_spp = "september"; }
			if($get_month_spp == "oct") { $new_update_month_spp = "october"; }
			if($get_month_spp == "nov") { $new_update_month_spp = "november"; }
			if($get_month_spp == "dec") { $new_update_month_spp = "december"; }
			if($get_month_spp == "jan") { $new_update_month_spp = "january"; }
			if($get_month_spp == "feb") { $new_update_month_spp = "february"; }
			if($get_month_spp == "mar") { $new_update_month_spp = "march"; }
			if($get_month_spp == "apr") { $new_update_month_spp = "april"; }
			if($get_month_spp == "may") { $new_update_month_spp = "may"; }
			if($get_month_spp == "jun") { $new_update_month_spp = "june"; }
			
			//Juga value updatenya bro
			$new_update_nominal_spp = $new_update_pref_spp."-".$get_nominal_spp;
			
			//Here we go
			$src_update_prefix = "update tunggakan set $new_update_month_spp = '$new_update_nominal_spp' where no_sisda = '$no_sisda_enc' and periode = '$new_update_year_spp' and jenis_tunggakan = 'spp'";
			$query_update_prefix = mysqli_query($mysql_connect, $src_update_prefix) or die (mysql_error());
			
			//jumlah yang akan tertera di dalam slip kwitansi adalah value yang prefixnya sudah terupdate di database.
			//Yang gagal, tidak akan diproses di kwitansi
			//Dengan kata lain, untuk bulan tersebut, harus dilakukan transaksi ulang. blahhhhhh
			if($query_update_prefix) {
			
				$updated_value_spp 			= $updated_value_spp + $new_share_spp;
				$updated_value_ks 			= $updated_value_ks + $new_share_ks;
				$updated_value_elearning	= $updated_value_elearning + $new_share_elearning;
				$updated_value_ict 			= $updated_value_ict + $new_share_ict;
				
				//Kalau tahuna ajarannya berubah, baru ditambahkan
				//Kalau tetap, ya janganlah...gitu aja kok repot......
				$total_tahun_spp_checked = substr($src_total_tahun_spp,-12,11);
				
				if($total_tahun_spp_checked != $new_update_year_spp) {
					
					 $src_total_tahun_spp = $src_total_tahun_spp.$new_update_year_spp.",";
					  
				}
				
				$src_total_bulan_spp = $src_total_bulan_spp.$get_month_spp.",";
				
			}
		}
		
		$check_total_updated_spp_value = $updated_value_spp + $updated_value_ks + $updated_value_elearning + $updated_value_ict;
		//echo "<br>nominal=".$check_total_updated_spp_value."<br>";
		
		if($check_total_updated_spp_value != 0) {
		
			$go_proc_spp	= "ok";		
			$go_item_spp	= "
									spp,
									tahun_ajaran_spp,
									bulan_spp,
									jumlah_bulan_spp,
									spp_spp,
									ks_spp,
									elearning_spp,
									ict_spp,
									";
			$go_value_spp	= "														
									'1',
									'$src_total_tahun_spp',
									'$src_total_bulan_spp',
									'$count_bulan_spp',
									'$updated_value_spp',
									'$updated_value_ks',
									'$updated_value_elearning',
									'$updated_value_ict',
									";
		
		} else {
		
			$go_proc_spp	= "gak ok";		
			$go_item_spp	= "";
			$go_value_spp	= "";
			
		}
		
	} else {
	
		$go_proc_spp	= "gak ok";		
		$go_item_spp	= "";
		$go_value_spp	= "";	
	
	}
	
	
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
	
	if(!empty($_POST["subtotal_catering"]) && $_POST["subtotal_catering"] != 0 && !empty($_POST["bulan_catering"])) {
		
		$bulan_catering	= empty($_POST["bulan_catering"]) ? 0 : $_POST["bulan_catering"];
		
		$count_bulan_catering = count($bulan_catering); 
		
		$count_bulan_catering_succeed 	= 0;
		$bulan_catering_succeed			= "";
		$tahun_catering_succeed			= "";
		$nominal_catering_succeed		= 0;
		
		for($i=0; $i < $count_bulan_catering; $i++) {
		
			$part_catering = explode("-",$bulan_catering[$i]);
			
			$get_nominal_catering 	= $part_catering[3];
			$get_prefix_catering	= $part_catering[2];
			$get_year_catering		= $part_catering[1];
			$get_month_catering		= $part_catering[0];
			
			//Tahunnya jugalah....
			$new_update_year_catering = substr($get_year_catering,0,4)." - ".substr($get_year_catering,4,4);
			
			//kita update dulu status tunggakan di tabel tunggakan sesuai dengan prefix terakhir mereka
			//Tapi sebelumnya bos, periapkan dulu prefixnya
			if($get_prefix_catering == 0) {$new_update_pref_catering = 7; } //Bayar sebelum waktunya
			if($get_prefix_catering == 1) {$new_update_pref_catering = 5; } //Bayar on time
			if($get_prefix_catering == 2) {$new_update_pref_catering = 6; } //Bayar telah
			if($get_prefix_catering == 3) {$new_update_pref_catering = 5; } //Bayar on time (special case)
			
			//Juga bulan yang mau di updatenya
			if($get_month_catering == "jul") { $new_update_month_catering = "jul_cataj"; }
			if($get_month_catering == "aug") { $new_update_month_catering = "aug_cataj"; }
			if($get_month_catering == "sep") { $new_update_month_catering = "sep_cataj"; }
			if($get_month_catering == "oct") { $new_update_month_catering = "oct_cataj"; }
			if($get_month_catering == "nov") { $new_update_month_catering = "nov_cataj"; }
			if($get_month_catering == "dec") { $new_update_month_catering = "dec_cataj"; }
			if($get_month_catering == "jan") { $new_update_month_catering = "jan_cataj"; }
			if($get_month_catering == "feb") { $new_update_month_catering = "feb_cataj"; }
			if($get_month_catering == "mar") { $new_update_month_catering = "mar_cataj"; }
			if($get_month_catering == "apr") { $new_update_month_catering = "apr_cataj"; }
			if($get_month_catering == "may") { $new_update_month_catering = "may_cataj"; }
			if($get_month_catering == "jun") { $new_update_month_catering = "jun_cataj"; }
			
			//Juga value updatenya bro
			$new_update_nominal_catering = $new_update_pref_catering."-".$get_nominal_catering;
			
			//Here we go
			$src_update_prefix_catering 	= "update tunggakan set $new_update_month_catering = '$new_update_nominal_catering' where no_sisda = '$no_sisda_enc' and periode = '$new_update_year_catering' and jenis_tunggakan = 'catering'";
			$query_update_prefix_catering 	= mysqli_query($mysql_connect, $src_update_prefix_catering) or die (mysql_error());
			
			if($query_update_prefix_catering) {
			
				//Pokoke kita cuma mau hitung yang sukses doangan, yoa brow....
				//Supaya nggak bentrok dengan ibu/bapa kasir yang terhormat
				$count_bulan_catering_succeed 	= $count_bulan_catering_succeed + 1;
				$bulan_catering_succeed			= $bulan_catering_succeed.$get_month_catering.",";
				$nominal_catering_succeed		= $nominal_catering_succeed + $get_nominal_catering;
				$cur_prov_catering				= $get_month_catering."_provider";
				
				if($tahun_catering_succeed != $get_year_catering) {
					
					 $tahun_catering_succeed = $tahun_catering_succeed.$get_year_catering.",";
					  
				}
				
				$src_prov_catering 		= "select $cur_prov_catering from tunggakan where no_sisda = '$no_sisda_enc' and periode = '$new_update_year_catering' and jenis_tunggakan = 'catering'";
				$query_prov_catering	= mysqli_query($mysql_connect, $src_prov_catering) or die(mysql_error());
				$row_prov_catering		= mysql_fetch_array($query_prov_catering);
				$prov_catering			= $row_prov_catering[$cur_prov_catering];
				
			}
			
		}
		
		$go_proc_catering	= "ok";		
		$go_item_catering	= "
								catering,
								jumlah_bulan_catering,
								bulan_catering,
								nom_catering,
								penyedia_catering,
								tahun_ajaran_catering,
								";
		$go_value_catering	= "														
								'1',
								'$count_bulan_catering_succeed',
								'$bulan_catering_succeed',
								'$nominal_catering_succeed',
								'$prov_catering',
								'$tahun_catering_succeed',
								";
	
	} else {
	
		$go_proc_catering	= "gak ok";		
		$go_item_catering	= "";
		$go_value_catering	= "";	
	
	}
	
	
	///////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////
	//////////////////////////--ANTAR JEMPUT--/////////////////////////
	///////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////
	
	//Related files to the cases below (tunggakan in antar_jemput, ect) ++++++++++++++++++++++++++
	//////////////////////////////////////////////////////////////////////////////
	////////Please check -> include/define_month_spp.php executed in proc_login.php///////
	////////Please check -> include/check_spp_arrear.php executed in proc_login.php///////
	////////Please check -> page/proc_reg_adm_siswa.php///////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////
	
	if(!empty($_POST["subtotal_antar_jemput"]) && $_POST["subtotal_antar_jemput"] != 0 && !empty($_POST["bulan_antar_jemput"])) {
		
		$bulan_antar_jemput	= empty($_POST["bulan_antar_jemput"]) ? 0 : $_POST["bulan_antar_jemput"];
		
		$count_bulan_antar_jemput = count($bulan_antar_jemput); 
		
		$count_bulan_antar_jemput_succeed 	= 0;
		$bulan_antar_jemput_succeed			= "";
		$tahun_antar_jemput_succeed			= "";
		$nominal_antar_jemput_succeed		= 0;
		
		for($i=0; $i < $count_bulan_antar_jemput; $i++) {
		
			$part_antar_jemput = explode("-",$bulan_antar_jemput[$i]);
			
			$get_nominal_antar_jemput 	= $part_antar_jemput[3];
			$get_prefix_antar_jemput	= $part_antar_jemput[2];
			$get_year_antar_jemput		= $part_antar_jemput[1];
			$get_month_antar_jemput		= $part_antar_jemput[0];
			
			//Tahunnya jugalah....
			$new_update_year_antar_jemput = substr($get_year_antar_jemput,0,4)." - ".substr($get_year_antar_jemput,4,4);
			
			//kita update dulu status tunggakan di tabel tunggakan sesuai dengan prefix terakhir mereka
			//Tapi sebelumnya bos, periapkan dulu prefixnya
			if($get_prefix_antar_jemput == 0) {$new_update_pref_antar_jemput = 7; } //Bayar sebelum waktunya
			if($get_prefix_antar_jemput == 1) {$new_update_pref_antar_jemput = 5; } //Bayar on time
			if($get_prefix_antar_jemput == 2) {$new_update_pref_antar_jemput = 6; } //Bayar telah
			if($get_prefix_antar_jemput == 3) {$new_update_pref_antar_jemput = 5; } //Bayar on time (special case)
			
			//Juga bulan yang mau di updatenya
			if($get_month_antar_jemput == "jul") { $new_update_month_antar_jemput = "jul_cataj"; }
			if($get_month_antar_jemput == "aug") { $new_update_month_antar_jemput = "aug_cataj"; }
			if($get_month_antar_jemput == "sep") { $new_update_month_antar_jemput = "sep_cataj"; }
			if($get_month_antar_jemput == "oct") { $new_update_month_antar_jemput = "oct_cataj"; }
			if($get_month_antar_jemput == "nov") { $new_update_month_antar_jemput = "nov_cataj"; }
			if($get_month_antar_jemput == "dec") { $new_update_month_antar_jemput = "dec_cataj"; }
			if($get_month_antar_jemput == "jan") { $new_update_month_antar_jemput = "jan_cataj"; }
			if($get_month_antar_jemput == "feb") { $new_update_month_antar_jemput = "feb_cataj"; }
			if($get_month_antar_jemput == "mar") { $new_update_month_antar_jemput = "mar_cataj"; }
			if($get_month_antar_jemput == "apr") { $new_update_month_antar_jemput = "apr_cataj"; }
			if($get_month_antar_jemput == "may") { $new_update_month_antar_jemput = "may_cataj"; }
			if($get_month_antar_jemput == "jun") { $new_update_month_antar_jemput = "jun_cataj"; }
			
			//Juga value updatenya bro
			$new_update_nominal_antar_jemput = $new_update_pref_antar_jemput."-".$get_nominal_antar_jemput;
			
			//Here we go
			$src_update_prefix_antar_jemput 	= "update tunggakan set $new_update_month_antar_jemput = '$new_update_nominal_antar_jemput' where no_sisda = '$no_sisda_enc' and periode = '$new_update_year_antar_jemput' and jenis_tunggakan = 'antar_jemput'";
			$query_update_prefix_antar_jemput 	= mysqli_query($mysql_connect, $src_update_prefix_antar_jemput) or die (mysql_error());
			
			if($query_update_prefix_antar_jemput) {
			
				//Pokoke kita cuma mau hitung yang sukses doangan, yoa brow....
				//Supaya nggak bentrok dengan ibu/bapa kasir yang terhormat
				$count_bulan_antar_jemput_succeed 	= $count_bulan_antar_jemput_succeed + 1;
				$bulan_antar_jemput_succeed			= $bulan_antar_jemput_succeed.$get_month_antar_jemput.",";
				$nominal_antar_jemput_succeed		= $nominal_antar_jemput_succeed + $get_nominal_antar_jemput;
				$cur_prov_antar_jemput				= $get_month_antar_jemput."_provider";
				
				if($tahun_antar_jemput_succeed != $get_year_antar_jemput) {
					
					 $tahun_antar_jemput_succeed = $tahun_antar_jemput_succeed.$get_year_antar_jemput.",";
					  
				}
				
				$src_prov_antar_jemput 		= "select $cur_prov_antar_jemput from tunggakan where no_sisda = '$no_sisda_enc' and periode = '$new_update_year_antar_jemput' and jenis_tunggakan = 'antar_jemput'";
				$query_prov_antar_jemput	= mysqli_query($mysql_connect, $src_prov_antar_jemput) or die(mysql_error());
				$row_prov_antar_jemput		= mysql_fetch_array($query_prov_antar_jemput);
				$prov_antar_jemput			= $row_prov_antar_jemput[$cur_prov_antar_jemput];
				//echo "<h2>src_prov_antar_jemput = ".$src_prov_antar_jemput."</h2>";
			}
			
		}
		
		$go_proc_antar_jemput	= "ok";		
		$go_item_antar_jemput	= "
									antar_jemput,
									jumlah_bulan_antar_jemput,
									bulan_antar_jemput,
									nom_antar_jemput,
									supir,
									tahun_ajaran_antar_jemput,
									";
		$go_value_antar_jemput	= "														
									'1',
									'$count_bulan_antar_jemput_succeed',
									'$bulan_antar_jemput_succeed',
									'$nominal_antar_jemput_succeed',
									'$prov_antar_jemput',
									'$tahun_antar_jemput_succeed',
									";
	
	} else {
			
		$go_proc_antar_jemput	= "gak ok";		
		$go_item_antar_jemput	= "";
		$go_value_antar_jemput	= "";
		
	}
	
	
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
		
		$go_proc_ruba			= "ok";	
		$go_item_ruba 			= "
									ruba,
									zakat_mal_ruba,
									zakat_profesi_ruba,
									infaq_sho_ruba,
									wakaf_ruba,
									zakat_fitrah_ruba,
									fidyah_ruba,
									baksos_ramadhan_ruba,
									qurban_ruba,
									";
		$go_value_ruba	= "
									'1',
									'$zakat_mal_ruba_enc',
									'$zakat_profesi_ruba_enc',
									'$infaq_sho_ruba_enc',
									'$wakaf_ruba_enc',
									'$zakat_fitrah_ruba_enc',
									'$fidyah_ruba_enc',
									'$baksos_ramadhan_ruba_enc',
									'$qurban_ruba_enc',
									";
	
	} else {
	
		$go_proc_ruba = "";
		$go_item_ruba = "";
		$go_value_ruba	= "";
		
	}
	
	///////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////
	///////////////////////////////SCHSPT//////////////////////////////
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
		
		$ket_schspt							= $_POST["ket_schspt"];
		$ket_schspt_enc						= mysql_real_escape_string($ket_schspt); 
		$add_comma_ket_schspt				= $ket_schspt_enc . ",";
		
		if($ket_schspt != "") {
		
			$src_update_ket_schspt 		= "update siswa_finance set keterangan_schspt = concat('$add_comma_ket_schspt',keterangan_schspt) where no_sisda = '$no_sisda_enc' and jenjang = '$jenjang_enc'";
			//echo $src_update_ket_schspt;
			
			$query_update_ket_schspt 	= mysqli_query($mysql_connect, $src_update_ket_schspt) or die(mysql_error());
		
		}
		
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
		
		$cetak_nom_item_schspt = "";
		
		while($get_schspt	= mysql_fetch_array($query_get_schspt)) {
				
			$cur_i_sch_sup	= $i_sch_sup++;
		
			//Define the array as the post variable that received from transaction page
			$chk_zero_sch_sup = empty($_POST["sch_sup_".$cur_i_sch_sup."_schspt"]) ? 0 : $_POST["sch_sup_".$cur_i_sch_sup."_schspt"];
			//$array[] = $_POST["sch_sup_".$cur_i_sch_sup."_schspt"];	
			$array[] = $chk_zero_sch_sup;	
			
			if($chk_zero_sch_sup == 0) {
			
				$src_get_item = "";
				
			} else {
			
				$src_get_item = $get_schspt["item_lwr"];
				$src_sch_item_printing = $src_sch_item_printing.$src_get_item.",";
				
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
										item_school_support,
										ket_school_support
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
										'$chk_zero_sch_sup',
										'$src_get_item',
										'$ket_schspt_enc'
										$if_transfer_value
										)";
								
				$query_input_schspt	= mysqli_query($mysql_connect, $src_input_schspt) or die(mysql_error());
				
			}
			
			$array_item[] = $src_get_item;
			
			//ini untuk ditampilkan di kuitansi. supaya masing-masing school support item dan nominalnya gak digabung.
			$src_chk_zero_sch_sup = "Rp ".number_format($chk_zero_sch_sup,0,",",".").",-";
			if($chk_zero_sch_sup != 0) { $cetak_nom_item_schspt = $cetak_nom_item_schspt.$src_get_item." = ".$src_chk_zero_sch_sup.", "; } 
			
			//echo "nom_item:".$chk_zero_sch_sup."<br>";
			//echo "item:".$src_get_item."<br>";
		}	
		
		//There are two conditions with additional school support item.
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
			
			$src_input_schspt_add	= "insert into transaksi (
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
									'$nama_item_schspt_enc'
									$if_transfer_value
									)";
								
				$query_input_schspt_add	= mysqli_query($mysql_connect, $src_input_schspt_add) or die(mysql_error());
		
		} else {
		
			//$school_support without additional item
			$school_support = implode(",", $array); 
			//echo "nom_schspt = <h1>".$school_support."</h1>";
			$all_item = implode(",",$array_item); 
			//echo "item_schspt = <h1>".$all_item."</h1>";
			//echo "<h1>nom_semua = ".$cetak_nom_item_schspt."</h1>";
			
			$sch_item_printing = $src_sch_item_printing;
			
		}
		
		if($query_input_schspt || $query_input_schspt_add) {
		
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
	
	
	
	$src_trask_all_data	= "
							insert into transaksi (
	
							$go_item_daful
							$go_item_bima
							$go_item_spp
							$go_item_catering
							$go_item_antar_jemput
							$go_item_ruba
							$if_transfer_item
							no_sisda, 
							no_trs,
							kasir,
							tanggal_transaksi,
							periode,
							nama_siswa,
							jenjang,
							tingkat,
							kelas, 
							teknik_pembayaran							
							
							) values (
							
							$go_value_daful
							$go_value_bima
							$go_value_spp
							$go_value_catering
							$go_value_antar_jemput
							$go_value_ruba							
							$if_transfer_value
							'$no_sisda_enc',
							'$src_no_kwintansi',
							'$who_operator_enc',
							'$tanggal_transaksi_enc',
							'$periode_trans',
							'$nama_siswa_enc',
							'$jenjang_enc',
							'$tingkat_enc',
							'$kelas_enc',
							'$teknik_pembayaran_enc'
							
							)";
							
	//echo "<br>".$src_trask_all_data."<br>";
	//echo "<br>".$go_item_catering.$go_value_catering."<br>";
	$query_trask_all_data	= mysqli_query($mysql_connect, $src_trask_all_data) or die(mysql_error());	
	
	///////////////////////////////
	///Send to print out process///
	///////////////////////////////
	
	if(
		$daful_succeed == "gagal" && 
		$bima_succeed == "gagal" && 
		$spp_succeed == "gagal" && 
		$catering_succeed == "gagal" && 
		$antar_jemput_succeed == "gagal" && 
		$ruba_succeed == "gagal" && 
		$schspt_succeed == "gagal") {
	
		$redirect_path	= "";
		$redirect_icon	= "images/icon_false.png";
		$redirect_url	= "mainpage.php?pl=transaction&no=$no_sisda_enc";
		$redirect_text	= "Tidak data transaksi yang berhasil dilakukan. Silakan ulangi lagi proses transaksi!";
		
		$need_redirect	= true;
		include_once ("include/redirect.php");
		
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
		
		/*
		'$src_total_tahun_spp',
									'$src_total_bulan_spp',
									'$src_jumlah_bulan_spp',
									'$updated_value_spp',
									'$updated_value_ks',
									'$updated_value_elearning',
									'$updated_value_ict',
		*/
		
		$sender_ks						= empty($updated_value_ks) ? "" : $updated_value_ks;								//echo "total_ks: ".$updated_value_ks."<br>";
				
		$src_updated_value_spp			= empty($updated_value_spp) ? "" : $updated_value_spp;
		$src_updated_value_elearning	= empty($updated_value_elearning) ? "" : $updated_value_elearning;
		$src_updated_value_ict			= empty($updated_value_ict) ? "" : $updated_value_ict;
		$src_sender_spp					= $src_updated_value_spp + $src_updated_value_elearning + $src_updated_value_ict;
		
		$sender_spp						= empty($src_sender_spp) ? "" : $src_sender_spp;									//echo "sender_spp: ".$sender_spp."<br>";
		//$sender_spp					= empty($subtotal_spp_enc) ? "" : $subtotal_spp_enc;								echo "sender_spp: ".$sender_spp."<br>";
		$sender_spp_bulan				= empty($src_total_bulan_spp) ? "" : $src_total_bulan_spp;							//echo "sender_spp_bulan: ".$src_total_bulan_spp."<br>";
		$sender_spp_succeed				= empty($spp_succeed) ? "" : $spp_succeed;											//echo "sender_spp_succeed: ".$sender_spp_succeed."<br>";
		$sender_spp_message				= empty($spp_message) ? "" : $spp_message;											//echo "sender_spp_message: ".$sender_spp_message."<br><br>";
		//////////
		$sender_catering				= empty($nominal_catering_succeed) ? "" : $nominal_catering_succeed; 						//echo "sender_catering: ". $sender_catering."<br>";
		$sender_catering_bulan			= empty($bulan_catering_succeed) ? "" : $bulan_catering_succeed; 			//echo "sender_catering_bulan: ". $sender_catering_bulan."<br>";
		$sender_catering_succeed		= empty($catering_succeed) ? "" : $catering_succeed; 								//echo "sender_catering_succeed: ". $sender_catering_succeed."<br>";
		$sender_catering_message		= empty($catering_message) ? "" : $catering_message; 								//echo "sender_catering_message: ". $sender_catering_message."<br><br>";
		//////////
		$sender_antar_jemput			= empty($nominal_antar_jemput_succeed) ? "" : $nominal_antar_jemput_succeed;				//echo "sender_antar_jemput: ". $sender_antar_jemput."<br>";
		$sender_antar_jemput_bulan		= empty($bulan_antar_jemput_succeed) ? "" : $bulan_antar_jemput_succeed;	//echo "sender_antar_jemput_bulan: ". $sender_antar_jemput_bulan."<br>";	
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
		$sender_schspt_item				= empty($sch_item_printing) ? "" : $sch_item_printing;		//echo "sender_schspt_item: ". $sender_schspt_item."<br>";
		$sender_schspt_succeed			= empty($schspt_succeed) ? "" : $schspt_succeed;			//echo "sender_schspt_succeed: ". $sender_schspt_succeed."<br>";
		$sender_schspt_message			= empty($schspt_message) ? "" : $schspt_message;			//echo "sender_schspt_message: ". $sender_schspt_message."<br><br>";
		$sender_cetak_nom_item_schspt	= empty($cetak_nom_item_schspt) ? "" : $cetak_nom_item_schspt;
		$sender_ket_schspt_enc			= empty($ket_schspt_enc) ? "" : $ket_schspt_enc;
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
        <input type="hidden" name="sender_cetak_nom_item_schspt" value="<?= $sender_cetak_nom_item_schspt; ?>" />
        <input type="hidden" name="sender_ket_schspt_enc" value="<?= $sender_ket_schspt_enc; ?>" />
        
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
	
} else {

	echo "[".$_SESSION["id"]."][".$_SESSION["privilege"]."]";
 	echo "ho";
}
?>