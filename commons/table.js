/*
    Must include helper.js first
*/

function filter_table(table_id, search_term, search_col, start_from=0) {
    var table = ele(table_id);
    var rows = table.tBodies[0].childNodes;

    for(var i = start_from; i < rows.length; i++) {
        // Hide
        if (rows[i].childNodes[search_col].innerHTML.toUpperCase().indexOf(search_term.toUpperCase()) > -1) {
            rows[i].style.display = "";
        } else {
            rows[i].style.display = "none";
        }
    }
}
