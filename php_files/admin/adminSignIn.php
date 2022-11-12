<html>
	<head>
		<title> Admin Sign In Page </title>
	</head>
	
	<body>	
        <h1>Admin Sign In</h1>	
    <!--<p> By <font size="5"> <strong> CCC team </strong> </font></p>-->
    <hr>
    <!-- Sign In -->
    <form  action=adminIn.php method="post">
        <div>
            <label><font size="3"> <strong>ID :</strong> </font></label>
            <input type="text" name="id" />
        </div><br/>
        
        <div>
            <label><font size="3"> <strong>Password :</strong> </font></label>
            <input type="password" name="password"><br/>
        </div><br/>
        <!-- submit -->
        <div>
            <input type="submit" value="Send">
        </div>
    </form>
	</body>	
</html>