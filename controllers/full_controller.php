<?php 
class Full_controller extends base_controller {
	private $data;
	
	private $matrix_x;
	private $matrix_r;
	private $nilai_max;
	private $w = [0.5, 0.5, 0.75, 0.5, 1];

	private $bobot = 0.00;

	public function index() {
		$user = ['faisal', 'bobi', 'saruan'];

		$this->data['user']['faisal'] 	= [73, 88, 1, 0, 18];
		$this->data['user']['bobi'] 	= [85, 92, 2, 1, 16];
		$this->data['user']['saruan'] 	= [70, 80, 3, 0, 16];

		echo "data asli <br>";
		for($i = 0; $i < count($user); $i++) {
			for($j = 0; $j < count($this->data['user'][$user[$i]]); $j++) {
				$nilai = $this->data['user'][$user[$i]][$j];
				echo $nilai.' ';
				switch ($j) {
					case '0': 
						$bobot = $this->hitung_bobot_rapot($nilai);
						break;
					case '1': 
						$bobot = $this->hitung_bobot_un($nilai);
						break;
					case '2': 
						$bobot = $this->hitung_bobot_jur($nilai);
						break;
					case '3': 
						$bobot = $this->hitung_bobot_ekskul($nilai);
						break;
					case '4': 
						$bobot = $this->hitung_bobot_simsoal($nilai);
						break;
					default:
						echo "null";
						break;
				}

				$this->matrix_x['user'][$user[$i]][$j] = $bobot;
			}
			echo "<br>";
		}

		echo "<br>";
		echo "decision matrix X<br>";
		for($i = 0; $i < count($user); $i++) {
			for($j = 0; $j < count($this->matrix_x['user'][$user[$i]]); $j++) {
				echo $this->matrix_x['user'][$user[$i]][$j].' ';
				

			}
			echo "<br>";
		}

		echo "<br>";
		echo "nilai max setiap user<br>";
		$total_kriteria = 5;
		$max = 0;
		for($i = 0; $i < $total_kriteria; $i++) {
			for($j = 0; $j < count($user); $j++) {
				
				echo $this->matrix_x['user'][$user[$j]][$i].' ';
				$nilai_index = $this->matrix_x['user'][$user[$j]][$i];

				if ($nilai_index > $max) {
					$max = $nilai_index;
				}
			}
			$this->nilai_max[$i] = $max;
			echo " -> ".$this->nilai_max[$i];
			$max = 0;
			echo "<br>";
		}	

		echo "<br>";
		echo "decision matrix R<br>";
		for($i = 0; $i < count($user); $i++) {
			for($j = 0; $j < count($this->matrix_x['user'][$user[$i]]); $j++) {
				$this->matrix_r['user'][$user[$i]][$j] = $this->matrix_x['user'][$user[$i]][$j] / $this->nilai_max[$j];

				echo $this->matrix_r['user'][$user[$i]][$j].' | ';
			}
			echo "<br>";
		}				

		echo "<br>";
		echo "alternatif terbaik dari setiap elemen di matrix R<br>";
		$nilai_alt = 0;
		for($i = 0; $i < count($user); $i++) {
			for($j = 0; $j < 5; $j++) {
				$nilai_alt += ($this->matrix_r['user'][$user[$i]][$j] * $this->w[$j]); 
			}
			$temp[$i] = $nilai_alt;
			echo "alt $i -> $temp[$i]";
			$nilai_alt = 0;
			echo '<br>';
		}

	}

// --------------------------------------------------------------------------------------------------------------------
	
	// c1
	public function hitung_bobot_rapot($nilai) {
		if ($nilai <= 50) 
			return $this->bobot;
		else if ($nilai >= 51 && $nilai <= 65)
			$this->bobot = 0.25;
		else if ($nilai >= 66 && $nilai <= 80)
			$this->bobot = 0.5;
		else if ($nilai >= 81 && $nilai <= 90)
			$this->bobot = 0.75;
		else if ($nilai >= 91 && $nilai <= 100)
			$this->bobot = 1;

		return $this->bobot;
	}

	// c2
	public function hitung_bobot_un($nilai) {
		if ($nilai <= 40) 
			return $this->bobot;
		else if ($nilai >= 41 && $nilai <= 60)
			$this->bobot = 0.25;
		else if ($nilai >= 61 && $nilai <= 80)
			$this->bobot = 0.5;
		else if ($nilai >= 81 && $nilai <= 90)
			$this->bobot = 0.75;
		else if ($nilai >= 91 && $nilai <= 100)
			$this->bobot = 1;

		return $this->bobot;
	}

	// c3
	public function hitung_bobot_jur($nilai) {
		if ($nilai == 3) 
			$this->bobot = 0.25;
		else if ($nilai == 2)
			$this->bobot = 0.5;
		else if ($nilai == 1)
			$this->bobot = 0.75;

		return $this->bobot;
	}

	// c4
	public function hitung_bobot_ekskul($nilai) {
		if ($nilai == 0) 
			$this->bobot = 0.5;
		else if ($nilai == 1)
			$this->bobot = 1;

		return $this->bobot;
	}

	// c5
	public function hitung_bobot_simsoal($total_jwbenar) {
		$total_soal = 20;
		$nilai = 0;

		$nilai = 1 - (($total_soal - $total_jwbenar) / $total_soal);

		if ($nilai <= 0.3) 
			$this->bobot = 0.25;
		else if ($nilai >= 0.31 && $nilai <= 0.5)
			$this->bobot = 0.5;
		else if ($nilai >= 0.51 && $nilai <= 0.7)
			$this->bobot = 0.75;
		else if ($nilai >= 0.71 && $nilai <= 1)
			$this->bobot = 1;

		return $this->bobot;
	}
}