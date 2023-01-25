<html>
	<head>
		<title> Database System Admin Page </title>
        <!--Bootstrap-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

	</head>
	
	<body onload="adminPageInitialize()">
        <div id="navbar"></div>
	
        <div class="container">
            <div class="row mb-5 mt-3">
                <div class="col"></div>
                <div class="col">
                    <h1>Admin Page</h1>
                </div>
                <div class="col"></div>
            </div>
            <div class="row mb-3 mt-5">
                <div class="col-1"></div>
                <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                    <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked>
                    <label class="btn btn-outline-success" for="btnradio1" onclick ="loadSearchForm()">Search books</label>

                    <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
                    <label class="btn btn-outline-success" for="btnradio2" onclick ="loadInsertForm()">Insert books</label>

                    <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off">
                    <label class="btn btn-outline-success" for="btnradio3" onclick ="loadUpdateForm()">Update book data</label>

                    <input type="radio" class="btn-check" name="btnradio" id="btnradio4" autocomplete="off">
                    <label class="btn btn-outline-success" for="btnradio4" onclick ="loadDeleteForm()">Delete books</label>
                </div>
                <div class="col-1"></div>
            </div>
            <div id="formBlock"></div>
            <div id="result"></div>
        </div>

        <script src="/script/nav.js"></script>
        <script src="/script/form.js"></script>
        <script src="/script/page.js"></script>
        <script src="/script/admin.js"></script>
	</body>	
</html>