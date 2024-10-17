<style>
/* Make sure the HTML and body fill the entire height */
html, body {
    height: 100%;
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
    background-color: #f5f5f5;
    padding: 30px 0;
    color: #333;
    text-align: center;
    font-family: Arial, sans-serif;
}

.footer-container {
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap;
    padding: 0 20px;
}

.footer-about, .footer-links, .footer-contact {
    flex: 1;
    min-width: 200px;
    margin: 15px;
}

.footer-about h3, .footer-links h3, .footer-contact h3 {
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


</style>
<footer>
    <div class="footer-container">
        <div class="footer-about">
            <h3>About Adopt A Buddy</h3>
            <p>Adopt A Buddy is a non-profit organization dedicated to finding forever homes for pets in need. Join us in our mission to provide love and care to animals waiting to be adopted.</p>
        </div>
        <div class="footer-links">
            <h3>Quick Links</h3>
            <ul>
                <li><a href="#dogs">Available Dogs</a></li>
                <li><a href="#cats">Available Cats</a></li>
                <li><a href="#how-to-help">How To Help</a></li>
                <li><a href="#contact">Contact Us</a></li>
            </ul>
        </div>
        <div class="footer-contact">
            <h3>Contact Us</h3>
            <p>Email: info@adoptabuddy.com</p>
            <p>Phone: +123 456 7890</p>
            <p>Address: 1234 Pet Street, Animal City, 56789</p>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; 2024 Adopt A Buddy. All rights reserved.</p>
    </div>
</footer>
</body>
</html>