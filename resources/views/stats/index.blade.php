<?php include 'php/session_check.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Stats</title>
        <link rel="stylesheet" href="{{ asset('css/stats.css') }}">
</head>

<body>

    <nav-bar></nav-bar>

    <div class="section">
        <h2>Subject-wise Attendance</h2>
        <img src="charts/subject_attendance.png?<?= time() ?>" alt="Subject Attendance Graph">
    </div>

    <div class="section">
        <h2>Student-wise Attendance Percentage</h2>
        <table id="student-table">
            <thead>
                <tr>
                    <th>Roll No</th>
                    <th>Attendance %</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>

</body>
<foot-ter></foot-ter>

<script src="{{ asset('js/navbar.js') }}"></script> 
<script src="{{ asset('js/footer.js') }}"></script> 

<script>
    fetch('php/stats_loader.php')
        .then(() => fetch('php/get_student_attendance.php'))
        .then(response => response.json())
        .then(data => {
            const tbody = document.querySelector("#student-table tbody");
            data.forEach(student => {
                const row = `<tr><td>${student.roll_no}</td><td>${student.percentage}%</td></tr>`;
                tbody.innerHTML += row;
            });
        });
</script>

</html>
