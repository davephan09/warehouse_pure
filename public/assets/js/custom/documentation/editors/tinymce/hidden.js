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

/***/ "./resources/src/js/custom/documentation/editors/tinymce/hidden.js":
/*!*************************************************************************!*\
  !*** ./resources/src/js/custom/documentation/editors/tinymce/hidden.js ***!
  \*************************************************************************/
/***/ (() => {

eval("\n\n// Class definition\nvar KTFormsTinyMCEHidden = function () {\n  // Private functions\n  var exampleHidden = function exampleHidden() {\n    tinymce.init({\n      selector: '#kt_docs_tinymce_hidden',\n      menubar: false,\n      toolbar: ['styleselect fontselect fontsizeselect', 'undo redo | cut copy paste | bold italic | link image | alignleft aligncenter alignright alignjustify', 'bullist numlist | outdent indent | blockquote subscript superscript | advlist | autolink | lists charmap | print preview |  code'],\n      plugins: 'advlist autolink link image lists charmap print preview code'\n    });\n  };\n  return {\n    // Public Functions\n    init: function init() {\n      exampleHidden();\n    }\n  };\n}();\n\n// On document ready\nKTUtil.onDOMContentLoaded(function () {\n  KTFormsTinyMCEHidden.init();\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9yZXNvdXJjZXMvc3JjL2pzL2N1c3RvbS9kb2N1bWVudGF0aW9uL2VkaXRvcnMvdGlueW1jZS9oaWRkZW4uanMuanMiLCJtYXBwaW5ncyI6IkFBQWE7O0FBRWI7QUFDQSxJQUFJQSxvQkFBb0IsR0FBRyxZQUFXO0VBQ2xDO0VBQ0EsSUFBSUMsYUFBYSxHQUFHLFNBQWhCQSxhQUFhQSxDQUFBLEVBQWM7SUFDM0JDLE9BQU8sQ0FBQ0MsSUFBSSxDQUFDO01BQ1RDLFFBQVEsRUFBRSx5QkFBeUI7TUFDbkNDLE9BQU8sRUFBRSxLQUFLO01BQ2RDLE9BQU8sRUFBRSxDQUFDLHVDQUF1QyxFQUM3Qyx1R0FBdUcsRUFDdkcsa0lBQWtJLENBQUM7TUFDdklDLE9BQU8sRUFBRztJQUNkLENBQUMsQ0FBQztFQUNOLENBQUM7RUFFRCxPQUFPO0lBQ0g7SUFDQUosSUFBSSxFQUFFLFNBQUFBLEtBQUEsRUFBVztNQUNiRixhQUFhLEVBQUU7SUFDbkI7RUFDSixDQUFDO0FBQ0wsQ0FBQyxFQUFFOztBQUVIO0FBQ0FPLE1BQU0sQ0FBQ0Msa0JBQWtCLENBQUMsWUFBVztFQUNqQ1Qsb0JBQW9CLENBQUNHLElBQUksRUFBRTtBQUMvQixDQUFDLENBQUMiLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvc3JjL2pzL2N1c3RvbS9kb2N1bWVudGF0aW9uL2VkaXRvcnMvdGlueW1jZS9oaWRkZW4uanM/MWU5OCJdLCJzb3VyY2VzQ29udGVudCI6WyJcInVzZSBzdHJpY3RcIjtcclxuXHJcbi8vIENsYXNzIGRlZmluaXRpb25cclxudmFyIEtURm9ybXNUaW55TUNFSGlkZGVuID0gZnVuY3Rpb24oKSB7XHJcbiAgICAvLyBQcml2YXRlIGZ1bmN0aW9uc1xyXG4gICAgdmFyIGV4YW1wbGVIaWRkZW4gPSBmdW5jdGlvbigpIHtcclxuICAgICAgICB0aW55bWNlLmluaXQoe1xyXG4gICAgICAgICAgICBzZWxlY3RvcjogJyNrdF9kb2NzX3RpbnltY2VfaGlkZGVuJyxcclxuICAgICAgICAgICAgbWVudWJhcjogZmFsc2UsXHJcbiAgICAgICAgICAgIHRvb2xiYXI6IFsnc3R5bGVzZWxlY3QgZm9udHNlbGVjdCBmb250c2l6ZXNlbGVjdCcsXHJcbiAgICAgICAgICAgICAgICAndW5kbyByZWRvIHwgY3V0IGNvcHkgcGFzdGUgfCBib2xkIGl0YWxpYyB8IGxpbmsgaW1hZ2UgfCBhbGlnbmxlZnQgYWxpZ25jZW50ZXIgYWxpZ25yaWdodCBhbGlnbmp1c3RpZnknLFxyXG4gICAgICAgICAgICAgICAgJ2J1bGxpc3QgbnVtbGlzdCB8IG91dGRlbnQgaW5kZW50IHwgYmxvY2txdW90ZSBzdWJzY3JpcHQgc3VwZXJzY3JpcHQgfCBhZHZsaXN0IHwgYXV0b2xpbmsgfCBsaXN0cyBjaGFybWFwIHwgcHJpbnQgcHJldmlldyB8ICBjb2RlJ10sXHJcbiAgICAgICAgICAgIHBsdWdpbnMgOiAnYWR2bGlzdCBhdXRvbGluayBsaW5rIGltYWdlIGxpc3RzIGNoYXJtYXAgcHJpbnQgcHJldmlldyBjb2RlJ1xyXG4gICAgICAgIH0pO1xyXG4gICAgfVxyXG5cclxuICAgIHJldHVybiB7XHJcbiAgICAgICAgLy8gUHVibGljIEZ1bmN0aW9uc1xyXG4gICAgICAgIGluaXQ6IGZ1bmN0aW9uKCkge1xyXG4gICAgICAgICAgICBleGFtcGxlSGlkZGVuKCk7XHJcbiAgICAgICAgfVxyXG4gICAgfTtcclxufSgpO1xyXG5cclxuLy8gT24gZG9jdW1lbnQgcmVhZHlcclxuS1RVdGlsLm9uRE9NQ29udGVudExvYWRlZChmdW5jdGlvbigpIHtcclxuICAgIEtURm9ybXNUaW55TUNFSGlkZGVuLmluaXQoKTtcclxufSk7XHJcbiJdLCJuYW1lcyI6WyJLVEZvcm1zVGlueU1DRUhpZGRlbiIsImV4YW1wbGVIaWRkZW4iLCJ0aW55bWNlIiwiaW5pdCIsInNlbGVjdG9yIiwibWVudWJhciIsInRvb2xiYXIiLCJwbHVnaW5zIiwiS1RVdGlsIiwib25ET01Db250ZW50TG9hZGVkIl0sInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./resources/src/js/custom/documentation/editors/tinymce/hidden.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/src/js/custom/documentation/editors/tinymce/hidden.js"]();
/******/ 	
/******/ })()
;