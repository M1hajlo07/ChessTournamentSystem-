<?php
$errors = [];

/**
 * Add an error message to the errors array
 */
function add_error(string $msg) {
    global $errors;
    $errors[] = $msg;
}

/**
 * Display all accumulated errors
 */
function display_errors() {
    global $errors;
    if (!empty($errors)) {
        echo '<div class="error-box">';
        foreach ($errors as $err) {
            echo '<p>' . htmlspecialchars($err) . '</p>';
        }
        echo '</div>';
    }
}

/**
 * Display a single fatal error and exit
 */
function display_error(string $message) {
    echo '<div class="error-box fatal">';
    echo '<h2>Error</h2>';
    echo '<p>' . htmlspecialchars($message) . '</p>';
    echo '<a href="javascript:history.back()" class="back-link">Go Back</a>';
    echo '</div>';
    exit;
}

/**
 * Turn text into a URL-friendly slug
 */
function slugify(string $text): string {
    $text = iconv('UTF-8', 'ASCII//TRANSLIT', $text);
    $text = str_replace(["'", "`", "’", "–", "—", "-"], ' ', $text);
    $text = strtolower($text);
    $text = preg_replace('/[^a-z0-9]+/', '_', $text);
    return trim($text, '_');
}
?>
