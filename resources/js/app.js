$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
    }
});

(function() {
    "use strict";
    window.addEventListener(
        "load",
        function() {
            var forms = document.getElementsByClassName("needs-validation");
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener(
                    "submit",
                    function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add("was-validated");
                    },
                    false
                );
            });
        },
        false
    );
})();

utility = {
    isExists: elem => {
        if ($(elem).length > 0) {
            return true;
        }
        return false;
    },

    bootstrapSelectEmptyRefreshDisabled: (target, caseType) => {
        if (caseType === "1") {
            // only empty
            $(target).empty();
        } else if (caseType === "2") {
            // only refresh
            $(target).selectpicker("refresh");
        } else if (caseType === "3") {
            // Only disable
            $(target).prop("disabled", true);
        } else {
            $(target).empty();
            $(target).prop("disabled", true);
            $(target).selectpicker("refresh");
        }
    },

    bootstrapSelectData: (target, response) => {
        if (response !== null) {
            $(target).prop("disabled", false);
            utility.bootstrapSelectEmptyRefreshDisabled(target, "1");

            $.each(response, function(key, value) {
                $(target).append(
                    '<option value="' +
                        value.id +
                        '">' +
                        value.name +
                        "</option>"
                );
            });

            utility.bootstrapSelectEmptyRefreshDisabled(target, "2");
        } else {
            utility.bootstrapSelectEmptyRefreshDisabled(target, "4");
        }
    },

    formatErrorMessage: (jqXHR, exception) => {
        if (jqXHR.status === 0) {
            return utility.swalError(
                "Not connected.\nPlease verify your network connection."
            );
        } else if (jqXHR.status == 404) {
            return utility.swalError("The requested page not found.");
        } else if (jqXHR.status == 401) {
            return utility.swalError(
                "Sorry!! You session has expired. Please login to continue access."
            );
        } else if (jqXHR.status == 500) {
            return utility.swalError("Internal Server Error.");
        } else if (exception === "parsererror") {
            return utility.swalError("Requested JSON parse failed.");
        } else if (exception === "timeout") {
            return utility.swalError("Time out error.");
        } else if (exception === "abort") {
            return utility.swalError("Ajax request aborted.");
        } else {
            if (jqXHR.status == 403) {
                return utility.swalError("You do not have authorization!");
            }
            if (
                exception ===
                "Symfony\\Component\\HttpKernel\\Exception\\AccessDeniedHttpException"
            ) {
                return utility.swalError("You do not have authorization!");
            }
            return utility.swalError(
                "Unknown error occured. Please try again."
            );
        }
    },

    swalError: message => {
        Swal.fire({
            title: "Error!",
            text: message,
            icon: "error",
            showConfirmButton: false,
            timer: 2000
        });
    }
};

if (utility.isExists("#choose-file") && utility.isExists("#proposal")) {
    $(document).on("click", ".choose-file", function(e) {
        e.preventDefault();

        $("#proposal").click();
    });

    $("#proposal").change(function() {
        var names = "";
        for (var i = 0; i < $(this).get(0).files.length; ++i) {
            if (i < $(this).get(0).files.length - 1) {
                names +=
                    $(this)
                        .get(0)
                        .files.item(i).name + ", ";
            } else {
                names += $(this)
                    .get(0)
                    .files.item(i).name;
            }
        }
        $(this)
            .parent()
            .find("#file-text")
            .val(names);
    });
}

if (
    utility.isExists("#choose-cover") &&
    utility.isExists("#cover") &&
    utility.isExists("#remove-cover") &&
    utility.isExists("#preview")
) {
    $(document).on("click", "#choose-cover", function(e) {
        e.preventDefault();

        $("#cover").click();
    });

    $("#cover").change(function() {
        if (this.files && this.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $("#preview").attr("src", e.target.result);
            };

            reader.readAsDataURL(this.files[0]); // convert to base64 string
        }

        $("#remove-cover").removeAttr("hidden");
    });

    $(document).on("click", "#remove-cover", function(e) {
        e.preventDefault();

        $("#cover").val("");

        $("#preview").attr("src", "https://i.imgur.com/aDn2yGH.jpg");

        $("#remove-cover").attr("hidden", "hidden");
    });
}

if (utility.isExists("#description")) {
    tinymce.init({
        selector: "#description",
        height: "452",
        branding: false,
        plugins: "link image",
        toolbar:
            "undo redo | styleselect | bold italic | outdent indent | sizeselect | fontselect |  fontsizeselect | link image |"
    });
}

