<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
</head>
<body>
    <form action="" method="post">
    <label for="pet_search">Search by product</label><br><br>
    <input type="text" name="pet_search" id="pet_search" placeholder="search by product"><br><br>
    
    <input type="submit" value="Search" name="search">
</form>
<br><br>
<h1>Your products will be displayed here</h1>
<h5><a href="">Clear search</a></h5>
<table border="1">
    <thead>
        <tr>
            <th>S.No.</th>
            <th>Product Title</th>
            <th>Description</th>
            <th>Price</th>
            <th>category</th>
        </tr>
    </thead>
    <tbody>
    <?php
    include 'search.php';
    $result = getProducts();
    if(empty($result)){
    echo "Search products by product title first";
    exit();
    }else{
        $counter= 1;
        foreach($result as $product){
            ?>
            <tr>
                <td><?php echo $counter; ?></td>
                <td><?php echo $product['product_title']; ?></td>
                <td><?php echo $product['product_desc']; ?></td>
                <td><?php echo $product['product_price']; ?></td>
                <td><?php echo $product['product_category']; ?></td>
            </tr>
            <?php
             $counter++;
        }
       
    }
    ?>
    </tbody>
</table>
</body>
</html>