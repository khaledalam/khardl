"use strict";
(self["webpackChunkkhardl"] = self["webpackChunkkhardl"] || []).push([["resources_landing-page_src_pages_Home_Components_Hero_jsx"],{

/***/ "./resources/landing-page/src/components/Button.jsx":
/*!**********************************************************!*\
  !*** ./resources/landing-page/src/components/Button.jsx ***!
  \**********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var react_router_dom__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! react-router-dom */ "./node_modules/react-router-dom/dist/index.js");
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! react/jsx-runtime */ "./node_modules/react/jsx-runtime.js");




var Button = function Button(_ref) {
  var title = _ref.title,
    classContainer = _ref.classContainer,
    onClick = _ref.onClick,
    icon = _ref.icon,
    link = _ref.link;
  return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)(react_router_dom__WEBPACK_IMPORTED_MODULE_2__.Link, {
    to: link,
    children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("button", {
      onClick: onClick,
      className: "font-bold border-[1px] border-black bg-[var(--primary)] flex justify-center items-center gap-[3px] rounded-full transition-all delay-100  py-2 px-6 text-[18px] leading-6 w-fit ".concat(classContainer),
      children: [title, icon]
    })
  });
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Button);

/***/ }),

/***/ "./resources/landing-page/src/pages/Home/Components/Hero.jsx":
/*!*******************************************************************!*\
  !*** ./resources/landing-page/src/pages/Home/Components/Hero.jsx ***!
  \*******************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _assets_Logo_webp__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../../assets/Logo.webp */ "./resources/landing-page/src/assets/Logo.webp");
/* harmony import */ var _assets_Hero_webp__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../assets/Hero.webp */ "./resources/landing-page/src/assets/Hero.webp");
/* harmony import */ var _assets_HeroPitcure_webp__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../assets/HeroPitcure.webp */ "./resources/landing-page/src/assets/HeroPitcure.webp");
/* harmony import */ var react_i18next__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! react-i18next */ "./node_modules/react-i18next/dist/es/index.js");
/* harmony import */ var _components_Button__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ../../../components/Button */ "./resources/landing-page/src/components/Button.jsx");
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! react/jsx-runtime */ "./node_modules/react/jsx-runtime.js");








var Hero = function Hero() {
  var _useTranslation = (0,react_i18next__WEBPACK_IMPORTED_MODULE_4__.useTranslation)(),
    t = _useTranslation.t;
  return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_6__.jsx)("section", {
    className: "active text-center mx-[160px] max-[1250px]:mx-[20px]",
    children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_6__.jsx)("div", {
      className: "px-6 py-10 text-center md:text-right rounded-[30px]",
      style: {
        backgroundImage: "url(".concat(_assets_Hero_webp__WEBPACK_IMPORTED_MODULE_2__["default"], ")"),
        backgroundSize: "cover"
      },
      children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_6__.jsxs)("div", {
        className: "grid grid-cols-2 items-center max-[700px]:flex  max-[700px]:flex-wrap-reverse",
        children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_6__.jsxs)("div", {
          className: "flex flex-col items-center justify-center gap-4",
          children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_6__.jsx)("div", {
            className: "mb-4 uppercase",
            children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_6__.jsx)("img", {
              loading: "lazy",
              className: "w-20 max-[500px]:w-16",
              src: _assets_Logo_webp__WEBPACK_IMPORTED_MODULE_1__["default"],
              alt: "logo"
            })
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_6__.jsx)("div", {
            className: "text-[34px] max-[1000px]:text-[30px] max-[500px]:text-[24px] font-bold flex justify-center gap-2 ",
            children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_6__.jsxs)("h2", {
              className: "max-w-[500px] text-center",
              children: [t("more clients"), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_6__.jsxs)("span", {
                className: "text-white",
                children: ["\xA0", t("commissions"), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_6__.jsxs)("span", {
                  className: "text-black",
                  children: ["\xA0", t("or")]
                }), "\xA0", t("mandatory subscriptions")]
              })]
            })
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_6__.jsx)("h2", {
            className: "max-w-[500px] text-center text-[18px] mb-4",
            children: t("Create your website")
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_6__.jsx)(_components_Button__WEBPACK_IMPORTED_MODULE_5__["default"], {
            title: t("Start Now"),
            link: "/register",
            classContainer: "!bg-black !text-[var(--primary)] !border-none !px-[70px] !py-3"
          })]
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_6__.jsx)("div", {
          className: "mb-4 uppercase",
          children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_6__.jsx)("img", {
            loading: "lazy",
            className: "w-full h-auto max-w-[100%]",
            src: _assets_HeroPitcure_webp__WEBPACK_IMPORTED_MODULE_3__["default"],
            alt: "logo"
          })
        })]
      })
    })
  });
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Hero);

/***/ }),

/***/ "./resources/landing-page/src/assets/Hero.webp":
/*!*****************************************************!*\
  !*** ./resources/landing-page/src/assets/Hero.webp ***!
  \*****************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ("/images/Hero.webp?be6cbdb497c53bf531f6e5f94ba2b091");

/***/ }),

/***/ "./resources/landing-page/src/assets/HeroPitcure.webp":
/*!************************************************************!*\
  !*** ./resources/landing-page/src/assets/HeroPitcure.webp ***!
  \************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ("/images/HeroPitcure.webp?9f52118d5891a4144f98a411fef9be01");

/***/ }),

/***/ "./resources/landing-page/src/assets/Logo.webp":
/*!*****************************************************!*\
  !*** ./resources/landing-page/src/assets/Logo.webp ***!
  \*****************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ("/images/Logo.webp?3768c851aea43781b2ccec6789e48fa1");

/***/ })

}]);