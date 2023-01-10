<head>
    <title> User Page </title>
    <!--Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

</head>
<body onload ="initialize()">
    <div id="navbar"></div>
	
    <div class="container">
        <div class="row mb-3 mt-2">
            <div class="col-9"></div>
            <div class="col">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="username"></button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#" onclick="logout()">Logout</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-1"></div>
        </div>
        <div class="row mb-3 mt-5">
            <div class="col-1"></div>
            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked>
                <label class="btn btn-outline-primary" for="btnradio1" onclick ="activateSearch()">Search Books</label>

                <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
                <label class="btn btn-outline-primary" for="btnradio2" onclick ="displayBorrowedBooks()">Borrowed Books</label>

                <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off">
                <label class="btn btn-outline-primary" for="btnradio3" onclick ="displayActivityHistory()">History</label>
            </div>
            <div class="col-1"></div>
        </div>
        <div id="formBlock"></div>
        <div id="result"></div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="/script/nav.js"></script>
    <script src="../../script/form.js"></script>
    <script src="../../script/user.js"></script>
</body>     