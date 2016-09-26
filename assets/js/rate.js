/* 
 * Question rating system, queries go through the AJAX
 */
function rate(id) {
    var xhttp = new XMLHttpRequest();
    
    xhttp.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            
            var li = document.getElementById("question-" + id);
            var rating = li.children[1];
            var number = rating.children[0];
            
            number.innerHTML = parseInt(number.innerHTML) + 1;
            rating.children[1].className += " rated";
        }
    };
    
    xhttp.open("POST", "http://q/en/home/?rate=" + id, true);
    xhttp.send();
}
