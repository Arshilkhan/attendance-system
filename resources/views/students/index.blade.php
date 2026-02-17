@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="{{ asset('css/students.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

<div class="page-wrapper">
    <div class="container">
        <h1>Student Management</h1>

        {{-- Filter + Search --}}
        <div class="filter-section">
            <select id="classFilter" onchange="loadStudents()">
                <option value="">Select class</option>
            </select>

            <div class="search-container">
                <input type="text" id="searchInput" placeholder="Search by name..." onkeyup="loadStudents()">
                <button onclick="loadStudents()" title="Search">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </div>
        </div>

        {{-- Table loads here --}}
        <div id="studentTable"></div>
    </div>
</div>

{{-- Modal --}}
<div id="studentModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2>Add Student</h2>

        <form id="studentForm">
            @csrf

            <label>Roll No:</label>
            <input type="text" id="roll_no" name="roll_no" required>

            <label>PRN No:</label>
            <input type="text" id="prn_no" name="prn_no" required>

            <label>Full Name:</label>
            <input type="text" id="full_name" name="full_name" required>

            <label>Class:</label>
            <select id="class_name" name="class_name" required></select>

            <button type="submit">Save</button>
        </form>
    </div>
</div>

<script>
    const baseUrl = "{{ url('/') }}";

    function loadClasses() {
        fetch(`${baseUrl}/api/classes`)
            .then(res => res.json())
            .then(classes => {
                const classFilter = document.getElementById('classFilter');
                const classDropdown = document.getElementById('class_name');

                classFilter.innerHTML = `<option value="">Select Class</option>`;
                classDropdown.innerHTML = `<option value="">Select Class</option>`;

                classes.forEach(cls => {
                    classFilter.innerHTML += `<option value="${cls}">${cls}</option>`;
                    classDropdown.innerHTML += `<option value="${cls}">${cls}</option>`;
                });
            });
    }

    function loadStudents() {
        const cls = document.getElementById('classFilter').value;
        const search = document.getElementById('searchInput').value;

        fetch(`${baseUrl}/api/students?class=${cls}&search=${search}`)
            .then(res => res.text())
            .then(html => {
                document.getElementById('studentTable').innerHTML = html;
            });
    }

    document.getElementById('studentForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(this);

        fetch(`${baseUrl}/api/students`, {
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            body: formData
        })
        .then(res => res.json())
        .then(() => {
            closeModal();
            loadStudents();
        });
    });

    function deleteStudent(rollNo, className) {
        if(confirm("Delete student?")) {
            fetch(`${baseUrl}/api/students/${rollNo}?class=${className}`, {
                method: "DELETE",
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            }).then(() => loadStudents());
        }
    }

    function closeModal() {
        document.getElementById('studentModal').style.display = 'none';
    }

    window.onload = () => {
        loadClasses();
        loadStudents();
    };
</script>

@endsection
