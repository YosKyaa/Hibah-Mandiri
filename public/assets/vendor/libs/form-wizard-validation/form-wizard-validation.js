!(function () {
    var n = $(".select2"),
        r = $(".selectpicker"),
        s = document.querySelector("#wizard-validation");
    if (null !== s) {
        var l = s.querySelector("#wizard-validation-form");
        let e = l.querySelector("#account-details-validation");
        var d = l.querySelector("#personal-info-validation"),
            m = l.querySelector("#social-links-validation"),
            u = [].slice.call(l.querySelectorAll(".btn-next")),
            p = [].slice.call(l.querySelectorAll(".btn-prev")),
            submitButton = l.querySelector(".btn-submit");
        let a = new Stepper(s, { linear: !0 }),
            i = FormValidation.formValidation(e, {
                fields: {
                    research_type: {
                        validators: {
                            notEmpty: {
                                message: "Jenis Penelitian wajib di isi",
                            },
                        },
                    },
                    research_categories: {
                        validators: {
                            notEmpty: {
                                message: "Kategori Penelitian wajib di isi",
                            },
                        },
                    },
                    research_themes: {
                        validators: {
                            notEmpty: {
                                message: "Tema Penelitian wajib di isi",
                            },
                        },
                    },
                    research_topics: {
                        validators: {
                            notEmpty: {
                                message: "Topik Penelitian wajib di isi",
                            },
                        },
                    },
                    research_title: {
                        validators: {
                            notEmpty: {
                                message: "Judul Penelitian Wajib di isi",
                            },
                        },
                    },
                    tkt_type: {
                        validators: {
                            notEmpty: { message: "TKT wajib di isi" },
                        },
                    },
                    main_research_target: {
                        validators: {
                            notEmpty: {
                                message: "Target Utama Riset wajib di isi",
                            },
                        },
                    },
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap5: new FormValidation.plugins.Bootstrap5({
                        eleValidClass: "",
                        rowSelector: ".col-sm-6",
                    }),
                    autoFocus: new FormValidation.plugins.AutoFocus(),
                    submitButton: new FormValidation.plugins.SubmitButton(),
                },
                init: (e) => {
                    e.on("plugins.message.placed", function (e) {
                        e.element.parentElement.classList.contains(
                            "input-group"
                        ) &&
                            e.element.parentElement.insertAdjacentElement(
                                "afterend",
                                e.messageElement
                            );
                    });
                },
            }).on("core.form.valid", function () {
                a.next();
            }),
            t = FormValidation.formValidation(d, {
                fields: {
                    researcher_id: {
                        validators: {
                            notEmpty: {
                                message: "Tim Penelitian wajib di isi",
                            },
                        },
                    },
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap5: new FormValidation.plugins.Bootstrap5({
                        eleValidClass: "",
                        rowSelector: ".col-sm-6",
                    }),
                    autoFocus: new FormValidation.plugins.AutoFocus(),
                    submitButton: new FormValidation.plugins.SubmitButton(),
                },
            }).on("core.form.valid", function () {
                a.next();
            }),
            o = FormValidation.formValidation(m, {
                fields: {
                    proposal_doc: {
                        validators: {
                            notEmpty: {
                                message: "Dokumen Proposal wajib di isi",
                            },
                        },
                    },
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap5: new FormValidation.plugins.Bootstrap5({
                        eleValidClass: "",
                        rowSelector: ".col-sm-12",
                    }),
                    autoFocus: new FormValidation.plugins.AutoFocus(),
                    submitButton: new FormValidation.plugins.SubmitButton(),
                },
            }).on("core.form.valid", function () {
                l.submit();
            });
        u.forEach((e) => {
            e.addEventListener("click", (e) => {
                switch (a._currentIndex) {
                    case 0:
                        i.validate();
                        break;
                    case 1:
                        t.validate();
                        break;
                    case 2:
                        o.validate();
                }
            });
        }),
            p.forEach((e) => {
                e.addEventListener("click", (e) => {
                    switch (a._currentIndex) {
                        case 2:
                        case 1:
                            a.previous();
                    }
                });
            }),
            submitButton.addEventListener("click", function () {
                o.validate().then(function (status) {
                    if (status === "Valid") {
                        l.submit();
                    }
                });
            });
    }
})();
