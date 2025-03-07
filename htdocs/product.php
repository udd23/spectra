<?php
// Database configuration
$host = 'localhost'; // Change if your database is hosted elsewhere
$dbname = 'user_system'; // Database name
$username = 'root'; // Your database username
$password = ''; // Your database password

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Connected successfully to the database.<br>";

    // Function to insert a response into the responses table
    function insertResponse($data) {
        global $pdo; // Use the global PDO instance

        // Prepare the SQL statement
        $stmt = $pdo->prepare("INSERT INTO product_survey (full_name, email, phone_number, product_name, satisfaction, recommend, like_most, dislike_most, comments_suggestions, experience, contact, quality, value, product_photo) 
                                VALUES (:full_name, :email, :phone_number, :product_name, :satisfaction, :recommend, :like_most, :dislike_most, :comments_suggestions, :experience, :contact, :quality, :value, :product_photo)");

        // Bind parameters
        $stmt->bindParam(':full_name', $data['full_name']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':phone_number', $data['phone_number']);
        $stmt->bindParam(':product_name', $data['product_name']);
        $stmt->bindParam(':satisfaction', $data['satisfaction']);
        $stmt->bindParam(':recommend', $data['recommend']);
        $stmt->bindParam(':like_most', $data['like_most']);
        $stmt->bindParam(':dislike_most', $data['dislike_most']);
        $stmt->bindParam(':comments_suggestions', $data['comments_suggestions']);
        $stmt->bindParam(':experience', $data['experience']);
        $stmt->bindParam(':contact', $data['contact']);
        $stmt->bindParam(':quality', $data['quality']);
        $stmt->bindParam(':value', $data['value']);
        $stmt->bindParam(':product_photo', $data['product_photo']);

        // Execute the statement
        if ($stmt->execute()) {
            echo "Response submitted successfully!";
        } else {
            echo "Error submitting response.";
        }
    }

    // Example data to insert (replace with actual data from your form)
    $responseData = [
        'full_name' => 'John Doe',
        'email' => 'john.doe@example.com',
        'phone_number' => '1234567890',
        'product_name' => 'Sample Product',
        'satisfaction' => 'satisfied',
        'recommend' => 'likely',
        'like_most' => 'Great quality!',
        'dislike_most' => 'A bit expensive.',
        'comments_suggestions' => 'Keep up the good work!',
        'experience' => 4,
        'contact' => 'yes',
        'quality' => 5,
        'value' => 4,
        'product_photo' => 'path/to/photo.jpg' // Optional
    ];

    // Call the function to insert the response
    insertResponse($responseData);

} catch (PDOException $e) {
    // Handle connection error
    echo "Connection failed: " . $e->getMessage();
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Integral And Advance Polling and Data Collection Form System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"></link>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
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

        function handleSubmit(event) {
            event.preventDefault();
            const formContainer = document.getElementById('form-container');
            formContainer.innerHTML = `
                <h2 class="text-xl font-bold mb-4">Thank you for submitting the survey!</h2>
                <p class="mb-4">You can see your response below:</p>
                <div class="bg-gray-100 p-4 rounded-lg">
                    <p><strong>Full Name:</strong> ${event.target.elements['full-name'].value}</p>
                    <p><strong>Email:</strong> ${event.target.elements['email'].value}</p>
                    <p><strong>Phone Number:</strong> ${event.target.elements['phone-number'].value}</p>
                    <p><strong>Product Name:</strong> ${event.target.elements['product-name'].value}</p>
                    <p><strong>How satisfied are you with the product?</strong> ${event.target.elements['satisfaction'].value}</p>
                    <p><strong>How likely are you to recommend this product to others?</strong> ${event.target.elements['recommend'].value}</p>
                    <p><strong>What did you like most about the product?</strong> ${event.target.elements['like-most'].value}</p>
                    <p><strong>What did you dislike about the product?</strong> ${event.target.elements['dislike-most'].value}</p>
                    <p><strong>Any additional comments or suggestions?</strong> ${event.target.elements['comments-suggestions'].value}</p>
                    <p><strong>Rate the overall experience:</strong> ${event.target.elements['experience'].value}</p>
                    <p><strong>Would you like to be contacted for further feedback?</strong> ${event.target.elements['contact'].value}</p>
                    <p><strong>Rate the product quality:</strong> ${event.target.elements['quality'].value}</p>
                    <p><strong>Rate the value for money:</strong> ${event.target.elements['value'].value}</p>
                </div>
            `;
        }
    </script>
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="container mx-auto p-4">
        <div class="flex justify-start mb-4">
            <a href="javascript:history.back()" class="text-gray-800 text-2xl">
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>
        <h1 class="text-3xl font-bold text-center mb-8">Integral And Advance Polling and Data Collection Form System</h1>
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
                    <option value="'Roboto', sans-serif">Roboto</option>
                    <option value="'Open Sans', sans-serif">Open Sans</option>
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
            <!-- Product Feedback Survey Template -->
            <div id="form-container" class="bg-white text-gray-800 p-6 rounded-lg shadow-lg w-full max-w-2xl">
                <h2 class="text-xl font-bold mb-4">Product Feedback Survey</h2>
                <form onsubmit="handleSubmit(event)">
                    <div class="mb-4">
                        <label class="block text-gray-700">Full Name:</label>
                        <input type="text" name="full-name" class="w-full p-2 border border-gray-300 rounded" placeholder="Enter full name">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Email:</label>
                        <input type="email" name="email" class="w-full p-2 border border-gray-300 rounded" placeholder="Enter email">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Phone Number:</label>
                        <input type="tel" name="phone-number" class="w-full p-2 border border-gray-300 rounded" placeholder="Enter phone number">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Product Name:</label>
                        <input type="text" name="product-name" class="w-full p-2 border border-gray-300 rounded" placeholder="Enter product name">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">How satisfied are you with the product?</label>
                        <select name="satisfaction" class="w-full p-2 border border-gray-300 rounded">
                            <option value="">Select satisfaction level</option>
                            <option value="very_satisfied">Very Satisfied</option>
                            <option value="satisfied">Satisfied</option>
                            <option value="neutral">Neutral</option>
                            <option value="dissatisfied">Dissatisfied</option>
                            <option value="very_dissatisfied">Very Dissatisfied</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">How likely are you to recommend this product to others?</label>
                        <select name="recommend" class="w-full p-2 border border-gray-300 rounded">
                            <option value="">Select likelihood</option>
                            <option value="very_likely">Very Likely</option>
                            <option value="likely">Likely</option>
                            <option value="neutral">Neutral</option>
                            <option value="unlikely">Unlikely</option>
                            <option value="very_unlikely">Very Unlikely</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">What did you like most about the product?</label>
                        <textarea name="like-most" class="w-full p-2 border border-gray-300 rounded" placeholder="Enter your feedback"></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">What did you dislike about the product?</label>
                        <textarea name="dislike-most" class="w-full p-2 border border-gray-300 rounded" placeholder="Enter your feedback"></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Any additional comments or suggestions?</label>
                        <textarea name="comments-suggestions" class="w-full p-2 border border-gray-300 rounded" placeholder="Enter your comments or suggestions"></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Rate the overall experience:</label>
                        <div class="flex space-x-2">
                            <label class="flex items-center">
                                <input type="radio" name="experience" value="1" class="mr-2"> 1
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="experience" value="2" class="mr-2"> 2
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="experience" value="3" class="mr-2"> 3
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="experience" value="4" class="mr-2"> 4
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="experience" value="5" class="mr-2"> 5
                            </label>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Would you like to be contacted for further feedback?</label>
                        <div class="flex space-x-2">
                            <label class="flex items-center">
                                <input type="radio" name="contact" value="yes" class="mr-2"> Yes
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="contact" value="no" class="mr-2"> No
                            </label>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Upload a photo of the product (optional):</label>
                        <input type="file" name="product-photo" class="w-full p-2 border border-gray-300 rounded">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Rate the product quality:</label>
                        <div class="flex space-x-2">
                            <label class="flex items-center">
                                <input type="radio" name="quality" value="1" class="mr-2"> 1
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="quality" value="2" class="mr-2"> 2
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="quality" value="3" class="mr-2"> 3
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="quality" value="4" class="mr-2"> 4
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="quality" value="5" class="mr-2"> 5
                            </label>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Rate the value for money:</label>
                        <div class="flex space-x-2">
                            <label class="flex items-center">
                                <input type="radio" name="value" value="1" class="mr-2"> 1
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="value" value="2" class="mr-2"> 2
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="value" value="3" class="mr-2"> 3
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="value" value="4" class="mr-2"> 4
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="value" value="5" class="mr-2"> 5
                            </label>
                        </div>
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