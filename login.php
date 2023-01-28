<?php 

include "db_con.php";

if (isset($_POST['username']) && isset($_POST['password'])){
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
    $username = validate($_POST['username']);
    $password = validate($_POST['password']);

    if(empty($username)){
        header("Location: index.php?error=Username is empty!");
        exit();

    } else if(empty($password)){
        header("Location: index.php?error=Password is empty!");
        exit();

    }else{
        $sql = "SELECT * FROM users WHERE user_name = '$username'
         AND user_password = '$password'";
        
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
			$row = mysqli_fetch_assoc($result);
            if ($row['user_name'] === $uname && $row['password'] === $pass) {
            	$_SESSION['user_name'] = $row['user_name'];
            	$_SESSION['name'] = $row['name'];
            	$_SESSION['id'] = $row['id'];
            	header("Location: home.php");
		        exit();
            }else{
				header("Location: index.php?error=Incorect Username or Password!");
		        exit();
			}
		}else{
			header("Location: index.php?error=Incorect Username or Password!");
	        exit();
		}
	}
	
}else{
	header("Location: index.php");
	exit();
}

?>