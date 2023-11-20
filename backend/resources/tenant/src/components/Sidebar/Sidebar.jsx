import React, { useState, useEffect } from 'react'
import { Taps, Tap } from '../Taps'
import Section from './Section'
import Edit from './Edit'
import { useTranslation } from 'react-i18next'
import {Link, useLocation, useParams} from 'react-router-dom'
import {toast} from "react-toastify";
import AxiosInstance from "../../axios/axios";

const Sidebar = () => {
   const [position, setPosition] = useState('static')
   const { branch_id } = useParams()
   const location = useLocation()
   const { t } = useTranslation()
   const [template, setTemplate] = useState('')

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
   }, [location.pathname])

    const handleSaveStyle = async () => {

       console.log("action save style");

       let inputs = {};
       if (template === 'restaurants') {
           inputs.

       } else if (template === 'customers') {

       } else {
           toast.error(`Invalid save style action, template not set`);
           return;
       }

        try {
            const response = await AxiosInstance.post(`api/categories?items&user&branch`, {
                ...inputs
            })

            console.log(response)
            if (response.data) {
                const responseData = await response.json()
                console.log(responseData)


                setBranch(data);

            } else {
            }
        } catch (error) {
            // toast.error(`${t('Failed to send verification code')}`)
            console.log(error);
        }
    };

   return (
      <div
         position={position}
         className={`bg-white !text-black ${
            position === 'static'
               ? '!min-w-[18%] !max-w-[18%] pt-[100px]'
               : 'pt-[20px]'
         }  text-white text-xl h-[100vh] overflow-y-auto shadow-md`}
      >
         {template === 'restaurants' && (
            <>
                <Taps contentClassName='bg-[#ffffff15] w-[100%]'>
                   <Tap component={<Section />} active key={'t1'}>
                      {t('Section')}
                   </Tap>
                   <Tap component={<Edit />}  key={'t2'}>{t('Edit')}</Tap>
                </Taps>
                <div className={"flex  justify-around w-[100%]"}>
                    <Link className={"flex border-[red] justify-center content-center bg-[var(--primary)] w-[50%]"} to={"/preview"} target={"_blank"} href={"/preview"}>Preview</Link>
                    <Link className={"flex justify-center content-center bg-[var(--primary)] w-[50%]"} onClick={handleSaveStyle}>Save</Link>
                </div>
            </>
         )}
         {template === 'customers' && (
            <Taps contentClassName='bg-[#ffffff15] w-[100%] !justify-start !px-6'>
               <Tap component={<Edit />} contentClassName='!px-[0px]' active key={"a1"}>
                  {t('Edit')}
               </Tap>
               <Tap key={"a2"}/>
            </Taps>
         )}
      </div>
   )
}

export default Sidebar
