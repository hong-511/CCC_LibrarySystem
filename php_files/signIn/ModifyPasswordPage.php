<html>
	<head>
		<title> Modify Password</title>
        <!--Bootstrap-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

	</head>
	
	<body onload="loadPwdForm()">
        <div class="container">
            <div class="row">
                <div class="col-3"></div>
                <div class="col">
                    <h1>Modify Password</h1>
                </div>
                <div class="col-3"></div>
            </div>
            <!-- Forget password -->
            <form  action=ModifyPassword.php method="post" id="pwdEditForm"></form>
        </div>
        	
    <hr>
        <div>
            <label>If you haven't sign up, don't type anything and click Modify.<br/>
                We will bring you to the User Sign Up Page.</label>
        </div>
        <script src="../script/form.js"></script>
        <script src="../script/password.js"></script>
	</body>	
</html>