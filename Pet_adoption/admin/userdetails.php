

<?php
include 'config.php';

$data = array();
$id = $_GET['id'];

$sql = "SELECT * FROM users WHERE ID = {$id}";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $data = array(
            "ID" => $row['ID'],
            "name" => $row['name'],
            "email" => $row['email'],
            "password" => $row['password'],
            "phone" => $row['Phone'],
            "address" => $row['address'],

        );
         
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
    <style>
        body {
          
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color:#e3dac9 ;
        }

        .card {
            padding-top: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 100px auto;
            width: 800px;
            height: 400px;
            background-color: #f7e7ce;
            border-radius: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.4);
            padding: 20px;
        }

        .card img {
            width: 300px;
            height: 300px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 40px;
            border: 3px solid #ddd;
        }

        .details {
            flex: 1;
            padding-left: 50px;
        }

        .details h1 {
            
            text-align: left;
            font-size: 24px;
            margin-bottom: 20px;
            
        }

        .details p {
            margin: 5px 0;
            color: #333;
        }

        .back-link {
            margin-left: 10px;
            margin-top: 20px;
            display: inline-block;
            text-decoration: none;
            color: #007bff;
            cursor: pointer;
            border: none;
            border-radius: 20px;
            padding: 10px 20px;
            background-color: #28a749;
            color: white
        }
        .back-link i{
            margin-right: 10px;
            font: 1em sans-serif;
        }

        .back-link:hover {
            background-color: #000000;
        }
        .adopt{
            margin-left: 140px;
            margin-top: 20px;
            display: inline-block;
            text-decoration: none;
            color: #007bff;
            cursor: pointer;
            border: none;
            border-radius: 20px;
            padding: 10px 20px;
            background-color: #28a749;
            color: white
        }
        .adopt:hover{
            background-color: #000000;
        }
    </style>
</head>
<body>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <section>
        <br><br><br>
        <div class="card">            
            <!-- <div class="img">
                <img src="../admin/uploaded_img/<?php echo $data['image']; ?>" alt="Pet Image">
            </div> -->
            <div class="details">
                <h1>User Details</h1>
                <p><strong>ID:</strong> <?php echo $data['ID']; ?></p>
                <p><strong>Name:</strong> <?php echo $data['name']; ?></p>
                <p><strong>Email:</strong> <?php echo $data['email']; ?></p>
                <p><strong>Password:</strong> <?php echo $data['password']; ?></p>
                <p><strong>Phone:</strong> <?php echo $data['phone']; ?></p>
                <p><strong>Address:</strong> <?php echo $data['address']; ?></p>
                <a href="users.php" class="back-link"><i class="">   Back</i></a>
                
            </div>
        </div>
    </section>
</body>

</html>
