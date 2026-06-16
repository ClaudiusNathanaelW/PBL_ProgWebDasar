<!DOCTYPE html>
<html>
<head>
    <title>MovieDB - Admin Homepage</title>
    <link rel="stylesheet" type="text/css" href="../../assets/css/style.css" />
    <script type="text/javascript" src="../../assets/js/script.js"></script>
</head>
<body>

    <div id="navbar">
        <div id="nav-left">
            <a href="index.php" class="back-btn" style="text-decoration: none; color: #222; font-size: 24px; font-weight: bold;">MovieDB</a>
        </div>
        
        <div id="nav-center">
            <input type="text" id="search-bar" placeholder="Search Movies">
        </div>
        
        <div id="nav-right">
            <input type="button" value="Login" id="btn-login">
            <div id="user-avatar" onclick="window.location.href='profile.php'">
                <img src="../../assets/img_misc/avatar_placeholder.png" alt="Admin Avatar">
            </div>
        </div>
        
        <br style="clear: both;" />
    </div>

    <div id="main-container">