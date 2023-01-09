<head>
    <title> User Page </title>
    <!--Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

</head>
<body onload ="initialize()">
    <div id="navbar"></div>
	
    <div class="container">
        <div class="row mb-3 mt-5">
            <div class="col-1"></div>
            <div class="col-2">
                <button type="button" class="btn btn-primary" onclick ="activateSearch()">Search Books</button>
            </div>
            <div class="col-2"></div>
            <div class="col-2">
                <button type="button" class="btn btn-primary" onclick ="displayBorrowedBooks()">Borrowed Books</button>
            </div>
            <div class="col-2"></div>
            <div class="col-2">
                <button type="button" class="btn btn-primary" onclick ="displayActivityHistory()">History</button>
            </div>
            <div class="col-1"></div>
        </div>
        <div id="formBlock"></div>
        <div id="result"></div>
    </div>

    <script src="/script/nav.js"></script>
    <script src="../../script/form.js"></script>
    <script src="../../script/user.js"></script>
</body>     