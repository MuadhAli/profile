<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and retrieve form data
    $clientName = filter_input(INPUT_POST, 'client-name', FILTER_SANITIZE_STRING);
    $companyName = filter_input(INPUT_POST, 'company-name', FILTER_SANITIZE_STRING);
    $clientEmail = filter_input(INPUT_POST, 'client-email', FILTER_SANITIZE_EMAIL);
    $clientPhone = filter_input(INPUT_POST, 'client-phone', FILTER_SANITIZE_STRING);
    $serviceType = filter_input(INPUT_POST, 'service-type', FILTER_SANITIZE_STRING);
    $timeline = filter_input(INPUT_POST, 'timeline', FILTER_SANITIZE_STRING);
    $budget = filter_input(INPUT_POST, 'budget', FILTER_SANITIZE_STRING);
    $hosting = filter_input(INPUT_POST, 'hosting', FILTER_SANITIZE_STRING);
    $support = filter_input(INPUT_POST, 'support', FILTER_SANITIZE_STRING);
    $techStack = filter_input(INPUT_POST, 'tech-stack', FILTER_SANITIZE_STRING);
    $contactMethod = filter_input(INPUT_POST, 'contact-method', FILTER_SANITIZE_STRING);

    // Validate required fields
    if (empty($clientName) || empty($companyName) || empty($clientEmail) || empty($clientPhone) || empty($serviceType) || empty($timeline) || empty($budget) || empty($hosting) || empty($support) || empty($techStack) || empty($contactMethod)) {
        echo "Error: All fields are required.";
        exit;
    }

    // Construct email subject and message
    $subject = "New Quote Request from Website";
    $emailMessage = "Dear Team,\n\n";
    $emailMessage .= "A new quote request has been received from the website. Here are the details:\n\n";
    $emailMessage .= "Client Name: $clientName\n";
    $emailMessage .= "Company Name: $companyName\n";
    $emailMessage .= "Email: $clientEmail\n";
    $emailMessage .= "Phone Number: $clientPhone\n";
    $emailMessage .= "Service Type: $serviceType\n";
    $emailMessage .= "Project Completion Timeline: $timeline\n";
    $emailMessage .= "Estimated Budget: $budget\n";
    $emailMessage .= "Hosting Requirement: $hosting\n";
    $emailMessage .= "Support & Maintenance: $support\n";
    $emailMessage .= "Preferred Technology Stack: $techStack\n";
    $emailMessage .= "Preferred Contact Method: $contactMethod\n\n";
    $emailMessage .= "Kind regards,\n";
    $emailMessage .= "$clientName";

    // Set email headers
    $headers = "From: no-reply@intelexsolutions.in\r\n"; // Replace with your domain email
    $headers .= "Reply-To: $clientEmail\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    $to = "mkhanmanzil@gmail.com";

    // Send email
    $mailSuccess = mail($to, $subject, $emailMessage, $headers);

    if ($mailSuccess) {
        echo '<script>alert("Thank you for your request. We will get back to you as soon as possible.");</script>';
        echo '<script>
                setTimeout(function(){
                    window.location.href = "contactus.html";
                }, 3000);
              </script>';
    } else {
        echo "Error sending email. Please try again later.";
    }
} else {
    echo "Invalid request method.";
}
?>