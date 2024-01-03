<?php
include "db.php";
?>
<?php
session_start();
?>

<?php
if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];



}
$username = escaping($username);
$password = escaping($password);



$q = "SELECT randSalt FROM users";
$select_q = mysqli_query($connection, $q);
if (!$select_q) {
  die("Query Failed" . mysqli_error($connection));
} else {
  $row = mysqli_fetch_array($select_q);
  $hashF_and_salt = $row['randSalt'];
  $password = crypt($password, $hashF_and_salt);
}


$query = "SELECT * FROM users WHERE username='$username'";

$select_user_query = mysqli_query($connection, $query);
if (!$select_user_query) {

  die("QUERY FAILED" . mysqli_error($connection));
}

while ($row = mysqli_fetch_array($select_user_query)) {


  $db_user_id = $row['user_id'];
  $db_username = $row['username'];
  $db_user_password = $row['user_password'];
  $db_user_firstname = $row['user_firstname'];
  $db_user_lastname = $row['user_lastname'];
  $db_user_email = $row['user_email'];
  $db_user_role = $row['user_role'];
}

if ($username === $db_username && $password === $db_user_password) {


  $_SESSION['user_id'] = $db_user_id;
  $_SESSION['username'] = $db_username;
  $_SESSION['firstname'] = $db_user_firstname;
  $_SESSION['lastname'] = $db_user_lastname;
  $_SESSION['email'] = $db_user_email;
  $_SESSION['user_role'] = $db_user_role;
  $times = 0;
  $_SESSION['times'] = $times;





  header("Location: ../admin");

} else {
  header("Location: ../index.php");

}


?>