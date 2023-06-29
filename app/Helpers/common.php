<?php

if (!function_exists('cleanInput')) {
    function cleanInput($data)
    {
        if (is_array($data)) {
            return array_map('cleanInput', $data);
        }

        $cleanedData = trim($data);
        $cleanedData = htmlspecialchars($cleanedData, ENT_QUOTES, 'UTF-8');
        $cleanedData = stripslashes($cleanedData);

        // Apply additional security rules using regex
        // $cleanedData = preg_replace('/[^a-zA-Z0-9@._-]/', '', $cleanedData);

        return $cleanedData;
    }
}
