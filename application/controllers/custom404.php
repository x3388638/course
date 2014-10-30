<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    class Custom404 extends CI_Controller{
        public function __contructor(){
            parent::__contructor();
        }
        function index(){
            header('Location:'.base_url());
        }
    }
?>