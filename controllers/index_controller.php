<?php 
	require_once('soal.php');
	require_once('nilai.php');
	require_once('charts_controller.php');


	class index_controller extends base_controller{
	
		public function __construct() {
			parent::__construct();

			$this->load->model('crud');
		}

		public function index() {
			$data['total_smstr'] = 6;
			$data['pelajaran'] = array(
										'mtk' => 'Matematika', 
										'ipa' => 'IPA',
										'ips' => 'IPS');

			$data['mapel_un'] = array(	
										'ipa' => 'IPA', 
										'mtk' => 'Matematika',
										'ips' => 'IPS');
			
			$data['jurusan'] = array(
										'ipa' => 'IPA',
										'ips' => 'IPS');

			$data['ptsi_non'] = array(
										'bd_relevan_ipa' => 'Bidang relevan yang meliputi MTK, FISIKA, KIMIA',
										'bd_relevan_ips' => 'Bidang relevan yang meliputi KWN, Ekonomi, Sosiologi, Sejarah, Geografi');

			$data['soal'] = $this->get_soalnjwbn();

			// print_r($data['soal']['list_soal'][0]['id_jenis_soal']);	

			// foreach($data['soal']['list_soal'] as $key_soal => $value_soal) {
			// 	echo $value_soal->id.'. ';
			// 	echo $value_soal->soal.'<br>';
			// 	for($i = 0; $i < 4; $i++) {

			// 		echo $data['soal']['list_jawaban'][$value_soal->id][$i]->pilihan_ganda.'. ';
			// 		echo $data['soal']['list_jawaban'][$value_soal->id][$i]->jawaban;
			// 		// print_r($data['soal']['list_jawaban']);
			// 		echo '<br>';				
			// 	}
			// 	echo "<br>";
			// }

			$this->load->view('templates/header');	
			$this->load->view('templates/navbar');
			$this->load->view('index', $data);
		}

		public function get_soalnjwbn() {
			// get soal
		    $data['list_soal'] = json_decode($this->crud->get('tb_soal'));


		    // $data['list_soal'] = $this->crud->get('tb_soal')->result_array();
		    // get jawaban according to id soal
		   	foreach ($data['list_soal'] as $key => $value) {
		    	
		   		$data['list_jawaban'][$value->id] = json_decode($this->crud->get_where('tb_jawaban', ['id_soal' => $value->id]));
				// echo "<pre>".print_r($data['list_jawaban'][$value->id],1)."</pre>";

		   	}

		   	return $data;
		}

		public function lihat_hasil() {

			// get data dari inputan user
			// cek NISN
			$data['nisn'] = $_POST['nisn'];

			$data['mapel_us']['mtk'] = 0;
			$data['mapel_us']['ipa'] = 0;
			$data['mapel_us']['ips'] = 0;

			$total = 0;
			$smstr = 1;
			// total rata rata dari nilai rapot semester 1 -6
			foreach ($data['mapel_us'] as $key => $value) {
				
				for($i = 1; $i <= 6; $i++) {
					$total += $_POST[$key.'_smstr'.$smstr];
				}

				$data['mapel_us'][$key] = $total / 6;
				$smstr += 1;
				$total = 0; # reset
			}

			// nilai ujian nasional
			$data['mapel_un']['ipa'] = $_POST['ipa'];
			$data['mapel_un']['ips'] = $_POST['mtk'];
			$data['mapel_un']['mtk'] = $_POST['ips'];

			// nilai angka dari jurusan yang diinginkan
			$data['jurusan_ipa'] = $_POST['jurusan_ipa'];
			$data['jurusan_ips'] = $_POST['jurusan_ips'];

			// nilai angka jika siswa mempunyai prestasi non-akademik
			if(isset($_POST['bd_relevan_ipa']) && isset($_POST['bd_relevan_ips'])) {
				$data['bd_relevan_ipa'] = $_POST['bd_relevan_ipa'];
				$data['bd_relevan_ips'] = $_POST['bd_relevan_ips'];
			}
			else {
				$data['bd_relevan_ipa'] = 0;
				$data['bd_relevan_ips'] = 0;
			}

			// nilai dari hasil jawaban simulasi soal
			$soal = new Soal();

			// komentar dua baris di bawah ini jika masing masing soal ipa dan ips sudah dimasukkan 20 di database
			$data['soal_ipa'] = $soal->get_benar($_POST['soal'], $offset=0);
			$data['soal_ips'] = 9;

			// hapus komentar dua baris di bawah ini jika masing-masing soal ipa dan ips sudah dimasukkan 20 di database
			// $data['soal_ipa'] = $soal->get_benar($_POST['soal'], $offset=0);
			// $data['soal_ips'] = $soal->get_benar($_POST['soal'], $offset=20);

			// echo "<pre>".print_r($data, 1)."</pre>";

			$nilai_ipa[] = (int)($data['mapel_us']['mtk'] + $data['mapel_us']['ipa']) / 2;
			$nilai_ipa[] = (int)($data['mapel_un']['mtk'] + $data['mapel_un']['ipa']) / 2;
			$nilai_ipa[] = (int)$data['jurusan_ipa'];
			$nilai_ipa[] = (int)$data['bd_relevan_ipa'];
			$nilai_ipa[] = (int)$data['soal_ipa'];

			$nilai_ips[] = (int)$data['mapel_us']['ips'];
			$nilai_ips[] = (int)$data['mapel_un']['ips'];
			$nilai_ips[] = (int)$data['jurusan_ips'];
			$nilai_ips[] = (int)$data['bd_relevan_ips'];
			$nilai_ips[] = (int)$data['soal_ips'];

			$nilai = new Nilai;
			$nilai_alt = $nilai->hitung_bobot($nilai_ipa, $nilai_ips);

			session_start();
			$_SESSION["nilai_alt"] = $nilai_alt;
			
			$charts = new Charts_controller();
			$charts->render_charts();
		}
	}