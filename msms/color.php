<?php 
include('includes/dbconnection.php');
session_start();
error_reporting(0);

if(isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $services = $_POST['services'];
    $adate = $_POST['adate'];
    $atime = $_POST['atime'];
    $phone = $_POST['phone'];
    $color = $_POST['color']; // 获取用户选择的颜色
    $aptnumber = mt_rand(100000000, 999999999);

    // 将颜色信息与其他预约信息一起插入数据库
    $query = mysqli_query($con, "INSERT INTO tblappointment (AptNumber, Name, Email, PhoneNumber, AptDate, AptTime, Services, HairColor) VALUES ('$aptnumber', '$name', '$email', '$phone', '$adate', '$atime', '$services', '$color')");

    if ($query) {
        $ret = mysqli_query($con, "SELECT AptNumber FROM tblappointment WHERE Email='$email' AND PhoneNumber='$phone'");
        $result = mysqli_fetch_array($ret);
        $_SESSION['aptno'] = $result['AptNumber'];
        echo "<script>window.location.href='thank-you.php'</script>";  
    } else {
        echo "<script>alert('Something Went Wrong. Please try again.');</script>"; 
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Men Salon Management System || Appointments Form</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i%7cMontserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <!-- Style -->
    <link href="css/style.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        #color-picker {
            display: none; /* 初始状态隐藏颜色选择器 */
        }
        #color-preview {
            width: 100%;
            height: 50px;
            margin-top: 10px;
            text-align: center;
            line-height: 50px;
            border: 1px solid #ccc;
            transition: background-color 0.3s ease;
            background-color: transparent;
            display: none; /* 初始状态隐藏颜色预览框 */
        }
    </style>
</head>
<body>
    <?php include_once('includes/header.php');?>
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="page-caption">
                        <h2 class="page-title">Book Appointment</h2>
                        <div class="page-breadcrumb">
                            <ol class="breadcrumb">
                                <li><a href="index.php">Home</a></li>
                                <li class="active">Book Appointment</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <h1>Appointment Form</h1>
                            <p> Book your appointment to save salon rush.</p>
                            <form method="post">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="control-label" for="name">Name</label>
                                        <input type="text" class="form-control" id="name" placeholder="Name" name="name" required="true">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label" for="phone">Phone</label>
                                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" required="true" maxlength="10" pattern="[0-9]+">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label" for="email">Email</label>
                                        <input type="email" class="form-control" id="appointment_email" placeholder="Email" name="email" required="true">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label" for="services">Services</label>
                                        <select name="services" id="services" required="true" class="form-control">
                                            <option value="">Select Services</option>
                                            <?php 
                                            $query=mysqli_query($con,"select * from tblservices");
                                            while($row=mysqli_fetch_array($query)) {
                                            ?>
                                                <option value="<?php echo $row['ServiceName'];?>"><?php echo $row['ServiceName'];?></option>
                                            <?php } ?> 
                                        </select>
                                    </div>
                                    <!-- 颜色选择器，默认隐藏 -->
                                    <div class="col-md-12" id="color-picker">
                                        <label class="control-label" for="color">Select Hair Color</label>
                                        <input type="color" class="form-control" name="color" id="color">
                                    </div>
                                    <!-- 颜色预览框，默认隐藏 -->
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label" for="adate">Appointment Date</label>
                                            <input type="date" class="form-control appointment_date" placeholder="Date" name="adate" id='inputdate' required="true">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label" for="atime">Appointment Time</label>
                                            <input type="time" class="form-control appointment_time" placeholder="Time" name="atime" id='atime' required="true">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="submit" id="submit" name="submit" class="btn btn-default">Book</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include_once('includes/footer.php');?>
    <!-- /.footer-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/menumaker.js"></script>
    <script src="js/jquery.sticky.js"></script>
    <script src="js/sticky-header.js"></script>
    <!-- JavaScript 代码，用于动态显示和实时预览颜色选择 -->
    <script type="text/javascript">
    $(document).ready(function() {
        // 当服务选项改变时，检测是否选择了“染发”服务
        $('#services').on('change', function() {
            var selectedService = $(this).val();
            // 假设 "Hair Coloring" 是染发服务的名称，你可以根据实际情况调整
            if (selectedService.toLowerCase().includes('color')) {
                $('#color-picker').slideDown(); // 显示颜色选择器
                $('#color-preview').slideDown(); // 显示颜色预览框
            } else {
                $('#color-picker').slideUp(); // 隐藏颜色选择器
                $('#color-preview').slideUp(); // 隐藏颜色预览框
                $('#color').val(''); // 重置颜色选择器的值
                $('#color-preview').css('background-color', 'transparent').text('No Color Selected');
            }
        });

        // 当颜色选择器改变时，更新预览框的背景颜色
        $('#color').on('input', function() {
            var selectedColor = $(this).val();
            $('#color-preview').css('background-color', selectedColor);
            $('#color-preview').text(selectedColor); // 显示选择的颜色代码
        });
        
        var dtToday = new Date();
        var month = dtToday.getMonth() + 1;
        var day = dtToday.getDate() + 1;
        var year = dtToday.getFullYear();
        if(month < 10)
            month = '0' + month.toString();
        if(day < 10)
            day = '0' + day.toString();
        var maxDate = year + '-' + month + '-' + day;
        $('#inputdate').attr('min', maxDate);
    });
    </script>
</body>
</html>
