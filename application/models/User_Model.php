<?php
    
    class User_Model extends CI_Model{

        public function __constructor(){
            return parent :: __constructor();
        }

        public function add($data){
        return $this -> db -> insert('Users_1',$data);
        }
    }


?>