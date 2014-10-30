<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    class Cdb extends CI_Model{
    	public function __construct(){
    		$this->load->database();
    	}
    	public function get($sql){
    		$result= $this->db->query($sql);
    		    return $result->result_array();
    	}
    	public function add($sql){
    		$this->db->query($sql);
    	}
        public function setTable($uid, $html, $rowArr, $sat, $sun){
            $result= $this->db->query("SELECT * FROM `st` WHERE `uid`= '$uid'");
            if($result->num_rows()> 0){
                $this->db->query("UPDATE `st` SET `html`='$html', `rowArr`= '$rowArr', `sat`= '$sat', `sun`= '$sun' WHERE `uid`= '$uid'");
            }
            else{
                $this->db->query("INSERT INTO `st` (uid, html, rowArr, sat, sun) VALUES ('$uid', '$html', '$rowArr', '$sat', '$sun') ");
            }
        }
        public function getTable($uid){
            $result= $this->db->query("SELECT * FROM `st` WHERE `uid`= '$uid' ");
            if($result->num_rows()> 0){
                return $result->result_array();
            }
            else{
                return false;
            }
        }
        public function addList($uid, $name, $want, $have, $desc, $time){
            $this->db->query("INSERT INTO `list` (`uid`, `name`, `want`, `have`, `desc`, `time`) VALUES ('$uid', '$name', '$want', '$have', '$desc', '$time')");
        }
    }
?>