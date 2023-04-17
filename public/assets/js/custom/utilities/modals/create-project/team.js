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

/***/ "./resources/src/js/custom/utilities/modals/create-project/team.js":
/*!*************************************************************************!*\
  !*** ./resources/src/js/custom/utilities/modals/create-project/team.js ***!
  \*************************************************************************/
/***/ ((module) => {

eval("\n\n// Class definition\nvar KTModalCreateProjectTeam = function () {\n  // Variables\n  var nextButton;\n  var previousButton;\n  var form;\n  var stepper;\n\n  // Private functions\n  var handleForm = function handleForm() {\n    nextButton.addEventListener('click', function (e) {\n      // Prevent default button action\n      e.preventDefault();\n\n      // Disable button to avoid multiple click \n      nextButton.disabled = true;\n\n      // Show loading indication\n      nextButton.setAttribute('data-kt-indicator', 'on');\n\n      // Simulate form submission\n      setTimeout(function () {\n        // Enable button\n        nextButton.disabled = false;\n\n        // Simulate form submission\n        nextButton.removeAttribute('data-kt-indicator');\n\n        // Go to next step\n        stepper.goNext();\n      }, 1500);\n    });\n    previousButton.addEventListener('click', function () {\n      stepper.goPrevious();\n    });\n  };\n  return {\n    // Public functions\n    init: function init() {\n      form = KTModalCreateProject.getForm();\n      stepper = KTModalCreateProject.getStepperObj();\n      nextButton = KTModalCreateProject.getStepper().querySelector('[data-kt-element=\"team-next\"]');\n      previousButton = KTModalCreateProject.getStepper().querySelector('[data-kt-element=\"team-previous\"]');\n      handleForm();\n    }\n  };\n}();\n\n// Webpack support\nif ( true && typeof module.exports !== 'undefined') {\n  window.KTModalCreateProjectTeam = module.exports = KTModalCreateProjectTeam;\n}//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9yZXNvdXJjZXMvc3JjL2pzL2N1c3RvbS91dGlsaXRpZXMvbW9kYWxzL2NyZWF0ZS1wcm9qZWN0L3RlYW0uanMuanMiLCJtYXBwaW5ncyI6IkFBQWE7O0FBRWI7QUFDQSxJQUFJQSx3QkFBd0IsR0FBRyxZQUFZO0VBQzFDO0VBQ0EsSUFBSUMsVUFBVTtFQUNkLElBQUlDLGNBQWM7RUFDbEIsSUFBSUMsSUFBSTtFQUNSLElBQUlDLE9BQU87O0VBRVg7RUFDQSxJQUFJQyxVQUFVLEdBQUcsU0FBYkEsVUFBVUEsQ0FBQSxFQUFjO0lBQzNCSixVQUFVLENBQUNLLGdCQUFnQixDQUFDLE9BQU8sRUFBRSxVQUFVQyxDQUFDLEVBQUU7TUFDakQ7TUFDQUEsQ0FBQyxDQUFDQyxjQUFjLEVBQUU7O01BRWxCO01BQ0FQLFVBQVUsQ0FBQ1EsUUFBUSxHQUFHLElBQUk7O01BRTFCO01BQ0FSLFVBQVUsQ0FBQ1MsWUFBWSxDQUFDLG1CQUFtQixFQUFFLElBQUksQ0FBQzs7TUFFbEQ7TUFDQUMsVUFBVSxDQUFDLFlBQVc7UUFDckI7UUFDQVYsVUFBVSxDQUFDUSxRQUFRLEdBQUcsS0FBSzs7UUFFM0I7UUFDQVIsVUFBVSxDQUFDVyxlQUFlLENBQUMsbUJBQW1CLENBQUM7O1FBRS9DO1FBQ0FSLE9BQU8sQ0FBQ1MsTUFBTSxFQUFFO01BQ2pCLENBQUMsRUFBRSxJQUFJLENBQUM7SUFDVCxDQUFDLENBQUM7SUFFRlgsY0FBYyxDQUFDSSxnQkFBZ0IsQ0FBQyxPQUFPLEVBQUUsWUFBWTtNQUNwREYsT0FBTyxDQUFDVSxVQUFVLEVBQUU7SUFDckIsQ0FBQyxDQUFDO0VBQ0gsQ0FBQztFQUVELE9BQU87SUFDTjtJQUNBQyxJQUFJLEVBQUUsU0FBQUEsS0FBQSxFQUFZO01BQ2pCWixJQUFJLEdBQUdhLG9CQUFvQixDQUFDQyxPQUFPLEVBQUU7TUFDckNiLE9BQU8sR0FBR1ksb0JBQW9CLENBQUNFLGFBQWEsRUFBRTtNQUM5Q2pCLFVBQVUsR0FBR2Usb0JBQW9CLENBQUNHLFVBQVUsRUFBRSxDQUFDQyxhQUFhLENBQUMsK0JBQStCLENBQUM7TUFDN0ZsQixjQUFjLEdBQUdjLG9CQUFvQixDQUFDRyxVQUFVLEVBQUUsQ0FBQ0MsYUFBYSxDQUFDLG1DQUFtQyxDQUFDO01BRXJHZixVQUFVLEVBQUU7SUFDYjtFQUNELENBQUM7QUFDRixDQUFDLEVBQUU7O0FBRUg7QUFDQSxJQUFJLEtBQTZCLElBQUksT0FBT2dCLE1BQU0sQ0FBQ0MsT0FBTyxLQUFLLFdBQVcsRUFBRTtFQUMzRUMsTUFBTSxDQUFDdkIsd0JBQXdCLEdBQUdxQixNQUFNLENBQUNDLE9BQU8sR0FBR3RCLHdCQUF3QjtBQUM1RSIsInNvdXJjZXMiOlsid2VicGFjazovLy8uL3Jlc291cmNlcy9zcmMvanMvY3VzdG9tL3V0aWxpdGllcy9tb2RhbHMvY3JlYXRlLXByb2plY3QvdGVhbS5qcz9kM2MxIl0sInNvdXJjZXNDb250ZW50IjpbIlwidXNlIHN0cmljdFwiO1xyXG5cclxuLy8gQ2xhc3MgZGVmaW5pdGlvblxyXG52YXIgS1RNb2RhbENyZWF0ZVByb2plY3RUZWFtID0gZnVuY3Rpb24gKCkge1xyXG5cdC8vIFZhcmlhYmxlc1xyXG5cdHZhciBuZXh0QnV0dG9uO1xyXG5cdHZhciBwcmV2aW91c0J1dHRvbjtcclxuXHR2YXIgZm9ybTtcclxuXHR2YXIgc3RlcHBlcjtcclxuXHJcblx0Ly8gUHJpdmF0ZSBmdW5jdGlvbnNcclxuXHR2YXIgaGFuZGxlRm9ybSA9IGZ1bmN0aW9uKCkge1xyXG5cdFx0bmV4dEJ1dHRvbi5hZGRFdmVudExpc3RlbmVyKCdjbGljaycsIGZ1bmN0aW9uIChlKSB7XHJcblx0XHRcdC8vIFByZXZlbnQgZGVmYXVsdCBidXR0b24gYWN0aW9uXHJcblx0XHRcdGUucHJldmVudERlZmF1bHQoKTtcclxuXHJcblx0XHRcdC8vIERpc2FibGUgYnV0dG9uIHRvIGF2b2lkIG11bHRpcGxlIGNsaWNrIFxyXG5cdFx0XHRuZXh0QnV0dG9uLmRpc2FibGVkID0gdHJ1ZTtcclxuXHJcblx0XHRcdC8vIFNob3cgbG9hZGluZyBpbmRpY2F0aW9uXHJcblx0XHRcdG5leHRCdXR0b24uc2V0QXR0cmlidXRlKCdkYXRhLWt0LWluZGljYXRvcicsICdvbicpO1xyXG5cclxuXHRcdFx0Ly8gU2ltdWxhdGUgZm9ybSBzdWJtaXNzaW9uXHJcblx0XHRcdHNldFRpbWVvdXQoZnVuY3Rpb24oKSB7XHJcblx0XHRcdFx0Ly8gRW5hYmxlIGJ1dHRvblxyXG5cdFx0XHRcdG5leHRCdXR0b24uZGlzYWJsZWQgPSBmYWxzZTtcclxuXHRcdFx0XHRcclxuXHRcdFx0XHQvLyBTaW11bGF0ZSBmb3JtIHN1Ym1pc3Npb25cclxuXHRcdFx0XHRuZXh0QnV0dG9uLnJlbW92ZUF0dHJpYnV0ZSgnZGF0YS1rdC1pbmRpY2F0b3InKTtcclxuXHRcdFx0XHRcclxuXHRcdFx0XHQvLyBHbyB0byBuZXh0IHN0ZXBcclxuXHRcdFx0XHRzdGVwcGVyLmdvTmV4dCgpO1xyXG5cdFx0XHR9LCAxNTAwKTsgXHRcdFxyXG5cdFx0fSk7XHJcblxyXG5cdFx0cHJldmlvdXNCdXR0b24uYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLCBmdW5jdGlvbiAoKSB7XHJcblx0XHRcdHN0ZXBwZXIuZ29QcmV2aW91cygpO1xyXG5cdFx0fSk7XHJcblx0fVxyXG5cclxuXHRyZXR1cm4ge1xyXG5cdFx0Ly8gUHVibGljIGZ1bmN0aW9uc1xyXG5cdFx0aW5pdDogZnVuY3Rpb24gKCkge1xyXG5cdFx0XHRmb3JtID0gS1RNb2RhbENyZWF0ZVByb2plY3QuZ2V0Rm9ybSgpO1xyXG5cdFx0XHRzdGVwcGVyID0gS1RNb2RhbENyZWF0ZVByb2plY3QuZ2V0U3RlcHBlck9iaigpO1xyXG5cdFx0XHRuZXh0QnV0dG9uID0gS1RNb2RhbENyZWF0ZVByb2plY3QuZ2V0U3RlcHBlcigpLnF1ZXJ5U2VsZWN0b3IoJ1tkYXRhLWt0LWVsZW1lbnQ9XCJ0ZWFtLW5leHRcIl0nKTtcclxuXHRcdFx0cHJldmlvdXNCdXR0b24gPSBLVE1vZGFsQ3JlYXRlUHJvamVjdC5nZXRTdGVwcGVyKCkucXVlcnlTZWxlY3RvcignW2RhdGEta3QtZWxlbWVudD1cInRlYW0tcHJldmlvdXNcIl0nKTtcclxuXHJcblx0XHRcdGhhbmRsZUZvcm0oKTtcclxuXHRcdH1cclxuXHR9O1xyXG59KCk7XHJcblxyXG4vLyBXZWJwYWNrIHN1cHBvcnRcclxuaWYgKHR5cGVvZiBtb2R1bGUgIT09ICd1bmRlZmluZWQnICYmIHR5cGVvZiBtb2R1bGUuZXhwb3J0cyAhPT0gJ3VuZGVmaW5lZCcpIHtcclxuXHR3aW5kb3cuS1RNb2RhbENyZWF0ZVByb2plY3RUZWFtID0gbW9kdWxlLmV4cG9ydHMgPSBLVE1vZGFsQ3JlYXRlUHJvamVjdFRlYW07XHJcbn0iXSwibmFtZXMiOlsiS1RNb2RhbENyZWF0ZVByb2plY3RUZWFtIiwibmV4dEJ1dHRvbiIsInByZXZpb3VzQnV0dG9uIiwiZm9ybSIsInN0ZXBwZXIiLCJoYW5kbGVGb3JtIiwiYWRkRXZlbnRMaXN0ZW5lciIsImUiLCJwcmV2ZW50RGVmYXVsdCIsImRpc2FibGVkIiwic2V0QXR0cmlidXRlIiwic2V0VGltZW91dCIsInJlbW92ZUF0dHJpYnV0ZSIsImdvTmV4dCIsImdvUHJldmlvdXMiLCJpbml0IiwiS1RNb2RhbENyZWF0ZVByb2plY3QiLCJnZXRGb3JtIiwiZ2V0U3RlcHBlck9iaiIsImdldFN0ZXBwZXIiLCJxdWVyeVNlbGVjdG9yIiwibW9kdWxlIiwiZXhwb3J0cyIsIndpbmRvdyJdLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./resources/src/js/custom/utilities/modals/create-project/team.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module is referenced by other modules so it can't be inlined
/******/ 	var __webpack_exports__ = __webpack_require__("./resources/src/js/custom/utilities/modals/create-project/team.js");
/******/ 	
/******/ })()
;