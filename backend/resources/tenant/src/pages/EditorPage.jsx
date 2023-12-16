import React, { useState, useEffect } from 'react'
import RestaurantsEditor from '../components/Restaurants/RestaurantsEditor/Editor'
import CustomersEditor from '../components/Customers/CustomersEditor/Editor'
import Header from '../components/Header/Header'
import Sidebar from '../components/Sidebar/Sidebar'
import { MdSettings } from 'react-icons/md'
import { FaTimes } from 'react-icons/fa'
import { useSelector } from 'react-redux'
import { useLocation, useParams } from 'react-router-dom'

const EditorPage = () => {
   const [isOpen, setOpen] = useState(false)
   const [template, setTemplate] = useState('')
   const toggleDrawer = () => {
      setOpen(!isOpen)
   }
   const [position, setPosition] = useState('static')
   const screenSize = useSelector((state) => state.ui.screenSize)
   const location = useLocation()
   const { branch_id } = useParams()
   useEffect(() => {
      const handleResize = () => {
         if (window.innerWidth <= 1200) {
            setPosition('absolute')
         } else {
            setPosition('static')
         }
      }
      window.addEventListener('resize', handleResize)
      handleResize()
      return () => {
         window.removeEventListener('resize', handleResize)
      }
   }, [])
   useEffect(() => {
      if (location.pathname === `/site-editor/restaurants`) {
         setTemplate('restaurants')
      }
      if (location.pathname === `/site-editor/customers`) {
         setTemplate('customers')
      }
      console.log('entered editorPage')
   }, [location.pathname])

   return (
      <div className='flex overflow-x-hidden'>
             {position === 'absolute' ? (
            <div className={`fixed gap-2 z-[99999999999]`}>
               <div className={`fixed top-0 w-[100%]`}>
                  {/*<Header />*/}
               </div>
               <button
                  onClick={toggleDrawer}
                  className={`fixed top-[25%] left-0 bg-[var(--primary)] p-[10px] pl-[6px] rounded-r-lg transition-transform duration-300 transform ${
                     isOpen ? 'translate-x-64' : 'translate-x-0'
                  }`}
               >
                  {isOpen ? (
                     <FaTimes className='text-white text-2xl' />
                  ) : (
                     <MdSettings className='text-white text-2xl transition-all hover:rotate-180 duration-300' />
                  )}
               </button>
               <div
                  className={`shadow-xl drawer fixed top-0 left-0 w-64 h-full transition-transform duration-300 transform  ${
                     isOpen ? 'translate-x-0' : '-translate-x-full'
                  } z-[9999999]`}
               >
                  <Sidebar />
               </div>
            </div>
         ) : (
            <>
               <div className={`fixed top-0 w-[100%]`}>
                  {/*<Header />*/}
               </div>
               <Sidebar />
            </>
         )}
         <div className={`editor bg-[var(--secondary)] w-[100%]`}>
            <div className={`flex justify-center`}>
               <div
                  className={`${
                     screenSize === 'desktop'
                        ? 'w-[100%]'
                        : screenSize === 'mobile'
                        ? 'w-[30%]'
                        : 'w-[60%]'
                  } m-6 mt-[85px] rounded-[10px]`}
               >
                  {template === 'restaurants' && <RestaurantsEditor />}
                  {template === 'customers' && <CustomersEditor />}
               </div>
            </div>
         </div>
      </div>
   )
}

export default EditorPage
