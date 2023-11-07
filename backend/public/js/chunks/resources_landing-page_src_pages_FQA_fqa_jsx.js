"use strict";
(self["webpackChunkkhardl"] = self["webpackChunkkhardl"] || []).push([["resources_landing-page_src_pages_FQA_fqa_jsx"],{

/***/ "./resources/landing-page/src/pages/FQA/fqa.jsx":
/*!******************************************************!*\
  !*** ./resources/landing-page/src/pages/FQA/fqa.jsx ***!
  \******************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var react_i18next__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! react-i18next */ "./node_modules/react-i18next/dist/es/index.js");
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! react/jsx-runtime */ "./node_modules/react/jsx-runtime.js");




var SectionAsk = /*#__PURE__*/(0,react__WEBPACK_IMPORTED_MODULE_0__.lazy)(function () {
  return __webpack_require__.e(/*! import() */ "resources_landing-page_src_components_FrequentlyAsk_SectionAsk_jsx").then(__webpack_require__.bind(__webpack_require__, /*! ../../components/FrequentlyAsk/SectionAsk */ "./resources/landing-page/src/components/FrequentlyAsk/SectionAsk.jsx"));
});
var HeaderSection = /*#__PURE__*/(0,react__WEBPACK_IMPORTED_MODULE_0__.lazy)(function () {
  return __webpack_require__.e(/*! import() */ "resources_landing-page_src_components_HeaderSection_jsx").then(__webpack_require__.bind(__webpack_require__, /*! ../../components/HeaderSection */ "./resources/landing-page/src/components/HeaderSection.jsx"));
});
var MainText = /*#__PURE__*/(0,react__WEBPACK_IMPORTED_MODULE_0__.lazy)(function () {
  return __webpack_require__.e(/*! import() */ "resources_landing-page_src_components_MainText_jsx").then(__webpack_require__.bind(__webpack_require__, /*! ../../components/MainText */ "./resources/landing-page/src/components/MainText.jsx"));
});
var ContactUs = /*#__PURE__*/(0,react__WEBPACK_IMPORTED_MODULE_0__.lazy)(function () {
  return __webpack_require__.e(/*! import() */ "resources_landing-page_src_components_ContactUsSection_ContactUs_jsx").then(__webpack_require__.bind(__webpack_require__, /*! ../../components/ContactUsSection/ContactUs */ "./resources/landing-page/src/components/ContactUsSection/ContactUs.jsx"));
});
var Loading = /*#__PURE__*/(0,react__WEBPACK_IMPORTED_MODULE_0__.lazy)(function () {
  return __webpack_require__.e(/*! import() */ "resources_landing-page_src_pages_Loading_jsx").then(__webpack_require__.bind(__webpack_require__, /*! ../Loading */ "./resources/landing-page/src/pages/Loading.jsx"));
});
var FQA = function FQA() {
  var _useTranslation = (0,react_i18next__WEBPACK_IMPORTED_MODULE_1__.useTranslation)(),
    t = _useTranslation.t;
  var faqsGeneral = [{
    question: "".concat(t("Question 1")),
    answer: "".concat(t("Answer 1"))
  }, {
    question: "".concat(t("Question 2")),
    answer: "".concat(t("Answer 2"))
  }, {
    question: "".concat(t("Question 3")),
    answer: "".concat(t("Answer 3"))
  }, {
    question: "".concat(t("Question 4")),
    answer: "".concat(t("Answer 4"))
  }, {
    question: "".concat(t("Question 5")),
    answer: "".concat(t("Answer 5"))
  }, {
    question: "".concat(t("Question 6")),
    answer: "".concat(t("Answer 6"))
  }];
  return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)(react__WEBPACK_IMPORTED_MODULE_0__.Suspense, {
    fallback: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)(Loading, {}),
    children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)("div", {
      className: "pt-[80px]",
      children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("div", {
        className: "p-[30px]  pt-[60px] max-md:px-[5px] max-md:py-[40px] ",
        children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)(HeaderSection, {
          title: t("FQA"),
          details: "".concat(t("Home"), " / ").concat(t("FQA"))
        })
      }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("div", {
        className: "mt-6",
        children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)(MainText, {
          SubTitle: t("Default Text")
        })
      }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("div", {
        className: "flex justify-center pb-16",
        children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)(SectionAsk, {
          data: faqsGeneral
        })
      }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)(ContactUs, {})]
    })
  });
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (FQA);

/***/ })

}]);