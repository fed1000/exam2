// NAVIGATION LOGO SCROLL TOP
$(document).ready(function () {
    (() => {
        let $ = el => document.querySelector(el);

        $(".animenu__btn").addEventListener("click", function () {
            this.classList.toggle("animenu__btn--active")
            $(".animenu__nav").classList.toggle("animenu__nav--active")
        });
    })()
}); 