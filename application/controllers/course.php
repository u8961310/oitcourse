<?php 
class Course extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->database();
		//載入資料庫
		$this->load->model('course_model');
	}
	public function index(){
		$this->page();


	}
	public function page(){

		//分頁libary
		$this->load->library('pagination');
		$config['base_url'] = site_url('course/page/');
		$config['per_page'] = 20;
		$config['num_links'] = 2;
		$config['total_rows'] = $this->db->get('course')->num_rows();
		
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link'] = '&laquo;';//自訂開始分頁連結名稱
		$config['first_tag_open'] = '<li class="prev page">';
		$config['first_tag_close'] = '</li>';
		$config['last_link'] = '&raquo;'; //自訂結束分頁連結名稱
		$config['last_tag_open'] = '<li class="next page">';
		$config['last_tag_close'] = '</li>';
		 
		$config['next_link'] = '下一頁 >';
		$config['next_tag_open'] = '<li class="next page">'; //自訂下一頁標籤
		$config['next_tag_close'] = '</li>';
		 
		$config['prev_link'] = '< 上一頁';
		$config['prev_tag_open'] = '<li class="prev page">';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a>';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li class="page">';
		$config['num_tag_close'] = '</li>';
		$this->pagination->initialize($config);
		$offset = $this->uri->segment(3);
		//資料庫載入
		//$data['query'] = $this->db->get('course',$config['per_page']);
		$data['query'] = $this->course_model->get_select_all($config['per_page'],$offset);
		$data['syear'] = $this->course_model->get_select_syear();
		$data['search_dept']  = $this->course_model->get_select_dept();
		$data['search_require'] = $this->course_model->get_select_require();
		//分頁
		$data['pagination'] = $this->pagination->create_links();
		$this->load->view('course',$data);

		

	}
	public function view($courseID=null){
		if($courseID ==null){
			show_404("沒有資料");
			return true;
		}
		$this->load->model('course_model');
		$course = $this->course_model->get($courseID);
		//print_r($course);
		if($course == null){
			show_404("沒有資料");
			return true;
		}	

		$this->load->view('course_detail_view',array(
			"pageTitle"=> $course->cos_title."| ",
			"course"=>$course
			));
	} 


}


?>