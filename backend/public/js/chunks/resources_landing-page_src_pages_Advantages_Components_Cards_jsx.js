"use strict";
(self["webpackChunkkhardl"] = self["webpackChunkkhardl"] || []).push([["resources_landing-page_src_pages_Advantages_Components_Cards_jsx"],{

/***/ "./resources/landing-page/src/pages/Advantages/Components/AdvantageCard.jsx":
/*!**********************************************************************************!*\
  !*** ./resources/landing-page/src/pages/Advantages/Components/AdvantageCard.jsx ***!
  \**********************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! react/jsx-runtime */ "./node_modules/react/jsx-runtime.js");
function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }
function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }
function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) arr2[i] = arr[i]; return arr2; }
function _iterableToArrayLimit(r, l) { var t = null == r ? null : "undefined" != typeof Symbol && r[Symbol.iterator] || r["@@iterator"]; if (null != t) { var e, n, i, u, a = [], f = !0, o = !1; try { if (i = (t = t.call(r)).next, 0 === l) { if (Object(t) !== t) return; f = !1; } else for (; !(f = (e = i.call(t)).done) && (a.push(e.value), a.length !== l); f = !0); } catch (r) { o = !0, n = r; } finally { try { if (!f && null != t["return"] && (u = t["return"](), Object(u) !== u)) return; } finally { if (o) throw n; } } return a; } }
function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }



var AdvantageCard = function AdvantageCard(_ref) {
  var number = _ref.number,
    AdvanageTitle = _ref.AdvanageTitle;
  var _useState = (0,react__WEBPACK_IMPORTED_MODULE_0__.useState)(false),
    _useState2 = _slicedToArray(_useState, 2),
    setIsHover = _useState2[1];
  var handleMouseEnter = function handleMouseEnter() {
    setIsHover(true);
  };
  var handleMouseLeave = function handleMouseLeave() {
    setIsHover(false);
  };
  return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("div", {
    onMouseEnter: handleMouseEnter,
    onMouseLeave: handleMouseLeave,
    className: "relative h-[200px] bg-[var(--third)] rounded-lg my-1 px-4 py-8 max-[600px]:py-12 shadow-md hover:translate-y-2 ease-in duration-200 flex flex-col items-center justify-center",
    children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("div", {
      className: " absolute bg-[var(--primary)] font-bold flex items-center justify-center w-12 h-12 rounded-full max-[640px]:right-[45%] max-[640px]:top-[-22px]  top-[-15px] border-2 border-[var(--third)] right-1 ",
      children: number <= 9 ? /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("div", {
        children: ["0", number]
      }) : /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("div", {
        children: number
      })
    }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("div", {
      className: "text-center flex flex-col items-center justify-center gap-3",
      children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("h2", {
        className: "font-bold",
        children: AdvanageTitle
      })
    })]
  });
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (AdvantageCard);

/***/ }),

/***/ "./resources/landing-page/src/pages/Advantages/Components/Cards.jsx":
/*!**************************************************************************!*\
  !*** ./resources/landing-page/src/pages/Advantages/Components/Cards.jsx ***!
  \**************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _AdvantageCard__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./AdvantageCard */ "./resources/landing-page/src/pages/Advantages/Components/AdvantageCard.jsx");
/* harmony import */ var react_i18next__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! react-i18next */ "./node_modules/react-i18next/dist/es/index.js");
/* harmony import */ var _components_Button__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../components/Button */ "./resources/landing-page/src/components/Button.jsx");
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! react/jsx-runtime */ "./node_modules/react/jsx-runtime.js");
function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }
function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }
function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) arr2[i] = arr[i]; return arr2; }
function _iterableToArrayLimit(r, l) { var t = null == r ? null : "undefined" != typeof Symbol && r[Symbol.iterator] || r["@@iterator"]; if (null != t) { var e, n, i, u, a = [], f = !0, o = !1; try { if (i = (t = t.call(r)).next, 0 === l) { if (Object(t) !== t) return; f = !1; } else for (; !(f = (e = i.call(t)).done) && (a.push(e.value), a.length !== l); f = !0); } catch (r) { o = !0, n = r; } finally { try { if (!f && null != t["return"] && (u = t["return"](), Object(u) !== u)) return; } finally { if (o) throw n; } } return a; } }
function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }






function Cards() {
  var _useTranslation = (0,react_i18next__WEBPACK_IMPORTED_MODULE_2__.useTranslation)(),
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
  var Advanages = [{
    Advanage: "".concat(t("Advanage 1"))
  }, {
    Advanage: "".concat(t("Advanage 2"))
  }, {
    Advanage: "".concat(t("Advanage 3"))
  }, {
    Advanage: "".concat(t("Advanage 4"))
  }, {
    Advanage: "".concat(t("Advanage 5"))
  }, {
    Advanage: "".concat(t("Advanage 6"))
  }, {
    Advanage: "".concat(t("Advanage 7"))
  }, {
    Advanage: "".concat(t("Advanage 8"))
  }, {
    Advanage: "".concat(t("Advanage 9"))
  }, {
    Advanage: "".concat(t("Advanage 10"))
  }, {
    Advanage: "".concat(t("Advanage 11"))
  }, {
    Advanage: "".concat(t("Advanage 12"))
  }, {
    Advanage: "".concat(t("Advanage 13"))
  }, {
    Advanage: "".concat(t("Advanage 14"))
  }, {
    Advanage: "".concat(t("Advanage 15"))
  }, {
    Advanage: "".concat(t("Advanage 16"))
  }, {
    Advanage: "".concat(t("Advanage 17"))
  }, {
    Advanage: "".concat(t("Advanage 18"))
  }, {
    Advanage: "".concat(t("Advanage 19"))
  }, {
    Advanage: "".concat(t("Advanage 20"))
  }, {
    Advanage: "".concat(t("Advanage 21"))
  }, {
    Advanage: "".concat(t("Advanage 22"))
  }, {
    Advanage: "".concat(t("Advanage 23"))
  }];
  return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsxs)("div", {
    className: "mx-[160px] max-[1250px]:mx-[20px]",
    children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)("div", {
      className: "grid max-sm:grid-cols-1 max-lg:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-10 mx-4 mt-8 mb-[50px]",
      children: Advanages.slice(0, Visible).map(function (advanage, index) {
        return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)("div", {
          children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)(_AdvantageCard__WEBPACK_IMPORTED_MODULE_1__["default"], {
            number: index + 1,
            AdvanageTitle: advanage.Advanage
          })
        }, index);
      })
    }), Advanages.slice(0, Visible).length === Advanages.length ? /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)("div", {}) : /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)("div", {
      className: "flex flex-col items-center justify-center",
      children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)(_components_Button__WEBPACK_IMPORTED_MODULE_3__["default"], {
        title: t("More"),
        classContainer: "!border-none !px-12",
        onClick: showMoreItems
      })
    })]
  });
}
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Cards);

/***/ })

}]);