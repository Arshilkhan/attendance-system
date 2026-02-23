@extends('layouts.app')
@section('content')

    <link rel="stylesheet" href="{{ asset('css/attendance.css') }}">

    <div class="students">
        <form id="attendanceForm">
            <h1>Attendance</h1>

            <input type="date" id="date" required>

            <div class="side-by-side">
                <select id="subject" required>
                    <option value="">Select Subject</option>
                </select>

                <select id="classDropdown" required>
                    <option value="">Select Class</option>
                </select>
            </div>

            <div id="studentTable"></div>

            <button type="button" onclick="saveAttendance()">Save</button>
            <button type="button" onclick="exportAttendance()">Export</button>
        </form>
    </div>

    <script>

        const baseUrl = "{{ url('/') }}";
        function loadSubjects() {
            fetch(`${baseUrl}/api/subjects`)
                .then(res => res.json())
                .then(subjects => {
                    const dropdown = document.getElementById('subject');
                    dropdown.innerHTML = '<option value="">Select Subject</option>';

                    subjects.forEach(sub => {
                        dropdown.innerHTML += `<option value="${sub.subject_code}">
                        ${sub.subject_name} (${sub.subject_code})
                    </option>`;
                    });
                });
        }

        function loadClasses() {
            fetch('/api/classes')
                .then(res => res.json())
                .then(classes => {
                    const dropdown = document.getElementById('classDropdown');
                    dropdown.innerHTML = '<option value="">Select Class</option>';

                    classes.forEach(cls => {
                        dropdown.innerHTML +=
                            `<option value="${cls.class_id}">
                            ${cls.class_name}
                        </option>`;
                    });
                });
        }


        document.getElementById('classDropdown').addEventListener('change', function () {
            const classId = this.value;

            fetch(`/api/students-by-class?class_id=${classId}`)
                .then(res => res.json())
                .then(students => {

                    let table = `<table>
                    <tr>
                        <th>Roll</th>
                        <th>PRN</th>
                        <th>Name</th>
                        <th>Present</th>
                    </tr>`;

                    students.forEach(stu => {
                        table += `
                    <tr>
                        <td>${stu.roll_no}</td>
                        <td>${stu.prn_no}</td>
                        <td>${stu.full_name}</td>
                        <td><input type="checkbox" data-roll="${stu.roll_no}"></td>
                    </tr>`;
                    });

                    table += '</table>';
                    document.getElementById('studentTable').innerHTML = table;
                });
        });

        function saveAttendance() {

            const attendance = [];

            document.querySelectorAll('input[type="checkbox"]').forEach(cb => {
                const roll = cb.dataset.roll;
                const status = cb.checked ? 'p' : 'a';
                attendance.push(`${roll}-${status}`);
            });

            fetch(`${baseUrl}/api/save-attendance`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    date: document.getElementById('date').value,
                    subject_code: document.getElementById('subject').value,
                    class_id: document.getElementById('classDropdown').value,
                    attendance: attendance.join(',')
                })

            })
                .then(res => res.json())
                .then(data => alert(data.message));
        }

        function exportAttendance() {
            const params = new URLSearchParams({
                date: document.getElementById('date').value,
                subject: document.getElementById('subject').value,
                class_name: document.getElementById('classDropdown').value
            });

            window.open(`${baseUrl}/api/export-attendance?${params}`, '_blank');
        }

        loadSubjects();
        loadClasses();
    </script>

@endsection