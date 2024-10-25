<?php include 'header.php'; ?>
<div class="background">  
        <br><br><br><br><br><br><br><br><br><br><br>
        <div class="content"><br><br><br><br><br><br>
          <h2>Find Your Forever <span>Friend</span><br>At The Shelter.</h2>
          <p class="par">When you adopt, you’re not only saving a life but also experiencing 
              <br>the unconditional love and joy that only a pet can bring.<br> 
              So, consider adopting and be a hero for those who need it most</p>

            <button class="cn"><a href="#">ADOPT A BUDDY</a></button>
        </div><br><br><br><br>
        <h1 class="pets">Pets Available For Adoption ></h1>
        <div class="main">
       
        <div class="cards">
          <div class="image">
               <a href="#"><img src="dg6.jpg.webp" alt="luna"></a>
          </div>
          <div class="pname">
             <h1>Luna</h1>
          </div>
          <div class="des">
            <P> Age: 1 <br>Breed: Dalmatian</P>
          </div>
          <div class="btn1">
            <button><a href="#">Details</a></button>
            <button ><a href="#">Adopt</a></button>
            
          </div>

        
       </div>
        </div>
        <div class="cards">
          <div class="image">
               <a href="#"><img src="dg2.jpg.webp" alt="luna"></a>
          </div>
          <div class="pname">
             <h1>Simba</h1>
          </div>
          <div class="des">
            <P> Age: 1.5 <br>Breed: Corgi</P>
          </div>
          <div class="btn1">
            <button><a href="#">Details</a></button>
            <button ><a href="#">Adopt</a></button>
            
          </div>

        
       </div>
       <div class="cards">
        <div class="image">
             <a href="#"><img src="ct4.jpg.webp" alt="luna"></a>
        </div>
        <div class="pname">
           <h1>Sweety</h1>
        </div>
        <div class="des">
          <P> Age: 1.5 <br>Breed: Siamese</P>
        </div>
        <div class="btn1">
          <button><a href="#">Details</a></button>
          <button ><a href="#">Adopt</a></button>
          
        </div>
      </div>  
      <div class="cards">
          <div class="image1">
               <a href="#"><img src="more.jpg" alt="luna"></a>
          </div>
          <div class="pname1">
           <h1>More pets available<br> for adoption</h1>
        </div>
          <div class="btn2">
            <!-- <button><a href="option.php">Find more </a></button> -->
            <button id="findMoreBtn" class="btn">Find more</button>
            <style>
             
/* Main page styles */
body {
    font-family: Arial, sans-serif;
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
            <div id="popup" class="popup">
        <div class="popup-content">
            <span class="close">&times;</span>
            <h3>Select an Option</h3>
            <button id="dogBtn" class="popup-btn">Dog</button>
            <button id="catBtn" class="popup-btn">Cat</button>
        </div>
    </div>
    <script>
      // Get elements
const findMoreBtn = document.getElementById('findMoreBtn');
const popup = document.getElementById('popup');
const closeBtn = document.querySelector('.close');
const dogBtn = document.getElementById('dogBtn');
const catBtn = document.getElementById('catBtn');

// Open popup when "Find more" button is clicked
findMoreBtn.onclick = function() {
    popup.style.display = 'block';
}

// Close popup when 'X' is clicked
closeBtn.onclick = function() {
    popup.style.display = 'none';
}

// Handle Dog selection
dogBtn.onclick = function() {
 window.location.href = 'Dogs.php';
}

// Handle Cat selection
catBtn.onclick = function() {
 window.location.href = 'cats.php';
}

// Close popup if user clicks outside of the popup content
window.onclick = function(event) {
    if (event.target == popup) {
        popup.style.display = 'none';
    }
}


    </script>
          </div> 
       </div>
       <?php include 'footer.php'; ?>  
       </div>
       
   
     <!-- cars add here -->
      </div>              
    </div> 
   </div>





   

        