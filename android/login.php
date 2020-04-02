<?php
include($rootFolder . "conn.php");
$user_name = $_POST["username"];
$user_pass = $_POST["password"];
$user_pass = hash('sha256',$user_pass);
$email = $_POST["email"];
$query = "select * from Credential where username like '$user_name' and password like '$user_pass'";
$result = mysqli_query($conn , $query);
echo mysqli_num_rows($result);
if(mysqli_num_rows($result)>0){
    $row = mysqli_fetch_assoc($result);
    $name = $row['username'];
    echo "login successful. Welcome $name";
}else echo " login failed";
?> 