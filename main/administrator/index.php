<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Set session timeout period in seconds
$timeout_duration = 1800; // 30 minutes

// Check if the user is logged in and has the 'admin' role
if (!isset($_SESSION['username']) || $_SESSION['role'] != '1') {
    // Redirect to login page if not logged in or not an admin
    header('Location: ../index.php');
    exit();
}

// Check if the timeout period has passed
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $timeout_duration) {
    session_unset();
    session_destroy();
    header('Location: ../index.php'); // Redirect to login page after timeout
    exit();
}

$_SESSION['last_activity'] = time(); // Update last activity time

if (!isset($_SESSION['emp'])) {
    $_SESSION['emp'] = 'Unknown'; // Handle missing EmployeeID
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WELCOME TO CHEKKEN</title>



    <link rel="shortcut icon" href="./assets/compiled/svg/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACEAAAAiCAYAAADRcLDBAAAEs2lUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4KPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iWE1QIENvcmUgNS41LjAiPgogPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4KICA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIgogICAgeG1sbnM6ZXhpZj0iaHR0cDovL25zLmFkb2JlLmNvbS9leGlmLzEuMC8iCiAgICB4bWxuczp0aWZmPSJodHRwOi8vbnMuYWRvYmUuY29tL3RpZmYvMS4wLyIKICAgIHhtbG5zOnBob3Rvc2hvcD0iaHR0cDovL25zLmFkb2JlLmNvbS9waG90b3Nob3AvMS4wLyIKICAgIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIKICAgIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIgogICAgeG1sbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIKICAgZXhpZjpQaXhlbFhEaW1lbnNpb249IjMzIgogICBleGlmOlBpeGVsWURpbWVuc2lvbj0iMzQiCiAgIGV4aWY6Q29sb3JTcGFjZT0iMSIKICAgdGlmZjpJbWFnZVdpZHRoPSIzMyIKICAgdGlmZjpJbWFnZUxlbmd0aD0iMzQiCiAgIHRpZmY6UmVzb2x1dGlvblVuaXQ9IjIiCiAgIHRpZmY6WFJlc29sdXRpb249Ijk2LjAiCiAgIHRpZmY6WVJlc29sdXRpb249Ijk2LjAiCiAgIHBob3Rvc2hvcDpDb2xvck1vZGU9IjMiCiAgIHBob3Rvc2hvcDpJQ0NQcm9maWxlPSJzUkdCIElFQzYxOTY2LTIuMSIKICAgeG1wOk1vZGlmeURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiCiAgIHhtcDpNZXRhZGF0YURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiPgogICA8eG1wTU06SGlzdG9yeT4KICAgIDxyZGY6U2VxPgogICAgIDxyZGY6bGkKICAgICAgc3RFdnQ6YWN0aW9uPSJwcm9kdWNlZCIKICAgICAgc3RFdnQ6c29mdHdhcmVBZ2VudD0iQWZmaW5pdHkgRGVzaWduZXIgMS4xMC4xIgogICAgICBzdEV2dDp3aGVuPSIyMDIyLTAzLTMxVDEwOjUwOjIzKzAyOjAwIi8+CiAgICA8L3JkZjpTZXE+CiAgIDwveG1wTU06SGlzdG9yeT4KICA8L3JkZjpEZXNjcmlwdGlvbj4KIDwvcmRmOlJERj4KPC94OnhtcG1ldGE+Cjw/eHBhY2tldCBlbmQ9InIiPz5V57uAAAABgmlDQ1BzUkdCIElFQzYxOTY2LTIuMQAAKJF1kc8rRFEUxz9maORHo1hYKC9hISNGTWwsRn4VFmOUX5uZZ36oeTOv954kW2WrKLHxa8FfwFZZK0WkZClrYoOe87ypmWTO7dzzud97z+nec8ETzaiaWd4NWtYyIiNhZWZ2TvE946WZSjqoj6mmPjE1HKWkfdxR5sSbgFOr9Ll/rXoxYapQVik8oOqGJTwqPL5i6Q5vCzeo6dii8KlwpyEXFL519LjLLw6nXP5y2IhGBsFTJ6ykijhexGra0ITl5bRqmWU1fx/nJTWJ7PSUxBbxJkwijBBGYYwhBgnRQ7/MIQIE6ZIVJfK7f/MnyUmuKrPOKgZLpEhj0SnqslRPSEyKnpCRYdXp/9++msneoFu9JgwVT7b91ga+LfjetO3PQ9v+PgLvI1xkC/m5A+h7F32zoLXug38dzi4LWnwHzjeg8UGPGbFfySvuSSbh9QRqZ6H+Gqrm3Z7l9zm+h+iafNUV7O5Bu5z3L/wAdthn7QIme0YAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAJTSURBVFiF7Zi9axRBGIefEw2IdxFBRQsLWUTBaywSK4ubdSGVIY1Y6HZql8ZKCGIqwX/AYLmCgVQKfiDn7jZeEQMWfsSAHAiKqPiB5mIgELWYOW5vzc3O7niHhT/YZvY37/swM/vOzJbIqVq9uQ04CYwCI8AhYAlYAB4Dc7HnrOSJWcoJcBS4ARzQ2F4BZ2LPmTeNuykHwEWgkQGAet9QfiMZjUSt3hwD7psGTWgs9pwH1hC1enMYeA7sKwDxBqjGnvNdZzKZjqmCAKh+U1kmEwi3IEBbIsugnY5avTkEtIAtFhBrQCX2nLVehqyRqFoCAAwBh3WGLAhbgCRIYYinwLolwLqKUwwi9pxV4KUlxKKKUwxC6ZElRCPLYAJxGfhSEOCz6m8HEXvOB2CyIMSk6m8HoXQTmMkJcA2YNTHm3congOvATo3tE3A29pxbpnFzQSiQPcB55IFmFNgFfEQeahaAGZMpsIJIAZWAHcDX2HN+2cT6r39GxmvC9aPNwH5gO1BOPFuBVWAZue0vA9+A12EgjPadnhCuH1WAE8ivYAQ4ohKaagV4gvxi5oG7YSA2vApsCOH60WngKrA3R9IsvQUuhIGY00K4flQG7gHH/mLytB4C42EgfrQb0mV7us8AAMeBS8mGNMR4nwHamtBB7B4QRNdaS0M8GxDEog7iyoAguvJ0QYSBuAOcAt71Kfl7wA8DcTvZ2KtOlJEr+ByyQtqqhTyHTIeB+ONeqi3brh+VgIN0fohUgWGggizZFTplu12yW8iy/YLOGWMpDMTPXnl+Az9vj2HERYqPAAAAAElFTkSuQmCC" type="image/png">
    <link rel="stylesheet" href="assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css">

    <link rel="stylesheet" href="assets/extensions/flatpickr/flatpickr.min.css">
    <link rel="stylesheet" href="./assets/compiled/css/table-datatable-jquery.css">
    <link rel="stylesheet" href="./assets/compiled/css/app.css">
    <link rel="stylesheet" href="./assets/compiled/css/app-dark.css">
    <link rel="stylesheet" href="./assets/extensions/@fortawesome/fontawesome-free/css/all.min.css">

    <style>
        .spinner {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1000;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: rgba(0, 0, 0, 1.0);
            width: 100%;
            height: 100%;
        }

        #button-group {
            margin-bottom: 1rem;
        }

        #button-group .btn {
            margin-right: 0.5rem;
            margin-bottom: 0.5rem;
        }
    </style>
