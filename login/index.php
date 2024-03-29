<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
	include('../config.php');
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if($_POST['secret']  === "X1766086542124389214"){
            $imei = $_POST['imei'];
            $sql = "SELECT * FROM devices WHERE imei = '$imei'";
            $result = $conn->query($sql);
            header('Content-Type: application/json');
            $id = 0;
            if(mysqli_num_rows($result)>0){
                while($row = mysqli_fetch_assoc($result)){
                    $id = (int)$row['id'];
                    $imei = $row['imei'];
                    $last_login = $row['last_login'];
                    $data[] = ['id'=>$id,'imei'=>$imei, 'last_login'=>$last_login];
                }
                echo json_encode(['status'=>true, 'data'=>$data]);
                $sql = "UPDATE devices SET last_login = NOW() WHERE id = $id";
                $conn->query($sql);
            }
            else{
                echo json_encode(['status'=>false, 'data'=> []]);
            }
        }
        else{
            echo json_encode(['status'=>false, 'data'=>'You are not authorised']);
        }
    } 
    else{
        echo json_encode(['status'=>false, 'data'=>'Unauthorised access']);
    }
?>