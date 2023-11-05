import React, { useState, useEffect } from 'react'
import Logo from '../../assets/Logo.webp'
import ContactUsCover from '../../assets/ContactUsCover.webp'
import { useTranslation } from 'react-i18next'
import { useNavigate } from 'react-router-dom'
import { useForm } from 'react-hook-form'
import { toast } from 'react-toastify'
import { GrPowerReset } from 'react-icons/gr'
import { useApiContext } from '../context'

const VerificationEmail = () => {
   const { t } = useTranslation()
   const navigate = useNavigate()
   const apiUrl = process.env.REACT_APP_API_URL

   const {
      register: register,
      handleSubmit: handleSubmit1,
      formState: { errors: errors },
   } = useForm()
   const { handleSubmit: handleSubmit2 } = useForm()
   let user_email = sessionStorage.getItem('email')

   const [showForm, setShowForm] = useState(false)
   const [countdown, setCountdown] = useState(30)
   const [canResend, setCanResend] = useState(false)
   const [showCountdownText, setShowCountdownText] = useState(true)

   const resetTimer = () => {
      setCountdown(30)
      setCanResend(false)
      startTimer()
   }

   // API POST REQUEST
   const ResendCode = async (data) => {
      try {
         const response = await fetch(`${apiUrl}/email/send-verify`, {
            method: 'POST',
            headers: {
               'Content-Type': 'application/json',
               Accept: 'application/json',
               'X-CSRF-TOKEN': window.csrfToken,
            },
            body: JSON.stringify({
               email: user_email,
            }),
         })

         if (response.ok) {
            console.log(user_email)
            const responseData = await response.json()
            console.log(responseData)
            sessionStorage.setItem('email', user_email)
            toast.success(`${t('The code has been re-sent successfully')}`)
            resetTimer()
         } else {
            throw new Error(`${t('Code resend failed')}`)
         }
      } catch (error) {
         toast.error(`${t('Code resend failed')}`)
      }
   }

   // API POST REQUEST
   const onSubmit = async (data) => {
      try {
         const response = await fetch(`${apiUrl}/email/verify`, {
            method: 'POST',
            headers: {
               'Content-Type': 'application/json',
               Accept: 'application/json',
               'X-CSRF-TOKEN': window.csrfToken,
            },
            body: JSON.stringify({
               code: data.verificationcode,
               email: data.email,
            }),
         })

         if (response.ok) {
            const responseData = await response.json()
            console.log(responseData)
            sessionStorage.removeItem('email')
            navigate('/login')
            toast.success(`${t('The code has been verified successfully')}`)
         } else {
            throw new Error(`${t('Code verification failed')}`)
         }
      } catch (error) {
         toast.error(`${t('Code verification failed')}`)
      }
   }

   const startTimer = () => {
      const timer = setInterval(() => {
         setCountdown((prevCountdown) => {
            if (prevCountdown === 1) {
               clearInterval(timer)
               setCanResend(true)
               setShowCountdownText(false)
               return 0
            } else if (prevCountdown > 0) {
               setShowCountdownText(true)
               return prevCountdown - 1
            } else {
               clearInterval(timer)
               setShowCountdownText(false)
               return 0
            }
         })
      }, 1000)
   }

   useEffect(() => {
      startTimer()
   }, [])

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
                     <div className='px-8 mb-3 flex flex-col items-center text-center'>
                        <img src={Logo} className='w-[80px]' alt='logo' />
                        <h3 className='pt-8 mb-3 text-md font-bold'>
                           {t('Please verify your email')}
                        </h3>
                        <p className='text-sm text-gray-700'>
                           {t("You're almost there! We sent an email to")}
                        </p>
                        {user_email ? <p>{user_email}</p> : <p></p>}
                     </div>
                     <div className='mt-4 flex justify-between items-center gap-3'>
                        {showCountdownText && (
                           <p className='text-sm px-8 pb-4'>
                              {t('Resend the code in')} {countdown}{' '}
                              {t('seconds')}
                           </p>
                        )}
                        <form
                           onSubmit={handleSubmit2(ResendCode)}
                           className='px-8 pb-4 bg-white rounded'
                        >
                           <div className='text-center flex items-center gap-2'>
                              <button
                                 id='submit'
                                 type='submit'
                                 className={`w-fit font-bold bg-[var(--secondary)] !text-[var(--primary)] rounded-full transition-all delay-100 p-2 text-[15px] ${
                                    canResend
                                       ? ''
                                       : 'opacity-50 pointer-events-none'
                                 }`}
                                 disabled={!canResend}
                              >
                                 <GrPowerReset />
                              </button>
                              {!showCountdownText && (
                                 <label
                                    htmlFor='submit'
                                    className={`${
                                       canResend
                                          ? 'text-[var(--primary)] hover:text-gray-400 cursor-pointer font-semibold'
                                          : 'text-gray-400'
                                    }`}
                                 >
                                    {t('Resend the code')}
                                 </label>
                              )}
                           </div>
                        </form>
                     </div>
                     <form
                        onSubmit={handleSubmit1(onSubmit)}
                        className='px-8 pt-2 pb-2 bg-white rounded'
                     >
                        <div className='mb-6 text-center'>
                           <label
                              className='block mb-4 text-sm text-start font-bold text-gray-700'
                              htmlFor='email'
                           >
                              {t('Enter the code sent to you')}
                           </label>
                           <input
                              type='email'
                              className={`hidden w-[100%] mt-0 p-[10px] px-[16px] max-[540px]:py-[15px] boreder-none rounded-full bg-[var(--third)]`}
                              value={user_email}
                              {...register('email', { required: true })}
                           />
                           <input
                              type='text'
                              className={`w-[100%] mt-0 p-[10px] px-[16px] max-[540px]:py-[15px] boreder-none rounded-full bg-[var(--third)]`}
                              placeholder={t('Validation code')}
                              {...register('verificationcode', {
                                 required: true,
                              })}
                           />
                           {errors.verificationcode && (
                              <span className='text-red-500 text-xs mt-1 ms-2'>
                                 {t('Validation code Error')}
                              </span>
                           )}
                        </div>
                        <div className='text-center'>
                           <button
                              type='submit'
                              className={`hover:bg-[#d6eb16] w-fit font-bold bg-[var(--primary)] rounded-full transition-all delay-100  py-2 px-6 text-[15px]`}
                           >
                              {t('verification')}
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

export default VerificationEmail
