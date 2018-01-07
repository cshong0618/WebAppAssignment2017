<?php
    /*
        [
            item_1,
            item_2,
            .
            .
            .
            item_n
        ]
    */

    function list_item($item) {
        return "<li> $item </li>";
    }

    function list_items($valarr) {
        $out = "";
        foreach($valarr as $item) {
            $out .= list_item($item);
        }
        return $out;
    }

    function ordered_list($items) {
        return <<<OL
<ol>$items</ol>
OL;
    }

    function unordered_list($items) {
        return <<<UL
<ul>$items</ul>
UL;
    }

    function alist($items, $func) {
        return $func($items);
    }

    // Auto sublist creator
    // Group the same keys together
    // IF key exists, append
    // ELSE create key, append
    /*
        [
            [
                k => ?,
                v => ?
            ],
            [
                k => ?,
                v => ?
            ],
            [
                k => ?,
                v => ?
            ],
        ]

        TO
        [
            k=>? : l[[li], [li]],
            k=>? : l[[li], [li]]
        ]

        TO
        l[l[[li], [li]], l[[li],[li]]]
    */
    function create_sublist($valarr, $key, $value, $type) {
        $default_key = "";
        $output = "";

        $arr = [];

        foreach($valarr as $items) {
            if (array_key_exists($items[$key], $arr)) {
                array_push($arr[$items[$key]], $items[$value]);
            } else {
                $arr[$items[$key]] = [];
                array_push($arr[$items[$key]], $items[$value]);
            }
        }

        foreach($arr as $k => $v) {
            $li = list_items($v);
            $arr[$k] = list_items([$k]) . $type($li);
        }
        $output = "<ul>" . implode(" ", $arr) . "</ul>";
        return $output;
    }
?>
