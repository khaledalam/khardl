"use strict";
(self["webpackChunkkhardl"] = self["webpackChunkkhardl"] || []).push([["resources_landing-page_src_pages_Advantages_Advantages_jsx"],{

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

/***/ "./resources/landing-page/src/pages/Advantages/Advantages.jsx":
/*!********************************************************************!*\
  !*** ./resources/landing-page/src/pages/Advantages/Advantages.jsx ***!
  \********************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var react_i18next__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! react-i18next */ "./node_modules/react-i18next/dist/es/index.js");
/* harmony import */ var _components_Button__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../components/Button */ "./resources/landing-page/src/components/Button.jsx");
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! react/jsx-runtime */ "./node_modules/react/jsx-runtime.js");
function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }
function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }
function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) arr2[i] = arr[i]; return arr2; }
function _iterableToArrayLimit(r, l) { var t = null == r ? null : "undefined" != typeof Symbol && r[Symbol.iterator] || r["@@iterator"]; if (null != t) { var e, n, i, u, a = [], f = !0, o = !1; try { if (i = (t = t.call(r)).next, 0 === l) { if (Object(t) !== t) return; f = !1; } else for (; !(f = (e = i.call(t)).done) && (a.push(e.value), a.length !== l); f = !0); } catch (r) { o = !0, n = r; } finally { try { if (!f && null != t["return"] && (u = t["return"](), Object(u) !== u)) return; } finally { if (o) throw n; } } return a; } }
function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }





