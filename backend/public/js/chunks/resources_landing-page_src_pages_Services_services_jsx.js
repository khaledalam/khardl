"use strict";
(self["webpackChunkkhardl"] = self["webpackChunkkhardl"] || []).push([["resources_landing-page_src_pages_Services_services_jsx"],{

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

/***/ }),

/***/ "./resources/landing-page/src/pages/Services/services.jsx":
/*!****************************************************************!*\
  !*** ./resources/landing-page/src/pages/Services/services.jsx ***!
  \****************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var react_i18next__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! react-i18next */ "./node_modules/react-i18next/dist/es/index.js");
/* harmony import */ var _components_MainText__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../components/MainText */ "./resources/landing-page/src/components/MainText.jsx");
/* harmony import */ var _assets_driversApp_webp__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../assets/driversApp.webp */ "./resources/landing-page/src/assets/driversApp.webp");
/* harmony import */ var _assets_Branches_webp__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../../assets/Branches.webp */ "./resources/landing-page/src/assets/Branches.webp");
/* harmony import */ var _assets_receiveRequests_webp__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ../../assets/receiveRequests.webp */ "./resources/landing-page/src/assets/receiveRequests.webp");
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! react/jsx-runtime */ "./node_modules/react/jsx-runtime.js");








var HeaderSection = /*#__PURE__*/(0,react__WEBPACK_IMPORTED_MODULE_0__.lazy)(function () {
  return __webpack_require__.e(/*! import() */ "resources_landing-page_src_components_HeaderSection_jsx").then(__webpack_require__.bind(__webpack_require__, /*! ../../components/HeaderSection */ "./resources/landing-page/src/components/HeaderSection.jsx"));
});
var ContactUs = /*#__PURE__*/(0,react__WEBPACK_IMPORTED_MODULE_0__.lazy)(function () {
  return __webpack_require__.e(/*! import() */ "resources_landing-page_src_components_ContactUsSection_ContactUs_jsx").then(__webpack_require__.bind(__webpack_require__, /*! ../../components/ContactUsSection/ContactUs */ "./resources/landing-page/src/components/ContactUsSection/ContactUs.jsx"));
});
var Card = /*#__PURE__*/(0,react__WEBPACK_IMPORTED_MODULE_0__.lazy)(function () {
  return __webpack_require__.e(/*! import() */ "resources_landing-page_src_components_FeaturesSection_Card_jsx").then(__webpack_require__.bind(__webpack_require__, /*! ../../components/FeaturesSection/Card */ "./resources/landing-page/src/components/FeaturesSection/Card.jsx"));
});
var Button = /*#__PURE__*/(0,react__WEBPACK_IMPORTED_MODULE_0__.lazy)(function () {
  return __webpack_require__.e(/*! import() */ "resources_landing-page_src_components_Button_jsx").then(__webpack_require__.bind(__webpack_require__, /*! ../../components/Button */ "./resources/landing-page/src/components/Button.jsx"));
});
var Loading = /*#__PURE__*/(0,react__WEBPACK_IMPORTED_MODULE_0__.lazy)(function () {
  return __webpack_require__.e(/*! import() */ "resources_landing-page_src_pages_Loading_jsx").then(__webpack_require__.bind(__webpack_require__, /*! ../Loading */ "./resources/landing-page/src/pages/Loading.jsx"));
});
function Services() {
  var _useTranslation = (0,react_i18next__WEBPACK_IMPORTED_MODULE_1__.useTranslation)(),
    t = _useTranslation.t;
  var Features = [{
    image: _assets_receiveRequests_webp__WEBPACK_IMPORTED_MODULE_5__["default"],
    title: "".concat(t("Receive Receive")),
    Price: "".concat(t("Receive Requests Price")),
    Device: "".concat(t("Devices"))
  }, {
    image: _assets_driversApp_webp__WEBPACK_IMPORTED_MODULE_3__["default"],
    title: "".concat(t("Drivers App")),
    Price: "".concat(t("Drivers App Price")),
    Device: "".concat(t("Devices"))
  }, {
    image: _assets_Branches_webp__WEBPACK_IMPORTED_MODULE_4__["default"],
    title: "".concat(t("Each Branch")),
    Price: 388
  }];
  var Fees = [{
    title: "".concat(t("Monthly")),
    Price: 299
  }, {
    title: "".concat(t("3 months")),
    Price: 499
  }, {
    title: "".concat(t("6 months")),
    Price: 799
  }, {
    title: "".concat(t("12 months")),
    Price: 1299
  }];
  return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_6__.jsx)("div", {
    className: "pt-[80px]",
    children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_6__.jsxs)(react__WEBPACK_IMPORTED_MODULE_0__.Suspense, {
      fallback: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_6__.jsx)(Loading, {}),
      children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_6__.jsx)("div", {
        className: "p-[30px]  pt-[60px] max-md:px-[5px] max-md:py-[40px] ",
        children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_6__.jsx)(HeaderSection, {
          title: t("Services"),
          details: "".concat(t("Home"), " / ").concat(t("Services"))
        })
      }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_6__.jsxs)("div", {
        className: "mt-22 mb-[130px]",
        children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_6__.jsx)("div", {
          className: "mt-6",
          children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_6__.jsx)(_components_MainText__WEBPACK_IMPORTED_MODULE_2__["default"], {
            SubTitle: t("Khardl's services Details")
          })
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_6__.jsxs)("div", {
          className: "mx-[160px] max-[1250px]:mx-[20px]",
          children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_6__.jsx)("div", {
            className: "grid max-sm:grid-cols-1 max-lg:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 gap-10 mx-4 mt-8 mb-[50px]",
            children: Features.map(function (Feature, index) {
              return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_6__.jsx)(Card, {
                FeatureImage: Feature.image,
                FeatureTitle: Feature.title,
                FeaturePrice: Feature.Price,
                FeatureDevice: Feature.Device
              }, index);
            })
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_6__.jsx)("div", {
            className: "mt-6",
            children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_6__.jsx)(_components_MainText__WEBPACK_IMPORTED_MODULE_2__["default"], {
              SubTitle: t("Application for your site")
            })
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_6__.jsx)("div", {
            className: "grid max-sm:grid-cols-1 max-lg:grid-cols-3 lg:grid-cols-3 xl:grid-cols-4 gap-10 mx-4 mt-8 mb-[50px]",
            children: Fees.map(function (Feature, index) {
              return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_6__.jsx)(Card, {
                FeatureTitle: Feature.title,
                FeaturePrice: Feature.Price
              }, index);
            })
          })]
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_6__.jsx)("div", {
          className: "flex justify-center",
          children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_6__.jsx)(Button, {
            title: t("Register now"),
            classContainer: "!w-fit !border-none px-12",
            link: "/login"
          })
        })]
      }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_6__.jsx)(ContactUs, {})]
    })
  });
}
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Services);

/***/ }),

/***/ "./resources/landing-page/src/assets/Branches.webp":
/*!*********************************************************!*\
  !*** ./resources/landing-page/src/assets/Branches.webp ***!
  \*********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ("/images/Branches.webp?f3d8c2969c75dc52b5d3e479d39da615");

/***/ }),

/***/ "./resources/landing-page/src/assets/driversApp.webp":
/*!***********************************************************!*\
  !*** ./resources/landing-page/src/assets/driversApp.webp ***!
  \***********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ("/images/driversApp.webp?5b2cd412de2418b75827cc6f3df45644");

/***/ }),

/***/ "./resources/landing-page/src/assets/receiveRequests.webp":
/*!****************************************************************!*\
  !*** ./resources/landing-page/src/assets/receiveRequests.webp ***!
  \****************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ("/images/receiveRequests.webp?539d14b387586cb5c904d99629ba26fb");

/***/ })

}]);