"use strict";
(self["webpackChunkkhardl"] = self["webpackChunkkhardl"] || []).push([["resources_landing-page_src_components_MainText_jsx"],{

/***/ "./resources/landing-page/src/components/MainText.jsx":
/*!************************************************************!*\
  !*** ./resources/landing-page/src/components/MainText.jsx ***!
  \************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _TextWithLine__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./TextWithLine */ "./resources/landing-page/src/components/TextWithLine.jsx");
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! react/jsx-runtime */ "./node_modules/react/jsx-runtime.js");





var MainText = function MainText(_ref) {
  var Title = _ref.Title,
    SubTitle = _ref.SubTitle,
    classTitle = _ref.classTitle,
    classSubTitle = _ref.classSubTitle;
  return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)("div", {
    className: "flex flex-col items-center",
    children: [Title ? /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("h2", {
      className: "font-semibold text-[25px] max-[600px]:text-[22px] mb-2 ",
      children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)(_TextWithLine__WEBPACK_IMPORTED_MODULE_1__["default"], {
        text: Title,
        classNameLine: "!w-[75px] !h-[12px] ".concat(classTitle),
        className: "".concat(classTitle)
      })
    }) : /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)(react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.Fragment, {}), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("h2", {
      className: "text-center leading-7 max-md:px-6 text-[20px] max-w-[650px] max-[600px]:text-[16px] mb-2 ".concat(classSubTitle),
      children: SubTitle
    })]
  });
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (MainText);

/***/ }),

/***/ "./resources/landing-page/src/components/TextWithLine.jsx":
/*!****************************************************************!*\
  !*** ./resources/landing-page/src/components/TextWithLine.jsx ***!
  \****************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! react/jsx-runtime */ "./node_modules/react/jsx-runtime.js");



var TextWithLine = function TextWithLine(_ref) {
  var text = _ref.text,
    classNameLine = _ref.classNameLine,
    className = _ref.className;
  return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("div", {
    className: "relative",
    children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("span", {
      className: "absolute w-full h-3 rounded-full bg-[var(--primary)] top-[38px] max-[1000px]:top-[28px] max-[500px]:top-[22px] transform -translate-y-1/2 z-0 ".concat(classNameLine)
    }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("span", {
      className: "relative z-10 text-black px-2 text-[40px] max-[1000px]:text-[30px] max-[500px]:text-[26px] ".concat(className),
      children: text
    })]
  });
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (TextWithLine);

/***/ })

}]);