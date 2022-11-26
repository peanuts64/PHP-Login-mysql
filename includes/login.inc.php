<?php
Class Login extends Dbh{


public function validate_login($data, $flag = false ){
#	$Username = 'Steve';
	$quered = $this->get_user($data['Username']);
	$Password =  password_hash($data['Password'], PASSWORD_DEFAULT);
        // Rudimentary hash check
        $result = password_verify($data['Password'], $quered['Password_hash']);
#		echo password_hash($_POST['Password'], PASSWORD_DEFAULT);
            /* Check if form's username and password matches */
        if( ($data['Username'] == $quered['User_name']) && ($result === true) ) {
                /* Success: Set session variables and redirect to protected page */
                $_SESSION['Username'] = $quered['User_name'];
                $_SESSION['Active'] = true;
		#echo "thanks for logging in";
                header("location:index.php");
                exit;
	}   
} 
protected function get_user($User){
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
	} catch(Exception $e){
$creds = $this->dump_protected_values();
$data['User_name'] = $creds['User_name'];
$data['Password_hash'] = $creds['Password_hash'];
		return $data;
	
	}
}








}
