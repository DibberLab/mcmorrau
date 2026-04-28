<?php

// 1. Setup your SendGrid credentials and email details
$apiKey = SENDGRID_API_KEY; // Replace with your NEW key
$fromEmail = 'andrew@dibberlab.me'; // Must be verified in SendGrid
$toEmail = 'amcmorrow84@proton.me';
$subject = 'Test Email from SendGrid PHP';
$messageBody = 'This is a test email sent using PHP and cURL.';

// 2. Prepare the data payload (JSON)
$data = [
    'personalizations' => [
        [
            'to' => [
                ['email' => $toEmail]
            ]
        ]
    ],
    'from' => ['email' => $fromEmail],
    'subject' => $subject,
    'content' => [
        [
            'type' => 'text/plain',
            'value' => $messageBody
        ]
    ]
];

// 3. Initialize cURL
$ch = curl_init();

// 4. Configure cURL options
curl_setopt($ch, CURLOPT_URL, 'https://api.sendgrid.com/v3/mail/send');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer ' . $apiKey,
    'Content-Type: application/json'
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// 5. Execute and check response
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

// 6. Output result
if ($httpCode == 202) {
    echo "Success! Email sent.";
} else {
    echo "Failed. HTTP Code: " . $httpCode . "\n";
    echo "Response: " . $response;
}
?>