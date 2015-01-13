<?php
class Simulator extends CI_Controller{

	public function index(){
		$week[1][0] = "星期一";
		$week[2][0] = "星期一";


		$this->load->view('simulator_view',$week);
	}

}


?>