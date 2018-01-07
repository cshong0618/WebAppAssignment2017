ev("default_button", "click", function() {
        var name = ele("name").value;
        var pass = true;

        if(name === "") {
            ele("name_error").innerHTML = "Name cannot be blank";
            pass = false;
        } else {
            ele("name_error").innerHTML = "";
        }

        if(pass) {
            ele("cud_form").submit();
        }
    }
)

ev("floor", "change", function(){
    var floor_id = this.value;
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

    xhr.open("GET", "/admin/get_lot.php?fid=" + floor_id, true);
    xhr.send();
})
