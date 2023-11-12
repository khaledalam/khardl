import React, { useState, useEffect } from 'react'
import Logo from '../../assets/Logo.webp'
import { Link, useNavigate } from 'react-router-dom'
import Button from '../Button'
import Li from './Li'
import { useSelector, useDispatch } from 'react-redux'
import { setActiveLink } from '../../redux/features/linkSlice'
import { setIsOpen } from '../../redux/features/drawerSlice'
import { useLocation } from 'react-router-dom'
import { useTranslation } from 'react-i18next'
import Languages from '../Languages'

import {getIsLoggedIn, logout} from '../../redux/auth/authSlice'
import { useAuthContext } from '../context/AuthContext'
// import Axios from '../../axios/axios'
import { toast } from 'react-toastify'

const Header = () => {
   const [isMobile, setIsMobile] = useState(false)
   const dispatch = useDispatch()
   const location = useLocation()
   const { t } = useTranslation()
   const isOpen = useSelector((state) => state.drawer.isOpen)
   const Language = useSelector((state) => state.languageMode.languageMode)


    const isLoggedIn = getIsLoggedIn();
   // const status = useSelector((state) => state.auth.status)
   const navigate = useNavigate()
   const { setStatusCode } = useAuthContext()

    console.log("isLoggedIn > ", isLoggedIn);

    const redirectToDashboard = () => {
      // Redirect to an external URL (window.location.href)
      window.open('/dashboard', '_blank');
    };
   const handleLogout = async (e) => {
      e.preventDefault()
      // try {
      //    dispatch(logout({ method: 'POST' }))
      //    // dispatch(changeLogState(false))
      //    dispatch(setIsOpen(false))
      //    navigate('/login')
      //    toast.success('Logged out successfully') //toast.success(`${t("Logged out successfully")}`)
      // } catch (err) {
      //    console.error(err.message)
      //    toast.error('Logout failed') // toast.error(`${t("Login failed")}`)
      // }

      try {
         await dispatch(logout({ method: 'POST' })).unwrap()
         setStatusCode(401)
         navigate('/login', { replace: true })
         toast.success(`${t('You have been logged out successfully')}`)
      } catch (err) {
         console.error(err.message)
         toast.error(`${t('Logout failed')}`)
      }
      dispatch(setIsOpen(false))
   }

   const toggleMenu = () => {
      dispatch(setIsOpen(!isOpen))
   }

   const closeDrawerHandler = () => {
      dispatch(setIsOpen(false))
   }

   const activeLink = useSelector((state) => state.link.activeLink)
   const handleCheckboxChange = (event) => {
      dispatch(setIsOpen(event.target.checked))
   }
   const handleLinkClick = (link) => {
      dispatch(setActiveLink(link))
   }

   useEffect(() => {
      dispatch(setActiveLink(location.pathname))
   }, [location.pathname, dispatch, isLoggedIn])

   useEffect(() => {
      const handleResize = () => {
         const isMobile = window.innerWidth <= 1000
         setIsMobile(!isMobile)
      }

      handleResize()

      window.addEventListener('resize', handleResize)

      return () => {
         window.removeEventListener('resize', handleResize)
      }
   }, [])

   return (
      <nav className={`fixed gap-2 z-[9998] w-[100%] bg-white`}>
         <div className='mx-auto flex items-center justify-between px-12 max-xl:px-4 py-2 '>
            <div className='min-[1000px]:hidden'>
               <label
                  className={`hamburger ${
                     isOpen ? 'absolute top-[20px] z-[999999999]' : ''
                  }`}
                  style={{ stroke: '#000000' }}
               >
                  <input
                     type='checkbox'
                     checked={isOpen}
                     onClick={toggleMenu}
                     onChange={handleCheckboxChange}
                  />
                  <svg viewBox='0 0 32 32'>
                     <path
    className='line line-top-bottom'
    d='M27 10 13 10C10.8 10 9 8.2 9 6 9 3.5 10.8 2 13 2 15.2 2 17 3.8 17 6L17 26C17 28.2 18.8 30 21 30 23.2 30 25 28.2 25 26 25 23.8 23.2 22 21 22L7 22'
    />
                     <path className='line' d='M7 16 27 16'/>
                  </svg>
               </label>
            </div>
            <div className='flex justify-start items-center'>
               <Link to='/' className='flex justify-start items-center gap-2'>
                  <img
                     className={`w-[43px]`}
                     src={Logo}
                     alt='logo-img'
                     loading='lazy'
                  />
               </Link>
            </div>
            <div className='hidden min-[1000px]:flex'>
               <ul className='flex space-x-8'>
                  <Li
                     link='/'
                     handleLinkClick={handleLinkClick}
                     close={closeDrawerHandler}
                     title={t('Home')}
                     activeLink={activeLink}
                     className='ml-6'
                  />
                 
               </ul>
            </div>
            {isMobile && (
               <div className='flex justify-center items-center gap-2'>
                  <Languages />
                  <div className='relative flex justify-center items-center gap-2 min-[1000px]:flex min-[1000px]:justify-center'>
                     {isLoggedIn ? (
                        <>
                        <Button
                           title={t('Logout')}
                           onClick={handleLogout}
                           classContainer='!text-[16px] !px-[16px] !py-[6px] !font-medium !bg-[var(--danger)] !text-white'
                        />
                        <Button
                              onClick={redirectToDashboard}
                              title={t('Dashboard')}
                              classContainer='!text-[16px] !px-[16px] !py-[6px] !font-medium '
                           />
                        </>
                     ) : (
                        <>
                           <Button
                              title={t('Create an account')}
                              link='/register'
                              onClick={() => dispatch(setIsOpen(false))}
                              classContainer='!text-[16px] !px-[16px] !py-[6px]'
                           />
                           <Button
                              title={t('Login')}
                              link='/login'
                              onClick={() => dispatch(setIsOpen(false))}
                              classContainer='!text-[16px] !px-[16px] !py-[6px] !font-medium '
                           />
                        </>
                     )}
                  </div>
               </div>
            )}
         </div>
         <div
            style={{
               backgroundColor: '#ffffff',
               backgroundSize: 'cover',
               boxShadow: '0px 2px 8px rgba(0, 0, 0, 0.2)',
            }}
            className={`drawer flex flex-col justify-center items-start fixed top-0 ${
               Language === 'en' ? 'left-0' : 'right-0'
            } w-[280px] min-h-[100%] transition-transform duration-300 transform  ${
               isOpen
                  ? Language === 'en'
                     ? '-translate-x-0'
                     : 'translate-x-0'
                  : Language === 'en'
                  ? '-translate-x-full'
                  : 'translate-x-full'
            }`}
         >
            <div className='p-4 w-full h-full text-[20px]'>
               <div className='p-4 ps-8'>
                  <ul className='space-y-4'>
                     <Li
                        link='/'
                        handleLinkClick={handleLinkClick}
                        close={closeDrawerHandler}
                        title={t('Home')}
                        activeLink={activeLink}
                     />
                    
                  </ul>
                  <div className='mt-6 w-[100%]'>
                     <Languages />
                     <div className='relative flex flex-col items-center gap-2 justify-center mt-4'>
                        {isLoggedIn ? (
                           <Button
                              title={t('Logout')}
                              onClick={handleLogout}
                              classContainer='!w-100 !px-[16px] !font-medium'
                           />
                        ) : (
                           <>
                              <Button
                                 title={t('Create an account')}
                                 link='/register'
                                 onClick={() => dispatch(setIsOpen(false))}
                                 classContainer='!w-100 !px-[25px]'
                              />
                              <Button
                                 title={t('Login')}
                                 link='/login'
                                 onClick={() => dispatch(setIsOpen(false))}
                                 classContainer='!w-100 !px-[16px] !font-medium'
                              />
                           </>
                        )}
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </nav>
   )
}

export default Header
