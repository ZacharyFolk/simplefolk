!function (n, o) { "object" == typeof exports && "undefined" != typeof module ? module.exports = o() : "function" == typeof define && define.amd ? define(o) : (n = "undefined" != typeof globalThis ? globalThis : n || self).EmblaCarouselAutoplay = o() }(this, (function () { "use strict"; const n = { active: !0, breakpoints: {}, delay: 4e3, jump: !1, playOnInit: !0, stopOnInteraction: !0, stopOnMouseEnter: !1, stopOnLastSnap: !1, rootNode: null }; function o(t = {}) { let e, i, s, r = 0, a = !1; function p() { i.off("pointerDown", s), e.stopOnInteraction || i.off("pointerUp", u), d(), r = 0 } function l(n) { d(), void 0 !== n && (a = n), r = window.setTimeout(c, e.delay) } function d() { r && window.clearTimeout(r) } function u() { r && (d(), l()) } function c() { const { index: n } = i.internalEngine(), o = i.scrollSnapList().length - 1; if (e.stopOnLastSnap && n.get() === o) return p(); i.canScrollNext() ? i.scrollNext(a) : i.scrollTo(0, a), l() } return { name: "autoplay", options: t, init: function (r, c) { i = r; const { mergeOptions: f, optionsAtMedia: y } = c, O = f(n, o.globalOptions), m = f(O, t); e = y(m), a = e.jump, s = e.stopOnInteraction ? p : d; const { eventStore: g, ownerDocument: b, ownerWindow: w } = i.internalEngine(), h = i.rootNode(), v = e.rootNode && e.rootNode(h) || h; i.on("pointerDown", s), e.stopOnInteraction || i.on("pointerUp", u), e.stopOnMouseEnter && (g.add(v, "mouseenter", s), e.stopOnInteraction || g.add(v, "mouseleave", u)), g.add(b, "visibilitychange", (() => { if ("hidden" === b.visibilityState) return d(); u() })), g.add(w, "pagehide", (n => { n.persisted && d() })), e.playOnInit && l() }, destroy: p, play: l, stop: d, reset: u } } return o.globalOptions = void 0, o }));