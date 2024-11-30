<?php
function fetchUserData(){
    $connect = mysqli_connect('localhost', 'root', '', 'day_nine');

    $sql = "SELECT * FROM users";
    $res_data = mysqli_query($connect, $sql);
     $user_data = array();

     if(mysqli_num_rows($res_data)>0){
        while($row = mysqli_fetch_array($res_data)){
            $user_data[] = array(
              "id" => $row['id'],
              "full_name" => $row['full_name'],
              "username" => $row['username'],
              "email" => $row['email'],
              "profile_pic" => $row['profile_pic'],  
            );
        
             }
        }

        return $user_data;

}

?>