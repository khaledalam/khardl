(self["webpackChunkkhardl"] = self["webpackChunkkhardl"] || []).push([["resources_landing-page_src_components_Clients_Clients_jsx"],{

/***/ "./resources/landing-page/src/components/Clients/Card.jsx":
/*!****************************************************************!*\
  !*** ./resources/landing-page/src/components/Clients/Card.jsx ***!
  \****************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
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



var Card = function Card(_ref) {
  var ClientImage = _ref.ClientImage,
    ClientLink = _ref.ClientLink;
  var _useState = (0,react__WEBPACK_IMPORTED_MODULE_0__.useState)(false),
    _useState2 = _slicedToArray(_useState, 2),
    setIsHover = _useState2[1];
  var handleMouseEnter = function handleMouseEnter() {
    setIsHover(true);
  };
  var handleMouseLeave = function handleMouseLeave() {
    setIsHover(false);
  };
  return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("div", {
    onMouseEnter: handleMouseEnter,
    onMouseLeave: handleMouseLeave,
    className: "bg-white rounded-lg shadow-[0_-1px_8px_rgba(0,0,0,0.09)] hover:translate-y-2 ease-in duration-200 flex flex-col items-center justify-center",
    children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("a", {
      href: ClientLink,
      children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("div", {
        className: "flex flex-col items-center p-4 px-6",
        children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("img", {
          loading: "lazy",
          className: "mb-2 w-[100%] h-auto",
          src: ClientImage,
          alt: "Bonnieimage"
        })
      })
    })
  });
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Card);

/***/ }),

/***/ "./resources/landing-page/src/components/Clients/Clients.jsx":
/*!*******************************************************************!*\
  !*** ./resources/landing-page/src/components/Clients/Clients.jsx ***!
  \*******************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _assets_ClientSection_webp__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../assets/ClientSection.webp */ "./resources/landing-page/src/assets/ClientSection.webp");
/* harmony import */ var react_multi_carousel_lib_styles_css__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! react-multi-carousel/lib/styles.css */ "./node_modules/react-multi-carousel/lib/styles.css");
/* harmony import */ var react_multi_carousel__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! react-multi-carousel */ "./node_modules/react-multi-carousel/index.js");
/* harmony import */ var _data_data__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../../data/data */ "./resources/landing-page/src/data/data.jsx");
/* harmony import */ var _Card__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./Card */ "./resources/landing-page/src/components/Clients/Card.jsx");
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! react/jsx-runtime */ "./node_modules/react/jsx-runtime.js");







var Clients = function Clients() {
  /* 
  const [clients, setClients] = useState([]);
   /////////////////////////////////////////////////////////////////////////////////////
  // API GET REQUEST 
  const fetchData = async () => {
    try {
      const response = await fetch('https://http://127.0.0.1:8000/api/clients');
      const data = await response.json();
      setClients(data.data);
    } catch (error) {
      console.error('Error fetching data:', error);
    }
  };
   useEffect(() => {
    fetchData();
  }, []);
  ///////////////////////////////////////////////////////////////////////////////////// 
  */
  var responsive = {
    superLargeDesktop: {
      breakpoint: {
        max: 4000,
        min: 1024
      },
      items: 4,
      slidesToScroll: 1
    },
    LargeDesktop: {
      breakpoint: {
        max: 1245,
        min: 1024
      },
      items: 3,
      slidesToScroll: 1
    },
    desktop: {
      breakpoint: {
        max: 1024,
        min: 700
      },
      items: 2
    },
    tablet: {
      breakpoint: {
        max: 700,
        min: 640
      },
      items: 1
    },
    mobile: {
      breakpoint: {
        max: 640,
        min: 350
      },
      items: 1
    },
    smallMobile: {
      breakpoint: {
        max: 350,
        min: 0
      },
      items: 1,
      slidesToScroll: 1
    }
  };
  return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_6__.jsx)("div", {
    className: "text-center",
    style: {
      backgroundImage: "url(".concat(_assets_ClientSection_webp__WEBPACK_IMPORTED_MODULE_1__["default"], ")"),
      backgroundSize: "cover"
    },
    children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_6__.jsx)("div", {
      className: "my-14 py-6",
      children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_6__.jsx)(react_multi_carousel__WEBPACK_IMPORTED_MODULE_3__["default"], {
        responsive: responsive,
        infinite: true,
        arrows: true,
        className: "!mx-0 !px-0",
        containerClass: "w-[98vw] !mx-0 !px-0",
        autoPlay: true,
        autoPlaySpeed: 3000,
        itemClass: "px-3 cursor-grab",
        children: _data_data__WEBPACK_IMPORTED_MODULE_4__.clients.slice(0, 8).map(function (client, index) {
          return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_6__.jsx)(_Card__WEBPACK_IMPORTED_MODULE_5__["default"], {
            ClientImage: client.client_image,
            ClientLink: client.client_link
          }, index);
        })
      })
    })
  });
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Clients);

/***/ }),

/***/ "./resources/landing-page/src/data/data.jsx":
/*!**************************************************!*\
  !*** ./resources/landing-page/src/data/data.jsx ***!
  \**************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   clients: () => (/* binding */ clients)
/* harmony export */ });
/* harmony import */ var _assets_ClientLogo1_webp__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../assets/ClientLogo1.webp */ "./resources/landing-page/src/assets/ClientLogo1.webp");
/* harmony import */ var _assets_ClientLogo2_webp__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../assets/ClientLogo2.webp */ "./resources/landing-page/src/assets/ClientLogo2.webp");
/* harmony import */ var _assets_ClientLogo3_webp__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../assets/ClientLogo3.webp */ "./resources/landing-page/src/assets/ClientLogo3.webp");



var clients = [{
  client_id: 1,
  client_image: _assets_ClientLogo1_webp__WEBPACK_IMPORTED_MODULE_0__["default"],
  client_link: ""
}, {
  client_id: 2,
  client_image: _assets_ClientLogo2_webp__WEBPACK_IMPORTED_MODULE_1__["default"],
  client_link: ""
}, {
  client_id: 3,
  client_image: _assets_ClientLogo3_webp__WEBPACK_IMPORTED_MODULE_2__["default"],
  client_link: ""
}, {
  client_id: 4,
  client_image: _assets_ClientLogo1_webp__WEBPACK_IMPORTED_MODULE_0__["default"],
  client_link: ""
}, {
  client_id: 5,
  client_image: _assets_ClientLogo2_webp__WEBPACK_IMPORTED_MODULE_1__["default"],
  client_link: ""
}, {
  client_id: 6,
  client_image: _assets_ClientLogo3_webp__WEBPACK_IMPORTED_MODULE_2__["default"],
  client_link: ""
}, {
  client_id: 7,
  client_image: _assets_ClientLogo1_webp__WEBPACK_IMPORTED_MODULE_0__["default"],
  client_link: ""
}, {
  client_id: 8,
  client_image: _assets_ClientLogo2_webp__WEBPACK_IMPORTED_MODULE_1__["default"],
  client_link: ""
}, {
  client_id: 9,
  client_image: _assets_ClientLogo3_webp__WEBPACK_IMPORTED_MODULE_2__["default"],
  client_link: ""
}, {
  client_id: 10,
  client_image: _assets_ClientLogo2_webp__WEBPACK_IMPORTED_MODULE_1__["default"],
  client_link: ""
}, {
  client_id: 11,
  client_image: _assets_ClientLogo3_webp__WEBPACK_IMPORTED_MODULE_2__["default"],
  client_link: ""
}, {
  client_id: 12,
  client_image: _assets_ClientLogo3_webp__WEBPACK_IMPORTED_MODULE_2__["default"],
  client_link: ""
}, {
  client_id: 13,
  client_image: _assets_ClientLogo3_webp__WEBPACK_IMPORTED_MODULE_2__["default"],
  client_link: ""
}, {
  client_id: 14,
  client_image: _assets_ClientLogo3_webp__WEBPACK_IMPORTED_MODULE_2__["default"],
  client_link: ""
}, {
  client_id: 15,
  client_image: _assets_ClientLogo3_webp__WEBPACK_IMPORTED_MODULE_2__["default"],
  client_link: ""
}, {
  client_id: 16,
  client_image: _assets_ClientLogo3_webp__WEBPACK_IMPORTED_MODULE_2__["default"],
  client_link: ""
}];

/***/ }),

/***/ "./resources/landing-page/src/assets/ClientLogo1.webp":
/*!************************************************************!*\
  !*** ./resources/landing-page/src/assets/ClientLogo1.webp ***!
  \************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ("/images/ClientLogo1.webp?080532ec52d66a078a01e2cb45a56619");

/***/ }),

/***/ "./resources/landing-page/src/assets/ClientLogo2.webp":
/*!************************************************************!*\
  !*** ./resources/landing-page/src/assets/ClientLogo2.webp ***!
  \************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ("/images/ClientLogo2.webp?d8774362b6866c770c0b9576b5a9997a");

/***/ }),

/***/ "./resources/landing-page/src/assets/ClientLogo3.webp":
/*!************************************************************!*\
  !*** ./resources/landing-page/src/assets/ClientLogo3.webp ***!
  \************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ("/images/ClientLogo3.webp?643e50f2c48953a95e7fbb011ae5471b");

/***/ }),

