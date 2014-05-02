<?php 
if (! defined('BASEPATH')) exit('No direct script access');

class Common_methods extends CI_Model {

	//php 5 constructor
	function __construct() {
		parent::__construct();
	}
	
	function getPrimaryImg($user_id)
	{
		$query = $this->db->get_where('user_images', array('user_id' => $user_id,'primary'=>1));
		$data = $query->row_array();
		
		//echo $this->db->last_query();
		
		$count = $query->num_rows();
		if($count>0)
			return $data;
		else
			return 0;
	}
	
	
	
	
	
	
	
	function checkAnswer($answer_id)
	{
		$this->db->select('*');
		$this->db->from('answer');
		$this->db->where('answer_id', $answer_id);
		$this->db->where('correct', 1);

		$query = $this->db->get();
		//echo $this->db->last_query();//exit;
		
		$count = $query->num_rows();
		
		if($count>0)
			return 1;
		else
			return 0;
	}
	
	function getStudenDtls($student_id)
	{
		$query = $this->db->get_where('school_student', array('student_id' => $student_id ));
		$data = $query->row_array();
		//echo '<pre>'.print_r($data,true).'</pre>';
		//exit;
		return $data;
	}
	
	function getUserDtls($user_id)
	{
		$query = $this->db->get_where('organisation_user', array('id' => $user_id ));
		$data = $query->row_array();
		//echo '<pre>'.print_r($data,true).'</pre>';
		//exit;
		return $data;
	}
	
	function getAdminDtls($admin_id)
	{
		$query = $this->db->get_where('fundo_admin', array('admin_id' => $admin_id ));
		$data = $query->row_array();
		//echo '<pre>'.print_r($data,true).'</pre>';
		//exit;
		return $data;
	}
	
	function getComment($gid,$pid)
	{
		$this->db->select('*');
		$this->db->from('fundo_comment');
		$this->db->where('group_id', $gid);
		$this->db->where('post_id', $pid);
		$this->db->order_by("com_id", "asc"); 
		//$this->db->group_by('schl_grade_id');

		$query = $this->db->get();
		//echo $this->db->last_query();//exit;
		
		$data = $query->result_array();
		$count = $query->num_rows();
		
		if($count>0)
			return $data;
		else
			return 0;
	}
	
	function getQuesById($question_id)
	{
		$this->db->select('SC.*');
		$this->db->from('question as SC');
		
		$this->db->where('SC.question_id', $question_id);
		$query = $this->db->get();
		
		//echo $this->db->last_query();//exit;
		
		$data = $query->row_array();
		$count = $query->num_rows();
		
		if($count>0)
			return $data;
		else
			return 0;
	}
	function getQuesOptionById($question_id)
	{
		$this->db->select('SC.*');
		$this->db->from('school_exercise_options as SC');
		
		$this->db->where('SC.ques_id', $question_id);
		$query = $this->db->get();
		
		//echo $this->db->last_query();exit;
		
		$data = $query->result_array();
		$count = $query->num_rows();
		
		if($count>0) return $data; else return 0;
	}
	
	function correctOption($ques_id)
	{
		$this->db->select('SC.*');
		$this->db->from('school_exercise_options as SC');
		$this->db->where('SC.ques_id', $ques_id);
		$this->db->where('SC.correct_ans', 1);
		$query = $this->db->get();
		//echo $this->db->last_query();//exit;
		
		$data = $query->result_array();
		/*echo "<pre>";
		print_r($data); exit;
		echo "</pre>";*/
		$count = $query->num_rows();
		if($count>0) return $data; else return 0;
	}

	function chkUserDtls($user_id)
	{
		
		$this->db->select('*');
		$this->db->from('fundo_assign_user');
		
		$this->db->where('user_id', $user_id);
		$query = $this->db->get();
		
		//echo $this->db->last_query();//exit;
		
		$data = $query->result_array();
		$count = $query->num_rows();
		
		if($count>0)
			return $data;
		else
			return 0;
	}
	
