/*
 * Load more questions via ajax
 * TODO: stop loading when limit is exceeded
 */
function more() {
    var xhttp = new XMLHttpRequest();
    var existList = document.querySelector(".q-list").children[1];
    
    if ((existList.children.length % 5) === 0) {
        xhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {

                var loadList = JSON.parse(this.response);
                var i;

                for (i=0; i < loadList.length; i++) {

                    var li = document.createElement("li");
                    li.id = "question-" + loadList[i].id;

                    // q-inquire div:
                    var inquire = document.createElement("div");
                    inquire.className = "q-inquire";

                    var h = document.createElement("h5");
                    h.className = "q-header";
                    h.appendChild(document.createTextNode(loadList[i].text));

                    var p = document.createElement("p");
                    p.className = "q-author";
                    p.appendChild(document.createTextNode(loadList[i].author));

                    inquire.appendChild(h);
                    inquire.appendChild(p);
                    li.appendChild(inquire);

                    // q-rating div:
                    var rating = document.createElement("div");
                    rating.className = "q-rating";

                    var icon = document.createElement("i");
                    icon.className = "fa fa-thumbs-o-up fa-2x";
                    icon.setAttribute("onclick", "rate(" + loadList[i].id + ")");
                    
                    var span = document.createElement("span");
                    span.className = "q-votes";
                    span.appendChild(document.createTextNode(loadList[i].rating));
                    
                    rating.appendChild(span);
                    rating.appendChild(icon);
                    li.appendChild(rating);

                    existList.appendChild(li);
                }
            }
        };
        
        var from = existList.children.length;
        var to = from + 5;

        xhttp.open("GET", "http://q/en/home/?loadmore=more&from=" + from + "&to=" + to, true);
        xhttp.send();
    } else {
        return false;
    }
}