/***/ "./resources/landing-page/src/assets/ClientSection.webp":
/*!**************************************************************!*\
  !*** ./resources/landing-page/src/assets/ClientSection.webp ***!
  \**************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ("/images/ClientSection.webp?46fce287b4a6bf2a7077687f48b780f7");

/***/ }),

/***/ "./node_modules/react-multi-carousel/lib/revicons.eot":
/*!************************************************************!*\
  !*** ./node_modules/react-multi-carousel/lib/revicons.eot ***!
  \************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ("/fonts/vendor/react-multi-carousel/lib/revicons.eot?a77de540a38981833f9e31bd4c365cc6");

/***/ }),

/***/ "./node_modules/react-multi-carousel/lib/revicons.ttf":
/*!************************************************************!*\
  !*** ./node_modules/react-multi-carousel/lib/revicons.ttf ***!
  \************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ("/fonts/vendor/react-multi-carousel/lib/revicons.ttf?57fd05d4ae650374c8deeff7c4aae380");

/***/ }),

/***/ "./node_modules/react-multi-carousel/lib/revicons.woff":
/*!*************************************************************!*\
  !*** ./node_modules/react-multi-carousel/lib/revicons.woff ***!
  \*************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ("/fonts/vendor/react-multi-carousel/lib/revicons.woff?e8746a624ed098489406e6113d185258");

/***/ }),

/***/ "./node_modules/laravel-mix/node_modules/css-loader/dist/cjs.js??ruleSet[1].rules[7].oneOf[1].use[1]!./node_modules/postcss-loader/dist/cjs.js??ruleSet[1].rules[7].oneOf[1].use[2]!./node_modules/react-multi-carousel/lib/styles.css":
/*!*********************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/laravel-mix/node_modules/css-loader/dist/cjs.js??ruleSet[1].rules[7].oneOf[1].use[1]!./node_modules/postcss-loader/dist/cjs.js??ruleSet[1].rules[7].oneOf[1].use[2]!./node_modules/react-multi-carousel/lib/styles.css ***!
  \*********************************************************************************************************************************************************************************************************************************************/
/***/ ((module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _laravel_mix_node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../laravel-mix/node_modules/css-loader/dist/runtime/api.js */ "./node_modules/laravel-mix/node_modules/css-loader/dist/runtime/api.js");
/* harmony import */ var _laravel_mix_node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_laravel_mix_node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _laravel_mix_node_modules_css_loader_dist_runtime_getUrl_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../laravel-mix/node_modules/css-loader/dist/runtime/getUrl.js */ "./node_modules/laravel-mix/node_modules/css-loader/dist/runtime/getUrl.js");
/* harmony import */ var _laravel_mix_node_modules_css_loader_dist_runtime_getUrl_js__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_laravel_mix_node_modules_css_loader_dist_runtime_getUrl_js__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _revicons_woff__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./revicons.woff */ "./node_modules/react-multi-carousel/lib/revicons.woff");
/* harmony import */ var _revicons_ttf__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./revicons.ttf */ "./node_modules/react-multi-carousel/lib/revicons.ttf");
/* harmony import */ var _revicons_eot__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./revicons.eot */ "./node_modules/react-multi-carousel/lib/revicons.eot");
// Imports





var ___CSS_LOADER_EXPORT___ = _laravel_mix_node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0___default()(function(i){return i[1]});
var ___CSS_LOADER_URL_REPLACEMENT_0___ = _laravel_mix_node_modules_css_loader_dist_runtime_getUrl_js__WEBPACK_IMPORTED_MODULE_1___default()(_revicons_woff__WEBPACK_IMPORTED_MODULE_2__["default"]);
var ___CSS_LOADER_URL_REPLACEMENT_1___ = _laravel_mix_node_modules_css_loader_dist_runtime_getUrl_js__WEBPACK_IMPORTED_MODULE_1___default()(_revicons_ttf__WEBPACK_IMPORTED_MODULE_3__["default"]);
var ___CSS_LOADER_URL_REPLACEMENT_2___ = _laravel_mix_node_modules_css_loader_dist_runtime_getUrl_js__WEBPACK_IMPORTED_MODULE_1___default()(_revicons_eot__WEBPACK_IMPORTED_MODULE_4__["default"]);
// Module
___CSS_LOADER_EXPORT___.push([module.id, "@font-face{font-family:\"revicons\";fallback:fallback;src:url(" + ___CSS_LOADER_URL_REPLACEMENT_0___ + ") format('woff'),url(" + ___CSS_LOADER_URL_REPLACEMENT_1___ + ") format('ttf'),url(" + ___CSS_LOADER_URL_REPLACEMENT_2___ + ") format('ttf')}.react-multi-carousel-list{display:flex;align-items:center;overflow:hidden;position:relative}.react-multi-carousel-track{list-style:none;padding:0;margin:0;display:flex;flex-direction:row;position:relative;transform-style:preserve-3d;backface-visibility:hidden;will-change:transform,transition}.react-multiple-carousel__arrow{position:absolute;outline:0;transition:all .5s;border-radius:35px;z-index:1000;border:0;background:rgba(0,0,0,0.5);min-width:43px;min-height:43px;opacity:1;cursor:pointer}.react-multiple-carousel__arrow:hover{background:rgba(0,0,0,0.8)}.react-multiple-carousel__arrow::before{font-size:20px;color:#fff;display:block;font-family:revicons;text-align:center;z-index:2;position:relative}.react-multiple-carousel__arrow:disabled{cursor:default;background:rgba(0,0,0,0.5)}.react-multiple-carousel__arrow--left{left:calc(4% + 1px)}.react-multiple-carousel__arrow--left::before{content:\"\\e824\"}.react-multiple-carousel__arrow--right{right:calc(4% + 1px)}.react-multiple-carousel__arrow--right::before{content:\"\\e825\"}.react-multi-carousel-dot-list{position:absolute;bottom:0;display:flex;left:0;right:0;justify-content:center;margin:auto;padding:0;margin:0;list-style:none;text-align:center}.react-multi-carousel-dot button{display:inline-block;width:12px;height:12px;border-radius:50%;opacity:1;padding:5px 5px 5px 5px;box-shadow:none;transition:background .5s;border-width:2px;border-style:solid;border-color:grey;padding:0;margin:0;margin-right:6px;outline:0;cursor:pointer}.react-multi-carousel-dot button:hover:active{background:#080808}.react-multi-carousel-dot--active button{background:#080808}.react-multi-carousel-item{transform-style:preserve-3d;backface-visibility:hidden}@media all and (-ms-high-contrast:none),(-ms-high-contrast:active){.react-multi-carousel-item{flex-shrink:0 !important}.react-multi-carousel-track{overflow:visible !important}}[dir='rtl'].react-multi-carousel-list{direction:rtl}.rtl.react-multiple-carousel__arrow--right{right:auto;left:calc(4% + 1px)}.rtl.react-multiple-carousel__arrow--right::before{content:\"\\e824\"}.rtl.react-multiple-carousel__arrow--left{left:auto;right:calc(4% + 1px)}.rtl.react-multiple-carousel__arrow--left::before{content:\"\\e825\"}", ""]);
// Exports
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (___CSS_LOADER_EXPORT___);


/***/ }),

/***/ "./node_modules/laravel-mix/node_modules/css-loader/dist/runtime/getUrl.js":
/*!*********************************************************************************!*\
  !*** ./node_modules/laravel-mix/node_modules/css-loader/dist/runtime/getUrl.js ***!
  \*********************************************************************************/
/***/ ((module) => {

"use strict";


module.exports = function (url, options) {
  if (!options) {
    // eslint-disable-next-line no-param-reassign
    options = {};
  } // eslint-disable-next-line no-underscore-dangle, no-param-reassign


  url = url && url.__esModule ? url.default : url;

  if (typeof url !== "string") {
    return url;
  } // If url is already wrapped in quotes, remove them


  if (/^['"].*['"]$/.test(url)) {
    // eslint-disable-next-line no-param-reassign
    url = url.slice(1, -1);
  }

  if (options.hash) {
    // eslint-disable-next-line no-param-reassign
    url += options.hash;
  } // Should url be wrapped?
  // See https://drafts.csswg.org/css-values-3/#urls


  if (/["'() \t\n]/.test(url) || options.needQuotes) {
    return "\"".concat(url.replace(/"/g, '\\"').replace(/\n/g, "\\n"), "\"");
  }

  return url;
};

/***/ }),

/***/ "./node_modules/react-multi-carousel/lib/styles.css":
/*!**********************************************************!*\
  !*** ./node_modules/react-multi-carousel/lib/styles.css ***!
  \**********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _laravel_mix_node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! !../../laravel-mix/node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js */ "./node_modules/laravel-mix/node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js");
/* harmony import */ var _laravel_mix_node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_laravel_mix_node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _laravel_mix_node_modules_css_loader_dist_cjs_js_ruleSet_1_rules_7_oneOf_1_use_1_postcss_loader_dist_cjs_js_ruleSet_1_rules_7_oneOf_1_use_2_styles_css__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! !!../../laravel-mix/node_modules/css-loader/dist/cjs.js??ruleSet[1].rules[7].oneOf[1].use[1]!../../postcss-loader/dist/cjs.js??ruleSet[1].rules[7].oneOf[1].use[2]!./styles.css */ "./node_modules/laravel-mix/node_modules/css-loader/dist/cjs.js??ruleSet[1].rules[7].oneOf[1].use[1]!./node_modules/postcss-loader/dist/cjs.js??ruleSet[1].rules[7].oneOf[1].use[2]!./node_modules/react-multi-carousel/lib/styles.css");

            

var options = {};

options.insert = "head";
options.singleton = false;

var update = _laravel_mix_node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0___default()(_laravel_mix_node_modules_css_loader_dist_cjs_js_ruleSet_1_rules_7_oneOf_1_use_1_postcss_loader_dist_cjs_js_ruleSet_1_rules_7_oneOf_1_use_2_styles_css__WEBPACK_IMPORTED_MODULE_1__["default"], options);



/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_laravel_mix_node_modules_css_loader_dist_cjs_js_ruleSet_1_rules_7_oneOf_1_use_1_postcss_loader_dist_cjs_js_ruleSet_1_rules_7_oneOf_1_use_2_styles_css__WEBPACK_IMPORTED_MODULE_1__["default"].locals || {});

/***/ }),

