<?php
Class Login {


public function validate_login($data, $flag = false ){
	$Username = 'Steve';
	$Password =  password_hash($_POST['Password'], PASSWORD_DEFAULT);
        // Rudimentary hash check
        $result = password_verify($_POST['Password'], $Password);
#		echo password_hash($_POST['Password'], PASSWORD_DEFAULT);
            /* Check if form's username and password matches */
        if( ($_POST['Username'] == $Username) && ($result === true) ) {
                /* Success: Set session variables and redirect to protected page */
                $_SESSION['Username'] = $Username;
                $_SESSION['Active'] = true;
		#echo "thanks for logging in";
                header("location:index.php");
                exit;
	}   
} 








}
