var timer;
window.onload = function() {
    for (var i = 0; i < document.getElementsByClassName("menu").length; i++) {
        var menu = document.getElementsByClassName("menu")[i];
        var sub = menu.getElementsByClassName("subMenu")[0];
        var headline = menu.getElementsByClassName("headline")[0];
        headline.onmouseover = function() {
            var headline_ref = event.target;
            var menu_ref = headline_ref.parentNode;
            var sub_ref = menu_ref.getElementsByClassName("subMenu")[0];
            headline_ref.style.backgroundColor = "rgba(255,255,255,0.3)";
            headline_ref.style.color = "#B21515";
            sub_ref.style.display = "";
        };
        headline.onmouseout = function() {
            var headline_ref = event.target;
            var menu_ref = headline_ref.parentNode;
            var sub_ref = menu_ref.getElementsByClassName("subMenu")[0];
            timer = setTimeout(hide, 50, headline_ref, sub_ref);
        };

        sub.onmouseover = function() {
            clearTimeout(timer);
        };

        sub.onmouseout = function() {
            var sub_ref = event.currentTarget;

            var headline_ref = sub_ref.parentNode.getElementsByClassName("headline")[0];
            timer = setTimeout(hide, 50, headline_ref, sub_ref);
        };

        for (var j = 0; j < sub.getElementsByTagName("span").length; j++) {
            sub.getElementsByTagName("span")[j].onmouseover = function() {
                event.currentTarget.style.backgroundColor = "rgba(255,255,255,0.3)";
                event.currentTarget.style.color = "#FFCCC3";
            };
            sub.getElementsByTagName("span")[j].onmouseout = function() {
                event.currentTarget.style.backgroundColor = "";
                event.currentTarget.style.color = "";
            };
        }
    }
};

function hide(headline_ref, sub_ref) {
    headline_ref.style.backgroundColor = "";
    headline_ref.style.color = "";
    sub_ref.style.display = "none";
}
