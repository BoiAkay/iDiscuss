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
    <style>
    .nounderline {
        text-decoration: none !important
    }
    </style>
</head>

<body>
    <?php
        include 'partials/_header.php';
        include 'partials/_dbconnect.php';
        if(!$conn)
            die();
        $page_id=$_GET['category_id'];
        $query="SELECT * FROM `categories` WHERE category_id=$page_id ORDER BY created DESC;";
        $result=mysqli_query($conn,$query);
        $category_name;
        $category_description;
        
        while($row=mysqli_fetch_assoc($result))
        {   $category_name=$row['category_name'];
            $category_description=$row['category_description'];
        }
      
    ?>
    <div class="container my-4">
        <div class="container bg-dark text-light">
            <div class="jumbotron">
                <h1 class="display-10 text-center">Welcome to <?php echo $category_name;?> Forums</h1>
                <p class="lead"><?php echo $category_description;?></p>
                <hr class="my-3">
                <small id="emailHelp" class="form-text text-light">
                    <ul>
                        <li> This is a peer to peer forum.</li>
                        <li>No Spam / Advertising / Self-promote in the forums is not allowed.</li>
                        <li>Do not post copyright-infringing material. </li>
                        <li>Do not post “offensive” posts, links or images.</li>
                        <li>Do not cross post questions. </li>
                        <li>Remain respectful of other members at all times.</li>
                    </ul>
                </small>
                <?php
                    // session_start();
                    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true)
                    {   // include question modal
                        include 'partials/_questionmodal.php';
                        // user is inside
                        echo '<a class="btn btn-success btn-lg mb-2" data-toggle="tooltip" data-placement="top"
                        title="Create a modal to post questions. Also Check whether user is login before posting" href="#"
                        role="button" data-bs-toggle="modal" data-bs-target="#questionmodal">Ask a question</a>';
                    }
                    else
                    {
                        echo '<a class="btn btn-success btn-lg mb-2" data-toggle="tooltip" data-placement="top"
                        title="Create a modal to post questions. Also Check whether user is login before posting" href="#"
                        role="button" data-bs-toggle="modal" data-bs-target="#loginmodal">Login Ask a question</a>';
                    }
                    
                ?>

            </div>
        </div>
    </div>
    <div class="container">
        <h1 class="py-2">Browse Questions</h1>
        <div class="row">
            <?php
            $query = "select * from `threads` where thread_category_id=$page_id ORDER BY timestamp DESC";
            $result=mysqli_query($conn,$query);
            $no_result=true;
            while($row=mysqli_fetch_assoc($result))
            {   $no_result=false;
                $thread_id=$row['thread_id'];
                $thread_user_name=$row['thread_user_name'];
                $timestame=$row['timestamp'];
                echo '
                
                <div class="container my-2">
                <div class="row align-items-start">
                    <div class="col">
                        <img src="images/default_user.png" width="30px">
                    </div>
                    <div class="col">
                    </div>
                    <div class="col">
                    posted by <b>'.$thread_user_name.'</b> at : '.$timestame.'
                    </div>
                </div>
                <a class="nounderline link-dark" href="thread.php?category_id='.$page_id.'&thread_id='.$thread_id.'">
                <h5 class="mt-0">'.$row['thread_title'].'</h5>
                <p class="text-truncate my-2" style="max-width: 1000px;">
                '.$row['thread_description'].'
                </p></a>


            </div>';
            }
            if($no_result)
            {
                // no result be the first person to ask questions 
                echo '<div class="jumbotron jumbotron-fluid bg-dark text-light">
                <div class="container">
                  <h1 class="display-10 "><b>No Questions Found</b></h1>
                  <p class="lead">Be the first to aks question !!!</p>
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
    
</body>

</html>