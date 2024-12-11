<?php
function getPets() {
    $data = array();

   include 'database.php';

    $query = "";
    if(isset($_POST['search'])){
        $title = $_POST['search'];
        $query = "select * from pets where pet_name like '%$title%'
        OR pet_breed like '%$title%'
        OR pet_status like '%$title%'
        OR pet_age like '%$title%'
        OR pet_gender like '%$title%'
        OR pet_desc like '%$title%'";

    }else{
        $query = "select * from pets";
    }

    $ressult = mysqli_query($conn, $query);
    if (mysqli_num_rows($ressult) > 0) {
        while ($row = mysqli_fetch_array($ressult)) {
            $data[] = array(
                "pet_name" => $row['pet_name'],
                "pet_breed" => $row['pet_breed'],
                "pet_age" => $row['pet_age'],
                "pet_gender" => $row['pet_gender'],
                "pet_desc" => $row['pet_desc'],
                "image" => $row['image'],
                "pet_status" => $row['pet_status']
            );
        }
    }
    return $data;
}