/***/ "./node_modules/react-multi-carousel/index.js":
/*!****************************************************!*\
  !*** ./node_modules/react-multi-carousel/index.js ***!
  \****************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

module.exports = __webpack_require__(/*! ./lib */ "./node_modules/react-multi-carousel/lib/index.js");


/***/ }),

/***/ "./node_modules/react-multi-carousel/lib/Arrows.js":
/*!*********************************************************!*\
  !*** ./node_modules/react-multi-carousel/lib/Arrows.js ***!
  \*********************************************************/
/***/ ((__unused_webpack_module, exports, __webpack_require__) => {

"use strict";
Object.defineProperty(exports, "__esModule", ({value:!0}));var React=__webpack_require__(/*! react */ "./node_modules/react/index.js"),LeftArrow=function(_a){var customLeftArrow=_a.customLeftArrow,getState=_a.getState,previous=_a.previous,disabled=_a.disabled,rtl=_a.rtl;if(customLeftArrow)return React.cloneElement(customLeftArrow,{onClick:function(){return previous()},carouselState:getState(),disabled:disabled,rtl:rtl});var rtlClassName=rtl?"rtl":"";return React.createElement("button",{"aria-label":"Go to previous slide",className:"react-multiple-carousel__arrow react-multiple-carousel__arrow--left "+rtlClassName,onClick:function(){return previous()},type:"button",disabled:disabled})};exports.LeftArrow=LeftArrow;var RightArrow=function(_a){var customRightArrow=_a.customRightArrow,getState=_a.getState,next=_a.next,disabled=_a.disabled,rtl=_a.rtl;if(customRightArrow)return React.cloneElement(customRightArrow,{onClick:function(){return next()},carouselState:getState(),disabled:disabled,rtl:rtl});var rtlClassName=rtl?"rtl":"";return React.createElement("button",{"aria-label":"Go to next slide",className:"react-multiple-carousel__arrow react-multiple-carousel__arrow--right "+rtlClassName,onClick:function(){return next()},type:"button",disabled:disabled})};exports.RightArrow=RightArrow;

/***/ }),

/***/ "./node_modules/react-multi-carousel/lib/Carousel.js":
/*!***********************************************************!*\
  !*** ./node_modules/react-multi-carousel/lib/Carousel.js ***!
  \***********************************************************/
