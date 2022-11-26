<?php

class dbh extends Dom {
private $servername;
private $username;
private $password;
private $dbname;

protected function set_credientials(){
	$this->servername = "127.0.0.1";
	$this->username = "admin";
	$this->password = "password";
	$this->dbname = "users";
#        $this->servername = "localhost";
#        $this->username = "";
#        $this->password = "";
#        $this->dbname = "";

}

protected function connect (){
	$this->set_credientials();
try{
         $conn = new mysqli($this->servername, $this->username,$this->password, $this->dbname);
	 if(mysqli_connect_errno()){
		 exit();
	 } 
         return $conn;}

catch (Exceptiopn $e){
	$error = $e->getMessage();

}
}
protected function dump_protected_values(){
	$this->set_credientials();
	$credintials['User_name'] = $this->username;
	$credintials['Password_hash'] = password_hash($this->password, PASSWORD_DEFAULT);
	return $credintials;

}

# END OF CLASS
}
