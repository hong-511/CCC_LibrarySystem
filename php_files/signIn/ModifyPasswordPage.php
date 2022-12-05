<html>
	<head>
		<title> Modify Password Page </title>
	</head>
	
	<body>	
        <h1>Modify Password here</h1>	
    <!--<p> By <font size="5"> <strong> CCC team </strong> </font></p>-->
    <hr>
    <!-- Forget password -->
    <form  action=ModifyPassword.php method="post">
        <!-- check -->
        <div>
            <label><font size="3"> <strong>ID :</strong> </font></label>
            <input type="text" name="Reader_ID" />
        </div><br/>    

        <div>
            <label><font size="3"> <strong>Name :</strong> </font></label>
            <input type="text" name="UserName" />
        </div><br/> 

        <div>
            <label><font size="3"> <strong>NewPassword :</strong> </font></label>
            <input type="password" name="NewPassword" />
        </div><br/> 

        <div>
            <label><font size="3"> <strong>check NewPassword :</strong> </font></label>
            <input type="password" name="checkedNewPassword" />
        </div><br/> 
        <!-- submit -->
        <div>
            <input type="submit" value="Modify"><br/><br/>
        </div>
    </form>
    <hr>
        <div>
            <label><font size="3"> <strong>If you haven't sign up, don't type anything and click Modify.<br/>
                We will bring you to the User Sign Up Page.</strong> </font></label>
        </div><br/> 
	</body>	
</html>