/***/ (function(__unused_webpack_module, exports, __webpack_require__) {

"use strict";
var __extends=this&&this.__extends||function(){var extendStatics=function(d,b){return(extendStatics=Object.setPrototypeOf||{__proto__:[]}instanceof Array&&function(d,b){d.__proto__=b}||function(d,b){for(var p in b)b.hasOwnProperty(p)&&(d[p]=b[p])})(d,b)};return function(d,b){function __(){this.constructor=d}extendStatics(d,b),d.prototype=null===b?Object.create(b):(__.prototype=b.prototype,new __)}}();Object.defineProperty(exports, "__esModule", ({value:!0}));var React=__webpack_require__(/*! react */ "./node_modules/react/index.js"),utils_1=__webpack_require__(/*! ./utils */ "./node_modules/react-multi-carousel/lib/utils/index.js"),types_1=__webpack_require__(/*! ./types */ "./node_modules/react-multi-carousel/lib/types.js"),Dots_1=__webpack_require__(/*! ./Dots */ "./node_modules/react-multi-carousel/lib/Dots.js"),Arrows_1=__webpack_require__(/*! ./Arrows */ "./node_modules/react-multi-carousel/lib/Arrows.js"),CarouselItems_1=__webpack_require__(/*! ./CarouselItems */ "./node_modules/react-multi-carousel/lib/CarouselItems.js"),common_1=__webpack_require__(/*! ./utils/common */ "./node_modules/react-multi-carousel/lib/utils/common.js"),defaultTransitionDuration=400,defaultTransition="transform 400ms ease-in-out",Carousel=function(_super){function Carousel(props){var _this=_super.call(this,props)||this;return _this.containerRef=React.createRef(),_this.listRef=React.createRef(),_this.state={itemWidth:0,slidesToShow:0,currentSlide:0,totalItems:React.Children.count(props.children),deviceType:"",domLoaded:!1,transform:0,containerWidth:0},_this.onResize=_this.onResize.bind(_this),_this.handleDown=_this.handleDown.bind(_this),_this.handleMove=_this.handleMove.bind(_this),_this.handleOut=_this.handleOut.bind(_this),_this.onKeyUp=_this.onKeyUp.bind(_this),_this.handleEnter=_this.handleEnter.bind(_this),_this.setIsInThrottle=_this.setIsInThrottle.bind(_this),_this.next=utils_1.throttle(_this.next.bind(_this),props.transitionDuration||defaultTransitionDuration,_this.setIsInThrottle),_this.previous=utils_1.throttle(_this.previous.bind(_this),props.transitionDuration||defaultTransitionDuration,_this.setIsInThrottle),_this.goToSlide=utils_1.throttle(_this.goToSlide.bind(_this),props.transitionDuration||defaultTransitionDuration,_this.setIsInThrottle),_this.onMove=!1,_this.initialX=0,_this.lastX=0,_this.isAnimationAllowed=!1,_this.direction="",_this.initialY=0,_this.isInThrottle=!1,_this.transformPlaceHolder=0,_this}return __extends(Carousel,_super),Carousel.prototype.resetTotalItems=function(){var _this=this,totalItems=React.Children.count(this.props.children),currentSlide=utils_1.notEnoughChildren(this.state)?0:Math.max(0,Math.min(this.state.currentSlide,totalItems));this.setState({totalItems:totalItems,currentSlide:currentSlide},function(){_this.setContainerAndItemWidth(_this.state.slidesToShow,!0)})},Carousel.prototype.setIsInThrottle=function(isInThrottle){void 0===isInThrottle&&(isInThrottle=!1),this.isInThrottle=isInThrottle},Carousel.prototype.setTransformDirectly=function(position,withAnimation){var additionalTransfrom=this.props.additionalTransfrom;this.transformPlaceHolder=position;var currentTransform=common_1.getTransform(this.state,this.props,this.transformPlaceHolder);this.listRef&&this.listRef.current&&(this.setAnimationDirectly(withAnimation),this.listRef.current.style.transform="translate3d("+(currentTransform+additionalTransfrom)+"px,0,0)")},Carousel.prototype.setAnimationDirectly=function(animationAllowed){this.listRef&&this.listRef.current&&(this.listRef.current.style.transition=animationAllowed?this.props.customTransition||defaultTransition:"none")},Carousel.prototype.componentDidMount=function(){this.setState({domLoaded:!0}),this.setItemsToShow(),window.addEventListener("resize",this.onResize),this.onResize(!0),this.props.keyBoardControl&&window.addEventListener("keyup",this.onKeyUp),this.props.autoPlay&&(this.autoPlay=setInterval(this.next,this.props.autoPlaySpeed))},Carousel.prototype.setClones=function(slidesToShow,itemWidth,forResizing,resetCurrentSlide){var _this=this;void 0===resetCurrentSlide&&(resetCurrentSlide=!1),this.isAnimationAllowed=!1;var childrenArr=React.Children.toArray(this.props.children),initialSlide=utils_1.getInitialSlideInInfiniteMode(slidesToShow||this.state.slidesToShow,childrenArr),clones=utils_1.getClones(this.state.slidesToShow,childrenArr),currentSlide=childrenArr.length<this.state.slidesToShow?0:this.state.currentSlide;this.setState({totalItems:clones.length,currentSlide:forResizing&&!resetCurrentSlide?currentSlide:initialSlide},function(){_this.correctItemsPosition(itemWidth||_this.state.itemWidth)})},Carousel.prototype.setItemsToShow=function(shouldCorrectItemPosition,resetCurrentSlide){var _this=this,responsive=this.props.responsive;Object.keys(responsive).forEach(function(item){var _a=responsive[item],breakpoint=_a.breakpoint,items=_a.items,max=breakpoint.max,min=breakpoint.min,widths=[window.innerWidth];window.screen&&window.screen.width&&widths.push(window.screen.width);var screenWidth=Math.min.apply(Math,widths);min<=screenWidth&&screenWidth<=max&&(_this.setState({slidesToShow:items,deviceType:item}),_this.setContainerAndItemWidth(items,shouldCorrectItemPosition,resetCurrentSlide))})},Carousel.prototype.setContainerAndItemWidth=function(slidesToShow,shouldCorrectItemPosition,resetCurrentSlide){var _this=this;if(this.containerRef&&this.containerRef.current){var containerWidth=this.containerRef.current.offsetWidth,itemWidth_1=utils_1.getItemClientSideWidth(this.props,slidesToShow,containerWidth);this.setState({containerWidth:containerWidth,itemWidth:itemWidth_1},function(){_this.props.infinite&&_this.setClones(slidesToShow,itemWidth_1,shouldCorrectItemPosition,resetCurrentSlide)}),shouldCorrectItemPosition&&this.correctItemsPosition(itemWidth_1)}},Carousel.prototype.correctItemsPosition=function(itemWidth,isAnimationAllowed,setToDomDirectly){isAnimationAllowed&&(this.isAnimationAllowed=!0),!isAnimationAllowed&&this.isAnimationAllowed&&(this.isAnimationAllowed=!1);var nextTransform=this.state.totalItems<this.state.slidesToShow?0:-itemWidth*this.state.currentSlide;setToDomDirectly&&this.setTransformDirectly(nextTransform,!0),this.setState({transform:nextTransform})},Carousel.prototype.onResize=function(value){var shouldCorrectItemPosition;shouldCorrectItemPosition=!!this.props.infinite&&("boolean"!=typeof value||!value),this.setItemsToShow(shouldCorrectItemPosition)},Carousel.prototype.componentDidUpdate=function(_a,_b){var _this=this,keyBoardControl=_a.keyBoardControl,autoPlay=_a.autoPlay,children=_a.children,containerWidth=_b.containerWidth,domLoaded=_b.domLoaded,currentSlide=_b.currentSlide;if(this.containerRef&&this.containerRef.current&&this.containerRef.current.offsetWidth!==containerWidth&&(this.itemsToShowTimeout&&clearTimeout(this.itemsToShowTimeout),this.itemsToShowTimeout=setTimeout(function(){_this.setItemsToShow(!0)},this.props.transitionDuration||defaultTransitionDuration)),keyBoardControl&&!this.props.keyBoardControl&&window.removeEventListener("keyup",this.onKeyUp),!keyBoardControl&&this.props.keyBoardControl&&window.addEventListener("keyup",this.onKeyUp),autoPlay&&!this.props.autoPlay&&this.autoPlay&&(clearInterval(this.autoPlay),this.autoPlay=void 0),autoPlay||!this.props.autoPlay||this.autoPlay||(this.autoPlay=setInterval(this.next,this.props.autoPlaySpeed)),children.length!==this.props.children.length?Carousel.clonesTimeout=setTimeout(function(){_this.props.infinite?_this.setClones(_this.state.slidesToShow,_this.state.itemWidth,!0,!0):_this.resetTotalItems()},this.props.transitionDuration||defaultTransitionDuration):this.props.infinite&&this.state.currentSlide!==currentSlide&&this.correctClonesPosition({domLoaded:domLoaded}),this.transformPlaceHolder!==this.state.transform&&(this.transformPlaceHolder=this.state.transform),this.props.autoPlay&&this.props.rewind&&!this.props.infinite&&utils_1.isInRightEnd(this.state)){var rewindBuffer=this.props.transitionDuration||defaultTransitionDuration;Carousel.isInThrottleTimeout=setTimeout(function(){_this.setIsInThrottle(!1),_this.resetAutoplayInterval(),_this.goToSlide(0,void 0,!!_this.props.rewindWithAnimation)},rewindBuffer+this.props.autoPlaySpeed)}},Carousel.prototype.correctClonesPosition=function(_a){var _this=this,domLoaded=_a.domLoaded,childrenArr=React.Children.toArray(this.props.children),_b=utils_1.checkClonesPosition(this.state,childrenArr,this.props),isReachingTheEnd=_b.isReachingTheEnd,isReachingTheStart=_b.isReachingTheStart,nextSlide=_b.nextSlide,nextPosition=_b.nextPosition;this.state.domLoaded&&domLoaded&&(isReachingTheEnd||isReachingTheStart)&&(this.isAnimationAllowed=!1,Carousel.transformTimeout=setTimeout(function(){_this.setState({transform:nextPosition,currentSlide:nextSlide})},this.props.transitionDuration||defaultTransitionDuration))},Carousel.prototype.next=function(slidesHavePassed){var _this=this;void 0===slidesHavePassed&&(slidesHavePassed=0);var _a=this.props,afterChange=_a.afterChange,beforeChange=_a.beforeChange;if(!utils_1.notEnoughChildren(this.state)){var _b=utils_1.populateNextSlides(this.state,this.props,slidesHavePassed),nextSlides=_b.nextSlides,nextPosition=_b.nextPosition,previousSlide=this.state.currentSlide;void 0!==nextSlides&&void 0!==nextPosition&&("function"==typeof beforeChange&&beforeChange(nextSlides,this.getState()),this.isAnimationAllowed=!0,this.props.shouldResetAutoplay&&this.resetAutoplayInterval(),this.setState({transform:nextPosition,currentSlide:nextSlides},function(){"function"==typeof afterChange&&(Carousel.afterChangeTimeout=setTimeout(function(){afterChange(previousSlide,_this.getState())},_this.props.transitionDuration||defaultTransitionDuration))}))}},Carousel.prototype.previous=function(slidesHavePassed){var _this=this;void 0===slidesHavePassed&&(slidesHavePassed=0);var _a=this.props,afterChange=_a.afterChange,beforeChange=_a.beforeChange;if(!utils_1.notEnoughChildren(this.state)){var _b=utils_1.populatePreviousSlides(this.state,this.props,slidesHavePassed),nextSlides=_b.nextSlides,nextPosition=_b.nextPosition;if(void 0!==nextSlides&&void 0!==nextPosition){var previousSlide=this.state.currentSlide;"function"==typeof beforeChange&&beforeChange(nextSlides,this.getState()),this.isAnimationAllowed=!0,this.props.shouldResetAutoplay&&this.resetAutoplayInterval(),this.setState({transform:nextPosition,currentSlide:nextSlides},function(){"function"==typeof afterChange&&(Carousel.afterChangeTimeout2=setTimeout(function(){afterChange(previousSlide,_this.getState())},_this.props.transitionDuration||defaultTransitionDuration))})}}},Carousel.prototype.resetAutoplayInterval=function(){this.props.autoPlay&&(clearInterval(this.autoPlay),this.autoPlay=setInterval(this.next,this.props.autoPlaySpeed))},Carousel.prototype.componentWillUnmount=function(){window.removeEventListener("resize",this.onResize),this.props.keyBoardControl&&window.removeEventListener("keyup",this.onKeyUp),this.props.autoPlay&&this.autoPlay&&(clearInterval(this.autoPlay),this.autoPlay=void 0),this.itemsToShowTimeout&&clearTimeout(this.itemsToShowTimeout),Carousel.clonesTimeout&&clearTimeout(Carousel.clonesTimeout),Carousel.isInThrottleTimeout&&clearTimeout(Carousel.isInThrottleTimeout),Carousel.transformTimeout&&clearTimeout(Carousel.transformTimeout),Carousel.afterChangeTimeout&&clearTimeout(Carousel.afterChangeTimeout),Carousel.afterChangeTimeout2&&clearTimeout(Carousel.afterChangeTimeout2),Carousel.afterChangeTimeout3&&clearTimeout(Carousel.afterChangeTimeout3)},Carousel.prototype.resetMoveStatus=function(){this.onMove=!1,this.initialX=0,this.lastX=0,this.direction="",this.initialY=0},Carousel.prototype.getCords=function(_a){var clientX=_a.clientX,clientY=_a.clientY;return{clientX:common_1.parsePosition(this.props,clientX),clientY:common_1.parsePosition(this.props,clientY)}},Carousel.prototype.handleDown=function(e){if(!(!types_1.isMouseMoveEvent(e)&&!this.props.swipeable||types_1.isMouseMoveEvent(e)&&!this.props.draggable||this.isInThrottle)){var _a=this.getCords(types_1.isMouseMoveEvent(e)?e:e.touches[0]),clientX=_a.clientX,clientY=_a.clientY;this.onMove=!0,this.initialX=clientX,this.initialY=clientY,this.lastX=clientX,this.isAnimationAllowed=!1}},Carousel.prototype.handleMove=function(e){if(!(!types_1.isMouseMoveEvent(e)&&!this.props.swipeable||types_1.isMouseMoveEvent(e)&&!this.props.draggable||utils_1.notEnoughChildren(this.state))){var _a=this.getCords(types_1.isMouseMoveEvent(e)?e:e.touches[0]),clientX=_a.clientX,clientY=_a.clientY,diffX=this.initialX-clientX,diffY=this.initialY-clientY;if(this.onMove){if(!(Math.abs(diffX)>Math.abs(diffY)))return;var _b=utils_1.populateSlidesOnMouseTouchMove(this.state,this.props,this.initialX,this.lastX,clientX,this.transformPlaceHolder),direction=_b.direction,nextPosition=_b.nextPosition,canContinue=_b.canContinue;direction&&(this.direction=direction,canContinue&&void 0!==nextPosition&&this.setTransformDirectly(nextPosition)),this.lastX=clientX}}},Carousel.prototype.handleOut=function(e){this.props.autoPlay&&!this.autoPlay&&(this.autoPlay=setInterval(this.next,this.props.autoPlaySpeed));var shouldDisableOnMobile="touchend"===e.type&&!this.props.swipeable,shouldDisableOnDesktop=("mouseleave"===e.type||"mouseup"===e.type)&&!this.props.draggable;if(!shouldDisableOnMobile&&!shouldDisableOnDesktop&&this.onMove){if(this.setAnimationDirectly(!0),"right"===this.direction)if(this.initialX-this.lastX>=this.props.minimumTouchDrag){var slidesHavePassed=Math.round((this.initialX-this.lastX)/this.state.itemWidth);this.next(slidesHavePassed)}else this.correctItemsPosition(this.state.itemWidth,!0,!0);if("left"===this.direction)if(this.lastX-this.initialX>this.props.minimumTouchDrag){slidesHavePassed=Math.round((this.lastX-this.initialX)/this.state.itemWidth);this.previous(slidesHavePassed)}else this.correctItemsPosition(this.state.itemWidth,!0,!0);this.resetMoveStatus()}},Carousel.prototype.isInViewport=function(el){var _a=el.getBoundingClientRect(),_b=_a.top,top=void 0===_b?0:_b,_c=_a.left,left=void 0===_c?0:_c,_d=_a.bottom,bottom=void 0===_d?0:_d,_e=_a.right,right=void 0===_e?0:_e;return 0<=top&&0<=left&&bottom<=(window.innerHeight||document.documentElement.clientHeight)&&right<=(window.innerWidth||document.documentElement.clientWidth)},Carousel.prototype.isChildOfCarousel=function(el){return!!(el instanceof Element&&this.listRef&&this.listRef.current)&&this.listRef.current.contains(el)},Carousel.prototype.onKeyUp=function(e){var target=e.target;switch(e.keyCode){case 37:if(this.isChildOfCarousel(target))return this.previous();break;case 39:if(this.isChildOfCarousel(target))return this.next();break;case 9:if(this.isChildOfCarousel(target)&&target instanceof HTMLInputElement&&this.isInViewport(target))return this.next()}},Carousel.prototype.handleEnter=function(e){types_1.isMouseMoveEvent(e)&&this.autoPlay&&this.props.autoPlay&&this.props.pauseOnHover&&(clearInterval(this.autoPlay),this.autoPlay=void 0)},Carousel.prototype.goToSlide=function(slide,skipCallbacks,animationAllowed){var _this=this;if(void 0===animationAllowed&&(animationAllowed=!0),!this.isInThrottle){var itemWidth=this.state.itemWidth,_a=this.props,afterChange=_a.afterChange,beforeChange=_a.beforeChange,previousSlide=this.state.currentSlide;"function"!=typeof beforeChange||skipCallbacks&&("object"!=typeof skipCallbacks||skipCallbacks.skipBeforeChange)||beforeChange(slide,this.getState()),this.isAnimationAllowed=animationAllowed,this.props.shouldResetAutoplay&&this.resetAutoplayInterval(),this.setState({currentSlide:slide,transform:-itemWidth*slide},function(){_this.props.infinite&&_this.correctClonesPosition({domLoaded:!0}),"function"!=typeof afterChange||skipCallbacks&&("object"!=typeof skipCallbacks||skipCallbacks.skipAfterChange)||(Carousel.afterChangeTimeout3=setTimeout(function(){afterChange(previousSlide,_this.getState())},_this.props.transitionDuration||defaultTransitionDuration))})}},Carousel.prototype.getState=function(){return this.state},Carousel.prototype.renderLeftArrow=function(disbaled){var _this=this,_a=this.props,customLeftArrow=_a.customLeftArrow,rtl=_a.rtl;return React.createElement(Arrows_1.LeftArrow,{customLeftArrow:customLeftArrow,getState:function(){return _this.getState()},previous:this.previous,disabled:disbaled,rtl:rtl})},Carousel.prototype.renderRightArrow=function(disbaled){var _this=this,_a=this.props,customRightArrow=_a.customRightArrow,rtl=_a.rtl;return React.createElement(Arrows_1.RightArrow,{customRightArrow:customRightArrow,getState:function(){return _this.getState()},next:this.next,disabled:disbaled,rtl:rtl})},Carousel.prototype.renderButtonGroups=function(){var _this=this,customButtonGroup=this.props.customButtonGroup;return customButtonGroup?React.cloneElement(customButtonGroup,{previous:function(){return _this.previous()},next:function(){return _this.next()},goToSlide:function(slideIndex,skipCallbacks){return _this.goToSlide(slideIndex,skipCallbacks)},carouselState:this.getState()}):null},Carousel.prototype.renderDotsList=function(){var _this=this;return React.createElement(Dots_1.default,{state:this.state,props:this.props,goToSlide:this.goToSlide,getState:function(){return _this.getState()}})},Carousel.prototype.renderCarouselItems=function(){var clones=[];if(this.props.infinite){var childrenArr=React.Children.toArray(this.props.children);clones=utils_1.getClones(this.state.slidesToShow,childrenArr)}return React.createElement(CarouselItems_1.default,{clones:clones,goToSlide:this.goToSlide,state:this.state,notEnoughChildren:utils_1.notEnoughChildren(this.state),props:this.props})},Carousel.prototype.render=function(){var _a=this.props,deviceType=_a.deviceType,arrows=_a.arrows,renderArrowsWhenDisabled=_a.renderArrowsWhenDisabled,removeArrowOnDeviceType=_a.removeArrowOnDeviceType,infinite=_a.infinite,containerClass=_a.containerClass,sliderClass=_a.sliderClass,customTransition=_a.customTransition,additionalTransfrom=_a.additionalTransfrom,renderDotsOutside=_a.renderDotsOutside,renderButtonGroupOutside=_a.renderButtonGroupOutside,className=_a.className,rtl=_a.rtl; true&&utils_1.throwError(this.state,this.props);var _b=utils_1.getInitialState(this.state,this.props),shouldRenderOnSSR=_b.shouldRenderOnSSR,shouldRenderAtAll=_b.shouldRenderAtAll,isLeftEndReach=utils_1.isInLeftEnd(this.state),isRightEndReach=utils_1.isInRightEnd(this.state),shouldShowArrows=arrows&&!(removeArrowOnDeviceType&&(deviceType&&-1<removeArrowOnDeviceType.indexOf(deviceType)||this.state.deviceType&&-1<removeArrowOnDeviceType.indexOf(this.state.deviceType)))&&!utils_1.notEnoughChildren(this.state)&&shouldRenderAtAll,disableLeftArrow=!infinite&&isLeftEndReach,disableRightArrow=!infinite&&isRightEndReach,currentTransform=common_1.getTransform(this.state,this.props);return React.createElement(React.Fragment,null,React.createElement("div",{className:"react-multi-carousel-list "+containerClass+" "+className,dir:rtl?"rtl":"ltr",ref:this.containerRef},React.createElement("ul",{ref:this.listRef,className:"react-multi-carousel-track "+sliderClass,style:{transition:this.isAnimationAllowed?customTransition||defaultTransition:"none",overflow:shouldRenderOnSSR?"hidden":"unset",transform:"translate3d("+(currentTransform+additionalTransfrom)+"px,0,0)"},onMouseMove:this.handleMove,onMouseDown:this.handleDown,onMouseUp:this.handleOut,onMouseEnter:this.handleEnter,onMouseLeave:this.handleOut,onTouchStart:this.handleDown,onTouchMove:this.handleMove,onTouchEnd:this.handleOut},this.renderCarouselItems()),shouldShowArrows&&(!disableLeftArrow||renderArrowsWhenDisabled)&&this.renderLeftArrow(disableLeftArrow),shouldShowArrows&&(!disableRightArrow||renderArrowsWhenDisabled)&&this.renderRightArrow(disableRightArrow),shouldRenderAtAll&&!renderButtonGroupOutside&&this.renderButtonGroups(),shouldRenderAtAll&&!renderDotsOutside&&this.renderDotsList()),shouldRenderAtAll&&renderDotsOutside&&this.renderDotsList(),shouldRenderAtAll&&renderButtonGroupOutside&&this.renderButtonGroups())},Carousel.defaultProps={slidesToSlide:1,infinite:!1,draggable:!0,swipeable:!0,arrows:!0,renderArrowsWhenDisabled:!1,containerClass:"",sliderClass:"",itemClass:"",keyBoardControl:!0,autoPlaySpeed:3e3,showDots:!1,renderDotsOutside:!1,renderButtonGroupOutside:!1,minimumTouchDrag:80,className:"",dotListClass:"",focusOnSelect:!1,centerMode:!1,additionalTransfrom:0,pauseOnHover:!0,shouldResetAutoplay:!0,rewind:!1,rtl:!1,rewindWithAnimation:!1},Carousel}(React.Component);exports["default"]=Carousel;

/***/ }),

