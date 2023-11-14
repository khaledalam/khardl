import React, { useState } from 'react'
import Logo from '../../assets/Logo.webp'
import ContactUsCover from '../../assets/ContactUsCover.webp'
import { useTranslation } from 'react-i18next'
import { useNavigate } from 'react-router-dom'
import { useForm } from 'react-hook-form'
import { toast } from 'react-toastify'
import { useSelector } from 'react-redux'
import { AiFillEye, AiFillEyeInvisible } from 'react-icons/ai'
import {API_ENDPOINT, PREFIX_KEY} from "../../config";
import AxiosInstance from "../../axios/axios";

const CreateNewPassword = () => {
   const { t } = useTranslation()
   const navigate = useNavigate()
   const {
      register,
      handleSubmit,
      formState: { errors },
   } = useForm()
   const [openEyePassword, setOpenEyePassword] = useState(false)
   const [openEyeRePassword, setOpenEyeRePassword] = useState(false)
   const Language = useSelector((state) => state.languageMode.languageMode)
   let user_email = sessionStorage.getItem(PREFIX_KEY + 'email')

   const EyePassword = () => {
      setOpenEyePassword(!openEyePassword)
   }
   const EyeRePassword = () => {
      setOpenEyeRePassword(!openEyeRePassword)
   }

   // **API POST REQUEST**
   const onSubmit = async (data) => {
      try {
         const response = await AxiosInstance.post(`/password/reset`, {
             email: user_email,
             password: data.password,
             c_password: data.confirm_password,
             token: data.token
         })
         if (response.data) {
            const responseData = await response.json()
            console.log(responseData)
            sessionStorage.removeItem(PREFIX_KEY + 'email')
            navigate('/login')
            toast.success(`${t('The password has been reset successfully')}`)
         } else {
            throw new Error(`${t('Password reset failed')}`)
         }
      } catch (error) {
         toast.error(`${t('Password reset failed')}`)
      }
   }

   ///////////////////**return state**/////////////////////////////
   return (
      <div className='flex flex-col items-stretch justify-center pt-[40px]'>
         <div
            className='flex justify-center items-center px-[40px] max-md:px-[0px]'
            style={{
               backgroundImage: `url(${ContactUsCover})`,
               backgroundSize: 'cover',
            }}
         >
            <div className='py-[20px] flex justify-center items-center'>
               <div className='py-[80px] max-md:py-[60px]'>
                  <div className='max-[860px]:w-[80vw] w-[450px] bg-white py-10 max-[860px]:px-2 shadow-lg rounded-2xl'>
                     <div className='px-8 mb-4 flex flex-col items-center text-center'>
                        <img src={Logo} className='w-[80px]' alt='logo' />
                        <h3 className='pt-6 text-md font-bold'>
                           {t('New Password')}
                        </h3>
                     </div>
                     <form
                        onSubmit={handleSubmit(onSubmit)}
                        className='px-8 pb-2 bg-white rounded'
                     >
                        <div className='mb-6 text-center'>
                           <div className='mb-4 text-center'>
                              <label
                                 className='block mb-2 text-sm text-start font-bold text-gray-700'
                                 htmlFor='email'
                              >
                                 {t('Enter the code sent to you')}
                              </label>
                              {/* Input 1 */}
                              <input
                                 type='email'
                                 className={`hidden w-[100%] mt-0 p-[10px] px-[16px] max-[540px]:py-[15px] boreder-none rounded-full bg-[var(--third)]`}
                                 value={user_email}
                                 {...register('email', { required: true })}
                              />
                              {/* Input 2 */}
                              <input
                                 type='text'
                                 className={`w-[100%] mt-0 p-[10px] px-[16px] max-[540px]:py-[15px] boreder-none rounded-full bg-[var(--third)]`}
                                 placeholder={t('Validation code')}
                                 {...register('token', { required: true })}
                              />
                              {errors.token && (
                                 <span className='text-red-500 text-xs mt-1 ms-2'>
                                    {t('Validation code Error')}
                                 </span>
                              )}
                           </div>

                           {/* Input 3 */}
                           <div className='relative'>
                              <h4 className='mb-2 ms-2 text-[13px] text-start font-semibold'>
                                 {t('Password')}
                              </h4>
                              <input
                                 type={
                                    openEyePassword === false
                                       ? 'password'
                                       : 'text'
                                 }
                                 className={`w-[100%] mt-0 p-[10px] px-[16px] max-[540px]:py-[15px] boreder-none rounded-full bg-[var(--third)]`}
                                 placeholder={t('password')}
                                 {...register('password', { required: true })}
                              />
                              {errors.password && (
                                 <span className='text-red-500 text-xs mt-1 ms-2'>
                                    {t('Password Error')}
                                 </span>
                              )}
                              <div
                                 className={`text-2xl absolute top-[38px] ${
                                    Language === 'en' ? 'right-5' : 'left-5'
                                 }`}
                              >
                                 {openEyePassword === false ? (
                                    <AiFillEye
                                       onClick={EyePassword}
                                       className='text-[var(--primary)] cursor-pointer'
                                    />
                                 ) : (
                                    <AiFillEyeInvisible
                                       onClick={EyePassword}
                                       className='text-[var(--primary)] cursor-pointer'
                                    />
                                 )}
                              </div>
                           </div>

                           {/* Input 4 */}
                           <div className='relative mt-4'>
                              <h4 className='mb-2 ms-2 text-[13px] text-start font-semibold'>
                                 {t('Reset password')}
                              </h4>
                              <input
                                 type={
                                    openEyeRePassword === false
                                       ? 'password'
                                       : 'text'
                                 }
                                 className={`w-[100%] mt-0 p-[10px] px-[16px] max-[540px]:py-[15px] boreder-none rounded-full bg-[var(--third)]`}
                                 placeholder={t('Reset password')}
                                 {...register('confirm_password', {
                                    required: true,
                                 })}
                              />
                              {errors.confirm_password && (
                                 <span className='text-red-500 text-xs mt-1 ms-2'>
                                    {t('Reset password Error')}
                                 </span>
                              )}
                              <div
                                 className={`text-2xl absolute top-[38px] ${
                                    Language === 'en' ? 'right-5' : 'left-5'
                                 }`}
                              >
                                 {openEyeRePassword === false ? (
                                    <AiFillEye
                                       onClick={EyeRePassword}
                                       className='text-[var(--primary)] cursor-pointer'
                                    />
                                 ) : (
                                    <AiFillEyeInvisible
                                       onClick={EyeRePassword}
                                       className='text-[var(--primary)] cursor-pointer'
                                    />
                                 )}
                              </div>
                           </div>
                        </div>
                        <div className='text-center'>
                           <button
                              type='submit'
                              className={`hover:bg-[#d6eb16] w-fit font-bold bg-[var(--primary)] rounded-full transition-all delay-100  py-2 px-6 text-[15px]`}
                           >
                              {t('Password Reset')}
                           </button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   )
}

export default CreateNewPassword
