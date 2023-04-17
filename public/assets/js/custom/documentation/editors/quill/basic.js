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

/***/ "./resources/src/js/custom/documentation/editors/quill/basic.js":
/*!**********************************************************************!*\
  !*** ./resources/src/js/custom/documentation/editors/quill/basic.js ***!
  \**********************************************************************/
/***/ (() => {

eval("\n\n// Class definition\nvar KTFormsQuillBasic = function () {\n  // Private functions\n  var exampleBasic = function exampleBasic() {\n    var quill = new Quill('#kt_docs_quill_basic', {\n      modules: {\n        toolbar: [[{\n          header: [1, 2, false]\n        }], ['bold', 'italic', 'underline'], ['image', 'code-block']]\n      },\n      placeholder: 'Type your text here...',\n      theme: 'snow' // or 'bubble'\n    });\n  };\n\n  return {\n    // Public Functions\n    init: function init() {\n      exampleBasic();\n    }\n  };\n}();\n\n// On document ready\nKTUtil.onDOMContentLoaded(function () {\n  KTFormsQuillBasic.init();\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9yZXNvdXJjZXMvc3JjL2pzL2N1c3RvbS9kb2N1bWVudGF0aW9uL2VkaXRvcnMvcXVpbGwvYmFzaWMuanMuanMiLCJtYXBwaW5ncyI6IkFBQWE7O0FBRWI7QUFDQSxJQUFJQSxpQkFBaUIsR0FBRyxZQUFXO0VBQy9CO0VBQ0EsSUFBSUMsWUFBWSxHQUFHLFNBQWZBLFlBQVlBLENBQUEsRUFBYztJQUMxQixJQUFJQyxLQUFLLEdBQUcsSUFBSUMsS0FBSyxDQUFDLHNCQUFzQixFQUFFO01BQzFDQyxPQUFPLEVBQUU7UUFDTEMsT0FBTyxFQUFFLENBQ0wsQ0FBQztVQUNHQyxNQUFNLEVBQUUsQ0FBQyxDQUFDLEVBQUUsQ0FBQyxFQUFFLEtBQUs7UUFDeEIsQ0FBQyxDQUFDLEVBQ0YsQ0FBQyxNQUFNLEVBQUUsUUFBUSxFQUFFLFdBQVcsQ0FBQyxFQUMvQixDQUFDLE9BQU8sRUFBRSxZQUFZLENBQUM7TUFFL0IsQ0FBQztNQUNEQyxXQUFXLEVBQUUsd0JBQXdCO01BQ3JDQyxLQUFLLEVBQUUsTUFBTSxDQUFDO0lBQ2xCLENBQUMsQ0FBQztFQUNOLENBQUM7O0VBRUQsT0FBTztJQUNIO0lBQ0FDLElBQUksRUFBRSxTQUFBQSxLQUFBLEVBQVc7TUFDYlIsWUFBWSxFQUFFO0lBQ2xCO0VBQ0osQ0FBQztBQUNMLENBQUMsRUFBRTs7QUFFSDtBQUNBUyxNQUFNLENBQUNDLGtCQUFrQixDQUFDLFlBQVc7RUFDakNYLGlCQUFpQixDQUFDUyxJQUFJLEVBQUU7QUFDNUIsQ0FBQyxDQUFDIiwic291cmNlcyI6WyJ3ZWJwYWNrOi8vLy4vcmVzb3VyY2VzL3NyYy9qcy9jdXN0b20vZG9jdW1lbnRhdGlvbi9lZGl0b3JzL3F1aWxsL2Jhc2ljLmpzP2NmZTEiXSwic291cmNlc0NvbnRlbnQiOlsiXCJ1c2Ugc3RyaWN0XCI7XHJcblxyXG4vLyBDbGFzcyBkZWZpbml0aW9uXHJcbnZhciBLVEZvcm1zUXVpbGxCYXNpYyA9IGZ1bmN0aW9uKCkge1xyXG4gICAgLy8gUHJpdmF0ZSBmdW5jdGlvbnNcclxuICAgIHZhciBleGFtcGxlQmFzaWMgPSBmdW5jdGlvbigpIHtcclxuICAgICAgICB2YXIgcXVpbGwgPSBuZXcgUXVpbGwoJyNrdF9kb2NzX3F1aWxsX2Jhc2ljJywge1xyXG4gICAgICAgICAgICBtb2R1bGVzOiB7XHJcbiAgICAgICAgICAgICAgICB0b29sYmFyOiBbXHJcbiAgICAgICAgICAgICAgICAgICAgW3tcclxuICAgICAgICAgICAgICAgICAgICAgICAgaGVhZGVyOiBbMSwgMiwgZmFsc2VdXHJcbiAgICAgICAgICAgICAgICAgICAgfV0sXHJcbiAgICAgICAgICAgICAgICAgICAgWydib2xkJywgJ2l0YWxpYycsICd1bmRlcmxpbmUnXSxcclxuICAgICAgICAgICAgICAgICAgICBbJ2ltYWdlJywgJ2NvZGUtYmxvY2snXVxyXG4gICAgICAgICAgICAgICAgXVxyXG4gICAgICAgICAgICB9LFxyXG4gICAgICAgICAgICBwbGFjZWhvbGRlcjogJ1R5cGUgeW91ciB0ZXh0IGhlcmUuLi4nLFxyXG4gICAgICAgICAgICB0aGVtZTogJ3Nub3cnIC8vIG9yICdidWJibGUnXHJcbiAgICAgICAgfSk7XHJcbiAgICB9XHJcblxyXG4gICAgcmV0dXJuIHtcclxuICAgICAgICAvLyBQdWJsaWMgRnVuY3Rpb25zXHJcbiAgICAgICAgaW5pdDogZnVuY3Rpb24oKSB7XHJcbiAgICAgICAgICAgIGV4YW1wbGVCYXNpYygpO1xyXG4gICAgICAgIH1cclxuICAgIH07XHJcbn0oKTtcclxuXHJcbi8vIE9uIGRvY3VtZW50IHJlYWR5XHJcbktUVXRpbC5vbkRPTUNvbnRlbnRMb2FkZWQoZnVuY3Rpb24oKSB7XHJcbiAgICBLVEZvcm1zUXVpbGxCYXNpYy5pbml0KCk7XHJcbn0pO1xyXG4iXSwibmFtZXMiOlsiS1RGb3Jtc1F1aWxsQmFzaWMiLCJleGFtcGxlQmFzaWMiLCJxdWlsbCIsIlF1aWxsIiwibW9kdWxlcyIsInRvb2xiYXIiLCJoZWFkZXIiLCJwbGFjZWhvbGRlciIsInRoZW1lIiwiaW5pdCIsIktUVXRpbCIsIm9uRE9NQ29udGVudExvYWRlZCJdLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./resources/src/js/custom/documentation/editors/quill/basic.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/src/js/custom/documentation/editors/quill/basic.js"]();
/******/ 	
/******/ })()
;