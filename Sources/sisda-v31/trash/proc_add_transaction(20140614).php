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
											status				=  '$cur_status_bima'
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
									'$pengembangan_bima_enc',
									'$kegiatan_bima_enc',
									'$peralatan_bima_enc',
									'$seragam_bima_enc',
									'$paket_bima_enc',
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
		
		$kekurangan_spp						= $_POST["kekurangan_spp"] ? 0 : $_POST["kekurangan_spp"];
		$kekurangan_spp_enc					= mysql_real_escape_string($kekurangan_spp);
		
		$tahun_bayar_berikut_spp			= empty($_POST["tahun_bayar_berikut_spp"]) ? 0 : $_POST["tahun_bayar_berikut_spp"];
		$bulan_bayar_berikut_spp			= empty($_POST["bulan_bayar_berikut_spp"]) ? 0 : $_POST["bulan_bayar_berikut_spp"];
		$tanggal_bayar_berikut_spp			= empty($_POST["tanggal_bayar_berikut_spp"]) ? 0 : $_POST["tanggal_bayar_berikut_spp"];
		
		$src_tanggal_bayar_berikut_spp		= $_POST["tahun_bayar_berikut_spp"]."-".$_POST["bulan_bayar_berikut_spp"]."-".$_POST["tanggal_bayar_berikut_spp"];
		$tanggal_bayar_berikut_spp_enc		= mysql_real_escape_string($src_tanggal_bayar_berikut_spp);
		
		$subtotal_spp						= $_POST["subtotal_spp"];
		$subtotal_spp_enc					= mysql_real_escape_string($subtotal_spp);
	
		/////--------------------------------------------------------//////
		//Yo-Yo-Yo..... look at what happen here...
		//we will work in many conditions with SPP, it's why you will find so many proccess here.
		//i hope it's not confusing you.....qqackkk-qackkkk-qackkkk, kamal juragan kambing garut KW5
		//Okay......
		//SPP is seperated into two conditions, you'll know it, if you see the from in page_transaction.php
		//SPP can be submitted via two ways. which are:
		//-------------->
		//1. Field group -Biaya masuk-
		//We have a field known as SPP Juli. so, student has to do the first payment of SPP, which it's for July
		//and we take the current year of study from
		//As a result, it's so simple. We only need to change the field july in table tunggakan, to 2. that's it, nothing else.
		//because the value will be taken from a text field type input.
		//-------------->
		//2. Field group -SPP-	
		
		
		//we are working in SPP- SPP- SPP- SPP
		/////////////////////////////////////
		//bon ambil dulu data dari database si fulan ini, cocokin yang udah bayarnya yang mana?
		///ngertikan??????????????????????  ---> GAK NGERTI>>>hehehe (Gila Xampeyan)
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
		
			//make a looping as many as count value of bulan_spp
			//if in the looping a month is selected, turn the $per_'month x' above to "y"
			for($i=0; $i<$count_bulan_spp; $i++) {
			
				//echo $bulan_spp[$i]."<br>";		
				//echo "mana:".$bulan_spp[$i]."<br>";
				if($bulan_spp[$i] == 'july')		{ $per_july = "y"; }
				if($bulan_spp[$i] == 'august')		{ $per_august = "y"; } 
				if($bulan_spp[$i] == 'september') 	{ $per_september = "y"; }
				if($bulan_spp[$i] == 'october') 	{ $per_october = "y"; }
				if($bulan_spp[$i] == 'november') 	{ $per_november = "y"; }
				if($bulan_spp[$i] == 'december')	{ $per_december = "y"; }
				if($bulan_spp[$i] == 'january') 	{ $per_january = "y"; }
				if($bulan_spp[$i] == 'february') 	{ $per_february = "y"; }
				if($bulan_spp[$i] == 'march') 		{ $per_march = "y"; }
				if($bulan_spp[$i] == 'april') 		{ $per_april = "y"; }
				if($bulan_spp[$i] == 'may') 		{ $per_may = "y"; }
				if($bulan_spp[$i] == 'june') 		{ $per_june = "y"; }
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
			if($per_july == "y") 		{ $val_july = 2; } 		else if ($per_july == "x")		{ $val_july = $row_cur_month_val["july"]; }
			if($per_august == "y") 		{ $val_august = 2; } 	else if ($per_august == "x")	{ $val_august = $row_cur_month_val["august"]; }
			if($per_september == "y") 	{ $val_september = 2; } else if ($per_september == "x")	{ $val_september = $row_cur_month_val["september"]; }
			if($per_october == "y") 	{ $val_october = 2; } 	else if ($per_october == "x")	{ $val_october = $row_cur_month_val["october"]; }
			if($per_november == "y") 	{ $val_november	= 2; } 	else if ($per_november == "x") 	{ $val_november = $row_cur_month_val["november"]; }
			if($per_december == "y") 	{ $val_december	= 2; }	else if ($per_december == "x") 	{ $val_december= $row_cur_month_val["december"]; }
			if($per_january == "y")   	{ $val_january = 2; } 	else if ($per_january == "x") 	{ $val_january = $row_cur_month_val["january"]; }
			if($per_february == "y")	{ $val_february	= 2; } 	else if ($per_february == "x")	{ $val_february	= $row_cur_month_val["february"]; }
			if($per_march == "y")		{ $val_march = 2; }    	else if	($per_march == "x")		{ $val_march = $row_cur_month_val["march"]; }
			if($per_april == "y")		{ $val_april = 2; }		else if ($per_april == "x") 	{ $val_april = $row_cur_month_val["april"]; }
			if($per_may == "y")			{ $val_may = 2; }		else if ($per_may == "x")		{ $val_may = $row_cur_month_val["may"]; }
			if($per_june == "y")		{ $val_june	= 2; } 		else if	($per_june == "x") 		{ $val_june	= $row_cur_month_val["june"]; }
		
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
			
			
			//So here we go buddy........
			$set_spp_payment	= "update tunggakan set 
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
			
			if($query_set_spp_paymnet) {
			
				$src_input_spp	= "insert into transaksi (
									no_sisda, 
									nama_siswa,
									jenjang,
									tingkat,
									tanggal_transaksi, 
									teknik_pembayaran,
									tahun_ajaran_spp,
									bulan_spp,
									spp_spp,
									ks_spp,
									kekurangan_spp,
									tanggal_bayar_berikut_spp,
									jenis_transaksi 
									$if_transfer_item
									) values (
									'$no_sisda_enc', 
									'$nama_siswa_enc',
									'$jenjang_enc',
									'$tingkat_enc',
									'$tanggal_transaksi_enc', 
									'$teknik_pembayaran_enc',
									'$year_spp_enc',
									'$count_bulan_spp',
									'$spp_spp_enc',
									'$ks_spp_enc',
									'$kekurangan_spp_enc',
									'$tanggal_bayar_berikut_spp_enc',
									'spp'
									$if_transfer_value 
									)";
				$query_input_spp	= mysqli_query($mysql_connect, $src_input_spp) or die(mysql_error());
				
				if($query_input_spp) $succeed = true;
				
			}
		
		}		
			
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
		$subtotal_ruba_enc					= mysql_real_escape_string(subtotal_ruba);
	
	
		$src_input_ruba	= "insert into transaksi (
								no_sisda, 
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
								'spp'
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
			$array[] = $_POST["sch_sup_".$cur_i_sch_sup."_schspt"];	
			
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
			$school_support = implode("", $array); 
			
		}
			
		$src_input_schspt	= "insert into transaksi (
								no_sisda, 
								tanggal_transaksi, 
								teknik_pembayaran, 
								jenis_transaksi, 
								school_support
								$if_transfer_item
								) values (
								'$no_sisda_enc',
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