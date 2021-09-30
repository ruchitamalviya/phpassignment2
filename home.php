<?php
 include 'conn.php';
session_start();
if(isset($_SESSION['id']) && ($_SESSION['id']!='')){
}else{
  header('location:login.php');
  die();
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>LoginSystem</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <script type="text/javascript" src="js/jquery-3.6.0.min.js"></script>
</head>
<body>

  <div class="container-fluid mt-3 bg-success">
    <div class="row">
      <div class="col-lg-7"><h6 class="text-uppercase py-3">Find the index of alphabets</h6></div><div class="col-lg-3"><h6 class="text-uppercase py-3">welcome: <?php echo $_SESSION['fname']?></h6></div><div class="col-lg-2"><h6 class="text-uppercase py-3"><a href="logout.php">Logout</a></h6></div>
     </div>
     </div>
  <div class="col-lg-12">
    <div class="container py-4">
      <form method="POST">
      <input type="text"  class="form-control" name="str"value="<?=($_POST)?$_POST['str']:''?>">
      <input type="submit" name="submit" value="Submit" class="btn btn-success mt-4 px-5">
    </form>
      </div>
       <?php
  if( isset($_POST['submit']) && $_POST['str'] ) {
    $str = $_POST['str'];
    $str_length = strlen($str);
    $result = " ";
  echo '<div class="col-md-8">';
    for( $i = 0;$i<$str_length; $i++ ) {
      $code = ord(strtoupper($str[$i]));
      if( $code > 64 && $code < 91 ) {
        $result = $code-64;
        echo "<li>The Index of '".$str[$i]."' ".$result. "<br></li>";
      } else {
        
       echo "<li> '".$str[$i]."' is not alphabet  <br></li>";
      }
    }
    echo '</div>';
  }
?>
  </div>


  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>
