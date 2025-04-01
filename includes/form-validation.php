<?php

function validateFormData($data) {
    
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function validateEmail($email) {
    
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}
?>
