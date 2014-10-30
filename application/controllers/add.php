<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    class Add extends CI_Controller{
        public function __construct(){
            parent::__construct();
            $this->load->model('cdb');
        }
        public function index(){
            $this->load->view('add');
        }
        public function ajax(){
            $dept= $_POST['dept'];
            $cid= $_POST['cid'];
            $cname= $_POST['cname'];
            $classes= $_POST['classes'];
            $time= $_POST['time'];
            $location= $_POST['location'];
            $teacher= $_POST['teacher'];
            $grade= $_POST['grade'];
            $content= addslashes($_POST['content']);
            $result= $this->cdb->add("INSERT INTO `course`(`dept`, `cid`, `cname`, `classes`, `time`, `location`, `teacher`, `grade`, `content`) VALUES ('$dept', '$cid', '$cname', '$classes', '$time', '$location', '$teacher', '$grade', '$content')");
        }
    }

?>