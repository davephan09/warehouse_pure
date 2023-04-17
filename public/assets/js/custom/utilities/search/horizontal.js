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

/***/ "./resources/src/js/custom/utilities/search/horizontal.js":
/*!****************************************************************!*\
  !*** ./resources/src/js/custom/utilities/search/horizontal.js ***!
  \****************************************************************/
/***/ (() => {

eval("\n\n// Class definition\nvar KTSearchHorizontal = function () {\n  // Private functions\n  var initAdvancedSearchForm = function initAdvancedSearchForm() {\n    var form = document.querySelector('#kt_advanced_search_form');\n\n    // Init tags\n    var tags = form.querySelector('[name=\"tags\"]');\n    new Tagify(tags);\n  };\n  var handleAdvancedSearchToggle = function handleAdvancedSearchToggle() {\n    var link = document.querySelector('#kt_horizontal_search_advanced_link');\n    link.addEventListener('click', function (e) {\n      e.preventDefault();\n      if (link.innerHTML === \"Advanced Search\") {\n        link.innerHTML = \"Hide Advanced Search\";\n      } else {\n        link.innerHTML = \"Advanced Search\";\n      }\n    });\n  };\n\n  // Public methods\n  return {\n    init: function init() {\n      initAdvancedSearchForm();\n      handleAdvancedSearchToggle();\n    }\n  };\n}();\n\n// On document ready\nKTUtil.onDOMContentLoaded(function () {\n  KTSearchHorizontal.init();\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9yZXNvdXJjZXMvc3JjL2pzL2N1c3RvbS91dGlsaXRpZXMvc2VhcmNoL2hvcml6b250YWwuanMuanMiLCJtYXBwaW5ncyI6IkFBQWE7O0FBRWI7QUFDQSxJQUFJQSxrQkFBa0IsR0FBRyxZQUFZO0VBQ2pDO0VBQ0EsSUFBSUMsc0JBQXNCLEdBQUcsU0FBekJBLHNCQUFzQkEsQ0FBQSxFQUFlO0lBQ3RDLElBQUlDLElBQUksR0FBR0MsUUFBUSxDQUFDQyxhQUFhLENBQUMsMEJBQTBCLENBQUM7O0lBRTdEO0lBQ0EsSUFBSUMsSUFBSSxHQUFHSCxJQUFJLENBQUNFLGFBQWEsQ0FBQyxlQUFlLENBQUM7SUFDOUMsSUFBSUUsTUFBTSxDQUFDRCxJQUFJLENBQUM7RUFDbkIsQ0FBQztFQUVELElBQUlFLDBCQUEwQixHQUFHLFNBQTdCQSwwQkFBMEJBLENBQUEsRUFBZTtJQUN6QyxJQUFJQyxJQUFJLEdBQUdMLFFBQVEsQ0FBQ0MsYUFBYSxDQUFDLHFDQUFxQyxDQUFDO0lBRXhFSSxJQUFJLENBQUNDLGdCQUFnQixDQUFDLE9BQU8sRUFBRSxVQUFVQyxDQUFDLEVBQUU7TUFDeENBLENBQUMsQ0FBQ0MsY0FBYyxFQUFFO01BRWxCLElBQUlILElBQUksQ0FBQ0ksU0FBUyxLQUFLLGlCQUFpQixFQUFFO1FBQ3RDSixJQUFJLENBQUNJLFNBQVMsR0FBRyxzQkFBc0I7TUFDM0MsQ0FBQyxNQUFNO1FBQ0hKLElBQUksQ0FBQ0ksU0FBUyxHQUFHLGlCQUFpQjtNQUN0QztJQUNKLENBQUMsQ0FBQztFQUNOLENBQUM7O0VBRUQ7RUFDQSxPQUFPO0lBQ0hDLElBQUksRUFBRSxTQUFBQSxLQUFBLEVBQVk7TUFDZFosc0JBQXNCLEVBQUU7TUFDeEJNLDBCQUEwQixFQUFFO0lBQ2hDO0VBQ0osQ0FBQztBQUNMLENBQUMsRUFBRTs7QUFFSDtBQUNBTyxNQUFNLENBQUNDLGtCQUFrQixDQUFDLFlBQVk7RUFDbENmLGtCQUFrQixDQUFDYSxJQUFJLEVBQUU7QUFDN0IsQ0FBQyxDQUFDIiwic291cmNlcyI6WyJ3ZWJwYWNrOi8vLy4vcmVzb3VyY2VzL3NyYy9qcy9jdXN0b20vdXRpbGl0aWVzL3NlYXJjaC9ob3Jpem9udGFsLmpzPzI5N2UiXSwic291cmNlc0NvbnRlbnQiOlsiXCJ1c2Ugc3RyaWN0XCI7XHJcbiBcclxuLy8gQ2xhc3MgZGVmaW5pdGlvblxyXG52YXIgS1RTZWFyY2hIb3Jpem9udGFsID0gZnVuY3Rpb24gKCkge1xyXG4gICAgLy8gUHJpdmF0ZSBmdW5jdGlvbnNcclxuICAgIHZhciBpbml0QWR2YW5jZWRTZWFyY2hGb3JtID0gZnVuY3Rpb24gKCkge1xyXG4gICAgICAgdmFyIGZvcm0gPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCcja3RfYWR2YW5jZWRfc2VhcmNoX2Zvcm0nKTtcclxuXHJcbiAgICAgICAvLyBJbml0IHRhZ3NcclxuICAgICAgIHZhciB0YWdzID0gZm9ybS5xdWVyeVNlbGVjdG9yKCdbbmFtZT1cInRhZ3NcIl0nKTtcclxuICAgICAgIG5ldyBUYWdpZnkodGFncyk7XHJcbiAgICB9XHJcblxyXG4gICAgdmFyIGhhbmRsZUFkdmFuY2VkU2VhcmNoVG9nZ2xlID0gZnVuY3Rpb24gKCkge1xyXG4gICAgICAgIHZhciBsaW5rID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvcignI2t0X2hvcml6b250YWxfc2VhcmNoX2FkdmFuY2VkX2xpbmsnKTtcclxuXHJcbiAgICAgICAgbGluay5hZGRFdmVudExpc3RlbmVyKCdjbGljaycsIGZ1bmN0aW9uIChlKSB7XHJcbiAgICAgICAgICAgIGUucHJldmVudERlZmF1bHQoKTtcclxuICAgICAgICAgICAgXHJcbiAgICAgICAgICAgIGlmIChsaW5rLmlubmVySFRNTCA9PT0gXCJBZHZhbmNlZCBTZWFyY2hcIikge1xyXG4gICAgICAgICAgICAgICAgbGluay5pbm5lckhUTUwgPSBcIkhpZGUgQWR2YW5jZWQgU2VhcmNoXCI7XHJcbiAgICAgICAgICAgIH0gZWxzZSB7XHJcbiAgICAgICAgICAgICAgICBsaW5rLmlubmVySFRNTCA9IFwiQWR2YW5jZWQgU2VhcmNoXCI7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9KVxyXG4gICAgfVxyXG5cclxuICAgIC8vIFB1YmxpYyBtZXRob2RzXHJcbiAgICByZXR1cm4ge1xyXG4gICAgICAgIGluaXQ6IGZ1bmN0aW9uICgpIHtcclxuICAgICAgICAgICAgaW5pdEFkdmFuY2VkU2VhcmNoRm9ybSgpO1xyXG4gICAgICAgICAgICBoYW5kbGVBZHZhbmNlZFNlYXJjaFRvZ2dsZSgpO1xyXG4gICAgICAgIH1cclxuICAgIH0gICAgIFxyXG59KCk7XHJcblxyXG4vLyBPbiBkb2N1bWVudCByZWFkeVxyXG5LVFV0aWwub25ET01Db250ZW50TG9hZGVkKGZ1bmN0aW9uICgpIHtcclxuICAgIEtUU2VhcmNoSG9yaXpvbnRhbC5pbml0KCk7XHJcbn0pO1xyXG4iXSwibmFtZXMiOlsiS1RTZWFyY2hIb3Jpem9udGFsIiwiaW5pdEFkdmFuY2VkU2VhcmNoRm9ybSIsImZvcm0iLCJkb2N1bWVudCIsInF1ZXJ5U2VsZWN0b3IiLCJ0YWdzIiwiVGFnaWZ5IiwiaGFuZGxlQWR2YW5jZWRTZWFyY2hUb2dnbGUiLCJsaW5rIiwiYWRkRXZlbnRMaXN0ZW5lciIsImUiLCJwcmV2ZW50RGVmYXVsdCIsImlubmVySFRNTCIsImluaXQiLCJLVFV0aWwiLCJvbkRPTUNvbnRlbnRMb2FkZWQiXSwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./resources/src/js/custom/utilities/search/horizontal.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/src/js/custom/utilities/search/horizontal.js"]();
/******/ 	
/******/ })()
;