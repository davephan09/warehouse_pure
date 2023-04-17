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

/***/ "./resources/src/js/custom/documentation/general/jstree/basic.js":
/*!***********************************************************************!*\
  !*** ./resources/src/js/custom/documentation/general/jstree/basic.js ***!
  \***********************************************************************/
/***/ (() => {

eval("\n\n// Class definition\nvar KTJSTreeBasic = function () {\n  // Private functions\n  var exampleBasic = function exampleBasic() {\n    $('#kt_docs_jstree_basic').jstree({\n      \"core\": {\n        \"themes\": {\n          \"responsive\": false\n        }\n      },\n      \"types\": {\n        \"default\": {\n          \"icon\": \"fa fa-folder\"\n        },\n        \"file\": {\n          \"icon\": \"fa fa-file\"\n        }\n      },\n      \"plugins\": [\"types\"]\n    });\n  };\n  return {\n    // Public Functions\n    init: function init() {\n      exampleBasic();\n    }\n  };\n}();\n\n// On document ready\nKTUtil.onDOMContentLoaded(function () {\n  KTJSTreeBasic.init();\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9yZXNvdXJjZXMvc3JjL2pzL2N1c3RvbS9kb2N1bWVudGF0aW9uL2dlbmVyYWwvanN0cmVlL2Jhc2ljLmpzLmpzIiwibWFwcGluZ3MiOiJBQUFhOztBQUViO0FBQ0EsSUFBSUEsYUFBYSxHQUFHLFlBQVc7RUFDM0I7RUFDQSxJQUFJQyxZQUFZLEdBQUcsU0FBZkEsWUFBWUEsQ0FBQSxFQUFjO0lBQzFCQyxDQUFDLENBQUMsdUJBQXVCLENBQUMsQ0FBQ0MsTUFBTSxDQUFDO01BQzlCLE1BQU0sRUFBRztRQUNMLFFBQVEsRUFBRztVQUNQLFlBQVksRUFBRTtRQUNsQjtNQUNKLENBQUM7TUFDRCxPQUFPLEVBQUc7UUFDTixTQUFTLEVBQUc7VUFDUixNQUFNLEVBQUc7UUFDYixDQUFDO1FBQ0QsTUFBTSxFQUFHO1VBQ0wsTUFBTSxFQUFHO1FBQ2I7TUFDSixDQUFDO01BQ0QsU0FBUyxFQUFFLENBQUMsT0FBTztJQUN2QixDQUFDLENBQUM7RUFDTixDQUFDO0VBRUQsT0FBTztJQUNIO0lBQ0FDLElBQUksRUFBRSxTQUFBQSxLQUFBLEVBQVc7TUFDYkgsWUFBWSxFQUFFO0lBQ2xCO0VBQ0osQ0FBQztBQUNMLENBQUMsRUFBRTs7QUFFSDtBQUNBSSxNQUFNLENBQUNDLGtCQUFrQixDQUFDLFlBQVc7RUFDakNOLGFBQWEsQ0FBQ0ksSUFBSSxFQUFFO0FBQ3hCLENBQUMsQ0FBQyIsInNvdXJjZXMiOlsid2VicGFjazovLy8uL3Jlc291cmNlcy9zcmMvanMvY3VzdG9tL2RvY3VtZW50YXRpb24vZ2VuZXJhbC9qc3RyZWUvYmFzaWMuanM/MDczZSJdLCJzb3VyY2VzQ29udGVudCI6WyJcInVzZSBzdHJpY3RcIjtcclxuXHJcbi8vIENsYXNzIGRlZmluaXRpb25cclxudmFyIEtUSlNUcmVlQmFzaWMgPSBmdW5jdGlvbigpIHtcclxuICAgIC8vIFByaXZhdGUgZnVuY3Rpb25zXHJcbiAgICB2YXIgZXhhbXBsZUJhc2ljID0gZnVuY3Rpb24oKSB7XHJcbiAgICAgICAgJCgnI2t0X2RvY3NfanN0cmVlX2Jhc2ljJykuanN0cmVlKHtcclxuICAgICAgICAgICAgXCJjb3JlXCIgOiB7XHJcbiAgICAgICAgICAgICAgICBcInRoZW1lc1wiIDoge1xyXG4gICAgICAgICAgICAgICAgICAgIFwicmVzcG9uc2l2ZVwiOiBmYWxzZVxyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9LFxyXG4gICAgICAgICAgICBcInR5cGVzXCIgOiB7XHJcbiAgICAgICAgICAgICAgICBcImRlZmF1bHRcIiA6IHtcclxuICAgICAgICAgICAgICAgICAgICBcImljb25cIiA6IFwiZmEgZmEtZm9sZGVyXCJcclxuICAgICAgICAgICAgICAgIH0sXHJcbiAgICAgICAgICAgICAgICBcImZpbGVcIiA6IHtcclxuICAgICAgICAgICAgICAgICAgICBcImljb25cIiA6IFwiZmEgZmEtZmlsZVwiXHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH0sXHJcbiAgICAgICAgICAgIFwicGx1Z2luc1wiOiBbXCJ0eXBlc1wiXVxyXG4gICAgICAgIH0pO1xyXG4gICAgfVxyXG5cclxuICAgIHJldHVybiB7XHJcbiAgICAgICAgLy8gUHVibGljIEZ1bmN0aW9uc1xyXG4gICAgICAgIGluaXQ6IGZ1bmN0aW9uKCkge1xyXG4gICAgICAgICAgICBleGFtcGxlQmFzaWMoKTtcclxuICAgICAgICB9XHJcbiAgICB9O1xyXG59KCk7XHJcblxyXG4vLyBPbiBkb2N1bWVudCByZWFkeVxyXG5LVFV0aWwub25ET01Db250ZW50TG9hZGVkKGZ1bmN0aW9uKCkge1xyXG4gICAgS1RKU1RyZWVCYXNpYy5pbml0KCk7XHJcbn0pO1xyXG4iXSwibmFtZXMiOlsiS1RKU1RyZWVCYXNpYyIsImV4YW1wbGVCYXNpYyIsIiQiLCJqc3RyZWUiLCJpbml0IiwiS1RVdGlsIiwib25ET01Db250ZW50TG9hZGVkIl0sInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./resources/src/js/custom/documentation/general/jstree/basic.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/src/js/custom/documentation/general/jstree/basic.js"]();
/******/ 	
/******/ })()
;