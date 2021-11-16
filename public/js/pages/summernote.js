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
/******/ 	return __webpack_require__(__webpack_require__.s = 4);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/pages/summernote.js":
/*!******************************************!*\
  !*** ./resources/js/pages/summernote.js ***!
  \******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

function sendFile(file) {
        var out = new FormData();
        out.append('file', file, file.name);
        jQuery.ajax({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        },
        method: 'POST',
        url: '/files',
        contentType: false,
        cache: false,
        processData: false,
        data: out,
        success: function success(data) {
            jQuery('.js-summernote').summernote('insertImage', '/files/' + data.idx);
        },
        error: function error(jqXHR, textStatus, errorThrown) {
            console.error(jqXHR, textStatus + " " + errorThrown);
        }
        });
    }

    function deleteFile(src) {
        jQuery.ajax({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        },
        method: 'DELETE',
        url: src,
        cache: false,
        success: function success(data) {},
        error: function error(jqXHR, textStatus, errorThrown) {
            console.error(jqXHR, textStatus + " " + errorThrown);
        }
        });
    }


var pageSummernote = /*#__PURE__*/function () {
  function pageSummernote() {
    _classCallCheck(this, pageSummernote);
  }

  _createClass(pageSummernote, null, [{
    key: "initSummernote",
    value: function initSummernote() {
      // Init text editor in air mode (inline)
      jQuery('.js-summernote-air:not(.js-summernote-air-enabled)').each(function (index, element) {
        // Add .js-summernote-air-enabled class to tag it as activated and init it
        jQuery(element).addClass('js-summernote-air-enabled').summernote({
          airMode: true,
          tooltip: false
        });
      }); // Init full text editor

        var HelloButton = function (context) {
            var ui = jQuery.summernote.ui;

            // create button
            var button = ui.button({
            contents: '<i class="fa fa-child"/> iframe',
            tooltip: 'hello',
            click: function () {
                var text = prompt("유튜브 iframe을 복사해서 넣어주세요.\n주소(url) 마지막에 ?playsinline=1 를 붙여줘야 동영상이 새 창으로 열리지 않습니다! \n ex) https://www.youtube.com/embed/neuB4l0gFlw?playsinline=1");
                context.invoke('editor.pasteHTML', text);
            }
            });

            return button.render();   // return button as jquery object
        }

    jQuery('.js-summernote:not(.js-summernote-enabled)').each(function (index, element) {
        var el = jQuery(element); // Add .js-summernote-enabled class to tag it as activated and init it

        el.addClass('js-summernote-enabled').summernote({
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']],
                ['mybutton', ['hello']]
            ],

            buttons: {
                hello: HelloButton
            },
            height: el.data('height') || 350,
            minHeight: el.data('min-height') || null,
            maxHeight: el.data('max-height') || null,
            callbacks: {
                onImageUpload: function onImageUpload(files) {
                    for (var i = 0; i < files.length; i++) {
                        sendFile(files[i]);
                    }
                },
                onMediaDelete: function onMediaDelete(target) {
                    deleteFile(target[0].src);
                }
            }
        });
    });
    }
  }, {
    key: "init",
    value: function init() {
      this.initSummernote();
    }
  }]);

  return pageSummernote;
}(); // Initialize when page loads


jQuery(function () {
  pageSummernote.init();
});

/***/ }),

/***/ 4:
/*!************************************************!*\
  !*** multi ./resources/js/pages/summernote.js ***!
  \************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Users/hansolji/Desktop/GU/dndlifecare/resources/js/pages/summernote.js */"./resources/js/pages/summernote.js");


/***/ })

/******/ });
