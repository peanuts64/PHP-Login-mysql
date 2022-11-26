<?php
Class Login extends Dbh{
protected function logins_url_redirect($user){
/* Success: Set session variables and redirect to protected page */
                $_SESSION['Username'] = $user;
                $_SESSION['Active'] = true;
#redirect to index page
                header("location:index.php");
                exit;
}

public function validate_login($data, $flag = false ){
#query DB for submitted username while garbbing associated password
	$quered = $this->get_user($data['Username']);
	if($quered != false){
// Rudimentary hash check compare submitted password to DB password
$this->Err['Password'] = (password_verify($data['Password'], $quered[0]['Password_hash']) ? $this->logins_url_redirect($data['Username']) : 'Incorrect Password');
	echo password_hash($data['Password'], PASSWORD_DEFAULT );
	return $this->Err['Password'];
/* Check if form's username and password matches */
	} else { return 'User Name Not Found'; }
}
#
protected function get_user($User){
#if database is setup, then the script will qurey credintials from database
	try{
        $mysqli = $this->connect();
        $sql = "SELECT * FROM `Users` WHERE `User_Name` = ? ORDER BY `id` DESC;";
        $stmt = $mysqli->prepare($sql);
	$stmt->bind_param("s", $User);
        $stmt->execute();
        $result = $stmt->get_result();
        $numRows = $result->num_rows;
        if($numRows > 0){
                while($row = $result->fetch_assoc()){
                        $data[] = $row;
                }
        return $data;
        }else{ return false;}
	} 
	#if no database exists and login fails, this code will use
	#the user name and password from the dbh.inc.php 
	#not sure how secure this is.	
	catch(Exception $e){
# delete or comment this line of code out if using a database		
	$creds = $this->dump_protected_values();
	$data[0]['User_name'] = $creds['User_name'];
	$data[0]['Password_hash'] = $creds['Password_hash'];
	return ($User == $data[0]['User_name'] ? $data : false);
#
	}
}







#END OF CLASS
}
