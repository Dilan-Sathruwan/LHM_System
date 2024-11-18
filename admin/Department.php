<?php include './include/header.php'; ?>

<!-- Content Start -->
<div class="content">
    <!-- Navbar Start -->
    <?php include './include/navbar.php'; ?>
    <!-- Navbar End -->


    <!-- Blank Start -->

    <!-- Table Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
        <h2 class="text-center">Department And Semester Manage</h2>
            <div class="col-sm-12 col-xl-6">
                <div class="bg-light rounded h-100 p-4">
                    <h5 class="mb-4">Departments</h5>
                    <table class="table table-bordered text-start table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Department name</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Fetch Departments
                            $stmt = $conn->query("SELECT id, department_name FROM departments");
                            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            if (!empty($result)) {
                                foreach ($result as $row) {
                                    echo '<tr>';
                                    echo '<td>' . htmlspecialchars($row['id']) . '</td>';
                                    echo '<td>' . htmlspecialchars($row['department_name']) . '</td>';
                                    echo '<td class="d-flex justify-content-center ">';
                                    echo '<a href="#" class="mx-1"';
                                    echo '><i class="fas fa-eye fa-lg"></i></a>';
                                    echo '<a href="#" class="ms-3"';
                                    echo '><i class="fas fa-trash fa-lg"></i></a>';
                                    echo '</td>';
                                    echo '</tr>';
                                }
                            } else {
                                echo '<tr><td colspan="2">No results found</td></tr>'; // Adjust colspan as needed
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-sm-12 col-xl-6">
                <div class="bg-light rounded h-100 p-4">
                    <h5 class="mb-4">Semesters & etc</h5>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">index.No</th>
                                <th scope="col">Semester name</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        // Fetch Departments
                        $stmt = $conn->query("SELECT id, sem_num, sem_name  FROM semester");
                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        if (!empty($result)) {
                            foreach ($result as $row) {
                                echo '<tr>';
                                echo '<td>' . htmlspecialchars($row['id']) . '</td>';
                                echo '<td>' . htmlspecialchars($row['sem_num']) . '</td>';
                                echo '<td>' . htmlspecialchars($row['sem_name']) . '</td>';
                                echo '<td class="text-center ">';
                                echo '<a href="#" class="mx-3"';
                                echo '><i class="fas fa-eye fa-lg"></i></a>';
                                echo '<a href="#" class="ms-3"';
                                echo '><i class="fas fa-trash fa-lg"></i></a>';
                                echo '</td>';
                                echo '</tr>';
                            }
                        } else {
                            echo '<tr><td colspan="2">No results found</td></tr>'; // Adjust colspan as needed
                        }
                        ?>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Blank End -->
</div>
<!-- Content End -->

<?php include './include/footer.php'; ?>