	function chkComplete($content_id,$category_type)
	{
		
		$this->db->select('SC.*');
		$this->db->from('progress as SC');
		
		$this->db->where('SC.content_id', $content_id);
		$this->db->where('SC.category_type', $category_type);
		$query = $this->db->get();
		
		//echo $this->db->last_query();//exit;
		
		$data = $query->result_array();
		$count = $query->num_rows();
		
		if($count>0)
			return $count;
		else
			return 0;
	}
	
	
	function chkgrade($grade_id,$teacher)
	{
		
		$this->db->select('SC.*');
		$this->db->from('teacher_subject as SC');
		
		$this->db->where('SC.grade_id', $grade_id);
		$this->db->where('SC.teacher_id', $teacher);
		$query = $this->db->get();
		
		//echo $this->db->last_query();//exit;
		
		$data = $query->result_array();
		$count = $query->num_rows();
		
		if($count>0)
			return $count;
		else
			return 0;
	}
	
	
	function chkSubject($grade_id,$sid)
	{
		
		$this->db->select('SC.*');
		$this->db->from('school_category as SC');
		
		$this->db->where('SC.schl_grade_id', $grade_id);
		$this->db->where('SC.school_id', $sid);
		$query = $this->db->get();
		
		//echo $this->db->last_query();//exit;
		
		$data = $query->result_array();
		$count = $query->num_rows();
		
		if($count>0)
			return $data;
		else
			return 0;
	}
	
	function chkCompleteTest($test_id)
	{
		$this->db->select('*');
		$this->db->from('progress');
		
		$this->db->where('content_id', $test_id);
		$this->db->where('category_type', 2);
		$query = $this->db->get();
		
		//echo $this->db->last_query();//exit;
		
		$data = $query->result_array();
		$count = $query->num_rows();
		
		if($count>0)
			return $count;
		else
			return 0;
	}
	
	function chkCompletecontent($content_id)
	{
		$this->db->select('*');
		$this->db->from('progress');
		
		$this->db->where('content_id', $content_id);
		$this->db->where('category_type', 1);
		$query = $this->db->get();
		
		//echo $this->db->last_query();//exit;
		
		$data = $query->result_array();
		$count = $query->num_rows();
		
		if($count>0)
			return $count;
		else
			return 0;
	}
	
	
	function chksub($grade_id,$sid,$sub_id,$tid)
	{
		
		$this->db->select('SC.*');
		$this->db->from('teacher_subject as SC');
		
		$this->db->where('SC.grade_id', $grade_id);
		$this->db->where('SC.school_id', $sid);
		$this->db->where('SC.teacher_id', $tid);
		$this->db->where('SC.subject_id', $sub_id);
		$query = $this->db->get();
		
		//echo $this->db->last_query();//exit;
		
		$data = $query->result_array();
		$count = $query->num_rows();
		
		if($count>0)
			return $count;
		else
			return 0;
	}
	
	
	function check_global($global_id)
	{
		$this->db->select('*');
		$this->db->from('school_exercise');
		
		$this->db->where('global_id', $global_id);
		$this->db->where('school_id', $this->session->userdata('school_id'));
		$query = $this->db->get();
		
		//echo $this->db->last_query();//exit;
		
		$data = $query->result_array();
		$count = $query->num_rows();
		
		if($count>0)
			return $count;
		else
			return 0;
	}
	
	function check_global_ques($global_id)
	{
		$this->db->select('*');
		$this->db->from('school_question');
		
		$this->db->where('global_id', $global_id);
		$this->db->where('school_id', $this->session->userdata('school_id'));
		$query = $this->db->get();
		
		//echo $this->db->last_query();//exit;
		
		$data = $query->result_array();
		$count = $query->num_rows();
		
		if($count>0)
			return $count;
		else
			return 0;
	}
	
	function countStudentBySchoolId($schlid)
	{
		$this->db->select('count(*) as no_student');
		$this->db->from('school_student');
		$this->db->where('school_name',$schlid);
		$query = $this->db->get();
		
		$data = $query->row_array();
		//echo $this->db->last_query();//exit;

		return $data;
	}
	
	function countTeacherBySchoolId($schlid)
	{
		$this->db->select('count(*) as no_teacher');
		$this->db->from('admin');
		$this->db->where('organisation_school_name',$schlid);
		$this->db->where('admin_type',4);
		$query = $this->db->get();
		
		$data = $query->row_array();
		//echo $this->db->last_query();//exit;

		return $data;
	}
	
	function getSchoolAdminforSchoolAdministrator($school_id)
	{
		$this->db->select('sa.*, a.fname, a.lname');
		$this->db->from('school_administrator as sa');
		$this->db->join('admin as a', 'a.admin_id = sa.admin_id' );
		$this->db->where('sa.school_id', $school_id);

		$query = $this->db->get();
		//echo $this->db->last_query();//exit;
		$data = $query->result_array();
		$count = $query->num_rows();
		
		$query->free_result();
		
		if($count>0) return $data; else return 0;
	}
}