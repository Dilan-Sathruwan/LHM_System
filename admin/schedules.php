<?php include './include/header.php'; ?>

<!-- Content Start -->
<div class="content">
    <!-- Navbar Start -->
    <?php include './include/navbar.php'; ?>
    <!-- Navbar End -->


    <!-- Blank Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-start mb-4">
                <h2>Generate your Timetable</h2>
            </div>
            <div class="d-flex align-items-center justify-content-start mb-4">
                <a class="btn btn-lg btn-primary ms-4" href="./check_batch.php">Lecture Timetable</a>
                <a class="btn btn-lg btn-primary ms-4" href="">Batch Timetable</a>
                <a class="btn btn-lg btn-primary ms-4" href="">Hall Timetable</a>
            </div>
        </div>
        <div class="bg-light text-center rounded p-4 mt-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h3 class="mb-0">All Avalible Lecturers</h3>
                <a class="btn btn-ml btn-primary" href="">Add Lecturers</a>
            </div>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">ID</th>
                            <th scope="col">Lecture Name</th>
                            <th scope="col">Department Name</th>
                            <th scope="col">Batch Name</th>
                            <th scope="col">Batch Name</th>
                            <th scope="col">Subject Name</th>
                            <th scope="col">Days</th>
                            <th scope="col">Time</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $stmt = $conn->query("SELECT id, lecturer_id, hall_id, department_id, batch_id, subject_id, slot_id, days FROM lecture_schedule");
                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        if (!empty($result)) {
                            foreach ($result as $row) {
                                echo '<tr>';
                                echo '<td>' . htmlspecialchars($row['id']) . '</td>';
                                echo '<td>' . htmlspecialchars($row['lecturer_id']) . '</td>';
                                echo '<td>' . htmlspecialchars($row['hall_id']) . '</td>';
                                echo '<td>' . htmlspecialchars($row['department_id']) . '</td>';
                                echo '<td>' . htmlspecialchars($row['batch_id']) . '</td>';
                                echo '<td>' . htmlspecialchars($row['subject_id']) . '</td>';
                                echo '<td>' . htmlspecialchars($row['days']) . '</td>';
                                echo '<td>' . htmlspecialchars($row['slot_id']) . '</td>';
                                echo '<td class="d-flex align-items-lg-center justify-content-around">';
                                echo '<a href="" class=""><i class="fas fa-user-edit fa-lg"></i></a>';
                                echo '<a href="" class=""><i class="fas fa-trash-alt fa-lg"></i></a>';
                                echo '</td>';
                                echo '</tr>';
                            }
                        } else {
                            echo '<tr><td colspan="5">No results found</td></tr>';
                        }

                        ?>

                    </tbody>
                </table>
            </div>
        </div>


    </div>

    <!-- Blank End -->


    <!-- Content End -->

    <?php include './include/footer.php'; ?>