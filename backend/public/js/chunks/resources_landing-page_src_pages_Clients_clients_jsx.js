"use strict";
(self["webpackChunkkhardl"] = self["webpackChunkkhardl"] || []).push([["resources_landing-page_src_pages_Clients_clients_jsx"],{

/***/ "./resources/landing-page/src/components/Clients/Card.jsx":
/*!****************************************************************!*\
  !*** ./resources/landing-page/src/components/Clients/Card.jsx ***!
  \****************************************************************/
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

/***/ "./resources/landing-page/src/components/HeaderSection.jsx":
/*!*****************************************************************!*\
  !*** ./resources/landing-page/src/components/HeaderSection.jsx ***!
  \*****************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _assets_LogoPattern_webp__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../assets/LogoPattern.webp */ "./resources/landing-page/src/assets/LogoPattern.webp");
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! react/jsx-runtime */ "./node_modules/react/jsx-runtime.js");




var HeaderSection = function HeaderSection(_ref) {
  var title = _ref.title,
    details = _ref.details;
  return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("section", {
    className: "mx-[160px] max-[1250px]:mx-[20px]",
    children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("footer", {
      className: "active text-center",
      children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("div", {
        className: "px-6 py-10 text-center md:text-right rounded-[30px]",
        style: {
          backgroundImage: "url(".concat(_assets_LogoPattern_webp__WEBPACK_IMPORTED_MODULE_1__["default"], ")"),
          backgroundSize: "cover"
        },
        children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)("div", {
          className: "text-center py-10 lg:py-20",
          children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("h1", {
            className: "text-4xl font-extrabold tracking-tight leading-none md:text-5xl lg:text-6xl mb-8",
            children: title
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("p", {
            className: "text-lg font-normal lg:text-xl sm:px-16 lg:px-48",
            children: details
          })]
        })
      })
    })
  });
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (HeaderSection);

/***/ }),

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

/***/ "./resources/landing-page/src/data/data.jsx":
/*!**************************************************!*\
  !*** ./resources/landing-page/src/data/data.jsx ***!
  \**************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

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

/***/ "./resources/landing-page/src/pages/Clients/clients.jsx":
/*!**************************************************************!*\
  !*** ./resources/landing-page/src/pages/Clients/clients.jsx ***!
  \**************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _components_HeaderSection__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../components/HeaderSection */ "./resources/landing-page/src/components/HeaderSection.jsx");
/* harmony import */ var react_i18next__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! react-i18next */ "./node_modules/react-i18next/dist/es/index.js");
/* harmony import */ var _components_MainText__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../components/MainText */ "./resources/landing-page/src/components/MainText.jsx");
/* harmony import */ var _components_ContactUsSection_ContactUs__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../../components/ContactUsSection/ContactUs */ "./resources/landing-page/src/components/ContactUsSection/ContactUs.jsx");
/* harmony import */ var _components_Clients_Card__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ../../components/Clients/Card */ "./resources/landing-page/src/components/Clients/Card.jsx");
/* harmony import */ var _data_data__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ../../data/data */ "./resources/landing-page/src/data/data.jsx");
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! react/jsx-runtime */ "./node_modules/react/jsx-runtime.js");









function Clients() {
  var _useTranslation = (0,react_i18next__WEBPACK_IMPORTED_MODULE_2__.useTranslation)(),
    t = _useTranslation.t;
  /*  const [clients, setClients] = useState([]);
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
     ///////////////////////////////////////////////////////////////////////////////////// */
  return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_7__.jsxs)("div", {
    className: "pt-[80px]",
    children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_7__.jsx)("div", {
      className: "p-[30px]  pt-[60px] max-md:px-[5px] max-md:py-[40px] ",
      children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_7__.jsx)(_components_HeaderSection__WEBPACK_IMPORTED_MODULE_1__["default"], {
        title: t("Clients"),
        details: "".concat(t("Home"), " / ").concat(t("Clients"))
      })
    }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_7__.jsx)("div", {
      className: "mt-6",
      children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_7__.jsx)(_components_MainText__WEBPACK_IMPORTED_MODULE_3__["default"], {
        SubTitle: t("Default Text")
      })
    }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_7__.jsx)("div", {
      className: "mx-[160px] max-[1250px]:mx-[20px]",
      children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_7__.jsx)("div", {
        className: "grid max-sm:grid-cols-1 max-lg:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-10 mx-4 mt-8 mb-[50px]",
        children: _data_data__WEBPACK_IMPORTED_MODULE_6__.clients.map(function (client, index) {
          return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_7__.jsx)(_components_Clients_Card__WEBPACK_IMPORTED_MODULE_5__["default"], {
            ClientImage: client.client_image,
            ClientLink: client.client_link
          }, index);
        })
      })
    }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_7__.jsx)(_components_ContactUsSection_ContactUs__WEBPACK_IMPORTED_MODULE_4__["default"], {})]
  });
}
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Clients);

/***/ }),

/***/ "./resources/landing-page/src/assets/ClientLogo1.webp":
/*!************************************************************!*\
  !*** ./resources/landing-page/src/assets/ClientLogo1.webp ***!
  \************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

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

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ("/images/ClientLogo3.webp?643e50f2c48953a95e7fbb011ae5471b");

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

/***/ }),

/***/ "./resources/landing-page/src/assets/LogoPattern.webp":
/*!************************************************************!*\
  !*** ./resources/landing-page/src/assets/LogoPattern.webp ***!
  \************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ("/images/LogoPattern.webp?6032d565356344543ea05956a09794b4");

/***/ })

}]);