<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    class Report extends CI_Controller{
        public function __construct(){
            parent::__construct();
            $this->load->model('cdb');
            ini_set('date.timezone', 'Asia/Taipei');
        }
        public function index(){
            $this->load->view('report/index');
        } 
    }

?>