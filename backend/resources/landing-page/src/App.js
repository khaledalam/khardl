import React from "react";
import "./App.css";
import { Routes, Route, useLocation } from "react-router-dom";
import { useSelector } from "react-redux";
import { ToastContainer } from "react-toastify";
import Header from "./components/Header/Header";
import Home from "./pages/Home/Home";
import RestaurantNotFound from "./pages/Home/RestaurantNotFound";
import Advantages from "./pages/Advantages/Advantages";
import Services from "./pages/Services/services";
import FQA from "./pages/FQA/fqa";
import Login from "./pages/LoginSignUp/Login";
import Register from "./pages/LoginSignUp/Register";
import CompleteRegistration from "./pages/LoginSignUp/CompleteRegistration";
import VerificationEmail from "./pages/LoginSignUp/VerificationEmail";
import TermsPolicies from "./pages/TermsPoliciesPrivacy/TermsPolicies";
import Privacy from "./pages/TermsPoliciesPrivacy/Privacy";
import ScrollUp from "./components/ScrollUp";
import Prices from "./pages/Prices/prices";
import Aos from "aos";
import "aos/dist/aos.css";
import ForgotPassword from "./pages/LoginSignUp/ForgotPassword";
import CreateNewPassword from "./pages/LoginSignUp/CreateNewPassword";
import Protected from "./Protected";

import PrivateRoute from "./components/PrivateRoute/PrivateRoute";
import Layout from "./components/Layout/Layout";
import Logout from "./components/Logout/Logout";
import { useAuthContext } from "./components/context/AuthContext";

import * as Sentry from "@sentry/react";
import { t } from "i18next";
// import { initializeApp } from "firebase/app";
// const firebaseConfig = {
//     apiKey: "AIzaSyD7xao9Wm2JTWWJwS5IvgNYWJWiSh48mwM",
//     authDomain: "khardl.firebaseapp.com",
//     projectId: "khardl",
//     storageBucket: "khardl.appspot.com",
//     messagingSenderId: "1002899768051",
//     appId: "1:1002899768051:web:9b50b863cddbe6fef82d86",
//     measurementId: "G-Z55421NDE7"
// };
// // Initialize Firebase
// const firstbaseApp = initializeApp(firebaseConfig);

if (sentry_on == "1") {
  Sentry.init({
    dsn: "https://860125ea20f9254e5c411ffbdeb02c39@o4506502637420544.ingest.sentry.io/4506563222896640",
    integrations: [new Sentry.Replay()],
    // Session Replay
    replaysSessionSampleRate: 0.1, // This sets the sample rate at 10%. You may want to change it to 100% while in development and then sample at a lower rate in production.
    replaysOnErrorSampleRate: 1.0, // If you're not already sampling the entire session, change the sample rate to 100% when sampling sessions where errors occur.
  });
}

const App = () => {
  console.log(localStorage.getItem("i18nextLng"));
  const Language = useSelector((state) => state.languageMode.languageMode);
  const direction = localStorage.getItem("i18nextLng") === "en" ? "ltr" : "rtl";
  const fontFamily = "cairo, sans-serif";
  const location = useLocation();
  const { loading } = useAuthContext();
  const showHeader = !["/complete-register", "/verification-email"].includes(
    location.pathname,
  );
  const showFooter = ![
    "/login",
    "/register",
    "/restaurant-not-found",
    "/reset-password",
    "/create-new-password",
    "/verification-email",
    "/complete-register",
    "/policies",
    "/privacy",
  ].includes(location.pathname);

  Aos.init({
    duration: 1000,
    offset: 0,
  });

  return (
    <div
      className="relative"
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
        {showHeader && !loading && <Header />} {/*<Supports />*/} <ScrollUp />
        <div>
          <Routes>
            {" "}
            {/* Public Routes */}
            <Route path="/" element={<Home />} />{" "}
            <Route
              path="/restaurant-not-found"
              element={<RestaurantNotFound />}
            />{" "}
            <Route path="/logout" element={<Logout />} />{" "}
            <Route path="/reset-password" element={<ForgotPassword />} />{" "}
            <Route
              path="/create-new-password"
              element={<Protected Cmp={CreateNewPassword} />}
            />
            <Route path="/policies" element={<TermsPolicies />} />{" "}
            <Route path="/privacy" element={<Privacy />} />{" "}
            <Route path="/advantages" element={<Advantages />} />{" "}
            <Route path="/services" element={<Services />} />{" "}
            <Route path="/prices" element={<Prices />} />{" "}
            <Route path="/fqa" element={<FQA />} />
            <Route element={<Layout />}>
              <Route path="/login" element={<Login />} />{" "}
              <Route path="/register" element={<Register />} />{" "}
            </Route>
            {/*Editor*/}{" "}
            <Route element={<PrivateRoute />}>
              <Route
                path="/complete-register"
                element={<CompleteRegistration />}
              />{" "}
              <Route
                path="/verification-email"
                element={<VerificationEmail />}
              />{" "}
            </Route>{" "}
          </Routes>{" "}
        </div>{" "}
        {/*{showFooter && !loading && (*/}
        {/*  <div className="p-[30px] pt-[60px] max-md:px-[5px] max-md:py-[40px] ">*/}
        {/*    /!* <Footer /> *!/*/}
        {/*  </div>*/}
      </div>{" "}
      {showFooter && !loading && (
        <div className="mini-footer">{t("All rights reserved")}</div>
      )}
    </div>
  );
};

export default App;
