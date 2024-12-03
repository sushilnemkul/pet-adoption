<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animal Buttons</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-color: #f0f0f0;
}

.button-container {
    display: flex;
    gap: 20px;
}

.square-button {
    width: 150px;
    height: 150px;
    font-size: 24px;
    background-color: #4CAF50; /* Green */
    color: white;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.square-button:hover {
    background-color: #45a049; /* Darker green */
}
    </style>
</head>
<body>
    <div class="button-container">
        <button class="square-button" onclick="window.location.href='Dogs.php'">Dogs</button>
        <button class="square-button" onclick="window.location.href='cats.php'">Cats</button>
    </div>
</body>
</html>