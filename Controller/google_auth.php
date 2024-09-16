<?php

require_once __DIR__ . '/../Model/google_config_mod.php'; // Include Google Client configuration

$client = getGoogleClient();

if (isset($_GET['code'])) {
    // Exchange the authorization code for an access token
    $accessToken = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $_SESSION['access_token'] = $accessToken;
    $_SESSION['refresh_token'] = $client->getRefreshToken(); // Store refresh token
    header('Location: /path/to/your/next/page.php'); // Redirect after successful authentication
    exit();
}

// Check if the user is already authenticated
if (!isset($_SESSION['access_token'])) {
    // Redirect to Google OAuth for authentication
    $authUrl = $client->createAuthUrl();
    header('Location: ' . filter_var($authUrl, FILTER_SANITIZE_URL));
    exit();
} else {
    // Set the access token if already authenticated
    $client->setAccessToken($_SESSION['access_token']);
}
?>