<?php include 'header.php';?>

<?php
// Start session

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}


// Include database connection
include 'database.php';



// Fetch user data
$user_id = $_SESSION['user_id'];
$user_query = $conn->prepare("SELECT name, email, address, Phone FROM users WHERE ID = ?");
$user_query->bind_param("i", $user_id);
$user_query->execute();
$user_result = $user_query->get_result();
$user_data = $user_result->fetch_assoc();



// Fetch pet ID from the URL
$pet_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Check if pet exists
$pet_query = $conn->prepare("SELECT pet_id FROM pets WHERE pet_id = ?");
$pet_query->bind_param("i", $pet_id);
$pet_query->execute();
$pet_result = $pet_query->get_result();

if ($pet_result->num_rows === 0) {
    echo "<script>alert('Pet not found. Please contact support.');</script>";
    exit();
}

// Process form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Fetch input values
    $phone = $conn->real_escape_string($_POST['phone']);
    $occupation = $conn->real_escape_string($_POST['occupation']);
    $previous_pets = $conn->real_escape_string($_POST['previous_pets']);
    

    // Handle file upload
    $document = $_FILES['document']['name'];
    $document_tmp_name = $_FILES['document']['tmp_name'];
    $unique_name = time() . '_' . basename($document); // Ensure unique filename
    $document_folder = "../admin/img1/" . $unique_name;

    if ($_FILES['document']['error'] === UPLOAD_ERR_OK && move_uploaded_file($document_tmp_name, $document_folder)) {
        // Insert data into the database using a prepared statement
        $stmt = $conn->prepare(
            "INSERT INTO agreement_form (name, email, address, phone, occupation, previous_pets, pet_id, user_id, documents) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)"
        );
        $stmt->bind_param(
            "ssssssiss",
            $user_data['name'],
            $user_data['email'],
            $user_data['address'],
            $phone,
            $occupation,
            $previous_pets,
            $pet_id,
            $user_id,
            
            $unique_name
            
        );

        if ($stmt->execute()) {
            echo "<script>alert('Form submitted successfully!');</script>";
            header("Location: profile.php");
            exit();
        } else {
            echo "Database Error: " . $conn->error;
        }
    } else {
        echo "Failed to upload the document. Error: " . $_FILES['document']['error'];
    }
}
$allowed_types = ['image/png', 'image/jpeg', 'image/jpg', 'image/webp'];
if (in_array($_FILES['document']['type'], $allowed_types) && $_FILES['document']['size'] <= 2 * 1024 * 1024) {
    // Proceed with file upload
} else {
    echo "Invalid file type or file size exceeds limit.";
}


?>


<body>
    <div class="body">
        <h2>Adoption Application Form</h2>
        <div class="form">
            <form action="aagreementform.php?id=<?= htmlspecialchars($pet_id) ?>" method="post" enctype="multipart/form-data">
            <div>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?= htmlspecialchars($user_data['name']) ?>" readonly>
    </div>
    <div>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($user_data['email']) ?>" readonly>
    </div>
    <div>
        <label for="address">Address:</label>
        <input type="text" id="address" name="address" value="<?= htmlspecialchars($user_data['address']) ?>" readonly>
    </div>
    <div>
        <label for="phone">Phone:</label>
        <input type="tel" id="phone" name="phone" value="<?= htmlspecialchars($user_data['Phone']) ?>" readonly>
    </div>

                <label for="occupation">Occupation:</label>
                <input type="text" id="occupation" name="occupation" placeholder="Enter your occupation" required>

                <label for="previous_pets">Previous Pets:</label>
                <input type="text" id="previous_pets" name="previous_pets" placeholder="Enter details of previous pets" required>

                <label for="Pet_ID">Pet ID:</label>
                <input type="text" id="Pet_ID" name="Pet_ID" value="<?= htmlspecialchars($pet_id); ?>" readonly>

              

                <label for="document">Document (citizenship, passport, etc.):</label>
                <input type="file" id="document" name="document" accept="image/png, image/jpeg, image/jpg, image/webp" required>

                <input type="checkbox" id="terms" name="terms" required>
                <label for="terms">
                    I agree to the 
                    <span class="terms-link" onclick="toggleTerms()">terms and conditions</span>.
                </label>

                <div id="termsDropdown" style="display:none;">
                    <h3>Terms and Conditions</h3>
                    <p>1. You must agree to these terms to use our services.</p>
                    <p>2. Your data will be handled in accordance with our privacy policy.</p>
                    <p>3. Violations of these terms may result in suspension or termination of service.</p>
                </div>

                <input type="submit" class="btn-submit" id="request" value="Submit" name="submit">
            </form>
        </div>
    </div>

    <script>
        function toggleTerms() {
            const dropdown = document.getElementById("termsDropdown");
            dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
        }
    
    </script>
    

</body>
</html>



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
    background-image: url(img/back.jpg);
    background-size: cover;
  
  }

  h2 {
    font-size: 34px;
    margin-top: 720px;
    margin-bottom: 10px;
  }

  .form {
    background-color: #fcf5ee; /* Light Peach */
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    width: 500px;
    text-align: left;
    margin-bottom: 30px;
    padding-left: 30px;
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
    padding: 16px 20px;
    margin: 8px 180px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-size: 16px;
    align-self: center;
  }

  input[type="file"] {
    display: block;
    width: 100%;
    margin-bottom: 20px;
    padding: 10px;
    font-size: 14px;
    color: #555;
    background: #f9f9f9;
    border: 1px solid #ddd;
    border-radius: 4px;
    cursor: pointer;
  }

  input[type="checkbox"] {
    margin-right: 8px;
    transform: scale(1.2);
    cursor: pointer;
  }

  input[type="checkbox"] + label {
    font-size: 14px;
    color: #333;
    display: inline-block;
    cursor: pointer;
    text-align: center;
  }

  #termsDropdown {
    display: none;
    margin-top: 10px;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    background-color: #f9f9f9;
    font-size: 14px;
    color: #555;
  }

  .terms-link {
    color: #007BFF;
    cursor: pointer;
    text-decoration: underline;
  }

  .terms-link:hover {
    color: #0056b3;
  }
</style>

<?php include 'footer.php'; ?>
