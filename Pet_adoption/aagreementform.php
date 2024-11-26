<? include 'header.php'; ?>
<style>
body {
    background-color: #eae1df; /* beige */
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
    text-align: center;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100vh;
  }

  h2 {
    font-size: 24px;
    margin-bottom: 20px;

  }

  .form {
    background-color: #fcf5ee; /* Light Peach */
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    width: 400px;
    text-align: left;
  }

  label {
    display: block;
    margin-bottom: 10px;
    font-weight: bold;
  }

  input[type="text"],
  input[type="email"],
  input[type="tel"],    
  input[type="date"],
  textarea {
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    margin-bottom: 10px;
    font-size: 16px;
  }

  input[type="submit"] {
    background-color: #28a745;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
  }
</style>

<div class="body">

<h2> Adoption Application Form </h2>
<div class="form">
<form action="aagreementform.php" method="post">
    <label for="name">Full Name:</label>
    <input type="text" id="name" name="name" placeholder="Enter your name" required>

    <label for="email">Email:</label>    
    <input type="email" id="email" name="email" placeholder="Email" required>

    <label for="address">Address:</label>
    <input type="text" id="address" name="address" placeholder="Address" required>

    <label for="phone">Phone:</label>
    <input type="tel" id="phone" name="phone" placeholder="Phone" required>

    <label for="occupation">Occupation:</label>
    <input type="text" id="occupation" name="occupation" placeholder="Occupation" required>

    <label for="previous_pets">Previous Pets:</label>
    <input type="text" id="previous_pets" name="previous_pets" placeholder="Previous Pets" required>

    <label for="Pet_ID">Pet ID:</label>
    <input type="text" id="Pet_ID" name="Pet_ID" placeholder="Pet ID" required>

    <input type="submit" class="btn-submit" value="Submit" name="submit">
</form>

</div>
</div>


<?include 'footer.php'; ?>