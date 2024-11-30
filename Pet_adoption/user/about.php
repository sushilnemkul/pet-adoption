<?php include 'header.php';?>
<style>
body {
    
    background-color: #eae1df; /* beige */
    margin: 0;
   
  }
  .container-intro {
    max-width: 1200px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    grid-gap: 20px;
    margin-top: 200px;
    margin-bottom: 50px;
  }
  .container {
    max-width: 1200px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    grid-gap: 20px;
  }
  .team-member {
    background-color: #fcf5ee; /* Light Peach */
    padding: 20px;
    border-radius: 8px;
    text-align: center;
  }
  .team-member h2 {
    margin-top: 0;
    font-size: 24px;
    color: #006666; 
  }
  .team-member p {
    margin-bottom: 10px;
    font-size: 18px;
  }
.btnn button{
    display: inline-block;
    padding: 8px 16px;
    background-color: #00ffff; 
    color: white;
    text-decoration: none;
    border-radius: 4px;
    transition: background-color 0.3s;
    cursor: pointer;
    margin-right: 10px;
    margin-top: 20px;
    font-weight: bold;
}
.connect-btn:hover {
    background-color: #006666; 
  }
  .team-member img {
    max-width: 20%;
    border-radius: 50%;
    margin-bottom: 50px;
  }
 .container-intro p{
    font-size: 1.5rem;
    margin-left: 90px;
  }

  .about-section h2 {
      font-size: 50px;
      font-weight: bold;
      text-align: center;
  }
</style>

<div class="container-intro">
        <div class="about-section">
          <h2>About Us</h2><br>
          <p>Welcome to my page!</p><br>
          <p>Hello and welcome to our pet adoption website!</p><br>
          <p>I'm Sushil Nemkul and I'm passionate about pet adoption.</p><br>
          <p>Here, we connect loving families with pets in need of a home. Browse through our available pets and find your new best friend today. With a user-friendly interface built using HTML, CSS, JavaScript, and PHP, we aim to make the adoption process easy and accessible for everyone.</p><br>
          <p>Thank you for visiting my page and being a part of pet adoption!</p>
        </div>
    </div>
    <!-- Add card -->
    <div class="container">
        <div class="team-member" id="sushil">
            <img src="img/sushil.jpg" alt="Sushil Nemkul">
            <h2>Sushil Nemkul</h2>
            <p><strong>Location: </strong>Siddhipur, Lalitpur</p>
            <p>Research, Coding, Design and Development</p>
            <p>Responsible for ideation and research, writing code for this Adoption page, writing and designing the UI.</p>
           <div class="btnn">
            <button><a href="https://www.linkedin.com/in/sushil-nemkul-7868b2261/">Linkedin</a></button>
        <button ><a href="https://github.com/sushilnemkul/pet-adoption">Github</a></button>
        <button><a href="https://sushilnemkul.com.np/">Website</a></button>
        </div>
        </div>
    </div>
    <br><br>
    <br>


<?php include 'footer.php';?>