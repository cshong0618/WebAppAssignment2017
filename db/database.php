<?php
    function connect_db($hostname="172.16.185.128",
                        $username="shaong",
                        $password="123",
                        $db="uecs2094_tenant")
    {
        $conn = new mysqli($hostname, $username, $password, $db);
        return $conn;
    }


        $queries = [
            "DB_SELECT_TENANTS" => "SELECT t.id, t.name, c.category_name, f.floor_name, l.lot_number FROM tenant AS t, category AS c, floor AS f, lot AS l WHERE t.lot_id = l.lot_id AND t.category_id = c.category_id AND l.floor_id = f.floor_id ORDER BY f.floor_name, l.lot_number",
            "DB_EDIT_TENANT" => "SELECT t.id, t.name, t.category_id, f.floor_id, l.lot_id FROM tenant AS t, lot AS l, floor AS f WHERE t.lot_id = l.lot_id AND l.floor_id = f.floor_id AND t.id = ?",
            "SELECT_ALL" => "SELECT * FROM tenant",
            "ALL_FLOORS" => "SELECT floor_id, floor_name FROM floor",
            "ALL_CATEGORY" => "SELECT * FROM category",
            "LOT_FROM_CURRENT_FLOOR" => "SELECT lot_id, lot_number FROM lot WHERE floor_id=? AND lot_id NOT IN (SELECT lot_id FROM tenant AS `t1`)",
            "LOT_FROM_CURRENT_FLOOR_INCLUDE_SELF" => "SELECT lot_id, lot_number FROM lot WHERE floor_id=? AND lot_id NOT IN (SELECT lot_id FROM tenant WHERE id <> ?)",
            "ADD_TENANT" => "INSERT INTO tenant SET name=?, category_id=?, lot_id=?",
            "DELETE_TENANT" => "DELETE FROM tenant WHERE id = ?",
            "EDIT_TENANT" => "UPDATE tenant SET name=?, category_id=?, lot_id=? WHERE id=?",
            "SELECT_TENANT_BY_ZONE" => "SELECT t.id, t.name, c.category_name, f.floor_number, l.lot_number, z.zone_name FROM tenant AS t, category AS c, lot AS l, floor AS f, zone AS z WHERE t.category_id = c.category_id AND t.lot_id = l.lot_id AND l.floor_id = f.floor_id AND l.zone_id = z.zone_id ORDER BY z.zone_name, f.floor_name, l.lot_number",
            "SELECT_TENANT_BY_FLOOR" => "SELECT t.id, t.name, c.category_name, f.floor_number, l.lot_number, z.zone_name FROM tenant AS t, category AS c, lot AS l, floor AS f, zone AS z WHERE t.category_id = c.category_id AND t.lot_id = l.lot_id AND l.floor_id = f.floor_id AND l.zone_id = z.zone_id ORDER BY f.floor_name, l.lot_number",
            "SELECT_TENANT_BY_CATEGORY" => "SELECT t.id, t.name, c.category_name, f.floor_number, l.lot_number, z.zone_name FROM tenant AS t, category AS c, lot AS l, floor AS f, zone AS z WHERE t.category_id = c.category_id AND t.lot_id = l.lot_id AND l.floor_id = f.floor_id AND l.zone_id = z.zone_id ORDER BY c.category_name, f.floor_name, l.lot_number"
        ];

        $query_types = [
            "DB_EDIT_TENANT" => "i",
            "LOT_FROM_CURRENT_FLOOR" => "i",
            "LOT_FROM_CURRENT_FLOOR_INCLUDE_SELF" =>"ii",
            "ADD_TENANT" => "sii",
            "DELETE_TENANT" => "i",
            "EDIT_TENANT" => "siii"
        ];

        function exec_query($conn, $query_type, ...$args) {
            global $queries;
            global $query_types;
            $q = $queries[$query_type];

            // The whether the number of params are the same
            if(substr_count($q, "?") != sizeof($args)) {
                return null;
            }

            $stmt = $conn->prepare($q);

            // Binding the params in case
            // we do get params
            if(sizeof($args) > 0) {
                $qt = $query_types[$query_type];
                $aa = $args;

                $params = [];
                $params[0] = &$qt;
                foreach ($args as $k => $param) {
                    $params[$k + 1] = &$args[$k];
                }

                //var_dump($params);
                call_user_func_array([$stmt, 'bind_param'], $params);
            }

            // Execute the statement
            $stmt->execute();

            $res = [];

            if(substr($q, 0, 6) == "SELECT") {
                $res = $stmt->get_result();
                $stmt->fetch();
            }
            $stmt->close();
            return $res;
        }

        function select($conn, $query_type, ...$args) {
            $res = exec_query($conn, $query_type, ...$args);

            $ret_arr = [];

            if($res->num_rows > 0) {
                while($row = $res->fetch_assoc()) {
                    array_push($ret_arr, $row);
                }
            }

            return $ret_arr;
        }

        /*
            [
                k => v,
                k => v,
                ...
            ]
        */
        function select_into_simple_array($k, $v, $conn, $query_type, ...$args) {
            $retarr = [];
            foreach(select($conn, $query_type, ...$args) as $retvar) {
                array_push($retarr, [$retvar[$k] => $retvar[$v]]);
            }

            return $retarr;
        }

 ?>
