! function() {
    var n = $(".select2"),
        r = $(".selectpicker"),
        s = document.querySelector("#wizard-validation");
    if (null !== s) {
        var l = s.querySelector("#wizard-validation-form");
        let e = l.querySelector("#account-details-validation");
        var d = l.querySelector("#personal-info-validation"),
            m = l.querySelector("#social-links-validation"),
            u = [].slice.call(l.querySelectorAll(".btn-next")),
            l = [].slice.call(l.querySelectorAll(".btn-prev"));
        let a = new Stepper(s, {
                linear: !0
            }),
            i = FormValidation.formValidation(e, {
                fields: {
                    formValidationUsername: {
                        validators: {
                            notEmpty: {
                                message: "The name is required"
                            },
                            stringLength: {
                                min: 6,
                                max: 30,
                                message: "The name must be more than 6 and less than 30 characters long"
                            },
                            regexp: {
                                regexp: /^[a-zA-Z0-9 ]+$/,
                                message: "The name can only consist of alphabetical, number and space"
                            }
                        }
                    },
                    formValidationEmail: {
                        validators: {
                            notEmpty: {
                                message: "The Email is required"
                            },
                            emailAddress: {
                                message: "The value is not a valid email address"
                            }
                        }
                    },
                    formValidationPass: {
                        validators: {
                            notEmpty: {
                                message: "The password is required"
                            }
                        }
                    },
                    formValidationConfirmPass: {
                        validators: {
                            notEmpty: {
                                message: "The Confirm Password is required"
                            },
                            identical: {
                                compare: function() {
                                    return e.querySelector('[name="formValidationPass"]').value
                                },
                                message: "The password and its confirm are not the same"
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger,
                    bootstrap5: new FormValidation.plugins.Bootstrap5({
                        eleValidClass: "",
                        rowSelector: ".col-sm-6"
                    }),
                    autoFocus: new FormValidation.plugins.AutoFocus,
                    submitButton: new FormValidation.plugins.SubmitButton
                },
                init: e => {
                    e.on("plugins.message.placed", function(e) {
                        e.element.parentElement.classList.contains("input-group") && e.element.parentElement.insertAdjacentElement("afterend", e.messageElement)
                    })
                }
            }).on("core.form.valid", function() {
                a.next()
            }),
            t = FormValidation.formValidation(d, {
                fields: {
                    formValidationFirstName: {
                        validators: {
                            notEmpty: {
                                message: "The first name is required"
                            }
                        }
                    },
                    formValidationLastName: {
                        validators: {
                            notEmpty: {
                                message: "The last name is required"
                            }
                        }
                    },
                    formValidationCountry: {
                        validators: {
                            notEmpty: {
                                message: "The Country is required"
                            }
                        }
                    },
                    formValidationLanguage: {
                        validators: {
                            notEmpty: {
                                message: "The Languages is required"
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger,
                    bootstrap5: new FormValidation.plugins.Bootstrap5({
                        eleValidClass: "",
                        rowSelector: ".col-sm-6"
                    }),
                    autoFocus: new FormValidation.plugins.AutoFocus,
                    submitButton: new FormValidation.plugins.SubmitButton
                }
            }).on("core.form.valid", function() {
                a.next()
            }),
            o = (r.length && r.each(function() {
                $(this).selectpicker().on("change", function() {
                    t.revalidateField("formValidationLanguage")
                })
            }), n.length && n.each(function() {
                var e = $(this);
                e.wrap('<div class="position-relative"></div>'), e.select2({
                    placeholder: "Select an country",
                    dropdownParent: e.parent()
                }).on("change", function() {
                    t.revalidateField("formValidationCountry")
                })
            }), FormValidation.formValidation(m, {
                fields: {
                    formValidationTwitter: {
                        validators: {
                            notEmpty: {
                                message: "The Twitter URL is required"
                            },
                            uri: {
                                message: "The URL is not proper"
                            }
                        }
                    },
                    formValidationFacebook: {
                        validators: {
                            notEmpty: {
                                message: "The Facebook URL is required"
                            },
                            uri: {
                                message: "The URL is not proper"
                            }
                        }
                    },
                    formValidationGoogle: {
                        validators: {
                            notEmpty: {
                                message: "The Google URL is required"
                            },
                            uri: {
                                message: "The URL is not proper"
                            }
                        }
                    },
                    formValidationLinkedIn: {
                        validators: {
                            notEmpty: {
                                message: "The LinkedIn URL is required"
                            },
                            uri: {
                                message: "The URL is not proper"
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger,
                    bootstrap5: new FormValidation.plugins.Bootstrap5({
                        eleValidClass: "",
                        rowSelector: ".col-sm-6"
                    }),
                    autoFocus: new FormValidation.plugins.AutoFocus,
                    submitButton: new FormValidation.plugins.SubmitButton
                }
            }).on("core.form.valid", function() {
                alert("Submitted..!!")
            }));
        u.forEach(e => {
            e.addEventListener("click", e => {
                switch (a._currentIndex) {
                    case 0:
                        i.validate();
                        break;
                    case 1:
                        t.validate();
                        break;
                    case 2:
                        o.validate()
                }
            })
        }), l.forEach(e => {
            e.addEventListener("click", e => {
                switch (a._currentIndex) {
                    case 2:
                    case 1:
                        a.previous()
                }
            })
        })
    }
}();