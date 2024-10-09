<?php include './include/header.php'; ?>

<!-- Content Start -->
<div class="content">
    <!-- Navbar Start -->
    <?php include './include/navbar.php'; ?>
    <!-- Navbar End -->

    <div>
        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="row g-3">
                            <div class="col-12">
                                <label for="inputname" class="form-label">Batch Name</label>
                                <input type="name" class="form-control" id="inputname">
                            </div>
                            <div class="col-md-6">
                                <label for="inputyear" class="form-label">Batch Year</label>
                                <input type="name" class="form-control" id="inputyear">
                            </div>
                            <div class="col-12">
                                <label for="inputState" class="form-label">Department</label>
                                <select id="inputState" class="form-select">
                                    <option selected>Choose...</option>
                                    <option>...</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="inputState" class="form-label">Semester</label>
                                <select id="inputState" class="form-select">
                                    <option selected>Choose...</option>
                                    <option>...</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Understood</button>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <!-- data Batches table Start -->
    <div class="container-fluid pt-4 px-4">

        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h3 class="mb-0">batches</h3>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Add Batch
                </button>
            </div>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">Id</th>
                            <th scope="col">Batch year</th>
                            <th scope="col">Batch Name</th>
                            <th scope="col">department_name</th>
                            <th scope="col">Semester_name</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $stmt = $conn->query("SELECT b.id, b.batch_year, b.batch_name, d.department_name, s.sem_name FROM batches b LEFT JOIN departments d ON b.department_id = d.id INNER JOIN semester s ON b.semester_id = s.id;");
                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        if (!empty($result)) {
                            foreach ($result as $row) {
                                echo '<tr>';
                                echo '<td>' . htmlspecialchars($row['id']) . '</td>';
                                echo '<td>' . htmlspecialchars($row['batch_year']) . '</td>';
                                echo '<td>' . htmlspecialchars($row['batch_name']) . '</td>';
                                echo '<td>' . htmlspecialchars($row['department_name']) . '</td>';
                                echo '<td>' . htmlspecialchars($row['sem_name']) . '</td>';
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
    <!-- data Batches table End -->
</div>
<!-- Content End -->

<?php include './include/footer.php'; ?>