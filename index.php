<?php
include "db.php";
$obj = new DB();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>OOP CRUD</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./style.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container-lg">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-8">
                            <h2>Shopping <b>List</b></h2>
                        </div>
                        <div class="col-sm-4">
                            <button type="button" class="btn btn-info add-new" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus"></i> Add New</button>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="col-2">No.</th>
                            <th class="col">Name</th>
                            <th class="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $limit = 10;
                        $page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
                        $offset = ($page - 1) * $limit;

                        $result = $obj->getAllData($offset, $limit);
                        $total_rows = $obj->countData();
                        $totalPages = ceil($total_rows / $limit);

                        $counter = 1;
                        if (!empty($result)) {
                            while ($row = $result->fetch_assoc()) {
                        ?>
                                <tr>
                                    <td><?php echo $counter ?></td>
                                    <td><?php echo htmlspecialchars($row["name"]); ?></td>
                                    <td>
                                        <a href="update.php?id=<?php echo $row["id"] ?>" class="edit"><i class="material-icons">&#xE254;</i></a>
                                        <a href="delete.php?id=<?php echo $row["id"] ?>" class="delete"><i class="material-icons">&#xE872;</i></a>
                                    </td>
                                </tr>
                        <?php
                                $counter++;
                            }
                        } else {
                            echo "<tr><td colspan='3' class='text-center'>No data</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <?php

                ?>
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <?php
                        for ($i = 1; $i <= $totalPages; $i++) {
                            echo "<li class='page-item'>";
                            echo "<a class='page-link' href='?page=$i'>$i</a>";
                            echo "</li>";
                        }
                        ?>
                    </ul>
                </nav>
            </div>
        </div>

    </div>

    <!-- Add Modal -->
    <div class="modal fade" tabindex="-1" id="addModal" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="add.php">
                        <div class="form-group">
                            <label for="item_name">Item name</label>
                            <input type="text" class="form-control" id="item_name" name="item_name" placeholder="Enter item name" required>
                        </div>

                        <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll(".delete").forEach(button => {
            button.addEventListener("click", function() {
                if (!confirm("Are you sure you want to delete this row?")) event.preventDefault();
            })
        })
    </script>
</body>

</html>