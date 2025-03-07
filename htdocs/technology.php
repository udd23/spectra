<?php
// Database connection details
$servername = "localhost";
$username = "root"; // Change if needed
$password = ""; // Change if needed
$dbname = "user_system"; // Change as per your database

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create table if not exists
$table_sql = "CREATE TABLE IF NOT EXISTS technology_survey (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(255),
    age INT,
    gender VARCHAR(50),
    occupation VARCHAR(255),
    primary_device VARCHAR(255),
    operating_system VARCHAR(255),
    internet_usage INT,
    favorite_brand VARCHAR(255),
    preferred_browser VARCHAR(255),
    social_media TEXT,
    favorite_apps TEXT,
    tech_hobbies TEXT,
    contact_email VARCHAR(255),
    contact_phone VARCHAR(20),
    submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($table_sql) === FALSE) {
    die("Error creating table: " . $conn->error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['full-name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $occupation = $_POST['occupation'];
    $primary_device = $_POST['primary-device-used'];
    $operating_system = $_POST['operating-system'];
    $internet_usage = $_POST['internet-usage'];
    $favorite_brand = $_POST['favorite-technology-brand'];
    $preferred_browser = $_POST['preferred-web-browser'];
    $social_media = $_POST['social-media-platforms-used'];
    $favorite_apps = $_POST['favorite-mobile-apps'];
    $tech_hobbies = $_POST['technology-related-hobbies'];
    $contact_email = $_POST['contact-email'];
    $contact_phone = $_POST['contact-phone'];

    $sql = "INSERT INTO technology_survey (full_name, age, gender, occupation, primary_device, operating_system, internet_usage, favorite_brand, preferred_browser, social_media, favorite_apps, tech_hobbies, contact_email, contact_phone)
            VALUES ('$full_name', '$age', '$gender', '$occupation', '$primary_device', '$operating_system', '$internet_usage', '$favorite_brand', '$preferred_browser', '$social_media', '$favorite_apps', '$tech_hobbies', '$contact_email', '$contact_phone')";

    if ($conn->query($sql) === TRUE) {
        $message = "Thank you! Your survey response has been recorded.";
    } else {
        $message = "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Technology Survey</title>
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
<body class="bg-gray-100 text-gray-800">
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold text-center mb-6">Technology Survey</h1>

        <?php if (isset($message)): ?>
            <div class="bg-green-200 p-4 rounded text-green-700 mb-4"><?php echo $message; ?></div>
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
            <div class="bg-white text-gray-800 p-6 rounded-lg shadow-lg w-full max-w-2xl">
                <form method="POST">
                    <div class="mb-4">
                        <label class="block text-gray-700">Full Name:</label>
                        <input type="text" name="full-name" class="w-full p-2 border rounded" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Age:</label>
                        <input type="number" name="age" class="w-full p-2 border rounded" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Gender:</label>
                        <select name="gender" class="w-full p-2 border rounded">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Contact Email:</label>
                        <input type="email" name="contact-email" class="w-full p-2 border rounded" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Contact Phone:</label>
                        <input type="tel" name="contact-phone" class="w-full p-2 border rounded">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Occupation:</label>
                        <input type="text" name="occupation" class="w-full p-2 border rounded">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Primary Device Used:</label>
                        <input type="text" name="primary-device-used" class="w-full p-2 border rounded">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Operating System:</label>
                        <input type="text" name="operating-system" class="w-full p-2 border rounded">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Internet Usage (hours per day):</label>
                        <input type="number" name="internet-usage" class="w-full p-2 border rounded">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Favorite Technology Brand:</label>
                        <input type="text" name="favorite-technology-brand" class="w-full p-2 border rounded">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Preferred Web Browser:</label>
                        <input type="text" name="preferred-web-browser" class="w-full p-2 border rounded">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Social Media Platforms Used:</label>
                        <textarea name="social-media-platforms-used" class="w-full p-2 border rounded"></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Favorite Mobile Apps:</label>
                        <textarea name="favorite-mobile-apps" class="w-full p-2 border rounded"></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Technology-Related Hobbies:</label>
                        <textarea name="technology-related-hobbies" class="w-full p-2 border rounded"></textarea>
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
