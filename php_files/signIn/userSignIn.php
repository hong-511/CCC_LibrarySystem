<html>
	<head>
		<title> Sign In Page </title>
        <!--Bootstrap-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

	</head>
	
	<body onload="checkLoginStatus()">
        <div id="navbar"></div>
        <div class="container">
            <div class="row mb-5 mt-3">
                <div class="col"></div>
                <div class="col">
                    <h1>User Sign In</h1>
                </div>
                <div class="col"></div>
            </div>
            <br>
            <!-- Sign In -->
            <form  action=userIn.php method="post" id="loginForm"></form>

            <div class="row">
                <div class="col"></div>
                <div class="col">
                    <form  action=modifyPasswordPage.php method="post">
                        <label>Forget the password?</label>
                        <input type="submit" class="btn btn-danger" value="Modify">
                    </form>
                </div>
                <div class="col"></div>
            </div>
        </div>
        
        <script src="/script/nav.js"></script>
        <script src="../script/form.js"></script>
        <script src="../script/user.js"></script>
	</body>	
</html>