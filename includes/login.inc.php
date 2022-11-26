<?php
Class Login extends Dbh{

public function validate_login($data, $flag = false ){
#query DB for submitted username while garbbing associated password
	$quered = $this->get_user($data['Username']);
// Rudimentary hash check compare submitted password to DB password
        $result = password_verify($data['Password'], $quered['Password_hash']);
/* Check if form's username and password matches */
        if( ($data['Username'] == $quered['User_name']) && ($result === true) ) {
/* Success: Set session variables and redirect to protected page */
                $_SESSION['Username'] = $quered['User_name'];
                $_SESSION['Active'] = true;
#redirect to index page
                header("location:index.php");
                exit;
	}
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
        }
	} 
	#if no database exists and login fails, this code will use
	#the user name and password from the dbh.inc.php 
	#not sure how secure this is.	
	catch(Exception $e){
# delete or comment this line of code out if using a database		
	$creds = $this->dump_protected_values();
	$data['User_name'] = $creds['User_name'];
	$data['Password_hash'] = $creds['Password_hash'];
	return $data;
#
	}
}







#END OF CLASS
}
