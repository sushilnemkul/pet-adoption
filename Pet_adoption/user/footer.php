<style>
/* Make sure the HTML and body fill the entire height */
html, body {
    height:100%;
    margin: 0;
    padding: 0;
}

/* Flexbox layout for the body */
body {
    display: flex;
    flex-direction: column;
    min-height: 100vh; /* 100% of the viewport height */
}

/* The main content will expand to fill available space */
main {
    flex: 1;
}

/* Footer styles (already provided) */
footer {
    background-color:#ffe5b4 ;
    padding: 10px 0;
    color: #333;
    text-align: center;
    font-family: Arial, sans-serif;
}

.footer-container {
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap;
    padding: 0 10px;
    padding-left: 100px;
    height: 200px;
}

 .footer-links, .footer-contact {
    flex: 2;
    min-width: 10px;
    margin: 15px;
}
 .footer-links h3, .footer-contact h3 {
    margin-bottom: 15px;
    font-size: 18px;
}

.footer-links ul {
    list-style-type: none;
    padding: 0;
}

.footer-links ul li {
    margin: 8px 0;
}

.footer-links ul li a {
    color: #333;
    text-decoration: none;
}

.footer-links ul li a:hover {
    text-decoration: underline;
}

.footer-contact p {
    margin: 5px 0;
}

.footer-bottom {
    background-color: #333;
    color: #fff;
    padding: 10px 0;
    margin-top: 20px;
}

.footer-bottom p {
    margin: 0;
    font-size: 14px;
}


.footer-about {
    display: flex;
    align-items: center;
    flex: 2;
    min-width: 100px;
    margin: 15px;
}

.footer-about .logo2 img {
    margin-right: 10px; /* Adds some spacing between the logo and text */
    padding-left: 200px;
}

.footer-about-content {
    flex: 1;
    padding-top: 20PX;

}

.footer-about h3 {
    margin-top: 0;
    font-size: 18px;
    padding-bottom: 300px;
}



</style>
<footer>
    <div class="footer-container">
    <div class="logo2">
                <img src="img/logo.png" alt="Adopt A Buddy Logo" width="120" height="120">
            </div>
        <div class="footer-about-content">
          
            <h3>About Adopt A Buddy</h3>
            <p>Adopt A Buddy is a non-profit organization dedicated to finding forever homes for pets in need. Join us in our mission to provide love and care to animals waiting to be adopted.</p>
        </div>
        <div class="footer-links">
            <h3>Quick Links</h3>
            <ul>
                <li><a href="pets.php">Available Pets</a></li>
                <!-- <li><a href="cats.php">Available Cats</a></li> -->
                <li><a href="#how-to-help">How To Help</a></li>
                <li><a href="#contact">Contact Us</a></li>
            </ul>
        </div>
        <div class="footer-contact">
            <h3>Contact Us</h3>
            <p>Email: namecoolsusil@gmail.com</p>
            <p>Phone: +977 9843432401</p>
            <p>Address: Siddhipur, Lalitpur, 46000</p>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; 2024 Adopt A Buddy. All rights reserved.</p>
    </div>
</footer>
</body>
</html>