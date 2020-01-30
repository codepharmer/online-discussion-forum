<?php
session_start();
include('includes/header.php');
// if( isset($_POST['title']))
//   echo"<h1>Title is set</h1>";
if( isset($_POST['title']) && isset($_POST['body']) && isset($_POST['submit'])){
    mysqli_report(MYSQLI_REPORT_ALL);
    require ('../secureDataFor226Project/connectionInfo.php');
    $title = htmlspecialchars(trim($_POST['title']));
    $body = htmlspecialchars(trim($_POST['body']));
    $userId = $_SESSION['userId'];
    $q = "INSERT INTO `posts`(`id`, `title`, `body`, timeofpost, `userid`)
    VALUES (0, ? , ? ,CURRENT_TIMESTAMP, $userId)";
      //echo '<div class="alert alert-info" role="alert"><p>This is an annoying ad! This is an annoying ad! This is an annoying ad! This is an annoying ad!</p></div>';
    // End of the function definition.
   // echo $q."<br/>";
    if ($userPost = $dbc->prepare($q)){
        $userPost->bind_param('ss', $title, $body);
         
        // echo $userPost ->error();
        mysqli_report(MYSQLI_REPORT_ALL);
        // }
        if($userPost->execute()){
          $userPost->store_result();
          //$userPost->bind_result($name, $password);
          echo"<h1>Post Added!</h1>";
          include('includes/footer.html');
          unset($_POST['title']);
          unset($_POST['body']);
      // }
        }
        else echo
      "<h1>Error creating the post</h1>";
    }
    else 
        echo "<h1>Error preparing the query</h1>";
    
}
else
if( isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] == true){
    echo'<form action="addPost.php" method="post">
    <label for="title">Title</label><br />

    <input name="title" placeholder="Enter post title..." type="text" id="title" style="
    color:black;border:solid-black;padding:2%;font: sans-serif;">
    </input>
    <textarea name="body" id="body" style="width:96%;height:90px;
    color:black;border:solid-black;padding:2%;font:22px/30px sans-serif;">
    </textarea>
    <input type="submit" value="Submit" name="submit" id="submit" style="color:white;padding:5px;font-size:18px;border:solid;padding:8px;">
    </form>';
}
else{
    echo"<h1>Sorry, no soup for you! Jk Jk, just login so you can post something!</h1>";
}
include('includes/footer.html');
?>