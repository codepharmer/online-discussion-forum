<?php
if (!isset($_POST['word'])){
echo'
<html>
<body>
<form action="regex.php" method = "post">
Enter String to Search: <input type="text" size="50"  maxlength="512"name="word"><br />
<!--Enter Regular Expression <br /> (please include delimiters
before and after search term): <input type="text" size="50" maxlength="48" name="regexp"><br />--!>
<input type="submit" name="submit">
</form>
</body>
</html>';
}
else {
    //"A purple pig and a green donkey flew a kite in the middle of the night and ended up sunburnt."
  $stringData = $_POST['word'];
  $pattern = '/[aeiouAEIOU]/';
  $replaceWith = '${1}-$3';
  echo"
  <html>
  <body><h1>".preg_replace($pattern, $replaceWith, $stringData)."</h1>
  </body>
  </html>";
  //preg_match($_POST['regexp'], $_POST['word']);
  //$regex = "^[1-9]{1,3}\.[1-9]{1,3}\.[1-9]{1,3}\.[1-9]{0,2}[1-9]$"; 
  //$containsRegex = preg_match($regex, $_POST['word']);
  // if ($containsRegex){
  //   echo"
  //   <html>
  //   <body><h1> Valid IP address!</h1>
  //   </body>
  //   </html>";
  // }
  //else {
    // echo"
    // <html>
    // <body><h1>Invalid ip address</h1>
    // </body>
    // </html>";
//  }
  
}
?>