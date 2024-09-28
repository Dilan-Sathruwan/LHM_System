<?php
// include('auth.php'); // Uncomment if authentication is required
include('../../includes/header.php'); // Common header 
include('../../includes/db_connection.php'); // Database Connection 

$message = isset($_GET['message']) ? $_GET['message'] : '';

// Fetch lectures for dropdown
$lectures_query = "SELECT id, lecture_name FROM lectures";
$lectures_result = mysqli_query($conn, $lectures_query);

// Fetch lecture halls for dropdown
$halls_query = "SELECT id, hall_name FROM lecture_halls WHERE available = TRUE";
$halls_result = mysqli_query($conn, $halls_query);

?>

<div class="container mt-5">
    <h1>Add Lecture Schedule</h1>

    <?php if ($message): ?>
        <div class="alert alert-success">
            <?php echo htmlspecialchars($message); ?>
        </div>
    <?php endif; ?>

    <form action="process_add_schedule.php" method="POST">
        <div class="mb-3">
            <label for="lecture_id" class="form-label">Lecture</label>
            <select class="form-select" id="lecture_id" name="lecture_id" required>
                <option value="">Select Lecture</option>
                <?php while ($lecture = mysqli_fetch_assoc($lectures_result)): ?>
                    <option value="<?php echo $lecture['id']; ?>"><?php echo htmlspecialchars($lecture['lecture_name']); ?></option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="hall_id" class="form-label">Lecture Hall</label>
            <select class="form-select" id="hall_id" name="hall_id" required>
                <option value="">Select Hall</option>
                <?php while ($hall = mysqli_fetch_assoc($halls_result)): ?>
                    <option value="<?php echo $hall['id']; ?>"><?php echo htmlspecialchars($hall['hall_name']); ?></option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="schedule_date" class="form-label">Schedule Date</label>
            <input type="date" class="form-control" id="schedule_date" name="schedule_date" required>
        </div>

        <div class="mb-3">
            <label for="schedule_time" class="form-label">Schedule Time</label>
            <input type="time" class="form-control" id="schedule_time" name="schedule_time" required>
        </div>

        <div class="mb-3">
            <label for="duration" class="form-label">Duration (minutes)</label>
            <input type="number" class="form-control" id="duration" name="duration" required>
        </div>

        <button type="submit" class="btn btn-primary">Add Schedule</button>
        <a href="manage_schedule.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<!-- Include footer -->
<?php include('../../includes/footer.php'); ?>
