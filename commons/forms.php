<?php
    function label_text_pair($name, $id, $title, $value, $type="text") {
        return <<<LABEL_TEXT_PAIR
<div>
<label for="$id">$title: </label>
<input type="$type" name="$name" id="$id" value="$value"></input>
</div>
LABEL_TEXT_PAIR;
    }

    function label_text_cascade($name, $id, $title, $value, $type="text") {
        return <<<LABEL_TEXT_CASCADE
<div>
    <div><label for="$id">$title:</label></div>
    <div><input type="$type" name="$name" id="$id" value="$value"></input></div>
</div>
LABEL_TEXT_CASCADE;
    }


    function label_text_array($name, $id, $title, $value, $type="text"){
        $retarr = [
            "LABEL" => "<label for=\"$id\">$title:</label>",
            "INPUT" => "<input name=\"$name\" id=\"$id\" value=\"$value\"></input>"
        ];

        return $retarr;
    }

    function label_textarea_pair($name, $id, $title, $value, $rows=4, $cols=80) {
        return <<<LABEL_TEXT_PAIR
<div>
<label for="$id">$title: </label>
<textarea name="$name" id="$id" rows="$rows" cols="$cols">$value</textarea>
</div>
LABEL_TEXT_PAIR;
    }

    function label_textarea_cascade($name, $id, $title, $value, $rows=4, $cols=80) {
        return <<<LABEL_TEXT_CASCADE
<div>
    <div><label for="$id">$title:</label></div>
    <div><textarea name="$name" id="$id" rows="$rows" cols="$cols">$value</textarea></div>
</div>
LABEL_TEXT_CASCADE;
    }


    function label_textarea_array($name, $id, $title, $value, $rows=4, $cols=80){
        $retarr = [
            "LABEL" => "<label for=\"$id\">$title:</label>",
            "INPUT" => "<textarea type=\"$type\" name=\"$name\" id=\"$id\" rows=\"$rows\" cols=\"$cols\">$value</textarea>"
        ];

        return $retarr;
    }

    function create_options($valarr, $default="") {
        $options = "";
        foreach($valarr as $kv) {
            foreach($kv as $k => $v){
                $options .= "<option value=\"$k\"";
                if($default == $k) {
                    $options .= " selected";
                }
                $options .= ">$v</option>";
            }
        }

        return $options;
    }

    function label_drop_down_pair($id, $title, $valarr, $default="") {
        $options = create_options($valarr, $default);

        return <<<LABEL_DROP_DOWN
<div>
    <label for="$id">$title</label>
    <select id="$id" name="$id">
        $options
    </select>
</div>
LABEL_DROP_DOWN;
    }

    function label_drop_down_array($id, $title, $valarr, $default="") {
        $options = create_options($valarr, $default);

        $retarr = [
            "LABEL" => "<label for=\"$id\">$title<label>",
            "INPUT" => "<select id=\"$id\" name=\"$id\">$options</select>"
        ];

        return $retarr;
    }

    function error_message_string($id, $class) {
        return <<<ERROR
<div id="$id" class="$class"></div>
ERROR;
    }
?>
