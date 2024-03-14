<?php
if (isset($_POST['fund'])) {
    $account_number = $_POST['account_number'];
    $amount = $_POST['amount'];
    $accountBalance = $_POST['acct_balance'];
    $currency = $_POST['currency'];
    $date = date('Y-m-d');
   

    $userid = $_POST['userid'];
    $userDataQuery = $conn->query("SELECT * FROM users WHERE userid='$userid'");

    if ($userDataQuery->num_rows > 0) {
        while ($row = $userDataQuery->fetch_assoc()) {
            $present_balance = $row['main_balance'];

            if ($accountBalance === "Main Balance") {
                $new_Mainbalance = $present_balance + $amount;
                $conn->query("UPDATE `users` SET main_balance='$new_Mainbalance' WHERE userid='$userid' AND account_number='$account_number'");
            } else {
                if ($present_balance >= $amount) {
                    $new_Mainbalance = $present_balance - $amount;
                    $new_Overdraftbalance = $row['overdraft_balance'] + $amount;
                    $conn->query("UPDATE `users` SET main_balance='$new_Mainbalance', overdraft_balance='$new_Overdraftbalance' WHERE userid='$userid' AND account_number='$account_number'");
                } else {
                    // Handle insufficient main balance error
                    $transactionErr = "<div class='alert bg-danger' role='alert'>
                        <div class='iq-alert-text'> Insufficient main balance to cover the overdraft.</div>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <i class='ri-close-line'></i>
                        </button>
                    </div>";
                    // You might want to exit or redirect here, depending on your use case.
                }
            }
            $newBalance = $row['main_balance'];
            $to = '';
            $subject = "Fund account";
        
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
                  text-align:center ;
                 
                } 
                footer{
                    max-width: 500px;
                  margin: 0 auto;
                  padding: 20px;
                  text-align:center ;
                 
                }
              </style>
            </head>
            <body>
              <div class='container'>
                <div class='' style=''>
                <img src='./images/loader.gif' alt='Bancorp logo' style='height: fit-content; width: 60%'>
            </div>
            <p>$currency$amount has been deposited in our wallet.
                Your new balance is $currency$newBalance.
            </p>
              </div>
              <footer>@2024 Bancorp, All Rights Reserved </footer>
            </body>
            </html>
            ";
        
            $headers .= "From: bancorp.org" . "\r\n";
            // If the database ot were successful, send the email
            if ($conn->affected_rows > 0) {
                if (mail($to, $subject, $message, $headers)) {
                    $transactionErr = "
                    <div class='alert bg-success' role='alert'>
                    <div class='iq-alert-text'> Funds sent successfully.</div>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <i class='ri-close-line'></i>
                    </button>
                </div>";
                } else {
                    // Handle email sending failure
                    $transactionErr = "<div class='alert bg-danger' role='alert'>
                        <div class='iq-alert-text'> Failed to send your message.</div>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <i class='ri-close-line'></i>
                        </button>
                    </div>";
                }
            } else {
                // Handle database update failure
                $transactionErr = "<div class='alert bg-danger' role='alert'>
                    <div class='iq-alert-text'> Failed to Fund User.</div>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <i class='ri-close-line'></i>
                    </button>
                </div>";
            }
        }
    } else {
        // Handle user not found
        $transactionErr = "<div class='alert bg-danger' role='alert'>
            <div class='iq-alert-text'> User not found.</div>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <i class='ri-close-line'></i>
            </button>
        </div>";
    }
}

