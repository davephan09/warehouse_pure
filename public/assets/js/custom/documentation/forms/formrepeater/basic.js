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

/***/ "./resources/src/js/custom/documentation/forms/formrepeater/basic.js":
/*!***************************************************************************!*\
  !*** ./resources/src/js/custom/documentation/forms/formrepeater/basic.js ***!
  \***************************************************************************/
/***/ (() => {

eval("\n\n// Class definition\nvar KTFormRepeaterBasic = function () {\n  // Private functions\n  var example1 = function example1() {\n    $('#kt_docs_repeater_basic').repeater({\n      initEmpty: false,\n      defaultValues: {\n        'text-input': 'foo'\n      },\n      show: function show() {\n        $(this).slideDown();\n      },\n      hide: function hide(deleteElement) {\n        $(this).slideUp(deleteElement);\n      }\n    });\n  };\n  return {\n    // Public Functions\n    init: function init() {\n      example1();\n    }\n  };\n}();\n\n// On document ready\nKTUtil.onDOMContentLoaded(function () {\n  KTFormRepeaterBasic.init();\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9yZXNvdXJjZXMvc3JjL2pzL2N1c3RvbS9kb2N1bWVudGF0aW9uL2Zvcm1zL2Zvcm1yZXBlYXRlci9iYXNpYy5qcy5qcyIsIm1hcHBpbmdzIjoiQUFBYTs7QUFFYjtBQUNBLElBQUlBLG1CQUFtQixHQUFHLFlBQVk7RUFDbEM7RUFDQSxJQUFJQyxRQUFRLEdBQUcsU0FBWEEsUUFBUUEsQ0FBQSxFQUFlO0lBQ3ZCQyxDQUFDLENBQUMseUJBQXlCLENBQUMsQ0FBQ0MsUUFBUSxDQUFDO01BQ2xDQyxTQUFTLEVBQUUsS0FBSztNQUVoQkMsYUFBYSxFQUFFO1FBQ1gsWUFBWSxFQUFFO01BQ2xCLENBQUM7TUFFREMsSUFBSSxFQUFFLFNBQUFBLEtBQUEsRUFBWTtRQUNkSixDQUFDLENBQUMsSUFBSSxDQUFDLENBQUNLLFNBQVMsRUFBRTtNQUN2QixDQUFDO01BRURDLElBQUksRUFBRSxTQUFBQSxLQUFVQyxhQUFhLEVBQUU7UUFDM0JQLENBQUMsQ0FBQyxJQUFJLENBQUMsQ0FBQ1EsT0FBTyxDQUFDRCxhQUFhLENBQUM7TUFDbEM7SUFDSixDQUFDLENBQUM7RUFDTixDQUFDO0VBRUQsT0FBTztJQUNIO0lBQ0FFLElBQUksRUFBRSxTQUFBQSxLQUFBLEVBQVk7TUFDZFYsUUFBUSxFQUFFO0lBQ2Q7RUFDSixDQUFDO0FBQ0wsQ0FBQyxFQUFFOztBQUVIO0FBQ0FXLE1BQU0sQ0FBQ0Msa0JBQWtCLENBQUMsWUFBWTtFQUNsQ2IsbUJBQW1CLENBQUNXLElBQUksRUFBRTtBQUM5QixDQUFDLENBQUMiLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvc3JjL2pzL2N1c3RvbS9kb2N1bWVudGF0aW9uL2Zvcm1zL2Zvcm1yZXBlYXRlci9iYXNpYy5qcz8xZTdmIl0sInNvdXJjZXNDb250ZW50IjpbIlwidXNlIHN0cmljdFwiO1xyXG5cclxuLy8gQ2xhc3MgZGVmaW5pdGlvblxyXG52YXIgS1RGb3JtUmVwZWF0ZXJCYXNpYyA9IGZ1bmN0aW9uICgpIHtcclxuICAgIC8vIFByaXZhdGUgZnVuY3Rpb25zXHJcbiAgICB2YXIgZXhhbXBsZTEgPSBmdW5jdGlvbiAoKSB7XHJcbiAgICAgICAgJCgnI2t0X2RvY3NfcmVwZWF0ZXJfYmFzaWMnKS5yZXBlYXRlcih7XHJcbiAgICAgICAgICAgIGluaXRFbXB0eTogZmFsc2UsXHJcblxyXG4gICAgICAgICAgICBkZWZhdWx0VmFsdWVzOiB7XHJcbiAgICAgICAgICAgICAgICAndGV4dC1pbnB1dCc6ICdmb28nXHJcbiAgICAgICAgICAgIH0sXHJcblxyXG4gICAgICAgICAgICBzaG93OiBmdW5jdGlvbiAoKSB7XHJcbiAgICAgICAgICAgICAgICAkKHRoaXMpLnNsaWRlRG93bigpO1xyXG4gICAgICAgICAgICB9LFxyXG5cclxuICAgICAgICAgICAgaGlkZTogZnVuY3Rpb24gKGRlbGV0ZUVsZW1lbnQpIHtcclxuICAgICAgICAgICAgICAgICQodGhpcykuc2xpZGVVcChkZWxldGVFbGVtZW50KTtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH0pO1xyXG4gICAgfVxyXG5cclxuICAgIHJldHVybiB7XHJcbiAgICAgICAgLy8gUHVibGljIEZ1bmN0aW9uc1xyXG4gICAgICAgIGluaXQ6IGZ1bmN0aW9uICgpIHtcclxuICAgICAgICAgICAgZXhhbXBsZTEoKTtcclxuICAgICAgICB9XHJcbiAgICB9O1xyXG59KCk7XHJcblxyXG4vLyBPbiBkb2N1bWVudCByZWFkeVxyXG5LVFV0aWwub25ET01Db250ZW50TG9hZGVkKGZ1bmN0aW9uICgpIHtcclxuICAgIEtURm9ybVJlcGVhdGVyQmFzaWMuaW5pdCgpO1xyXG59KTtcclxuIl0sIm5hbWVzIjpbIktURm9ybVJlcGVhdGVyQmFzaWMiLCJleGFtcGxlMSIsIiQiLCJyZXBlYXRlciIsImluaXRFbXB0eSIsImRlZmF1bHRWYWx1ZXMiLCJzaG93Iiwic2xpZGVEb3duIiwiaGlkZSIsImRlbGV0ZUVsZW1lbnQiLCJzbGlkZVVwIiwiaW5pdCIsIktUVXRpbCIsIm9uRE9NQ29udGVudExvYWRlZCJdLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./resources/src/js/custom/documentation/forms/formrepeater/basic.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/src/js/custom/documentation/forms/formrepeater/basic.js"]();
/******/ 	
/******/ })()
;