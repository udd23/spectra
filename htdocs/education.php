<?php
// Database Connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "user_system";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle Form Submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['full-name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $level_of_education = $_POST['level-of-education'];
    $field_of_study = $_POST['field-of-study'];
    $institution_name = $_POST['institution-name'];
    $graduation_year = $_POST['graduation-year'];
    $current_occupation = $_POST['current-occupation'];
    $skills_acquired = $_POST['skills-acquired'];
    $favorite_subjects = $_POST['favorite-subjects'];
    $extracurricular_activities = $_POST['extracurricular-activities'];
    $future_education_goals = $_POST['future-education-goals'];
    $contact_email = $_POST['contact-email'];
    $contact_phone = $_POST['contact-phone'];

    $sql = "INSERT INTO education_survey (full_name, age, gender, level_of_education, field_of_study, institution_name, graduation_year, current_occupation, skills_acquired, favorite_subjects, extracurricular_activities, future_education_goals, contact_email, contact_phone) VALUES ('$full_name', '$age', '$gender', '$level_of_education', '$field_of_study', '$institution_name', '$graduation_year', '$current_occupation', '$skills_acquired', '$favorite_subjects', '$extracurricular_activities', '$future_education_goals', '$contact_email', '$contact_phone')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Survey response submitted successfully!');</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survey Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
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


<body class="bg-gray-100 text-gray-800 p-6">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-xl font-bold mb-4">Education Survey</h2>
        <form method="POST">
            <label>Full Name:</label>
            <input type="text" name="full-name" class="w-full p-2 border rounded mb-2" required>
            <label>Age:</label>
            <input type="number" name="age" class="w-full p-2 border rounded mb-2" required>
            <label>Gender:</label>
            <select name="gender" class="w-full p-2 border rounded mb-2">
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
            </select>
            <label>Level of Education:</label>
            <input type="text" name="level-of-education" class="w-full p-2 border rounded mb-2" required>
            <label>Field of Study:</label>
            <input type="text" name="field-of-study" class="w-full p-2 border rounded mb-2" required>
            <label>Institution Name:</label>
            <input type="text" name="institution-name" class="w-full p-2 border rounded mb-2" required>
            <label>Graduation Year:</label>
            <input type="number" name="graduation-year" class="w-full p-2 border rounded mb-2" required>
            <label>Current Occupation:</label>
            <input type="text" name="current-occupation" class="w-full p-2 border rounded mb-2">
            <label>Skills Acquired:</label>
            <textarea name="skills-acquired" class="w-full p-2 border rounded mb-2"></textarea>
            <label>Favorite Subjects:</label>
            <textarea name="favorite-subjects" class="w-full p-2 border rounded mb-2"></textarea>
            <label>Extracurricular Activities:</label>
            <textarea name="extracurricular-activities" class="w-full p-2 border rounded mb-2"></textarea>
            <label>Future Education Goals:</label>
            <textarea name="future-education-goals" class="w-full p-2 border rounded mb-2"></textarea>
            <label>Contact Email:</label>
            <input type="email" name="contact-email" class="w-full p-2 border rounded mb-2" required>
            <label>Contact Phone:</label>
            <input type="tel" name="contact-phone" class="w-full p-2 border rounded mb-2">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Submit</button>
        </form>
    </div>
</body>
</html>
