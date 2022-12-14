<html>
	<head>
		<title> Admin Sign In</title>
        <!--Bootstrap-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

	</head>
	
	<body onload="loadAdminLoginForm()">	
        	
        <div class="container">
            <div class="row mb-5 mt-3">
                <div class="col"></div>
                <div class="col">
                    <h1>Admin Sign In</h1>
                </div>
                <div class="col"></div>
            </div>
            <br>
            <!--Sign In -->
            <form  action=adminIn.php method="post"  id="loginForm"></form>
        </div>
        <script src="../script/form.js"></script>
        <script src="../script/admin.js"></script>
	</body>	
</html>