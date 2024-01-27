<?php
	include('../config.php');
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if($_POST['secret']  === "X17660865421243894"){
            $id = $_POST['id'];
            $sql = "SELECT * FROM messages WHERE device_id = '$id'";
            $result = $conn->query($sql);
            header('Content-Type: application/json');
            if(mysqli_num_rows($result)>0){
                while($row = mysqli_fetch_assoc($result)){
                    $id = $row['id'];
                    $phone_no = $row['phone_no'];
                    $content = $row['content'];
                    $created_at = $row['created_at'];
                    $data[] = ['id'=>$id,'phone_no'=>$phone_no, 'content'=>$content, 'created_at'=>$created_at];
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