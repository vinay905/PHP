<?php
if(isset($_POST['patientCase']))
{
    $apiUrl = 'http://127.0.0.1:5000/summarize';
    $postData = json_encode(['patientCase' => $_POST['patientCase']]);

    $ch = curl_init($apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Content-Length: ' . strlen($postData)
    ]);

    $response = curl_exec($ch);

    if ($response === false) {
        echo 'Error: Failed to connect to the API';
    } else {
        $responseData = json_decode($response, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            echo 'Error: Invalid JSON response';
        } else {
            if (isset($responseData['summary'])) {
                // echo $responseData;
            } else {
                echo 'Error: Invalid response format - "summary" key not found';
            }
        }
    }
    curl_close($ch);
}
else 
    echo 'Empty data';
?>
