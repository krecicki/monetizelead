! function() {
    "use strict";
    if (!window.jQuery) {
        var a = document.createElement("script");
        a.type = "text/javascript", a.src = "https://code.jquery.com/jquery-3.2.1.min.js", document.getElementsByTagName("head")[0].appendChild(a)
    }
    window.addEventListener("load", function() {
        var a = jQuery("[data-api='name']"),
            e = jQuery("[data-api='email']"),
            t = jQuery("[data-api='phone']"),
            n = jQuery("[data-api='zipcode']"),
            i = jQuery("[data-api='apiKey']"),
            o = jQuery("[data-api='leadTypes']"),
            l = jQuery("[data-api='lead-gen']");
        l && l.click(function() {
            event.preventDefault(), event.stopImmediatePropagation();
            var l = {
                action: "lead_gen",
                leadData: {
                    apiKey: i.val(),
                    name: a.val(),
                    email: e.val(),
                    phone: t.val(),
                    zipcode: n.val(),
                    lead_types: o.val()
                }
            };
            console.log(l);
            jQuery.post("https://monetizelead.com/client/{USERNAME}/api/lead_gen", l, function(a) {
            //jQuery.post("../api/lead_gen", l, function(a) {

                console.log(a), api_callback ? api_callback(a) : alert(a.status)
            }, "json")
        })
    }, !1)
}();