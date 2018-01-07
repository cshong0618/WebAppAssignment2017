<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/commons/tables.php");
    include("{$_SERVER['DOCUMENT_ROOT']}/commons/forms.php");
    include("{$_SERVER['DOCUMENT_ROOT']}/db/database.php");

    $tenants_data = [];
    $tb_head = ["Shop ID","Name","Category", "Floor", "Lot Number"];
    $errors;
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if(isset($_POST['logout_button'])) {
            session_destroy();
            header("Location: /admin");
        }
    } else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $db = connect_db();
        if($db->connect_errno) {
            $errors = "Failed to connect to database";
        } else {
            $tenants_data = select($db, "DB_SELECT_TENANTS");
            //$tenants_data = $db->query($queries['DB_SELECT_TENANTS']);

            // Change name to edit data
            for($i = 0; $i < sizeof($tenants_data); $i++) {
                $tenants_data[$i]['name'] = "<a href=\"/admin/edit.php?id={$tenants_data[$i]['id']}\">{$tenants_data[$i]['name']}</a>";
            }
            $db->close();
        }
    }
 ?>
 <body>
     <link rel="stylesheet" href="/css/table.css">
     <div id="top-right">
         <form method="post">
             <button name="logout_button" id="logout_button" type="submit">LOGOUT</button>
         </form>
     </div>
     <div id="top-left">
         <a href="/"><img src="/images/csh_logo.jpg" class="mid_logo"></img><br>HOMEPAGE</a>
     </div>
     <div id="main-content">
         <div class="error-message" id="error-message">
             <?= isset($errors) ? $errors : "" ?>
         </div>
             Search: <input type="text" onkeyup="javascript:filter_table('tenants_table', this.value, 1, 1)"></input>
         <br>
             <a href="/admin/create.php">ADD NEW SHOP</a>
             <?= create_table("tenants_table",
                              $tenants_data,
                              $tb_head,
                              "Tenants"); ?>
     </div>
     <script src="/commons/cshjs.js"></script>
     <script src="/commons/table.js"></script>
 </body>
