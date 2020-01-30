<?php 
session_start();
include('includes/header.php');
error_reporting(0);
# Script 3.7 - index.php #2
// This function outputs theoretical HTML
// for adding ads to a Web page.
 

//  echo" <div class='page-header'><h1>Content Header</h1></div>
// <p>This is where the page-specific content goes. This section, and the corresponding header, will change from one page to the next.</p>

// <p>Volutpat at varius sed sollicitudin et, arcu. Vivamus viverra. Nullam turpis. 
// Vestibulum sed etiam. Lorem ipsum sit amet dolore. Nulla facilisi. Sed tortor. 
// Aenean felis. Quisque eros. Cras lobortis commodo metus. Vestibulum vel purus. 
// In eget odio in sapien adipiscing blandit. Quisque augue tortor, facilisis sit amet
// , aliquam, suscipit vitae, cursus sed, arcu lorem ipsum dolor sit amet.</p>
// </div>
// ";


if( isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] == true){
  displayUserWelcome();
}
function displayLatestPosts($limitParameter) {
  require ('../secureDataFor226Project/connectionInfo.php');
  
  $q = "SELECT posts.title, posts.body, users.userName, posts.timeofpost FROM posts, users WHERE 
    users.id = posts.userid ORDER BY posts.timeofpost DESC LIMIT ?";
  //echo '<div class="alert alert-info" role="alert"><p>This is an annoying ad! This is an annoying ad! This is an annoying ad! This is an annoying ad!</p></div>';
  // End of the function definition.
  $fill_query = (string) $limitParameter;
  $posts = $dbc->prepare($q);
  //$fill_query .= $limitParameter;
  // if ($posts = $dbc->prepare($q))
  //   echo"Prepared!";
  // else
  //   echo"Trouble preparing query";
  $posts->bind_param('s', $fill_query);
  $posts->execute();
  $posts->store_result();
  $posts->bind_result($title, $body, $userid, $timestamp);
  $page_title = 'Welcome to this Site!';
  echo "<div class='d-flex justify-center'>
  <div class = 'container'>

  <h3> Showing ".$posts->num_rows." most recent posts</h3>";
  while ($posts->fetch()){
    echo "<br />
    
  <div class = 'panel panel-default'>
    <strong>$userid</strong><br />
    <font size = '4'>$title</font><br />
      $body<br />
      <em>$timestamp</em><br />
      </div>";
      }
      echo"
        </div>
      </div>";
}
$howManyToShowAtATime = 5;
displayLatestPosts($howManyToShowAtATime);
// Call the function:
//print_latest_posts();
// Call the function again:

if($page > 1)
  $lastPage = $page - 1;
if($page < $totalPages)
  $nextPage = $page + 1;
  //in anchor link we'll have something like index.php?page=".$nextPage
echo"<a href=''>Last 5 Posts</a> &nbsp <a href=''>Next 5 Posts</a>";
include('includes/footer.html');
function displayUserWelcome(){
  echo "<h1>Welcome ".$_SESSION['userName']."!</h1> <br />";
}
?>