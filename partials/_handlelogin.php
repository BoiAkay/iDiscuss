<?php
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        include '_dbconnect.php';
        $url=$_POST['url'];
        strval($url);
        $default_url="/idiscuss/";
        $loginsuccess=true;
        $error;
        $email=$_POST['login_email'];
        $password=$_POST['login_password'];
        $query="select * from `users` where user_email='$email'";
        $result=mysqli_query($conn,$query);
        $total_row=mysqli_num_rows($result);
        if($total_row==1)
        {
            $row=mysqli_fetch_assoc($result);
            if(password_verify($password,$row['user_password_hash']))
            {   // psssword verified
                session_start();
                $_SESSION['loggedin']=true;
                $_SESSION['user_email']=$email;
                $_SESSION['user_name']=$row['user_name'];
                $_SESSION['user_id']=$row['user_id'];
            }
            else
            {   // passwored not verified
                $loginsuccess=false;
                $error="Invalid password.";
                header("Location: /idiscuss/index.php?login_success=false&error=$error");
                exit();
            }
        }
        else
        {   // no row found
            $loginsuccess=false;
            $error="Email not exists.";
            header("Location: /idiscuss/index.php?login_success=false&error=$error");
            exit();
        }
        
        if($url==$default_url)
        {   
            // user is trying to loging from home page
            header("Location: /idiscuss/index.php?login_success=true");
            exit();
        }
        header("Location: $url&login_success=true");
        exit();
    }
    header("Location: /idiscuss/");
    exit();
?>
