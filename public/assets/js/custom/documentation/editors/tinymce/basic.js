/*
 * ATTENTION: An "eval-source-map" devtool has been used.
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file with attached SourceMaps in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/src/js/custom/documentation/editors/tinymce/basic.js":
/*!************************************************************************!*\
  !*** ./resources/src/js/custom/documentation/editors/tinymce/basic.js ***!
  \************************************************************************/
/***/ (() => {

eval("\n\n// Class definition\nvar KTFormsTinyMCEBasic = function () {\n  // Private functions\n  var exampleBasic = function exampleBasic() {\n    var options = {\n      selector: '#kt_docs_tinymce_basic'\n    };\n    if (KTApp.isDarkMode()) {\n      options['skin'] = 'oxide-dark';\n      options['content_css'] = 'dark';\n    }\n    tinymce.init(options);\n  };\n  return {\n    // Public Functions\n    init: function init() {\n      exampleBasic();\n    }\n  };\n}();\n\n// On document ready\nKTUtil.onDOMContentLoaded(function () {\n  KTFormsTinyMCEBasic.init();\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9yZXNvdXJjZXMvc3JjL2pzL2N1c3RvbS9kb2N1bWVudGF0aW9uL2VkaXRvcnMvdGlueW1jZS9iYXNpYy5qcy5qcyIsIm1hcHBpbmdzIjoiQUFBYTs7QUFFYjtBQUNBLElBQUlBLG1CQUFtQixHQUFHLFlBQVc7RUFDakM7RUFDQSxJQUFJQyxZQUFZLEdBQUcsU0FBZkEsWUFBWUEsQ0FBQSxFQUFjO0lBQzFCLElBQUlDLE9BQU8sR0FBRztNQUFDQyxRQUFRLEVBQUU7SUFBd0IsQ0FBQztJQUVsRCxJQUFJQyxLQUFLLENBQUNDLFVBQVUsRUFBRSxFQUFFO01BQ3BCSCxPQUFPLENBQUMsTUFBTSxDQUFDLEdBQUcsWUFBWTtNQUM5QkEsT0FBTyxDQUFDLGFBQWEsQ0FBQyxHQUFHLE1BQU07SUFDbkM7SUFFQUksT0FBTyxDQUFDQyxJQUFJLENBQUNMLE9BQU8sQ0FBQztFQUN6QixDQUFDO0VBRUQsT0FBTztJQUNIO0lBQ0FLLElBQUksRUFBRSxTQUFBQSxLQUFBLEVBQVc7TUFDYk4sWUFBWSxFQUFFO0lBQ2xCO0VBQ0osQ0FBQztBQUNMLENBQUMsRUFBRTs7QUFFSDtBQUNBTyxNQUFNLENBQUNDLGtCQUFrQixDQUFDLFlBQVc7RUFDakNULG1CQUFtQixDQUFDTyxJQUFJLEVBQUU7QUFDOUIsQ0FBQyxDQUFDIiwic291cmNlcyI6WyJ3ZWJwYWNrOi8vLy4vcmVzb3VyY2VzL3NyYy9qcy9jdXN0b20vZG9jdW1lbnRhdGlvbi9lZGl0b3JzL3RpbnltY2UvYmFzaWMuanM/MmIzNSJdLCJzb3VyY2VzQ29udGVudCI6WyJcInVzZSBzdHJpY3RcIjtcclxuXHJcbi8vIENsYXNzIGRlZmluaXRpb25cclxudmFyIEtURm9ybXNUaW55TUNFQmFzaWMgPSBmdW5jdGlvbigpIHtcclxuICAgIC8vIFByaXZhdGUgZnVuY3Rpb25zXHJcbiAgICB2YXIgZXhhbXBsZUJhc2ljID0gZnVuY3Rpb24oKSB7XHJcbiAgICAgICAgdmFyIG9wdGlvbnMgPSB7c2VsZWN0b3I6ICcja3RfZG9jc190aW55bWNlX2Jhc2ljJ307XHJcbiAgICAgICAgXHJcbiAgICAgICAgaWYgKEtUQXBwLmlzRGFya01vZGUoKSkge1xyXG4gICAgICAgICAgICBvcHRpb25zWydza2luJ10gPSAnb3hpZGUtZGFyayc7XHJcbiAgICAgICAgICAgIG9wdGlvbnNbJ2NvbnRlbnRfY3NzJ10gPSAnZGFyayc7XHJcbiAgICAgICAgfVxyXG4gICAgICAgIFxyXG4gICAgICAgIHRpbnltY2UuaW5pdChvcHRpb25zKTtcclxuICAgIH1cclxuXHJcbiAgICByZXR1cm4ge1xyXG4gICAgICAgIC8vIFB1YmxpYyBGdW5jdGlvbnNcclxuICAgICAgICBpbml0OiBmdW5jdGlvbigpIHtcclxuICAgICAgICAgICAgZXhhbXBsZUJhc2ljKCk7XHJcbiAgICAgICAgfVxyXG4gICAgfTtcclxufSgpO1xyXG5cclxuLy8gT24gZG9jdW1lbnQgcmVhZHlcclxuS1RVdGlsLm9uRE9NQ29udGVudExvYWRlZChmdW5jdGlvbigpIHtcclxuICAgIEtURm9ybXNUaW55TUNFQmFzaWMuaW5pdCgpO1xyXG59KTtcclxuIl0sIm5hbWVzIjpbIktURm9ybXNUaW55TUNFQmFzaWMiLCJleGFtcGxlQmFzaWMiLCJvcHRpb25zIiwic2VsZWN0b3IiLCJLVEFwcCIsImlzRGFya01vZGUiLCJ0aW55bWNlIiwiaW5pdCIsIktUVXRpbCIsIm9uRE9NQ29udGVudExvYWRlZCJdLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./resources/src/js/custom/documentation/editors/tinymce/basic.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/src/js/custom/documentation/editors/tinymce/basic.js"]();
/******/ 	
/******/ })()
;