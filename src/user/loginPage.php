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
            <div id="userLoginFormBlock"></div>

            <div class="row">
                <div class="col"></div>
                <div class="col-5">
                    <div>Forget the password?
                        <a href="/user/modifyPasswordPage.php" class="btn btn-danger">Modify</a>
                    </div>
                    
                </div>
                <div class="col"></div>
            </div>
            <div id="modalBlock"></div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        <script src="/script/modal.js"></script>
        <script src="/script/nav.js"></script>
        <script src="/script/form.js"></script>
        <script src="/script/user.js"></script>
	</body>	
</html>