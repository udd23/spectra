<?php
session_start(); // Start the session at the beginning of the file

// Database connection
$host = "localhost";
$dbname = "user_system";
$username = "root";  // Change this if needed
$password = "";  // Change this if needed

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize message variable
$message = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $patient_name = $_POST['patient-name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $contact_number = $_POST['contact-number'];
    $email_address = $_POST['email-address'];
    $address = $_POST['address'];
    $health_insurance_provider = $_POST['health-insurance-provider'];
    $primary_care_physician = $_POST['primary-care-physician'];
    $reason_for_visit = $_POST['reason-for-visit'];
    $current_medications = $_POST['current-medications'];
    $allergies = $_POST['allergies'];
    $past_medical_history = $_POST['past-medical-history'];
    $family_medical_history = $_POST['family-medical-history'];
    $lifestyle_and_habits = $_POST['lifestyle-and-habits'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO healthcare_survey (patient_name, age, gender, contact_number, email_address, address, health_insurance_provider, primary_care_physician, reason_for_visit, current_medications, allergies, past_medical_history, family_medical_history, lifestyle_and_habits) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sissssssssssss", $patient_name, $age, $gender, $contact_number, $email_address, $address, $health_insurance_provider, $primary_care_physician, $reason_for_visit, $current_medications, $allergies, $past_medical_history, $family_medical_history, $lifestyle_and_habits);

    // Execute the statement
    if ($stmt->execute()) {
        $_SESSION['last_survey_title'] = "Health Care Survey"; // Store the survey title in session
        $message = "Survey submitted successfully!";
    } else {
        $message = "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
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

<body class="bg-white text-gray-800">
    <div class="container mx-auto p-4">
        <div class="flex justify-start mb-4">
            <a href="javascript:history.back()" class="text-gray-800 text-2xl">
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>
        <h1 class="text-3xl font-bold text-center mb-8">Integral And Advance Polling and Data Collection Form System</h1>
        
        <?php if (!empty($message)) : ?>
            <div class="bg-green-500 text-white p-4 rounded-md text-center mb-6">
                <p><?= $message ?></p>
            </div>
        <?php endif; ?>

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
                <h2 class="text-xl font-bold mb-4">Health Care Survey</h2>
                <form action="" method="POST">
                    <div class="mb-4">
                        <label class="block text-gray-700">Patient Name:</label>
                        <input type="text" name="patient-name" class="w-full p-2 border border-gray-300 rounded" placeholder="Enter patient name" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Age:</label>
                        <input type="number" name="age" class="w-full p-2 border border-gray-300 rounded" placeholder="Enter age" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Gender:</label>
                        <select name="gender" class="w-full p-2 border border-gray-300 rounded" required>
                            <option value="">Select gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Contact Number:</label>
                        <input type="tel" name="contact-number" class="w-full p-2 border border-gray-300 rounded" placeholder="Enter contact number" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Email Address:</label>
                        <input type="email" name="email-address" class="w-full p-2 border border-gray-300 rounded" placeholder="Enter email address" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Address:</label>
                        <textarea name="address" class="w-full p-2 border border-gray-300 rounded" placeholder="Enter address" required></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Health Insurance Provider:</label>
                        <input type="text" name="health-insurance-provider" class="w-full p-2 border border-gray-300 rounded" placeholder="Enter health insurance provider" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Primary Care Physician:</label>
                        <input type="text" name="primary-care-physician" class="w-full p-2 border border-gray-300 rounded" placeholder="Enter primary care physician name" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Reason for Visit:</label>
                        <textarea name="reason-for-visit" class="w-full p-2 border border-gray-300 rounded" placeholder="Enter reason for visit" required></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Current Medications:</label>
                        <textarea name="current-medications" class="w-full p-2 border border-gray-300 rounded" placeholder="Enter current medications" required></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Allergies:</label>
                        <textarea name="allergies" class="w-full p-2 border border-gray-300 rounded" placeholder="Enter allergies" required></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Past Medical History:</label>
                        <textarea name="past-medical-history" class="w-full p-2 border border-gray-300 rounded" placeholder="Enter past medical history" required></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Family Medical History:</label>
                        <textarea name="family-medical-history" class="w-full p-2 border border-gray-300 rounded" placeholder="Enter family medical history" required></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Lifestyle and Habits:</label>
                        <textarea name="lifestyle-and-habits" class="w-full p-2 border border-gray-300 rounded" placeholder="Enter lifestyle and habits" required></textarea>
                    </div>
                    <div class="flex space-x-4">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Submit</button>
                        <button type="button" class="bg-blue-500 text-white px-4 py-2 rounded">
                            <i class="fas fa-share"></i> Share
                        </button>
                    </div>  
                </form>
            </div>
        </div>
    </div>

</body>
</html>