if (utility.isExists("#event-approve") && utility.isExists("#event-deny")) {
    $(document).on("click", "#event-approve", function(e) {
        e.preventDefault();

        $.ajax({
            url: "/dashboard/event/feedback",
            type: "POST",
            data: {
                feedback: tinymce.get("description").getContent(),
                slug: $(this).data("slug"),
                status: $(this).data("status")
            },
            success: function success(data) {
                window.location = data.url;
            },
            error: function error(jqXHR, textStatus, errorThrown) {
                utility.formatErrorMessage(jqXHR, errorThrown);
            }
        });
    });

    $(document).on("click", "#event-deny", function(e) {
        e.preventDefault();

        if (tinymce.get("description").getContent() == "") {
            return utility.swalError("Give us reason why you deny");
        }

        $.ajax({
            url: "/dashboard/event/feedback",
            type: "POST",
            data: {
                feedback: tinymce.get("description").getContent(),
                slug: $(this).data("slug"),
                status: $(this).data("status")
            },
            success: function success(data) {
                window.location = data.url;
            },
            error: function error(jqXHR, textStatus, errorThrown) {
                utility.formatErrorMessage(jqXHR, errorThrown);
            }
        });
    });
}

if (utility.isExists("#event_start") && utility.isExists("#event_end")) {
    $("#event_start").datetimepicker({
        stepping: 15,
        minDate: moment(),
        icons: {
            time: "fa fa-clock-o",
            date: "fa fa-calendar",
            up: "fa fa-chevron-up",
            down: "fa fa-chevron-down",
            previous: "fa fa-chevron-left",
            next: "fa fa-chevron-right",
            today: "fa fa-screenshot",
            clear: "fa fa-trash",
            close: "fa fa-remove"
        }
    });

    $("#event_end").datetimepicker({
        useCurrent: false,
        stepping: 15,
        icons: {
            time: "fa fa-clock-o",
            date: "fa fa-calendar",
            up: "fa fa-chevron-up",
            down: "fa fa-chevron-down",
            previous: "fa fa-chevron-left",
            next: "fa fa-chevron-right",
            today: "fa fa-screenshot",
            clear: "fa fa-trash",
            close: "fa fa-remove"
        }
    });

    $("#event_start")
        .data("DateTimePicker")
        .format("DD-MMM-YYYY h:mm A");

    $("#event_end")
        .data("DateTimePicker")
        .format("DD-MMM-YYYY h:mm A");

    $("#event_start").on("dp.change", function(e) {
        $("#event_end")
            .data("DateTimePicker")
            .minDate(e.date);
    });
    $("#event_end").on("dp.change", function(e) {
        $("#event_start")
            .data("DateTimePicker")
            .maxDate(e.date);
    });
}

