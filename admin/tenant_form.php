<form method="post" id="<?= isset($form_id) ? $form_id : "cud_form" ?>">
    <input type="hidden" name="id" id="tenant_id" value=<?= isset($id) ? $id : "" ?>>
    <?= create_table("tenant_form",
        [
            // Name
            label_text_array("name", "name", "Name", isset($name) ? $name : ""),
            [
                error_message_string("name_error", "error_message"),"&nbsp"
            ],
            // Category
            label_drop_down_array("category", "Category", isset($category) ? $category : [], isset($category_default) ? $category_default : ""),
            // Floor
            label_drop_down_array("floor", "Floor", isset($floor) ? $floor : [], isset($floor_default) ? $floor_default : ""),
            // Lot Number
            label_drop_down_array("lot_number", "Lot Number", isset($lot_number) ? $lot_number : [], isset($lot_number_default) ? $lot_number_default : ""),
            // Black space
            [
                "&nbsp", "&nbsp"
            ],
            // Buttons
            [
                isset($default_button) ? $default_button : "",
                isset($delete_button) ? $delete_button : ""
            ]
        ]
    ,[isset($form_title) ? $form_title : "", ""])
    ?>
</form>
<script src="/commons/cshjs.js"></script>