/***/ "./node_modules/react-multi-carousel/lib/CarouselItems.js":
/*!****************************************************************!*\
  !*** ./node_modules/react-multi-carousel/lib/CarouselItems.js ***!
  \****************************************************************/
/***/ ((__unused_webpack_module, exports, __webpack_require__) => {

"use strict";
Object.defineProperty(exports, "__esModule", ({value:!0}));var React=__webpack_require__(/*! react */ "./node_modules/react/index.js"),utils_1=__webpack_require__(/*! ./utils */ "./node_modules/react-multi-carousel/lib/utils/index.js"),CarouselItems=function(_a){var props=_a.props,state=_a.state,goToSlide=_a.goToSlide,clones=_a.clones,notEnoughChildren=_a.notEnoughChildren,itemWidth=state.itemWidth,children=props.children,infinite=props.infinite,itemClass=props.itemClass,itemAriaLabel=props.itemAriaLabel,partialVisbile=props.partialVisbile,partialVisible=props.partialVisible,_b=utils_1.getInitialState(state,props),flexBisis=_b.flexBisis,shouldRenderOnSSR=_b.shouldRenderOnSSR,domFullyLoaded=_b.domFullyLoaded,partialVisibilityGutter=_b.partialVisibilityGutter;return _b.shouldRenderAtAll?(partialVisbile&&console.warn('WARNING: Please correct props name: "partialVisible" as old typo will be removed in future versions!'),React.createElement(React.Fragment,null,(infinite?clones:React.Children.toArray(children)).map(function(child,index){return React.createElement("li",{key:index,"data-index":index,onClick:function(){props.focusOnSelect&&goToSlide(index)},"aria-hidden":utils_1.getIfSlideIsVisbile(index,state)?"false":"true","aria-label":itemAriaLabel||(child.props.ariaLabel?child.props.ariaLabel:null),style:{flex:shouldRenderOnSSR?"1 0 "+flexBisis+"%":"auto",position:"relative",width:domFullyLoaded?((partialVisbile||partialVisible)&&partialVisibilityGutter&&!notEnoughChildren?itemWidth-partialVisibilityGutter:itemWidth)+"px":"auto"},className:"react-multi-carousel-item "+(utils_1.getIfSlideIsVisbile(index,state)?"react-multi-carousel-item--active":"")+" "+itemClass},child)}))):null};exports["default"]=CarouselItems;

/***/ }),

