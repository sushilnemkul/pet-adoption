<?php include 'header.php'; ?>
<?php
// Include database connection
include 'database.php';

// Query to fetch up to 3 pets from the database
$query = "SELECT * FROM pets ORDER BY image LIMIT 3";
$result = $conn->query($query);

if (!$result) {
    die("Database query failed: " . $conn->error);
}
?>

<div class="background">
    <br><br><br><br><br><br><br><br><br><br><br>
    <div class="content"><br><br><br><br><br><br>
        <h2>Find Your Forever <span>Friend</span><br>At The Shelter.</h2>
        <p class="par">
            When you adopt, you’re not only saving a life but also experiencing 
            <br>the unconditional love and joy that only a pet can bring.<br> 
            So, consider adopting and be a hero for those who need it most.
        </p>
        <button class="cn" id="adoptButton"><a href="pets.php">ADOPT A BUDDY</a></button>
    </div>
    <h1 class="pets">Pets Available For Adoption ></h1>
    <div class="main">
      

        <!-- "Find More" Card -->
        <div class="cards">
            <div class="image1">
                <a href="#"><img src="img/more.jpg" alt="More pets"></a>
            </div>
            <div class="pname1">
                <h1>More pets available<br> for adoption</h1>
            </div>
            <div class="btn2">
                <button id="adoptButton" class="btn"><a href="pets.php">Find more</a></button>
            </div>
        </div>
    </div>
   <?php include 'footer.php'; ?>  
   
</div>

            <style>
             
/* Main page styles */
body {
    font-family: Arial, sans-serif;
    background-color: #f7e7ce;
}

.pet-card {
    display: inline-block;
    text-align: center;
    margin: 10px;
}

.pet-img {
    width: 150px;
    height: 150px;
}

.btn {
    background-color: #00FFCC;
    padding: 10px;
    border: none;
    cursor: pointer;
    border-radius: 5px;
}




            </style>
           
    
        

          </div> 
       </div>
      
 
       </div>
     <!-- cars add here -->
      </div>              
    </div> 
   </div>





   

        