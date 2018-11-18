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
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
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
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(1);
module.exports = __webpack_require__(2);


/***/ }),
/* 1 */
/***/ (function(module, exports) {

var replyBtn = document.querySelectorAll('.btn--reply');

function toggleReplyForm(e) {
  var elem = e.currentTarget.parentNode.parentNode.parentNode.children[4];
  elem.classList.toggle('active');
  if (elem.classList[1] == 'active') {
    elem.style.display = 'none';
  } else {
    elem.style.display = 'block';
  }
}

for (var i = 0; i < replyBtn.length; i++) {
  replyBtn[i].addEventListener('click', toggleReplyForm);
}

$('.login--btn').on('click', function () {
  $('.login-modal-overlay').fadeIn(200);
});

$('.login-modal').click(function (event) {
  event.stopPropagation();
});

$('.login-modal-overlay').click(function () {
  $('.login-modal-overlay').fadeOut(200);
});

$('.login-form').on('submit', function (e) {
  e.preventDefault();

  $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    type: 'POST',
    url: $(this).attr('action'),
    data: {
      'email': $('input[name=email]').val(),
      'password': $('input[name=password').val()
    },
    success: function success(data) {
      $('.login-modal-overlay').fadeOut();
    },
    error: function error(response) {
      console.log(response);
      if (response.responseJSON.errors.email[0]) {
        $('.login-form__error').text(response.responseJSON.message);
        $('.login-form__error').fadeIn();
      } else {
        console.log('Internal server error. Try again.');
      }
    }

  });
});

$('.logout--btn').on('click', function (e) {
  e.preventDefault();
  $('#logout-form').submit();
});

/***/ }),
/* 2 */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ })
/******/ ]);