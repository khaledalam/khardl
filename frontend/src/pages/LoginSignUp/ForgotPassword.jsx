import React from 'react'
import Logo from '../../assets/Logo.webp'
import ContactUsCover from '../../assets/ContactUsCover.webp'
import { useTranslation } from 'react-i18next'
import { useNavigate } from 'react-router-dom'
import { useForm } from 'react-hook-form'
import { toast } from 'react-toastify'
import { useApiContext } from '../context'

const ForgotPassword = () => {
   const { t } = useTranslation()
   const navigate = useNavigate()
   const {
      register,
      handleSubmit,
      formState: { errors },
   } = useForm()
   const apiUrl = useApiContext()

   // **API POST REQUEST**
   const onSubmit = async (data) => {
      try {
         const response = await fetch(`${apiUrl}/password/forgot`, {
            method: 'POST',
            headers: {
               'Content-Type': 'application/json',
               Accept: 'application/json',
               'X-CSRF-TOKEN': window.csrfToken,
            },
            body: JSON.stringify({
               email: data.email,
            }),
         })
         if (response.ok) {
            const responseData = await response.json()
            console.log(responseData)
            sessionStorage.setItem('email', data.email)
            navigate('/create-new-password')
            toast.success(
               `${t('The verification code has been sent to your email')}`
            )
         } else {
            throw new Error(`${t('Failed to send verification code')}`)
         }
      } catch (error) {
         toast.error(`${t('Failed to send verification code')}`)
      }
   }
   /////////////////////////////////////////////////////////////////////////////////////

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
                     <div className='px-8 mb-6 flex flex-col items-center text-center'>
                        <img src={Logo} className='w-[80px]' alt='logo' />
                        <h3 className='pt-8 mb-3 text-md font-bold'>
                           {t('Forgot your password?')}
                        </h3>
                        <p className='text-sm text-gray-700'>
                           {t('Reset Text')}
                        </p>
                     </div>
                     <form
                        onSubmit={handleSubmit(onSubmit)}
                        className='px-8 pt-2 pb-2 bg-white rounded'
                     >
                        <div className='mb-6 text-center'>
                           <label
                              className='block mb-4 text-sm text-start font-bold text-gray-700'
                              htmlFor='email'
                           >
                              {t('Email')}
                           </label>
                           <input
                              type='email'
                              className={`w-[100%] mt-0 p-[10px] px-[16px] max-[540px]:py-[15px] boreder-none rounded-full bg-[var(--third)]`}
                              placeholder={t('Email')}
                              {...register('email', { required: true })}
                           />
                           {errors.email && (
                              <span className='text-red-500 text-xs mt-1 ms-2'>
                                 {t('Email Error')}
                              </span>
                           )}
                        </div>
                        <div className='text-center'>
                           <button
                              type='submit'
                              className={`hover:bg-[#d6eb16] w-fit font-bold bg-[var(--primary)] rounded-full transition-all delay-100  py-2 px-6 text-[15px]`}
                           >
                              {t('Send verification code')}
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

export default ForgotPassword
