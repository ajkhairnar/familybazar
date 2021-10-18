<?php


    // $mysqli=mysqli_connect("localhost","root","","familybazar");
//     hostname' => 'localhost',
// 	'username' => 'familybazar',
// 	'password' => 'FAMILYbazar1not2$$',
// 	'database' => 'familybazar',
     $mysqli=mysqli_connect("localhost","familybazar","FAMILYbazar1not2$$","familybazar");


    $list='';
    $statename = filter_var($_POST['statename'],FILTER_SANITIZE_STRING);
    // include('config/db_connect.php');
    $stmt = $mysqli->prepare("SELECT land_area FROM shop_landmarklist WHERE land_city = ?");
    $stmt->bind_param("s", $statename);
    $stmt->execute();
    $result = $stmt->get_result();
    while($row = $result->fetch_assoc()) {
        $landmarklist = json_decode($row['land_area']);

        if(is_array($landmarklist))
        {
        foreach($landmarklist as $name)
        {
            $list .= "<option value='".$name."'>".$name."</option>";
        }
        }
        else
        {
            $list = "<option selected='selected' disabled='disabled'>No City Found</option>";
        }
    }
    $stmt->close();
    echo $list;

?>