<?php
$valid_password = "teacher123"; // Change this to your secure password

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $grade = htmlspecialchars($_POST['grade']);
    $password = $_POST['password'];

    if ($password !== $valid_password) {
        echo "<h3>Invalid password!</h3><a href='teacher_login.html'>Back</a>";
        exit();
    }

    $file = 'leave_data.json';
    if (!file_exists($file)) {
        echo "<h3>No leave requests found.</h3>";
        exit();
    }

    $data = json_decode(file_get_contents($file), true);

    echo "<h2>Leave Requests for Grade: $grade</h2>";
    $found = false;
    foreach ($data as $index => $req) {
        if ($req['grade'] === $grade) {
            $found = true;
            echo "<div class='request'>";
            echo "<strong>Name:</strong> " . $req['name'] . "<br />";
            echo "<strong>Reason:</strong> " . $req['reason'] . "<br />";
            echo "<strong>Status:</strong> " . $req['status'] . "<br />";
            if ($req['status'] === 'Pending') {
                echo "<form action='approve_request.php' method='POST'>
                        <input type='hidden' name='index' value='$index' />
                        <button type='submit'>Approve</button>
                      </form>";
            }
            echo "</div>";
        }
    }
    if (!$found) {
        echo "<p>No leave requests for this grade.</p>";
    }
    echo "<a href='index.html'>Back to Home</a>";
} else {
    echo "<h3>Invalid request method!</h3>";
}
?>
