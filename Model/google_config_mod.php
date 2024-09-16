<?php
session_start(); // Start the session

require_once __DIR__ . '/../vendor/autoload.php'; // Adjust the path if necessary

function getGoogleClient() {
    $client = new Google_Client();
    $client->setClientId('915464357645-fsds8ghcck57vctdcgphsmkne41ioi5c.apps.googleusercontent.com');
    $client->setClientSecret('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');
    $client->setRedirectUri('http://localhost/argaochurch1/Controller/insert_event.php'); // Your redirect URI
    $client->addScope(Google_Service_Calendar::CALENDAR);
    $client->setAccessType('offline'); // Enables refresh tokens
    $client->setIncludeGrantedScopes(true); // Allows incremental authorization

    // Check if we need to re-authenticate with a different Google account
    if (isset($_GET['reauth']) && $_GET['reauth'] === 'true') {
        unset($_SESSION['access_token']);
        unset($_SESSION['refresh_token']);
    }

    // Load token from session or database
    if (isset($_SESSION['refresh_token'])) {
        $client->fetchAccessTokenWithRefreshToken($_SESSION['refresh_token']);
    } elseif (isset($_SESSION['access_token'])) {
        $client->setAccessToken($_SESSION['access_token']);
    }

    // If the access token is expired, try to refresh it
    if ($client->isAccessTokenExpired()) {
        if ($client->getRefreshToken()) {
            $newToken = $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
            $_SESSION['access_token'] = $newToken;
            $_SESSION['refresh_token'] = $client->getRefreshToken(); // Store the refresh token
        } else {
            // If no refresh token is available, redirect for authentication
            unset($_SESSION['access_token']);
            header('Location: google_auth.php');
            exit();
        }
    }

    return $client;
}
?>