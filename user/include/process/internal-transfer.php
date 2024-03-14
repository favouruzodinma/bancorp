<?php
// Include your database connection file (replace YOUR_DB_CONNECTION_DETAILS)
require_once("../../../_db.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get user input
    Global $conn;
    $userId = $_POST['userid'];
    $senderBalance = floatval($_POST['wallet_balance']);
    $accountNumber = $_POST['account_number'];
    $amount = floatval($_POST['amount']);
    $transaction_pin = $_POST['pin1'] . $_POST['pin2'] . $_POST['pin3'] . $_POST['pin4'];

    // Validate the transaction pin
    if (!isValidTransactionPin($transaction_pin, $userId, $conn)) {
        handleTransferError("Invalid transaction pin");
    }

    // Perform the internal transfer
    $result = performInternalTransfer($userId, $senderBalance, $accountNumber, $amount);

    if ($result === true) {
        header('Location: ../../internal_transfer.php?status=success&message=Internal transfer successful');
        exit;
    } else {
        handleTransferError("$result");
    }

    // Close the database connection (you may want to do this after the if-else block)
    $conn->close();
}

// Function to validate transaction pin
function isValidTransactionPin($transactionPin, $userId, $conn) {
    // Implement your validation logic
    $stmt = $conn->prepare("SELECT userid FROM users WHERE transaction_pin = ?");
    $stmt->bind_param("s", $transactionPin);
    
    if (!$stmt->execute()) {
        handleTransferError("Error executing validation statement: " . $stmt->error);
    }

    $stmt->store_result();
    $foundUserId = $userId;

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($foundUserId);
        $stmt->fetch();
        $stmt->close();

        // Check if the transaction pin belongs to the logged-in user
        return $foundUserId === $userId;
    }

    return false;
}

// Function to perform the internal transfer
function performInternalTransfer($userId, $senderBalance, $accountNumber, $amount) {
    GLOBAL $conn;

    // Example SQL queries (modify as needed)
    $getReceiverBalanceQuery = $conn->prepare("SELECT main_balance FROM users WHERE account_number = ?");
    $getReceiverBalanceQuery->bind_param("s", $accountNumber);

    if (!$getReceiverBalanceQuery->execute()) {
        return "Error executing getReceiverBalanceQuery: " . $getReceiverBalanceQuery->error;
    }

    $getReceiverBalanceQuery->bind_result($receiverBalance);

    if (!$getReceiverBalanceQuery->fetch()) {
        $getReceiverBalanceQuery->close();
        return "Error fetching getReceiverBalanceQuery result: " . $getReceiverBalanceQuery->error;
    }

    $getReceiverBalanceQuery->close();

    // Check if the sender has sufficient balance
    if ($amount > $senderBalance) {
        return "Insufficient balance";
    } else {
        // Add the amount to the receiver's balance
        $newReceiverBalance = $receiverBalance + $amount;

        // Update the receiver's balance
        $updateReceiverBalanceQuery = $conn->prepare("UPDATE users SET main_balance = ? WHERE account_number = ?");
        $updateReceiverBalanceQuery->bind_param("ds", $newReceiverBalance, $accountNumber);

        if (!$updateReceiverBalanceQuery->execute()) {
            $updateReceiverBalanceQuery->close();
            return "Error executing updateReceiverBalanceQuery: " . $updateReceiverBalanceQuery->error;
        }

        $updateReceiverBalanceQuery->close();

        // Subtract the amount from the sender's balance
        $newSenderBalance = $senderBalance - $amount;

        // Update the sender's balance
        $updateSenderBalanceQuery = $conn->prepare("UPDATE users SET main_balance = ? WHERE userid = ?");
        $updateSenderBalanceQuery->bind_param("ds", $newSenderBalance, $userId);

        if (!$updateSenderBalanceQuery->execute()) {
            $updateSenderBalanceQuery->close();
            return "Error executing updateSenderBalanceQuery: " . $updateSenderBalanceQuery->error;
        }

        $updateSenderBalanceQuery->close();

        return true;
    }
}

// Function to handle transfer errors
function handleTransferError($errorMessage) {
    header("Location: ../../internal_transfer.php?status=error&message=$errorMessage");
    exit;
}

?>