/***/ "./node_modules/react-multi-carousel/lib/Dots.js":
/*!*******************************************************!*\
  !*** ./node_modules/react-multi-carousel/lib/Dots.js ***!
  \*******************************************************/
/***/ ((__unused_webpack_module, exports, __webpack_require__) => {

"use strict";
Object.defineProperty(exports, "__esModule", ({value:!0}));var React=__webpack_require__(/*! react */ "./node_modules/react/index.js"),clones_1=__webpack_require__(/*! ./utils/clones */ "./node_modules/react-multi-carousel/lib/utils/clones.js"),dots_1=__webpack_require__(/*! ./utils/dots */ "./node_modules/react-multi-carousel/lib/utils/dots.js"),common_1=__webpack_require__(/*! ./utils/common */ "./node_modules/react-multi-carousel/lib/utils/common.js"),Dots=function(_a){var props=_a.props,state=_a.state,goToSlide=_a.goToSlide,getState=_a.getState,showDots=props.showDots,customDot=props.customDot,dotListClass=props.dotListClass,infinite=props.infinite,children=props.children;if(!showDots||common_1.notEnoughChildren(state))return null;var numberOfDotsToShow,currentSlide=state.currentSlide,slidesToShow=state.slidesToShow,slidesToSlide=common_1.getSlidesToSlide(state,props),childrenArr=React.Children.toArray(children);numberOfDotsToShow=infinite?Math.ceil(childrenArr.length/slidesToSlide):Math.ceil((childrenArr.length-slidesToShow)/slidesToSlide)+1;var nextSlidesTable=dots_1.getLookupTableForNextSlides(numberOfDotsToShow,state,props,childrenArr),lookupTable=clones_1.getOriginalIndexLookupTableByClones(slidesToShow,childrenArr),currentSlides=lookupTable[currentSlide];return React.createElement("ul",{className:"react-multi-carousel-dot-list "+dotListClass},Array(numberOfDotsToShow).fill(0).map(function(_,index){var isActive,nextSlide;if(infinite){nextSlide=nextSlidesTable[index];var cloneIndex=lookupTable[nextSlide];isActive=currentSlides===cloneIndex||cloneIndex<=currentSlides&&currentSlides<cloneIndex+slidesToSlide}else{var maximumNextSlide=childrenArr.length-slidesToShow,possibileNextSlides=index*slidesToSlide;isActive=(nextSlide=maximumNextSlide<possibileNextSlides?maximumNextSlide:possibileNextSlides)===currentSlide||nextSlide<currentSlide&&currentSlide<nextSlide+slidesToSlide&&currentSlide<childrenArr.length-slidesToShow}return customDot?React.cloneElement(customDot,{index:index,active:isActive,key:index,onClick:function(){return goToSlide(nextSlide)},carouselState:getState()}):React.createElement("li",{"data-index":index,key:index,className:"react-multi-carousel-dot "+(isActive?"react-multi-carousel-dot--active":"")},React.createElement("button",{"aria-label":"Go to slide "+(index+1),onClick:function(){return goToSlide(nextSlide)}}))}))};exports["default"]=Dots;

/***/ }),

/***/ "./node_modules/react-multi-carousel/lib/index.js":
/*!********************************************************!*\
  !*** ./node_modules/react-multi-carousel/lib/index.js ***!
  \********************************************************/
/***/ ((__unused_webpack_module, exports, __webpack_require__) => {

"use strict";
Object.defineProperty(exports, "__esModule", ({value:!0}));var Carousel_1=__webpack_require__(/*! ./Carousel */ "./node_modules/react-multi-carousel/lib/Carousel.js");exports["default"]=Carousel_1.default;

/***/ }),

/***/ "./node_modules/react-multi-carousel/lib/types.js":
/*!********************************************************!*\
  !*** ./node_modules/react-multi-carousel/lib/types.js ***!
  \********************************************************/
/***/ (function(__unused_webpack_module, exports, __webpack_require__) {

"use strict";
var __extends=this&&this.__extends||function(){var extendStatics=function(d,b){return(extendStatics=Object.setPrototypeOf||{__proto__:[]}instanceof Array&&function(d,b){d.__proto__=b}||function(d,b){for(var p in b)b.hasOwnProperty(p)&&(d[p]=b[p])})(d,b)};return function(d,b){function __(){this.constructor=d}extendStatics(d,b),d.prototype=null===b?Object.create(b):(__.prototype=b.prototype,new __)}}();Object.defineProperty(exports, "__esModule", ({value:!0}));var React=__webpack_require__(/*! react */ "./node_modules/react/index.js");function isMouseMoveEvent(e){return"clientY"in e}exports.isMouseMoveEvent=isMouseMoveEvent;var Carousel=function(_super){function Carousel(){return null!==_super&&_super.apply(this,arguments)||this}return __extends(Carousel,_super),Carousel}(React.Component);exports["default"]=Carousel;

/***/ }),

/***/ "./node_modules/react-multi-carousel/lib/utils/clones.js":
/*!***************************************************************!*\
  !*** ./node_modules/react-multi-carousel/lib/utils/clones.js ***!
  \***************************************************************/
/***/ ((__unused_webpack_module, exports) => {

"use strict";
function getOriginalCounterPart(index,_a,childrenArr){var slidesToShow=_a.slidesToShow,currentSlide=_a.currentSlide;return childrenArr.length>2*slidesToShow?index+2*slidesToShow:currentSlide>=childrenArr.length?childrenArr.length+index:index}function getOriginalIndexLookupTableByClones(slidesToShow,childrenArr){if(childrenArr.length>2*slidesToShow){for(var table={},firstBeginningOfClones=childrenArr.length-2*slidesToShow,firstEndOfClones=childrenArr.length-firstBeginningOfClones,firstCount=firstBeginningOfClones,i=0;i<firstEndOfClones;i++)table[i]=firstCount,firstCount++;var secondBeginningOfClones=childrenArr.length+firstEndOfClones,secondEndOfClones=secondBeginningOfClones+childrenArr.slice(0,2*slidesToShow).length,secondCount=0;for(i=secondBeginningOfClones;i<=secondEndOfClones;i++)table[i]=secondCount,secondCount++;var originalEnd=secondBeginningOfClones,originalCounter=0;for(i=firstEndOfClones;i<originalEnd;i++)table[i]=originalCounter,originalCounter++;return table}table={};var totalSlides=3*childrenArr.length,count=0;for(i=0;i<totalSlides;i++)table[i]=count,++count===childrenArr.length&&(count=0);return table}function getClones(slidesToShow,childrenArr){return childrenArr.length<slidesToShow?childrenArr:childrenArr.length>2*slidesToShow?childrenArr.slice(childrenArr.length-2*slidesToShow,childrenArr.length).concat(childrenArr,childrenArr.slice(0,2*slidesToShow)):childrenArr.concat(childrenArr,childrenArr)}function getInitialSlideInInfiniteMode(slidesToShow,childrenArr){return childrenArr.length>2*slidesToShow?2*slidesToShow:childrenArr.length}function checkClonesPosition(_a,childrenArr,props){var isReachingTheEnd,currentSlide=_a.currentSlide,slidesToShow=_a.slidesToShow,itemWidth=_a.itemWidth,totalItems=_a.totalItems,nextSlide=0,nextPosition=0,isReachingTheStart=0===currentSlide,originalFirstSlide=childrenArr.length-(childrenArr.length-2*slidesToShow);return childrenArr.length<slidesToShow?(nextPosition=nextSlide=0,isReachingTheStart=isReachingTheEnd=!1):childrenArr.length>2*slidesToShow?((isReachingTheEnd=currentSlide>=originalFirstSlide+childrenArr.length)&&(nextPosition=-itemWidth*(nextSlide=currentSlide-childrenArr.length)),isReachingTheStart&&(nextPosition=-itemWidth*(nextSlide=originalFirstSlide+(childrenArr.length-2*slidesToShow)))):((isReachingTheEnd=currentSlide>=2*childrenArr.length)&&(nextPosition=-itemWidth*(nextSlide=currentSlide-childrenArr.length)),isReachingTheStart&&(nextPosition=props.showDots?-itemWidth*(nextSlide=childrenArr.length):-itemWidth*(nextSlide=totalItems/3))),{isReachingTheEnd:isReachingTheEnd,isReachingTheStart:isReachingTheStart,nextSlide:nextSlide,nextPosition:nextPosition}}Object.defineProperty(exports, "__esModule", ({value:!0})),exports.getOriginalCounterPart=getOriginalCounterPart,exports.getOriginalIndexLookupTableByClones=getOriginalIndexLookupTableByClones,exports.getClones=getClones,exports.getInitialSlideInInfiniteMode=getInitialSlideInInfiniteMode,exports.checkClonesPosition=checkClonesPosition;

/***/ }),

