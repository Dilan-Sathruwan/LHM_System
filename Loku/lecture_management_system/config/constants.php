<?php
// Define constants for database connection
define('DB_HOST', 'localhost');        // Database host (usually localhost)
define('DB_USER', 'root');             // Database username
define('DB_PASSWORD', '');             // Database password
define('DB_NAME', 'lecture_management_system'); // Database name

// Define base URL for your project (useful for links and assets)
define('BASE_URL', 'http://localhost/lecture_management_system/');

// Define other project-related constants
define('PROJECT_NAME', 'Lecture Management System');

// Define directory paths
define('ASSETS_PATH', BASE_URL . 'assets/'); // Path to assets (CSS, JS, Images)
define('INCLUDES_PATH', BASE_URL . 'includes/'); // Path to includes like header, footer, etc.

// Set default timezone (optional)
date_default_timezone_set('Your/Timezone'); // Example: 'America/New_York'

// Other constants
define('MAX_LOGIN_ATTEMPTS', 5); // Maximum login attempts before blocking the user
define('SESSION_TIMEOUT', 3600); // Session timeout in seconds (1 hour)

?>
