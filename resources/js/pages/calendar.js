/*!
 * oneui - v4.8.0
 * @author pixelcave - https://pixelcave.com
 * Copyright (c) 2020
 * fullcalendar Docs - https://fullcalendar.io/docs
 */
! function() {
    function e(e, t) {
        for (var n = 0; n < t.length; n++) {
            var a = t[n];
            a.enumerable = a.enumerable || !1, a.configurable = !0, "value" in a && (a.writable = !0), Object.defineProperty(e, a.key, a)
        }
    }
    var t = function() {
        function t() {
            ! function(e, t) {
                if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
            }(this, t)
        }
        var n, a;
        return n = t, a = [{
            key: "addEvent",
            value: function() {
                var e = jQuery(".js-add-event"),
                    t = "";
                jQuery(".js-form-add-event").on("submit", (function(n) {
                    return (t = e.prop("value")) && (jQuery("#js-events").prepend('<li><div class="js-event p-2 text-white font-size-sm font-w500 bg-info">' + jQuery("<div />").text(t).html() + "</div></li>"), e.prop("value", "")), !1
                }))
            }
        }, {
            key: "initEvents",
            value: function() {
                new FullCalendar.Draggable(document.getElementById("js-events"), {
                    itemSelector: ".js-event",
                    eventData: function(e) {
                        return {
                            title: e.innerText,
                            backgroundColor: getComputedStyle(e).backgroundColor,
                            borderColor: getComputedStyle(e).backgroundColor
                        }
                    }
                })
            }
        }, {
            key: "initCalendar",
            value: function() {
                var e = new Date,
                    t = e.getDate(),
                    n = e.getMonth(),
                    a = e.getFullYear();
                new FullCalendar.Calendar(document.getElementById("js-calendar"), {
                    themeSystem: "bootstrap",
                    locale: 'ko', // the initial locale
                    firstDay: 1,
                    editable: !0,
                    droppable: !0,
                    headerToolbar: {
                        left: "title",
                        right: "prev,next today dayGridMonth,timeGridWeek,timeGridDay,listWeek"
                    },
                    drop: function(e) {
                        e.draggedEl.parentNode.remove()
                    },
                    events: [{
                        title: "Gaming Day",
                        start: new Date(a, n, 1),
                        allDay: !0
                    }, {
                        title: "Skype Meeting",
                        start: new Date(a, n, 3)
                    }, {
                        title: "Project X",
                        start: new Date(a, n, 9),
                        end: new Date(a, n, 12),
                        allDay: !0,
                        color: "#e04f1a"
                    }, {
                        title: "Work",
                        start: new Date(a, n, 17),
                        end: new Date(a, n, 19),
                        allDay: !0,
                        color: "#82b54b"
                    }, {
                        id: 999,
                        title: "Hiking (repeated)",
                        start: new Date(a, n, t - 1, 15, 0)
                    }, {
                        id: 999,
                        title: "Hiking (repeated)",
                        start: new Date(a, n, t + 3, 15, 0)
                    }, {
                        title: "Landing Template",
                        start: new Date(a, n, t - 3),
                        end: new Date(a, n, t - 3),
                        allDay: !0,
                        color: "#ffb119"
                    }, {
                        title: "Lunch",
                        start: new Date(a, n, t + 7, 15, 0),
                        color: "#82b54b"
                    }, {
                        title: "Coding",
                        start: new Date(a, n, t, 8, 0),
                        end: new Date(a, n, t, 14, 0)
                    }, {
                        title: "Trip",
                        start: new Date(a, n, 25),
                        end: new Date(a, n, 27),
                        allDay: !0,
                        color: "#ffb119"
                    }, {
                        title: "Reading",
                        start: new Date(a, n, t + 8, 20, 0),
                        end: new Date(a, n, t + 8, 22, 0)
                    }, {
                        title: "Follow us on Twitter",
                        start: new Date(a, n, 22),
                        allDay: !0,
                        url: "http://twitter.com/pixelcave",
                        color: "#3c90df"
                    }]
                }).render()
            }
        }, {
            key: "init",
            value: function() {
                this.addEvent(), this.initEvents(), this.initCalendar()
            }
        }], null && e(n.prototype, null), a && e(n, a), t
    }();
    jQuery((function() {
        t.init()
    }))
}();