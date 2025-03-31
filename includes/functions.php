<?php
// includes/functions.php

function getSupabaseData($table, $select = '*', $filter = '') {
  $url = SUPABASE_URL . "/rest/v1/$table?select=$select";
  if ($filter) $url .= "&$filter";
  
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'apikey: ' . SUPABASE_KEY,
    'Authorization: Bearer ' . SUPABASE_KEY
  ]);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  
  $response = curl_exec($ch);
  curl_close($ch);
  
  return json_decode($response, true);
}

// Exemplo de uso no PHP:
// $transactions = getSupabaseData('transaction', '*', 'order=date.desc');
?>
