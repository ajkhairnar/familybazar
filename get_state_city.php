<?php

    // $mysqli=mysqli_connect("localhost","root","","familybazar");
    $mysqli=mysqli_connect("localhost","familybazar","FAMILYbazar1not2$$","familybazar");


    $list='';
    $statename = filter_var($_POST['statename'],FILTER_SANITIZE_STRING);
    // include('config/db_connect.php');
    $stmt = $mysqli->prepare("SELECT state_citylist FROM shop_statelist WHERE state_slug = ?");
    $stmt->bind_param("s", $statename);
    $stmt->execute();
    $result = $stmt->get_result();
    while($row = $result->fetch_assoc()) {
        $citylist = json_decode($row['state_citylist']);
        if(is_array($citylist))
        {
        foreach($citylist as $name)
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