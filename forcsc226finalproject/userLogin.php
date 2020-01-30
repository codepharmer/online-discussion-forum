<?php
session_start();
include('includes/header.php');
function refreshHeader(){
  include('includes/header.php');
}

if (isset($_POST['logout'])){
  $_SESSION = array();
  if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
  session_destroy();
  refreshHeader();
};
if(isset($_POST['login']) 
    && isset($_POST['username']) 
    && isset($_POST['password']) ){
        userLogin();
    }
    else    {
      if(!(isset($_SESSION['isLoggedIn'])) || $_SESSION['isLoggedIn']== false){
        echo"
        <div class='container d-flex  align-items-center>
        <div class='d-flex text-center'>
            <fieldset class ='container'>
                <legend>Login</legend>
                <form id=login action='userLogin.php' method ='post' accept-charset='UTF-8'>
                        <label for='username'>Username: </label>
                        <input type='text' name='username'>
                        <label for='password'>Password: </label>
                        <input type='password' name='password'>
                        <button type='submit' name='login'> Login </button>
                </form>
            </fieldset>
        </div>
        </div>
        ";
     }

     else 
      echo"
        <div class='container d-flex  align-items-center>
        <div class='d-flex text-center'>
            <fieldset class ='container'>
                <legend>Logout</legend>
                <form id=logout action='userLogin.php' method ='post' accept-charset='UTF-8'>
                        <button type='submit' name='logout'> Logout </button>
                </form>
            </fieldset>
        </div>
        </div>
        ";

    }
    
include('includes/footer.html');
function userLogin(){
  //mysqli_report(MYSQLI_REPORT_ALL);
  //echo$_POST['username']." ".$_POST['password'];
    require ('../secureDataFor226Project/connectionInfo.php');
    $attemptedUn = htmlspecialchars(trim($_POST['username']));
    $attemptedPw = htmlspecialchars(trim($_POST['password']));
    //echo$attemptedUn." ".$attemptedPw;
    $q = "SELECT userName, pswd, id FROM `users` WHERE  
      userName = ? AND pswd = ? ";
      //echo '<div class="alert alert-info" role="alert"><p>This is an annoying ad! This is an annoying ad! This is an annoying ad! This is an annoying ad!</p></div>';
    // End of the function definition.
   // echo $q."<br/>";
    if ($userNames = $dbc->prepare($q)){  
      $userNames->bind_param('ss', $attemptedUn, $attemptedPw);
      if(!($userNames->execute())) echo $userNames ->error();
      $userNames->store_result();
      $userNames->bind_result($name, $password, $id);
    }
    if ($userNames->num_rows > 0){
        $userNames->fetch();
        $_SESSION['userName'] = $name;
        $_SESSION['userId'] = $id;
        $_SESSION['isLoggedIn'] = true;
        echo"<h1>Sucessful Login!</h1>";
        include('includes/footer.html');
     // }
    }
    else {
      echo "<h1>Login not successful</h1>";
    }
      refreshHeader();
  }
  
?>