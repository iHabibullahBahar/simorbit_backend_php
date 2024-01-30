<?php
	include('../config.php');
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if($_POST['secret']  === "X1766086542124389214"){
            $ids = $_POST['ids'];
            echo $ids;
            $sql = "SELECT * FROM messages WHERE device_id  IN ($ids)";
            $result = $conn->query($sql);
            header('Content-Type: application/json');
            if(mysqli_num_rows($result)>0){
                while($row = mysqli_fetch_assoc($result)){
                    $id = (int)$row['id'];
                    $device_id = (int)$row['device_id'];
                    $sql = "Select imei from devices where id = $device_id";
                    $result1 = $conn->query($sql);
                    $row1 = mysqli_fetch_assoc($result1);
                    $imei = $row1['imei'];
                    
                    $phone_no = $row['phone_no'];
                    $content = $row['content'];
                    $created_at = $row['created_at'];
                    $data[] = ['id'=>$id, 'imei' => $imei, 'device_id'=>$device_id,'phone_no'=>$phone_no, 'content'=>$content, 'created_at'=>$created_at];
                }
                echo json_encode(['status'=>true, 'data'=>$data]);
            }
            else{
                echo json_encode(['status'=>true, 'data'=>[]]);
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