<?php include './include/header.php'; ?>

<!-- Content Start -->
<div class="content">
    <!-- Navbar Start -->
    <?php include './include/navbar.php'; ?>
    <!-- Navbar End -->


    <!-- #########lecture hall add model#########-->
    <div class="modal fade" id="hallForm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="lectureHalllabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-color-fram">
                    <h1 class="modal-title fs-5" id="lectureHalllabel">Add Hall</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3" id="hallForm1" action="include/create_hall.php" method="POST">
                    <input type="hidden" name="id">
                        <div class="col-12">
                            <label for="hall_name" class="form-label">Hall name</label>
                            <input type="text" class="form-control" name="hall_name" required>
                        </div>
                        <div class="col-6">
                            <label for="student_number" class="form-label">Student capacity</label>
                            <input type="number" class="form-control" name="capacity" required>
                        </div>
                        <div class="col-md-12">
                            <label for="hall_location" class="form-label">Location</label>
                            <input type="text" class="form-control" name="hall_location" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" form="hallForm1" class="btn btn-primary">Add hall</button>
                </div>
            </div>
        </div>
    </div>



    <!-- #########lecture hall edit model#########-->
    <div class="modal fade" id="edithallForm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="lectureHalllabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="lectureHalllabel">Edit Hall</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3" id="hallupdate" action="include/create_hall.php" method="POST">
                        <input type="hidden" id="hall_id" name="id">
                        <div class="col-12">
                            <label for="hall_name" class="form-label">Hall name</label>
                            <input type="text" class="form-control" id="hall_name" name="hall_name" required>
                        </div>
                        <div class="col-6">
                            <label for="capacity" class="form-label">Student capacity</label>
                            <input type="number" class="form-control" id="capacity" name="capacity" required>
                        </div>
                        <div class="col-md-12">
                            <label for="hall_location" class="form-label">Location</label>
                            <input type="text" class="form-control" id="hall_location" name="hall_location" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" form="hallupdate" class="btn btn-primary">Update Hall</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Event listener for edit buttons
            document.querySelectorAll(".edit-hall").forEach(function(button) {
                button.addEventListener("click", function() {
                    // Populate the modal with hall data
                    document.getElementById("hall_id").value = this.dataset.id;
                    document.getElementById("hall_name").value = this.dataset.hall_name;
                    document.getElementById("capacity").value = this.dataset.capacity;
                    document.getElementById("hall_location").value = this.dataset.location;
                });
            });
        });
    </script>


    <!-- data Subject table Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h3 class="mb-0">Lecture Halls</h3>
                <button type="button" class="btn button-29" data-bs-toggle="modal" data-bs-target="#hallForm">Add hall
                </button>
            </div>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">ID</th>
                            <th scope="col">Hall Name</th>
                            <th scope="col">Student capacity</th>
                            <th scope="col">Location</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $stmt = $conn->query("SELECT id, hall_name, capacity, location, available FROM lecture_halls");
                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        if (!empty($result)) {
                            foreach ($result as $row) {
                                echo '<tr>';
                                echo '<td>' . htmlspecialchars($row['id']) . '</td>';
                                echo '<td>' . htmlspecialchars($row['hall_name']) . '</td>';
                                echo '<td>' . htmlspecialchars($row['capacity']) . '</td>';
                                echo '<td>' . htmlspecialchars($row['location']) . '</td>';
                                echo '<td>' . htmlspecialchars($row['available']) . '</td>';
                                echo '<td class="d-flex justify-content-around">';
                                echo '<a href="#" class="edit-hall" data-bs-toggle="modal" data-bs-target="#edithallForm" data-id="' . $row['id'] . '" data-hall_name="' . htmlspecialchars($row['hall_name']) . '" data-capacity="' . htmlspecialchars($row['capacity']) . '" data-location="' . htmlspecialchars($row['location']) . '"><i class="fas fa-user-edit fa-lg"></i></a>';
                                echo '<a href="include/delete.php?type=LectureHall&id=' . $row['id'] . '" class="m-1" onclick="return confirm(\'Are you sure you want to delete this Hall?\')"><i class="fas fa-trash-alt fa-lg"></i></a>';
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
    <!-- data Subject table End -->
</div>
<!-- Content End -->

<?php include './include/footer.php'; ?>