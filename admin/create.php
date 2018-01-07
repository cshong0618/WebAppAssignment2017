<?php
include("{$_SERVER['DOCUMENT_ROOT']}/commons/tables.php");
include("{$_SERVER['DOCUMENT_ROOT']}/commons/forms.php");
include("{$_SERVER['DOCUMENT_ROOT']}/db/database.php");

$form_title = "Create new tenant";
$default_button = "<button type=\"button\" name=\"create\" id=\"default_button\">CREATE</button>";

$error = "";

$category = [];
$floor = [];
$lot_number = [];

    if($_SERVER['REQUEST_METHOD'] == "POST") {
        var_dump($_POST);
        if (isset($_POST['category']) && isset($_POST['floor']) && isset($_POST['lot_number']) && isset($_POST['name'])) {
            $lot_number = $_POST['lot_number'];
            $name = $_POST['name'];
            if($lot_number == -1) {
                // No more lots to put
                $error .= "No more lots available";
            } else if ($name == ""){
                // Name is empty
                $error .= "Name cannot be empty";
            } else {
                // Success
                $category_id = $_POST['category'];
                $floor_id = $_POST['floor'];

                // Start DB
                $db = connect_db();

                // Create
                exec_query($db, "ADD_TENANT", $name, $category_id, $lot_number);

                // Close
                $db->close();
                header("Location: /admin");
            }
        }
    } else if ($_SERVER['REQUEST_METHOD'] == "GET") {
        // Populate category, floor and lot
        $db = connect_db();
        $category = select_into_simple_array("category_id", "category_name",$db, "ALL_CATEGORY");
        $floor = select_into_simple_array("floor_id", "floor_name", $db, "ALL_FLOORS");

        // Default current floor to 1
        $lot_number = select_into_simple_array("lot_id", "lot_number", $db, "LOT_FROM_CURRENT_FLOOR", 1);
        $db->close();
    }
?>
<!DOCTYPE html>

<head>
    <title> Create new tenant </title>
    <link rel="stylesheet" href="css/main_page.css">
    <link rel="stylesheet" href="/css/table.css">
    <link rel="stylesheet" href="/css/forms.css">
</head>
<body>
    <div id="main-content">
        <?php include("tenant_form.php"); ?>
        <div id="error_message" class="error_message"><?= isset($error) ? $error : "" ?> </div>
    </div>
    <script src="tenant_form.js"></script>

</body>
</html>
