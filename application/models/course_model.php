<?php
class Course_model extends CI_Model{

	function __construct(){ 
		parent::__construct();
		$this->load->database();//載入database設定

	}
	/* 顯示資料 */
	function get_select_all($page_size,$offset){
		$this->db->select('syear,cos_dept,cos_year,cos_num,cos_title,cos_require,cos_credit,cos_hours,cos_teacher,cos_room,cos_time,course_id');
		//$this->db->from('course');
		//$query = $this-> db->get('course',10,20);
		$query = $this-> db->get('course',$page_size,$offset);
		return $query->result_array();

	}
	/* 顯示學期年 */
	function get_select_syear(){
		$this->db->distinct();
		$this->db->select('syear');
		$this->db->from('course');
		$query= $this->db->get();
		return $query->result_array();

	}

	/* 顯示必選修 */
	function get_select_require(){
		$this->db->distinct();
		$this->db->select('cos_require');
		$this->db->from('course');
		$query=$this->db->get();
		return $query->result_array();
	}

	/* 顯示系級 */
	function get_select_dept(){
		$this->db->distinct();
		$this->db->select('cos_dept');
		$this->db->from('course');
		$query= $this->db->get();
		return $query->result_array();

	}

	/* 詳細資料 */
	function get($courseID){
		$this->db->select("syear,cos_dept,cos_year,cos_num,cos_title,cos_require,cos_credit,cos_hours,cos_teacher,cos_room,cos_time,course_id");
		$this->db->from('course');
		$this->db->where(Array("course_id" => $courseID));
		$query = $this->db->get();

		if($query->num_rows() <= 0){
			return null;

		}
		return $query->row();
	}

}

?>