<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    class Cont extends CI_Controller{
    	public function __construct(){
    		parent::__construct();
    		$this->load->model('cdb');
            ini_set('date.timezone', 'Asia/Taipei');
    	}
    	public function index(){
    		/*
            $data['result']= $this->cdb->get("SELECT * FROM `course` WHERE `dept`= '資管系' OR `cid`= 'C20005' OR `cid`= 'C20006' OR `cid`= 'C20007' OR `cid`= 'C20008' OR `cid`= 'C20010' ORDER BY `grade`");
            $data['result2']= $this->cdb->get("SELECT * FROM `course` WHERE `dept`= '共同選' OR `cid`= '385008' OR `cid`= '385010' OR `cid`= '981131' OR `cid`= '982131' OR `cid`= '982132' OR `cid`= '982139' OR `cid`= '982504' OR `cid`= '982506' OR `cid`= '983002' OR `cid`= '984002' OR `cid`= '984003' OR `dept`= '通識' ORDER BY `cid`");
            $data['result3']= $this->cdb->get("SELECT * FROM `course` WHERE `dept`= '體育室' AND `cid`< '903101' OR `cid`= '903110' ORDER BY `cid`");
    		$this->load->view("index", $data);
            */
            header("Location:".base_url()."ncnu.htm");
    	}
    	public function ajax(){
    		if(isset($_GET)){
    			$cid= $_GET['cid'];
                $classes= $_GET['classes'];
    			$result= $this->cdb->get("SELECT * FROM `course` WHERE `cid`= '$cid' AND `classes`= '$classes'");
    			foreach($result as $row){
    				//$dept= $row['dept'];
    				//$cname= $row['cname'];
    				//$time= $row['time'];
    				//$location= $row['location'];
                    //$teacher= $row['teacher'];
                    //$grade= $row['grade'];
                    $content= $row['content'];
                    break;
    			}
                echo json_encode(array('content'=> $content));
    			//echo json_encode(array('cid'=> $cid, 'dept'=> $dept, 'cname'=> $cname, 'time'=> $time, 'location'=> $location, 'teacher'=> $teacher, 'grade'=> $grade, 'content'=> $content)); 
    		}
    	}
        public function set(){
            if(isset($_POST)){
                $uid= $_POST['uid'];
                $html= $_POST['html'];
                $rowArr= $_POST['rowArr'];
                $sat= $_POST['Sat'];
                $sun= $_POST['Sun'];
                $this->cdb->setTable($uid, $html, $rowArr, $sat, $sun);
            }
        }
        public function get(){
            if(isset($_GET)){
                $uid= $_GET['uid'];
                $result= $this->cdb->getTable($uid);
                if($result!= false){
                    foreach($result as $row){
                        echo json_encode(array('html'=> $row['html'], 'rowArr'=> $row['rowArr'], 'sat'=> $row['sat'], 'sun'=> $row['sun'], 'status'=> 'true'));
                        break;
                    }
                }
                else{
                    echo json_encode(array('status'=> 'false'));
                }
            }
        }
        public function report(){
            if(isset($_POST)){
                $uid= $_POST['uid'];
                $content= $_POST['content'];
                require APPPATH.'libraries/PHPMailer/PHPMailerAutoload.php';
                $mail= new PHPMailer;
                $mail->isSMTP();
                $mail->Host= 'smtp.mailgun.org';
                $mail->SMTPAuth = true;
                $mail->Username = 'postmaster@sandbox83510d1646e4403aafa2a17980739197.mailgun.org';
                $mail->Password = 'jonilars';
                $mail->SMTPSecure = 'tls';
                /*-------------------------*/
                $mail->From = 'report@imcourse.com';
                $mail->FromName = $uid;
                $mail->addAddress('z3388638@gmail.com', 'Y.Y. ChaNg');
                $mail->WordWrap = 50;
                $mail->isHTML(true); 
                $mail->Subject = 'report';
                $mail->Body    = $content;
                if($mail->send()){
                    echo "success";
                }

                // record to db
                $this->cdb->addReportLog($uid, $content);
            }
        }
        public function addList(){
            if(isset($_POST)){
                $uid= $_POST['uid'];
                $name= $_POST['name'];
                $wantJ= json_decode($_POST['want']);
                $haveJ= json_decode($_POST['have']);
                $desc= $_POST['desc'];
                $want= "";
                $have= "";
                $time= date("Y/m/d H:i:s");
                for($i= 0; $i< count($wantJ); $i++){
                    if($i!= count($wantJ)-1){
                        $want.=$wantJ[$i]."<br>";
                    }
                    else{
                        $want.=$wantJ[$i];
                    }
                }
                for($i= 0; $i< count($haveJ); $i++){
                    if($i!= count($haveJ)-1){
                        $have.=$haveJ[$i]."<br>";
                    }
                    else{
                        $have.=$haveJ[$i];
                    }
                }
                $this->cdb->addList($uid, $name, $want, $have, $desc, $time);
            }
        }
        public function getList(){
            $result= $this->cdb->get("SELECT * FROM `list` ORDER BY `id` DESC");
            foreach($result as $row){
                $want= str_replace('&jonilars;', "'", $row['want']);
                $have= str_replace('&jonilars;', "'", $row['have']);
                $desc= str_replace('&jonilars;', "'", $row['desc']);
                echo "<tr><td>".$row['id']."</td><td>".$row['name']."</td><td>".$want."</td><td>".$have."</td><td>".$desc."</td></tr>";
            }
        }
        public function delList(){
            if(isset($_POST)){
                $id= $_POST['id'];
                $this->cdb->add("DELETE FROM `list` WHERE `id`= '$id' ");
            }
        }
        public function updateList(){
            if(isset($_POST)){
                $id= $_POST['id'];
                $wantJ= json_decode($_POST['want']);
                $haveJ= json_decode($_POST['have']);
                $desc= $_POST['desc'];
                $want= "";
                $have= "";
                for($i= 0; $i< count($wantJ); $i++){
                    if($i!= count($wantJ)-1){
                        $want.=$wantJ[$i]."<br>";
                    }
                    else{
                        $want.=$wantJ[$i];
                    }
                }
                for($i= 0; $i< count($haveJ); $i++){
                    if($i!= count($haveJ)-1){
                        $have.=$haveJ[$i]."<br>";
                    }
                    else{
                        $have.=$haveJ[$i];
                    }
                }
                $this->cdb->add("UPDATE `list` SET `want`='$want',`have`='$have',`desc`='$desc' WHERE `id`= '$id'");
            }
        }
        public function getDetail(){
            if(isset($_GET)){
                $id= $_GET['id'];
                $result= $this->cdb->get("SELECT * FROM `list` WHERE `id`= '$id'");
                foreach($result as $row){
                    $uid= $row['uid'];
                    $name= $row['name'];
                    $want= $row['want'];
                    $have= $row['have'];
                    $desc= $row['desc'];
                    $time= $row['time'];
                    echo json_encode(array('uid'=> $uid, 'id'=> $id, 'name'=> $name, 'want'=> $want, 'have'=> $have, 'desc'=> $desc, 'time'=> $time));
                    break;
                }
            }
        }
        public function admin() {
            if(isset($_POST)) {
                $user = $_POST['user'];
                $pass = $_POST['pass'];
                if(md5(md5($user).'abc') == 'c0f97e55908b6cc0411040cc1e3b9ecf' && md5(md5($pass).'qwer') == '7d633eb4a91d30642746d5ee408f52f4') {
                    echo json_encode(array('valid' => 1));
                } else {
                    echo json_encode(array('valid' => 0));
                }
            }
        }
        public function getReport() {
            if(isset($_POST)) {
                $user = $_POST['user'];
                $pass = $_POST['pass'];
                if(md5(md5($user).'abc') == 'c0f97e55908b6cc0411040cc1e3b9ecf' && md5(md5($pass).'qwer') == '7d633eb4a91d30642746d5ee408f52f4') {
                    $result = $this->cdb->get("SELECT * FROM `report` ORDER BY `id` DESC");
                    echo json_encode(array('valid' => 1, 'list' => $result));
                } else {
                    echo json_encode(array('valid' => 0));
                }
            }
        }
    }
?>