<?php
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        include '_dbconnect.php';
        $loginsuccess=true;
        $error;
        $email=$_POST['admin_email'];
        $password=$_POST['admin_password'];
        $mac_adress=$_POST['mac_adress'];
        strval($mac_adress);
        $query="select * from `admin` where admin_email='$email'";
        $result=mysqli_query($conn,$query);
        $total_row=mysqli_num_rows($result);
        if($total_row==1)
        {
            $row=mysqli_fetch_assoc($result);
            if(password_verify($password,$row['admin_password_hash']) and password_verify($mac_adress,$row['device_mac_addr_hash']))
            {
                session_start();
                $_SESSION['admin_loggedin']=true;
                $_SESSION['admin_email']=$email;
                $_SESSION['admin_id']=$row['admin_id'];
            }
            else
            {   
                $loginsuccess=false;
                $error="Email or device is not valid";
                header("Location: /idiscuss/index.php?login_success=false&error=$error");
                exit();
            }
        }
        else
        {
            $loginsuccess=false;
            $error="Email not exists.";
           header("Location: /idiscuss/index.php?login_success=false&error=$error");
            exit();
        }
       header("Location: /idiscuss/admin.php");  
        exit();
    }
    header("Location: /idiscuss/");
?>
