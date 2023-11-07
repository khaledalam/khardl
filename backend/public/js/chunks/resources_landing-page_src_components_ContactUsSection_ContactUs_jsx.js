"use strict";
(self["webpackChunkkhardl"] = self["webpackChunkkhardl"] || []).push([["resources_landing-page_src_components_ContactUsSection_ContactUs_jsx"],{

/***/ "./resources/landing-page/src/components/ContactUsSection/ContactUs.jsx":
/*!******************************************************************************!*\
  !*** ./resources/landing-page/src/components/ContactUsSection/ContactUs.jsx ***!
  \******************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _assets_ContactUsCover_webp__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../assets/ContactUsCover.webp */ "./resources/landing-page/src/assets/ContactUsCover.webp");
/* harmony import */ var react_i18next__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! react-i18next */ "./node_modules/react-i18next/dist/es/index.js");
/* harmony import */ var react_router_dom__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! react-router-dom */ "./node_modules/react-router-dom/dist/index.js");
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! react/jsx-runtime */ "./node_modules/react/jsx-runtime.js");






var LazyMainText = /*#__PURE__*/(0,react__WEBPACK_IMPORTED_MODULE_0__.lazy)(function () {
  return __webpack_require__.e(/*! import() */ "resources_landing-page_src_components_MainText_jsx").then(__webpack_require__.bind(__webpack_require__, /*! ../MainText */ "./resources/landing-page/src/components/MainText.jsx"));
});
var LazyButton = /*#__PURE__*/(0,react__WEBPACK_IMPORTED_MODULE_0__.lazy)(function () {
  return __webpack_require__.e(/*! import() */ "resources_landing-page_src_components_Button_jsx").then(__webpack_require__.bind(__webpack_require__, /*! ../Button */ "./resources/landing-page/src/components/Button.jsx"));
});
function ContactUs() {
  var _useTranslation = (0,react_i18next__WEBPACK_IMPORTED_MODULE_2__.useTranslation)(),
    t = _useTranslation.t;
  return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("div", {
    className: "text-center w-[100%]",
    style: {
      backgroundImage: "url(".concat(_assets_ContactUsCover_webp__WEBPACK_IMPORTED_MODULE_1__["default"], ")"),
      backgroundSize: "cover"
    },
    children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)(react__WEBPACK_IMPORTED_MODULE_0__.Suspense, {
      fallback: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("div", {
        children: "Loading..."
      }),
      children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("div", {
        className: "mx-32 mt-8 max-[1200px]:mx-0 p-16 max-[540px]:p-10 max-[900px]:mt-[30px]",
        children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsxs)("div", {
          className: "grid grid-cols-2 items-center max-[700px]:flex max-[700px]:flex-wrap-reverse",
          children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsxs)("div", {
            className: "w-[100%]",
            children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("div", {
              className: "max-[900px]:text-center w-[100%]",
              children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)(LazyMainText, {
                classTitle: "!mb-[20px]",
                classSubTitle: "!leading-8",
                Title: t("ContactUs")
              })
            }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("div", {
              className: "w-[100%] flex items-center justify-center",
              children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsxs)("form", {
                className: "w-[100%] xl:w-[80%] flex flex-col gap-[22px] px-[15px]",
                children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("input", {
                  className: "p-[16px] max-[540px]:py-[15px] boreder-none rounded-full bg-[var(--secondary)]",
                  placeholder: t("Email"),
                  name: "email"
                }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("input", {
                  className: "p-[16px] max-[540px]:py-[15px] boreder-none rounded-full bg-[var(--secondary)]",
                  placeholder: t("Phone"),
                  name: "Phone"
                }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("input", {
                  className: "p-[16px] max-[540px]:py-[15px] boreder-none rounded-full bg-[var(--secondary)]",
                  placeholder: t("Business name"),
                  name: "BusinessName"
                }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("input", {
                  className: "p-[16px] max-[540px]:py-[15px] boreder-none rounded-full bg-[var(--secondary)]",
                  placeholder: t("Responsible person name"),
                  name: "ResponsiblePersonName"
                }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsxs)(react_router_dom__WEBPACK_IMPORTED_MODULE_4__.Link, {
                  to: "/login",
                  className: "cursor-pointer flex gap-1",
                  children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("h2", {
                    children: t("create your website")
                  }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("h2", {
                    className: "text-blue-500",
                    children: t("from here")
                  })]
                }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("div", {
                  className: "flex justify-center",
                  children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)(LazyButton, {
                    title: t("Send"),
                    classContainer: "!border-none !py-2 !px-10 !w-fit text-[20px]"
                  })
                })]
              })
            })]
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("div", {
            children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("div", {
              className: "max-[900px]:text-center",
              children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)(LazyMainText, {
                classTitle: "!mb-[30px]",
                classSubTitle: "!leading-8",
                Title: t("Let us help you get more clients with lower fees")
              })
            })
          })]
        })
      })
    })
  });
}
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (ContactUs);

/***/ }),

/***/ "./resources/landing-page/src/assets/ContactUsCover.webp":
/*!***************************************************************!*\
  !*** ./resources/landing-page/src/assets/ContactUsCover.webp ***!
  \***************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ("/images/ContactUsCover.webp?8cfedd3a2b6f1b95be8d7efe25a42dae");

/***/ })

}]);