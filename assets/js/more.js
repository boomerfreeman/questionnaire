/*
 * Load more questions via ajax
 */
function getMore() {
    var xhttp = new XMLHttpRequest();
    
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            
            var exist_list = document.querySelector(".q-list").children[1];
            var load_list = JSON.parse(this.response);
            var append_list = '';
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
    
    xhttp.open("GET", "http://q/en/home/?ajax=more", true);
    xhttp.send();
}
