import React from 'react'
import './App.css'
import { Routes, Route, useLocation } from 'react-router-dom'
import { useSelector } from 'react-redux'
import { ToastContainer } from 'react-toastify'
import Footer from './components/Footer/Footer'
import Login from './pages/LoginSignUp/Login'
import LoginAdmin from './pages/LoginSignUp/LoginAdmin'
import LoginTrial from './pages/LoginSignUp/LoginTrial'
import Register from './pages/LoginSignUp/Register'
import VerificationPhone from './pages/LoginSignUp/VerificationPhone'
import Supports from './components/Supports'
import ScrollUp from './components/ScrollUp'
import Aos from 'aos'
import 'aos/dist/aos.css'
import ForgotPassword from './pages/LoginSignUp/ForgotPassword'
import CreateNewPassword from './pages/LoginSignUp/CreateNewPassword'
import EditorPage from './pages/EditorPage'
import CustomersPreview from './components/Customers/CustomersPreview/Preview'
import EditorSwitcher from './pages/EditorSwitcher'
import Protected from './Protected'
import PrivateRoute from './components/PrivateRoute/PrivateRoute'
import Layout from './components/Layout/Layout'
import Logout from './components/Logout/Logout'
import { useAuthContext } from './components/context/AuthContext'
import TermsPolicies from "../../landing-page/src/pages/TermsPoliciesPrivacy/TermsPolicies";
import Privacy from "../../landing-page/src/pages/TermsPoliciesPrivacy/Privacy";
import Cart from "./components/Cart/Cart";
import RestaurantHomePage from "./components/Restaurants/RestaurantsPreview/RestaurantHomePage";
import Header from "./components/Restaurants/RestaurantsPreview/components/header";
import {SideMenu} from "./components/SideMenu";
import MenuProvider from 'react-flexible-sliding-menu';

const App = () => {
   const Language = useSelector((state) => state.languageMode.languageMode)
   const direction = Language === 'en' ? 'ltr' : 'rtl'
   const fontFamily = 'cairo, sans-serif'
   const location = useLocation()
   const { loading } = useAuthContext()
   const showHeader = ![
       '/policies',
       '/login-trial',
       '/privacy'].includes(
      location.pathname
   );
   const showFooter = ![
       '/',
       '/site-editor/restaurants',
       '/site-editor/customers',
      '/login',
      '/login-trial',
       '/register',
       '/register/:url',
      '/reset-password',
      '/create-new-password',
      '/verification-phone',
      '/policies',
      '/privacy',
   ].includes(location.pathname)

   Aos.init({
      duration: 1000,
      offset: 0,
   });

   if (loading) {
       return;
   }


   return (
       <MenuProvider MenuComponent={SideMenu}
                     direction={Language == 'en' ? 'left' : 'right'}
                     animation={'push'} // 'slide' │ 'push' │ 'reveal'
                     width={'250px'}

       >
          <div
             className='relative'
             style={{
                '::selection': {
                   backgroundColor: '#000000',
                   color: '#ffffff',
                },
                direction,
                fontFamily,
             }}
          >
             <div>
                <ToastContainer theme='colored'/>
                {showHeader && <Header />}
                <Supports />
                <ScrollUp />
                <div>
                   <Routes>
                      {/* Public Routes */}
                      <Route path='/' element={<RestaurantHomePage />} />
                      <Route path='/logout' element={<Logout />} />
                      <Route
                         path='/reset-password'
                         element={<ForgotPassword  />}
                      />
                      <Route
                         path='/create-new-password'
                         element={<Protected Cmp={CreateNewPassword} />}
                      />

                       <Route path='/policies' element={<TermsPolicies />} />
                       <Route path='/privacy' element={<Privacy />} />
                       {/*<Route path='/advantages' element={<Advantages />} />*/}
                       {/*<Route path='/services' element={<Services />} />*/}
                       {/*<Route path='/prices' element={<Prices />} />*/}
                       {/*<Route path='/fqa' element={<FQA />} />*/}
                       <Route path='/login-trial' element={<LoginTrial />} />

                       <Route element={<Layout />}>
                         <Route path='/login' element={<Login />} />
                         <Route path='/register' element={<Register />} />
                         <Route path='/login-admins' element={<LoginAdmin />} />
                      </Route>

                      {/*Editor*/}
                      <Route element={<PrivateRoute />}>
                         <Route
                            path='/verification-phone'
                            element={<VerificationPhone />}
                         />
                         <Route path='/site-editor' element={<EditorSwitcher />} />

                          <Route path='/cart' element={<Cart />} />

                          <Route
                            path='/site-editor/restaurants'
                            element={<EditorPage />}
                         />
                          {/*/site-editor/customers/preview*/}
                         <Route
                            path='/dashboard'
                            element={<CustomersPreview />}
                         />
                         <Route
                            path='/site-editor/customers'
                            element={<EditorPage />}
                         />
                      </Route>
                   </Routes>
                </div>
                {showFooter && !loading && (
                   <div className='p-[30px] pt-[60px] max-md:px-[5px] max-md:py-[40px] '>
                      <Footer />
                   </div>
                )}
             </div>
          </div>
       </MenuProvider>
   )
}

export default App