/***/ "./node_modules/react-multi-carousel/lib/utils/common.js":
/*!***************************************************************!*\
  !*** ./node_modules/react-multi-carousel/lib/utils/common.js ***!
  \***************************************************************/
/***/ ((__unused_webpack_module, exports, __webpack_require__) => {

"use strict";
Object.defineProperty(exports, "__esModule", ({value:!0}));var elementWidth_1=__webpack_require__(/*! ./elementWidth */ "./node_modules/react-multi-carousel/lib/utils/elementWidth.js");function notEnoughChildren(state){var slidesToShow=state.slidesToShow;return state.totalItems<slidesToShow}function getInitialState(state,props){var flexBisis,domLoaded=state.domLoaded,slidesToShow=state.slidesToShow,containerWidth=state.containerWidth,itemWidth=state.itemWidth,deviceType=props.deviceType,responsive=props.responsive,ssr=props.ssr,partialVisbile=props.partialVisbile,partialVisible=props.partialVisible,domFullyLoaded=Boolean(domLoaded&&slidesToShow&&containerWidth&&itemWidth);ssr&&deviceType&&!domFullyLoaded&&(flexBisis=elementWidth_1.getWidthFromDeviceType(deviceType,responsive));var shouldRenderOnSSR=Boolean(ssr&&deviceType&&!domFullyLoaded&&flexBisis);return{shouldRenderOnSSR:shouldRenderOnSSR,flexBisis:flexBisis,domFullyLoaded:domFullyLoaded,partialVisibilityGutter:elementWidth_1.getPartialVisibilityGutter(responsive,partialVisbile||partialVisible,deviceType,state.deviceType),shouldRenderAtAll:shouldRenderOnSSR||domFullyLoaded}}function getIfSlideIsVisbile(index,state){var currentSlide=state.currentSlide,slidesToShow=state.slidesToShow;return currentSlide<=index&&index<currentSlide+slidesToShow}function getTransformForCenterMode(state,props,transformPlaceHolder){var transform=transformPlaceHolder||state.transform;return!props.infinite&&0===state.currentSlide||notEnoughChildren(state)?transform:transform+state.itemWidth/2}function isInLeftEnd(_a){return!(0<_a.currentSlide)}function isInRightEnd(_a){var currentSlide=_a.currentSlide,totalItems=_a.totalItems;return!(currentSlide+_a.slidesToShow<totalItems)}function getTransformForPartialVsibile(state,partialVisibilityGutter,props,transformPlaceHolder){void 0===partialVisibilityGutter&&(partialVisibilityGutter=0);var currentSlide=state.currentSlide,slidesToShow=state.slidesToShow,isRightEndReach=isInRightEnd(state),shouldRemoveRightGutter=!props.infinite&&isRightEndReach,baseTransform=transformPlaceHolder||state.transform;if(notEnoughChildren(state))return baseTransform;var transform=baseTransform+currentSlide*partialVisibilityGutter;return shouldRemoveRightGutter?transform+(state.containerWidth-(state.itemWidth-partialVisibilityGutter)*slidesToShow):transform}function parsePosition(props,position){return props.rtl?-1*position:position}function getTransform(state,props,transformPlaceHolder){var partialVisbile=props.partialVisbile,partialVisible=props.partialVisible,responsive=props.responsive,deviceType=props.deviceType,centerMode=props.centerMode,transform=transformPlaceHolder||state.transform,partialVisibilityGutter=elementWidth_1.getPartialVisibilityGutter(responsive,partialVisbile||partialVisible,deviceType,state.deviceType);return parsePosition(props,partialVisible||partialVisbile?getTransformForPartialVsibile(state,partialVisibilityGutter,props,transformPlaceHolder):centerMode?getTransformForCenterMode(state,props,transformPlaceHolder):transform)}function getSlidesToSlide(state,props){var domLoaded=state.domLoaded,slidesToShow=state.slidesToShow,containerWidth=state.containerWidth,itemWidth=state.itemWidth,deviceType=props.deviceType,responsive=props.responsive,slidesToScroll=props.slidesToSlide||1,domFullyLoaded=Boolean(domLoaded&&slidesToShow&&containerWidth&&itemWidth);return props.ssr&&props.deviceType&&!domFullyLoaded&&Object.keys(responsive).forEach(function(device){var slidesToSlide=responsive[device].slidesToSlide;deviceType===device&&slidesToSlide&&(slidesToScroll=slidesToSlide)}),domFullyLoaded&&Object.keys(responsive).forEach(function(item){var _a=responsive[item],breakpoint=_a.breakpoint,slidesToSlide=_a.slidesToSlide,max=breakpoint.max,min=breakpoint.min;slidesToSlide&&window.innerWidth>=min&&window.innerWidth<=max&&(slidesToScroll=slidesToSlide)}),slidesToScroll}exports.notEnoughChildren=notEnoughChildren,exports.getInitialState=getInitialState,exports.getIfSlideIsVisbile=getIfSlideIsVisbile,exports.getTransformForCenterMode=getTransformForCenterMode,exports.isInLeftEnd=isInLeftEnd,exports.isInRightEnd=isInRightEnd,exports.getTransformForPartialVsibile=getTransformForPartialVsibile,exports.parsePosition=parsePosition,exports.getTransform=getTransform,exports.getSlidesToSlide=getSlidesToSlide;

/***/ }),

/***/ "./node_modules/react-multi-carousel/lib/utils/dots.js":
/*!*************************************************************!*\
  !*** ./node_modules/react-multi-carousel/lib/utils/dots.js ***!
  \*************************************************************/
/***/ ((__unused_webpack_module, exports, __webpack_require__) => {

"use strict";
Object.defineProperty(exports, "__esModule", ({value:!0}));var clones_1=__webpack_require__(/*! ./clones */ "./node_modules/react-multi-carousel/lib/utils/clones.js"),common_1=__webpack_require__(/*! ./common */ "./node_modules/react-multi-carousel/lib/utils/common.js");function getLookupTableForNextSlides(numberOfDotsToShow,state,props,childrenArr){var table={},slidesToSlide=common_1.getSlidesToSlide(state,props);return Array(numberOfDotsToShow).fill(0).forEach(function(_,i){var nextSlide=clones_1.getOriginalCounterPart(i,state,childrenArr);if(0===i)table[0]=nextSlide;else{var now=table[i-1]+slidesToSlide;table[i]=now}}),table}exports.getLookupTableForNextSlides=getLookupTableForNextSlides;

/***/ }),

/***/ "./node_modules/react-multi-carousel/lib/utils/elementWidth.js":
/*!*********************************************************************!*\
  !*** ./node_modules/react-multi-carousel/lib/utils/elementWidth.js ***!
  \*********************************************************************/
/***/ ((__unused_webpack_module, exports) => {

"use strict";
Object.defineProperty(exports, "__esModule", ({value:!0}));var hasWarnAboutTypo=!1;function getPartialVisibilityGutter(responsive,partialVisible,serverSideDeviceType,clientSideDeviceType){var gutter=0,deviceType=clientSideDeviceType||serverSideDeviceType;return partialVisible&&deviceType&&(!hasWarnAboutTypo&&"production"!=="development"&&responsive[deviceType].paritialVisibilityGutter&&(hasWarnAboutTypo=!0,console.warn("You appear to be using paritialVisibilityGutter instead of partialVisibilityGutter which will be moved to partialVisibilityGutter in the future completely")),gutter=responsive[deviceType].partialVisibilityGutter||responsive[deviceType].paritialVisibilityGutter),gutter}function getWidthFromDeviceType(deviceType,responsive){var itemWidth;responsive[deviceType]&&(itemWidth=(100/responsive[deviceType].items).toFixed(1));return itemWidth}function getItemClientSideWidth(props,slidesToShow,containerWidth){return Math.round(containerWidth/(slidesToShow+(props.centerMode?1:0)))}exports.getPartialVisibilityGutter=getPartialVisibilityGutter,exports.getWidthFromDeviceType=getWidthFromDeviceType,exports.getItemClientSideWidth=getItemClientSideWidth;

/***/ }),

/***/ "./node_modules/react-multi-carousel/lib/utils/index.js":
/*!**************************************************************!*\
  !*** ./node_modules/react-multi-carousel/lib/utils/index.js ***!
  \**************************************************************/
