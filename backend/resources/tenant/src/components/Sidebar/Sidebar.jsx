import React, { useState, useEffect } from 'react'
import { Taps, Tap } from '../Taps'
import Section from './Section'
import Edit from './Edit'
import { useTranslation } from 'react-i18next'
import {Link, useLocation, useParams} from 'react-router-dom'
import {toast} from "react-toastify";
import AxiosInstance from "../../axios/axios";
import {useSelector} from "react-redux";

const Sidebar = () => {
   const [position, setPosition] = useState('static')
   const { branch_id } = useParams()
   const location = useLocation()
   const { t } = useTranslation()
   const [template, setTemplate] = useState('')

    const state = useSelector((state) => state);


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

    const handleSaveStyle = async (e) => {
       e.preventDefault();

       console.log("action save style");

       console.log(state);
       console.log(template);

  


       let inputs = {};
       if (template === 'restaurants')
        {
            inputs.logo = (state?.logo)?await fetch(state?.logo).then(r => r.blob()):'';
            inputs.logo_alignment = state?.align?.selectedAlign;
            inputs.category_style = state?.category?.selectedCategory;
            inputs.banner_style = state?.banner?.selectedBanner;
            inputs.social_medias = state?.contact?.icons;
            inputs.phone_number = state?.contact?.phoneNumber;
            inputs.primary_color = state?.button?.GlobalColor;
            inputs.buttons_style = state?.button?.GlobalShape;
            inputs.images_style= state?.shapeImage?.shapeImageShape;
            inputs.font_family= state?.fonts?.selectedFontFamily;
            inputs.font_type= state?.fonts?.selectedFontWeight;
            inputs.font_size= state?.fonts?.selectedFontSize;
            inputs.font_alignment= state?.alignText?.selectedAlignText;
            inputs.right_side_button= state?.button?.buttons[0];
            inputs.center_side_button= state?.button?.buttons[1];
            inputs.left_side_button= state?.button?.buttons[2];
            inputs.banner_image = (state?.image)?await fetch(state?.image).then(r => r.blob()):'';
            if (state?.images?.image && state?.images?.image.length > 0) {
               const imagePromises = state?.images?.image.map(async (image) => {
                  return await fetch(image).then(r => r.blob());;
               });
               inputs.banner_images  =await Promise.all(imagePromises);
            } else {
               inputs.banner_images = '';
            }
            try {
               const response = await AxiosInstance.post(`restaurant-style`,inputs,{
                  headers: {
                     'Content-Type': 'multipart/form-data',
                  }
               })
            if (response) {
               toast.success(response.data.message);
            }
            } catch (error) {
               console.log(error.response.data.message);
               toast.error(error.response?.data?.message);
            }

         } else if (template === 'customers') 
         {
            inputs.primary_color = state?.button?.GlobalColor;
            inputs.buttons_style = state?.button?.GlobalShape;
            inputs.images_style= state?.shapeImage?.shapeImageShape;
            inputs.font_family= state?.fonts?.selectedFontFamily;
            inputs.font_type= state?.fonts?.selectedFontWeight;
            inputs.font_size= state?.fonts?.selectedFontSize;
            inputs.font_alignment= state?.alignText?.selectedAlignText;
            
      
            try {
               const response = await AxiosInstance.post(`customer-style`,inputs);
               if (response) {
                  toast.success(response.data.message);
               }
            } catch (error) {
                  console.log(error.response.data.message);
                  toast.error(error.response?.data?.message);
            }
         } else {
            toast.error(`Invalid save style action, template not set`);
            return;
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
                    <Link className={"flex border-[red] justify-center content-center bg-[var(--primary)] w-[50%]"} to={"./preview"} target={"_blank"} href={"./preview"}>Preview</Link>
                    <Link className={"flex justify-center content-center bg-[var(--primary)] w-[50%]"} onClick={handleSaveStyle}>Save</Link>
                </div>
            </>
         )}
         {template === 'customers' && (
            <>
            <Taps contentClassName='bg-[#ffffff15] w-[100%] !justify-start !px-6'>
               <Tap component={<Edit />} contentClassName='!px-[0px]' active key={"a1"}>
                  {t('Edit')}
               </Tap>
               <Tap key={"a2"}/>
            </Taps>
               <div className={"flex  justify-around w-[100%]"}>
                     <Link className={"flex border-[red] justify-center content-center bg-[var(--primary)] w-[50%]"} to={"./preview"} target={"_blank"} href={"./preview"}>Preview</Link>
                     <Link className={"flex justify-center content-center bg-[var(--primary)] w-[50%]"} onClick={handleSaveStyle}>Save</Link>
               </div>
            </>
         )}
      </div>
   )
}

export default Sidebar
