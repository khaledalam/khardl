import React, { useEffect, useState } from "react";
import "./App.css";
import "slick-carousel/slick/slick.css";
import "slick-carousel/slick/slick-theme.css";
import { Routes, Route, useLocation, Navigate } from "react-router-dom";
import { useSelector } from "react-redux";
import { ToastContainer } from "react-toastify";
import Footer from "./components/Footer/Footer";
import Login from "./pages/LoginSignUp/Login";
import { Helmet } from "react-helmet";
import LoginAdmin from "./pages/LoginSignUp/LoginAdmin";
import LoginTrial from "./pages/LoginSignUp/LoginTrial";
import Register from "./pages/LoginSignUp/Register";
import RestaurantNotLive from "./components/RestaurantNotLive";
import RestaurantNotSubscribed from "./components/RestaurantNotSubscribed";
import "aos/dist/aos.css";
import "react-phone-input-2/lib/style.css";
import VerificationPhone from "./pages/LoginSignUp/VerificationPhone";
import ScrollUp from "./components/ScrollUp";
import Aos from "aos";
import "aos/dist/aos.css";
import "react-phone-input-2/lib/style.css";
import ForgotPassword from "./pages/LoginSignUp/ForgotPassword";
import CreateNewPassword from "./pages/LoginSignUp/CreateNewPassword";
import EditorSwitcher from "./pages/EditorSwitcher";
import Protected from "./Protected";
import PrivateRoute from "./components/PrivateRoute/PrivateRoute";
import Layout from "./components/Layout/Layout";
import Logout from "./components/Logout/Logout";
import { useAuthContext } from "./components/context/AuthContext";
import TermsPolicies from "./pages/TermsPoliciesPrivacy/TermsPolicies";
import Privacy from "./pages/TermsPoliciesPrivacy/Privacy";
import MenuProvider from "react-flexible-sliding-menu";
import { RestuarantEditor } from "./pages/EditorsPage";
import { RestuarantHomePage } from "./pages/RestuarantPage";
import OuterSidebarNav from "./pages/EditorsPage/Restuarants/components/OuterSidebarNav";
import CartPage from "./pages/CartPage";
import NavbarRestuarant from "./pages/RestuarantPage/components/NavbarRestuarant";
import { CustomerPage } from "./pages/CustomerPage";
import SuccessPayment from "./pages/SuccessPayment";
import FailedPayment from "./pages/FailedPayment";
import * as Sentry from "@sentry/react";

import { initializeApp } from "firebase/app";
const firebaseConfig = {
    apiKey: "AIzaSyD7xao9Wm2JTWWJwS5IvgNYWJWiSh48mwM",
    authDomain: "khardl.firebaseapp.com",
    projectId: "khardl",
    storageBucket: "khardl.appspot.com",
    messagingSenderId: "1002899768051",
    appId: "1:1002899768051:web:9b50b863cddbe6fef82d86",
    measurementId: "G-Z55421NDE7"
};
// Initialize Firebase
const firstbaseApp = initializeApp(firebaseConfig);

Sentry.init({
  dsn:
    "https://860125ea20f9254e5c411ffbdeb02c39@o4506502637420544.ingest.sentry.io/4506563222896640",
  integrations: [new Sentry.Replay()],
  // Session Replay
  replaysSessionSampleRate: 0.1, // This sets the sample rate at 10%. You may want to change it to 100% while in development and then sample at a lower rate in production.
  replaysOnErrorSampleRate: 1.0, // If you're not already sampling the entire session, change the sample rate to 100% when sampling sessions where errors occur.
});

