<?php
include "db.php";
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
                        <div class="col-sm-12">
                            <h2>Update Item</h2>
                        </div>
                    </div>
                </div>
                <?php
                $item_id = $_GET["id"];
                $get_single_data = new DB();
                $result = $get_single_data->getSingleData($item_id);
                $row = $result->fetch_assoc();
                ?>

                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["item_name"])) {
                    $update_data = new DB();
                    $update_data->updateData($_POST["item_id"], $_POST["item_name"]);
                }
                ?>

                <form method="POST" action="">
                    <div class="form-group">
                        <label for="item_name">Item Name</label>
                        <input type="hidden" name="item_id" value="<?php echo $row["id"]; ?>">
                        <input type="text" class="form-control" name="item_name" value="<?php echo htmlspecialchars($row["name"]); ?>" aria-describedby="item name">
                    </div>

                    <button type="submit" class="btn btn-success">Submit</button>
                    <a class="btn btn-secondary" href="javascript:history.go(-1)">Cancel</a>
                </form>

            </div>
        </div>
    </div>
</body>

</html>