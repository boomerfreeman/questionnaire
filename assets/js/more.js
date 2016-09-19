/*
 * Load more questions via ajax
 * TODO: stop loading when limit is exceeded
 */
function getMore() {
    var xhttp = new XMLHttpRequest();
    var exist_list = document.querySelector(".q-list").children[1];
    
    xhttp.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            
            var load_list = JSON.parse(this.response);
            var i;
            
            for (i=0; i < load_list.length; i++) {

                var li = document.createElement("li");

                var h = document.createElement("h5");
                h.className = "q-header";
                h.appendChild(document.createTextNode(load_list[i].question_text));

                var p = document.createElement("p");
                p.className = "q-author";
                p.appendChild(document.createTextNode(load_list[i].question_author));

                li.appendChild(h);
                li.appendChild(p);

                exist_list.appendChild(li);
            }
        }
    };
    
    var from = exist_list.children.length;
    var to = from + 5;
    
    xhttp.open("GET", "http://q/en/home/?ajax=more&from=" + from + "&to=" + to, true);
    xhttp.send();
}
