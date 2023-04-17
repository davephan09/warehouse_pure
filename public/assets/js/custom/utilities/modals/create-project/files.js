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

/***/ "./resources/src/js/custom/utilities/modals/create-project/files.js":
/*!**************************************************************************!*\
  !*** ./resources/src/js/custom/utilities/modals/create-project/files.js ***!
  \**************************************************************************/
/***/ ((module) => {

eval("\n\n// Class definition\nvar KTModalCreateProjectFiles = function () {\n  // Variables\n  var nextButton;\n  var previousButton;\n  var form;\n  var stepper;\n\n  // Private functions\n  var initForm = function initForm() {\n    // Project logo\n    // For more info about Dropzone plugin visit:  https://www.dropzonejs.com/#usage\n    var myDropzone = new Dropzone(\"#kt_modal_create_project_files_upload\", {\n      url: \"https://keenthemes.com/scripts/void.php\",\n      // Set the url for your upload script location\n      paramName: \"file\",\n      // The name that will be used to transfer the file\n      maxFiles: 10,\n      maxFilesize: 10,\n      // MB\n      addRemoveLinks: true,\n      accept: function accept(file, done) {\n        if (file.name == \"justinbieber.jpg\") {\n          done(\"Naha, you don't.\");\n        } else {\n          done();\n        }\n      }\n    });\n  };\n  var handleForm = function handleForm() {\n    nextButton.addEventListener('click', function (e) {\n      // Prevent default button action\n      e.preventDefault();\n\n      // Disable button to avoid multiple click \n      nextButton.disabled = true;\n\n      // Show loading indication\n      nextButton.setAttribute('data-kt-indicator', 'on');\n\n      // Simulate form submission\n      setTimeout(function () {\n        // Hide loading indication\n        nextButton.removeAttribute('data-kt-indicator');\n\n        // Enable button\n        nextButton.disabled = false;\n\n        // Go to next step\n        stepper.goNext();\n      }, 1500);\n    });\n    previousButton.addEventListener('click', function () {\n      stepper.goPrevious();\n    });\n  };\n  return {\n    // Public functions\n    init: function init() {\n      form = KTModalCreateProject.getForm();\n      stepper = KTModalCreateProject.getStepperObj();\n      nextButton = KTModalCreateProject.getStepper().querySelector('[data-kt-element=\"files-next\"]');\n      previousButton = KTModalCreateProject.getStepper().querySelector('[data-kt-element=\"files-previous\"]');\n      initForm();\n      handleForm();\n    }\n  };\n}();\n\n// Webpack support\nif ( true && typeof module.exports !== 'undefined') {\n  window.KTModalCreateProjectFiles = module.exports = KTModalCreateProjectFiles;\n}//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9yZXNvdXJjZXMvc3JjL2pzL2N1c3RvbS91dGlsaXRpZXMvbW9kYWxzL2NyZWF0ZS1wcm9qZWN0L2ZpbGVzLmpzLmpzIiwibWFwcGluZ3MiOiJBQUFhOztBQUViO0FBQ0EsSUFBSUEseUJBQXlCLEdBQUcsWUFBWTtFQUMzQztFQUNBLElBQUlDLFVBQVU7RUFDZCxJQUFJQyxjQUFjO0VBQ2xCLElBQUlDLElBQUk7RUFDUixJQUFJQyxPQUFPOztFQUVYO0VBQ0EsSUFBSUMsUUFBUSxHQUFHLFNBQVhBLFFBQVFBLENBQUEsRUFBYztJQUN6QjtJQUNBO0lBQ0EsSUFBSUMsVUFBVSxHQUFHLElBQUlDLFFBQVEsQ0FBQyx1Q0FBdUMsRUFBRTtNQUN0RUMsR0FBRyxFQUFFLHlDQUF5QztNQUFFO01BQ3ZDQyxTQUFTLEVBQUUsTUFBTTtNQUFFO01BQ25CQyxRQUFRLEVBQUUsRUFBRTtNQUNaQyxXQUFXLEVBQUUsRUFBRTtNQUFFO01BQ2pCQyxjQUFjLEVBQUUsSUFBSTtNQUNwQkMsTUFBTSxFQUFFLFNBQUFBLE9BQVNDLElBQUksRUFBRUMsSUFBSSxFQUFFO1FBQ3pCLElBQUlELElBQUksQ0FBQ0UsSUFBSSxJQUFJLGtCQUFrQixFQUFFO1VBQ2pDRCxJQUFJLENBQUMsa0JBQWtCLENBQUM7UUFDNUIsQ0FBQyxNQUFNO1VBQ0hBLElBQUksRUFBRTtRQUNWO01BQ0o7SUFDVixDQUFDLENBQUM7RUFDSCxDQUFDO0VBRUQsSUFBSUUsVUFBVSxHQUFHLFNBQWJBLFVBQVVBLENBQUEsRUFBYztJQUMzQmhCLFVBQVUsQ0FBQ2lCLGdCQUFnQixDQUFDLE9BQU8sRUFBRSxVQUFVQyxDQUFDLEVBQUU7TUFDakQ7TUFDQUEsQ0FBQyxDQUFDQyxjQUFjLEVBQUU7O01BRWxCO01BQ0FuQixVQUFVLENBQUNvQixRQUFRLEdBQUcsSUFBSTs7TUFFMUI7TUFDQXBCLFVBQVUsQ0FBQ3FCLFlBQVksQ0FBQyxtQkFBbUIsRUFBRSxJQUFJLENBQUM7O01BRWxEO01BQ0FDLFVBQVUsQ0FBQyxZQUFXO1FBQ3JCO1FBQ0F0QixVQUFVLENBQUN1QixlQUFlLENBQUMsbUJBQW1CLENBQUM7O1FBRS9DO1FBQ0F2QixVQUFVLENBQUNvQixRQUFRLEdBQUcsS0FBSzs7UUFFM0I7UUFDQWpCLE9BQU8sQ0FBQ3FCLE1BQU0sRUFBRTtNQUNqQixDQUFDLEVBQUUsSUFBSSxDQUFDO0lBQ1QsQ0FBQyxDQUFDO0lBRUZ2QixjQUFjLENBQUNnQixnQkFBZ0IsQ0FBQyxPQUFPLEVBQUUsWUFBWTtNQUNwRGQsT0FBTyxDQUFDc0IsVUFBVSxFQUFFO0lBQ3JCLENBQUMsQ0FBQztFQUNILENBQUM7RUFFRCxPQUFPO0lBQ047SUFDQUMsSUFBSSxFQUFFLFNBQUFBLEtBQUEsRUFBWTtNQUNqQnhCLElBQUksR0FBR3lCLG9CQUFvQixDQUFDQyxPQUFPLEVBQUU7TUFDckN6QixPQUFPLEdBQUd3QixvQkFBb0IsQ0FBQ0UsYUFBYSxFQUFFO01BQzlDN0IsVUFBVSxHQUFHMkIsb0JBQW9CLENBQUNHLFVBQVUsRUFBRSxDQUFDQyxhQUFhLENBQUMsZ0NBQWdDLENBQUM7TUFDOUY5QixjQUFjLEdBQUcwQixvQkFBb0IsQ0FBQ0csVUFBVSxFQUFFLENBQUNDLGFBQWEsQ0FBQyxvQ0FBb0MsQ0FBQztNQUV0RzNCLFFBQVEsRUFBRTtNQUNWWSxVQUFVLEVBQUU7SUFDYjtFQUNELENBQUM7QUFDRixDQUFDLEVBQUU7O0FBRUg7QUFDQSxJQUFJLEtBQTZCLElBQUksT0FBT2dCLE1BQU0sQ0FBQ0MsT0FBTyxLQUFLLFdBQVcsRUFBRTtFQUMzRUMsTUFBTSxDQUFDbkMseUJBQXlCLEdBQUdpQyxNQUFNLENBQUNDLE9BQU8sR0FBR2xDLHlCQUF5QjtBQUM5RSIsInNvdXJjZXMiOlsid2VicGFjazovLy8uL3Jlc291cmNlcy9zcmMvanMvY3VzdG9tL3V0aWxpdGllcy9tb2RhbHMvY3JlYXRlLXByb2plY3QvZmlsZXMuanM/MmI3OCJdLCJzb3VyY2VzQ29udGVudCI6WyJcInVzZSBzdHJpY3RcIjtcclxuXHJcbi8vIENsYXNzIGRlZmluaXRpb25cclxudmFyIEtUTW9kYWxDcmVhdGVQcm9qZWN0RmlsZXMgPSBmdW5jdGlvbiAoKSB7XHJcblx0Ly8gVmFyaWFibGVzXHJcblx0dmFyIG5leHRCdXR0b247XHJcblx0dmFyIHByZXZpb3VzQnV0dG9uO1xyXG5cdHZhciBmb3JtO1xyXG5cdHZhciBzdGVwcGVyO1xyXG5cclxuXHQvLyBQcml2YXRlIGZ1bmN0aW9uc1xyXG5cdHZhciBpbml0Rm9ybSA9IGZ1bmN0aW9uKCkge1xyXG5cdFx0Ly8gUHJvamVjdCBsb2dvXHJcblx0XHQvLyBGb3IgbW9yZSBpbmZvIGFib3V0IERyb3B6b25lIHBsdWdpbiB2aXNpdDogIGh0dHBzOi8vd3d3LmRyb3B6b25lanMuY29tLyN1c2FnZVxyXG5cdFx0dmFyIG15RHJvcHpvbmUgPSBuZXcgRHJvcHpvbmUoXCIja3RfbW9kYWxfY3JlYXRlX3Byb2plY3RfZmlsZXNfdXBsb2FkXCIsIHsgXHJcblx0XHRcdHVybDogXCJodHRwczovL2tlZW50aGVtZXMuY29tL3NjcmlwdHMvdm9pZC5waHBcIiwgLy8gU2V0IHRoZSB1cmwgZm9yIHlvdXIgdXBsb2FkIHNjcmlwdCBsb2NhdGlvblxyXG4gICAgICAgICAgICBwYXJhbU5hbWU6IFwiZmlsZVwiLCAvLyBUaGUgbmFtZSB0aGF0IHdpbGwgYmUgdXNlZCB0byB0cmFuc2ZlciB0aGUgZmlsZVxyXG4gICAgICAgICAgICBtYXhGaWxlczogMTAsXHJcbiAgICAgICAgICAgIG1heEZpbGVzaXplOiAxMCwgLy8gTUJcclxuICAgICAgICAgICAgYWRkUmVtb3ZlTGlua3M6IHRydWUsXHJcbiAgICAgICAgICAgIGFjY2VwdDogZnVuY3Rpb24oZmlsZSwgZG9uZSkge1xyXG4gICAgICAgICAgICAgICAgaWYgKGZpbGUubmFtZSA9PSBcImp1c3RpbmJpZWJlci5qcGdcIikge1xyXG4gICAgICAgICAgICAgICAgICAgIGRvbmUoXCJOYWhhLCB5b3UgZG9uJ3QuXCIpO1xyXG4gICAgICAgICAgICAgICAgfSBlbHNlIHtcclxuICAgICAgICAgICAgICAgICAgICBkb25lKCk7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH1cclxuXHRcdH0pOyAgXHJcblx0fVxyXG5cclxuXHR2YXIgaGFuZGxlRm9ybSA9IGZ1bmN0aW9uKCkge1xyXG5cdFx0bmV4dEJ1dHRvbi5hZGRFdmVudExpc3RlbmVyKCdjbGljaycsIGZ1bmN0aW9uIChlKSB7XHJcblx0XHRcdC8vIFByZXZlbnQgZGVmYXVsdCBidXR0b24gYWN0aW9uXHJcblx0XHRcdGUucHJldmVudERlZmF1bHQoKTtcclxuXHJcblx0XHRcdC8vIERpc2FibGUgYnV0dG9uIHRvIGF2b2lkIG11bHRpcGxlIGNsaWNrIFxyXG5cdFx0XHRuZXh0QnV0dG9uLmRpc2FibGVkID0gdHJ1ZTtcclxuXHJcblx0XHRcdC8vIFNob3cgbG9hZGluZyBpbmRpY2F0aW9uXHJcblx0XHRcdG5leHRCdXR0b24uc2V0QXR0cmlidXRlKCdkYXRhLWt0LWluZGljYXRvcicsICdvbicpO1xyXG5cclxuXHRcdFx0Ly8gU2ltdWxhdGUgZm9ybSBzdWJtaXNzaW9uXHJcblx0XHRcdHNldFRpbWVvdXQoZnVuY3Rpb24oKSB7XHJcblx0XHRcdFx0Ly8gSGlkZSBsb2FkaW5nIGluZGljYXRpb25cclxuXHRcdFx0XHRuZXh0QnV0dG9uLnJlbW92ZUF0dHJpYnV0ZSgnZGF0YS1rdC1pbmRpY2F0b3InKTtcclxuXHJcblx0XHRcdFx0Ly8gRW5hYmxlIGJ1dHRvblxyXG5cdFx0XHRcdG5leHRCdXR0b24uZGlzYWJsZWQgPSBmYWxzZTtcclxuXHRcdFx0XHRcclxuXHRcdFx0XHQvLyBHbyB0byBuZXh0IHN0ZXBcclxuXHRcdFx0XHRzdGVwcGVyLmdvTmV4dCgpO1xyXG5cdFx0XHR9LCAxNTAwKTsgXHRcdFxyXG5cdFx0fSk7XHJcblxyXG5cdFx0cHJldmlvdXNCdXR0b24uYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLCBmdW5jdGlvbiAoKSB7XHJcblx0XHRcdHN0ZXBwZXIuZ29QcmV2aW91cygpO1xyXG5cdFx0fSk7XHJcblx0fVxyXG5cclxuXHRyZXR1cm4ge1xyXG5cdFx0Ly8gUHVibGljIGZ1bmN0aW9uc1xyXG5cdFx0aW5pdDogZnVuY3Rpb24gKCkge1xyXG5cdFx0XHRmb3JtID0gS1RNb2RhbENyZWF0ZVByb2plY3QuZ2V0Rm9ybSgpO1xyXG5cdFx0XHRzdGVwcGVyID0gS1RNb2RhbENyZWF0ZVByb2plY3QuZ2V0U3RlcHBlck9iaigpO1xyXG5cdFx0XHRuZXh0QnV0dG9uID0gS1RNb2RhbENyZWF0ZVByb2plY3QuZ2V0U3RlcHBlcigpLnF1ZXJ5U2VsZWN0b3IoJ1tkYXRhLWt0LWVsZW1lbnQ9XCJmaWxlcy1uZXh0XCJdJyk7XHJcblx0XHRcdHByZXZpb3VzQnV0dG9uID0gS1RNb2RhbENyZWF0ZVByb2plY3QuZ2V0U3RlcHBlcigpLnF1ZXJ5U2VsZWN0b3IoJ1tkYXRhLWt0LWVsZW1lbnQ9XCJmaWxlcy1wcmV2aW91c1wiXScpO1xyXG5cclxuXHRcdFx0aW5pdEZvcm0oKTtcclxuXHRcdFx0aGFuZGxlRm9ybSgpO1xyXG5cdFx0fVxyXG5cdH07XHJcbn0oKTtcclxuXHJcbi8vIFdlYnBhY2sgc3VwcG9ydFxyXG5pZiAodHlwZW9mIG1vZHVsZSAhPT0gJ3VuZGVmaW5lZCcgJiYgdHlwZW9mIG1vZHVsZS5leHBvcnRzICE9PSAndW5kZWZpbmVkJykge1xyXG5cdHdpbmRvdy5LVE1vZGFsQ3JlYXRlUHJvamVjdEZpbGVzID0gbW9kdWxlLmV4cG9ydHMgPSBLVE1vZGFsQ3JlYXRlUHJvamVjdEZpbGVzO1xyXG59XHJcbiJdLCJuYW1lcyI6WyJLVE1vZGFsQ3JlYXRlUHJvamVjdEZpbGVzIiwibmV4dEJ1dHRvbiIsInByZXZpb3VzQnV0dG9uIiwiZm9ybSIsInN0ZXBwZXIiLCJpbml0Rm9ybSIsIm15RHJvcHpvbmUiLCJEcm9wem9uZSIsInVybCIsInBhcmFtTmFtZSIsIm1heEZpbGVzIiwibWF4RmlsZXNpemUiLCJhZGRSZW1vdmVMaW5rcyIsImFjY2VwdCIsImZpbGUiLCJkb25lIiwibmFtZSIsImhhbmRsZUZvcm0iLCJhZGRFdmVudExpc3RlbmVyIiwiZSIsInByZXZlbnREZWZhdWx0IiwiZGlzYWJsZWQiLCJzZXRBdHRyaWJ1dGUiLCJzZXRUaW1lb3V0IiwicmVtb3ZlQXR0cmlidXRlIiwiZ29OZXh0IiwiZ29QcmV2aW91cyIsImluaXQiLCJLVE1vZGFsQ3JlYXRlUHJvamVjdCIsImdldEZvcm0iLCJnZXRTdGVwcGVyT2JqIiwiZ2V0U3RlcHBlciIsInF1ZXJ5U2VsZWN0b3IiLCJtb2R1bGUiLCJleHBvcnRzIiwid2luZG93Il0sInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./resources/src/js/custom/utilities/modals/create-project/files.js\n");

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
/******/ 	var __webpack_exports__ = __webpack_require__("./resources/src/js/custom/utilities/modals/create-project/files.js");
/******/ 	
/******/ })()
;