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

/***/ "./resources/src/js/custom/documentation/forms/dialer.js":
/*!***************************************************************!*\
  !*** ./resources/src/js/custom/documentation/forms/dialer.js ***!
  \***************************************************************/
/***/ (() => {

eval("\n\n// Class definition\nvar KTFormsDialerDemos = function () {\n  // Private functions\n  var example1 = function example1(element) {\n    // Dialer container element\n    var dialerElement = document.querySelector(\"#kt_dialer_example_1\");\n\n    // Create dialer object and initialize a new instance\n    var dialerObject = new KTDialer(dialerElement, {\n      min: 1000,\n      max: 50000,\n      step: 1000,\n      prefix: \"$\",\n      decimals: 2\n    });\n  };\n  return {\n    // Public Functions\n    init: function init(element) {\n      example1();\n    }\n  };\n}();\n\n// On document ready\nKTUtil.onDOMContentLoaded(function () {\n  KTFormsDialerDemos.init();\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9yZXNvdXJjZXMvc3JjL2pzL2N1c3RvbS9kb2N1bWVudGF0aW9uL2Zvcm1zL2RpYWxlci5qcy5qcyIsIm1hcHBpbmdzIjoiQUFBYTs7QUFFYjtBQUNBLElBQUlBLGtCQUFrQixHQUFHLFlBQVc7RUFDaEM7RUFDQSxJQUFJQyxRQUFRLEdBQUcsU0FBWEEsUUFBUUEsQ0FBWUMsT0FBTyxFQUFFO0lBQzdCO0lBQ0EsSUFBSUMsYUFBYSxHQUFHQyxRQUFRLENBQUNDLGFBQWEsQ0FBQyxzQkFBc0IsQ0FBQzs7SUFFbEU7SUFDQSxJQUFJQyxZQUFZLEdBQUcsSUFBSUMsUUFBUSxDQUFDSixhQUFhLEVBQUU7TUFDM0NLLEdBQUcsRUFBRSxJQUFJO01BQ1RDLEdBQUcsRUFBRSxLQUFLO01BQ1ZDLElBQUksRUFBRSxJQUFJO01BQ1ZDLE1BQU0sRUFBRSxHQUFHO01BQ1hDLFFBQVEsRUFBRTtJQUNkLENBQUMsQ0FBQztFQUNOLENBQUM7RUFFRCxPQUFPO0lBQ0g7SUFDQUMsSUFBSSxFQUFFLFNBQUFBLEtBQVNYLE9BQU8sRUFBRTtNQUNwQkQsUUFBUSxFQUFFO0lBQ2Q7RUFDSixDQUFDO0FBQ0wsQ0FBQyxFQUFFOztBQUVIO0FBQ0FhLE1BQU0sQ0FBQ0Msa0JBQWtCLENBQUMsWUFBVztFQUNqQ2Ysa0JBQWtCLENBQUNhLElBQUksRUFBRTtBQUM3QixDQUFDLENBQUMiLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvc3JjL2pzL2N1c3RvbS9kb2N1bWVudGF0aW9uL2Zvcm1zL2RpYWxlci5qcz81ZmEwIl0sInNvdXJjZXNDb250ZW50IjpbIlwidXNlIHN0cmljdFwiO1xyXG5cclxuLy8gQ2xhc3MgZGVmaW5pdGlvblxyXG52YXIgS1RGb3Jtc0RpYWxlckRlbW9zID0gZnVuY3Rpb24oKSB7XHJcbiAgICAvLyBQcml2YXRlIGZ1bmN0aW9uc1xyXG4gICAgdmFyIGV4YW1wbGUxID0gZnVuY3Rpb24oZWxlbWVudCkge1xyXG4gICAgICAgIC8vIERpYWxlciBjb250YWluZXIgZWxlbWVudFxyXG4gICAgICAgIHZhciBkaWFsZXJFbGVtZW50ID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvcihcIiNrdF9kaWFsZXJfZXhhbXBsZV8xXCIpO1xyXG5cclxuICAgICAgICAvLyBDcmVhdGUgZGlhbGVyIG9iamVjdCBhbmQgaW5pdGlhbGl6ZSBhIG5ldyBpbnN0YW5jZVxyXG4gICAgICAgIHZhciBkaWFsZXJPYmplY3QgPSBuZXcgS1REaWFsZXIoZGlhbGVyRWxlbWVudCwge1xyXG4gICAgICAgICAgICBtaW46IDEwMDAsXHJcbiAgICAgICAgICAgIG1heDogNTAwMDAsXHJcbiAgICAgICAgICAgIHN0ZXA6IDEwMDAsXHJcbiAgICAgICAgICAgIHByZWZpeDogXCIkXCIsXHJcbiAgICAgICAgICAgIGRlY2ltYWxzOiAyXHJcbiAgICAgICAgfSk7XHJcbiAgICB9XHJcblxyXG4gICAgcmV0dXJuIHtcclxuICAgICAgICAvLyBQdWJsaWMgRnVuY3Rpb25zXHJcbiAgICAgICAgaW5pdDogZnVuY3Rpb24oZWxlbWVudCkge1xyXG4gICAgICAgICAgICBleGFtcGxlMSgpO1xyXG4gICAgICAgIH1cclxuICAgIH07XHJcbn0oKTtcclxuXHJcbi8vIE9uIGRvY3VtZW50IHJlYWR5XHJcbktUVXRpbC5vbkRPTUNvbnRlbnRMb2FkZWQoZnVuY3Rpb24oKSB7XHJcbiAgICBLVEZvcm1zRGlhbGVyRGVtb3MuaW5pdCgpO1xyXG59KTtcclxuIl0sIm5hbWVzIjpbIktURm9ybXNEaWFsZXJEZW1vcyIsImV4YW1wbGUxIiwiZWxlbWVudCIsImRpYWxlckVsZW1lbnQiLCJkb2N1bWVudCIsInF1ZXJ5U2VsZWN0b3IiLCJkaWFsZXJPYmplY3QiLCJLVERpYWxlciIsIm1pbiIsIm1heCIsInN0ZXAiLCJwcmVmaXgiLCJkZWNpbWFscyIsImluaXQiLCJLVFV0aWwiLCJvbkRPTUNvbnRlbnRMb2FkZWQiXSwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./resources/src/js/custom/documentation/forms/dialer.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/src/js/custom/documentation/forms/dialer.js"]();
/******/ 	
/******/ })()
;