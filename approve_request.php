<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $index = (int) $_POST['index'];
    $file = 'leave_data.json';

    if (!file_exists($file)) {
        echo "<h3>No data file found!</h3>";
        exit();
    }

    $data = json_decode(file_get_contents($file), true);

    if (!isset($data[$index])) {
        echo "<h3>Request not found!</h3>";
        exit();
    }

    $data[$index]['status'] = 'Approved';
    file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

    echo "<h3>Request approved successfully!</h3>";
    echo "<a href='index.html'>Back to Home</a>";
} else {
    echo "<h3>Invalid access method!</h3>";
}
?>
