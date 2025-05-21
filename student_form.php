<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $grade = htmlspecialchars($_POST['grade']);
    $reason = htmlspecialchars($_POST['reason']);

    $leave = [
        'name' => $name,
        'grade' => $grade,
        'reason' => $reason,
        'status' => 'Pending'
    ];

    $file = 'leave_data.json';
    $data = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
    $data[] = $leave;

    file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

    echo "<h3>Your leave application has been successfully submitted!</h3><a href='index.html'>Back to Home</a>";
} else {
    echo "Submission error!";
}
?>
