/*
 * Send a question for review with AJAX
 */
document.getElementById("btn-ask").addEventListener("click", function () {

    var xhttp = new XMLHttpRequest();
    var value = document.getElementById("question").value;

    xhttp.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {

            var loadList = JSON.parse(this.response);
            console.log(loadList);
        }
    };

    xhttp.open("POST", location.href, true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("question=" + value);
});
