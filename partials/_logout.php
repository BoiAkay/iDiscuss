<?php
    @session_start();
    $_SESSION['loggedin']=false;
    session_write_close();
    header("Location: /forum");
?>