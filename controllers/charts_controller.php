<?php 
class charts_controller extends base_controller {
	public function index() {}

	public function render_charts() {
		$data = $_SESSION["nilai_alt"];

		$vars['ipa'] = $data[0];
		$vars['ips'] = $data[1];

		$this->load->view('hasil', $vars);
	}
}