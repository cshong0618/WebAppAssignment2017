// This file is used to intercept the default button actions

// Block form from posting
function form_blocker(e) {
    console.log(pressed_button);

    var pass = true;
    if(pressed_button === "default_button"){
        var name = ele("name").value;

        if(name === "") {
            ele("name_error").innerHTML = "Name cannot be blank";
            e.preventDefault();
            pass = false;
        } else {
            ele("name_error").innerHTML = "";
        }
    }
    return pass;
}

function identify_self(button){
    pressed_button = button.srcElement.id;
}

ev("edit_form", "submit", form_blocker);
ev("default_button", "click", identify_self);
ev("delete_button", "click", identify_self);


ev("floor", "change", function(){
    var floor_id = this.value;
    var tenant_id = ele("tenant_id").value;
    console.log(floor_id);

    var xhr = new XMLHttpRequest();
    console.log(xhr);

    xhr.onreadystatechange = function() {
        if(this.readyState != 4) {
            // Disable submit button while in process
            ele("default_button").disabled = true;
            if(ele("delete_button") != null) {
                ele("delete_button").disabled = true;
            }
        } else if (this.readyState == 4 && this.status == 200) {
            var sel = ele("lot_number");

            // Clear all selections
            clearAllChild(sel);

            // Get the JSON
            var ret_json = JSON.parse(this.responseText);

            // No more space
            if (ret_json.length == 0){
                // Put a -1 placeholder
                var opt = ce("option");
                opt.value = -1;
                opt.innerHTML = "No more available lots";
                ac(sel, opt);
            } else {
                // Insert JSON data into selections
                for_each(ret_json, function(element){
                    for(k in element) {
                        var opt = ce("option");
                        opt.value = k;
                        opt.innerHTML = element[k];
                        if (default_lot == k) {
                            opt.selected = true;
                        }
                        ac(sel, opt);
                    }
                });
            }

            // Re-enable all buttons
            ele("default_button").disabled = false;
            if(ele("delete_button") != null) {
                ele("delete_button").disabled = false;
            }
        }
    }

    xhr.open("GET", "/admin/get_lot_including_self.php?fid=" + floor_id+"&tid="+tenant_id, true);
    xhr.send();
})
