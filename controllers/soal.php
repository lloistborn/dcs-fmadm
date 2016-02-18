<?php
class soal extends base_controller {

	public function index() {}

	public function get_benar($array_data, $offset) {
		$this->load->model('crud');

		$jwbn 	= json_decode($this->crud->get('tb_soal', $offset));

		$iter 	= count($jwbn);
		$benar 	= 0;

		for($i = 0; $i < $iter; $i++) {
			if($jwbn[$i]->id_jawaban == $array_data[$i+1]) {
				$benar += 1;
			}
		}

		return $benar;
	}
}