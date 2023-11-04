import React from 'react'
import './App.css'
import { Routes, Route, useLocation } from 'react-router-dom'
import { useSelector } from 'react-redux'
import { ToastContainer } from 'react-toastify'
import Header from './components/Header/Header'
import Footer from './components/Footer/Footer'
import Home from './pages/Home/Home'
import Advantages from './pages/Advantages/Advantages'
import Clients from './pages/Clients/clients'
import Services from './pages/Services/services'
import FQA from './pages/FQA/fqa'
import Login from './pages/LoginSignUp/Login'
import Register from './pages/LoginSignUp/Register'
import CompleteRegistration from './pages/LoginSignUp/CompleteRegistration'
import VerificationEmail from './pages/LoginSignUp/VerificationEmail'
import TermsPolicies from './pages/TermsPoliciesPrivacy/TermsPolicies'
import Privacy from './pages/TermsPoliciesPrivacy/Privacy'
import Supports from './components/Supports'
import ScrollUp from './components/ScrollUp'
import Prices from './pages/Prices/prices'
import Aos from 'aos'
import 'aos/dist/aos.css'
import ForgotPassword from './pages/LoginSignUp/ForgotPassword'
import CreateNewPassword from './pages/LoginSignUp/CreateNewPassword'
import { API_URL } from './pages/context'
import EditorPage from './pages/EditorPage'
import ResturentsPreview from './components/Resturents/ResturentsPreview/Preview'
import CustomersPreview from './components/Customers/CustomersPreview/Preview'
import EditorSwitcher from './pages/EditorSwitcher'
import Protected from './Protected'

import PrivateRoute from './components/PrivateRoute/PrivateRoute'
import Layout from './components/Layout/Layout'

const App = () => {
   const Language = useSelector((state) => state.languageMode.languageMode)
   const direction = Language === 'en' ? 'ltr' : 'rtl'
   const fontFamily = 'cairo, sans-serif'
   const location = useLocation()
   const showHeader = !['/switcher', '/policies', '/privacy'].includes(
      location.pathname
   )
   const showFooter = ![
      '/switcher',
      '/login',
      '/register',
      '/reset-password',
      '/create-new-password',
      '/verification-email',
      '/complete-register',
      '/policies',
      '/privacy',
   ].includes(location.pathname)
   const apiUrl = process.env.REACT_APP_API_URL

   Aos.init({
      duration: 1000,
      offset: 0,
   })

   return (
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
            <ToastContainer theme='colored'></ToastContainer>
            {showHeader && <Header />}
            <Supports />
            <ScrollUp />
            <div>
               <API_URL.Provider value={apiUrl}>
                  <Routes>
                     <Route path='/' element={<Home />} />
                     <Route
                        path='/reset-password'
                        element={<Protected Cmp={ForgotPassword} />}
                     />
                     <Route
                        path='/create-new-password'
                        element={<Protected Cmp={CreateNewPassword} />}
                     />

                     <Route element={<Layout />}>
                        <Route path='/login' element={<Login />} />
                        <Route path='/register' element={<Register />} />
                     </Route>

                     {/* <Route path='/policies' element={<TermsPolicies />} />
                     <Route path='/privacy' element={<Privacy />} />
                     <Route path='/advantages' element={<Advantages />} />
                     <Route path='/clients' element={<Clients />} />
                     <Route path='/services' element={<Services />} />
                     <Route path='/prices' element={<Prices />} />
                     <Route path='/fqa' element={<FQA />} /> */}

                     {/*Editor*/}
                     <Route element={<PrivateRoute />}>
                        <Route
                           path='/complete-register'
                           element={<CompleteRegistration />}
                        />
                        <Route
                           path='/verification-email'
                           element={<VerificationEmail />}
                        />
                        <Route path='/switcher' element={<EditorSwitcher />} />

                        <Route
                           path='/restaurants/:branch_id'
                           element={<EditorPage />}
                        />
                        <Route
                           path='/restaurants/:branch_id/Preview'
                           element={<ResturentsPreview />}
                        />
                        <Route
                           path='/customers/:branch_id'
                           element={<EditorPage />}
                        />
                        <Route
                           path='/customers/:branch_id/Preview'
                           element={<CustomersPreview />}
                        />
                     </Route>
                  </Routes>
               </API_URL.Provider>
            </div>
            {showFooter && (
               <div className='p-[30px] pt-[60px] max-md:px-[5px] max-md:py-[40px] '>
                  <Footer />
               </div>
            )}
         </div>
      </div>
   )
}

export default App
