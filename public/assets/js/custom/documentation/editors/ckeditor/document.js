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

/***/ "./resources/src/js/custom/documentation/editors/ckeditor/document.js":
/*!****************************************************************************!*\
  !*** ./resources/src/js/custom/documentation/editors/ckeditor/document.js ***!
  \****************************************************************************/
/***/ (() => {

eval("\n\n// Class definition\nvar KTFormsCKEditorDocument = function () {\n  // Private functions\n  var exampleDocument = function exampleDocument() {\n    DecoupledEditor.create(document.querySelector('#kt_docs_ckeditor_document')).then(function (editor) {\n      var toolbarContainer = document.querySelector('#kt_docs_ckeditor_document_toolbar');\n      toolbarContainer.appendChild(editor.ui.view.toolbar.element);\n    })[\"catch\"](function (error) {\n      console.error(error);\n    });\n  };\n  return {\n    // Public Functions\n    init: function init() {\n      exampleDocument();\n    }\n  };\n}();\n\n// On document ready\nKTUtil.onDOMContentLoaded(function () {\n  KTFormsCKEditorDocument.init();\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9yZXNvdXJjZXMvc3JjL2pzL2N1c3RvbS9kb2N1bWVudGF0aW9uL2VkaXRvcnMvY2tlZGl0b3IvZG9jdW1lbnQuanMuanMiLCJtYXBwaW5ncyI6IkFBQWE7O0FBRWI7QUFDQSxJQUFJQSx1QkFBdUIsR0FBRyxZQUFZO0VBQ3RDO0VBQ0EsSUFBSUMsZUFBZSxHQUFHLFNBQWxCQSxlQUFlQSxDQUFBLEVBQWU7SUFDOUJDLGVBQWUsQ0FDVkMsTUFBTSxDQUFDQyxRQUFRLENBQUNDLGFBQWEsQ0FBQyw0QkFBNEIsQ0FBQyxDQUFDLENBQzVEQyxJQUFJLENBQUMsVUFBQUMsTUFBTSxFQUFJO01BQ1osSUFBTUMsZ0JBQWdCLEdBQUdKLFFBQVEsQ0FBQ0MsYUFBYSxDQUFDLG9DQUFvQyxDQUFDO01BRXJGRyxnQkFBZ0IsQ0FBQ0MsV0FBVyxDQUFDRixNQUFNLENBQUNHLEVBQUUsQ0FBQ0MsSUFBSSxDQUFDQyxPQUFPLENBQUNDLE9BQU8sQ0FBQztJQUNoRSxDQUFDLENBQUMsU0FDSSxDQUFDLFVBQUFDLEtBQUssRUFBSTtNQUNaQyxPQUFPLENBQUNELEtBQUssQ0FBQ0EsS0FBSyxDQUFDO0lBQ3hCLENBQUMsQ0FBQztFQUNWLENBQUM7RUFFRCxPQUFPO0lBQ0g7SUFDQUUsSUFBSSxFQUFFLFNBQUFBLEtBQUEsRUFBWTtNQUNkZixlQUFlLEVBQUU7SUFDckI7RUFDSixDQUFDO0FBQ0wsQ0FBQyxFQUFFOztBQUVIO0FBQ0FnQixNQUFNLENBQUNDLGtCQUFrQixDQUFDLFlBQVk7RUFDbENsQix1QkFBdUIsQ0FBQ2dCLElBQUksRUFBRTtBQUNsQyxDQUFDLENBQUMiLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvc3JjL2pzL2N1c3RvbS9kb2N1bWVudGF0aW9uL2VkaXRvcnMvY2tlZGl0b3IvZG9jdW1lbnQuanM/NTJhMCJdLCJzb3VyY2VzQ29udGVudCI6WyJcInVzZSBzdHJpY3RcIjtcclxuXHJcbi8vIENsYXNzIGRlZmluaXRpb25cclxudmFyIEtURm9ybXNDS0VkaXRvckRvY3VtZW50ID0gZnVuY3Rpb24gKCkge1xyXG4gICAgLy8gUHJpdmF0ZSBmdW5jdGlvbnNcclxuICAgIHZhciBleGFtcGxlRG9jdW1lbnQgPSBmdW5jdGlvbiAoKSB7XHJcbiAgICAgICAgRGVjb3VwbGVkRWRpdG9yXHJcbiAgICAgICAgICAgIC5jcmVhdGUoZG9jdW1lbnQucXVlcnlTZWxlY3RvcignI2t0X2RvY3NfY2tlZGl0b3JfZG9jdW1lbnQnKSlcclxuICAgICAgICAgICAgLnRoZW4oZWRpdG9yID0+IHtcclxuICAgICAgICAgICAgICAgIGNvbnN0IHRvb2xiYXJDb250YWluZXIgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCcja3RfZG9jc19ja2VkaXRvcl9kb2N1bWVudF90b29sYmFyJyk7XHJcblxyXG4gICAgICAgICAgICAgICAgdG9vbGJhckNvbnRhaW5lci5hcHBlbmRDaGlsZChlZGl0b3IudWkudmlldy50b29sYmFyLmVsZW1lbnQpO1xyXG4gICAgICAgICAgICB9KVxyXG4gICAgICAgICAgICAuY2F0Y2goZXJyb3IgPT4ge1xyXG4gICAgICAgICAgICAgICAgY29uc29sZS5lcnJvcihlcnJvcik7XHJcbiAgICAgICAgICAgIH0pO1xyXG4gICAgfVxyXG5cclxuICAgIHJldHVybiB7XHJcbiAgICAgICAgLy8gUHVibGljIEZ1bmN0aW9uc1xyXG4gICAgICAgIGluaXQ6IGZ1bmN0aW9uICgpIHtcclxuICAgICAgICAgICAgZXhhbXBsZURvY3VtZW50KCk7XHJcbiAgICAgICAgfVxyXG4gICAgfTtcclxufSgpO1xyXG5cclxuLy8gT24gZG9jdW1lbnQgcmVhZHlcclxuS1RVdGlsLm9uRE9NQ29udGVudExvYWRlZChmdW5jdGlvbiAoKSB7XHJcbiAgICBLVEZvcm1zQ0tFZGl0b3JEb2N1bWVudC5pbml0KCk7XHJcbn0pO1xyXG4iXSwibmFtZXMiOlsiS1RGb3Jtc0NLRWRpdG9yRG9jdW1lbnQiLCJleGFtcGxlRG9jdW1lbnQiLCJEZWNvdXBsZWRFZGl0b3IiLCJjcmVhdGUiLCJkb2N1bWVudCIsInF1ZXJ5U2VsZWN0b3IiLCJ0aGVuIiwiZWRpdG9yIiwidG9vbGJhckNvbnRhaW5lciIsImFwcGVuZENoaWxkIiwidWkiLCJ2aWV3IiwidG9vbGJhciIsImVsZW1lbnQiLCJlcnJvciIsImNvbnNvbGUiLCJpbml0IiwiS1RVdGlsIiwib25ET01Db250ZW50TG9hZGVkIl0sInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./resources/src/js/custom/documentation/editors/ckeditor/document.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/src/js/custom/documentation/editors/ckeditor/document.js"]();
/******/ 	
/******/ })()
;