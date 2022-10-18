//create event
/** Set the current page to be the first page(0) */
var currentPage = 0;

/** To show the current page */
showPage(currentPage);

/** To display the specified page of the form */
function showPage(n) {
    var x = document.getElementsByClassName("page");
    x[n].style.display = "block";
    if (n == 0) {
        document.getElementById("previousButton").style.display = "none";
    } else {
        document.getElementById("previousButton").style.display = "inline";
    }

    if (n == (x.length - 1)) {
        document.getElementById("nextButton").innerHTML = "Submit";
    } else {
        document.getElementById("nextButton").innerHTML = "Next";
    }
      
    activeRemover(n);
}

/** To find out which page to show */
function nextPage(n) {
    var x = document.getElementsByClassName("page");

    if (n == 1 && !validateCheck()) return false;

    x[currentPage].style.display = "none";
    currentPage = currentPage + n;

    if (currentPage >= x.length) {
        document.getElementById("creatForm").submit();
        return false;
    }

    showPage(currentPage);
}

/** To check whether this form is validate or not */
function validateCheck() {
    var x, y, i, valid = true;
    x = document.getElementsByClassName("page");
    y = x[currentPage].getElementsByTagName("input");

    for (i = 0; i < y.length; i++) {
        if (y[i].value == "") {
            y[i].className += " invalid";
            valid = false;
        }
    }

    if (valid) {
        document.getElementsByClassName("step")[currentPage].className += " finish";
    }
    return valid;
}

/** To remove active steps */
function activeRemover(n) {
    var i, x = document.getElementsByClassName("step");
    for (i = 0; i < x.length; i++) {
      x[i].className = x[i].className.replace(" active", "");
    }
    
    x[n].className += " active";
}