const App = () => {
  const restuarantStyle = useSelector((state) => state.restuarantEditorStyle);
  const Language = useSelector((state) => state.languageMode.languageMode);
  const direction = localStorage.getItem("i18nextLng") === "en" ? "ltr" : "rtl";
  const fontFamily = "cairo, sans-serif";
  const location = useLocation();
  const { loading } = useAuthContext();
  // const [isMobile, setIsMobile] = useState(false);
  const isMobile = window.innerWidth < 600
  const isTablet = window.innerWidth > 601 && window.innerWidth < 1024
  const isLoggedIn = JSON.parse(localStorage.getItem("isLoggedIn"));
  useEffect(() => {
    // const isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);

    // setIsMobile(isMobile);
  }, []);

  const showHeader = ![
    "/policies",
    "/dashboard",
    "/privacy",
    "/site-editor/restaurants",
    "/restaurant-not-live",
    "/restaurant-not-subscribed",
    "/success",
    "/failed",
    "/verification-phone",
    '/login-trial',
    "/login-admins",
    "/summary"

  ].includes(location.pathname);
  const showFooter = ![
    "/",
    "/cart",
    "/dashboard",
    "/site-editor/restaurants",
    "/login",
    "/login-trial",
    "/login-admins",
    "/register",
    "/register/:url",
    "/reset-password",
    "/create-new-password",
    "/restaurant-not-live",
    "/restaurant-not-subscribed",
    "/verification-phone",
    "/policies",
    "/privacy",
    "/success",
    "/failed",
    "/summary"
  ].includes(location.pathname);

  Aos.init({
    duration: 1000,
    offset: 0,
  });

  if (loading) {
    return;
  }
  return (
    <>
      <Helmet>
        {/* <title>Login</title> */}
        <link
          rel="icon"
          type="image/png"
          href={restuarantStyle.logo}
          sizes="16x16"
        />
      </Helmet>

      <MenuProvider
        MenuComponent={OuterSidebarNav}
        direction={
          localStorage.getItem("i18nextLng") == "en" ? "left" : "right"
        }
        animation={"slide"} // 'slide' │ 'push' │ 'reveal'
        width={isMobile ? "80vw" : isTablet ? '45vw':"25vw"}
      >
        <div
          className="relative "
          style={{
            "::selection": {
              backgroundColor: "#000000",
              color: "#ffffff",
            },
            direction,
            fontFamily,
          }}
        >
          <div>
            <ToastContainer theme="colored" />{" "}
            {showHeader && <NavbarRestuarant />} {/*<Supports />*/} <ScrollUp />
            <div>
              <Routes>
                {" "}
                {/* Public Routes */}{" "}
                <Route path="/" element={<RestuarantHomePage />} />{" "}
                <Route path="/logout" element={<Logout />} />{" "}
                <Route path="/reset-password" element={<ForgotPassword />} />{" "}
                <Route
                  path="/create-new-password"
                  element={<Protected Cmp={CreateNewPassword} />}
                />
                <Route
                  path="/summary"
                  element={<div></div>}
                />


                    <Route
                      path="/restaurant-not-live"
                      element={<RestaurantNotLive />}
                    />
                    <Route
                      path="/restaurant-not-subscribed"
                      element={<RestaurantNotSubscribed />}
                    />

                <Route path="/login-trial" element={<LoginTrial />} />{" "}
                <Route path="/success" element={<SuccessPayment />} />
                <Route path="/failed" element={<FailedPayment />} />
                <Route path="/policies" element={<TermsPolicies />} />{" "}
                <Route path="/privacy" element={<Privacy />} />{" "}
                {/*<Route path='/advantages' element={<Advantages />} />*/}{" "}
                {/*<Route path='/services' element={<Services />} />*/}{" "}
                {/*<Route path='/prices' element={<Prices />} />*/}{" "}
                {/*<Route path='/fqa' element={<FQA />} />*/}{" "}
                <Route element={<Layout />}>
                  <Route path="/login" element={<Login />} />{" "}
                  <Route path="/register" element={<Register />} />{" "}
                  <Route path="/login-admins" element={<LoginAdmin />} />{" "}
                </Route>{" "}
                {/*Editor*/}{" "}
                <Route element={<PrivateRoute />}>
                  <Route
                    path="/verification-phone"
                    element={<VerificationPhone />}
                  />{" "}
                  <Route path="/site-editor" element={<EditorSwitcher />} />{" "}
                  <Route path="/cart" element={<CartPage />} />{" "}
                  <Route
                    path="/site-editor/restaurants"
                    element={<RestuarantEditor />}
                  />{" "}
                  {/* <Route
                {/* <Route path='/dashboard' element={<CustomersPreview />} />{" "} */}{" "}
                  <Route path="/dashboard" element={<CustomerPage />} />{" "}
                  <Route path="/customers" element={<CustomerPage />} />{" "}
                  {/* <Route path='/customers' element={<CustomerPage />} />{" "} */}{" "}
                </Route>{" "}
              </Routes>{" "}
            </div>{" "}
            {showFooter && !loading && (
              <div className="p-[30px] pt-[60px] max-md:px-[5px] max-md:py-[40px] ">
                <Footer />
              </div>
            )}{" "}
          </div>{" "}
        </div>{" "}
      </MenuProvider>
    </>
  );
};

export default App;
