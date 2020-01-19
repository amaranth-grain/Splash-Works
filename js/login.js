var submitButton = document.getElementById("submit");
submitButton.addEventListener("mouseover", changeColor);
submitButton.addEventListener("mouseleave", changeBack)

function changeColor() {
submitButton.style.background = "#D00589";
}

function changeBack() {
submitButton.style.background = "#D65B88";
}

function focusIn (el) {
    el.addEventListener("focusin", function() {
       el.style.background = "rgba(104, 43, 119, 0.5)"; 
    });
}

function focusOut (el) {
    el.addEventListener("focusout", function() {
        el.style.background = "none";
    });
}

var username = document.getElementById("name");
focusIn(username);
focusOut(username);

var password = document.getElementById("password");
focusIn(password);
focusOut(password);

var passwordConfirm = document.getElementById("passwordConfirm");
focusIn(passwordConfirm);
focusOut(passwordConfirm);


function view () {
        let viewheight = $(window).height();
        let viewwidth = $(window).width();
        let viewport = document.querySelector("meta[name=viewport]");
        viewport.setAttribute("content", "height=" + viewheight + "px, width=" + viewwidth + "px, initial-scale=1.0");
    }

view();