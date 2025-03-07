<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "user_system";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hospital_name = $_POST['hospital-name'];
    $location = $_POST['location'];
    $number_of_beds = $_POST['number-of-beds'];
    $number_of_doctors = $_POST['number-of-doctors'];
    $number_of_nurses = $_POST['number-of-nurses'];
    $annual_budget = $_POST['annual-budget'];
    $hospital_website = $_POST['hospital-website'];
    $contact_person = $_POST['contact-person'];
    $contact_email = $_POST['contact-email'];
    $contact_phone = $_POST['contact-phone'];
    $hospital_address = $_POST['hospital-address'];

    $sql = "INSERT INTO hospital_survey (hospital_name, location, number_of_beds, number_of_doctors, number_of_nurses, annual_budget, hospital_website, contact_person, contact_email, contact_phone, hospital_address) 
            VALUES ('$hospital_name', '$location', '$number_of_beds', '$number_of_doctors', '$number_of_nurses', '$annual_budget', '$hospital_website', '$contact_person', '$contact_email', '$contact_phone', '$hospital_address')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Survey submitted successfully!'); window.location.href='hospital.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Integral And Advance Polling and Data Collection Form System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"></link>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&family=Open+Sans:wght@400;600;700&family=Lato:wght@400;700&family=Montserrat:wght@400;700&family=Poppins:wght@400;700&family=Nunito:wght@400;700&family=Raleway:wght@400;700&family=Merriweather:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
        }
    </style>
    <script>
        function changeFormTheme(theme) {
            const formContainer = document.getElementById('form-container');
            formContainer.className = theme + ' p-6 rounded-lg shadow-lg w-full max-w-2xl';
        }

        function changeFont(font) {
            document.body.style.fontFamily = font;
        }


    </script>


</head>

<div class="flex justify-center mb-8">
            <div class="mr-4">
                <label for="form-theme" class="block text-gray-800 mb-2">Select Form Theme:</label>
                <select id="form-theme" class="p-2 rounded text-gray-800" onchange="changeFormTheme(this.value)">
                    <option value="bg-white text-black">Default</option>
                    <option value="bg-gray-800 text-white">Dark</option>
                    <option value="bg-blue-500 text-white">Blue</option>
                    <option value="bg-green-500 text-white">Green</option>
                    <option value="bg-red-500 text-white">Red</option>
                    <option value="bg-gray-900 text-white">Gray</option>
                    <option value="bg-yellow-500 text-white">Yellow</option>
                    <option value="bg-orange-500 text-white">Orange</option>
                    <option value="bg-violet-500 text-white">Violet</option>
                </select>
            </div>
            <div>
                <label for="font" class="block text-gray-800 mb-2">Select Font:</label>
                <select id="font" class="p-2 rounded text-gray-800" onchange="changeFont(this.value)">
                    <option value="'Open Sans', sans-serif">Open Sans</option>
                    <option value="'Roboto', sans-serif">Roboto</option>
                    <option value="'Arial', sans-serif">Arial</option>
                    <option value="'Lato', sans-serif">Lato</option>
                    <option value="'Montserrat', sans-serif">Montserrat</option>
                    <option value="'Poppins', sans-serif">Poppins</option>
                    <option value="'Nunito', sans-serif">Nunito</option>
                    <option value="'Raleway', sans-serif">Raleway</option>
                    <option value="'Merriweather', sans-serif">Merriweather</option>
                    <option value="'Playfair Display', serif">Playfair Display</option>
                    <option value="'Great Vibes', cursive">Great Vibes</option>
                    <option value="'Pacifico', cursive">Pacifico</option>
                    <option value="'Dancing Script', cursive">Dancing Script</option>
                    <option value="'New Times Roman', sans-serif">New Times Roman</option>
                </select>
            </div>
        </div>


        <div class="flex justify-center">
            <div id="form-container" class="bg-white text-gray-800 p-6 rounded-lg shadow-lg w-full max-w-2xl">
                <h2 class="text-xl font-bold mb-4">Hospital Survey</h2>
                <form action="" method="POST">
            <label>Hospital Name:</label>
            <input type="text" name="hospital-name" class="w-full p-2 border rounded mb-3" required>
            
            <label>Location:</label>
            <input type="text" name="location" class="w-full p-2 border rounded mb-3" required>

            <label>Contact Person:</label>
            <input type="text" name="contact-person" class="w-full p-2 border rounded mb-3">
            
            <label>Contact Email:</label>
            <input type="email" name="contact-email" class="w-full p-2 border rounded mb-3">
            
            <label>Contact Phone:</label>
            <input type="tel" name="contact-phone" class="w-full p-2 border rounded mb-3">
            
            <label>Number of Beds:</label>
            <input type="number" name="number-of-beds" class="w-full p-2 border rounded mb-3">
            
            <label>Number of Doctors:</label>
            <input type="number" name="number-of-doctors" class="w-full p-2 border rounded mb-3">
            
            <label>Number of Nurses:</label>
            <input type="number" name="number-of-nurses" class="w-full p-2 border rounded mb-3">
            
            <label>Annual Budget:</label>
            <input type="number" name="annual-budget" class="w-full p-2 border rounded mb-3">
            
            <label>Hospital Website:</label>
            <input type="url" name="hospital-website" class="w-full p-2 border rounded mb-3">
            
            <label>Hospital Address:</label>
            <textarea name="hospital-address" class="w-full p-2 border rounded mb-3"></textarea>
            
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Submit</button>
                        <button type="button" class="bg-blue-500 text-white px-4 py-2 rounded">
                            <i class="fas fa-share"></i> Share
                        </button>
        </form>
    </div>
</body>
</html>
