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

/***/ "./resources/src/js/custom/documentation/editors/ckeditor/balloon.js":
/*!***************************************************************************!*\
  !*** ./resources/src/js/custom/documentation/editors/ckeditor/balloon.js ***!
  \***************************************************************************/
/***/ (() => {

eval("\n\n// Class definition\nvar KTFormsCKEditorBalloon = function () {\n  // Private functions\n  var exampleBalloon = function exampleBalloon() {\n    BalloonEditor.create(document.querySelector('#kt_docs_ckeditor_balloon')).then(function (editor) {\n      console.log(editor);\n    })[\"catch\"](function (error) {\n      console.error(error);\n    });\n  };\n  return {\n    // Public Functions\n    init: function init() {\n      exampleBalloon();\n    }\n  };\n}();\n\n// On document ready\nKTUtil.onDOMContentLoaded(function () {\n  KTFormsCKEditorBalloon.init();\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9yZXNvdXJjZXMvc3JjL2pzL2N1c3RvbS9kb2N1bWVudGF0aW9uL2VkaXRvcnMvY2tlZGl0b3IvYmFsbG9vbi5qcy5qcyIsIm1hcHBpbmdzIjoiQUFBYTs7QUFFYjtBQUNBLElBQUlBLHNCQUFzQixHQUFHLFlBQVk7RUFDckM7RUFDQSxJQUFJQyxjQUFjLEdBQUcsU0FBakJBLGNBQWNBLENBQUEsRUFBZTtJQUM3QkMsYUFBYSxDQUNSQyxNQUFNLENBQUNDLFFBQVEsQ0FBQ0MsYUFBYSxDQUFDLDJCQUEyQixDQUFDLENBQUMsQ0FDM0RDLElBQUksQ0FBQyxVQUFBQyxNQUFNLEVBQUk7TUFDWkMsT0FBTyxDQUFDQyxHQUFHLENBQUNGLE1BQU0sQ0FBQztJQUN2QixDQUFDLENBQUMsU0FDSSxDQUFDLFVBQUFHLEtBQUssRUFBSTtNQUNaRixPQUFPLENBQUNFLEtBQUssQ0FBQ0EsS0FBSyxDQUFDO0lBQ3hCLENBQUMsQ0FBQztFQUNWLENBQUM7RUFFRCxPQUFPO0lBQ0g7SUFDQUMsSUFBSSxFQUFFLFNBQUFBLEtBQUEsRUFBWTtNQUNkVixjQUFjLEVBQUU7SUFDcEI7RUFDSixDQUFDO0FBQ0wsQ0FBQyxFQUFFOztBQUVIO0FBQ0FXLE1BQU0sQ0FBQ0Msa0JBQWtCLENBQUMsWUFBWTtFQUNsQ2Isc0JBQXNCLENBQUNXLElBQUksRUFBRTtBQUNqQyxDQUFDLENBQUMiLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvc3JjL2pzL2N1c3RvbS9kb2N1bWVudGF0aW9uL2VkaXRvcnMvY2tlZGl0b3IvYmFsbG9vbi5qcz83OTBjIl0sInNvdXJjZXNDb250ZW50IjpbIlwidXNlIHN0cmljdFwiO1xyXG5cclxuLy8gQ2xhc3MgZGVmaW5pdGlvblxyXG52YXIgS1RGb3Jtc0NLRWRpdG9yQmFsbG9vbiA9IGZ1bmN0aW9uICgpIHtcclxuICAgIC8vIFByaXZhdGUgZnVuY3Rpb25zXHJcbiAgICB2YXIgZXhhbXBsZUJhbGxvb24gPSBmdW5jdGlvbiAoKSB7XHJcbiAgICAgICAgQmFsbG9vbkVkaXRvclxyXG4gICAgICAgICAgICAuY3JlYXRlKGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJyNrdF9kb2NzX2NrZWRpdG9yX2JhbGxvb24nKSlcclxuICAgICAgICAgICAgLnRoZW4oZWRpdG9yID0+IHtcclxuICAgICAgICAgICAgICAgIGNvbnNvbGUubG9nKGVkaXRvcik7XHJcbiAgICAgICAgICAgIH0pXHJcbiAgICAgICAgICAgIC5jYXRjaChlcnJvciA9PiB7XHJcbiAgICAgICAgICAgICAgICBjb25zb2xlLmVycm9yKGVycm9yKTtcclxuICAgICAgICAgICAgfSk7XHJcbiAgICB9XHJcblxyXG4gICAgcmV0dXJuIHtcclxuICAgICAgICAvLyBQdWJsaWMgRnVuY3Rpb25zXHJcbiAgICAgICAgaW5pdDogZnVuY3Rpb24gKCkge1xyXG4gICAgICAgICAgICBleGFtcGxlQmFsbG9vbigpO1xyXG4gICAgICAgIH1cclxuICAgIH07XHJcbn0oKTtcclxuXHJcbi8vIE9uIGRvY3VtZW50IHJlYWR5XHJcbktUVXRpbC5vbkRPTUNvbnRlbnRMb2FkZWQoZnVuY3Rpb24gKCkge1xyXG4gICAgS1RGb3Jtc0NLRWRpdG9yQmFsbG9vbi5pbml0KCk7XHJcbn0pO1xyXG4iXSwibmFtZXMiOlsiS1RGb3Jtc0NLRWRpdG9yQmFsbG9vbiIsImV4YW1wbGVCYWxsb29uIiwiQmFsbG9vbkVkaXRvciIsImNyZWF0ZSIsImRvY3VtZW50IiwicXVlcnlTZWxlY3RvciIsInRoZW4iLCJlZGl0b3IiLCJjb25zb2xlIiwibG9nIiwiZXJyb3IiLCJpbml0IiwiS1RVdGlsIiwib25ET01Db250ZW50TG9hZGVkIl0sInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./resources/src/js/custom/documentation/editors/ckeditor/balloon.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/src/js/custom/documentation/editors/ckeditor/balloon.js"]();
/******/ 	
/******/ })()
;