if (utility.isExists("#clubs-dataTables")) {
    $("#clubs-dataTables").DataTable({
        order: [[0, "asc"]],
        pagingType: "full_numbers",
        lengthMenu: [
            [50, 100, 150, -1],
            [50, 100, 150, "All"]
        ],
        processing: true,
        serverSide: true,
        ajax: {
            url: "/dashboard/clubs/dataTable",
            type: "POST"
        },
        columns: [
            {
                data: "abbreviation",
                name: "abbreviation"
            },
            {
                data: "name",
                name: "name"
            },
            {
                data: "owner",
                name: "owner"
            },
            {
                data: "action",
                className: "text-center",
                orderable: false,
                searchable: false
            }
        ],
        language: {
            url: "/dashboard/dataTable/language"
        },
        fnDrawCallback: () => {}
    });

    $(document).on("click", ".club-remove", function(e) {
        e.preventDefault();

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then(result => {
            if (result.value) {
                $.ajax({
                    url: "/dashboard/club/delete/" + $(this).data("slug"),
                    type: "DELETE",
                    success: data => {
                        var table_id = $(this)
                            .parent()
                            .parent()
                            .parent()
                            .parent()
                            .attr("id");

                        $("#" + table_id)
                            .DataTable()
                            .ajax.reload();
                    },
                    error: (jqXHR, textStatus, errorThrown) => {
                        utility.formatErrorMessage(jqXHR, errorThrown);
                    }
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                // Cancel button is pressed
                Swal.fire({
                    icon: "info",
                    title: "Your data is safe!",
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        });
    });
}

if (utility.isExists("#events-dataTables")) {
    $("#events-dataTables").DataTable({
        order: [[0, "asc"]],
        pagingType: "full_numbers",
        lengthMenu: [
            [50, 100, 150, -1],
            [50, 100, 150, "All"]
        ],
        processing: true,
        serverSide: true,
        ajax: {
            url: "/dashboard/events/dataTable",
            type: "POST"
        },
        columns: [
            {
                data: "name",
                name: "name"
            },
            {
                data: "created",
                name: "created"
            },
            {
                data: "start_at",
                name: "start_at"
            },
            {
                data: "duration",
                name: "duration"
            },
            {
                data: "status",
                name: "status"
            },
            {
                data: "action",
                className: "text-center",
                orderable: false,
                searchable: false
            }
        ],
        language: {
            url: "/dashboard/dataTable/language"
        },
        fnDrawCallback: () => {}
    });

    $(document).on("click", ".event-remove", function(e) {
        e.preventDefault();

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then(result => {
            if (result.value) {
                $.ajax({
                    url: "/dashboard/event/delete/" + $(this).data("slug"),
                    type: "DELETE",
                    success: data => {
                        var table_id = $(this)
                            .parent()
                            .parent()
                            .parent()
                            .parent()
                            .attr("id");

                        $("#" + table_id)
                            .DataTable()
                            .ajax.reload();
                    },
                    error: (jqXHR, textStatus, errorThrown) => {
                        utility.formatErrorMessage(jqXHR, errorThrown);
                    }
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                // Cancel button is pressed
                Swal.fire({
                    icon: "info",
                    title: "Your data is safe!",
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        });
    });
}

if (utility.isExists("#users-dataTables")) {
    $("#users-dataTables").DataTable({
        order: [[0, "asc"]],
        pagingType: "full_numbers",
        lengthMenu: [
            [50, 100, 150, -1],
            [50, 100, 150, "All"]
        ],
        processing: true,
        serverSide: true,
        ajax: {
            url: "/dashboard/users/dataTable",
            type: "POST"
        },
        columns: [
            {
                data: "name",
                name: "name"
            },
            {
                data: "email",
                name: "email"
            },
            {
                data: "access",
                name: "access"
            },
            {
                data: "action",
                className: "text-right",
                orderable: false,
                searchable: false
            }
        ],
        language: {
            url: "/dashboard/dataTable/language"
        },
        fnDrawCallback: () => {}
    });

    $(document).on("click", ".user-remove", function(e) {
        e.preventDefault();

        Swal.fire({
            title: "Are you sure?",
            text:
                "Current user and all of her/his related information will be also deleted!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, remove it!"
        }).then(result => {
            if (result.value) {
                $.ajax({
                    url: "/dashboard/user/delete/" + $(this).data("email"),
                    type: "DELETE",
                    success: data => {
                        var table_id = $(this)
                            .parent()
                            .parent()
                            .parent()
                            .parent()
                            .attr("id");

                        $("#" + table_id)
                            .DataTable()
                            .ajax.reload();
                    },
                    error: (jqXHR, textStatus, errorThrown) => {
                        utility.formatErrorMessage(jqXHR, errorThrown);
                    }
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                // Cancel button is pressed
                Swal.fire({
                    icon: "info",
                    title: "Your data is safe!",
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        });
    });
}

if (utility.isExists("#roles-dataTables")) {
    $("#roles-dataTables").DataTable({
        order: [[0, "asc"]],
        pagingType: "full_numbers",
        lengthMenu: [
            [50, 100, 150, -1],
            [50, 100, 150, "All"]
        ],
        processing: true,
        serverSide: true,
        ajax: {
            url: "/dashboard/roles/dataTable",
            type: "POST"
        },
        columns: [
            {
                data: "name",
                name: "name"
            },
            {
                data: "action",
                className: "text-center",
                orderable: false,
                searchable: false
            }
        ],
        language: {
            url: "/dashboard/dataTable/language"
        },
        fnDrawCallback: () => {}
    });

    $(document).on("click", ".role-remove", function(e) {
        e.preventDefault();

        Swal.fire({
            title: "Are you sure?",
            text: "You cannot revert this action",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, remove it!"
        }).then(result => {
            if (result.value) {
                $.ajax({
                    url: "/dashboard/role/delete/" + $(this).data("name"),
                    type: "DELETE",
                    success: data => {
                        var table_id = $(this)
                            .parent()
                            .parent()
                            .parent()
                            .parent()
                            .attr("id");

                        $("#" + table_id)
                            .DataTable()
                            .ajax.reload();
                    },
                    error: (jqXHR, textStatus, errorThrown) => {
                        utility.formatErrorMessage(jqXHR, errorThrown);
                    }
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                // Cancel button is pressed
                Swal.fire({
                    icon: "info",
                    title: "Your data is safe!",
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        });
    });
}

if (utility.isExists("#permissions-dataTables")) {
    $("#permissions-dataTables").DataTable({
        order: [[0, "asc"]],
        pagingType: "full_numbers",
        lengthMenu: [
            [50, 100, 150, -1],
            [50, 100, 150, "All"]
        ],
        processing: true,
        serverSide: true,
        ajax: {
            url: "/dashboard/permissions/dataTable",
            type: "POST"
        },
        columns: [
            {
                data: "name",
                name: "name"
            },
            {
                data: "role",
                name: "role"
            },
            {
                data: "action",
                className: "text-center",
                orderable: false,
                searchable: false
            }
        ],
        language: {
            url: "/dashboard/dataTable/language"
        },
        fnDrawCallback: () => {}
    });

    $(document).on("click", ".permission-remove", function(e) {
        e.preventDefault();

        Swal.fire({
            title: "Are you sure?",
            text: "You cannot revert this action",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, remove it!"
        }).then(result => {
            if (result.value) {
                $.ajax({
                    url: "/dashboard/permission/delete/" + $(this).data("name"),
                    type: "DELETE",
                    success: data => {
                        var table_id = $(this)
                            .parent()
                            .parent()
                            .parent()
                            .parent()
                            .attr("id");

                        $("#" + table_id)
                            .DataTable()
                            .ajax.reload();
                    },
                    error: (jqXHR, textStatus, errorThrown) => {
                        utility.formatErrorMessage(jqXHR, errorThrown);
                    }
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                // Cancel button is pressed
                Swal.fire({
                    icon: "info",
                    title: "Your data is safe!",
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        });
    });
}

$(document).ready(function() {
    if (utility.isExists("#clubs")) {
        $(".clubs").select2({
            placeholder: "Select club",
            width: "100%",
            ajax: {
                url: "/dashboard/clubs/loadOptions",
                method: "POST",
                dataType: "JSON",
                data: params => {
                    var query = {
                        search: params.term
                    };

                    return query;
                },
                processResults: data => {
                    return {
                        results: data
                    };
                }
            }
        });
    }

    if (utility.isExists("#president")) {
        $(".president").select2({
            placeholder: "Select president",
            width: "100%",
            ajax: {
                url: "/dashboard/users/loadPresidentOptions",
                method: "POST",
                dataType: "JSON",
                data: params => {
                    var query = {
                        search: params.term
                    };

                    return query;
                },
                processResults: data => {
                    return {
                        results: data
                    };
                }
            }
        });
    }

    if (utility.isExists("#advisor")) {
        $(".advisor").select2({
            placeholder: "Select advisor",
            width: "100%",
            ajax: {
                url: "/dashboard/users/loadAdvisorOptions",
                method: "POST",
                dataType: "JSON",
                data: params => {
                    var query = {
                        search: params.term
                    };

                    return query;
                },
                processResults: data => {
                    return {
                        results: data
                    };
                }
            }
        });
    }

    if (utility.isExists("#available-advisor")) {
        $(".available-advisor").select2({
            placeholder: "Select advisor",
            width: "100%",
            height: "50px",
            ajax: {
                url: "/dashboard/users/loadAdvisorWithNoClubOptions",
                method: "POST",
                dataType: "JSON",
                data: params => {
                    var query = {
                        search: params.term
                    };

                    return query;
                },
                processResults: data => {
                    return {
                        results: data
                    };
                }
            }
        });
    }

    if (utility.isExists("#role")) {
        $(".role").select2({
            placeholder: "Select role for member",
            width: "100%",
            ajax: {
                url: "/dashboard/teams/loadRoleForMember",
                method: "POST",
                dataType: "JSON",
                data: params => {
                    var query = {
                        search: params.term
                    };

                    return query;
                },
                processResults: data => {
                    return {
                        results: data
                    };
                }
            }
        });
    }

    if (utility.isExists("#roles")) {
        $(".roles").select2({
            placeholder: "Select roles",
            width: "100%",
            ajax: {
                url: "/dashboard/roles/loadOptions",
                method: "POST",
                dataType: "JSON",
                data: params => {
                    var query = {
                        search: params.term
                    };

                    return query;
                },
                processResults: data => {
                    return {
                        results: data
                    };
                }
            }
        });
    }

    if (utility.isExists("#permissions")) {
        $(".permissions").select2({
            placeholder: "Select permissions to assign",
            width: "100%",
            ajax: {
                url: "/dashboard/permissions/loadOptions",
                method: "POST",
                dataType: "JSON",
                data: params => {
                    var query = {
                        search: params.term
                    };

                    return query;
                },
                processResults: data => {
                    return {
                        results: data
                    };
                }
            }
        });
    }

    $(".alert").fadeIn("slow", function() {
        setTimeout(function() {
            $(".alert").slideUp();
        }, 4000);
    });

    setTimeout(function() {
        $(".alert").remove();
    }, 4500);
});
