<?php
if (!defined('INTERNAL')) {
  exit('Direct access is not allowed');
}
$userRequest = getBodyData();
if($userRequest['username'] === '') {
  exit('Username cannot be blank');
}
$username = addslashes($userRequest['username']);
$query = "SELECT `user_id` AS id, `username`, `email`,`firstname`, `lastname`, `zipcode`, `image_url` FROM `users` WHERE `username` = '$username'";
$result = mysqli_query($conn, $query);

if(!$result) {
  throw new Exception('Problem retrieving data ' . mysqli_error($conn));
}

if(!mysqli_num_rows($result)) {
  throw new Exception('Invalid Username ' . mysqli_error($conn));
}

$userDataOutput = mysqli_fetch_assoc($result);

$userDataOutput = json_encode($userDataOutput);

print_r($userDataOutput);

?>
