<!DOCTYPE html>
<html>
<head>
    <title>Students</title>
</head>
<body>

<h2>Student List</h2>

<table border="1" cellpadding="10">
    <tr>
        <th>Roll No</th>
        <th>PRN</th>
        <th>Full Name</th>
    </tr>

    @foreach($students as $student)
    <tr>
        <td>{{ $student->roll_no }}</td>
        <td>{{ $student->prn_no }}</td>
        <td>{{ $student->full_name }}</td>
    </tr>
    @endforeach

</table>

</body>
</html>
