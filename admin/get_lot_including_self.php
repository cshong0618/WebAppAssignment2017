<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/db/database.php");

    if($_SERVER["REQUEST_METHOD"] === "GET"){
        $sesame = connect_db();
        $floor_id = $_GET["fid"];
        $tenant_id = $_GET["tid"];
        $lots_arr = select_into_simple_array("lot_id", "lot_number", $sesame, "LOT_FROM_CURRENT_FLOOR_INCLUDE_SELF", $floor_id, $tenant_id);
        $ret = json_encode($lots_arr);
        $sesame->close();
        echo $ret;
    }
?>
