<?php
$backendUrl = "https://policeqr.000webhostapp.com/fetch_feedback.php"; // Replace with your actual 000webhost domain

// Forward GET parameters if any
if ($_SERVER['QUERY_STRING']) {
    $backendUrl .= '?' . $_SERVER['QUERY_STRING'];
}

// Use cURL to forward the request and get the response
$ch = curl_init($backendUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

// Set the content type to JSON and return the response from the backend
header('Content-Type: application/json', true, $httpCode);
echo $response;
?>
