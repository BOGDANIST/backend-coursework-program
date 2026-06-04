<?php
declare(strict_types=1);

// Test type strings to ensure they match field counts

echo "=== Type String Verification ===\n\n";

// CREATE statement: 32 fields
$createFields = [
    's_group', 's_pr', 's_im', 's_bat', 's_stat', 's_contract', 's_dnar', 's_vik',
    's_adresa', 's_tels', 's_telb', 's_telm', 's_osvita_type', 's_rik_zaver',
    's_region_type', 's_region', 's_galuz', 's_spec', 's_specz', 's_sirota',
    's_peresel', 's_inval', 's_malozab', 's_war_act', 's_chernob', 's_ato',
    's_ditzag', 's_rada', 's_shahter', 's_vip', 's_cours', 's_form_navch'
];

$intFields = ['s_vik', 's_cours', 's_id'];

$createTypes = '';
foreach ($createFields as $field) {
    $createTypes .= in_array($field, $intFields, true) ? 'i' : 's';
}

echo "CREATE Type String:\n";
echo "Expected length: " . count($createFields) . "\n";
echo "Actual length: " . strlen($createTypes) . "\n";
echo "Type string: $createTypes\n";
echo "Status: " . (strlen($createTypes) === 32 ? "✓ PASS" : "✗ FAIL") . "\n\n";

// UPDATE statement: 32 SET fields + 1 WHERE id
$updateFields = $createFields;
$updateFields[] = 's_id'; // Add WHERE clause parameter

$updateTypes = '';
foreach ($updateFields as $field) {
    $updateTypes .= in_array($field, $intFields, true) ? 'i' : 's';
}

echo "UPDATE Type String:\n";
echo "Expected length: " . count($updateFields) . "\n";
echo "Actual length: " . strlen($updateTypes) . "\n";
echo "Type string: $updateTypes\n";
echo "Status: " . (strlen($updateTypes) === 33 ? "✓ PASS" : "✗ FAIL") . "\n\n";

echo "=== Verification Complete ===\n";
?>
