/*
 *  Project: PicEdit
 *  Description: Creates an image upload box with tools to edit the image on the front-end before uploading it to the server
 *  Author: Andy V.
 *  License: MIT
 */
! function (i, t, e, a) {
    "use strict";

    function s(t, e) {
        this.inputelement = t, this.element = t, this.options = i.extend({}, o, e), this._defaults = o, this._name = n, this._image = !1, this._filename = "", this._variables = {}, this._template()
    }
    var n = "picEdit",
        o = {
            imageUpdated: function (i) {},
            formSubmitted: function (i) {},
            fileNameChanged: function (i) {},
            fileLoaded: function (i) {},
            redirectUrl: !1,
            maxWidth: 400,
            maxHeight: "auto",
            aspectRatio: !0,
            defaultImage: !1,
            defaultMessageTimeout: 3e3
        };
    s.prototype = {
        init: function () {
            function a(i) {
                if (i || i.length) {
                    var t = i[0];
                    s._filename || (s._filename = t.name);
                    var e = new FileReader;
                    e.onload = function (i) {
                        s._create_image_with_datasrc(i.target.result, !1, t), s.options.fileLoaded(t), t.name != s._filename && (s._filename = t.name, s.options.fileNameChanged(t.name))
                    }, e.readAsDataURL(t)
                }
            }
            var s = this,
                n = i(this.inputelement).prop("type");
            if ("file" == n ? this._fileinput = i(this.inputelement) : (i(this.inputelement).after('<input type="file" style="display:none" accept="image/*">'), this._fileinput = i(this.inputelement).next("input")), !this.check_browser_capabilities()) return "file" != n && (i(this.inputelement).prop("type", "file"), i(this._fileinput).remove()), i(this.inputelement).show(), void i(this.element).remove();
            if (this._canvas = i(this.element).find(".picedit_canvas > canvas")[0], this._ctx = this._canvas.getContext("2d"), this._videobox = i(this.element).find(".picedit_video"), this._painter = i(this.element).find(".picedit_painter"), this._painter_canvas = this._painter.children("canvas")[0], this._painter_ctx = this._painter_canvas.getContext("2d"), this._painter_painting = !1, this._messagebox = i(this.element).find(".picedit_message"), this._messagetimeout = !1, this._mainbuttons = i(this.element).find(".picedit_action_btns"), this._viewport = {
                    width: 0,
                    height: 0
                }, this._cropping = {
                    is_dragging: !1,
                    is_resizing: !1,
                    left: 0,
                    top: 0,
                    width: 0,
                    height: 0,
                    cropbox: i(this.element).find(".picedit_drag_resize"),
                    cropframe: i(this.element).find(".picedit_drag_resize_box")
                }, i(this.element).find(".picedit_canvas_box").on("drop", function (t) {
                    t.preventDefault(), i(this).removeClass("dragging");
                    var e = (t.dataTransfer || t.originalEvent.dataTransfer).files;
                    a(e)
                }).on("dragover", function (t) {
                    t.preventDefault(), i(this).addClass("dragging")
                }).on("dragleave", function (t) {
                    t.preventDefault(), i(this).removeClass("dragging")
                }), i(this._fileinput).on("change", function () {
                    a(this.files)
                }), !t.Clipboard) {
                var o = i(e.createElement("div"));
                o.prop("contenteditable", "true").css({
                    position: "absolute",
                    left: -999,
                    width: 0,
                    height: 0,
                    overflow: "hidden",
                    outline: 0,
                    opacity: 0
                }), i(e.body).prepend(o)
            }
            i(e).on("paste", function (i) {
                var t, e = (i.clipboardData || i.originalEvent.clipboardData).items;
                if (e) {
                    for (var a = 0; a < e.length; a++) 0 === e[a].type.indexOf("image") && (t = e[a].getAsFile());
                    if (t) {
                        var n = new FileReader;
                        n.onload = function (i) {
                            s._create_image_with_datasrc(i.target.result)
                        }, n.readAsDataURL(t)
                    }
                } else o.get(0).focus(), o.on("DOMSubtreeModified", function () {
                    var i = o.children().last().get(0);
                    o.html(""), i && ("IMG" === i.tagName && "data:" == i.src.substr(0, 5) ? s._create_image_with_datasrc(i.src) : "IMG" === i.tagName && "http" == i.src.substr(0, 4) && s._create_image_with_datasrc(i.src, !1, !1, !0))
                })
            }), this._theformdata = !1, this._theform = i(this.inputelement).parents("form"), this._theform.length && this._theform.on("submit", function () {
                return s._formsubmit()
            }), this._bindControlButtons(), this._bindInputVariables(), this._bindSelectionDrag(), this._variables.pen_color = "black", this._variables.pen_size = !1, this._variables.prev_pos = !1, this.options.defaultImage && s.set_default_image(this.options.defaultImage)
        },
        check_browser_capabilities: function () {
            return 0 == !!t.CanvasRenderingContext2D ? !1 : t.FileReader ? !0 : !1
        },
        set_default_image: function (i) {
            this._create_image_with_datasrc(i, !1, !1, !0);
            var t = i.match(/.*\/(.+?)[\?#]/);
            t && t.length > 1 ? this._filename = t[1] : this._filename = i, this.options.fileNameChanged(this._filename)
        },
        hide_messagebox: function () {
            var i = this._messagebox;
            i.removeClass("active no_close_button"), setTimeout(function () {
                i.children("div").html("")
            }, 200)
        },
        set_loading: function (i) {
            return i && 1 == i ? this.set_messagebox("Working...", !1, !1) : this.set_messagebox("Please Wait...", !1, !1)
        },
        set_messagebox: function (i, t, e) {
            if (t = "undefined" != typeof t ? t : this.options.defaultMessageTimeout, e = "undefined" != typeof e ? e : !0, this._messagebox.addClass("active"), e ? this._messagebox.removeClass("no_close_button") : this._messagebox.addClass("no_close_button"), t) {
                clearTimeout(this._messagetimeout);
                var a = this;
                this._messagetimeout = setTimeout(function () {
                    a.hide_messagebox()
                }, t)
            }
            return this._messagebox.children("div").html(i)
        },
        toggle_button: function (t) {
            if (i(t).hasClass("active")) {
                var e = !1;
                i(t).removeClass("active")
            } else {
                var e = !0;
                i(t).siblings().removeClass("active"), i(t).addClass("active")
            }
            var a = i(t).data("variable");
            if (a) {
                var s = i(t).data("value");
                s || (s = i(t).val()), s && e && (e = s), this._setVariable(a, e)
            }
            this._variables.pen_color && this._variables.pen_size ? this.pen_tool_open() : this.pen_tool_close()
        },
        load_image: function () {
            this._fileinput.click()
        },
        pen_tool_open: function () {
            return this._image ? (this.pen_tool_params_set(), this._painter.addClass("active"), void this._hideAllNav()) : this._hideAllNav(1)
        },
        pen_tool_params_set: function () {
            this._painter_canvas.width = 0, this._painter_canvas.width = this._canvas.width, this._painter_canvas.height = this._canvas.height, this._painter_ctx.lineJoin = "round", this._painter_ctx.lineCap = "round", this._painter_ctx.strokeStyle = this._variables.pen_color, this._painter_ctx.lineWidth = this._variables.pen_size
        },
        pen_tool_close: function () {
            this._painter.removeClass("active")
        },
        rotate_ccw: function () {
            if (!this._image) return this._hideAllNav(1);
            var i = this;
            this.set_loading(1).delay(200).promise().done(function () {
                i._doRotation(-90), i._resizeViewport(), i.hide_messagebox()
            }), this._hideAllNav()
        },
        rotate_cw: function () {
            if (!this._image) return this._hideAllNav(1);
            var i = this;
            this.set_loading(1).delay(200).promise().done(function () {
                i._doRotation(90), i._resizeViewport(), i.hide_messagebox()
            }), this._hideAllNav()
        },
        resize_image: function () {
            if (!this._image) return this._hideAllNav(1);
            var i = this;
            this.set_loading(1).delay(200).promise().done(function () {
                var t = e.createElement("canvas"),
                    a = t.getContext("2d");
                t.width = i._variables.resize_width, t.height = i._variables.resize_height, a.drawImage(i._image, 0, 0, t.width, t.height), i._create_image_with_datasrc(t.toDataURL("image/png"), function () {
                    i.hide_messagebox()
                })
            }), this._hideAllNav()
        },
        camera_open: function () {
            var i, t = navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.getUserMedia;
            if (!t) return this.set_messagebox("Sorry, your browser doesn't support WebRTC!");
            var e = this;
            (i = t.bind(navigator))({
                audio: !1,
                video: !0
            }, function (i) {
                var t = e._videobox.find("video")[0];
                t.src = URL.createObjectURL(i), t.onloadedmetadata = function () {
                    t.videoWidth && t.videoHeight && (e._image || (e._image = {}), e._image.width = t.videoWidth, e._image.height = t.videoHeight, e._resizeViewport())
                }, e._videobox.addClass("active")
            }, function (i) {
                return e.set_messagebox("No video source detected! Please allow camera access!")
            })
        },
        camera_close: function () {
            this._videobox.removeClass("active")
        },
        take_photo: function () {
            var i = this,
                t = this._videobox.find("video")[0],
                a = e.createElement("canvas"),
                s = a.getContext("2d");
            a.width = t.clientWidth, a.height = t.clientHeight, s.drawImage(t, 0, 0, a.width, a.height), this._create_image_with_datasrc(a.toDataURL("image/png"), function () {
                i._videobox.removeClass("active")
            })
        },
        crop_image: function () {
            var i = this._calculateCropWindow(),
                t = this;
            this.set_loading(1).delay(200).promise().done(function () {
                var a = e.createElement("canvas"),
                    s = a.getContext("2d");
                a.width = i.width, a.height = i.height, s.drawImage(t._image, i.left, i.top, i.width, i.height, 0, 0, i.width, i.height), t._create_image_with_datasrc(a.toDataURL("image/png"), function () {
                    t.hide_messagebox()
                })
            }), this.crop_close()
        },
        crop_open: function () {
            return this._image ? (this._cropping.cropbox.addClass("active"), void this._hideAllNav()) : this._hideAllNav(1)
        },
        crop_close: function () {
            this._cropping.cropbox.removeClass("active")
        },
        _create_image_with_datasrc: function (i, t, a, s) {
            var n = this,
                o = e.createElement("img");
            s && o.setAttribute("crossOrigin", "anonymous"), a && (o.file = a), o.src = i, o.onload = function () {
                if (s) {
                    var i = e.createElement("canvas"),
                        a = i.getContext("2d");
                    i.width = o.width, i.height = o.height, a.drawImage(o, 0, 0), o.src = i.toDataURL("image/png")
                }
                n._image = o, n._resizeViewport(), n._paintCanvas(), n.options.imageUpdated(n._image), n._mainbuttons.removeClass("active"), t && "function" == typeof t && t(), o.onload = null
            }
        },
        _bindSelectionDrag: function () {
            var e = this,
                a = this._cropping.cropframe,
                s = this._painter,
                n = this._cropping.cropbox.find(".picedit_drag_resize_box_corner_wrap");
            i(t).on("mousedown touchstart", function (i) {
                var t = i.clientX ? i : i.originalEvent.touches[0];
                e._cropping.x = t.clientX, e._cropping.y = t.clientY, e._cropping.w = a[0].clientWidth, e._cropping.h = a[0].clientHeight, a.on("mousemove touchmove", function (i) {
                    i.stopPropagation(), i.preventDefault(), e._cropping.is_dragging = !0, e._cropping.is_resizing || e._selection_drag_movement(i)
                }), n.on("mousemove touchmove", function (i) {
                    i.stopPropagation(), i.preventDefault(), e._cropping.is_resizing = !0, e._selection_resize_movement(i)
                }), s.on("mousemove touchmove", function (i) {
                    i.stopPropagation(), i.preventDefault(), e._painter_painting = !0, e._painter_movement(i)
                })
            }).on("mouseup touchend", function () {
                e._painter_painting && e._painter_merge_drawing(), e._cropping.is_dragging = !1, e._cropping.is_resizing = !1, e._painter_painting = !1, e._variables.prev_pos = !1, a.off("mousemove touchmove"), n.off("mousemove touchmove"), s.off("mousemove touchmove")
            })
        },
        _selection_resize_movement: function (i) {
            var t = this._cropping.cropframe[0],
                e = i.clientX ? i : i.originalEvent.touches[0];
            t.style.width = this._cropping.w + e.clientX - this._cropping.x + "px", t.style.height = this._cropping.h + e.clientY - this._cropping.y + "px"
        },
        _selection_drag_movement: function (i) {
            var t = this._cropping.cropframe[0],
                e = i.pageX ? i : i.originalEvent.touches[0];
            this._cropping.cropframe.offset({
                top: e.pageY - parseInt(t.clientHeight / 2, 10),
                left: e.pageX - parseInt(t.clientWidth / 2, 10)
            })
        },
        _painter_movement: function (i) {
            var t = {},
                e = i.target || i.srcElement,
                a = e.getBoundingClientRect(),
                s = i.clientX ? i : i.originalEvent.touches[0];
            return t.x = s.clientX - a.left, t.y = s.clientY - a.top, this._variables.prev_pos ? (this._painter_ctx.beginPath(), this._painter_ctx.moveTo(this._variables.prev_pos.x, this._variables.prev_pos.y), this._painter_ctx.lineTo(t.x, t.y), this._painter_ctx.stroke(), void(this._variables.prev_pos = t)) : this._variables.prev_pos = t
        },
        _painter_merge_drawing: function () {
            var i = e.createElement("canvas"),
                t = i.getContext("2d"),
                a = this;
            i.width = this._image.width, i.height = this._image.height, t.drawImage(this._image, 0, 0, i.width, i.height), t.drawImage(this._painter_canvas, 0, 0, i.width, i.height), i.width > 1280 && i.height > 800 ? this.set_loading().delay(200).promise().done(function () {
                a._create_image_with_datasrc(i.toDataURL("image/png"), function () {
                    a.pen_tool_params_set(), a.hide_messagebox()
                })
            }) : this._create_image_with_datasrc(i.toDataURL("image/png"), function () {
                a.pen_tool_params_set()
            })
        },
        _hideAllNav: function (t) {
            t && 1 == t && this.set_messagebox("Open an image or use your camera to make a photo!"), i(this.element).find(".picedit_nav_box").removeClass("active").find(".picedit_element").removeClass("active")
        },
        _paintCanvas: function () {
            this._canvas.width = this._viewport.width, this._canvas.height = this._viewport.height, this._ctx.drawImage(this._image, 0, 0, this._viewport.width, this._viewport.height), i(this.element).find(".picedit_canvas").css("display", "block")
        },
        _calculateCropWindow: function () {
            var i = this._viewport,
                t = this._cropping.cropframe[0],
                e = {
                    width: this._image.width,
                    height: this._image.height
                },
                a = {
                    width: t.clientWidth,
                    height: t.clientHeight,
                    top: t.offsetTop > 0 ? t.offsetTop : .1,
                    left: t.offsetLeft > 0 ? t.offsetLeft : .1
                };
            a.width + a.left > i.width && (a.width = i.width - a.left), a.height + a.top > i.height && (a.height = i.height - a.top);
            var s = a.width / i.width,
                n = a.height / i.height,
                o = {
                    width: parseInt(e.width * s, 10),
                    height: parseInt(e.height * n, 10)
                },
                c = a.top / i.height,
                r = a.left / i.width;
            return o.top = parseInt(e.height * c, 10), o.left = parseInt(e.width * r, 10), o
        },
        _doRotation: function (i) {
            var t, a, s = i * Math.PI / 180,
                n = Math.cos(s),
                o = Math.sin(s);
            0 > o && (o = -o), 0 > n && (n = -n), t = this._image.height * o + this._image.width * n, a = this._image.height * n + this._image.width * o;
            var c = e.createElement("canvas"),
                r = c.getContext("2d");
            c.width = parseInt(t, 10), c.height = parseInt(a, 10);
            var d = c.width / 2,
                _ = c.height / 2;
            r.clearRect(0, 0, c.width, c.height), r.translate(d, _), r.rotate(s), r.drawImage(this._image, -this._image.width / 2, -this._image.height / 2), this._image.src = c.toDataURL("image/png"), this._paintCanvas(), this.options.imageUpdated(this._image)
        },
        _resizeViewport: function () {
            var t = this._image,
                e = {
                    width: t.width,
                    height: t.height
                };
            if ("auto" != this.options.maxWidth && t.width > this.options.maxWidth && (e.width = this.options.maxWidth), "auto" != this.options.maxHeight && t.height > this.options.maxHeight && (e.height = this.options.maxHeight), this.options.aspectRatio) {
                var a = t.width,
                    s = t.height,
                    n = a / s;
                a > e.width && (e.width = parseInt(e.width, 10), e.height = parseInt(e.width / n, 10)), s > e.height && (n = a / s, e.height = parseInt(e.height, 10), e.width = parseInt(e.height * n, 10))
            }
            i(this.element).css({
                width: e.width,
                height: e.height
            }), this._viewport = e, this._setVariable("resize_width", t.width), this._setVariable("resize_height", t.height)
        },
        _bindControlButtons: function () {
            var t = this;
            i(this.element).find(".picedit_control").bind("click", function () {
                var e = i(this).data("action");
                e ? t[e](this) : i(this).hasClass("picedit_action") && (i(this).parent(".picedit_element").toggleClass("active").siblings(".picedit_element").removeClass("active"), i(this).parent(".picedit_element").hasClass("active") ? i(this).closest(".picedit_nav_box").addClass("active") : i(this).closest(".picedit_nav_box").removeClass("active"))
            })
        },
        _bindInputVariables: function () {
            var t = this;
            i(this.element).find(".picedit_input").bind("change keypress paste input", function () {
                var e = i(this).data("variable");
                if (e) {
                    var a = i(this).val();
                    t._variables[e] = a
                }
                if (("resize_width" == e || "resize_height" == e) && t._variables.resize_proportions) {
                    var s = t._image.width / t._image.height;
                    "resize_width" == e ? t._setVariable("resize_height", parseInt(a / s, 10)) : t._setVariable("resize_width", parseInt(a * s, 10))
                }
            })
        },
        _setVariable: function (t, e) {
            this._variables[t] = e, i(this.element).find('[data-variable="' + t + '"]').val(e)
        },
        _formsubmit: function () {
            if (t.FormData) {
                var e = this;
                this.set_loading().delay(200).promise().done(function () {
                    if (e._theformdata = new FormData(e._theform[0]), e._image) {
                        var a = i(e.inputelement).prop("name") || "file",
                            s = e._dataURItoBlob(e._image.src);
                        e._filename ? e._filename = e._filename.match(/^[^\.]*/) + "." + s.type.match(/[^\/]*$/) : e._filename = s.type.replace("/", "."), e._theformdata.append(a, s, e._filename)
                    }
                    var n = new XMLHttpRequest;
                    n.onprogress = function (i) {
                        if (i.lengthComputable) var t = i.total;
                        else var t = Math.ceil(1.3 * s.size);
                        var a = Math.ceil(i.loaded / t * 100);
                        a > 100 && (a = 100), e.set_messagebox("Please Wait... Uploading... " + a + "% Uploaded.", !1, !1)
                    }, n.open(e._theform.prop("method"), e._theform.prop("action"), !0), n.onload = function (i) {
                        200 != this.status ? e.set_messagebox("Server did not accept data!") : e.options.redirectUrl === !0 ? t.location.reload() : e.options.redirectUrl ? t.location = e.options.redirectUrl : e.set_messagebox("Data successfully submitted!"), e.options.formSubmitted(this)
                    }, n.send(e._theformdata)
                }) location.reload(true);

            } else this.set_messagebox("Sorry, the FormData API is not supported!");
            return !1
        },
        _dataURItoBlob: function (i) {
            if (!i) return null;
            for (var t = i.match(/^data\:(.+?)\;/), e = atob(i.split(",")[1]), a = new ArrayBuffer(e.length), s = new Uint8Array(a), n = 0; n < e.length; n++) s[n] = e.charCodeAt(n);
            return new Blob([a], {
                type: t[1]
            })
        },
        _template: function () {
            var t = '<div class="picedit_box"> <
            div class = "picedit_message" > < span class = "picedit_control ico-picedit-close"
            data - action = "hide_messagebox" > < /span> <
            div > < /div> < /
            div > <
                div class = "picedit_nav_box picedit_gray_gradient" >
                <
                div class = "picedit_pos_elements" > < /div> <
            div class = "picedit_nav_elements" >
                <
                div class = "picedit_element" > < span class = "picedit_control picedit_action ico-picedit-pencil"
            title = "Pen Tool" > < /span> <
            div class = "picedit_control_menu" >
                <
                div class = "picedit_control_menu_container picedit_tooltip picedit_elm_3" >
                <
                label class = "picedit_colors" > < span title = "Black"
            class = "picedit_control picedit_action picedit_black active"
            data - action = "toggle_button"
            data - variable = "pen_color"
            data - value = "black" > < /span> <span title="Red" class="picedit_control picedit_action picedit_red" data-action="toggle_button" data-variable="pen_color" data-value="red"></span > < span title = "Green"
            class = "picedit_control picedit_action picedit_green"
            data - action = "toggle_button"
            data - variable = "pen_color"
            data - value = "green" > < /span> </label >
                <
                label > < span class = "picedit_separator" > < /span> </label >
                <
                label class = "picedit_sizes" > < span title = "Large"
            class = "picedit_control picedit_action picedit_large"
            data - action = "toggle_button"
            data - variable = "pen_size"
            data - value = "16" > < /span> <span title="Medium" class="picedit_control picedit_action picedit_medium" data-action="toggle_button" data-variable="pen_size" data-value="8"></span > < span title = "Small"
            class = "picedit_control picedit_action picedit_small"
            data - action = "toggle_button"
            data - variable = "pen_size"
            data - value = "3" > < /span> </label >
                <
                /div> < /
            div > <
                /div> <
            div class = "picedit_element" > < span class = "picedit_control picedit_action ico-picedit-insertpicture"
            title = "Crop"
            data - action = "crop_open" > < /span> </div >
                <
                div class = "picedit_element" > < span class = "picedit_control picedit_action ico-picedit-redo"
            title = "Rotate" > < /span> <
            div class = "picedit_control_menu" >
                <
                div class = "picedit_control_menu_container picedit_tooltip picedit_elm_1" >
                <
                label > < span > 90° CW < /span> <span class="picedit_control picedit_action ico-picedit-redo" data-action="rotate_cw"></span > < /label> <
            label > < span > 90° CCW < /span> <span class="picedit_control picedit_action ico-picedit-undo" data-action="rotate_ccw"></span > < /label> < /
            div > <
                /div> < /
            div > <
                div class = "picedit_element" > < span class = "picedit_control picedit_action ico-picedit-arrow-maximise"
            title = "Resize" > < /span> <
            div class = "picedit_control_menu" >
                <
                div class = "picedit_control_menu_container picedit_tooltip picedit_elm_2" >
                <
                label > < span class = "picedit_control picedit_action ico-picedit-checkmark"
            data - action = "resize_image" > < /span><span class="picedit_control picedit_action ico-picedit-close" data-action=""></span > < /label> <
            label > < span > Width(px) < /span> <
            input type = "text"
            class = "picedit_input"
            data - variable = "resize_width"
            value = "0" > < /label> <
            label class = "picedit_nomargin" > < span class = "picedit_control ico-picedit-link"
            data - action = "toggle_button"
            data - variable = "resize_proportions" > < /span> </label >
                <
                label > < span > Height(px) < /span> <
            input type = "text"
            class = "picedit_input"
            data - variable = "resize_height"
            value = "0" > < /label> < /
            div > <
                /div> < /
            div > <
                /div> < /
            div > <
                div class = "picedit_canvas_box" >
                <
                div class = "picedit_painter" >
                <
                canvas > < /canvas> < /
            div > <
                div class = "picedit_canvas" >
                <
                canvas > < /canvas> < /
            div > <
                div class = "picedit_action_btns active" >
                <
                div class = "picedit_control ico-picedit-picture"
            data - action = "load_image" > < /div> <
            div class = "picedit_control ico-picedit-camera"
            data - action = "camera_open" > < /div> <
            div class = "center" > or copy / paste image here < /div> < /
            div > <
                /div> <
            div class = "picedit_video" > ,
                e = this;
            i(this.inputelement).hide().after(t).each(function () {
                e.element = i(e.inputelement).next(".picedit_box"), e.init()
            })
        }
    }, i.fn[n] = function (t) {
        var e = arguments;
        if (t === a || "object" == typeof t) return this.each(function () {
            i.data(this, "plugin_" + n) || i.data(this, "plugin_" + n, new s(this, t))
        });
        if ("string" == typeof t && "_" !== t[0] && "init" !== t) {
            var o;
            return this.each(function () {
                var a = i.data(this, "plugin_" + n);
                a instanceof s && "function" == typeof a[t] && (o = a[t].apply(a, Array.prototype.slice.call(e, 1))), "destroy" === t && i.data(this, "plugin_" + n, null)
            }), o !== a ? o : this
        }
    }
}(jQuery, window, document);
