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

if (!function_exists('cleanNumber')) {
    function cleanNumber($data)
    {
        if (is_array($data)) {
            return array_map('cleanNumber', $data);
        }

        $cleanedData = trim($data);
        $cleanedData = htmlspecialchars($cleanedData, ENT_QUOTES, 'UTF-8');
        $cleanedData = stripslashes($cleanedData);
        $cleanedData = preg_replace('/[^0-9.,]/', '', $cleanedData);
        $cleanedData = str_replace(',', '.', $cleanedData);
        $cleanedData = preg_replace('/\.(?=.*\.)/', '', $cleanedData);
        $cleanedData = intval($cleanedData);
        return $cleanedData;
    }
}

if (!function_exists('formatNumber')) {
    function formatNumber($input) {
        $roundedNumber = round(floatval($input), 3);
        $parts = explode(".", strval($roundedNumber));
        $parts[0] = preg_replace('/\B(?=(\d{3})+(?!\d))/', ' ', $parts[0]);
        return isset($parts[1]) ? implode(".", $parts) : $parts[0];
    }    
}
