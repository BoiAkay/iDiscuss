<?php
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        include '_dbconnect.php';
        $email=$_POST['signupemail'];
        $password=$_POST['signuppassword'];
        $cpassword=$_POST['signupcpassword'];
        $name=$_POST['user_name'];
        $success=true;
        $error;
        if($password==$cpassword)
        {
            $query="select * from `users` where user_email='$email'";
            $result=mysqli_query($conn,$query);
            $row=mysqli_num_rows($result);
            $hash=password_hash($password,PASSWORD_DEFAULT);
            if($row>0)
            {
                $success=false;
                $error='Email already exists';  
                header("Location: /forum/index.php?signup_success=false&error=$error");
                exit();
            }
            else
            {
            $query="INSERT INTO `users` (`user_name`, `user_email`, `user_password_hash`, `user_created_time`) VALUES ('$name', '$email', '$hash', current_timestamp());";
            $result=mysqli_query($conn,$query);
            if(!$result)
            {
                $success=false;
                $error='unable to create account';  
                header("Location: /forum/index.php?signup_success=false&error=$error");
                exit();
            }
        }
        }
        else
        {
            $success=false;
            $error='Password and confirm Password not match';
            header("Location: /forum/index.php?signup_success=false&error=$error");
            exit();
        }
    }
    header("Location: /forum/index.php?signup_success=true");
    
?>