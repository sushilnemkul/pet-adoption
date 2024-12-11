

<?php include 'header.php'; ?>

<?php


// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    // Redirect to pets.php if logged in
    header("Location: pets.php");
    exit();
} else {
    // Redirect to login.php if not logged in
    header("Location: login.php");
    exit();
}

?>

<div class="background">  
        <br><br><br><br><br><br><br><br><br><br><br>
        <div class="content"><br><br><br><br><br><br>
          <h2>Find Your Forever <span>Friend</span><br>At The Shelter.</h2>
          <p class="par">When you adopt, you’re not only saving a life but also experiencing 
              <br>the unconditional love and joy that only a pet can bring.<br> 
              So, consider adopting and be a hero for those who need it most</p>

            <button class="cn" id="adoptButton"><a href="#">ADOPT A BUDDY</a></button>
        </div>
        <h1 class="pets">Pets Available For Adoption ></h1>
        <div class="main">
       
        <div class="cards">
          <div class="image">
               <a href="#"><img src="img/dg6.jpg.webp" alt="luna"></a>
          </div>
          <div class="pname">
             <h1>Luna</h1>
          </div>
          <div class="des">
            <P> Age: 1 <br>Breed: Dalmatian</P>
          </div>
          <div class="btn1">
            <button><a href="#">Details</a></button>
            <button id="adoptButton"><a href="#">Adopt</a></button>
            
          </div>

        
       </div>
        </div>
        <div class="cards">
          <div class="image">
               <a href="#"><img src="img/dg2.jpg.webp" alt="luna"></a>
          </div>
          <div class="pname">
             <h1>Simba</h1>
          </div>
          <div class="des">
            <P> Age: 1.5 <br>Breed: Corgi</P>
          </div>
          <div class="btn1">
            <button><a href="#">Details</a></button>
            <button id="adoptButton" ><a href="#">Adopt</a></button>
            
          </div>

        
       </div>
       <div class="cards">
        <div class="image">
             <a href="#"><img src="img/ct4.jpg.webp" alt="luna"></a>
        </div>
        <div class="pname">
           <h1>Sweety</h1>
        </div>
        <div class="des">
          <P> Age: 1.5 <br>Breed: Siamese</P>
        </div>
        <div class="btn1">
          <button><a href="#">Details</a></button>
          <button id="adoptButton" ><a href="#">Adopt</a></button>
          
        </div>
      </div>  
      <div class="cards">
          <div class="image1">
               <a href="#"><img src="img/more.jpg" alt="luna"></a>
          </div>
          <div class="pname1">
           <h1>More pets available<br> for adoption</h1>
        </div>
          <!-- <div class="btn2">
             <button><a href="option.php">Find more </a></button> -->

            <!-- <button id="adoptButton" class="btn"><a href="pets.php">Find more</a></button> -->
            <div class="btn2">
    <form action="indexx.php" method="post">
        <button type="submit" class="btn">Find more</button>
    </form>
</div>

        

            <script src="scriptt.js" class="btn"></script>
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

/* Popup styles */
.popup {
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: white;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
    z-index: 999;
    width: 300px;
    text-align: center;
    border-radius: 10px;
}

.popup-content {
    padding: 20px;
}

.popup-btn {
    background-color: #00FFCC;
    padding: 10px 20px;
    border: none;
    margin: 5px;
    cursor: pointer;
    border-radius: 5px;
}

.close {
    float: right;
    font-size: 20px;
    cursor: pointer;
}

/* Ensure popup is centered */
.popup-content h3 {
    margin-top: 0;
}




            </style>
            <!-- <div id="popup" class="popup">
        <div class="popup-content">
            <span class="close">&times;</span>
            <h3>Select an Option</h3>
            <button id="dogBtn" class="popup-btn">Dog</button>
            <button id="catBtn" class="popup-btn">Cat</button>
        </div>
    </div> -->
    


          </div> 
       </div>
      
       <?php include 'footer.php'; ?>  
       </div>
       
   
     <!-- cars add here -->
      </div>              
    </div> 
   </div>





   

        