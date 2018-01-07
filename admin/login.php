<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/commons/tables.php");
    include("{$_SERVER['DOCUMENT_ROOT']}/commons/forms.php");
    include("{$_SERVER['DOCUMENT_ROOT']}/db/database.php");

    $username = $password = "";
    $login_error = "";

    if($_SERVER["REQUEST_METHOD"] === "POST") {
        $username = $_POST["username"];
        $password = $_POST["password"];

        if ($username == "admin" && $password == "admin") {
            $_SESSION['id'] = md5("admin");
            header("Location: /admin");
        } else {
            $login_error = "Username or password wrong.";
        }
    }
?>

<body >
<div class="div_login">
    <a href="/"><img src="/images/csh_logo.jpg" class="mid_logo"></img></a>
    <form id="login_form" method="post" class="form-form">
        <table class="form-table">
            <tr>
                <td>
                    <label for="username">Username: </label>
                </td>
                <td>
                    <input type="text" name="username" id="username" value=""></input>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="error_message" id="username_error"></div>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="password">Password: </label>
                </td>
                <td>
                    <input type="password" name="password" id="password" value=""></input>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="error_message" id="password_error"></div>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <button class="form_button" type="button" id="form_button">LOGIN</button>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="error_message"><?= $login_error ?></div>
                </td>
            </tr>
        </table>
    </form>
</div>


<script src="/commons/cshjs.js"> </script>
<script src="/admin/login.js"> </script>
</body>
