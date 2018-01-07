function ele(id) {
    return document.getElementById(id);
}

function ev(id, listener, func) {
    if(ele(id) !== null) {
        ele(id).addEventListener(listener, func);
    }
}

function ac(parent, child) {
    return parent.appendChild(child);
}

function ce(tag) {
    return document.createElement(tag);
}

function cte(string) {
    return document.createTextNode(string);
}

function back() {
    window.history.back();
}

function clearAllChild(ele) {
    while(ele.firstChild) {
        ele.removeChild(ele.firstChild);
    }
}

function for_each(collection, func) {
    for(var i = 0; i < collection.length; i++) {
        func(collection[i]);
    }
}

function reverse_for(collection, func) {
    for(var i = collection.length - 1; i >= 0; i--) {
        func(collection[i]);
    }
}

function showdiv(id) {
    if (ele(id).style.display == 'none') {
        ele(id).style.display = 'block';
    } else {
        ele(id).style.display = 'none';
    }
}
