<html>
	<head>
		<title> Sign Up Page </title>
	</head>
	
	<body>	
        <h1>User Sign Up</h1>	
    <!--<p> By <font size="5"> <strong> CCC team </strong> </font></p>-->
    <hr>
    <!-- Sign In -->
    <form  action=addReader.php method="post">
        <div>
            <label><font size="3"> <strong>ID :</strong> </font></label>
            <input type="text" name="Reader_ID" />
        </div><br/>
        <div>
            <label><font size="3"> <strong>Name :</strong> </font></label>
            <input type="text" name="Name" />
        </div><br/>
        <div>
            <label><font size="3"> <strong>Password :</strong> </font></label>
            <input type="password" name="Password1"><br/>
        </div><br/>
        <div>
            <label><font size="3"> <strong>check Password :</strong> </font></label>
            <input type="password" name="Password2"><br/>
        </div><br/>
        <!-- submit -->
        <div>
            <input type="submit" value="Send">
        </div>
    </form>
	</body>	
</html>
