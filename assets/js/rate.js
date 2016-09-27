/* 
 * Question rating system, queries go through the AJAX
 */
function rate(id) {
    var xhttp = new XMLHttpRequest();
    
    xhttp.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            var attempt = JSON.parse(this.response);
            
            if (attempt.result === true) {
                var li = document.getElementById("question-" + id);
                var rating = li.children[1];
                var number = rating.children[0];
                var prop = rating.children[1].className;
                
                number.innerHTML = parseInt(number.innerHTML) + 1;
                
                if (prop.indexOf('rated') === -1) {
                    rating.children[1].className += " rated";
                }
            }
        }
    };
    
    xhttp.open("POST", location.href, true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("rate=" + id);
}
