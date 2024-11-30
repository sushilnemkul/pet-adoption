<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Day 16 : PHP user registration </title>
</head>
<body>
    <h3>Day 16: File Upload | PHP</h3>
    <hr>

    <form action="file_handler.php" method="post" enctype="multipart/form-data">
        <label for="full_name">Full Name: </label>
        <input type="text" name="full_name" id="full_name"><br><br>
       
        <label for="username">Username: </label>
        <input type="text" name="username" id="username"><br><br>

        <label for="email">Email: </label>
        <input type="text" name="email" id="email"><br><br>

        <label for="password"> Password: </label>
        <input type="password" name="password" id="password"><br><br>

        <label>Select File you want to upload</label><br><br>
        <input type="file" name="file_to_upload" id="file_to_upload"><br><br>

        <input type="submit" value="Register" name="upload">
    </form>
    <br><br>
    <h1>Users List</h1>
    <table>
        <thead>
            <tr>
                <th>S.No.</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Profile</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require_once 'display_user_data.php';

            $users = fetchUserData();
            $counter = 1;

            foreach($users as $user){
            ?>
            <tr>
                <td><?php echo $counter; ?></td>
                <td><?php echo $user['full_name']; ?></td>
                <td><?php echo $user['username']; ?></td>
                <td><?php echo $user['email']; ?></td>
                <td><img src="<?php echo "/".$user['profile_pic']; ?>" alt="Profile Picture" width='100' height='100' ></td>
                
            </tr>
            <?php $counter++; } ?>
        </tbody>
    </table>
</body>
</html>