</head>

<body>

    <script src="assets/static/js/initTheme.js"></script>
    <div id="app">
        <div id="sidebar">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header position-relative">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="logo">
                            chekken
                        </div>
                        <div class="theme-toggle d-flex gap-2  align-items-center mt-2">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--system-uicons" width="20" height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 21 21">
                                <g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M10.5 14.5c2.219 0 4-1.763 4-3.982a4.003 4.003 0 0 0-4-4.018c-2.219 0-4 1.781-4 4c0 2.219 1.781 4 4 4zM4.136 4.136L5.55 5.55m9.9 9.9l1.414 1.414M1.5 10.5h2m14 0h2M4.135 16.863L5.55 15.45m9.899-9.9l1.414-1.415M10.5 19.5v-2m0-14v-2" opacity=".3"></path>
                                    <g transform="translate(-210 -1)">
                                        <path d="M220.5 2.5v2m6.5.5l-1.5 1.5"></path>
                                        <circle cx="220.5" cy="11.5" r="4"></circle>
                                        <path d="m214 5l1.5 1.5m5 14v-2m6.5-.5l-1.5-1.5M214 18l1.5-1.5m-4-5h2m14 0h2"></path>
                                    </g>
                                </g>
                            </svg>
                            <div class="form-check form-switch fs-6">
                                <input class="form-check-input  me-0" type="checkbox" id="toggle-dark" style="cursor: pointer">
                                <label class="form-check-label"></label>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--mdi" width="20" height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                                <path fill="currentColor" d="m17.75 4.09l-2.53 1.94l.91 3.06l-2.63-1.81l-2.63 1.81l.91-3.06l-2.53-1.94L12.44 4l1.06-3l1.06 3l3.19.09m3.5 6.91l-1.64 1.25l.59 1.98l-1.7-1.17l-1.7 1.17l.59-1.98L15.75 11l2.06-.05L18.5 9l.69 1.95l2.06.05m-2.28 4.95c.83-.08 1.72 1.1 1.19 1.85c-.32.45-.66.87-1.08 1.27C15.17 23 8.84 23 4.94 19.07c-3.91-3.9-3.91-10.24 0-14.14c.4-.4.82-.76 1.27-1.08c.75-.53 1.93.36 1.85 1.19c-.27 2.86.69 5.83 2.89 8.02a9.96 9.96 0 0 0 8.02 2.89m-1.64 2.02a12.08 12.08 0 0 1-7.8-3.47c-2.17-2.19-3.33-5-3.49-7.82c-2.81 3.14-2.7 7.96.31 10.98c3.02 3.01 7.84 3.12 10.98.31Z">
                                </path>
                            </svg>
                        </div>
                        <div class="sidebar-toggler  x">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>

                </div>

                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>

                        <li class="sidebar-item  ">
                            <a href="index.php" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-item  ">
                            <a href="events.php" class='sidebar-link'>
                                <svg class="bi" width="1em" height="1em" fill="currentColor">
                                    <use xlink:href="assets/static/images/bootstrap-icons.svg#calendar-event-fill"></use>
                                </svg>
                                <span>Events</span>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
        <div id="main">
            <header>
                <nav class="navbar navbar-expand navbar-light navbar-top">
                    <div class="container-fluid">



                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto mb-lg-0">




                                <div class="dropdown">
                                    <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                        <div class="user-menu d-flex">
                                            <div class="user-name text-end me-3">
                                            <h6  id="employeeName" class="mb-0 text-gray-600">Name</h6>

