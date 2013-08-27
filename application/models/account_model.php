<?php

Class account_model extends CI_Model

{

 function login($emailid, $password)

 {

   $this -> db -> select('userid, emailid, password,pname,active');

   $this -> db -> from('anonym');

   $this -> db -> where('emailid', $emailid);

   $this -> db -> where('password',$password);

   $this -> db -> limit(1);

   $query = $this -> db -> get();

   if($query -> num_rows() == 1)

   {

     return $query->result();

   }

   else

   {

     return false;

   }

 }

}

?>

