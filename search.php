<!doctype html>
<html lang="en">

<head>
<link rel="icon" href="images/favicon-32x32.png" type="image/png" sizes="16x16">
    <!-- included meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>iDiscuss | An Online Discussion Forum</title>
</head>

<body>
    <?php
        include 'partials/_header.php';
        include 'partials/_dbconnect.php';
        if(!$conn)
            die();
    ?>
    <div class="container my-3" id="maincontainer">
        <h1 class="py-3">Search results for <em>"<?php echo $_GET['search']?>"</em></h1>
        <div class="result">
            <?php
                $query = $_GET['search'];
                //$sql = "select * from threads where match (thread_title, thread_description) against ('$query')"; 
                $sql = "SELECT * FROM `threads` WHERE `thread_title` or `thread_description` LIKE '%$query%'";
               // echo $sql;
                $result = mysqli_query($conn, $sql);
                $noresult=true;
                while($row = mysqli_fetch_assoc($result)){
                    $noresult=false;
                    $title = $row['thread_title'];
                    $thread_category_id=$row['thread_category_id'];
                    $desc = $row['thread_description']; 
                    $thread_id= $row['thread_id'];
                    $url = "thread.php?category_id=$thread_category_id&thread_id=". $thread_id;
                    echo ' <div class="result">
                                <h3><a href="'. $url. '" class="text-dark">'. $title. '</a> </h3>
                                <p>'. $desc .'</p>
                          </div>'; 
                    }
                if($noresult)
                {
                    echo '<div class="jumbotron jumbotron-fluid">
                <div class="container">
                  <h1 class="display-10 "><b>No Thread Found</b></h1>
                </div>
              </div>';
                }
                    
            ?>
        </div>
    </div>
    <?php
        include 'partials/_footer.php'
    ?>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>