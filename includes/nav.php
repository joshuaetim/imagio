<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="https://fonts.googleapis.com/css2?family=Jost&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="css/app.css">
        <link rel="stylesheet" href="css/bootstrap.css">
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.js"></script>
        <title><?=$title?></title>
    </head>
    <body>
    <nav class="navbar navbar-expand-sm bg-light navbar-light">
            <!-- Brand/logo -->
            <a class="navbar-brand" href="index">Imagio</a>
            
            <!-- Links -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                <a class="nav-link <?=activeCheck($_SERVER['REQUEST_URI'], 'addimage') ? 'active' : ''?>" href="addimage">Upload Image</a>
                </li>
                <li class="nav-item">
                <a class="nav-link <?=activeCheck($_SERVER['REQUEST_URI'], 'filemanager') ? 'active' : ''?>" href="filemanager">File Manager</a>
                </li>
                <li class="nav-item">
                <a class="nav-link <?=activeCheck($_SERVER['REQUEST_URI'], 'rand') ? 'active' : ''?>" href="#">Random thing</a>
                </li>
                <!-- Dropdown -->
        
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                        Profile
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">My Account</a>
                        <a class="dropdown-item" href="logout">Logout</a>
                    </div>
                </li>
                <form class="form-inline float-right" action="/action_page.php">
                    <input class="form-control mr-sm-2" type="text" placeholder="Search Images">
                    <button class="btn btn-warning" type="submit">Search</button>
                </form>
            </ul>
            
        </nav>