<p id="employeeRole" class="mb-0 text-sm text-gray-600">Role</p>
                                            </div>
                                            <div class="user-img d-flex align-items-center">
                                                <div class="avatar avatar-md">
                                                    <img src="./assets/compiled/jpg/1.jpg">
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton" style="min-width: 11rem;">
                                        <li>
                                            <h6 class="dropdown-header">Hello, John!</h6>
                                        </li>
                                        <li><a class="dropdown-item" href="#"><i class="icon-mid bi bi-person me-2"></i> My
                                                Profile</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="icon-mid bi bi-gear me-2"></i>
                                                Settings</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="icon-mid bi bi-wallet me-2"></i>
                                                Wallet</a></li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item" href="logout.php"><i class="icon-mid bi bi-box-arrow-left me-2"></i> Logout</a></li>
                                    </ul>
                                </div>
                        </div>
                    </div>
                </nav>
            </header>
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">





                <div class="page-title">
                    <div class="row">

                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Cashier Screen</h3>
                            <p class="text-subtitle text-muted"></p>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Cashier Screen</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="card col-4">
                    <div class="card-body">
                        <div class="card-title">

                            <p class="h3">
                                <span class="fa-fw select-all fas">

                                </span> Money on Hand: <span id="totalAmount">0.00</span> PHP</p>
                        </div>

                        <div id="button-group">
                            <button type="button" class="col-md-6  btn btn-lg btn-success"><span class="fa-fw select-all fas"></span> View Summary</button>
                            <button type="button" class="col-md-5  btn btn-lg btn-success" data-bs-toggle="modal" data-bs-target="#inlineForm"><span class="fa-fw select-all fas"></span> Cash In</button>
                            <button type="button" class="col-md-6  btn btn-lg btn-success"><span class="fa-fw select-all fas"></span> Tranfer Fund</button>
                            <button type="button" class="col-md-5  btn btn-lg btn-success"><span class="fa-fw select-all fas"></span> Cash Out</button>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div id="spinner" class="spinner">
                        <img src="./assets/compiled/svg/grid.svg" class="me-4" style="width: 3rem" alt="audio">
                    </div>
                    <div class="card-body">

                        <ul class="nav nav-tabs" id="myTab" role="tablist">

                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Watch Screen</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">BET</a>
                            </li>

                        </ul>
                        <hr>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="row match-height">

                                </div>
                                <div class="row match-height">
                                    <div class="col-12">
                                        <div class="card-group">
                                            <div class="card">
                                                <div class="card-content">

                                                    <div class="card-body">
                                                        <h2 class="card-title text-center">MERON</h2>
                                                        <p class="card-text text-center bg-primary rounded display-6 ">
                                                            Sample
                                                        </p>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-content">

                                                    <div class="card-body">
                                                        <h2 class="card-title text-center">DRAW</h2>
                                                        <p class="card-text text-center bg-success rounded display-6 ">
                                                            Sample
                                                        </p>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class=" card">
                                                <div class="card-content">

                                                    <div class="card-body">
                                                        <h2 class="card-title text-center">WALA</h2>
                                                        <p class="card-text text-center bg-danger rounded display-6 ">
                                                            Sample
                                                        </p>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="row">
                                    <div class="col-sm-7">
                                        <div class="card border border-primary">
                                            <div class="card-body">
                                                <div class="row justify-content-between">
                                                    <h5 class="card-title">Minimum Bet : 100</h5>
                                                    <div class="col-5">
                                                        <div class="input-group mb-3">
                                                            <input type="text" id="customBet" class="form-control" placeholder="Custom Bet" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                                            <span class="input-group-text" id="basic-addon2">PHP</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-7">

                                                        <div class="card border border-primary">

                                                            <div class="card-body text-center">


                                                                <div id="button-group">
                                                                    <button type="button" class="col-md-3  btn btn-lg btn-success" onclick="setBetValue(100)">100</button>
                                                                    <button type="button" class="col-md-3  btn btn-lg btn-success" onclick="setBetValue(200)">200</button>
                                                                    <button type="button" class="col-md-3  btn btn-lg btn-success" onclick="setBetValue(300)">300</button>
                                                                    <button type="button" class="col-md-3  btn btn-lg btn-success" onclick="setBetValue(400)">400</button>
                                                                    <button type="button" class="col-md-3  btn btn-lg btn-success" onclick="setBetValue(500)">500</button>
                                                                    <button type="button" class="col-md-3  btn btn-lg btn-success" onclick="setBetValue(600)">600</button>
                                                                    <button type="button" class="col-md-3  btn btn-lg btn-success" onclick="setBetValue(700)">700</button>
                                                                    <button type="button" class="col-md-3  btn btn-lg btn-success" onclick="setBetValue(800)">800</button>
                                                                    <button type="button" class="col-md-3  btn btn-lg btn-success" onclick="setBetValue(900)">900</button>
                                                                    <button type="button" class="col-md-3  btn btn-lg btn-success" onclick="setBetValue(1000)">1000</button>
                                                                    <button type="button" class="col-md-3  btn btn-lg btn-success" onclick="setBetValue(2000)">2000</button>
                                                                    <button type="button" class="col-md-3  btn btn-lg btn-success" onclick="setBetValue(3000)">3000</button>
                                                                    <button type="button" class="col-md-3  btn btn-lg btn-success" onclick="setBetValue(4000)">4000</button>
                                                                    <button type="button" class="col-md-3  btn btn-lg btn-success" onclick="setBetValue(5000)">5000</button>
                                                                    <button type="button" class="col-md-3  btn btn-lg btn-success" onclick="setBetValue(6000)">6000</button>
                                                                    <button type="button" class="col-md-3  btn btn-lg btn-success" onclick="setBetValue(7000)">7000</button>
                                                                    <button type="button" class="col-md-3  btn btn-lg btn-success" onclick="setBetValue(8000)">8000</button>
                                                                    <button type="button" class="col-md-3  btn btn-lg btn-success" onclick="setBetValue(9000)">9000</button>
                                                                    <button type="button" class="col-md-3  btn btn-lg btn-danger" onclick="setBetValue(10000)">10000</button>
                                                                    <button type="button" class="col-md-3  btn btn-lg btn-danger" onclick="setBetValue(20000)">20000</button>
                                                                    <button type="button" class="col-md-3  btn btn-lg btn-danger" onclick="setBetValue(50000)">50000</button>
                                                                </div>




                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="card border border-primary text-center">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col">
                                                        <h5 class="card-title">Select Side</h5>
                                                        <div class="row justify-content-around">

                                                        <button class="col-4 btn btn-xl btn-danger" data-bs-toggle="button"  onclick="setSideValue('Meron')">MERON</button>

                                                            <button class="col-4 btn btn-xl btn-primary" data-bs-toggle="button" onclick="setSideValue('Wala')">WALA</button>

                                                        </div>
                                                        <div class="card-body">
                                                        <button class="col-4 btn btn-xl btn-success" data-bs-toggle="button" onclick="setSideValue('Draw')">DRAW</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div clas="col">
                                                        <h3 class="card-title">BET SUMMARY</h3>
                                                        <hr>
                                                        <h4> Event: <span id="displayEvent">0</span></h4>
                                                        <h4> Side:<span id="displaySide">0</span></h4>
                                                        <h4>Amount: <span id="displayAmount">0</span> PHP</h4>
                                                        <h4> Fight #: <span id="displayFight">0</span></h4>
                                                        <h4> Location: <span id="displayLocation"></span></h4>
                                                        <button class="col-4 btn btn-xl btn-primary" >POST BET</button>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>


                <!-- Table for Status -->
                <div class="row">
                    <div class="col-12 col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">
                                    Current Bets:
                                </h5>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table" id="table1">
                                        <thead>
                                            <tr>
                                                <th>Fight #</th>
                                                <th>Bet Type</th>
                                                <th>Side</th>
                                                <th>Amount</th>
                                                <th>Barcode</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Current Status</h4>
                            </div>
                            <div class="card-content">


                                <!-- Table with no outer spacing -->
                                <div class="table-responsive">
                                    <table class="table mb-0 table-lg">
                                        <thead>
                                            <tr>
                                                <th>Status</th>
                                                <th>Betting</th>
                                                <th>Winner</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel33">Cashin Form</h4>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <i data-feather="x"></i>
                                </button>
                            </div>
                            <form action="process_cashin.php" method="post" data-parsley-validate   >
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="employeeID">Employee ID: </label>
                                        <input id="employeeID" name="employeeID" type="text" value="<?php echo htmlspecialchars($_SESSION['emp']); ?>" class="form-control" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="transactionID">Transaction ID: </label>
                                        <input id="transactionID" name="transactionID" type="text" placeholder="" class="form-control" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="amount">Amount: </label>
                                        <input id="amount" name="amount" type="text" placeholder="" class="form-control" data-parsley-required="true">
                                    </div>

                                    <div class="form-group">
                                        <label for="datetime">Date/Time: </label>
                                        <input id="datetime" name="datetime" type="text" placeholder="" class="form-control flatpickr-no-config" data-parsley-required="true">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                        <i class="bx bx-x d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">Close</span>
                                    </button>
                                    <button type="submit" class="btn btn-primary ms-1">
                                        <i class="bx bx-check d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">Save</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!--End Cashin form Modal -->
            </div> <!-- Main Div -->
        </div>
        <!-- End of Table -->

    </div>

    <!-- App Div -->

