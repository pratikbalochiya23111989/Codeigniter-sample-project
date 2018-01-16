<?php defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class MY_Controller extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        ini_set('post_max_size', '500M');
		ini_set('upload_max_filesize', '500M');
		$this->load->library('session');
		$this->load->helper('cookie');
		$this->load->helper('url');
		$this->load->database();
		$this->load->library('email');
		$this->load->helper('file');
		$this->load->library('Image_lib');
		$this->load->library('upload');
        $this->load->helper('string');
        $this->load->library('querycreator');

        $this->data['base_path'] = $this->config->item('base_path');
        $this->data['base_url'] = $this->config->item('base_url');
        $this->data['base_upload'] = $this->config->item('base_upload');
        $this->data['base_upload_path'] = $this->config->item('base_upload_path');
        $this->load->model('QueryCreator.php');
    }

    function encrypt($data)
    {
        for($i = 0, $key = 27, $c = 48; $i <= 255; $i++){
            $c = 255 & ($key ^ ($c << 1));
            $table[$key] = $c;
            $key = 255 & ($key + 1);
        }
        $len = strlen($data);
        for($i = 0; $i < $len; $i++){
            $data[$i] = chr($table[ord($data[$i])]);
        }
        return base64_encode($data);
    }
     
    function decrypt($data)
    {
        $data = base64_decode($data);
        for($i = 0, $key = 27, $c = 48; $i <= 255; $i++){
            $c = 255 & ($key ^ ($c << 1));
            $table[$c] = $key;
            $key = 255 & ($key + 1);
        }
        $len = strlen($data);
        for($i = 0; $i < $len; $i++){
            $data[$i] = chr($table[ord($data[$i])]);
        }       
        return $data;
    }

    function send_email($vEmailCode,$vEmail,$bodyArr,$postArr)
    {
        if($vEmailCode!=NULL)
        {
            $email_info = $this->Common_model->getSingleRecordByFieldWithoutStatus('emailtemplates','vEmailCode',$vEmailCode);
            $subject = strtr($email_info['vEmailSubject'], "\r\n" , "  " ); 
            $body = stripslashes($email_info['tEmailMessage']);
            $from_name = $email_info['vFromName'];
            $from_email = $email_info['vFromEmail'];
        }
        else
        {
            $body=$bodyArr;
            $from_name= 'My Talking Pillow';
            $from_email='demo1.testing1@gmail.com';
            $subject = 'My Talking Pillow - Forgot Password';
        }
       
        $body = str_replace($bodyArr,$postArr, $body);
        $to = stripcslashes($vEmail);
        require_once(APPPATH.'third_party/PHPMailer-master/PHPMailerAutoload.php');
        $mail = new PHPMailer;
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;       
        $mail->SMTPDebug = 0;                     // Enable SMTP authentication
        $mail->Username = 'demo1.testing1@gmail.com';                 // SMTP username
        $mail->Password = 'demo12345678';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                  // TCP port to connect to

        $mail->From = $from_email;
        $mail->FromName = $from_name;
        $mail->addAddress($to);
        $mail->WordWrap = 50;                                 // Set word wrap to 50 characters
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $body;
        $mail->AltBody = '';
        
        if(!$mail->send()) {
            $res = 0;
        } else {
            $res = 1;
        }
        return $res;        
    }
    
    public function do_upload()
    {

        if(!is_dir('assets/uploads/'.$folder.'/')){
            @mkdir('assets/uploads/'.$folder.'/', 0777);
        }
        if(!is_dir('assets/uploads/'.$folder.'/'.$folderId)){
            @mkdir('assets/uploads/'.$folder.'/'.$folderId, 0777);
        }

        $config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 10000;
        $config['max_width']            = 1024;
        $config['max_height']           = 768;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('userfile'))
        {
            $error = array('error' => $this->upload->display_errors());
            echo '<pre>';
            print_r($error);
            exit;
            $this->load->view('upload_form', $error);
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());
            if(is_file($data['upload_data']['full_path']))
            {
                chmod($data['upload_data']['full_path'], 0777); ## this should change the permissions
            }
            $this->load->view('success', $data);
        }
    }

    /*function do_upload_doc($folderId,$folder,$image,$size){ 
        if(!is_dir('uploads/'.$folder.'/')){
            @mkdir('uploads/'.$folder.'/', 0777);
        }

        if(!is_dir('uploads/'.$folder.'/'.$folderId)){
            @mkdir('uploads/'.$folder.'/'.$folderId, 0777);
        }
        
        $img=$this->data['base_path'].'uploads/'.$folder.'/'.$folderId.'/'.$_FILES[$image]['name'];     
        if (file_exists($img)) {            
            $rnd1=$this->rand_number();         
            $name='copy_'.$rnd1.$_FILES[$image]['name'];
            $file_name=str_replace(' ','_',$name);
        } else {
            $file_name=str_replace(' ','_',$_FILES[$image]['name']);            
        }
        
        $config = array(
            'allowed_types' => '*',
            'upload_path' => 'uploads/'.$folder.'/'.$folderId,
            'file_name' => str_replace(' ','',$file_name),
            'max_size'=>5380334
        );
        
        $this->load->library('Upload', $config);          
        $this->upload->initialize($config);
        $this->upload->do_upload($image); //do upload
        $image_data = $this->upload->data(); //get icon data        
        if($size){
            $name='uploads/'.$folder.'/'.$folderId.'/'.$size['width'].'X'.$size['height'].'_'.$image_data['file_name'];
            $config1 = array(
              'source_image' => $image_data['full_path'], //get original image          
              'new_image' => $name, //save as new image //need to create thumbs first
              'maintain_ratio' => false,
              'width' => $size['width'],
              'height' => $size['height']
            );      
        }       
        $image_data = $this->upload->data(); //get image data       
        $img_uploaded = $image_data['file_name'];          
        return $img_uploaded;
    }*/
}