var HeaderSection = /*#__PURE__*/(0,react__WEBPACK_IMPORTED_MODULE_0__.lazy)(function () {
  return __webpack_require__.e(/*! import() */ "resources_landing-page_src_components_HeaderSection_jsx").then(__webpack_require__.bind(__webpack_require__, /*! ../../components/HeaderSection */ "./resources/landing-page/src/components/HeaderSection.jsx"));
});
var MainText = /*#__PURE__*/(0,react__WEBPACK_IMPORTED_MODULE_0__.lazy)(function () {
  return __webpack_require__.e(/*! import() */ "resources_landing-page_src_components_MainText_jsx").then(__webpack_require__.bind(__webpack_require__, /*! ../../components/MainText */ "./resources/landing-page/src/components/MainText.jsx"));
});
var Cards = /*#__PURE__*/(0,react__WEBPACK_IMPORTED_MODULE_0__.lazy)(function () {
  return __webpack_require__.e(/*! import() */ "resources_landing-page_src_pages_Advantages_Components_Cards_jsx").then(__webpack_require__.bind(__webpack_require__, /*! ./Components/Cards */ "./resources/landing-page/src/pages/Advantages/Components/Cards.jsx"));
});
var ContactUs = /*#__PURE__*/(0,react__WEBPACK_IMPORTED_MODULE_0__.lazy)(function () {
  return __webpack_require__.e(/*! import() */ "resources_landing-page_src_components_ContactUsSection_ContactUs_jsx").then(__webpack_require__.bind(__webpack_require__, /*! ../../components/ContactUsSection/ContactUs */ "./resources/landing-page/src/components/ContactUsSection/ContactUs.jsx"));
});
var DeliveryAreaCard = /*#__PURE__*/(0,react__WEBPACK_IMPORTED_MODULE_0__.lazy)(function () {
  return __webpack_require__.e(/*! import() */ "resources_landing-page_src_pages_Advantages_Components_DeliveryAreaCard_jsx").then(__webpack_require__.bind(__webpack_require__, /*! ./Components/DeliveryAreaCard */ "./resources/landing-page/src/pages/Advantages/Components/DeliveryAreaCard.jsx"));
});
var Loading = /*#__PURE__*/(0,react__WEBPACK_IMPORTED_MODULE_0__.lazy)(function () {
  return __webpack_require__.e(/*! import() */ "resources_landing-page_src_pages_Loading_jsx").then(__webpack_require__.bind(__webpack_require__, /*! ../Loading */ "./resources/landing-page/src/pages/Loading.jsx"));
});
function Advantages() {
  var _useTranslation = (0,react_i18next__WEBPACK_IMPORTED_MODULE_1__.useTranslation)(),
    t = _useTranslation.t;
  var _useState = (0,react__WEBPACK_IMPORTED_MODULE_0__.useState)(10),
    _useState2 = _slicedToArray(_useState, 2),
    Visible = _useState2[0],
    setVisible = _useState2[1];
  var showMoreItems = function showMoreItems() {
    setVisible(function (prevValue) {
      return prevValue + 5;
    });
  };
  var DeliveryAreas = [{
    Area: "".concat(t("Area 1"))
  }, {
    Area: "".concat(t("Area 2"))
  }, {
    Area: "".concat(t("Area 3"))
  }, {
    Area: "".concat(t("Area 4"))
  }, {
    Area: "".concat(t("Area 5"))
  }, {
    Area: "".concat(t("Area 6"))
  }, {
    Area: "".concat(t("Area 7"))
  }, {
    Area: "".concat(t("Area 8"))
  }, {
    Area: "".concat(t("Area 9"))
  }, {
    Area: "".concat(t("Area 10"))
  }, {
    Area: "".concat(t("Area 11"))
  }, {
    Area: "".concat(t("Area 12"))
  }, {
    Area: "".concat(t("Area 13"))
  }, {
    Area: "".concat(t("Area 14"))
  }, {
    Area: "".concat(t("Area 15"))
  }, {
    Area: "".concat(t("Area 16"))
  }, {
    Area: "".concat(t("Area 17"))
  }, {
    Area: "".concat(t("Area 18"))
  }, {
    Area: "".concat(t("Area 19"))
  }, {
    Area: "".concat(t("Area 20"))
  }, {
    Area: "".concat(t("Area 21"))
  }, {
    Area: "".concat(t("Area 22"))
  }, {
    Area: "".concat(t("Area 23"))
  }, {
    Area: "".concat(t("Area 24"))
  }, {
    Area: "".concat(t("Area 25"))
  }, {
    Area: "".concat(t("Area 26"))
  }, {
    Area: "".concat(t("Area 27"))
  }];
  return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)(react__WEBPACK_IMPORTED_MODULE_0__.Suspense, {
    fallback: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)(Loading, {}),
    children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsxs)("div", {
      className: "pt-[80px]",
      children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("div", {
        className: "p-[30px]  pt-[60px] max-md:px-[5px] max-md:py-[40px] ",
        children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)(HeaderSection, {
          title: t("Advantages"),
          details: "".concat(t("Home"), " / ").concat(t("Advantages"))
        })
      }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("div", {
        className: "mt-6",
        children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)(MainText, {
          SubTitle: t("features of Khardl")
        })
      }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("div", {
        className: "p-[30px]",
        children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)(Cards, {})
      }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsxs)("div", {
        className: "mt-6",
        children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)(MainText, {
          Title: t("Geographical coverage areas"),
          SubTitle: t("Default Text")
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsxs)("div", {
          className: "mx-[160px] max-[1250px]:mx-[20px]",
          children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("div", {
            className: "grid max-sm:grid-cols-1 max-lg:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 items-center justify-center gap-10 mx-4 mt-8 mb-[50px]",
            children: DeliveryAreas.slice(0, Visible).map(function (area, index) {
              return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("div", {
                children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)(DeliveryAreaCard, {
                  AreaName: area.Area
                })
              }, index);
            })
          }), DeliveryAreas.slice(0, Visible).length === DeliveryAreas.length ? /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("div", {}) : /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("div", {
            className: "flex flex-col items-center justify-center",
            children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)(_components_Button__WEBPACK_IMPORTED_MODULE_2__["default"], {
              title: t("More"),
              classContainer: "!border-none !px-12",
              onClick: showMoreItems
            })
          })]
        })]
      }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)(ContactUs, {})]
    })
  });
}
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Advantages);

/***/ })

}]);