<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    class Ncnu extends CI_Controller{
        public function __construct(){
            parent::__construct();
            $this->load->model('cdb');
            ini_set('date.timezone', 'Asia/Taipei');
        }
        public function index(){
            $data['result']= $this->cdb->get("SELECT * FROM `course` ORDER BY `dept`, `grade`");
            $data['dept']= $this->cdb->get("SELECT `dept` FROM `course` GROUP BY `dept`");
            $this->load->view('ncnu/index', $data);
        }	
        public function exchange(){
            $data['result']= $this->cdb->get("SELECT * FROM `list` ORDER BY `id` DESC");
            $this->load->view('exchange/index', $data);
            // function bgExec($cmd) {
            //     if(substr(php_uname(), 0, 7) == "Windows"){
            //         pclose(popen("start /B ". $cmd . "> NUL", "r")); 
            //     }else {
            //         exec($cmd . " > /dev/null &"); 
            //     }
            // }
            // bgExec('php -q '.APPPATH.'libraries/PHPWebSocket/server.php');
        }
    }

?>