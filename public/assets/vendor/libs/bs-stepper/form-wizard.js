$(function() {
    var e = $(".select2"),
        t = $(".selectpicker");
    t.length && t.selectpicker(), e.length && e.each(function() {
        var e = $(this);
        e.wrap('<div class="position-relative"></div>'), e.select2({
            placeholder: "Select value",
            dropdownParent: e.parent()
        })
    })
}),
function() {
    var e = document.querySelector(".wizard-numbered"),
        l = [].slice.call(e.querySelectorAll(".btn-next")),
        r = [].slice.call(e.querySelectorAll(".btn-prev")),
        c = e.querySelector(".btn-submit");
    if (null !== e) {
        let t = new Stepper(e, {
            linear: !1
        });
        l && l.forEach(e => {
            e.addEventListener("click", e => {
                t.next()
            })
        }), r && r.forEach(e => {
            e.addEventListener("click", e => {
                t.previous()
            })
        }), c && c.addEventListener("click", e => {
            alert("Submitted..!!")
        })
    }
    e = document.querySelector(".wizard-vertical"), l = [].slice.call(e.querySelectorAll(".btn-next")), r = [].slice.call(e.querySelectorAll(".btn-prev")), c = e.querySelector(".btn-submit");
    if (null !== e) {
        let t = new Stepper(e, {
            linear: !1
        });
        l && l.forEach(e => {
            e.addEventListener("click", e => {
                t.next()
            })
        }), r && r.forEach(e => {
            e.addEventListener("click", e => {
                t.previous()
            })
        }), c && c.addEventListener("click", e => {
            alert("Submitted..!!")
        })
    }
    e = document.querySelector(".wizard-modern-example"), l = [].slice.call(e.querySelectorAll(".btn-next")), r = [].slice.call(e.querySelectorAll(".btn-prev")), c = e.querySelector(".btn-submit");
    if (null !== e) {
        let t = new Stepper(e, {
            linear: !1
        });
        l && l.forEach(e => {
            e.addEventListener("click", e => {
                t.next()
            })
        }), r && r.forEach(e => {
            e.addEventListener("click", e => {
                t.previous()
            })
        }), c && c.addEventListener("click", e => {
            alert("Submitted..!!")
        })
    }
    e = document.querySelector(".wizard-modern-vertical"), l = [].slice.call(e.querySelectorAll(".btn-next")), r = [].slice.call(e.querySelectorAll(".btn-prev")), c = e.querySelector(".btn-submit");
    if (null !== e) {
        let t = new Stepper(e, {
            linear: !1
        });
        l && l.forEach(e => {
            e.addEventListener("click", e => {
                t.next()
            })
        }), r && r.forEach(e => {
            e.addEventListener("click", e => {
                t.previous()
            })
        }), c && c.addEventListener("click", e => {
            alert("Submitted..!!")
        })
    }
}();