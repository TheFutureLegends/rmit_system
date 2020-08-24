/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/app.js":
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
/*! no static exports found */
/***/ (function(module, exports) {

$.ajaxSetup({
  headers: {
    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
  }
});

(function () {
  "use strict";

  window.addEventListener("load", function () {
    var forms = document.getElementsByClassName("needs-validation");
    var validation = Array.prototype.filter.call(forms, function (form) {
      form.addEventListener("submit", function (event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }

        form.classList.add("was-validated");
      }, false);
    });
  }, false);
})();

utility = {
  isExists: function isExists(elem) {
    if ($(elem).length > 0) {
      return true;
    }

    return false;
  },
  bootstrapSelectEmptyRefreshDisabled: function bootstrapSelectEmptyRefreshDisabled(target, caseType) {
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
  bootstrapSelectData: function bootstrapSelectData(target, response) {
    if (response !== null) {
      $(target).prop("disabled", false);
      utility.bootstrapSelectEmptyRefreshDisabled(target, "1");
      $.each(response, function (key, value) {
        $(target).append('<option value="' + value.id + '">' + value.name + "</option>");
      });
      utility.bootstrapSelectEmptyRefreshDisabled(target, "2");
    } else {
      utility.bootstrapSelectEmptyRefreshDisabled(target, "4");
    }
  },
  formatErrorMessage: function formatErrorMessage(jqXHR, exception) {
    if (jqXHR.status === 0) {
      return utility.swalError("Not connected.\nPlease verify your network connection.");
    } else if (jqXHR.status == 404) {
      return utility.swalError("The requested page not found.");
    } else if (jqXHR.status == 401) {
      return utility.swalError("Sorry!! You session has expired. Please login to continue access.");
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

      if (exception === "Symfony\\Component\\HttpKernel\\Exception\\AccessDeniedHttpException") {
        return utility.swalError("You do not have authorization!");
      }

      return utility.swalError("Unknown error occured. Please try again.");
    }
  },
  swalError: function swalError(message) {
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
  $(document).on("click", ".choose-file", function (e) {
    e.preventDefault();
    $("#proposal").click();
  });
  $("#proposal").change(function () {
    var names = "";

    for (var i = 0; i < $(this).get(0).files.length; ++i) {
      if (i < $(this).get(0).files.length - 1) {
        names += $(this).get(0).files.item(i).name + ", ";
      } else {
        names += $(this).get(0).files.item(i).name;
      }
    }

    $(this).parent().find("#file-text").val(names);
  });
}

if (utility.isExists("#choose-cover") && utility.isExists("#cover") && utility.isExists("#remove-cover") && utility.isExists("#preview")) {
  $(document).on("click", "#choose-cover", function (e) {
    e.preventDefault();
    $("#cover").click();
  });
  $("#cover").change(function () {
    if (this.files && this.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
        $("#preview").attr("src", e.target.result);
      };

      reader.readAsDataURL(this.files[0]); // convert to base64 string
    }

    $("#remove-cover").removeAttr("hidden");
  });
  $(document).on("click", "#remove-cover", function (e) {
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
    toolbar: "undo redo | styleselect | bold italic | outdent indent | sizeselect | fontselect |  fontsizeselect | link image |"
  });
}

if (utility.isExists("#event-approve") && utility.isExists("#event-deny")) {
  $(document).on("click", "#event-approve", function (e) {
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
  $(document).on("click", "#event-deny", function (e) {
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
  $("#event_start").data("DateTimePicker").format("DD-MMM-YYYY h:mm A");
  $("#event_end").data("DateTimePicker").format("DD-MMM-YYYY h:mm A");
  $("#event_start").on("dp.change", function (e) {
    $("#event_end").data("DateTimePicker").minDate(e.date);
  });
  $("#event_end").on("dp.change", function (e) {
    $("#event_start").data("DateTimePicker").maxDate(e.date);
  });
}

if (utility.isExists("#clubs-dataTables")) {
  $("#clubs-dataTables").DataTable({
    order: [[0, "asc"]],
    pagingType: "full_numbers",
    lengthMenu: [[50, 100, 150, -1], [50, 100, 150, "All"]],
    processing: true,
    serverSide: true,
    ajax: {
      url: "/dashboard/clubs/dataTable",
      type: "POST"
    },
    columns: [{
      data: "abbreviation",
      name: "abbreviation"
    }, {
      data: "name",
      name: "name"
    }, {
      data: "owner",
      name: "owner"
    }, {
      data: "action",
      className: "text-center",
      orderable: false,
      searchable: false
    }],
    language: {
      url: "/dashboard/dataTable/language"
    },
    fnDrawCallback: function fnDrawCallback() {}
  });
  $(document).on("click", ".club-remove", function (e) {
    var _this = this;

    e.preventDefault();
    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!"
    }).then(function (result) {
      if (result.value) {
        $.ajax({
          url: "/dashboard/club/delete/" + $(_this).data("slug"),
          type: "DELETE",
          success: function success(data) {
            var table_id = $(_this).parent().parent().parent().parent().attr("id");
            $("#" + table_id).DataTable().ajax.reload();
          },
          error: function error(jqXHR, textStatus, errorThrown) {
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
    lengthMenu: [[50, 100, 150, -1], [50, 100, 150, "All"]],
    processing: true,
    serverSide: true,
    ajax: {
      url: "/dashboard/events/dataTable",
      type: "POST"
    },
    columns: [{
      data: "name",
      name: "name"
    }, {
      data: "created",
      name: "created"
    }, {
      data: "start_at",
      name: "start_at"
    }, {
      data: "duration",
      name: "duration"
    }, {
      data: "status",
      name: "status"
    }, {
      data: "action",
      className: "text-center",
      orderable: false,
      searchable: false
    }],
    language: {
      url: "/dashboard/dataTable/language"
    },
    fnDrawCallback: function fnDrawCallback() {}
  });
  $(document).on("click", ".event-remove", function (e) {
    var _this2 = this;

    e.preventDefault();
    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!"
    }).then(function (result) {
      if (result.value) {
        $.ajax({
          url: "/dashboard/event/delete/" + $(_this2).data("slug"),
          type: "DELETE",
          success: function success(data) {
            var table_id = $(_this2).parent().parent().parent().parent().attr("id");
            $("#" + table_id).DataTable().ajax.reload();
          },
          error: function error(jqXHR, textStatus, errorThrown) {
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
    lengthMenu: [[50, 100, 150, -1], [50, 100, 150, "All"]],
    processing: true,
    serverSide: true,
    ajax: {
      url: "/dashboard/users/dataTable",
      type: "POST"
    },
    columns: [{
      data: "name",
      name: "name"
    }, {
      data: "email",
      name: "email"
    }, {
      data: "access",
      name: "access"
    }, {
      data: "action",
      className: "text-right",
      orderable: false,
      searchable: false
    }],
    language: {
      url: "/dashboard/dataTable/language"
    },
    fnDrawCallback: function fnDrawCallback() {}
  });
  $(document).on("click", ".user-remove", function (e) {
    var _this3 = this;

    e.preventDefault();
    Swal.fire({
      title: "Are you sure?",
      text: "Current user and all of her/his related information will be also deleted!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, remove it!"
    }).then(function (result) {
      if (result.value) {
        $.ajax({
          url: "/dashboard/user/delete/" + $(_this3).data("email"),
          type: "DELETE",
          success: function success(data) {
            var table_id = $(_this3).parent().parent().parent().parent().attr("id");
            $("#" + table_id).DataTable().ajax.reload();
          },
          error: function error(jqXHR, textStatus, errorThrown) {
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
    lengthMenu: [[50, 100, 150, -1], [50, 100, 150, "All"]],
    processing: true,
    serverSide: true,
    ajax: {
      url: "/dashboard/roles/dataTable",
      type: "POST"
    },
    columns: [{
      data: "name",
      name: "name"
    }, {
      data: "action",
      className: "text-center",
      orderable: false,
      searchable: false
    }],
    language: {
      url: "/dashboard/dataTable/language"
    },
    fnDrawCallback: function fnDrawCallback() {}
  });
  $(document).on("click", ".role-remove", function (e) {
    var _this4 = this;

    e.preventDefault();
    Swal.fire({
      title: "Are you sure?",
      text: "You cannot revert this action",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, remove it!"
    }).then(function (result) {
      if (result.value) {
        $.ajax({
          url: "/dashboard/role/delete/" + $(_this4).data("name"),
          type: "DELETE",
          success: function success(data) {
            var table_id = $(_this4).parent().parent().parent().parent().attr("id");
            $("#" + table_id).DataTable().ajax.reload();
          },
          error: function error(jqXHR, textStatus, errorThrown) {
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
    lengthMenu: [[50, 100, 150, -1], [50, 100, 150, "All"]],
    processing: true,
    serverSide: true,
    ajax: {
      url: "/dashboard/permissions/dataTable",
      type: "POST"
    },
    columns: [{
      data: "name",
      name: "name"
    }, {
      data: "role",
      name: "role"
    }, {
      data: "action",
      className: "text-center",
      orderable: false,
      searchable: false
    }],
    language: {
      url: "/dashboard/dataTable/language"
    },
    fnDrawCallback: function fnDrawCallback() {}
  });
  $(document).on("click", ".permission-remove", function (e) {
    var _this5 = this;

    e.preventDefault();
    Swal.fire({
      title: "Are you sure?",
      text: "You cannot revert this action",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, remove it!"
    }).then(function (result) {
      if (result.value) {
        $.ajax({
          url: "/dashboard/permission/delete/" + $(_this5).data("name"),
          type: "DELETE",
          success: function success(data) {
            var table_id = $(_this5).parent().parent().parent().parent().attr("id");
            $("#" + table_id).DataTable().ajax.reload();
          },
          error: function error(jqXHR, textStatus, errorThrown) {
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

$(document).ready(function () {
  if (utility.isExists("#clubs")) {
    $(".clubs").select2({
      placeholder: "Select club",
      width: "100%",
      ajax: {
        url: "/dashboard/clubs/loadOptions",
        method: "POST",
        dataType: "JSON",
        data: function data(params) {
          var query = {
            search: params.term
          };
          return query;
        },
        processResults: function processResults(data) {
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
        data: function data(params) {
          var query = {
            search: params.term
          };
          return query;
        },
        processResults: function processResults(data) {
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
        data: function data(params) {
          var query = {
            search: params.term
          };
          return query;
        },
        processResults: function processResults(data) {
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
        data: function data(params) {
          var query = {
            search: params.term
          };
          return query;
        },
        processResults: function processResults(data) {
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
        data: function data(params) {
          var query = {
            search: params.term
          };
          return query;
        },
        processResults: function processResults(data) {
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
        data: function data(params) {
          var query = {
            search: params.term
          };
          return query;
        },
        processResults: function processResults(data) {
          return {
            results: data
          };
        }
      }
    });
  }

  $(".alert").fadeIn("slow", function () {
    setTimeout(function () {
      $(".alert").slideUp();
    }, 4000);
  });
  setTimeout(function () {
    $(".alert").remove();
  }, 4500);
});

/***/ }),

/***/ "./resources/sass/app.scss":
/*!*********************************!*\
  !*** ./resources/sass/app.scss ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 0:
/*!*************************************************************!*\
  !*** multi ./resources/js/app.js ./resources/sass/app.scss ***!
  \*************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! /Users/leon/Dev/laravel/event/resources/js/app.js */"./resources/js/app.js");
module.exports = __webpack_require__(/*! /Users/leon/Dev/laravel/event/resources/sass/app.scss */"./resources/sass/app.scss");


/***/ })

/******/ });