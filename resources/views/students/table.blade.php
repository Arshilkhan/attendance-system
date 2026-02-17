<table border="1" cellpadding="10">
    <tr>
        <th>Roll No</th>
        <th>PRN</th>
        <th>Full Name</th>
        <th>Class</th>
    </tr>

    @foreach($students as $student)
    <tr>
        <td>{{ $student->roll_no }}</td>
        <td>{{ $student->prn_no }}</td>
        <td>{{ $student->full_name }}</td>
        <td>{{ $student->class_name }}</td>
    </tr>
    @endforeach
</table>