</body>
<script src="assets/static/js/components/dark.js"></script>
<script src="assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="assets/extensions/jquery/jquery.min.js"></script>
<script src="assets/extensions/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
<script src="assets/static/js/pages/datatables.js"></script>
<script src="assets/extensions/flatpickr/flatpickr.min.js"></script>
<script src="assets/static/js/pages/date-picker.js"></script>
<script src="assets/compiled/js/app.js"></script>
<script src="assets/extensions/parsleyjs/parsley.min.js"></script>
<script src="assets/static/js/pages/parsley.js"></script>

<script>
    var employeeName = "<?php echo $_SESSION['empName'] ?>";
     var employeeRole = "<?php echo $_SESSION['role'] ?>";
     var currentRole = '';
     if(employeeRole == 1){
        currentRole = 'Administartor';
     }else{
        currentRole = 'Cashier';
     }

     $("#employeeName").html(employeeName);
     $("#employeeRole").html(currentRole);
    document.addEventListener('DOMContentLoaded', function() {
        // Generate a randomized 5-digit integer and set it to the input field
        function generateTransactionID() {
            var min = 10000; // Minimum value for a 5-digit integer
            var max = 99999; // Maximum value for a 5-digit integer
            return Math.floor(Math.random() * (max - min + 1)) + min;
        }

        document.getElementById('transactionID').value = generateTransactionID();
    });
    document.addEventListener('DOMContentLoaded', function() {
        fetch('fetch_total.php')
            .then(response => response.json())
            .then(data => {
                document.getElementById('totalAmount').textContent = data.totalAmount;
            })
            .catch(error => console.error('Error fetching total amount:', error));
    });

    window.addEventListener('load', function() {
        setTimeout(function() {
            document.getElementById('spinner').style.display = 'none';
        }, 1000);
    });

    function setBetValue(value) {
        document.getElementById('customBet').value = value;
        document.getElementById('displayAmount').innerText = value;
    }

    function setSideValue(value) {
        document.getElementById('displaySide').innerText = value;
    }

    $("#customBet").keyup(function(event){
        if(event.keyCode == 13){
            document.getElementById('displayAmount').innerText = $("#customBet").val();
        }
    });

</script>


</body>

</html>