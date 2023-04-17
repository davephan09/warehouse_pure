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

/***/ "./resources/src/js/custom/documentation/charts/flotcharts/pie.js":
/*!************************************************************************!*\
  !*** ./resources/src/js/custom/documentation/charts/flotcharts/pie.js ***!
  \************************************************************************/
/***/ (() => {

eval("\n\n// Class definition\nvar KTFlotDemoPie = function () {\n  // Private functions\n  var examplePie = function examplePie() {\n    var data = [{\n      label: \"CSS\",\n      data: 10,\n      color: KTUtil.getCssVariableValue('--bs-active-primary')\n    }, {\n      label: \"HTML5\",\n      data: 40,\n      color: KTUtil.getCssVariableValue('--bs-active-success')\n    }, {\n      label: \"PHP\",\n      data: 30,\n      color: KTUtil.getCssVariableValue('--bs-active-danger')\n    }, {\n      label: \"Angular\",\n      data: 20,\n      color: KTUtil.getCssVariableValue('--bs-active-warning')\n    }];\n    $.plot($(\"#kt_docs_flot_pie\"), data, {\n      series: {\n        pie: {\n          show: true\n        }\n      }\n    });\n  };\n  return {\n    // Public Functions\n    init: function init() {\n      examplePie();\n    }\n  };\n}();\n\n// On document ready\nKTUtil.onDOMContentLoaded(function () {\n  KTFlotDemoPie.init();\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9yZXNvdXJjZXMvc3JjL2pzL2N1c3RvbS9kb2N1bWVudGF0aW9uL2NoYXJ0cy9mbG90Y2hhcnRzL3BpZS5qcy5qcyIsIm1hcHBpbmdzIjoiQUFBYTs7QUFFYjtBQUNBLElBQUlBLGFBQWEsR0FBRyxZQUFZO0VBQzVCO0VBQ0EsSUFBSUMsVUFBVSxHQUFHLFNBQWJBLFVBQVVBLENBQUEsRUFBZTtJQUN6QixJQUFJQyxJQUFJLEdBQUcsQ0FDUDtNQUFFQyxLQUFLLEVBQUUsS0FBSztNQUFFRCxJQUFJLEVBQUUsRUFBRTtNQUFFRSxLQUFLLEVBQUVDLE1BQU0sQ0FBQ0MsbUJBQW1CLENBQUMscUJBQXFCO0lBQUUsQ0FBQyxFQUNwRjtNQUFFSCxLQUFLLEVBQUUsT0FBTztNQUFFRCxJQUFJLEVBQUUsRUFBRTtNQUFFRSxLQUFLLEVBQUVDLE1BQU0sQ0FBQ0MsbUJBQW1CLENBQUMscUJBQXFCO0lBQUUsQ0FBQyxFQUN0RjtNQUFFSCxLQUFLLEVBQUUsS0FBSztNQUFFRCxJQUFJLEVBQUUsRUFBRTtNQUFFRSxLQUFLLEVBQUVDLE1BQU0sQ0FBQ0MsbUJBQW1CLENBQUMsb0JBQW9CO0lBQUUsQ0FBQyxFQUNuRjtNQUFFSCxLQUFLLEVBQUUsU0FBUztNQUFFRCxJQUFJLEVBQUUsRUFBRTtNQUFFRSxLQUFLLEVBQUVDLE1BQU0sQ0FBQ0MsbUJBQW1CLENBQUMscUJBQXFCO0lBQUUsQ0FBQyxDQUMzRjtJQUVEQyxDQUFDLENBQUNDLElBQUksQ0FBQ0QsQ0FBQyxDQUFDLG1CQUFtQixDQUFDLEVBQUVMLElBQUksRUFBRTtNQUNqQ08sTUFBTSxFQUFFO1FBQ0pDLEdBQUcsRUFBRTtVQUNEQyxJQUFJLEVBQUU7UUFDVjtNQUNKO0lBQ0osQ0FBQyxDQUFDO0VBQ04sQ0FBQztFQUVELE9BQU87SUFDSDtJQUNBQyxJQUFJLEVBQUUsU0FBQUEsS0FBQSxFQUFZO01BQ2RYLFVBQVUsRUFBRTtJQUNoQjtFQUNKLENBQUM7QUFDTCxDQUFDLEVBQUU7O0FBRUg7QUFDQUksTUFBTSxDQUFDUSxrQkFBa0IsQ0FBQyxZQUFZO0VBQ2xDYixhQUFhLENBQUNZLElBQUksRUFBRTtBQUN4QixDQUFDLENBQUMiLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvc3JjL2pzL2N1c3RvbS9kb2N1bWVudGF0aW9uL2NoYXJ0cy9mbG90Y2hhcnRzL3BpZS5qcz9lYzJhIl0sInNvdXJjZXNDb250ZW50IjpbIlwidXNlIHN0cmljdFwiO1xyXG5cclxuLy8gQ2xhc3MgZGVmaW5pdGlvblxyXG52YXIgS1RGbG90RGVtb1BpZSA9IGZ1bmN0aW9uICgpIHtcclxuICAgIC8vIFByaXZhdGUgZnVuY3Rpb25zXHJcbiAgICB2YXIgZXhhbXBsZVBpZSA9IGZ1bmN0aW9uICgpIHtcclxuICAgICAgICB2YXIgZGF0YSA9IFtcclxuICAgICAgICAgICAgeyBsYWJlbDogXCJDU1NcIiwgZGF0YTogMTAsIGNvbG9yOiBLVFV0aWwuZ2V0Q3NzVmFyaWFibGVWYWx1ZSgnLS1icy1hY3RpdmUtcHJpbWFyeScpIH0sXHJcbiAgICAgICAgICAgIHsgbGFiZWw6IFwiSFRNTDVcIiwgZGF0YTogNDAsIGNvbG9yOiBLVFV0aWwuZ2V0Q3NzVmFyaWFibGVWYWx1ZSgnLS1icy1hY3RpdmUtc3VjY2VzcycpIH0sXHJcbiAgICAgICAgICAgIHsgbGFiZWw6IFwiUEhQXCIsIGRhdGE6IDMwLCBjb2xvcjogS1RVdGlsLmdldENzc1ZhcmlhYmxlVmFsdWUoJy0tYnMtYWN0aXZlLWRhbmdlcicpIH0sXHJcbiAgICAgICAgICAgIHsgbGFiZWw6IFwiQW5ndWxhclwiLCBkYXRhOiAyMCwgY29sb3I6IEtUVXRpbC5nZXRDc3NWYXJpYWJsZVZhbHVlKCctLWJzLWFjdGl2ZS13YXJuaW5nJykgfVxyXG4gICAgICAgIF07XHJcblxyXG4gICAgICAgICQucGxvdCgkKFwiI2t0X2RvY3NfZmxvdF9waWVcIiksIGRhdGEsIHtcclxuICAgICAgICAgICAgc2VyaWVzOiB7XHJcbiAgICAgICAgICAgICAgICBwaWU6IHtcclxuICAgICAgICAgICAgICAgICAgICBzaG93OiB0cnVlXHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9KTtcclxuICAgIH1cclxuXHJcbiAgICByZXR1cm4ge1xyXG4gICAgICAgIC8vIFB1YmxpYyBGdW5jdGlvbnNcclxuICAgICAgICBpbml0OiBmdW5jdGlvbiAoKSB7XHJcbiAgICAgICAgICAgIGV4YW1wbGVQaWUoKTtcclxuICAgICAgICB9XHJcbiAgICB9O1xyXG59KCk7XHJcblxyXG4vLyBPbiBkb2N1bWVudCByZWFkeVxyXG5LVFV0aWwub25ET01Db250ZW50TG9hZGVkKGZ1bmN0aW9uICgpIHtcclxuICAgIEtURmxvdERlbW9QaWUuaW5pdCgpO1xyXG59KTtcclxuIl0sIm5hbWVzIjpbIktURmxvdERlbW9QaWUiLCJleGFtcGxlUGllIiwiZGF0YSIsImxhYmVsIiwiY29sb3IiLCJLVFV0aWwiLCJnZXRDc3NWYXJpYWJsZVZhbHVlIiwiJCIsInBsb3QiLCJzZXJpZXMiLCJwaWUiLCJzaG93IiwiaW5pdCIsIm9uRE9NQ29udGVudExvYWRlZCJdLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./resources/src/js/custom/documentation/charts/flotcharts/pie.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/src/js/custom/documentation/charts/flotcharts/pie.js"]();
/******/ 	
/******/ })()
;