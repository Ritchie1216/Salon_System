<?php
include('includes/dbconnection.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
    <style>
 body {
    background-color: #2c2c2c; /* Dark gray background */
}

/* Title Container */
.container2 {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100px;
    margin-top: 100px;
}

.container2 h1 {
    color: rgba(255, 255, 255, 0.7); /* Slightly transparent white (70% opacity) */
    font-size: 36px;
    font-family: Arial, sans-serif;
    text-align: center;
}

/* Table Styles */
.photo-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 10px; /* Space between table cells */
}

.photo-table th, .photo-table td {
    text-align: center;
    vertical-align: middle;
}

.photo-card {
    text-align: center;
}

.photo-card img {
    border-radius: 10px;
    border: 2px solid rgba(255, 255, 255, 0.6);
    max-width: 200px; /* Adjust to control image size */
    height: auto; /* Maintain aspect ratio */
    transition: transform 0.3s ease;
}

.photo-card img:hover {
    transform: scale(1.05); /* Slightly zoom in on hover */
}

.photo-title {
    color: rgba(255, 255, 255, 0.8); /* Slightly transparent white (80% opacity) */
    font-size: 16px; /* Smaller font size for titles */
    font-family: Arial, sans-serif;
    margin-top: 10px;
}

/* Pagination */
.pagination .page-item .page-link {
    color: rgba(255, 255, 255, 0.8); /* Slightly transparent white */
    background-color: #2c2c2c; /* Match background color */
    border: 1px solid rgba(255, 255, 255, 0.5);
}

.pagination .page-item.active .page-link {
    background-color: rgba(255, 255, 255, 0.8); /* Highlight active page */
    color: #2c2c2c; /* Dark text for active page */
}

.pagination .page-item:hover .page-link {
    background-color: rgba(255, 255, 255, 0.6);
    color: #2c2c2c;
}
.photo-card img {
    border-radius: 10px;
    border: 2px solid rgba(255, 255, 255, 0.6);
    width: 200px; /* Set a fixed width */
    height: 300px; /* Set a fixed height */
    object-fit: cover; /* Ensures the image fits within the set width and height while maintaining aspect ratio */
    transition: transform 0.3s ease;
}
.photo-title {
    color: #000000; /* Set the text color to black */
    font-size: 16px;
    font-family: Arial, sans-serif;
    margin-top: 10px;
}

    </style>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Haircut Results</title>
    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <?php include_once('includes/header.php');?>


    <!-- Page Header -->
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="page-caption">
                        <h2 class="page-title">Haircut Gallery</h2>
                        <div class="page-breadcrumb">
                            <ol class="breadcrumb">
                                <li><a href="index.php">Home</a></li>
                                <li class="active">Gallery</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <?php
        // 从数据库中查询图片
        $itemsPerPage = 4; // 每页显示的项目数量
        $query = "SELECT * FROM tblhaircuts";
        $result = mysqli_query($con, $query);
        $totalItems = mysqli_num_rows($result);
        $totalPages = ceil($totalItems / $itemsPerPage);

        // 当前页数，默认为第一页
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        if ($page < 1) $page = 1;
        if ($page > $totalPages) $page = $totalPages;

        // 计算当前页面的起始索引
        $start = ($page - 1) * $itemsPerPage;

        // 查询当前页的图片
        $paginatedQuery = "SELECT * FROM tblhaircuts LIMIT $start, $itemsPerPage";
        $paginatedResult = mysqli_query($con, $paginatedQuery);
        ?>

        <table class="photo-table">
            <tbody>
                <tr>
                    <?php if (mysqli_num_rows($paginatedResult) > 0) { ?>
                        <?php while ($row = mysqli_fetch_assoc($paginatedResult)) { ?>
                            <td>
                                <div class="photo-card">
                                    <img src="<?php echo $row['imagePath']; ?>" alt="Haircut" class="img-fluid">
                                    <div class="photo-title"><?php echo $row['haircutName']; ?></div>
                                </div>
                            </td>
                        <?php } ?>
                    <?php } else { ?>
                        <td>No images available.</td>
                    <?php } ?>
                </tr>
            </tbody>
        </table>

        <!-- Pagination -->
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

    <?php include_once('includes/footer.php');?>


    <!-- jQuery and Bootstrap JS -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>
