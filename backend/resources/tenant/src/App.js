import React, {useEffect, useState} from "react"
import "./App.css"
import "slick-carousel/slick/slick.css"
import "slick-carousel/slick/slick-theme.css"
import {Routes, Route, useLocation} from "react-router-dom"
import {useSelector} from "react-redux"
import {ToastContainer} from "react-toastify"
import Footer from "./components/Footer/Footer"
import Login from "./pages/LoginSignUp/Login"
import LoginAdmin from "./pages/LoginSignUp/LoginAdmin"
import LoginTrial from "./pages/LoginSignUp/LoginTrial"
import Register from "./pages/LoginSignUp/Register"
import VerificationPhone from "./pages/LoginSignUp/VerificationPhone"
import Supports from "./components/Supports"
import ScrollUp from "./components/ScrollUp"
import Aos from "aos"
import "aos/dist/aos.css"
import "react-phone-input-2/lib/style.css"
import ForgotPassword from "./pages/LoginSignUp/ForgotPassword"
import CreateNewPassword from "./pages/LoginSignUp/CreateNewPassword"
import EditorPage from "./pages/EditorPage"
import CustomersPreview from "./components/Customers/CustomersPreview/Preview"
import EditorSwitcher from "./pages/EditorSwitcher"
import Protected from "./Protected"
import PrivateRoute from "./components/PrivateRoute/PrivateRoute"
import Layout from "./components/Layout/Layout"
import Logout from "./components/Logout/Logout"
import {useAuthContext} from "./components/context/AuthContext"
import TermsPolicies from "../../landing-page/src/pages/TermsPoliciesPrivacy/TermsPolicies"
import Privacy from "../../landing-page/src/pages/TermsPoliciesPrivacy/Privacy"
import Cart from "./components/Cart/Cart"
import Header from "./components/Restaurants/RestaurantsPreview/components/header"
import MenuProvider from "react-flexible-sliding-menu"
import {RestuarantEditor} from "./pages/EditorsPage"
import {RestuarantHomePage} from "./pages/RestuarantPage"
import OuterSidebarNav from "./pages/EditorsPage/Restuarants/components/OuterSidebarNav"
import CartPage from "./pages/CartPage"
import NavbarRestuarant from "./pages/RestuarantPage/components/NavbarRestuarant"
import {CustomerPage} from "./pages/CustomerPage"
import Editor from "./components/Customers/CustomersEditor/Editor"

const App = () => {
  const Language = useSelector((state) => state.languageMode.languageMode)
  const direction = Language === "en" ? "ltr" : "rtl"
  const fontFamily = "cairo, sans-serif"
  const location = useLocation()
  const {loading} = useAuthContext()
  const [isMobile, setIsMobile] = useState(false)

  useEffect(() => {
    const isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent)

    setIsMobile(isMobile)
  }, [])

  const showHeader = ![
    "/policies",
    "/login-trial",
    "/privacy",
    "/site-editor/restaurants",
    "/site-editor/customers",
  ].includes(location.pathname)
  const showFooter = ![
    "/",
    "/cart",
    "/site-editor/restaurants",
    "/site-editor/customers",
    "/login",
    "/login-admins",
    "/login-trial",
    "/register",
    "/register/:url",
    "/reset-password",
    "/create-new-password",
    "/verification-phone",
    "/policies",
    "/privacy",
  ].includes(location.pathname)

  Aos.init({
    duration: 1000,
    offset: 0,
  })

  if (loading) {
    return
  }

  return (
    <MenuProvider
      MenuComponent={OuterSidebarNav}
      direction={Language == "en" ? "left" : "right"}
      animation={"slide"} // 'slide' │ 'push' │ 'reveal'
      width={isMobile ? "80vw" : "25vw"}
    >
      <div
        className='relative '
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
          <ToastContainer theme='colored' />{" "}
          {showHeader && <NavbarRestuarant />} {/*<Supports />*/} <ScrollUp />
          <div>
            <Routes>
              {" "}
              {/* Public Routes */}{" "}
              <Route path='/' element={<RestuarantHomePage />} />{" "}
              <Route path='/logout' element={<Logout />} />{" "}
              <Route path='/reset-password' element={<ForgotPassword />} />{" "}
              <Route
                path='/create-new-password'
                element={<Protected Cmp={CreateNewPassword} />}
              />
              <Route path='/policies' element={<TermsPolicies />} />{" "}
              <Route path='/privacy' element={<Privacy />} />{" "}
              {/*<Route path='/advantages' element={<Advantages />} />*/}{" "}
              {/*<Route path='/services' element={<Services />} />*/}{" "}
              {/*<Route path='/prices' element={<Prices />} />*/}{" "}
              {/*<Route path='/fqa' element={<FQA />} />*/}{" "}
              <Route path='/login-trial' element={<LoginTrial />} />{" "}
              <Route element={<Layout />}>
                <Route path='/login' element={<Login />} />{" "}
                <Route path='/register' element={<Register />} />{" "}
                <Route path='/login-admins' element={<LoginAdmin />} />{" "}
              </Route>{" "}
              {/*Editor*/}{" "}
              <Route element={<PrivateRoute />}>
                <Route
                  path='/verification-phone'
                  element={<VerificationPhone />}
                />{" "}
                <Route path='/site-editor' element={<EditorSwitcher />} />{" "}
                <Route path='/cart' element={<CartPage />} />{" "}
                <Route
                  path='/site-editor/restaurants'
                  element={<RestuarantEditor />}
                />{" "}
                {/* <Route
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      path='/site-editor/restaurants'
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      element={<EditorPage />}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    />{" "} */}{" "}
                {/*/site-editor/customers/preview*/}{" "}
                <Route path='/dashboard' element={<CustomersPreview />} />{" "}
                <Route
                  path='/site-editor/customers'
                  element={<CustomerPage />}
                />{" "}
                {/* <Route path='/customers' element={<CustomerPage />} />{" "} */}{" "}
              </Route>{" "}
            </Routes>{" "}
          </div>{" "}
          {showFooter && !loading && (
            <div className='p-[30px] pt-[60px] max-md:px-[5px] max-md:py-[40px] '>
              <Footer />
            </div>
          )}{" "}
        </div>{" "}
      </div>{" "}
    </MenuProvider>
  )
}

export default App
