<?php
    function create_row($data) {
        $td = "<td>";
        $td .= implode("</td><td>", $data);
        $td .= "</td>";

        return $td;
    }

    function create_headers($data) {
        $th = "<th>";
        $th .= implode("</th><th>", $data);
        $th .= "</th>";

        return $th;
    }

    function add_row($td) {
        return <<<TR
<tr>$td</tr>
TR;
    }

    /*
        $data takes in a 2D array;
        Eg.:
        $data = [
            // First row
            [
                item_1, item_2, ...
            ],
            // Second row
            [
                item_1, item_2, ...
            ],
            ...
        ];
    */
    function create_table($id, $data, $headers=[], $caption = "") {
        $table = "<table id=\"$id\"><caption>$caption</caption>";

        if (sizeof($headers) > 0) {
            $table .= add_row(create_headers($headers));
        }

        foreach($data as $vals) {
            $table .= add_row(create_row($vals));
        }

        $table .= "</table>";
        return $table;
    }
?>
