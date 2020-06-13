<?php
include("conn.php");
if(!$conn){
    die("ERROR in connection: ". mysqli_connect_error());
}
$response = array();

$sql_query = "SELECT Shortcode,Grade,Type,DateReceived FROM `grades` g join `subjects` s ON g.SubjectID = s.SubjectID WHERE g.Active = 1 ORDER BY DateReceived";
$result =  mysqli_query($conn,$sql_query);

if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
        array_push($response,$row);
    }
}
else{
    $response['SubjectID'] = 0;
    $response['Grade'] = 0;
    $response['Type'] = 'no data';
    $response['DateReceived'] = date("Y-m-d H:i:s");
}
echo json_encode($response);
?> 