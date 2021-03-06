    <?php
      include 'conn.php';
      session_start();
        if(!isset($_SESSION['id']) && ($_SESSION['id'] =='')){
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
      <!-- Latest compiled and minified CSS -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

      <!-- jQuery library -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

      <!-- Popper JS -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

      <!-- Latest compiled JavaScript -->
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js" integrity="sha512-RdSPYh1WA6BF0RhpisYJVYkOyTzK4HwofJ3Q7ivt/jkpW6Vc8AurL1R+4AUcvn9IwEKAPm/fk7qFZW3OuiUDeg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <script type="text/javascript" src="assests/js/jquery-3.6.0.min.js">
      </script>
  </head>
  <body>
    <div class="container-fluid mt-3 bg-success">
      <div class="row">
        <div class="col-lg-7 col-md-3 col-sm-3">
          <h6 class="text-uppercase py-3">Find the index of alphabets</h6>
        </div>
        <div class="col-lg-3 col md-3 col-sm-3"><h6 class="text-uppercase py-3">welcome: <?php echo $_SESSION['fname']?></h6>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2"><h6 class="text-uppercase py-3"><a href="logout.php">Logout</a></h6>
        </div>
      </div>
    </div>
    <div class="col-lg-12">
      <div class="container py-4">
        <form method="POST">
          <input type="text"  class="form-control" id="search" name="str" value="<?=($_POST)?$_POST['str']:''?>">
          <input type="submit" name="submit" value="Submit" id="submit_str" class="btn btn-success mt-4 px-5">
        </form>
      </div>
      <?php
      if(isset($_POST['submit'])) {
        $str = $_POST['str'];
        $uid = $_SESSION['id'];
        $date = date("d M Y");
        $sql = "SELECT * FROM `index_search` WHERE word ='$str' and  uid ='    $uid'";
        $query = mysqli_query($conn,$sql);
        $check = mysqli_num_rows($query);
        if($check>0)
        {

        }else
        {

          $sql="INSERT INTO `index_search` ( `uid`, `word`,`added`) VALUES ( '$uid', '$str','$date')";
          mysqli_query($conn, $sql);        
        }
        $str_length = strlen($str);
        $result = " ";
        echo '<div class="col-md-8" id="result">';
        for( $i = 0;$i<$str_length; $i++ ) {
          $code = ord(strtoupper($str[$i]));
          if( $code > 64 && $code < 91 ) {
            $result = $code-64;
            echo "<li>The Index of '".$str[$i]."' ".$result. "<br></li>";
          } else 
          {

            echo "<li> '".$str[$i]."' is not alphabet  <br></li>";
          }
        }
        echo '</div>';
      }
      ?>
    </div>
    <div class="container">
      <h4 class="text-center text-uppercase py-3">Your Search History</h4>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Sno</th>
            <th>Word</th>
            <th>Date</th>
           
          </tr>
        </thead>
        <tbody>
          <?php
            $uid = $_SESSION['id'];
            $sql = "SELECT id, word, added FROM `index_search` WHERE uid = '$uid'";
            $query = mysqli_query($conn,$sql);
            $id = 1;
            while ($row = mysqli_fetch_assoc($query)) {
          ?>
          <tr>
            <td><?php echo $id++?></td>
            <td class="edit_input"><?php echo $row['word']?></td>
            <td><?php echo $row['added']?></td>
           <td><button class="btn btn-success btn_action" data-search-word = "<?php echo $row['word'];?>">Search</button></td>
            <td><button class="btn btn-danger btn_del" data-id="<?php echo  $row['id'];?>">Delete</button></td>
            <td><button class="btn btn-success btn_edit" data-edit-id="<?php echo $row['id'];?>">Edit</button></td>
          </tr>
        <?php } ?>
        </tbody>
      </table>
    </div>
    <script type="text/javascript" src="assests/js/main.js"></script>
  </body>
</html>
