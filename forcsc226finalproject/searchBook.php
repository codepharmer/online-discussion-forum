<?php
session_start();
include('includes/header.php');
error_reporting(0);
if(empty($_POST['searchterm']))
echo"
  <h1>Book-O-Rama Catalog Search</h1>

  <form action='searchBook.php' method='post'>
    Choose Search Type:<br />
    <select name='searchtype'>
      <option value='Author'>Author
      <option value='Title'>Title
      <option value='ISBN'>ISBN
    </select>
    <br />
    Enter Search Term:<br />
    <input name='searchterm' type='text' size='40'>
    <br />
    <input type='submit' name='submit' value='Search'>
  </form>
  ";
//loon to server 
//include file that has login information
//usrname and pw are not stored on this site

define('DB_USER', 'weissman');
define('DB_PASSWORD','45Trip98');
define('DB_HOST', 'localhost');
define('DB_NAME', 'bookOrama');

$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR 
  die('Could not connect to the database'.mysqli_connect_error());

$searchterm = htmlspecialchars($_POST['searchterm']);
$searchtype = htmlspecialchars($_POST['searchtype']);
if (empty($_POST['searchterm']) || empty($_POST['searchtype'])){
  echo "<p>No proper input</p>";
  exit;
}
echo"<div class='text-center'>";
//? prepared query!
 $query = "SELECT ISBN, Author, Title, Price
 FROM Books WHERE $searchtype = ?";
 $stmt = $dbc->prepare($query);
 $stmt->bind_param('s', $searchterm);
 $stmt->execute();
 $stmt->store_result();
 $stmt->bind_result($isbn, $author, $title, $price);
 echo "<div class='container'>
 <h3> Results: ".$stmt->num_rows."</h3>";
 while ($stmt->fetch()){
   echo $isbn."<br />". 
   $author."<br />".
    $title."<br />".
     ($price*1.0)."<br />
     </div>";
 }
// $query = "SELECT ISBN, Author, Title, Price
//    FROM Books WHERE 
//    $searchtype LIKE '%'.$searchterm.'%' ";
$queryResults =  mysqli_query($dbc, $query);
echo $queryResults;
echo"</div>";
// if (mysqli_num_rows($queryResults) > 0) {
//   // output data of each row
//   while($row = mysqli_fetch_assoc($queryResults)) {
//       echo "id: " . $row["id"]. " - Name: " .
//        $row["firstname"]. " " .
//         $row["lastname"]. "<br>";
//   }
// }
//"insert in to users (userid, password, email, nickname) values (null, ?,?,?)"
//$stmt = $dbc -> bind_param('sss', $emai, $passowrd, $nickname);
//$stmt -> execute

include('includes/footer.html');
?>

