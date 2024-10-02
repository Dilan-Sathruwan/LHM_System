<?php
session_start();
require_once '../includes/db_connection.inc.php'; // Include database connection

// Fetch lecturer's lectures and create the table rows dynamically

// Use the same logic as the PHP above, but return only the table rows (without `<html>` or `<table>` tags).
?>

<!-- Inside this PHP file, echo out only the table rows -->
<?php foreach ($timeslots as $index => $timeslot): ?>
<tr>
    <td><?php echo $timeslot; ?></td>

    <?php foreach (['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'] as $day): ?>
        <?php if (strpos($timeslot, 'Interval') !== false): ?>
            <td class="interval">Interval</td>
        <?php else: ?>
            <?php if (isset($timetable[$day][$actualTimes[$index]])): ?>
                <?php $lecture = $timetable[$day][$actualTimes[$index]]; ?>
                <td class="subject-cell">
                    <?php echo htmlspecialchars($lecture['subject_name']); ?><br>
                    <?php echo htmlspecialchars($lecture['hall_name']); ?>
                </td>
            <?php else: ?>
                <td></td>
            <?php endif; ?>
        <?php endif; ?>
    <?php endforeach; ?>
</tr>
<?php endforeach; ?>