/***/ ((__unused_webpack_module, exports, __webpack_require__) => {

"use strict";
Object.defineProperty(exports, "__esModule", ({value:!0}));var clones_1=__webpack_require__(/*! ./clones */ "./node_modules/react-multi-carousel/lib/utils/clones.js");exports.getOriginalCounterPart=clones_1.getOriginalCounterPart,exports.getClones=clones_1.getClones,exports.checkClonesPosition=clones_1.checkClonesPosition,exports.getInitialSlideInInfiniteMode=clones_1.getInitialSlideInInfiniteMode;var elementWidth_1=__webpack_require__(/*! ./elementWidth */ "./node_modules/react-multi-carousel/lib/utils/elementWidth.js");exports.getWidthFromDeviceType=elementWidth_1.getWidthFromDeviceType,exports.getPartialVisibilityGutter=elementWidth_1.getPartialVisibilityGutter,exports.getItemClientSideWidth=elementWidth_1.getItemClientSideWidth;var common_1=__webpack_require__(/*! ./common */ "./node_modules/react-multi-carousel/lib/utils/common.js");exports.getInitialState=common_1.getInitialState,exports.getIfSlideIsVisbile=common_1.getIfSlideIsVisbile,exports.getTransformForCenterMode=common_1.getTransformForCenterMode,exports.getTransformForPartialVsibile=common_1.getTransformForPartialVsibile,exports.isInLeftEnd=common_1.isInLeftEnd,exports.isInRightEnd=common_1.isInRightEnd,exports.notEnoughChildren=common_1.notEnoughChildren,exports.getSlidesToSlide=common_1.getSlidesToSlide;var throttle_1=__webpack_require__(/*! ./throttle */ "./node_modules/react-multi-carousel/lib/utils/throttle.js");exports.throttle=throttle_1.default;var throwError_1=__webpack_require__(/*! ./throwError */ "./node_modules/react-multi-carousel/lib/utils/throwError.js");exports.throwError=throwError_1.default;var next_1=__webpack_require__(/*! ./next */ "./node_modules/react-multi-carousel/lib/utils/next.js");exports.populateNextSlides=next_1.populateNextSlides;var previous_1=__webpack_require__(/*! ./previous */ "./node_modules/react-multi-carousel/lib/utils/previous.js");exports.populatePreviousSlides=previous_1.populatePreviousSlides;var mouseOrTouchMove_1=__webpack_require__(/*! ./mouseOrTouchMove */ "./node_modules/react-multi-carousel/lib/utils/mouseOrTouchMove.js");exports.populateSlidesOnMouseTouchMove=mouseOrTouchMove_1.populateSlidesOnMouseTouchMove;

/***/ }),

/***/ "./node_modules/react-multi-carousel/lib/utils/mouseOrTouchMove.js":
/*!*************************************************************************!*\
  !*** ./node_modules/react-multi-carousel/lib/utils/mouseOrTouchMove.js ***!
  \*************************************************************************/
/***/ ((__unused_webpack_module, exports) => {

"use strict";
function populateSlidesOnMouseTouchMove(state,props,initialX,lastX,clientX,transformPlaceHolder){var direction,nextPosition,itemWidth=state.itemWidth,slidesToShow=state.slidesToShow,totalItems=state.totalItems,currentSlide=state.currentSlide,infinite=props.infinite,canContinue=!1,slidesHavePassedRight=Math.round((initialX-lastX)/itemWidth),slidesHavePassedLeft=Math.round((lastX-initialX)/itemWidth),isMovingLeft=initialX<clientX;if(clientX<initialX&&!!(slidesHavePassedRight<=slidesToShow)){direction="right";var translateXLimit=Math.abs(-itemWidth*(totalItems-slidesToShow)),nextTranslate=transformPlaceHolder-(lastX-clientX),isLastSlide=currentSlide===totalItems-slidesToShow;(Math.abs(nextTranslate)<=translateXLimit||isLastSlide&&infinite)&&(nextPosition=nextTranslate,canContinue=!0)}isMovingLeft&&slidesHavePassedLeft<=slidesToShow&&(direction="left",((nextTranslate=transformPlaceHolder+(clientX-lastX))<=0||0===currentSlide&&infinite)&&(canContinue=!0,nextPosition=nextTranslate));return{direction:direction,nextPosition:nextPosition,canContinue:canContinue}}Object.defineProperty(exports, "__esModule", ({value:!0})),exports.populateSlidesOnMouseTouchMove=populateSlidesOnMouseTouchMove;

/***/ }),

/***/ "./node_modules/react-multi-carousel/lib/utils/next.js":
/*!*************************************************************!*\
  !*** ./node_modules/react-multi-carousel/lib/utils/next.js ***!
  \*************************************************************/
/***/ ((__unused_webpack_module, exports, __webpack_require__) => {

"use strict";
Object.defineProperty(exports, "__esModule", ({value:!0}));var common_1=__webpack_require__(/*! ./common */ "./node_modules/react-multi-carousel/lib/utils/common.js");function populateNextSlides(state,props,slidesHavePassed){void 0===slidesHavePassed&&(slidesHavePassed=0);var nextSlides,nextPosition,slidesToShow=state.slidesToShow,currentSlide=state.currentSlide,itemWidth=state.itemWidth,totalItems=state.totalItems,slidesToSlide=common_1.getSlidesToSlide(state,props),nextMaximumSlides=currentSlide+1+slidesHavePassed+slidesToShow+(0<slidesHavePassed?0:slidesToSlide);return nextPosition=nextMaximumSlides<=totalItems?-itemWidth*(nextSlides=currentSlide+slidesHavePassed+(0<slidesHavePassed?0:slidesToSlide)):totalItems<nextMaximumSlides&&currentSlide!==totalItems-slidesToShow?-itemWidth*(nextSlides=totalItems-slidesToShow):nextSlides=void 0,{nextSlides:nextSlides,nextPosition:nextPosition}}exports.populateNextSlides=populateNextSlides;

/***/ }),

/***/ "./node_modules/react-multi-carousel/lib/utils/previous.js":
/*!*****************************************************************!*\
  !*** ./node_modules/react-multi-carousel/lib/utils/previous.js ***!
  \*****************************************************************/
/***/ ((__unused_webpack_module, exports, __webpack_require__) => {

"use strict";
Object.defineProperty(exports, "__esModule", ({value:!0}));var React=__webpack_require__(/*! react */ "./node_modules/react/index.js"),common_1=__webpack_require__(/*! ./common */ "./node_modules/react-multi-carousel/lib/utils/common.js"),common_2=__webpack_require__(/*! ./common */ "./node_modules/react-multi-carousel/lib/utils/common.js");function populatePreviousSlides(state,props,slidesHavePassed){void 0===slidesHavePassed&&(slidesHavePassed=0);var nextSlides,nextPosition,currentSlide=state.currentSlide,itemWidth=state.itemWidth,slidesToShow=state.slidesToShow,children=props.children,showDots=props.showDots,infinite=props.infinite,slidesToSlide=common_1.getSlidesToSlide(state,props),nextMaximumSlides=currentSlide-slidesHavePassed-(0<slidesHavePassed?0:slidesToSlide),additionalSlides=(React.Children.toArray(children).length-slidesToShow)%slidesToSlide;return nextPosition=0<=nextMaximumSlides?(nextSlides=nextMaximumSlides,showDots&&!infinite&&0<additionalSlides&&common_2.isInRightEnd(state)&&(nextSlides=currentSlide-additionalSlides),-itemWidth*nextSlides):nextSlides=nextMaximumSlides<0&&0!==currentSlide?0:void 0,{nextSlides:nextSlides,nextPosition:nextPosition}}exports.populatePreviousSlides=populatePreviousSlides;

/***/ }),

/***/ "./node_modules/react-multi-carousel/lib/utils/throttle.js":
/*!*****************************************************************!*\
  !*** ./node_modules/react-multi-carousel/lib/utils/throttle.js ***!
  \*****************************************************************/
/***/ ((__unused_webpack_module, exports) => {

"use strict";
Object.defineProperty(exports, "__esModule", ({value:!0}));var throttle=function(func,limit,setIsInThrottle){var inThrottle;return function(){var args=arguments;inThrottle||(func.apply(this,args),inThrottle=!0,"function"==typeof setIsInThrottle&&setIsInThrottle(!0),setTimeout(function(){inThrottle=!1,"function"==typeof setIsInThrottle&&setIsInThrottle(!1)},limit))}};exports["default"]=throttle;

/***/ }),

/***/ "./node_modules/react-multi-carousel/lib/utils/throwError.js":
/*!*******************************************************************!*\
  !*** ./node_modules/react-multi-carousel/lib/utils/throwError.js ***!
  \*******************************************************************/
/***/ ((__unused_webpack_module, exports) => {

"use strict";
function throwError(state,props){var partialVisbile=props.partialVisbile,partialVisible=props.partialVisible,centerMode=props.centerMode,ssr=props.ssr,responsive=props.responsive;if((partialVisbile||partialVisible)&&centerMode)throw new Error("center mode can not be used at the same time with partialVisible");if(!responsive)throw ssr?new Error("ssr mode need to be used in conjunction with responsive prop"):new Error("Responsive prop is needed for deciding the amount of items to show on the screen");if(responsive&&"object"!=typeof responsive)throw new Error("responsive prop must be an object")}Object.defineProperty(exports, "__esModule", ({value:!0})),exports["default"]=throwError;

/***/ })

}]);