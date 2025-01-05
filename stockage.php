<h1 class="title">Attendance Table for <?php echo $dateInEnglish; ?></h1>

<table>
    <thead>
        <tr>
            <th>Last Name</th>
            <th>First Name</th>
            <th>Class</th>
            <th>Morning Attendance</th>
            <th>Morning Time</th>
            <th>Afternoon Attendance</th>
            <th>Afternoon Time</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($attendances as $attendance) : ?>
            <tr>
                <td><?php echo $attendance['LastName']; ?></td>
                <td><?php echo $attendance['FirstName']; ?></td>
                <td><?php echo $attendance['Class']; ?></td>
                <td><?php echo $attendance['MorningAttendance']; ?></td>
                <td><?php echo $attendance['MorningTime']; ?></td>
                <td><?php echo $attendance['AfternoonAttendance']; ?></td>
                <td><?php echo $attendance['AfternoonTime']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>