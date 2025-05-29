<?php
$dataFile = 'data.json';

// Image Upload
if (isset($_FILES['image'])) {
    $imageName = time() . '_' . $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/' . $imageName);
}

// New Data
$newEntry = [
    'image' => 'uploads/' . $imageName,
    'heading' => $_POST['heading'],
    'details' => $_POST['details'],
    'date' => $_POST['date'],
    'link' => $_POST['link']
];

// Read old data
if (file_exists($dataFile)) {
    $oldData = json_decode(file_get_contents($dataFile), true);
} else {
    $oldData = [];
}

// Add new entry
$oldData[] = $newEntry;

// Save back to file
file_put_contents($dataFile, json_encode($oldData, JSON_PRETTY_PRINT));
