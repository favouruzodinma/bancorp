<?php
include_once('config.php');

$status = $_GET['status'];
$loanid = $_GET['id'];

if ($status == 'pending') {
    // Update kyc_status to 'active' in the database
    $updateSql = $conn->query("UPDATE loans SET status='approved' WHERE loanid='$loanid' ");
   
    // Check if the update was successful
    if ($updateSql == true) {
        // Retrieve loan details after the update
        $selectSql = $conn->query("SELECT * FROM loans WHERE loanid='$loanid'");

        // Check if loan details are found
        if ($selectSql->num_rows > 0) {
            while ($row = $selectSql->fetch_assoc()) {
                $userName = $row['user_name'];
                $amount =  $row['loan_amount'];
                $account_type = $row['account_type'];
                $email = $row['user_email'];
            }

            // Send email verification
            $to = $email;
            $subject = "Approved Loan Request";

            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

            $message = "
            <html>
            <head>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        background-color: #f4f4f4;
                        color: #333;
                    }

                    .container {
                        max-width: 400px;
                        margin: 0 auto;
                        padding: 20px;
                        background-color: #fff;
                        border-radius: 5px;
                        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                        text-align:center;
                    } 

                    footer {
                        max-width: 500px;
                        margin: 0 auto;
                        padding: 20px;
                        text-align:center;
                    }
                </style>
            </head>
            <body>
                <div class='container'>
                    <div class='' style=''>
                        <img src='./images/loader.gif' alt='Bancorp logo' style='height: fit-content; width: 60%'>
                    </div>
                    <p>Dear $userName, your request for a loan amount of $aamount has been approved and your sent to your $account_type account .</p>
                </div>
                <footer>@2024 Bancorp, All Rights Reserved </footer>
            </body>
            </html>
            ";

            $headers .= "From: bancorp.org" . "\r\n";

            // Check if the email is sent successfully
            if (mail($to, $subject, $message, $headers)) {
                $verificationErr = "
                <div class='alert bg-success' role='alert'>
                    <div class='iq-alert-text'> $userName's kyc has been verified.</div>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <i class='ri-close-line'></i>
                    </button>
                </div>";
            } else {
                // Handle email sending failure
                $verificationErr = "
                <div class='alert bg-danger' role='alert'>
                    <div class='iq-alert-text'>Failed to send verification email.</div>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <i class='ri-close-line'></i>
                    </button>
                </div>";
            }
        }
    }
}

// Redirect to the manage-kyc page
header("location: manage-kyc");

