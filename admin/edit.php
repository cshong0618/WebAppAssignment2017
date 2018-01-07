<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/commons/tables.php");
    include("{$_SERVER['DOCUMENT_ROOT']}/commons/forms.php");
    include("{$_SERVER['DOCUMENT_ROOT']}/db/database.php");

    $form_id = "edit_form";

    $id;
    $name;
    $category_default;
    $floor_default;
    $lot_number_default;

    $default_button = "<button type=\"submit\" name=\"edit\" id=\"default_button\">EDIT</button>";
    $delete_button = "<button type=\"submit\" name=\"delete\" id=\"delete_button\">DELETE</button>";
    $form_title = "Edit tenant";

    $category = [];
    $floor = [];
    $lot_number = [];

    if($_SERVER['REQUEST_METHOD'] == "GET") {
        // Get the ID that we want to use
        $id = $_GET['id'];

        // Connect to DB
        $db = connect_db();

        // Get our data
        $tenant = select($db, "DB_EDIT_TENANT", $id)[0];

        $category_default = $tenant['category_id'];
        $floor_default = $tenant['floor_id'];
        $lot_number_default = $tenant['lot_id'];

        // Get category
        $category = select_into_simple_array("category_id", "category_name",$db, "ALL_CATEGORY");

        // Get floor
        $floor = select_into_simple_array("floor_id", "floor_name", $db, "ALL_FLOORS");

        //
        //$lot_number = select_into_simple_array("lot_id", "lot_number", $db, "LOT_FROM_CURRENT_FLOOR", $floor_default);
        $lot_number = select_into_simple_array("lot_id", "lot_number", $db, "LOT_FROM_CURRENT_FLOOR_INCLUDE_SELF", $floor_default, $tenant['id']);
        $name = $tenant['name'];

        $db->close();
    } if ($_SERVER['REQUEST_METHOD'] == "POST") {

        if(isset($_POST['edit'])) {
            // Populate all, can just use to populate into form too.
            $id = $_POST['id'];
            $name = $_POST['name'];
            $category_default = $_POST['category'];
            $floor_default = $_POST['floor'];
            $lot_number_default = $_POST['lot_number'];

            $db = connect_db();
            if($name != "") {
                // Proceed
                exec_query($db, "EDIT_TENANT", $name, $category_default, $lot_number_default, $id);
                $db->close();
                header("Location: /admin");
            } else {
                // Get category
                $category = select_into_simple_array("category_id", "category_name",$db, "ALL_CATEGORY");

                // Get floor
                $floor = select_into_simple_array("floor_id", "floor_name", $db, "ALL_FLOORS");

                //
                //$lot_number = select_into_simple_array("lot_id", "lot_number", $db, "LOT_FROM_CURRENT_FLOOR", $floor_default);
                $lot_number = select_into_simple_array("lot_id", "lot_number", $db, "LOT_FROM_CURRENT_FLOOR_INCLUDE_SELF", $floor_default, $id);
                $db->close();
            }
        } else if (isset($_POST['delete'])) {
            $id = $_POST['id'];
            // Delete the tenant
            $db = connect_db();
            exec_query($db, "DELETE_TENANT", $id);
            $db->close();
            header("Location: /admin");
        }
    }
 ?>
 <!DOCTYPE html>
 <head>
     <title> Edit tenant details </title>
     <link rel="stylesheet" href="css/main_page.css">
     <link rel="stylesheet" href="/css/table.css">
     <link rel="stylesheet" href="/css/forms.css">
     <script>
        default_lot = <?= isset($lot_number_default) ? $lot_number_default : -1 ?>;
     </script>
 </head>
 <body>
     <div id="main-content">
         <?php include("tenant_form.php"); ?>
         <div id="error_message" class="error_message"><?= isset($error) ? $error : "" ?> </div>
     </div>
     <script src="edit.js"></script>
 </body>
 </html>
