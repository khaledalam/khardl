
import React, { lazy, Suspense } from 'react';
import './App.css';
import { Routes, Route, useLocation } from "react-router-dom";
import { useSelector } from 'react-redux';
import { ToastContainer } from 'react-toastify';
const Header = lazy(() => import("./components/header/Header"));
const Footer = lazy(() => import("./components/Footer/Footer"));
const Home = lazy(() => import("./pages/Home/Home"));
const Advantages = lazy(() => import("./pages/Advantages/Advantages"));
const Clients = lazy(() => import("./pages/Clients/clients"));
const Services = lazy(() => import("./pages/Services/services"));
const FQA = lazy(() => import("./pages/FQA/fqa"));
const Login = lazy(() => import("./pages/LoginSignUp/Login"));
const CompleteRegisteration = lazy(() => import("./pages/LoginSignUp/CompleteRegisteration"));
const TermsPolicies = lazy(() => import("./pages/TermsPoliciesPrivacy/TermsPolicies"));
const Privacy = lazy(() => import("./pages/TermsPoliciesPrivacy/Privacy"));
const Register = lazy(() => import("./pages/LoginSignUp/Register"));
const Supports = lazy(() => import("./components/Supports"));
const Loading = lazy(() => import('./pages/Loading'));

function App() {
  const Language = useSelector((state) => state.languageMode.languageMode);
  const direction = Language === 'en' ? 'ltr' : 'rtl';
  const fontFamily = 'cairo, sans-serif';
  const location = useLocation();
  const showHeader = !['/login', '/register', '/completeregister', '/policies', '/privacy'].includes(location.pathname);

  return (
    <div className='relative'
      style={{
        "::selection": {
          backgroundColor: "#000000",
          color: "#ffffff",
        },
        direction,
        fontFamily
      }}>
      <Suspense fallback={<Loading />}>
        <ToastContainer theme='colored' ></ToastContainer>
        {showHeader && <Header />}
        <Supports />
        <div>
          <Routes>
            <Route path="/" element={<Home />} />
            <Route path="/login" element={<Login />} />
            <Route path="/completeregister" element={<CompleteRegisteration />} />
            <Route path="/policies" element={<TermsPolicies />} />
            <Route path="/privacy" element={<Privacy />} />
            <Route path="/register" element={<Register />} />
            <Route path="/advantages" element={<Advantages />} />
            <Route path="/clients" element={<Clients />} />
            <Route path="/services" element={<Services />} />
            <Route path="/fqa" element={<FQA />} />
          </Routes>
        </div>
        {showHeader &&
          <div className='p-[30px] pt-[60px] max-md:px-[5px] max-md:py-[40px] '>
            <Footer />
          </div>
        }
      </Suspense>
    </div>

  );
}

export default App;
