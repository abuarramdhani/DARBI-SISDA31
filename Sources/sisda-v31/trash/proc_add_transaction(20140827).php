<?PHP
session_start();

if(isset($_SESSION["id"]) && $_SESSION["privilege"] == "2") {

	///////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////
	//////////////////////////ALL VARIABLES////////////////////////////
	///////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////
	
	//-------> student data and transfer method
	
	$no_sisda 							= $_POST["no_sisda"];
	$no_sisda_enc						= mysql_real_escape_string($no_sisda);
	
	$nama_siswa							= $_POST["nama_siswa"];
	$nama_siswa_enc						= mysql_real_escape_string($nama_siswa);
	
	$jenjang							= $_POST["jenjang"];
	$jenjang_enc						= mysql_real_escape_string($jenjang);
	
	$tingkat							= $_POST["tingkat"];
	$tingkat_enc						= mysql_real_escape_string($tingkat);
	
	$tanggal_transaksi					= $_POST["tahun_transaksi"]."-".$_POST["bulan_transaksi"]."-".$_POST["tanggal_transaksi"];
	$tanggal_transaksi_enc				= mysql_real_escape_string($tanggal_transaksi);
	
	$teknik_pembayaran					= $_POST["teknik_pembayaran"];
	$teknik_pembayaran_enc				= mysql_real_escape_string($teknik_pembayaran);
	
	//$tanggal tranfer not always to be sent here
	//it's depend on the teknik_pembayaran chosen.
	if($teknik_pembayaran == "transfer") {
	
		if(!empty($_POST["tanggal_transfer"]) && !empty($_POST["bulan_transfer"]) && !empty($_POST["tahun_transfer"]) && !empty($_POST["bank_tujuan"])) {	
			
			$tanggal_transfer				= $_POST["tahun_transfer"]."-".$_POST["bulan_transfer"]."-".$_POST["tanggal_transfer"];
			$tanggal_transfer_enc			= mysql_real_escape_string($tanggal_transfer);
			
			$bank_tujuan					= $_POST["bank_tujuan"];
			$bank_tujuan_enc				= mysql_real_escape_string($bank_tujuan);	
			
			$if_transfer_item	= ",tanggal_transfer, bank_tujuan";
			$if_transfer_value	= ",'$tanggal_transfer_enc','$bank_tujuan_enc'";
			
		} else {
		
			echo " Data bank tujuan atau tanggal transfer tidak lengkap";
			
		}
		
	} else if ($teknik_pembayaran == "tunai") {
	
		$tanggal_transfer_enc			= "";
		$bank_tujuan_enc				= "";
		
		$if_transfer_item				= "";
		$if_transfer_value				= "";
		
	}
	
	
	///////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////
	//////////////////////////DAFTAR ULANG/////////////////////////////
	///////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////
	
	//If only there is at least one value filled in Daftar Ulang section, we proccess the data to database.
	//if $_POST["subtotal_daful"] empty or 0, it means all of Daftar Ulang fields are empty.
	//And we do not need to do something with this
	//The same thing goes to other sections
	
	if(!empty($_POST["subtotal_daful"]) && $_POST["subtotal_daful"] != 0) {
	
		$tahun_daftar_ulang_enc	= mysql_real_escape_string($_POST["year_daftar_ulang"]);
		
		if($tahun_daftar_ulang_enc != "") {
	
			$subtotal_daful_enc					= mysql_real_escape_string($_POST["subtotal_daful"]);
			
			$kegiatan_daful						= empty($_POST["nom_daful"]) ? 0 : $_POST["nom_daful"];
			$kegiatan_daful_enc					= mysql_real_escape_string($kegiatan_daful);
			
			
			
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
			
			echo "<h1>exixt kegiatan:".$exist_db_daful_kegiatan." hehe</h1>";
			if($exist_db_daful_kegiatan != 0) {
			
				if($subtotal_daful_enc == $exist_db_daful_kegiatan ) {
				
					$cur_db_daful_kegiatan	= 0;
					$transk_daful_kegiatan	= $exist_db_daful_kegiatan;
					$subtotal_daful_enc		= 0;
					echo "<h1>exixt peralatan:aaa</h1>";
				
				} else if($subtotal_daful_enc > $exist_db_daful_kegiatan){
				
					$cur_db_daful_kegiatan	= 0;
					$transk_daful_kegiatan	= $exist_db_daful_kegiatan;
					$subtotal_daful_enc		= $subtotal_daful_enc - $exist_db_daful_kegiatan;
					echo "<h1>exixt peralatan:bbb</h1>";
					
				} else if($subtotal_daful_enc < $exist_db_daful_kegiatan){
				
					$cur_db_daful_kegiatan	= $exist_db_daful_kegiatan - $subtotal_daful_enc;
					$transk_daful_kegiatan	= $cur_db_daful_kegiatan;
					$subtotal_daful_enc		= 0;
					echo "<h1>exixt peralatan:ccc</h1>";
					
				}
				
			} else {
			
				$cur_db_daful_kegiatan	= 0;
				$transk_daful_kegiatan	= 0;
				
			}
			
			echo "<h1>exixt peralatan:".$exist_db_daful_peralatan." hehe</h1>";
			echo "<h1>subtotal daful:".$subtotal_daful_enc." hehe</h1>";
			if($exist_db_daful_peralatan != 0) {
			
				if($subtotal_daful_enc	!= 0) {
				
					if($subtotal_daful_enc == $exist_db_daful_peralatan ) {
				
						$cur_db_daful_peralatan	= 0;
						$transk_daful_peralatan	= $exist_db_daful_peralatan;
						$subtotal_daful_enc		= 0;
						echo "<h1>exixt peralatan:ddd</h1>";
					
					} else if($subtotal_daful_enc > $exist_db_daful_peralatan){
					
						$cur_db_daful_peralatan	= 0;
						$transk_daful_peralatan	= $exist_db_daful_peralatan;
						$subtotal_daful_enc		= $subtotal_daful_enc - $exist_db_daful_peralatan;
						echo "<h1>exixt peralatan:eee</h1>";
						
					} else if($subtotal_daful_enc < $exist_db_daful_peralatan){
					
						$cur_db_daful_peralatan	= $exist_db_daful_peralatan - $subtotal_daful_enc;
						$transk_daful_peralatan	= $cur_db_daful_peralatan;
						$subtotal_daful_enc		= 0;
						echo "<h1>exixt peralatan:fff</h1>";
						
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
						echo "<h1>exixt peralatan:ggg</h1>";
					
					} else if($subtotal_daful_enc > $exist_db_daful_seragam){
					
						$cur_db_daful_seragam	= 0;
						$transk_daful_seragam	= $exist_db_daful_seragam;
						$subtotal_daful_enc		= $subtotal_daful_enc - $exist_db_daful_seragam;
						echo "<h1>exixt peralatan:hhh</h1>";
						
					} else if($subtotal_daful_enc < $exist_db_daful_seragam){
					
						$cur_db_daful_seragam	= $exist_db_daful_seragam - $subtotal_daful_enc;
						$transk_daful_seragam	= $cur_db_daful_seragam;
						$subtotal_daful_enc		= 0;
						echo "<h1>exixt peralatan:lll</h1>";
						
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
										nama_siswa,
										jenjang,
										tingkat,
										tanggal_transaksi, 
										teknik_pembayaran, 
										kegiatan_daful,
										peralatan_daful,
										seragam_daful,
										tanggal_bayar_berikut_daful,
										jenis_transaksi
										$if_transfer_item
										) values (
										'$no_sisda_enc', 
										'$nama_siswa_enc',
										'$jenjang_enc',
										'$tingkat_enc',
										'$tanggal_transaksi_enc', 
										'$teknik_pembayaran_enc',								
										'$transk_daful_kegiatan',
										'$transk_daful_peralatan',
										'$transk_daful_seragam',
										'$tanggal_bayar_berikut_daful_enc',
										'daful'
										$if_transfer_value
										)";
				$query_input_daful	= mysqli_query($mysql_connect, $src_input_daful) or die(mysql_error());
				
				if($query_input_daful) $succeed = true;
			
			}
			
		} else {
		
			echo "Tahun pembayaran untuk Daftar ulang tidak dipilih, proses tidak dapat dilanjutkan";
		}
	}
	
	///////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////
	//////////////////////////BIAYA MASUK//////////////////////////////
	///////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////
	if(!empty($_POST["subtotal_bima"]) && $_POST["subtotal_bima"] != 0) {
	
		$subtotal_bima_enc					= mysql_real_escape_string($_POST["subtotal_bima"]);
	
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
		$exist_db_bima_pengembangan	= $row_get_tunggakan_bima["nom_pengembangan"];
		$exist_db_bima_kegiatan		= $row_get_tunggakan_bima["nom_kegiatan"];
		$exist_db_bima_peralatan	= $row_get_tunggakan_bima["nom_peralatan"];
		$exist_db_bima_seragam		= $row_get_tunggakan_bima["nom_seragam"];
		$exist_db_bima_paket		= $row_get_tunggakan_bima["nom_paket"];
		
		echo "<h1>exixt pengembangan:".$exist_db_bima_pengembangan." hehe</h1>";
		if($exist_db_bima_pengembangan != 0) {
		
			if($subtotal_bima_enc == $exist_db_bima_pengembangan ) {
			
				$cur_db_bima_pengembangan	= 0;
				$transk_bima_pengembangan	= $exist_db_bima_pengembangan;
				$subtotal_bima_enc			= 0;
				echo "<h1>exixt pengembangan:aaa</h1>";
			
			} else if($subtotal_bima_enc > $exist_db_bima_pengembangan){
			
				$cur_db_bima_pengembangan	= 0;
				$transk_bima_pengembangan	= $exist_db_bima_pengembangan;
				$subtotal_bima_enc			= $subtotal_bima_enc - $exist_db_bima_pengembangan;
				echo "<h1>exixt pengembangan:bbb</h1>";
				
			} else if($subtotal_bima_enc < $exist_db_bima_pengembangan){
			
				$cur_db_bima_pengembangan	= $exist_db_bima_pengembangan - $subtotal_bima_enc;
				$transk_bima_pengembangan	= $cur_db_bima_pengembangan;
				$subtotal_bima_enc			= 0;
				echo "<h1>exixt pengembangan:ccc</h1>";
				
			}
			
		} else {
		
			$cur_db_bima_pengembangan	= 0;
			$transk_bima_pengembangan	= 0;
			
		}
		
		echo "<h1>exixt pengembangan:".$exist_db_bima_pengembangan." hehe</h1>";
		echo "<h1>subtotal bima:".$subtotal_bima_enc." hehe</h1>";
		if($exist_db_bima_kegiatan != 0) {
		
			if($subtotal_bima_enc	!= 0) {
			
				if($subtotal_bima_enc == $exist_db_bima_kegiatan ) {
			
					$cur_db_bima_kegiatan	= 0;
					$transk_bima_kegiatan	= $exist_db_bima_kegiatan;
					$subtotal_bima_enc		= 0;
					echo "<h1>exixt kegiatan:ddd</h1>";
				
				} else if($subtotal_bima_enc > $exist_db_bima_kegiatan){
				
					$cur_db_bima_kegiatan	= 0;
					$transk_bima_kegiatan	= $exist_db_bima_kegiatan;
					$subtotal_bima_enc		= $subtotal_bima_enc - $exist_db_bima_kegiatan;
					echo "<h1>exixt kegiatan:eee</h1>";
					
				} else if($subtotal_bima_enc < $exist_db_bima_kegiatan){
				
					$cur_db_bima_kegiatan	= $exist_db_bima_kegiatan - $subtotal_bima_enc;
					$transk_bima_kegiatan	= $cur_db_bima_kegiatan;
					$subtotal_bima_enc		= 0;
					echo "<h1>exixt kegiatan:fff</h1>";
					
				}
			} else {
			
				$cur_db_bima_kegiatan = $exist_db_bima_kegiatan;
				$transk_bima_kegiatan = 0;
				
			}
		} else {
		
			$cur_db_bima_kegiatan = 0;
			$transk_bima_kegiatan = 0;
		
		}
		
		echo "<h1>exixt kegiatan:".$exist_db_bima_kegiatan." hehe</h1>";
		echo "<h1>subtotal bima:".$subtotal_bima_enc." hehe</h1>";
		if($exist_db_bima_peralatan != 0) {
		
			if($subtotal_bima_enc	!= 0) {
			
				if($subtotal_bima_enc == $exist_db_bima_peralatan ) {
			
					$cur_db_bima_peralatan	= 0;
					$transk_bima_peralatan	= $exist_db_bima_peralatan;
					$subtotal_bima_enc		= 0;
					echo "<h1>exixt peralatan:ddd</h1>";
				
				} else if($subtotal_bima_enc > $exist_db_bima_peralatan){
				
					$cur_db_bima_peralatan	= 0;
					$transk_bima_peralatan	= $exist_db_bima_peralatan;
					$subtotal_bima_enc		= $subtotal_bima_enc - $exist_db_bima_peralatan;
					echo "<h1>exixt peralatan:eee</h1>";
					
				} else if($subtotal_bima_enc < $exist_db_bima_peralatan){
				
					$cur_db_bima_peralatan	= $exist_db_bima_peralatan - $subtotal_bima_enc;
					$transk_bima_peralatan	= $cur_db_bima_peralatan;
					$subtotal_bima_enc		= 0;
					echo "<h1>exixt peralatan:fff</h1>";
					
				}
			} else {
			
				$cur_db_bima_peralatan = $exist_db_bima_peralatan;
				$transk_bima_peralatan = 0;
				
			}
		} else {
		
			$cur_db_bima_peralatan	= 0;
			$transk_bima_peralatan = 0;
		
		}
		
		echo "<h1>exixt seragam:".$exist_db_bima_seragam." hehe</h1>";
		echo "<h1>subtotal bima:".$subtotal_bima_enc." hehe</h1>";
		if($exist_db_bima_seragam != 0) {
		
			if($subtotal_bima_enc	!= 0) {
			
				if($subtotal_bima_enc == $exist_db_bima_seragam ) {
			
					$cur_db_bima_seragam	= 0;
					$transk_bima_seragam	= $exist_db_bima_seragam;
					$subtotal_bima_enc		= 0;
					echo "<h1>exixt seragam:ddd</h1>";
				
				} else if($subtotal_bima_enc > $exist_db_bima_seragam){
				
					$cur_db_bima_seragam	= 0;
					$transk_bima_seragam	= $exist_db_bima_seragam;
					$subtotal_bima_enc		= $subtotal_bima_enc - $exist_db_bima_seragam;
					echo "<h1>exixt seragam:eee</h1>";
					
				} else if($subtotal_bima_enc < $exist_db_bima_seragam){
				
					$cur_db_bima_seragam	= $exist_db_bima_seragam - $subtotal_bima_enc;
					$transk_bima_seragam	= $cur_db_bima_seragam;
					$subtotal_bima_enc		= 0;
					echo "<h1>exixt seragam:fff</h1>";
					
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
					echo "<h1>exixt paket:ggg</h1>";
				
				} else if($subtotal_bima_enc > $exist_db_bima_paket){
				
					$cur_db_bima_paket	= 0;
					$transk_bima_paket	= $exist_db_bima_paket;
					$subtotal_bima_enc	= $subtotal_bima_enc - $exist_db_bima_paket;
					echo "<h1>exixt paket:hhh</h1>";
					
				} else if($subtotal_bima_enc < $exist_db_bima_paket){
				
					$cur_db_bima_paket	= $exist_db_bima_paket - $subtotal_bima_enc;
					$transk_bima_paket	= $cur_db_bima_paket;
					$subtotal_bima_enc		= 0;
					echo "<h1>exixt paket:lll</h1>";
					
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
									nama_siswa,
									jenjang,
									tingkat,
									tanggal_transaksi, 
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
									'$nama_siswa_enc',
									'$jenjang_enc',
									'$tingkat_enc',
									'$tanggal_transaksi_enc', 
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
			
			if($query_input_bima) $succeed = true;
		}
	}
	
	///////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////
	//////////////////////////////SPP//////////////////////////////////
	///////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////
	
	//Related files to the cases below (tunggakan in SPP, ect) ++++++++++++++++++++++++++
	//////////////////////////////////////////////////////////////////////////////
	////////Please check -> include/define_month_spp.php executed in proc_login.php///////
	////////Please check -> include/check_spp_arrear.php executed in proc_login.php///////
	////////Please check -> page/proc_reg_adm_siswa.php///////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////
	
	if(!empty($_POST["subtotal_spp"]) && $_POST["subtotal_spp"] != 0) {
	
		$year_spp							= empty($_POST["year_spp"]) ? 0 : $_POST["year_spp"];
		$year_spp_enc						= mysql_real_escape_string($year_spp);
		
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
		$src_cur_month_val		= "select * from tunggakan where no_sisda = '$no_sisda_enc' and periode = '$year_spp_enc' and jenis_tunggakan = 'spp'";
		$query_cur_month_val	= mysqli_query($mysql_connect, $src_cur_month_val) or die(mysql_error());
		$row_cur_month_val		= mysql_fetch_array($query_cur_month_val);
		//$num					= mysql_num_rows($query_cur_month_val);
		
		
		//echo "no sisda=".$no_sisda_enc;
		//echo "periode=".$year_spp_enc;
		//echo "num=".$num;
		
		/*
		
		*/
		
		if(!empty($_POST["bulan_spp"]) && !empty($_POST["year_spp"])) {
		
		//We have to ensure whether both value of bulan_spp and year_spp are not empty
		//If so, we do not need to do something with SPP
		
		
			//from selection bulan_spp, we need to know, how many option has been selected by user.
			//So we have to count it. we will use this number to make a looping ahead.
			$count_bulan_spp = count($bulan_spp);
			
			//how much money that the student paid for each month
			//$nom_one_month	= $subtotal_spp_enc/$count_bulan_spp;
			$nom_one_month	= $nom_spp_enc/$count_bulan_spp;
			
			//Nih ya... kita butuh info bulan-bulan apa saja yang termasuk kedalam sebuah pembayaran SPP,
			//Jika pembayaran yang dilakukan lebih dari satu bulan cuy...
			//Klo tahunnya sih gak usah khawatir, karena tidak mungkin lebih dari satu tahun ajaran, dah saya block di formnya...
			$src_nama_bulan_diinput	= $_POST["bulan_spp"];
			$nama_bulan_diinput		= implode($src_nama_bulan_diinput,',');
			
			//why we have to set all month variables to "X"?
			//Because we have to make two different conditions, before and after bulan_spp combo box selected
			//We will change it to "y", when the month is selected in bulan_spp combo box.
			$per_july		= "x";
			$per_august		= "x";
			$per_september	= "x";
			$per_october	= "x";
			$per_november	= "x";
			$per_december	= "x";
			$per_january	= "x";
			$per_february	= "x";
			$per_march		= "x";
			$per_april		= "x";
			$per_may		= "x";
			$per_june		= "x";
			
			//there are 2 fields describing whether a student ever had an arrear or a student ever had a payment that done before month of payment comes
			$have_plus 	= 0;
			$have_minus = 0;
		
			//make a looping as many as count value of bulan_spp
			//if in the looping a month is selected, turn the $per_'month x' above to "y"
			for($i=0; $i<$count_bulan_spp; $i++) {
			
				//echo $bulan_spp[$i]."<br>";		
				//echo "mana:".$bulan_spp[$i]."<br>";
				if($bulan_spp[$i] == 'july') { 
				
					$per_july = "y"; 
					
					//YOYOOYOOY...di kondisi $row_cur_month_val["july"] == 3 (nilai khusus) belum ada nih... piye?????????
					if(substr($row_cur_month_val["july"],0,1) == 0)  { $cur_status_july = "7-". $nom_one_month; $have_plus++; } //have paid before the month of payment come 
					if(substr($row_cur_month_val["july"],0,1) == 1)  { $cur_status_july = "5-". $nom_one_month; } //have paid on time 
					if(substr($row_cur_month_val["july"],0,1) == 2)  { $cur_status_july = "6-". $nom_one_month; $have_minus++; } //have paid late 
				
				}
				
				if($bulan_spp[$i] == 'august')		{ 
				
					$per_august = "y";
					 
					if(substr($row_cur_month_val["august"],0,1) == 0)  { $cur_status_august = "7-". $nom_one_month; $have_plus++; }
					if(substr($row_cur_month_val["august"],0,1) == 1)  { $cur_status_august = "5-". $nom_one_month; }
					if(substr($row_cur_month_val["august"],0,1) == 2)  { $cur_status_august = "6-". $nom_one_month; $have_minus++; }
				
				} 
				
				if($bulan_spp[$i] == 'september') 	{ 
				
					$per_september = "y"; 
					
					if(substr($row_cur_month_val["september"],0,1) == 0)  { $cur_status_september = "7-". $nom_one_month; $have_plus++; } 
					if(substr($row_cur_month_val["september"],0,1) == 1)  { $cur_status_september = "5-". $nom_one_month; }
					if(substr($row_cur_month_val["september"],0,1) == 2)  { $cur_status_september = "6-". $nom_one_month; $have_minus++; }
				
				}
				
				if($bulan_spp[$i] == 'october') 	{ 
				
					$per_october = "y"; 
					
					if(substr($row_cur_month_val["october"],0,1) == 0)  { $cur_status_october = "7-". $nom_one_month; $have_plus++; }
					if(substr($row_cur_month_val["october"],0,1) == 1)  { $cur_status_october = "5-". $nom_one_month; }
					if(substr($row_cur_month_val["october"],0,1) == 2)  { $cur_status_october = "6-". $nom_one_month; $have_minus++; }
					
				}
				
				if($bulan_spp[$i] == 'november') 	{ 
				
					$per_november = "y"; 
					
					if(substr($row_cur_month_val["november"],0,1) == 0)  { $cur_status_november = "7-". $nom_one_month; $have_plus++; } 
					if(substr($row_cur_month_val["november"],0,1) == 1)  { $cur_status_november = "5-". $nom_one_month; }
					if(substr($row_cur_month_val["november"],0,1) == 2)  { $cur_status_november = "6-". $nom_one_month; $have_minus++; }
				
				}
				
				if($bulan_spp[$i] == 'december')	{ 
					
					$per_december = "y";
					
					if(substr($row_cur_month_val["december"],0,1) == 0)  { $cur_status_december = "7-". $nom_one_month; $have_plus++; }
					if(substr($row_cur_month_val["december"],0,1) == 1)  { $cur_status_december = "5-". $nom_one_month; }
					if(substr($row_cur_month_val["december"],0,1) == 2)  { $cur_status_december = "6-". $nom_one_month; $have_minus++; }
					
				}
				
				if($bulan_spp[$i] == 'january') 	{ 
				
					$per_january = "y"; 
					
					if(substr($row_cur_month_val["january"],0,1) == 0)  { $cur_status_january = "7-". $nom_one_month; $have_plus++; }
					if(substr($row_cur_month_val["january"],0,1) == 1)  { $cur_status_january = "5-". $nom_one_month; }
					if(substr($row_cur_month_val["january"],0,1) == 2)  { $cur_status_january = "6-". $nom_one_month; $have_minus++; }
					
				}
				
				if($bulan_spp[$i] == 'february') 	{ 
				
					$per_february = "y"; 
					
					if(substr($row_cur_month_val["february"],0,1) == 0)  { $cur_status_february = "7-". $nom_one_month; $have_plus++; } 
					if(substr($row_cur_month_val["february"],0,1) == 1)  { $cur_status_february = "5-". $nom_one_month; }
					if(substr($row_cur_month_val["february"],0,1) == 2)  { $cur_status_february = "6-". $nom_one_month; $have_minus++; }
					
				}
				
				if($bulan_spp[$i] == 'march') 		{ 
				
					$per_march = "y"; 
					
					if(substr($row_cur_month_val["march"],0,1) == 0)  { $cur_status_march = "7-". $nom_one_month; $have_plus++; }
					if(substr($row_cur_month_val["march"],0,1) == 1)  { $cur_status_march = "5-". $nom_one_month; }
					if(substr($row_cur_month_val["march"],0,1) == 2)  { $cur_status_march = "6-". $nom_one_month; $have_minus++; }
					
				}
				
				if($bulan_spp[$i] == 'april') 		{ 
				
					$per_april = "y"; 
					
					if(substr($row_cur_month_val["april"],0,1) == 0)  { $cur_status_april = "7-". $nom_one_month; $have_plus++; }
					if(substr($row_cur_month_val["april"],0,1) == 1)  { $cur_status_april = "5-". $nom_one_month; }
					if(substr($row_cur_month_val["april"],0,1) == 2)  { $cur_status_april = "6-". $nom_one_month; $have_minus++; }
				
				}
				
				if($bulan_spp[$i] == 'may') 		{ 
				
					$per_may = "y"; 
					
					if(substr($row_cur_month_val["may"],0,1) == 0)  { $cur_status_may = "7-". $nom_one_month; $have_plus++; }
					if(substr($row_cur_month_val["may"],0,1) == 1)  { $cur_status_may = "5-". $nom_one_month; }
					if(substr($row_cur_month_val["may"],0,1) == 2)  { $cur_status_may = "6-". $nom_one_month; $have_minus++; }
				
				}
				
				if($bulan_spp[$i] == 'june') 		{ 
				
					$per_june = "y"; 
					
					if(substr($row_cur_month_val["june"],0,1) == 0)  { $cur_status_june = "7-". $nom_one_month; $have_plus++; } 
					if(substr($row_cur_month_val["june"],0,1) == 1)  { $cur_status_june = "5-". $nom_one_month; }
					if(substr($row_cur_month_val["june"],0,1) == 2)  { $cur_status_june = "6-". $nom_one_month; $have_minus++; }			
					
				}
			}
		
			/*echo "is jul=(".$per_july.")";
			echo "is aug=(".$per_august.")";
			echo "is sep=(".$per_september.")";
			echo "is oct=(".$per_october.")";
			echo "is nov=(".$per_november.")";
			echo "is dec=(".$per_december.")";
			echo "is jan=(".$per_january.")";
			echo "is feb=(".$per_february.")";
			echo "is mar=(".$per_march.")";
			echo "is apr=(".$per_april.")";
			echo "is may=(".$per_may.")";
			echo "is jun=(".$per_june.")";*/
		
			//what we are going to do here is, we will make some update to table tunggakan in database
			//what is that????
			//we already had some values from the record that we got in $row_cur_month_val	
			//So we have to define it, into two conditions
			//1. If the month is selected ini combo box (it's already Y), turn it into 2. the meaning is, student has done the payment for the specified month
			//2. If the month is not selected in combo box (it's  still X), keep the value from $row_cur_month_val as the value that we want to use in updating process (no need to change the existing value fo that month)
			if($per_july == "y") 		{ $val_july = $cur_status_july; } 			else if ($per_july == "x")		{ $val_july = $row_cur_month_val["july"]; }
			if($per_august == "y") 		{ $val_august = $cur_status_august; } 		else if ($per_august == "x")	{ $val_august = $row_cur_month_val["august"]; }
			if($per_september == "y") 	{ $val_september = $cur_status_september; } else if ($per_september == "x")	{ $val_september = $row_cur_month_val["september"]; }
			if($per_october == "y") 	{ $val_october = $cur_status_october; } 	else if ($per_october == "x")	{ $val_october = $row_cur_month_val["october"]; }
			if($per_november == "y") 	{ $val_november	= $cur_status_november; } 	else if ($per_november == "x") 	{ $val_november = $row_cur_month_val["november"]; }
			if($per_december == "y") 	{ $val_december	= $cur_status_december; }	else if ($per_december == "x") 	{ $val_december= $row_cur_month_val["december"]; }
			if($per_january == "y")   	{ $val_january = $cur_status_january; } 	else if ($per_january == "x") 	{ $val_january = $row_cur_month_val["january"]; }
			if($per_february == "y")	{ $val_february	= $cur_status_february; } 	else if ($per_february == "x")	{ $val_february	= $row_cur_month_val["february"]; }
			if($per_march == "y")		{ $val_march = $cur_status_march; }    		else if	($per_march == "x")		{ $val_march = $row_cur_month_val["march"]; }
			if($per_april == "y")		{ $val_april = $cur_status_april; }			else if ($per_april == "x") 	{ $val_april = $row_cur_month_val["april"]; }
			if($per_may == "y")			{ $val_may = $cur_status_may; }				else if ($per_may == "x")		{ $val_may = $row_cur_month_val["may"]; }
			if($per_june == "y")		{ $val_june	= $cur_status_june; } 			else if	($per_june == "x") 		{ $val_june	= $row_cur_month_val["june"]; }
		
			/*echo "val_july =".$val_july."-".$row_cur_month_val["july"]."<br>";
			echo "val_august=".$val_august."-".$row_cur_month_val["august"]."<br>";
			echo "val_september=".$val_september."-".$row_cur_month_val["september"]."<br>";	
			echo "val_october=".$val_october."-".$row_cur_month_val["october"]."<br>";
			echo "val_november=".$val_november."-".$row_cur_month_val["november"]."<br>";
			echo "val_december=".$val_december."-".$row_cur_month_val["december"]."<br>";
			echo "val_january=".$val_january."-".$row_cur_month_val["january"]."<br>";
			echo "val_february=".$val_february."-".$row_cur_month_val["february"]."<br>";
			echo "val_march=".$val_march."-".$row_cur_month_val["march"]."<br>";
			echo "val_april=".$val_april."-".$row_cur_month_val["april"]."<br>";
			echo "val_may=".$val_may."-".$row_cur_month_val["may"]."<br>";
			echo "val_june=".$val_june."-".$row_cur_month_val["june"]."<br>";*/
			
			//the 'have' status goes here
			if($have_plus >= 1) {
			
				$field_have_plus = "have_plus = '1',";
			
			} else {
			
				$field_have_plus = "";
				
			}
			
			if($have_minus >= 1) {
			
				$field_have_minus = "have_minus = '1',";
			
			} else {
			
				$field_have_minus = "";
			
			}
			
			//So here we go buddy........
			$set_spp_payment	= "update tunggakan set 
									$field_have_plus
									$field_have_minus
									july 		= '$val_july',
									august		= '$val_august',
									september	= '$val_september',
									october		= '$val_october',
									november	= '$val_november',
									december	= '$val_december',
									january		= '$val_january',
									february	= '$val_february',
									march		= '$val_march',
									april		= '$val_april',
									may			= '$val_may',
									june		= '$val_june'
									
									where  no_sisda = '$no_sisda_enc' and periode = '$year_spp_enc' and jenis_tunggakan = 'spp'
									";
			echo $set_spp_payment."<br>";				
			$query_set_spp_paymnet	= mysqli_query($mysql_connect, $set_spp_payment) or die(mysql_error());
			
			
			echo $year_spp_enc."<br>";
			echo $count_bulan_spp."<br>";
			echo $spp_spp_enc."<br>";
			echo $ks_spp_enc;
			
			//We need to know the components of spp payment
			//we can get it from table siswa_finance
			//and each component has to be multiplicated with the number of month payment
			$src_what_spp 	= "select spp, ict, elearning, ks from siswa_finance where no_sisda = '$no_sisda_enc' and periode = '$year_spp_enc'";
			$query_what_spp	= mysqli_query($mysql_connect, $src_what_spp);
			$row_what_spp	= mysql_fetch_array($query_what_spp);
			
			$cur_spp_transk 		= $row_what_spp["spp"] * $count_bulan_spp;
			$cur_ict_transk 		= $row_what_spp["ict"] * $count_bulan_spp;
			$cur_elearning_transk 	= $row_what_spp["elearning"] * $count_bulan_spp;
			$cur_ks_transk 			= $row_what_spp["ks"] * $count_bulan_spp;
			
			if($query_set_spp_paymnet) {
			
				$src_input_transaksi_spp	= "insert into transaksi (
												no_sisda,
												periode, 
												nama_siswa,
												jenjang,
												tingkat,
												tanggal_transaksi, 
												teknik_pembayaran,
												tahun_ajaran_spp,
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
												'$year_spp_enc',
												'$nama_siswa_enc',
												'$jenjang_enc',
												'$tingkat_enc',
												'$tanggal_transaksi_enc', 
												'$teknik_pembayaran_enc',
												'$year_spp_enc',
												'$count_bulan_spp',
												'$nama_bulan_diinput',
												'$cur_spp_transk',
												'$cur_ict_transk',
												'$cur_elearning_transk',
												'$cur_ks_transk',
												'spp'
												$if_transfer_value 
												)";
				$query_input_transaksi_spp	= mysqli_query($mysql_connect, $src_input_transaksi_spp) or die(mysql_error());
				
				if($query_input_spp) $succeed = true;
				
			}
			
			//We need to check whether all errears has been paid by students, if so we have to turn the field tunggakan to 0 (no arrear)
			//All field values has to be equal with 4,5,6 or 7 to make the status 0
			$src_check_status_spp 	= "select july,august,september,october,november,december,january,february,march,april,may,june from tunggakan where no_sisda = '$no_sisda' and periode = '$year_spp_enc' and jenis_tunggakan = 'spp'";
			$query_check_status_spp = mysqli_query($mysql_connect, $src_check_status_spp) or die(mysql_error());	
			$row_check_status_spp	= mysql_fetch_array($query_check_status_spp);					
			
			$val_jul_exp	= explode("-",$row_check_status_spp["july"]); 		$val_jul_sta = $val_jul_exp[0]; echo "<h1>july".$val_jul_sta."</h1>";
			$val_aug_exp	= explode("-",$row_check_status_spp["august"]); 	$val_aug_sta = $val_aug_exp[0]; echo "<h1>aug".$val_aug_sta."</h1>";
			$val_sep_exp	= explode("-",$row_check_status_spp["september"]); 	$val_sep_sta = $val_sep_exp[0]; echo "<h1>sep".$val_sep_sta."</h1>";
			$val_oct_exp	= explode("-",$row_check_status_spp["october"]); 	$val_oct_sta = $val_oct_exp[0]; echo "<h1>oct".$val_oct_sta."</h1>";
			$val_nov_exp	= explode("-",$row_check_status_spp["november"]); 	$val_nov_sta = $val_nov_exp[0]; echo "<h1>nov".$val_nov_sta."</h1>";
			$val_dec_exp	= explode("-",$row_check_status_spp["december"]); 	$val_dec_sta = $val_dec_exp[0]; echo "<h1>dec".$val_dec_sta."</h1>";
			$val_jan_exp	= explode("-",$row_check_status_spp["january"]); 	$val_jan_sta = $val_jan_exp[0]; echo "<h1>jan".$val_jan_sta."</h1>";
			$val_feb_exp	= explode("-",$row_check_status_spp["february"]); 	$val_feb_sta = $val_feb_exp[0]; echo "<h1>feb".$val_feb_sta."</h1>";
			$val_mar_exp	= explode("-",$row_check_status_spp["march"]); 		$val_mar_sta = $val_mar_exp[0]; echo "<h1>mar".$val_mar_sta."</h1>";
			$val_apr_exp	= explode("-",$row_check_status_spp["april"]); 		$val_apr_sta = $val_apr_exp[0]; echo "<h1>apr".$val_apr_sta."</h1>";
			$val_may_exp	= explode("-",$row_check_status_spp["may"]); 		$val_may_sta = $val_may_exp[0]; echo "<h1>may".$val_may_sta."</h1>";
			$val_jun_exp	= explode("-",$row_check_status_spp["june"]); 		$val_jun_sta = $val_jun_exp[0]; echo "<h1>jun".$val_jun_sta."</h1>";
										
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
			
				$src_zero_spp_status	= "update tunggakan set status = '0' where no_sisda = '$no_sisda' and periode = '$year_spp_enc' and jenis_tunggakan = 'spp'";
				$query_zero_spp_status	= mysqli_query($mysql_connect, $src_zero_spp_status) or die(mysql_error());
				
				if(!$query_zero_spp_status) { echo "<h1>update status table tunggakan error, hubungi admin</h1>"; }
			
			}
		}		
			
	}
	
	///////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////
	//////////////////////////////CATAJ////////////////////////////////
	///////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////
	//echo "<h1>bbb=".$_POST["subtotal_catering"]."=bbb</h1>";
	if((!empty($_POST["subtotal_catering"]) && $_POST["subtotal_catering"] != 0) || (!empty($_POST["antar_jemput"]) && $_POST["antar_jemput"]) != 0) {
	
		if(!empty($_POST["catering"])) {
			$src_year_catering 	= empty($_POST["year_catering"]) ? 0 : $_POST["year_catering"];
			$year_catering_enc	= mysql_real_escape_string($src_year_catering);
			
			$src_bulan_catering = empty($_POST["bulan_catering"]) ? 0 : $_POST["bulan_catering"];
			$bulan_catering_enc	= $src_bulan_catering;
			
			//echo "<h1>cat=".$_POST["catering"]."=cat</h1>";
			//echo "<h1>year=".$src_year_catering."=year</h1>";
			//echo "<h1>mon=".$src_bulan_catering."=mon</h1>";
			if($_POST["catering"] != 0 && $src_year_catering != 0 && $src_bulan_catering != 0) {
			
				$nominal_catering		= mysql_real_escape_string($_POST["catering"]);
				$num_month_catering		= count($src_bulan_catering);	
				
				$src_cur_month_val_catering		= "select * from tunggakan where no_sisda = '$no_sisda_enc' and periode = '$year_catering_enc' and jenis_tunggakan = 'catering'";
				$query_cur_month_val_catering	= mysqli_query($mysql_connect, $src_cur_month_val_catering) or die(mysql_error());
				$row_cur_month_val_catering		= mysql_fetch_array($query_cur_month_val_catering);
				
				//echo "<h1>query:".mysql_num_rows($query_cur_month_val_catering)."</h1>";
				
				//lihat di SPP untuk keterangan ini
				$per_july_catering		= "x";
				$per_august_catering	= "x";
				$per_september_catering	= "x";
				$per_october_catering	= "x";
				$per_november_catering	= "x";
				$per_december_catering	= "x";
				$per_january_catering	= "x";
				$per_february_catering	= "x";
				$per_march_catering		= "x";
				$per_april_catering		= "x";
				$per_may_catering		= "x";
				$per_june_catering		= "x";
				
				//Lihat spp untuk keterangan ini
				$have_plus_catering 	= 0;
				$have_minus_catering 	= 0;
				
				$src_nama_bulan_diinput_catering	= $_POST["bulan_catering"];
				$nama_bulan_diinput_catering		= implode($src_nama_bulan_diinput_catering,',');
				
				//kita pastikan nih, yang dibayar sama dengan yang tercantum ditagihan/tunggakan di database... yoaaaaah
				//Soalnyakan jumlah hari caterign tiap bulan belom tentu sama,,..tul gak bro....
				//kita nolin dulu deh...
				$have_to_payx = 0;
				
				$src_have_to_pay_jul_exp = explode("-",$row_cur_month_val_catering["jul_cataj"]); 
				$src_have_to_pay_aug_exp = explode("-",$row_cur_month_val_catering["aug_cataj"]); 
				$src_have_to_pay_sep_exp = explode("-",$row_cur_month_val_catering["sep_cataj"]); 
				$src_have_to_pay_oct_exp = explode("-",$row_cur_month_val_catering["oct_cataj"]); 
				$src_have_to_pay_nov_exp = explode("-",$row_cur_month_val_catering["nov_cataj"]); 
				$src_have_to_pay_dec_exp = explode("-",$row_cur_month_val_catering["dec_cataj"]); 
				$src_have_to_pay_jan_exp = explode("-",$row_cur_month_val_catering["jan_cataj"]); 
				$src_have_to_pay_feb_exp = explode("-",$row_cur_month_val_catering["feb_cataj"]); 
				$src_have_to_pay_mar_exp = explode("-",$row_cur_month_val_catering["mar_cataj"]); 
				$src_have_to_pay_apr_exp = explode("-",$row_cur_month_val_catering["apr_cataj"]); 
				$src_have_to_pay_may_exp = explode("-",$row_cur_month_val_catering["may_cataj"]); 
				$src_have_to_pay_jun_exp = explode("-",$row_cur_month_val_catering["jun_cataj"]); 
				
				for($i=0; $i<$num_month_catering; $i++) {
					
					if($src_nama_bulan_diinput_catering[$i] == 'july') 		{ $have_to_payx		= $have_to_payx + $src_have_to_pay_jul_exp[1]; }
					if($src_nama_bulan_diinput_catering[$i] == 'august') 	{ $have_to_payx		= $have_to_payx + $src_have_to_pay_aug_exp[1]; }
					if($src_nama_bulan_diinput_catering[$i] == 'september') { $have_to_payx		= $have_to_payx + $src_have_to_pay_sep_exp[1]; }
					if($src_nama_bulan_diinput_catering[$i] == 'october') 	{ $have_to_payx		= $have_to_payx + $src_have_to_pay_oct_exp[1]; }
					if($src_nama_bulan_diinput_catering[$i] == 'november') 	{ $have_to_payx		= $have_to_payx + $src_have_to_pay_nov_exp[1]; }
					if($src_nama_bulan_diinput_catering[$i] == 'december') 	{ $have_to_payx		= $have_to_payx + $src_have_to_pay_dec_exp[1]; }
					if($src_nama_bulan_diinput_catering[$i] == 'january') 	{ $have_to_payx		= $have_to_payx + $src_have_to_pay_jan_exp[1]; }
					if($src_nama_bulan_diinput_catering[$i] == 'february') 	{ $have_to_payx		= $have_to_payx + $src_have_to_pay_feb_exp[1]; }
					if($src_nama_bulan_diinput_catering[$i] == 'march') 	{ $have_to_payx		= $have_to_payx + $src_have_to_pay_mar_exp[1]; }
					if($src_nama_bulan_diinput_catering[$i] == 'april') 	{ $have_to_payx		= $have_to_payx + $src_have_to_pay_apr_exp[1]; }
					if($src_nama_bulan_diinput_catering[$i] == 'may') 		{ $have_to_payx		= $have_to_payx + $src_have_to_pay_may_exp[1]; }
					if($src_nama_bulan_diinput_catering[$i] == 'june') 		{ $have_to_payx		= $have_to_payx + $src_have_to_pay_jun_exp[1]; }
				}
				
				//Note: no 1
				//echo "<h1>payx=".$have_to_payx."=payx</h1>";
				//Ya, kita harus pastikan bahwa apa yang akan dibayar oleh teller, sama dengan yang tertera di database
				//Kenapa kasus ini tidak diterapkan pada SPP?
				//Karena di SPP jumlah pembayaran per bulan dalam satu tahun pasti sama. maka gampang tinggal dibaji saja nominal dibagi jumalh bulan bayar.
				//klo di catering dan antar jemput tidak demikian. tiap bulan belum tentu sama, karena ada variable jumalh hari catering dan antar jemput
				//Sedangkan nominal_ catering adalah sudah jumlah keseluruhan pembayaran catering yang dipilih teller
				//Nah salah satu alat kontrolnya adalah database. Cocokan apakah sama jumlah yang diambil dari database dengan jumlah yang diisi di nominal_catering
				//nanti sama akan halnya dengan yang di antar jemput
				//klo hasilnya gak sama, ya transaksi jangan diproses
				if($have_to_payx == $nominal_catering) {
				
					for($i=0; $i<$num_month_catering; $i++) {
						
						//echo "<h1>for:".$src_nama_bulan_diinput_catering[$i]."</h1>";
						//echo $bulan_spp[$i]."<br>";		
						//echo "mana:".$bulan_spp[$i]."<br>";
						if($src_nama_bulan_diinput_catering[$i] == 'july') { //1
						
							$per_july_catering 	= "y"; 
						
							if(substr($row_cur_month_val_catering["jul_cataj"],0,1) == 0)  { $cur_status_july_catering = "7-". $src_have_to_pay_jul_exp[1]; $have_plus_catering++; } //have paid before the month of payment come 
							if(substr($row_cur_month_val_catering["jul_cataj"],0,1) == 1)  { $cur_status_july_catering = "5-". $src_have_to_pay_jul_exp[1]; } //have paid on time 
							if(substr($row_cur_month_val_catering["jul_cataj"],0,1) == 2)  { $cur_status_july_catering = "6-". $src_have_to_pay_jul_exp[1]; $have_minus_catering++; } //have paid late 
						
						}
						
						if($src_nama_bulan_diinput_catering[$i] == 'august') { //2
						
							$per_august_catering 	= "y"; 
						
							if(substr($row_cur_month_val_catering["aug_cataj"],0,1) == 0)  { $cur_status_august_catering = "7-". $src_have_to_pay_aug_exp[1]; $have_plus_catering++; } //have paid before the month of payment come 
							if(substr($row_cur_month_val_catering["aug_cataj"],0,1) == 1)  { $cur_status_august_catering = "5-". $src_have_to_pay_aug_exp[1]; } //have paid on time 
							if(substr($row_cur_month_val_catering["aug_cataj"],0,1) == 2)  { $cur_status_august_catering = "6-". $src_have_to_pay_aug_exp[1]; $have_minus_catering++; } //have paid late 
						
						}
						
						if($src_nama_bulan_diinput_catering[$i] == 'september') { //3
						
							$per_september_catering = "y"; 
						
							if(substr($row_cur_month_val_catering["sep_cataj"],0,1) == 0)  { $cur_status_september_catering = "7-". $src_have_to_pay_sep_exp[1]; $have_plus_catering++; } //have paid before the month of payment come 
							if(substr($row_cur_month_val_catering["sep_cataj"],0,1) == 1)  { $cur_status_september_catering = "5-". $src_have_to_pay_sep_exp[1]; } //have paid on time 
							if(substr($row_cur_month_val_catering["sep_cataj"],0,1) == 2)  { $cur_status_september_catering = "6-". $src_have_to_pay_sep_exp[1]; $have_minus_catering++; } //have paid late 
						
						}
						
						if($src_nama_bulan_diinput_catering[$i] == 'october') { //4
						
							$per_october_catering 	= "y"; 
						
							if(substr($row_cur_month_val_catering["oct_cataj"],0,1) == 0)  { $cur_status_october_catering = "7-". $src_have_to_pay_oct_exp[1]; $have_plus_catering++; } //have paid before the month of payment come 
							if(substr($row_cur_month_val_catering["oct_cataj"],0,1) == 1)  { $cur_status_october_catering = "5-". $src_have_to_pay_oct_exp[1]; } //have paid on time 
							if(substr($row_cur_month_val_catering["oct_cataj"],0,1) == 2)  { $cur_status_october_catering = "6-". $src_have_to_pay_oct_exp[1]; $have_minus_catering++; } //have paid late 
						
						}
						
						if($src_nama_bulan_diinput_catering[$i] == 'november') { //5
						
							$per_november_catering 	= "y"; 
						
							if(substr($row_cur_month_val_catering["nov_cataj"],0,1) == 0)  { $cur_status_november_catering = "7-". $src_have_to_pay_nov_exp[1]; $have_plus_catering++; } //have paid before the month of payment come 
							if(substr($row_cur_month_val_catering["nov_cataj"],0,1) == 1)  { $cur_status_november_catering = "5-". $src_have_to_pay_nov_exp[1]; } //have paid on time 
							if(substr($row_cur_month_val_catering["nov_cataj"],0,1) == 2)  { $cur_status_november_catering = "6-". $src_have_to_pay_nov_exp[1]; $have_minus_catering++; } //have paid late 
						
						}
						
						if($src_nama_bulan_diinput_catering[$i] == 'december') { //6
						
							$per_december_catering 	= "y"; 
						
							if(substr($row_cur_month_val_catering["dec_cataj"],0,1) == 0)  { $cur_status_december_catering = "7-". $src_have_to_pay_dec_exp[1]; $have_plus_catering++; } //have paid before the month of payment come 
							if(substr($row_cur_month_val_catering["dec_cataj"],0,1) == 1)  { $cur_status_december_catering = "5-". $src_have_to_pay_dec_exp[1]; } //have paid on time 
							if(substr($row_cur_month_val_catering["dec_cataj"],0,1) == 2)  { $cur_status_december_catering = "6-". $src_have_to_pay_dec_exp[1]; $have_minus_catering++; } //have paid late 
						
						}
						
						if($src_nama_bulan_diinput_catering[$i] == 'january') { //7
						
							$per_january_catering 	= "y"; 
						
							if(substr($row_cur_month_val_catering["jan_cataj"],0,1) == 0)  { $cur_status_january_catering = "7-". $src_have_to_pay_jan_exp[1]; $have_plus_catering++; } //have paid before the month of payment come 
							if(substr($row_cur_month_val_catering["jan_cataj"],0,1) == 1)  { $cur_status_january_catering = "5-". $src_have_to_pay_jan_exp[1]; } //have paid on time 
							if(substr($row_cur_month_val_catering["jan_cataj"],0,1) == 2)  { $cur_status_january_catering = "6-". $src_have_to_pay_jan_exp[1]; $have_minus_catering++; } //have paid late 
						
						}
						
						if($src_nama_bulan_diinput_catering[$i] == 'february') { //8
						
							$per_february_catering 	= "y"; 
						
							if(substr($row_cur_month_val_catering["feb_cataj"],0,1) == 0)  { $cur_status_february_catering = "7-". $src_have_to_pay_feb_exp[1]; $have_plus_catering++; } //have paid before the month of payment come 
							if(substr($row_cur_month_val_catering["feb_cataj"],0,1) == 1)  { $cur_status_february_catering = "5-". $src_have_to_pay_feb_exp[1]; } //have paid on time 
							if(substr($row_cur_month_val_catering["feb_cataj"],0,1) == 2)  { $cur_status_february_catering = "6-". $src_have_to_pay_feb_exp[1]; $have_minus_catering++; } //have paid late 
						
						}
						
						if($src_nama_bulan_diinput_catering[$i] == 'march') { //9
						
							$per_march_catering = "y"; 
						
							if(substr($row_cur_month_val_catering["mar_cataj"],0,1) == 0)  { $cur_status_march_catering = "7-". $src_have_to_pay_mar_exp[1]; $have_plus_catering++; } //have paid before the month of payment come 
							if(substr($row_cur_month_val_catering["mar_cataj"],0,1) == 1)  { $cur_status_march_catering = "5-". $src_have_to_pay_mar_exp[1]; } //have paid on time 
							if(substr($row_cur_month_val_catering["mar_cataj"],0,1) == 2)  { $cur_status_march_catering = "6-". $src_have_to_pay_mar_exp[1]; $have_minus_catering++; } //have paid late 
						
						}
						
						if($src_nama_bulan_diinput_catering[$i] == 'april') { //10
						
							$per_april_catering = "y"; 
						
							if(substr($row_cur_month_val_catering["apr_cataj"],0,1) == 0)  { $cur_status_april_catering = "7-". $src_have_to_pay_apr_exp[1]; $have_plus_catering++; } //have paid before the month of payment come 
							if(substr($row_cur_month_val_catering["apr_cataj"],0,1) == 1)  { $cur_status_april_catering = "5-". $src_have_to_pay_apr_exp[1]; } //have paid on time 
							if(substr($row_cur_month_val_catering["apr_cataj"],0,1) == 2)  { $cur_status_april_catering = "6-". $src_have_to_pay_apr_exp[1]; $have_minus_catering++; } //have paid late 
						
						}
						
						if($src_nama_bulan_diinput_catering[$i] == 'may') { //11
						
							$per_may_catering 	= "y"; 
						
							if(substr($row_cur_month_val_catering["may_cataj"],0,1) == 0)  { $cur_status_may_catering = "7-". $src_have_to_pay_may_exp[1]; $have_plus_catering++; } //have paid before the month of payment come 
							if(substr($row_cur_month_val_catering["may_cataj"],0,1) == 1)  { $cur_status_may_catering = "5-". $src_have_to_pay_may_exp[1]; } //have paid on time 
							if(substr($row_cur_month_val_catering["may_cataj"],0,1) == 2)  { $cur_status_may_catering = "6-". $src_have_to_pay_may_exp[1]; $have_minus_catering++; } //have paid late 
						
						}
						
						if($src_nama_bulan_diinput_catering[$i] == 'june') { //12
						
							$per_june_catering 	= "y"; 
						
							if(substr($row_cur_month_val_catering["jun_cataj"],0,1) == 0)  { $cur_status_june_catering = "7-". $src_have_to_pay_jun_exp[1]; $have_plus_catering++; } //have paid before the month of payment come 
							if(substr($row_cur_month_val_catering["jun_cataj"],0,1) == 1)  { $cur_status_june_catering = "5-". $src_have_to_pay_jun_exp[1]; } //have paid on time 
							if(substr($row_cur_month_val_catering["jun_cataj"],0,1) == 2)  { $cur_status_june_catering = "6-". $src_have_to_pay_jun_exp[1]; $have_minus_catering++; } //have paid late 
						
						}
						
						//keterangan lihat SPP
						if($per_july_catering == "x") 		{ $val_july_catering = ""; } 		else if ($per_july_catering == "y")		{ $val_july_catering = "jul_cataj = '".$cur_status_july_catering."',"; }
						if($per_august_catering == "x") 	{ $val_august_catering = ""; } 		else if ($per_august_catering == "y")	{ $val_august_catering = "aug_cataj = '".$cur_status_august_catering."',"; }
						if($per_september_catering == "x") 	{ $val_september_catering = ""; } 	else if ($per_september_catering == "y"){ $val_september_catering = "sep_cataj = '".$cur_status_september_catering."',"; }
						if($per_october_catering == "x") 	{ $val_october_catering = ""; } 	else if ($per_october_catering == "y")	{ $val_october_catering = "oct_cataj = '".$cur_status_october_catering."',"; }
						if($per_november_catering == "x") 	{ $val_november_catering = ""; } 	else if ($per_november_catering == "y")	{ $val_november_catering = "nov_cataj = '".$cur_status_november_catering."',"; }
						if($per_december_catering == "x") 	{ $val_december_catering = ""; }	else if ($per_december_catering == "y") { $val_december_catering = "dec_cataj = '".$cur_status_december_catering."',"; }
						if($per_january_catering == "x")   	{ $val_january_catering = ""; } 	else if ($per_january_catering == "y") 	{ $val_january_catering = "jan_cataj = '".$cur_status_january_catering."',"; }
						if($per_february_catering == "x")	{ $val_february_catering = ""; } 	else if ($per_february_catering == "y")	{ $val_february_catering = "feb_cataj = '".$cur_status_february_catering."',"; }
						if($per_march_catering == "x")		{ $val_march_catering = ""; }    	else if	($per_march_catering == "y")	{ $val_march_catering = "mar_cataj = '".$cur_status_march_catering."',"; }
						if($per_april_catering == "x")		{ $val_april_catering = ""; }		else if ($per_april_catering == "y") 	{ $val_april_catering = "apr_cataj = '".$cur_status_april_catering."',"; }
						if($per_may_catering == "x")		{ $val_may_catering = ""; }			else if ($per_may_catering == "y")		{ $val_may_catering = "may_cataj = '".$cur_status_may_catering."',"; }
						if($per_june_catering == "x")		{ $val_june_catering = ""; } 		else if	($per_june_catering == "y") 	{ $val_june_catering = "jun_cataj = '".$cur_status_june_catering."',"; }
						
						
						//see explanation in spp
						if($have_plus_catering >= 1) {
						
							$field_have_plus_catering = "have_plus = '1',";
						
						} else {
						
							$field_have_plus_catering = "";
							
						}
						
						if($have_minus_catering >= 1) {
						
							$field_have_minus_catering = "have_minus = '1',";
						
						} else {
						
							$field_have_minus_catering = "";
						
						}
						
						
						//So here we go buddy........
						//itu field periode sebenernya gak perlu di-update,..tapi kita butuh dia untuk menyelamatkan , (comma) yang dikirim oleh $val_august_catering
						//kan yang diakhir gak pake comma, tul gak bro...					
						$cur_periode_cataj	= $row_cur_month_val_catering["periode"];
						
						
						//here we go
						$set_payment_catering	= "update tunggakan set 
												$field_have_plus_catering
												$field_have_minus_catering
												$val_july_catering
												$val_august_catering
												$val_september_catering
												$val_october_catering
												$val_november_catering
												$val_december_catering
												$val_january_catering
												$val_february_catering
												$val_march_catering
												$val_april_catering
												$val_may_catering
												$val_june_catering
												periode = '$cur_periode_cataj'
												
												where  no_sisda = '$no_sisda_enc' and periode = '$year_catering_enc' and jenis_tunggakan = 'catering'
												";
						
						//echo $set_payment_catering;								
						$query_set_paymnet_catering	= mysqli_query($mysql_connect, $set_payment_catering) or die(mysql_error());
							
					}
								
					$src_input_transaksi_catering	= "insert into transaksi(
																	no_sisda,
																	periode, 
																	nama_siswa,
																	jenjang,
																	tingkat,
																	tanggal_transaksi, 
																	teknik_pembayaran,
																	jumlah_bulan_catering,
																	bulan_catering,
																	catering,
																	jenis_transaksi
																	) values (
																	
																	'$no_sisda_enc', 
																	'$year_catering_enc',
																	'$nama_siswa_enc',
																	'$jenjang_enc',
																	'$tingkat_enc',
																	'$tanggal_transaksi_enc', 
																	'$teknik_pembayaran_enc',
																	'$num_month_catering',
																	'$nama_bulan_diinput_catering',
																	'$nominal_catering',
																	'catering'
																	)";
																	
					$query_input_transaksi_catering	= mysqli_query($mysql_connect, $src_input_transaksi_catering) or die(mysql_error());
				
					if($query_input_transaksi_catering) {
					
						$succeed = true;
					
						//We need to check whether all errears has been paid by students, if so we have to turn the field tunggakan to 0 (no arrear)
						//All field values has to be equal with 4,5,6 or 7 to make the status 0
						$src_check_status_catering 	= "select jul_cataj,aug_cataj,sep_cataj,oct_cataj,nov_cataj,dec_cataj,jan_cataj,feb_cataj,mar_cataj,apr_cataj,may_cataj,jun_cataj from tunggakan where no_sisda = '$no_sisda' and periode = '$year_catering_enc' and jenis_tunggakan = 'catering'";
						$query_check_status_catering = mysqli_query($mysql_connect, $src_check_status_catering) or die(mysql_error());	
						$row_check_status_catering	= mysql_fetch_array($query_check_status_catering);					
						
						$val_jul_sta_exp_catering	= explode("-",$row_check_status_catering["jul_cataj"]); $val_jul_sta_catering = $val_jul_sta_exp_catering[0]; //echo "<h1>july".$val_jul_sta_catering."</h1>";
						$val_aug_sta_exp_catering	= explode("-",$row_check_status_catering["aug_cataj"]); $val_aug_sta_catering = $val_aug_sta_exp_catering[0]; //echo "<h1>aug".$val_aug_sta_catering."</h1>";
						$val_sep_sta_exp_catering	= explode("-",$row_check_status_catering["sep_cataj"]); $val_sep_sta_catering = $val_sep_sta_exp_catering[0]; //echo "<h1>sep".$val_sep_sta_catering."</h1>";
						$val_oct_sta_exp_catering	= explode("-",$row_check_status_catering["oct_cataj"]); $val_oct_sta_catering = $val_oct_sta_exp_catering[0]; //echo "<h1>oct".$val_oct_sta_catering."</h1>";
						$val_nov_sta_exp_catering	= explode("-",$row_check_status_catering["nov_cataj"]); $val_nov_sta_catering = $val_nov_sta_exp_catering[0]; //echo "<h1>nov".$val_nov_sta_catering."</h1>";
						$val_dec_sta_exp_catering	= explode("-",$row_check_status_catering["dec_cataj"]); $val_dec_sta_catering = $val_dec_sta_exp_catering[0]; //echo "<h1>dec".$val_dec_sta_catering."</h1>";
						$val_jan_sta_exp_catering	= explode("-",$row_check_status_catering["jan_cataj"]); $val_jan_sta_catering = $val_jan_sta_exp_catering[0]; //echo "<h1>jan".$val_jan_sta_catering."</h1>";
						$val_feb_sta_exp_catering	= explode("-",$row_check_status_catering["feb_cataj"]); $val_feb_sta_catering = $val_feb_sta_exp_catering[0]; //echo "<h1>feb".$val_feb_sta_catering."</h1>";
						$val_mar_sta_exp_catering	= explode("-",$row_check_status_catering["mar_cataj"]); $val_mar_sta_catering = $val_mar_sta_exp_catering[0]; //echo "<h1>mar".$val_mar_sta_catering."</h1>";
						$val_apr_sta_exp_catering	= explode("-",$row_check_status_catering["apr_cataj"]); $val_apr_sta_catering = $val_apr_sta_exp_catering[0]; //echo "<h1>apr".$val_apr_sta_catering."</h1>";
						$val_may_sta_exp_catering	= explode("-",$row_check_status_catering["may_cataj"]); $val_may_sta_catering = $val_may_sta_exp_catering[0]; //echo "<h1>may".$val_may_sta_catering."</h1>";
						$val_jun_sta_exp_catering	= explode("-",$row_check_status_catering["jun_cataj"]); $val_jun_sta_catering = $val_jun_sta_exp_catering[0]; //echo "<h1>jun".$val_jun_sta_catering."</h1>";
													
						if(
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
						
							$src_zero_status_catering	= "update tunggakan set status = '0' where no_sisda = '$no_sisda' and periode = '$year_catering_enc' and jenis_tunggakan = 'catering'";
							$query_zero_status_catering	= mysqli_query($mysql_connect, $src_zero_status_catering) or die(mysql_error());
							echo $src_zero_status_catering;
							if(!$query_zero_status_catering) { echo "<h1>update status table tunggakan error, hubungi admin</h1>"; }
						
						}
						
					} else { echo "Data transaksi tidak gagal diinput, hubungi admin"; }
				
				} else { echo "Jumlah uang catering yang akan dibayarkan tidak sesuai dengan jumlah yang tertera di dalam database (yang seharusnya dibayarkan).<br>Silakan ulangi proses"; }
				
			} else { echo "data catering tidak lengkap"; }
								
		}else { echo "<h1>2</h1>"; }
		
		/////////////////////////
		/////////////////////////
		/////////////////////////
		
		if(!empty($_POST["antar_jemput"])) {
			$src_year_antar_jemput 	= empty($_POST["year_antar_jemput"]) ? 0 : $_POST["year_antar_jemput"];
			$year_antar_jemput_enc	= mysql_real_escape_string($src_year_antar_jemput);
			
			$src_bulan_antar_jemput = empty($_POST["bulan_antar_jemput"]) ? 0 : $_POST["bulan_antar_jemput"];
			$bulan_antar_jemput_enc	= $src_bulan_antar_jemput;
			
			//echo "<h1>cat=".$_POST["antar_jemput"]."=cat</h1>";
			//echo "<h1>year=".$src_year_antar_jemput."=year</h1>";
			//echo "<h1>mon=".$src_bulan_antar_jemput."=mon</h1>";
			if($_POST["antar_jemput"] != 0 && $src_year_antar_jemput != 0 && $src_bulan_antar_jemput != 0) {
			
				$nominal_antar_jemput		= mysql_real_escape_string($_POST["antar_jemput"]);
				$num_month_antar_jemput		= count($src_bulan_antar_jemput);	
				
				$src_cur_month_val_antar_jemput		= "select * from tunggakan where no_sisda = '$no_sisda_enc' and periode = '$year_antar_jemput_enc' and jenis_tunggakan = 'antar_jemput'";
				$query_cur_month_val_antar_jemput	= mysqli_query($mysql_connect, $src_cur_month_val_antar_jemput) or die(mysql_error());
				$row_cur_month_val_antar_jemput		= mysql_fetch_array($query_cur_month_val_antar_jemput);
				
				//echo "<h1>query:".mysql_num_rows($query_cur_month_val_antar_jemput)."</h1>";
				
				//lihat di SPP untuk keterangan ini
				$per_july_antar_jemput		= "x";
				$per_august_antar_jemput	= "x";
				$per_september_antar_jemput	= "x";
				$per_october_antar_jemput	= "x";
				$per_november_antar_jemput	= "x";
				$per_december_antar_jemput	= "x";
				$per_january_antar_jemput	= "x";
				$per_february_antar_jemput	= "x";
				$per_march_antar_jemput		= "x";
				$per_april_antar_jemput		= "x";
				$per_may_antar_jemput		= "x";
				$per_june_antar_jemput		= "x";
				
				//Lihat spp untuk keterangan ini
				$have_plus_antar_jemput 	= 0;
				$have_minus_antar_jemput 	= 0;
				
				$src_nama_bulan_diinput_antar_jemput	= $_POST["bulan_antar_jemput"];
				$nama_bulan_diinput_antar_jemput		= implode($src_nama_bulan_diinput_antar_jemput,',');
				
				//kita pastikan nih, yang dibayar sama dengan yang tercantum ditagihan/tunggakan di database... yoaaaaah
				//Soalnyakan jumlah hari caterign tiap bulan belom tentu sama,,..tul gak bro....
				//kita nolin dulu deh...
				$have_to_pay_antar_jemput = 0;
				
				$src_have_to_pay_jul_exp_antar_jemput = explode("-",$row_cur_month_val_antar_jemput["jul_cataj"]); 
				$src_have_to_pay_aug_exp_antar_jemput = explode("-",$row_cur_month_val_antar_jemput["aug_cataj"]); 
				$src_have_to_pay_sep_exp_antar_jemput = explode("-",$row_cur_month_val_antar_jemput["sep_cataj"]); 
				$src_have_to_pay_oct_exp_antar_jemput = explode("-",$row_cur_month_val_antar_jemput["oct_cataj"]); 
				$src_have_to_pay_nov_exp_antar_jemput = explode("-",$row_cur_month_val_antar_jemput["nov_cataj"]); 
				$src_have_to_pay_dec_exp_antar_jemput = explode("-",$row_cur_month_val_antar_jemput["dec_cataj"]); 
				$src_have_to_pay_jan_exp_antar_jemput = explode("-",$row_cur_month_val_antar_jemput["jan_cataj"]); 
				$src_have_to_pay_feb_exp_antar_jemput = explode("-",$row_cur_month_val_antar_jemput["feb_cataj"]); 
				$src_have_to_pay_mar_exp_antar_jemput = explode("-",$row_cur_month_val_antar_jemput["mar_cataj"]); 
				$src_have_to_pay_apr_exp_antar_jemput = explode("-",$row_cur_month_val_antar_jemput["apr_cataj"]); 
				$src_have_to_pay_may_exp_antar_jemput = explode("-",$row_cur_month_val_antar_jemput["may_cataj"]); 
				$src_have_to_pay_jun_exp_antar_jemput = explode("-",$row_cur_month_val_antar_jemput["jun_cataj"]); 
				
				for($i=0; $i<$num_month_antar_jemput; $i++) {
					
					if($src_nama_bulan_diinput_antar_jemput[$i] == 'july') 		{ $have_to_pay_antar_jemput	= $have_to_pay_antar_jemput + $src_have_to_pay_jul_exp_antar_jemput[1]; }
					if($src_nama_bulan_diinput_antar_jemput[$i] == 'august') 	{ $have_to_pay_antar_jemput	= $have_to_pay_antar_jemput + $src_have_to_pay_aug_exp_antar_jemput[1]; }
					if($src_nama_bulan_diinput_antar_jemput[$i] == 'september') { $have_to_pay_antar_jemput	= $have_to_pay_antar_jemput + $src_have_to_pay_sep_exp_antar_jemput[1]; }
					if($src_nama_bulan_diinput_antar_jemput[$i] == 'october') 	{ $have_to_pay_antar_jemput	= $have_to_pay_antar_jemput + $src_have_to_pay_oct_exp_antar_jemput[1]; }
					if($src_nama_bulan_diinput_antar_jemput[$i] == 'november') 	{ $have_to_pay_antar_jemput	= $have_to_pay_antar_jemput + $src_have_to_pay_nov_exp_antar_jemput[1]; }
					if($src_nama_bulan_diinput_antar_jemput[$i] == 'december') 	{ $have_to_pay_antar_jemput	= $have_to_pay_antar_jemput + $src_have_to_pay_dec_exp_antar_jemput[1]; }
					if($src_nama_bulan_diinput_antar_jemput[$i] == 'january') 	{ $have_to_pay_antar_jemput	= $have_to_pay_antar_jemput + $src_have_to_pay_jan_exp_antar_jemput[1]; }
					if($src_nama_bulan_diinput_antar_jemput[$i] == 'february') 	{ $have_to_pay_antar_jemput	= $have_to_pay_antar_jemput + $src_have_to_pay_feb_exp_antar_jemput[1]; }
					if($src_nama_bulan_diinput_antar_jemput[$i] == 'march') 	{ $have_to_pay_antar_jemput	= $have_to_pay_antar_jemput + $src_have_to_pay_mar_exp_antar_jemput[1]; }
					if($src_nama_bulan_diinput_antar_jemput[$i] == 'april') 	{ $have_to_pay_antar_jemput	= $have_to_pay_antar_jemput + $src_have_to_pay_apr_exp_antar_jemput[1]; }
					if($src_nama_bulan_diinput_antar_jemput[$i] == 'may') 		{ $have_to_pay_antar_jemput	= $have_to_pay_antar_jemput + $src_have_to_pay_may_exp_antar_jemput[1]; }
					if($src_nama_bulan_diinput_antar_jemput[$i] == 'june') 		{ $have_to_pay_antar_jemput	= $have_to_pay_antar_jemput + $src_have_to_pay_jun_exp_antar_jemput[1]; }
				}
				
				//Note: no 1
				//echo "<h1>payx=".$have_to_payx."=payx</h1>";
				//Ya, kita harus pastikan bahwa apa yang akan dibayar oleh teller, sama dengan yang tertera di database
				//Kenapa kasus ini tidak diterapkan pada SPP?
				//Karena di SPP jumlah pembayaran per bulan dalam satu tahun pasti sama. maka gampang tinggal dibaji saja nominal dibagi jumalh bulan bayar.
				//klo di antar_jemput dan antar jemput tidak demikian. tiap bulan belum tentu sama, karena ada variable jumalh hari antar_jemput dan antar jemput
				//Sedangkan nominal_ antar_jemput adalah sudah jumlah keseluruhan pembayaran antar_jemput yang dipilih teller
				//Nah salah satu alat kontrolnya adalah database. Cocokan apakah sama jumlah yang diambil dari database dengan jumlah yang diisi di nominal_antar_jemput
				//nanti sama akan halnya dengan yang di antar jemput
				//klo hasilnya gak sama, ya transaksi jangan diproses
				if($have_to_pay_antar_jemput == $nominal_antar_jemput) {
				
					for($i=0; $i<$num_month_antar_jemput; $i++) {
						
						//echo "<h1>for:".$src_nama_bulan_diinput_antar_jemput[$i]."</h1>";
						//echo $bulan_spp[$i]."<br>";		
						//echo "mana:".$bulan_spp[$i]."<br>";
						if($src_nama_bulan_diinput_antar_jemput[$i] == 'july') { //1
						
							$per_july_antar_jemput 	= "y"; 
						
							if(substr($row_cur_month_val_antar_jemput["jul_cataj"],0,1) == 0)  { $cur_status_july_antar_jemput = "7-". $src_have_to_pay_jul_exp_antar_jemput[1]; $have_plus_antar_jemput++; } //have paid before the month of payment come 
							if(substr($row_cur_month_val_antar_jemput["jul_cataj"],0,1) == 1)  { $cur_status_july_antar_jemput = "5-". $src_have_to_pay_jul_exp_antar_jemput[1]; } //have paid on time 
							if(substr($row_cur_month_val_antar_jemput["jul_cataj"],0,1) == 2)  { $cur_status_july_antar_jemput = "6-". $src_have_to_pay_jul_exp_antar_jemput[1]; $have_minus_antar_jemput++; } //have paid late 
						
						}
						
						if($src_nama_bulan_diinput_antar_jemput[$i] == 'august') { //2
						
							$per_august_antar_jemput 	= "y"; 
						
							if(substr($row_cur_month_val_antar_jemput["aug_cataj"],0,1) == 0)  { $cur_status_august_antar_jemput = "7-". $src_have_to_pay_aug_exp_antar_jemput[1]; $have_plus_antar_jemput++; } //have paid before the month of payment come 
							if(substr($row_cur_month_val_antar_jemput["aug_cataj"],0,1) == 1)  { $cur_status_august_antar_jemput = "5-". $src_have_to_pay_aug_exp_antar_jemput[1]; } //have paid on time 
							if(substr($row_cur_month_val_antar_jemput["aug_cataj"],0,1) == 2)  { $cur_status_august_antar_jemput = "6-". $src_have_to_pay_aug_exp_antar_jemput[1]; $have_minus_antar_jemput++; } //have paid late 
						
						}
						
						if($src_nama_bulan_diinput_antar_jemput[$i] == 'september') { //3
						
							$per_september_antar_jemput = "y"; 
						
							if(substr($row_cur_month_val_antar_jemput["sep_cataj"],0,1) == 0)  { $cur_status_september_antar_jemput = "7-". $src_have_to_pay_sep_exp_antar_jemput[1]; $have_plus_antar_jemput++; } //have paid before the month of payment come 
							if(substr($row_cur_month_val_antar_jemput["sep_cataj"],0,1) == 1)  { $cur_status_september_antar_jemput = "5-". $src_have_to_pay_sep_exp_antar_jemput[1]; } //have paid on time 
							if(substr($row_cur_month_val_antar_jemput["sep_cataj"],0,1) == 2)  { $cur_status_september_antar_jemput = "6-". $src_have_to_pay_sep_exp_antar_jemput[1]; $have_minus_antar_jemput++; } //have paid late 
						
						}
						
						if($src_nama_bulan_diinput_antar_jemput[$i] == 'october') { //4
						
							$per_october_antar_jemput 	= "y"; 
						
							if(substr($row_cur_month_val_antar_jemput["oct_cataj"],0,1) == 0)  { $cur_status_october_antar_jemput = "7-". $src_have_to_pay_oct_exp_antar_jemput[1]; $have_plus_antar_jemput++; } //have paid before the month of payment come 
							if(substr($row_cur_month_val_antar_jemput["oct_cataj"],0,1) == 1)  { $cur_status_october_antar_jemput = "5-". $src_have_to_pay_oct_exp_antar_jemput[1]; } //have paid on time 
							if(substr($row_cur_month_val_antar_jemput["oct_cataj"],0,1) == 2)  { $cur_status_october_antar_jemput = "6-". $src_have_to_pay_oct_exp_antar_jemput[1]; $have_minus_antar_jemput++; } //have paid late 
						
						}
						
						if($src_nama_bulan_diinput_antar_jemput[$i] == 'november') { //5
						
							$per_november_antar_jemput 	= "y"; 
						
							if(substr($row_cur_month_val_antar_jemput["nov_cataj"],0,1) == 0)  { $cur_status_november_antar_jemput = "7-". $src_have_to_pay_nov_exp_antar_jemput[1]; $have_plus_antar_jemput++; } //have paid before the month of payment come 
							if(substr($row_cur_month_val_antar_jemput["nov_cataj"],0,1) == 1)  { $cur_status_november_antar_jemput = "5-". $src_have_to_pay_nov_exp_antar_jemput[1]; } //have paid on time 
							if(substr($row_cur_month_val_antar_jemput["nov_cataj"],0,1) == 2)  { $cur_status_november_antar_jemput = "6-". $src_have_to_pay_nov_exp[_antar_jemput1]; $have_minus_antar_jemput++; } //have paid late 
						
						}
						
						if($src_nama_bulan_diinput_antar_jemput[$i] == 'december') { //6
						
							$per_december_antar_jemput 	= "y"; 
						
							if(substr($row_cur_month_val_antar_jemput["dec_cataj"],0,1) == 0)  { $cur_status_december_antar_jemput = "7-". $src_have_to_pay_dec_exp_antar_jemput[1]; $have_plus_antar_jemput++; } //have paid before the month of payment come 
							if(substr($row_cur_month_val_antar_jemput["dec_cataj"],0,1) == 1)  { $cur_status_december_antar_jemput = "5-". $src_have_to_pay_dec_exp_antar_jemput[1]; } //have paid on time 
							if(substr($row_cur_month_val_antar_jemput["dec_cataj"],0,1) == 2)  { $cur_status_december_antar_jemput = "6-". $src_have_to_pay_dec_exp_antar_jemput[1]; $have_minus_antar_jemput++; } //have paid late 
						
						}
						
						if($src_nama_bulan_diinput_antar_jemput[$i] == 'january') { //7
						
							$per_january_antar_jemput 	= "y"; 
						
							if(substr($row_cur_month_val_antar_jemput["jan_cataj"],0,1) == 0)  { $cur_status_january_antar_jemput = "7-". $src_have_to_pay_jan_exp_antar_jemput[1]; $have_plus_antar_jemput++; } //have paid before the month of payment come 
							if(substr($row_cur_month_val_antar_jemput["jan_cataj"],0,1) == 1)  { $cur_status_january_antar_jemput = "5-". $src_have_to_pay_jan_exp_antar_jemput[1]; } //have paid on time 
							if(substr($row_cur_month_val_antar_jemput["jan_cataj"],0,1) == 2)  { $cur_status_january_antar_jemput = "6-". $src_have_to_pay_jan_exp_antar_jemput[1]; $have_minus_antar_jemput++; } //have paid late 
						
						}
						
						if($src_nama_bulan_diinput_antar_jemput[$i] == 'february') { //8
						
							$per_february_antar_jemput 	= "y"; 
						
							if(substr($row_cur_month_val_antar_jemput["feb_cataj"],0,1) == 0)  { $cur_status_february_antar_jemput = "7-". $src_have_to_pay_feb_exp_antar_jemput[1]; $have_plus_antar_jemput++; } //have paid before the month of payment come 
							if(substr($row_cur_month_val_antar_jemput["feb_cataj"],0,1) == 1)  { $cur_status_february_antar_jemput = "5-". $src_have_to_pay_feb_exp_antar_jemput[1]; } //have paid on time 
							if(substr($row_cur_month_val_antar_jemput["feb_cataj"],0,1) == 2)  { $cur_status_february_antar_jemput = "6-". $src_have_to_pay_feb_exp_antar_jemput[1]; $have_minus_antar_jemput++; } //have paid late 
						
						}
						
						if($src_nama_bulan_diinput_antar_jemput[$i] == 'march') { //9
						
							$per_march_antar_jemput = "y"; 
						
							if(substr($row_cur_month_val_antar_jemput["mar_cataj"],0,1) == 0)  { $cur_status_march_antar_jemput = "7-". $src_have_to_pay_mar_exp_antar_jemput[1]; $have_plus_antar_jemput++; } //have paid before the month of payment come 
							if(substr($row_cur_month_val_antar_jemput["mar_cataj"],0,1) == 1)  { $cur_status_march_antar_jemput = "5-". $src_have_to_pay_mar_exp_antar_jemput[1]; } //have paid on time 
							if(substr($row_cur_month_val_antar_jemput["mar_cataj"],0,1) == 2)  { $cur_status_march_antar_jemput = "6-". $src_have_to_pay_mar_exp_antar_jemput[1]; $have_minus_antar_jemput++; } //have paid late 
						
						}
						
						if($src_nama_bulan_diinput_antar_jemput[$i] == 'april') { //10
						
							$per_april_antar_jemput = "y"; 
						
							if(substr($row_cur_month_val_antar_jemput["apr_cataj"],0,1) == 0)  { $cur_status_april_antar_jemput = "7-". $src_have_to_pay_apr_exp_antar_jemput[1]; $have_plus_antar_jemput++; } //have paid before the month of payment come 
							if(substr($row_cur_month_val_antar_jemput["apr_cataj"],0,1) == 1)  { $cur_status_april_antar_jemput = "5-". $src_have_to_pay_apr_exp_antar_jemput[1]; } //have paid on time 
							if(substr($row_cur_month_val_antar_jemput["apr_cataj"],0,1) == 2)  { $cur_status_april_antar_jemput = "6-". $src_have_to_pay_apr_exp_antar_jemput[1]; $have_minus_antar_jemput++; } //have paid late 
						
						}
						
						if($src_nama_bulan_diinput_antar_jemput[$i] == 'may') { //11
						
							$per_may_antar_jemput 	= "y"; 
						
							if(substr($row_cur_month_val_antar_jemput["may_cataj"],0,1) == 0)  { $cur_status_may_antar_jemput = "7-". $src_have_to_pay_may_exp_antar_jemput[1]; $have_plus_antar_jemput++; } //have paid before the month of payment come 
							if(substr($row_cur_month_val_antar_jemput["may_cataj"],0,1) == 1)  { $cur_status_may_antar_jemput = "5-". $src_have_to_pay_may_exp_antar_jemput[1]; } //have paid on time 
							if(substr($row_cur_month_val_antar_jemput["may_cataj"],0,1) == 2)  { $cur_status_may_antar_jemput = "6-". $src_have_to_pay_may_exp_antar_jemput[1]; $have_minus_antar_jemput++; } //have paid late 
						
						}
						
						if($src_nama_bulan_diinput_antar_jemput[$i] == 'june') { //12
						
							$per_june_antar_jemput 	= "y"; 
						
							if(substr($row_cur_month_val_antar_jemput["jun_cataj"],0,1) == 0)  { $cur_status_june_antar_jemput = "7-". $src_have_to_pay_jun_exp_antar_jemput[1]; $have_plus_antar_jemput++; } //have paid before the month of payment come 
							if(substr($row_cur_month_val_antar_jemput["jun_cataj"],0,1) == 1)  { $cur_status_june_antar_jemput = "5-". $src_have_to_pay_jun_exp_antar_jemput[1]; } //have paid on time 
							if(substr($row_cur_month_val_antar_jemput["jun_cataj"],0,1) == 2)  { $cur_status_june_antar_jemput = "6-". $src_have_to_pay_jun_exp_antar_jemput[1]; $have_minus_antar_jemput++; } //have paid late 
						
						}
						
						//keterangan lihat SPP
						if($per_july_antar_jemput == "x") 		{ $val_july_antar_jemput = ""; } 		else if ($per_july_antar_jemput == "y")		{ $val_july_antar_jemput = "jul_cataj = '".$cur_status_july_antar_jemput."',"; }
						if($per_august_antar_jemput == "x") 	{ $val_august_antar_jemput = ""; } 		else if ($per_august_antar_jemput == "y")	{ $val_august_antar_jemput = "aug_cataj = '".$cur_status_august_antar_jemput."',"; }
						if($per_september_antar_jemput == "x") 	{ $val_september_antar_jemput = ""; } 	else if ($per_september_antar_jemput == "y"){ $val_september_antar_jemput = "sep_cataj = '".$cur_status_september_antar_jemput."',"; }
						if($per_october_antar_jemput == "x") 	{ $val_october_antar_jemput = ""; } 	else if ($per_october_antar_jemput == "y")	{ $val_october_antar_jemput = "oct_cataj = '".$cur_status_october_antar_jemput."',"; }
						if($per_november_antar_jemput == "x") 	{ $val_november_antar_jemput = ""; } 	else if ($per_november_antar_jemput == "y")	{ $val_november_antar_jemput = "nov_cataj = '".$cur_status_november_antar_jemput."',"; }
						if($per_december_antar_jemput == "x") 	{ $val_december_antar_jemput = ""; }	else if ($per_december_antar_jemput == "y") { $val_december_antar_jemput = "dec_cataj = '".$cur_status_december_antar_jemput."',"; }
						if($per_january_antar_jemput == "x")   	{ $val_january_antar_jemput = ""; } 	else if ($per_january_antar_jemput == "y") 	{ $val_january_antar_jemput = "jan_cataj = '".$cur_status_january_antar_jemput."',"; }
						if($per_february_antar_jemput == "x")	{ $val_february_antar_jemput = ""; } 	else if ($per_february_antar_jemput == "y")	{ $val_february_antar_jemput = "feb_cataj = '".$cur_status_february_antar_jemput."',"; }
						if($per_march_antar_jemput == "x")		{ $val_march_antar_jemput = ""; }    	else if	($per_march_antar_jemput == "y")	{ $val_march_antar_jemput = "mar_cataj = '".$cur_status_march_antar_jemput."',"; }
						if($per_april_antar_jemput == "x")		{ $val_april_antar_jemput = ""; }		else if ($per_april_antar_jemput == "y") 	{ $val_april_antar_jemput = "apr_cataj = '".$cur_status_april_antar_jemput."',"; }
						if($per_may_antar_jemput == "x")		{ $val_may_antar_jemput = ""; }			else if ($per_may_antar_jemput == "y")		{ $val_may_antar_jemput = "may_cataj = '".$cur_status_may_antar_jemput."',"; }
						if($per_june_antar_jemput == "x")		{ $val_june_antar_jemput = ""; } 		else if	($per_june_antar_jemput == "y") 	{ $val_june_antar_jemput = "jun_cataj = '".$cur_status_june_antar_jemput."',"; }
						
						
						//see explanation in spp
						if($have_plus_antar_jemput >= 1) {
						
							$field_have_plus_antar_jemput = "have_plus = '1',";
						
						} else {
						
							$field_have_plus_antar_jemput = "";
							
						}
						
						if($have_minus_antar_jemput >= 1) {
						
							$field_have_minus_antar_jemput = "have_minus = '1',";
						
						} else {
						
							$field_have_minus_antar_jemput = "";
						
						}
						
						
						//So here we go buddy........
						//itu field periode sebenernya gak perlu di-update,..tapi kita butuh dia untuk menyelamatkan , (comma) yang dikirim oleh $val_august_antar_jemput
						//kan yang diakhir gak pake comma, tul gak bro...					
						$cur_periode_cataj	= $row_cur_month_val_antar_jemput["periode"];
						
						
						//here we go
						$set_payment_antar_jemput	= "update tunggakan set 
												$field_have_plus_antar_jemput
												$field_have_minus_antar_jemput
												$val_july_antar_jemput
												$val_august_antar_jemput
												$val_september_antar_jemput
												$val_october_antar_jemput
												$val_november_antar_jemput
												$val_december_antar_jemput
												$val_january_antar_jemput
												$val_february_antar_jemput
												$val_march_antar_jemput
												$val_april_antar_jemput
												$val_may_antar_jemput
												$val_june_antar_jemput
												periode = '$cur_periode_cataj'
												
												where  no_sisda = '$no_sisda_enc' and periode = '$year_antar_jemput_enc' and jenis_tunggakan = 'antar_jemput'
												";
						
						//echo $set_payment_antar_jemput;								
						$query_set_paymnet_antar_jemput	= mysqli_query($mysql_connect, $set_payment_antar_jemput) or die(mysql_error());
							
					}
								
					$src_input_transaksi_antar_jemput	= "insert into transaksi(
																	no_sisda,
																	periode, 
																	nama_siswa,
																	jenjang,
																	tingkat,
																	tanggal_transaksi, 
																	teknik_pembayaran,
																	jumlah_bulan_antar_jemput,
																	bulan_antar_jemput,
																	antar_jemput,
																	jenis_transaksi
																	) values (
																	
																	'$no_sisda_enc', 
																	'$year_antar_jemput_enc',
																	'$nama_siswa_enc',
																	'$jenjang_enc',
																	'$tingkat_enc',
																	'$tanggal_transaksi_enc', 
																	'$teknik_pembayaran_enc',
																	'$num_month_antar_jemput',
																	'$nama_bulan_diinput_antar_jemput',
																	'$nominal_antar_jemput',
																	'antar_jemput'
																	)";
																	
					$query_input_transaksi_antar_jemput	= mysqli_query($mysql_connect, $src_input_transaksi_antar_jemput) or die(mysql_error());
				
					if($query_input_transaksi_antar_jemput) {
					
						$succeed = true;
					
						//We need to check whether all errears has been paid by students, if so we have to turn the field tunggakan to 0 (no arrear)
						//All field values has to be equal with 4,5,6 or 7 to make the status 0
						$src_check_status_antar_jemput 	= "select jul_cataj,aug_cataj,sep_cataj,oct_cataj,nov_cataj,dec_cataj,jan_cataj,feb_cataj,mar_cataj,apr_cataj,may_cataj,jun_cataj from tunggakan where no_sisda = '$no_sisda' and periode = '$year_antar_jemput_enc' and jenis_tunggakan = 'antar_jemput'";
						$query_check_status_antar_jemput = mysqli_query($mysql_connect, $src_check_status_antar_jemput) or die(mysql_error());	
						$row_check_status_antar_jemput	= mysql_fetch_array($query_check_status_antar_jemput);					
						
						$val_jul_sta_exp_antar_jemput	= explode("-",$row_check_status_antar_jemput["jul_cataj"]); $val_jul_sta_antar_jemput = $val_jul_sta_exp_antar_jemput[0]; //echo "<h1>july".$val_jul_sta_antar_jemput."</h1>";
						$val_aug_sta_exp_antar_jemput	= explode("-",$row_check_status_antar_jemput["aug_cataj"]); $val_aug_sta_antar_jemput = $val_aug_sta_exp_antar_jemput[0]; //echo "<h1>aug".$val_aug_sta_antar_jemput."</h1>";
						$val_sep_sta_exp_antar_jemput	= explode("-",$row_check_status_antar_jemput["sep_cataj"]); $val_sep_sta_antar_jemput = $val_sep_sta_exp_antar_jemput[0]; //echo "<h1>sep".$val_sep_sta_antar_jemput."</h1>";
						$val_oct_sta_exp_antar_jemput	= explode("-",$row_check_status_antar_jemput["oct_cataj"]); $val_oct_sta_antar_jemput = $val_oct_sta_exp_antar_jemput[0]; //echo "<h1>oct".$val_oct_sta_antar_jemput."</h1>";
						$val_nov_sta_exp_antar_jemput	= explode("-",$row_check_status_antar_jemput["nov_cataj"]); $val_nov_sta_antar_jemput = $val_nov_sta_exp_antar_jemput[0]; //echo "<h1>nov".$val_nov_sta_antar_jemput."</h1>";
						$val_dec_sta_exp_antar_jemput	= explode("-",$row_check_status_antar_jemput["dec_cataj"]); $val_dec_sta_antar_jemput = $val_dec_sta_exp_antar_jemput[0]; //echo "<h1>dec".$val_dec_sta_antar_jemput."</h1>";
						$val_jan_sta_exp_antar_jemput	= explode("-",$row_check_status_antar_jemput["jan_cataj"]); $val_jan_sta_antar_jemput = $val_jan_sta_exp_antar_jemput[0]; //echo "<h1>jan".$val_jan_sta_antar_jemput."</h1>";
						$val_feb_sta_exp_antar_jemput	= explode("-",$row_check_status_antar_jemput["feb_cataj"]); $val_feb_sta_antar_jemput = $val_feb_sta_exp_antar_jemput[0]; //echo "<h1>feb".$val_feb_sta_antar_jemput."</h1>";
						$val_mar_sta_exp_antar_jemput	= explode("-",$row_check_status_antar_jemput["mar_cataj"]); $val_mar_sta_antar_jemput = $val_mar_sta_exp_antar_jemput[0]; //echo "<h1>mar".$val_mar_sta_antar_jemput."</h1>";
						$val_apr_sta_exp_antar_jemput	= explode("-",$row_check_status_antar_jemput["apr_cataj"]); $val_apr_sta_antar_jemput = $val_apr_sta_exp_antar_jemput[0]; //echo "<h1>apr".$val_apr_sta_antar_jemput."</h1>";
						$val_may_sta_exp_antar_jemput	= explode("-",$row_check_status_antar_jemput["may_cataj"]); $val_may_sta_antar_jemput = $val_may_sta_exp_antar_jemput[0]; //echo "<h1>may".$val_may_sta_antar_jemput."</h1>";
						$val_jun_sta_exp_antar_jemput	= explode("-",$row_check_status_antar_jemput["jun_cataj"]); $val_jun_sta_antar_jemput = $val_jun_sta_exp_antar_jemput[0]; //echo "<h1>jun".$val_jun_sta_antar_jemput."</h1>";
													
						if(
							($val_jul_sta_antar_jemput == 0 || $val_jul_sta_antar_jemput == 4 || $val_jul_sta_antar_jemput == 5 || $val_jul_sta_antar_jemput == 6 || $val_jul_sta_antar_jemput == 7) and
							($val_aug_sta_antar_jemput == 0 || $val_aug_sta_antar_jemput == 4 || $val_aug_sta_antar_jemput == 5 || $val_aug_sta_antar_jemput == 6 || $val_aug_sta_antar_jemput == 7) and
							($val_sep_sta_antar_jemput == 0 || $val_sep_sta_antar_jemput == 4 || $val_sep_sta_antar_jemput == 5 || $val_sep_sta_antar_jemput == 6 || $val_sep_sta_antar_jemput == 7) and
							($val_oct_sta_antar_jemput == 0 || $val_oct_sta_antar_jemput == 4 || $val_oct_sta_antar_jemput == 5 || $val_oct_sta_antar_jemput == 6 || $val_oct_sta_antar_jemput == 7) and
							($val_nov_sta_antar_jemput == 0 || $val_nov_sta_antar_jemput == 4 || $val_nov_sta_antar_jemput == 5 || $val_nov_sta_antar_jemput == 6 || $val_nov_sta_antar_jemput == 7) and
							($val_dec_sta_antar_jemput == 0 || $val_dec_sta_antar_jemput == 4 || $val_dec_sta_antar_jemput == 5 || $val_dec_sta_antar_jemput == 6 || $val_dec_sta_antar_jemput == 7) and
							($val_jan_sta_antar_jemput == 0 || $val_jan_sta_antar_jemput == 4 || $val_jan_sta_antar_jemput == 5 || $val_jan_sta_antar_jemput == 6 || $val_jan_sta_antar_jemput == 7) and
							($val_feb_sta_antar_jemput == 0 || $val_feb_sta_antar_jemput == 4 || $val_feb_sta_antar_jemput == 5 || $val_feb_sta_antar_jemput == 6 || $val_feb_sta_antar_jemput == 7) and
							($val_mar_sta_antar_jemput == 0 || $val_mar_sta_antar_jemput == 4 || $val_mar_sta_antar_jemput == 5 || $val_mar_sta_antar_jemput == 6 || $val_mar_sta_antar_jemput == 7) and
							($val_apr_sta_antar_jemput == 0 || $val_apr_sta_antar_jemput == 4 || $val_apr_sta_antar_jemput == 5 || $val_apr_sta_antar_jemput == 6 || $val_apr_sta_antar_jemput == 7) and
							($val_may_sta_antar_jemput == 0 || $val_may_sta_antar_jemput == 4 || $val_may_sta_antar_jemput == 5 || $val_may_sta_antar_jemput == 6 || $val_may_sta_antar_jemput == 7) and
							($val_jun_sta_antar_jemput == 0 || $val_jun_sta_antar_jemput == 4 || $val_jun_sta_antar_jemput == 5 || $val_jun_sta_antar_jemput == 6 || $val_jun_sta_antar_jemput == 7) 
						) {
						
							$src_zero_status_antar_jemput	= "update tunggakan set status = '0' where no_sisda = '$no_sisda' and periode = '$year_antar_jemput_enc' and jenis_tunggakan = 'antar_jemput'";
							$query_zero_status_antar_jemput	= mysqli_query($mysql_connect, $src_zero_status_antar_jemput) or die(mysql_error());
							echo $src_zero_status_antar_jemput;
							if(!$query_zero_status_antar_jemput) { echo "<h1>update status table tunggakan error, hubungi admin</h1>"; }
						
						}
						
					} else { echo "Data transaksi tidak gagal diinput, hubungi admin"; }
				
				} else { echo "Jumlah uang antar_jemput yang akan dibayarkan tidak sesuai dengan jumlah yang tertera di dalam database (yang seharusnya dibayarkan).<br>Silakan ulangi proses"; }
				
			} else { echo "data antar_jemput tidak lengkap"; }
								
		}else { echo "<h1>2</h1>"; }
		
	} else { echo "<h1>1</h1>"; }
	
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
								nama_siswa,
								jenjang,
								tingkat,
								tanggal_transaksi, 
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
								'$nama_siswa_enc',
								'$jenjang_enc',
								'$tingkat_enc',
								'$tanggal_transaksi_enc', 
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
		
		if($query_input_ruba) $succeed = true;
	}
	
	
	///////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////
	//////////////////////////SCHOOL SUPPORT///////////////////////////
	///////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////
	if(!empty($_POST["subtotal_schspt"]) && $_POST["subtotal_schspt"] != 0) {
	
		$nama_item_schspt					= $_POST["nama_item_schspt"];
		$nama_item_schspt_enc				= mysql_real_escape_string($nama_item_schspt);
		
		$nominal_item_schspt				= $_POST["nominal_item_schspt"];
		$nominal_item_schspt_enc			= mysql_real_escape_string($nominal_item_schspt);
		
		$subtotal_schspt					= $_POST["subtotal_schspt"];
		$subtotal_schspt_enc				= mysql_real_escape_string($subtotal_schspt);
	
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
		
		//define $array as array
		$array = array();
		
		while($get_schspt	= mysql_fetch_array($query_get_schspt)) {		
			$cur_i_sch_sup	= $i_sch_sup++;
		
			//Define the array as the post variable that received from transaction page
			$chk_zero_sch_sup = empty($_POST["sch_sup_".$cur_i_sch_sup."_schspt"]) ? 0 : $_POST["sch_sup_".$cur_i_sch_sup."_schspt"];
			//$array[] = $_POST["sch_sup_".$cur_i_sch_sup."_schspt"];	
			$array[] = $chk_zero_sch_sup;
		}		
		
		//There are two condition with additional school support item.
		//Those are:
		//1. item name and nominal is not empty
		//2. item name and nominal is empty			
		if(!empty($nominal_item_schspt) && !empty($nama_item_schspt_enc)) {
		
			//We put the additional school support item in the end of part of $school_support
			//We implode the result with comma(,)	
			
			if($num_get_schspt == 0) {	
			
				$school_support = $nominal_item_schspt;
			
			} else {
			
				$school_support = implode(",", $array).",".$nominal_item_schspt; 
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
			
		}
			
		$src_input_schspt	= "insert into transaksi (
								no_sisda, 
								nama_siswa,
								jenjang,
								tingkat,
								tanggal_transaksi, 
								teknik_pembayaran, 
								jenis_transaksi, 
								school_support
								$if_transfer_item
								) values (
								'$no_sisda_enc',
								'$nama_siswa_enc',
								'$jenjang_enc',
								'$tingkat_enc',
								'$tanggal_transaksi_enc', 
								'$teknik_pembayaran_enc',
								'schspt',
								'$school_support'
								$if_transfer_value
								)";
		$query_input_schspt	= mysqli_query($mysql_connect, $src_input_schspt) or die(mysql_error());
		
		if($query_input_schspt) $succeed = true;
	}
	
	
	if(empty($succeed)) {
	
		$redirect_path	= "";
		$redirect_icon	= "images/icon_false.png";
		$redirect_url	= "mainpage.php?pl=transaction&no=$no_sisda_enc";
		$redirect_text	= "Tidak ada data yang diisi dalam form";
		
		$need_redirect	= true;
		include_once ("include/redirect.php");
	
	} else if($succeed == true) {
	
		//---------------------------------------
		//here are variables that used in prog_log.php
		include_once("include/url.php");
		$activity	= "Insert data transaction";
		$url		= curPageURL();
		$id			= $_SESSION["id"];
		$need_log	= true;
		include_once("include/log.php");
		//---------------------------------------
		
		$redirect_path	= "";
		$redirect_icon	= "images/icon_true.png";
		$redirect_url	= "mainpage.php?pl=transaction_src_idsisda";
		$redirect_text	= "Transaksi berhasil dilakukan";
		
		$need_redirect	= true;
		include_once ("include/redirect.php");
		
	}	
} else {
	echo "srssr".$_SESSION["id"];
	echo "fddfg".$_SESSION["privilege"];
	
	//header("location:index.php");
}

?>