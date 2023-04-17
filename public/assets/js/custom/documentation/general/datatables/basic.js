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

/***/ "./resources/src/js/custom/documentation/general/datatables/basic.js":
/*!***************************************************************************!*\
  !*** ./resources/src/js/custom/documentation/general/datatables/basic.js ***!
  \***************************************************************************/
/***/ (() => {

eval("\n\n// Class definition\nvar KTDatatablesBasic = function () {\n  // Private functions\n\n  var _initExample1 = function _initExample1() {\n    $(\"#kt_datatable_example_1\").DataTable();\n  };\n  var _initExample2 = function _initExample2() {\n    $(\"#kt_datatable_example_2\").DataTable({\n      \"scrollY\": \"500px\",\n      \"scrollCollapse\": true,\n      \"paging\": false,\n      \"dom\": \"<'table-responsive'tr>\"\n    });\n  };\n  var _initExample3 = function _initExample3() {\n    $(\"#kt_datatable_example_3\").DataTable({\n      \"scrollX\": true\n    });\n  };\n  var _initExample4 = function _initExample4() {\n    $(\"#kt_datatable_example_4\").DataTable({\n      \"scrollY\": 300,\n      \"scrollX\": true\n    });\n  };\n\n  // Public methods\n  return {\n    init: function init() {\n      _initExample1();\n      _initExample2();\n      _initExample3();\n      _initExample4();\n    }\n  };\n}();\n\n// On document ready\nKTUtil.onDOMContentLoaded(function () {\n  KTDatatablesBasic.init();\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9yZXNvdXJjZXMvc3JjL2pzL2N1c3RvbS9kb2N1bWVudGF0aW9uL2dlbmVyYWwvZGF0YXRhYmxlcy9iYXNpYy5qcy5qcyIsIm1hcHBpbmdzIjoiQUFBYTs7QUFFYjtBQUNBLElBQUlBLGlCQUFpQixHQUFHLFlBQVk7RUFDaEM7O0VBRUEsSUFBSUMsYUFBYSxHQUFHLFNBQWhCQSxhQUFhQSxDQUFBLEVBQWM7SUFDM0JDLENBQUMsQ0FBQyx5QkFBeUIsQ0FBQyxDQUFDQyxTQUFTLEVBQUU7RUFDNUMsQ0FBQztFQUVELElBQUlDLGFBQWEsR0FBRyxTQUFoQkEsYUFBYUEsQ0FBQSxFQUFjO0lBQzNCRixDQUFDLENBQUMseUJBQXlCLENBQUMsQ0FBQ0MsU0FBUyxDQUFDO01BQ25DLFNBQVMsRUFBUyxPQUFPO01BQ3pCLGdCQUFnQixFQUFFLElBQUk7TUFDdEIsUUFBUSxFQUFVLEtBQUs7TUFDdkIsS0FBSyxFQUFJO0lBQ2IsQ0FBQyxDQUFDO0VBQ04sQ0FBQztFQUVELElBQUlFLGFBQWEsR0FBRyxTQUFoQkEsYUFBYUEsQ0FBQSxFQUFjO0lBQzNCSCxDQUFDLENBQUMseUJBQXlCLENBQUMsQ0FBQ0MsU0FBUyxDQUFDO01BQ25DLFNBQVMsRUFBRTtJQUNmLENBQUMsQ0FBQztFQUNOLENBQUM7RUFFRCxJQUFJRyxhQUFhLEdBQUcsU0FBaEJBLGFBQWFBLENBQUEsRUFBYztJQUMzQkosQ0FBQyxDQUFDLHlCQUF5QixDQUFDLENBQUNDLFNBQVMsQ0FBQztNQUNuQyxTQUFTLEVBQUUsR0FBRztNQUNkLFNBQVMsRUFBRTtJQUNmLENBQUMsQ0FBQztFQUNOLENBQUM7O0VBRUQ7RUFDQSxPQUFPO0lBQ0hJLElBQUksRUFBRSxTQUFBQSxLQUFBLEVBQVk7TUFDZE4sYUFBYSxFQUFFO01BQ2ZHLGFBQWEsRUFBRTtNQUNmQyxhQUFhLEVBQUU7TUFDZkMsYUFBYSxFQUFFO0lBQ25CO0VBQ0osQ0FBQztBQUNMLENBQUMsRUFBRTs7QUFFSDtBQUNBRSxNQUFNLENBQUNDLGtCQUFrQixDQUFDLFlBQVc7RUFDakNULGlCQUFpQixDQUFDTyxJQUFJLEVBQUU7QUFDNUIsQ0FBQyxDQUFDIiwic291cmNlcyI6WyJ3ZWJwYWNrOi8vLy4vcmVzb3VyY2VzL3NyYy9qcy9jdXN0b20vZG9jdW1lbnRhdGlvbi9nZW5lcmFsL2RhdGF0YWJsZXMvYmFzaWMuanM/MGY4OSJdLCJzb3VyY2VzQ29udGVudCI6WyJcInVzZSBzdHJpY3RcIjtcclxuXHJcbi8vIENsYXNzIGRlZmluaXRpb25cclxudmFyIEtURGF0YXRhYmxlc0Jhc2ljID0gZnVuY3Rpb24gKCkge1xyXG4gICAgLy8gUHJpdmF0ZSBmdW5jdGlvbnNcclxuXHJcbiAgICB2YXIgX2luaXRFeGFtcGxlMSA9IGZ1bmN0aW9uKCkge1xyXG4gICAgICAgICQoXCIja3RfZGF0YXRhYmxlX2V4YW1wbGVfMVwiKS5EYXRhVGFibGUoKTtcclxuICAgIH1cclxuXHJcbiAgICB2YXIgX2luaXRFeGFtcGxlMiA9IGZ1bmN0aW9uKCkge1xyXG4gICAgICAgICQoXCIja3RfZGF0YXRhYmxlX2V4YW1wbGVfMlwiKS5EYXRhVGFibGUoe1xyXG4gICAgICAgICAgICBcInNjcm9sbFlcIjogICAgICAgIFwiNTAwcHhcIixcclxuICAgICAgICAgICAgXCJzY3JvbGxDb2xsYXBzZVwiOiB0cnVlLFxyXG4gICAgICAgICAgICBcInBhZ2luZ1wiOiAgICAgICAgIGZhbHNlLFxyXG4gICAgICAgICAgICBcImRvbVwiOiAgIFwiPCd0YWJsZS1yZXNwb25zaXZlJ3RyPlwiIFxyXG4gICAgICAgIH0pO1xyXG4gICAgfVxyXG5cclxuICAgIHZhciBfaW5pdEV4YW1wbGUzID0gZnVuY3Rpb24oKSB7XHJcbiAgICAgICAgJChcIiNrdF9kYXRhdGFibGVfZXhhbXBsZV8zXCIpLkRhdGFUYWJsZSh7XHJcbiAgICAgICAgICAgIFwic2Nyb2xsWFwiOiB0cnVlXHJcbiAgICAgICAgfSk7XHJcbiAgICB9XHJcblxyXG4gICAgdmFyIF9pbml0RXhhbXBsZTQgPSBmdW5jdGlvbigpIHtcclxuICAgICAgICAkKFwiI2t0X2RhdGF0YWJsZV9leGFtcGxlXzRcIikuRGF0YVRhYmxlKHtcclxuICAgICAgICAgICAgXCJzY3JvbGxZXCI6IDMwMCxcclxuICAgICAgICAgICAgXCJzY3JvbGxYXCI6IHRydWVcclxuICAgICAgICB9KTtcclxuICAgIH0gIFxyXG5cclxuICAgIC8vIFB1YmxpYyBtZXRob2RzXHJcbiAgICByZXR1cm4ge1xyXG4gICAgICAgIGluaXQ6IGZ1bmN0aW9uICgpIHtcclxuICAgICAgICAgICAgX2luaXRFeGFtcGxlMSgpO1xyXG4gICAgICAgICAgICBfaW5pdEV4YW1wbGUyKCk7XHJcbiAgICAgICAgICAgIF9pbml0RXhhbXBsZTMoKTtcclxuICAgICAgICAgICAgX2luaXRFeGFtcGxlNCgpO1xyXG4gICAgICAgIH1cclxuICAgIH1cclxufSgpO1xyXG5cclxuLy8gT24gZG9jdW1lbnQgcmVhZHlcclxuS1RVdGlsLm9uRE9NQ29udGVudExvYWRlZChmdW5jdGlvbigpIHtcclxuICAgIEtURGF0YXRhYmxlc0Jhc2ljLmluaXQoKTtcclxufSk7Il0sIm5hbWVzIjpbIktURGF0YXRhYmxlc0Jhc2ljIiwiX2luaXRFeGFtcGxlMSIsIiQiLCJEYXRhVGFibGUiLCJfaW5pdEV4YW1wbGUyIiwiX2luaXRFeGFtcGxlMyIsIl9pbml0RXhhbXBsZTQiLCJpbml0IiwiS1RVdGlsIiwib25ET01Db250ZW50TG9hZGVkIl0sInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./resources/src/js/custom/documentation/general/datatables/basic.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/src/js/custom/documentation/general/datatables/basic.js"]();
/******/ 	
/******/ })()
;