<?php
    class Users extends CI_Controller{
        public function __construct(){
            parent::__construct();
            $this->load->database();
            $this->load->model("Users_model");
            $this->load->helper(array('url','form'));
            $this->load->library('form_validation');
        }
        // public function index(){
        //     echo "Hello World";
        // }

        public function insert(){

            $this->form_validation->set_rules('name','Name','required|max_length[50]|trim',
            array('required' => 'Name is required.','max_length' => 'Max length of name should not exceed 50 characters.'));
            
            $this->form_validation->set_rules('username','Username','required|max_length[50]|callback_ifuserexists|trim',
            array('required' => 'Username is required.','max_length' => 'Max length of username should not exceed 50 characters.','ifuserexists' => 'Username already exits.'));
            
            $this->form_validation->set_rules('email','E-mail','required|valid_email|max_length[50]|trim',
            array('required' => 'E-mail is required.','max_length' => 'Max length of email should not exceed 50 characters.','valid_email' => 'Invalid email.'));
            
            $this->form_validation->set_rules('contact','Contact','required|max_length[50]|trim',
            array('required' => 'Contact is required.','max_length' => 'Max length of contact should not exceed 10 characters.'));
            
            $this->form_validation->set_rules('address','Address','max_length[255]|trim',
            array('required' => 'address is required.','max_length' => 'Max length of contact should not exceed 255 characters.'));

            if($this->form_validation->run() == FALSE){
                $this->load->view('register');
            }
            else{
                //after validating form input calling user model to register user
                if($this->input->post("register")){
                    // var_dump($this->input->post());
                    // exit;
                    $name=$this->input->post('name');
                    $username=$this->input->post('username');
                    $email=$this->input->post('email');
                    $contact=$this->input->post('contact');
                    $address=$this->input->post('address');

                    $this->Users_model->insertUser($name,$username,$email,$contact,$address);
                    redirect('Users/view');
                }
            }
        }

        public function view(){
            $data['user'] = $this->Users_model->getUsers();
            // var_dump($data).exit;
            $this->load->view('viewUsers',$data);
        }

        public function delete(){ 
            $id = $this->input->get('id');
            $this->Users_model->deleteUser($id);
            // redirect('Users/view');
        }

        //to get one user by id
        public function getUserById(){
            $id = $this->input->post('id');
            // echo $id;
            if($userData = $this->Users_model->getUserById($id)){
                $data = array('response' => 'success', 'userData' => $userData);
            }
            else{
                $data = array('responSe' => 'error', 'message' => 'failed to fetch record');
            }
            echo json_encode($data);
        }
        
        public function updatedata(){
                // var_dump($this->input->post());
                // exit;
                    // $this->load->view('updateUser');
                    $id=$this->input->post('id');
                    $name=$this->input->post('name');
                    $username=$this->input->post('username');
                    $email=$this->input->post('email');
                    $contact=$this->input->post('contact');
                    $address=$this->input->post('address');

                    if($this->Users_model->updateUserById($id,$name,$username,$email,$contact,$address)){
                        $data = array('response' => 'success', 'message' => 'Record update Successfully');
                    }
                    else{
                        $data = array('response' => 'error', 'message' => 'Failed to update record');
                    }
                echo json_encode($data);
        }
        
        public function update($id){
            $data['id'] = $id;
            $this->load->view('updateUser',$data);
        }
        
        //for form validation 
        public function ifuserexists($str){
            $result = $this->Users_model->ifuserexists($str);
            if($result)
                return FALSE;
            return TRUE;
        }
    }
?>