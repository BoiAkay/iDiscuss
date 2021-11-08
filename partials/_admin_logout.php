<?php
    @session_start();
    $_SESSION['admin_loggedin']=false;
    session_write_close();
    header("Location: /forum");
?>