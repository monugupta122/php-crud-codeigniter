<?php
    class Users_model extends CI_Model{
        public function __construct(){
            parent::__construct();
        }

        public function insertUser($name,$email,$username,$contact,$address){
            $query="insert into users(name,email,username,contact,address) values('$name','$username','$email',$contact,'$address')";
            $this->db->query($query);
        }

        public function getUsers(){
            $query = $this->db->query("Select * from users");
            return $query->result();
        }

        public function deleteUser($id){
            $query = $this->db->query("delete from users where id=$id");
        }

        public function getUserById($id){
            $query = $this->db->query("select * from users where id=$id");
            if (count($query->result()) > 0) {
        		return $query->row();
        	}
        }

        public function updateUserById($id,$name,$username,$email,$contact,$address){
            $query = $this->db->query("Update users set name='$name', username='$username', email='$email', contact=$contact, address='$address' where id=$id");
        }

        public function ifuserexists($str){
            $query = $this->db->query("select username from users where username='$str'");
            return $query->result();
        }
    }
?>