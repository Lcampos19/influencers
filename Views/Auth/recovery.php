<!DOCTYPE html>
<html lang="en">
	<head>
	<meta charset="utf-8" />
	<title>Influencers</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta name="Influencers" />
	<meta name="Ing. Luis Campos" />
    <link rel="stylesheet" href="plugins/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="plugins/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="plugins/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="css/AdminLTE.css">
    <link rel="stylesheet" href="css/skins/skin-green.min.css">
    <link rel="stylesheet" href="plugins/iCheck/square/blue.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="plugins/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="plugins/parsley/src/parsley.css">

    <script src="plugins/pace/pace.min.js"></script>

	<link rel="stylesheet"
		href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
	</head>
 <body class="pace-top bg-white" style="background: white;">
  <div id="page-loader" class="fade show"><span class="spinner"></span></div>
        <div class="login login-with-news-feed">
            <div class="news-feed">
                <div class="news-image" style="background-image: url(img/influencers.jpg)"></div>
            </div>
            <div class="right-content">
                <div class="login-header">
                    <div class="brand">
                        <strong>Influ</strong>encers
                        <small>Influencers</small>
                    </div>
                    <div class="icon">
                        <i class="fa fa-sign-in"></i>
                    </div>
                </div>
                <div class="login-content">
                    <form id="recoveryForm" data-parsley-validate="">
                        <div id="alert"></div>
                        <div class="form-group m-b-15">
                            <input type="text" name="username" class="form-control form-control-lg" value="<?php echo $datos; ?>" required style="text-transform:lowercase" readonly/>
                        </div>
                        <div class="form-group m-b-15">
                            <input type="password" name="password" class="form-control form-control-lg" placeholder="Password" required />
                        </div>
                        <div class="form-group m-b-15">
                            <input type="password" name="newpassword" class="form-control form-control-lg" placeholder="NewPassword" required />
                        </div>
                        <div class="login-buttons">
                            <button type="submit" class="btn btn-success btn-block btn-lg validate" >Sign me in</button>
                        </div>
                        <p class="text-center text-grey-darker">
                            &copy; Influencers All Right Reserved <?php echo date("Y"); ?>
                        </p>
                    </form>
                </div>
            </div>
        </div>

        <script src="plugins/jquery/dist/jquery.min.js"></script>
        <script src="plugins/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="js/adminlte.min.js"></script>
        <script src="plugins/iCheck/icheck.min.js"></script>
        <script src="js/login.js"></script>
        <script src="plugins/slimscroll/jquery.slimscroll.min.js"></script>
        <script src="plugins/parsley/dist/parsley.js"></script>
        <script src="js/recovery.js"></script>
	</body>
</html>