<?php include 'php/session_check.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance</title>
        <link rel="stylesheet" href="{{ asset('css/attendance.css') }}">
</head>

<body>
    <script src="{{ asset('js/naavbar.js') }}"></script> 
    <nav-bar></nav-bar>

    <div class="students">
        <div class="students">
            <form id="exportForm">
                <h1>Attendance</h1>

                <!-- Date Picker -->
                <input type="date" name="date" id="date" required>

                <div class="side-by-side">

                    <!-- ✅ Dropdown for Subjects (Loaded from the subject table) -->
                    <select id="subject" name="subject" required>
                        <option value="">Select Subject</option>
                    </select>

                    <!-- ✅ Dropdown for Classes (Loaded from the class_ table) -->
                    <select id="classDropdown" name="class_name" required>
                        <option value="">Select Class</option>
                    </select>
                </div>

                <div id="studentTable"></div>

                <script>
                    // ✅ Load subjects from the database
                    function loadSubjects() {
                        fetch('php/fetch_subjects.php')
                            .then(response => response.json())
                            .then(subjects => {
                                const subjectDropdown = document.getElementById('subject');
                                subjectDropdown.innerHTML = `<option value="">Select Subject</option>`;

                                subjects.forEach(subject => {
                                    const option = document.createElement('option');
                                    option.value = subject.code.toLowerCase();  // Use lowercase for table matching
                                    option.textContent = `${subject.name} (${subject.code})`;
                                    subjectDropdown.appendChild(option);
                                });
                            })
                            .catch(error => console.error('Error loading subjects:', error));
                    }

                    // ✅ Load classes from the database
                    function loadClasses() {
                        fetch('php/fetch_classes.php')
                            .then(response => response.json())
                            .then(classes => {
                                const dropdown = document.getElementById('classDropdown');
                                dropdown.innerHTML = `<option value="">Select Class</option>`;

                                classes.forEach(className => {
                                    const option = document.createElement('option');
                                    option.value = className;
                                    option.textContent = className;
                                    dropdown.appendChild(option);
                                });
                            })
                            .catch(error => console.error('Error loading classes:', error));
                    }

                    // ✅ Fetch students based on the selected class
                    document.getElementById('classDropdown').addEventListener('change', () => {
                        const className = document.getElementById('classDropdown').value;

                        if (!className) {
                            document.getElementById('studentTable').innerHTML = '';
                            return;
                        }

                        fetch(`php/fetch_students_by_class.php?class_name=${className}`)
                            .then(response => response.json())
                            .then(students => {
                                const tableContainer = document.getElementById('studentTable');
                                tableContainer.innerHTML = '';

                                if (students.error) {
                                    tableContainer.innerHTML = `<p>Error: ${students.error}</p>`;
                                    return;
                                }

                                let table = `<table border="1" cellpadding="10">
                                    <thead>
                                        <tr>
                                            <th>Roll No</th>
                                            <th>PRN No</th>
                                            <th>Full Name</th>
                                            <th>Present</th>
                                        </tr>
                                    </thead>
                                    <tbody>`;

                                students.forEach(student => {
                                    table += `
                                        <tr>
                                            <td>${student.roll_no}</td>
                                            <td>${student.prn_no}</td>
                                            <td>${student.full_name}</td>
                                            <td>
                                                <input type="checkbox" name="attendance[]" data-rollno="${student.roll_no}">
                                            </td>
                                        </tr>`;
                                });

                                table += `</tbody></table>`;
                                tableContainer.innerHTML = table;
                            })
                            .catch(error => console.error('Error loading students:', error));
                    });

                    // ✅ Handle Save and Export actions with AJAX
                    document.getElementById('exportForm').addEventListener('submit', (event) => {
                        event.preventDefault();  // Prevent page reload

                        const formData = new FormData();
                        formData.append('date', document.querySelector('#date').value);

                        // ✅ Extract selected subject and class
                        const subjectDropdown = document.querySelector('#subject');
                        const selectedSubject = subjectDropdown.value.toLowerCase();  // Lowercase for table naming
                        formData.append('subject', selectedSubject);

                        formData.append('class_name', document.querySelector('#classDropdown').value);

                        // Collect attendance data
                        const checkboxes = document.querySelectorAll('input[type="checkbox"]');
                        let attendanceData = [];

                        checkboxes.forEach((checkbox) => {
                            const rollNo = checkbox.getAttribute('data-rollno');
                            const status = checkbox.checked ? 'present' : 'absent';
                            attendanceData.push(`${rollNo}-${status}`);
                        });

                        console.log('Attendance Data:', attendanceData);  // Debugging log

                        formData.append('attendance', attendanceData.join(','));  // Add attendance data

                        const action = event.submitter.value.toLowerCase();  // Determine button clicked (save or export)

                        if (action === 'save') {
                            fetch('php/save_attendance.php', {
                                method: 'POST',
                                body: formData
                            })
                                .then(response => response.json())
                                .then(data => {
                                    alert(data.success ? `✅ ${data.success}` : `❌ ${data.error}`);
                                })
                                .catch(error => console.error('Error:', error));
                        } else if (action === 'export') {
                            const exportUrl = `php/export.php?date=${formData.get('date')}&subject=${formData.get('subject')}&class_name=${formData.get('class_name')}&attendance=${attendanceData.join(',')}`;
                            window.open(exportUrl, '_blank');  // Open export in new tab
                        }
                    });

                    // ✅ Load subjects and classes on page load
                    loadSubjects();
                    loadClasses();
                </script>

                <input type="submit" name="action" value="Export">
                <input type="submit" name="action" value="Save">
            </form>
        </div>
    </div>

    <fixed-button></fixed-button>
    <import-button></import-button>
</body>
<!-- <foot-ter></foot-ter> -->
<script src="{{ asset('js/footer.js') }}"></script> 
<script src="{{ asset('js/add_button.js') }}"></script> 
</html>
