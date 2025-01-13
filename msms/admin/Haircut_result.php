<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

// Check if user is logged in
if (strlen($_SESSION['bpmsaid']) == 0) {
    header('location:logout.php');
} else {

    // Handle form submission
    if (isset($_POST['submit'])) {
        $haircutName = $_POST['haircutName'];
        $description = $_POST['description'];

        // Handle file upload
        $target_dir = "images/"; // Directory to save images
        $target_file = $target_dir . basename($_FILES["haircutImage"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if the file is a valid image
        $check = getimagesize($_FILES["haircutImage"]["tmp_name"]);
        if ($check === false) {
            echo "<script>alert('The file is not an image.');</script>";
        } else {
            // Upload the image to the server
            if (move_uploaded_file($_FILES["haircutImage"]["tmp_name"], $target_file)) {
                // Insert file path into the database
                $query = mysqli_query($con, "INSERT INTO tblhaircuts(haircutName, description, imagePath) VALUES('$haircutName', '$description', '$target_file')");
                if ($query) {
                    echo "<script>alert('Haircut added successfully.');</script>";
                    echo "<script>window.location.href = 'Haircut_result.php'</script>";
                } else {
                    echo "<script>alert('An error occurred. Please try again.');</script>";
                }
            } else {
                echo "<script>alert('There was an error uploading the file.');</script>";
            }
        }
    }

    // Handle delete request
    if (isset($_POST['delete'])) {
        $deleteId = $_POST['deleteId'];

        // Fetch the image path from the database
        $result = mysqli_query($con, "SELECT imagePath FROM tblhaircuts WHERE id = '$deleteId'");
        if ($row = mysqli_fetch_array($result)) {
            $imagePath = $row['imagePath'];

            // Delete the record from the database
            $deleteQuery = mysqli_query($con, "DELETE FROM tblhaircuts WHERE id = '$deleteId'");

            if ($deleteQuery) {
                // Delete the image file from the server
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
                echo "<script>alert('Haircut deleted successfully.');</script>";
                echo "<script>window.location.href = 'Haircut_result.php'</script>";
            } else {
                echo "<script>alert('An error occurred. Please try again.');</script>";
            }
        }
    }
}
?>


<!DOCTYPE HTML>
<html>
<head>
    <title>MSMS | Add Haircut</title>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
    <!-- Custom CSS -->
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <!-- Font Awesome Icons -->
    <link href="css/font-awesome.css" rel="stylesheet">
    <!-- JavaScript -->
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/modernizr.custom.js"></script>
    <link href="//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic" rel='stylesheet' type='text/css'>
    <link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
    <script src="js/wow.min.js"></script>
    <script>
        new WOW().init();
    </script>
    <script src="js/metisMenu.min.js"></script>
    <script src="js/custom.js"></script>

    <!-- Custom CSS for Pagination and Layout -->
   <!-- Custom CSS for Pagination and Layout -->
<style>
    .photo-gallery {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: center;
    }

    .photo-card {
        display: flex;
        flex-direction: column;
        align-items: center;
        max-width: 250px;
        text-align: center;
        border: 1px solid #ddd;
        padding: 15px;
        border-radius: 10px;
    }

    .photo-card img {
        width: 200px; /* Fixed width */
        height: 300px; /* Increased height for a rectangular look */
        object-fit: cover; /* Ensures the image fits without distortion */
        border-radius: 10px;
    }

    .photo-info {
        margin-top: 10px;
    }

    .pagination {
        margin-top: 20px;
    }

    .pagination .page-item.active .page-link {
        background-color: #007bff;
        border-color: #007bff;
        color: white;
    }

    .pagination .page-link {
        color: #007bff;
        border: 1px solid #ddd;
    }

    .pagination .page-item.disabled .page-link {
        color: #6c757d;
        background-color: #fff;
        border-color: #ddd;
    }

    .delete-btn {
        margin-top: 10px;
        background-color: #dc3545;
        color: white;
        border: none;
        padding: 5px 10px;
        cursor: pointer;
        border-radius: 5px;
    }
</style>

</head>
<body class="cbp-spmenu-push">
    <div class="main-content">
        <!-- Sidebar -->
        <?php include_once('includes/sidebar.php'); ?>
        <!-- Header -->
        <?php include_once('includes/header.php'); ?>
        <!-- Main Content -->
        <div id="page-wrapper">
            <div class="main-page">
                <div class="forms">
                    <h3 class="title1">Add Haircut</h3>
                    <div class="form-grids row widget-shadow" data-example-id="basic-forms">
                        <div class="form-title">
                            <h4>Upload Haircut Image:</h4>
                        </div>
                        <div class="form-body">
                            <!-- Haircut Form -->
                            <form method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Haircut Name</label>
                                    <input type="text" class="form-control" name="haircutName" placeholder="Haircut Name" required="true">
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control" name="description" rows="5" required="true"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Upload Image</label>
                                    <input type="file" class="form-control" name="haircutImage" required="true">
                                </div>
                                <button type="submit" name="submit" class="btn btn-default">Add Haircut</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Display Existing Haircuts with Pagination -->
                <div class="forms">
                    <h3 class="title1">Available Haircuts</h3>
                    <div class="form-grids row widget-shadow" data-example-id="basic-forms">
                        <div class="form-body">
                            <?php
                            // Pagination setup
                            $itemsPerPage = 4; // Number of items per page
                            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                            $page = ($page > 0) ? $page : 1;

                            // Get the total number of items
                            $totalQuery = mysqli_query($con, "SELECT COUNT(*) AS total FROM tblhaircuts");
                            $totalResult = mysqli_fetch_array($totalQuery);
                            $totalItems = $totalResult['total'];

                            // Calculate total pages
                            $totalPages = ceil($totalItems / $itemsPerPage);

                            // Calculate the starting item index for the current page
                            $start = ($page - 1) * $itemsPerPage;

                            // Fetch items for the current page
                            $query = mysqli_query($con, "SELECT * FROM tblhaircuts LIMIT $start, $itemsPerPage");
                            ?>

                            <div class="photo-gallery">
                                <?php
                                while ($row = mysqli_fetch_array($query)) {
                                    echo "<div class='photo-card'>";
                                    echo "<img src='" . $row['imagePath'] . "' class='img-responsive' alt='Haircut Image'>";
                                    echo "<div class='photo-info'>";
                                    echo "<h4>" . $row['haircutName'] . "</h4>";
                                    echo "<p>" . $row['description'] . "</p>";
                                    echo "<form method='post'>"; // Form for deleting the haircut
                                    echo "<input type='hidden' name='deleteId' value='" . $row['id'] . "'>";
                                    echo "<button type='submit' name='delete' class='delete-btn'>Delete</button>";
                                    echo "</form>";
                                    echo "</div>";
                                    echo "</div>";
                                }
                                ?>
                            </div>

                            <!-- Pagination Controls -->
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-center">
                                    <li class="page-item <?php if($page <= 1) echo 'disabled'; ?>">
                                        <a class="page-link" href="?page=<?php echo $page - 1; ?>" tabindex="-1">Previous</a>
                                    </li>
                                    <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
                                        <li class="page-item <?php if($i == $page) echo 'active'; ?>">
                                            <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                        </li>
                                    <?php } ?>
                                    <li class="page-item <?php if($page >= $totalPages) echo 'disabled'; ?>">
                                        <a class="page-link" href="?page=<?php echo $page + 1; ?>">Next</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include_once('includes/footer.php'); ?>
    </div>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.js"></script>
</body>
</html>
