<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/db/database.php");
    include("{$_SERVER['DOCUMENT_ROOT']}/commons/list.php");

    if($_SERVER['REQUEST_METHOD'] == 'GET') {
        // Default = By zone
        $db = connect_db();
        $tenants = select($db, "SELECT_TENANT_BY_ZONE");
        $tenant_list = [];
        foreach($tenants as $item) {
            $title = "<h2>" . $item['zone_name'] . "</h2>";
            $value = <<<DIV
<a href="javascript:void(0)" onclick="showdiv('tenant-{$item['id']}')"><h3>{$item['name']}</h3></a>
<div style="display:none" id="tenant-{$item['id']}" class="list-item">
    <h5>Floor number: Level {$item['floor_number']}</h5>
    <h5>Lot number: {$item['floor_number']}-{$item['lot_number']}</h5>
    <h5>Zone: {$item['zone_name']} </h5>
    <h5>Category: {$item['category_name']} </h5>
</div>
DIV;
            array_push($tenant_list, ["k" => $title, "value" => $value]);
        }
        $db->close();
    } else if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $q = array_keys($_POST)[0];
        $qarr = [
            'view_by_zone' => "SELECT_TENANT_BY_ZONE",
            'view_by_floor' => "SELECT_TENANT_BY_FLOOR",
            'view_by_category' => "SELECT_TENANT_BY_CATEGORY",
        ];

        $keyname = [
            'view_by_zone' => "zone_name",
            'view_by_floor' => "floor_number",
            'view_by_category' => "category_name",
        ];

        $db = connect_db();
        $tenants = select($db, $qarr[$q]);
        $tenant_list = [];
        foreach($tenants as $item) {
            $title = "<h2>" . $item[$keyname[$q]] . "</h2>";
            $value = <<<DIV
<a href="javascript:void(0)" onclick="showdiv('tenant-{$item['id']}')"><h3>{$item['name']}</h3></a>
<div style="display:none" id="tenant-{$item['id']}" class="list-item">
    <h5>Floor number: Level {$item['floor_number']}</h5>
    <h5>Lot number: {$item['floor_number']}-{$item['lot_number']}</h5>
    <h5>Zone: {$item['zone_name']} </h5>
    <h5>Category: {$item['category_name']} </h5>
</div>
DIV;
            array_push($tenant_list, ["k" => $title, "value" => $value]);
        }
        $db->close();
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title> Main Page </title>
    <script src="/commons/cshjs.js"></script>
    <link rel="stylesheet" href="/css/master.css">
</head>
<body>
    <div id="logo">
        <img src="/images/csh_logo.jpg">
        <p>CSH Mall</p>
        <a href="/admin"> Admin page </a>
    </div>
    <div id="main-content">
        <form method="post">
            <input type="submit" name="view_by_zone" id="button-link" value="View by zone"></input>
            <input type="submit" name="view_by_floor" id="button-link" value="View by floor"></input>
            <input type="submit" name="view_by_category" id="button-link" value="View by category"></input>
        </form>
        <?= create_sublist($tenant_list, "k", "value", 'unordered_list') ?>
    </div>
</body>
</html>
