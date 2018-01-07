<?php
    session_start();

    $css_pages = [
        "login" => "/admin/css/login.css",
        "main_page" => "/admin/css/main_page.css"
    ];

    function set_css($type) {
        global $css_pages;
        return <<<CSS
<link rel="stylesheet" href="$css_pages[$type]">

CSS;
    }

    $current_page = "";
    $title = "";
    if(isset($_SESSION['id'])) {
        if($_SESSION['id'] == md5('admin')) {
            $current_page = "admin.php";
            $title = "Admin page";
            $current_css = set_css("main_page");
        }
    } else {
        $current_page = "login.php";
        $title = "Admin login";
        $current_css = set_css("login");
    }
 ?>
 <!DOCTYPE html>
 <html>
<head>
    <title><?= $title ?></title>
    <?= $current_css ?>
    <script src="/commons/cshjs.js"></script>
</head>
<?php include($current_page); ?>
</html>