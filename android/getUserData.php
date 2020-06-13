
<?php
$rootFolder = "../";
include("conn.php");
include($rootFolder . "includes/database.php");
$emailAddressOrUsername = $_POST["username"];
if(!$conn){ 
    die("ERROR in connection: ". mysqli_connect_error());
}
$response = array();
$sql = "SELECT UserID, Name, Surname, Email, Username FROM Credentials c JOIN User u ON c.CredentialsID = u.CredentialsID WHERE u.UserID = " . getUserID($conn, $emailAddressOrUsername);
$result =  mysqli_query($conn,$sql);

if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
        array_push($response,$row);
    }
}
else{
    $response['UserID'] = 0;
    $response['Name'] = 'no data';
    $response['Surname'] = 'no data';
    $response['Email'] = 'no data';
    $response['Username'] = 'no data';
}
echo json_encode($response);
 //{"UserID":"1","Name":"Toma\u017e","Surname":"Bizjak","Email":"admin@redovalnica.ga","Username":"redovalnica_admin"}
 // [{"UserID":"1","Name":"Tomaž","Surname":"Bizjak","Email":"admin@redovalnica.ga","Username":"redovalnica_admin"}]
?> 