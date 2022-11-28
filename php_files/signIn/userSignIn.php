<html>
	<head>
		<title> Sign In Page </title>
	</head>
	
	<body>	
        <h1>User Sign In</h1>	
    <!--<p> By <font size="5"> <strong> CCC team </strong> </font></p>-->
    <hr>
    <!-- Sign In -->
    <form  action=userIn.php method="post">
        <div>
            <label><font size="3"> <strong>ID :</strong> </font></label>
            <input type="text" name="Reader_ID" />
        </div><br/>
        
        <div>
            <label><font size="3"> <strong>Password :</strong> </font></label>
            <input type="password" name="Password"><br/>
        </div><br/>
        <!-- submit -->
        <div>
            <input type="submit" value="Send"><br/><br/>
        </div>
    </form>

    <form  action=modifyPasswordPage.php method="post">
        <div>
            <label><font size="3"> <strong>Forget the password?</strong> </font></label><br/>
            <input type="submit" value="Modify">
        </div>
    </form>
	</body>	
</html>