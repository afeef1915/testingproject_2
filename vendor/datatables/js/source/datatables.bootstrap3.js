/*!
 DataTables Bootstrap 3 integration
 ©2011-2014 SpryMedia Ltd - datatables.net/license
 */
(function (l, q) {
    var e = function (b, c) {
        b.extend(!0, c.defaults, {renderer: "bootstrap", language: {sSearch: ""}});
        b.extend(c.ext.classes, {sWrapper: "dataTables_wrapper form-inline dt-bootstrap", sFilterInput: "form-control input-sm", sLengthSelect: "form-control input-sm"});
        c.ext.renderer.pageButton.bootstrap = function (g, e, r, s, i, m) {
            var t = new c.Api(g), u = g.oClasses, j = g.oLanguage.oPaginate, d, f, n = 0, p = function (c, e) {
                var k, h, o, a, l = function (a) {
                    a.preventDefault();
                    b(a.currentTarget).hasClass("disabled") || t.page(a.data.action).draw(!1)
                };
                k = 0;
                for (h = e.length; k < h; k++)
                    if (a = e[k], b.isArray(a))
                        p(c, a);
                    else {
                        f = d = "";
                        switch (a) {
                            case "ellipsis":
                                d = "&hellip;";
                                f = "disabled";
                                break;
                            case "first":
                                d = j.sFirst;
                                f = a + (0 < i ? "" : " disabled");
                                break;
                            case "previous":
                                d = j.sPrevious;
                                f = a + (0 < i ? "" : " disabled");
                                break;
                            case "next":
                                d = j.sNext;
                                f = a + (i < m - 1 ? "" : " disabled");
                                break;
                            case "last":
                                d = j.sLast;
                                f = a + (i < m - 1 ? "" : " disabled");
                                break;
                            default:
                                d = a + 1, f = i === a ? "active" : ""
                        }
                        d && (o = b("<li>", {"class": u.sPageButton + " " +
                            f, id: 0 === r && "string" === typeof a ? g.sTableId + "_" + a : null}).append(b("<a>", {href: "#", "aria-controls": g.sTableId, "data-dt-idx": n, tabindex: g.iTabIndex}).html(d)).appendTo(c), g.oApi._fnBindAction(o, {action: a}, l), n++)
                    }
            }, h;
            try {
                h = b(q.activeElement).data("dt-idx")
            } catch (l) {
            }
            p(b(e).empty().html('<ul class="pagination"/>').children("ul"), s);
            h && b(e).find("[data-dt-idx=" + h + "]").focus()
        };
        c.TableTools && (b.extend(!0, c.TableTools.classes, {container: "DTTT btn-group", buttons: {normal: "btn btn-default", disabled: "disabled"},
            collection: {container: "DTTT_dropdown dropdown-menu", buttons: {normal: "", disabled: "disabled"}}, print: {info: "DTTT_print_info"}, select: {row: "active"}}), b.extend(!0, c.TableTools.DEFAULTS.oTags, {collection: {container: "ul", button: "li", liner: "a"}}))
    };
    "function" === typeof define && define.amd ? define(["jquery", "datatables"], e) : "object" === typeof exports ? e(require("jquery"), require("datatables")) : jQuery && e(jQuery, jQuery.fn.dataTable)
})(window, document);