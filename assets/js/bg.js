var $body = document.querySelector("body");
!function () {
    var e, t, s, i = {images: {"assets/images/bg.jpg": "center", "assets/images/bg2.jpg": "center"}, delay: 6e3}, a = 0, d = 0, n = [];
    e = document.createElement("div"), e.id = "bg", $body.appendChild(e);
    for (s in i.images) t = document.createElement("div"), t.style.backgroundImage = 'url("' + s + '")', t.style.backgroundPosition = i.images[s], e.appendChild(t), n.push(t);
    n[a].classList.add("visible"), n[a].classList.add("top"), 1 != n.length && canUse("transition") && window.setInterval(function () {
        d = a, a++, a >= n.length && (a = 0), n[d].classList.remove("top"), n[a].classList.add("visible"), n[a].classList.add("top"), window.setTimeout(function () {
            n[d].classList.remove("visible")
        }, i.delay / 2)
    }, i.delay)
}();