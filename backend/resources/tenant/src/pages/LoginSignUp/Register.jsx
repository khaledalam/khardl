import React, { useEffect, useState } from 'react'
import Logo from '../../assets/Logo.webp'
import ContactUsCover from '../../assets/ContactUsCover.webp'
import { useTranslation } from 'react-i18next'
import MainText from '../../components/MainText'
import { Link } from 'react-router-dom'
import { useForm } from 'react-hook-form'
import { toast } from 'react-toastify'
import { useNavigate } from 'react-router-dom'
import { AiFillEyeInvisible, AiFillEye } from 'react-icons/ai'
import { useDispatch, useSelector } from 'react-redux'
import AxiosInstance from "../../axios/axios";
import { PREFIX_KEY } from "../../config";
import { changeRestuarantEditorStyle } from '../../redux/NewEditor/restuarantEditorSlice'
import imgLogo from "../../assets/khardl_Logo.png"

const Register = () => {
   const navigate = useNavigate()
   const { t } = useTranslation()
   const {
      handleSubmit,
      register,
      setError,
      formState: { errors },
   } = useForm()
   const [openEyePassword, setOpenEyePassword] = useState(false)
   const [openEyeRePassword, setOpenEyeRePassword] = useState(false)
   const [isLoading, setisLoading] = useState(true);
   const Language = useSelector((state) => state.languageMode.languageMode)
   const [spinner, setSpinner] = useState(false)
   const restaurantStyle = useSelector((state) => state.restuarantEditorStyle)
   const dispatch = useDispatch()
   const EyePassword = () => {
      setOpenEyePassword(!openEyePassword)
   }
   const EyeRePassword = () => {
      setOpenEyeRePassword(!openEyeRePassword)
   }

   /////////////////////////////////////////////////////////////////////////////////////
   // API POST REQUEST
   const onSubmit = async (data) => {
      try {
         setSpinner(true);
         const response = await AxiosInstance.post(`/register`, {
            first_name: data.first_name,
            last_name: data.last_name,
            email: data.email,
            phone: data.phone,
            terms_and_policies: data.terms_and_policies,
         });
         console.log(response.data);
         setSpinner(false);
         toast.success(`${t('Account successfully created')}`)
         sessionStorage.setItem(PREFIX_KEY + 'phone', data.phone)
         window.location.href = '/verification-phone';
      } catch (error) {
         setSpinner(false);
         console.log(error.response.data);


         // if (error.response.data.errors?.length > 0) {
         //     setError(error.response.data.errors);
         // }

         // Object.keys(error.response.data.errors).forEach((field) => {
         //    setError(field, {'message':error.response.data.errors[field][0]});
         // });
         toast.error(`${t(error.response.data.message)}`);
      }

   }
   /////////////////////////////////////////////////////////////////////////////////////
   const fetchResStyleData = async () => {
      try {
         AxiosInstance.get(`restaurant-style`).then((response) => {
            console.log("DATA", response.data?.data);
            dispatch(changeRestuarantEditorStyle(response.data?.data));
         });
         setisLoading(false);
      } catch (error) {
         // toast.error(`${t('Failed to send verification code')}`)
         console.log(error);
         setisLoading(false);
      }
   };
   const fetchCartData = async () => {
      try {
         const cartResponse = await AxiosInstance.get(`carts`);
         if (cartResponse.data) {
            dispatch(getCartItemsCount(cartResponse.data?.data?.items?.length));
         }
      } catch (error) {
         // toast.error(`${t('Failed to send verification code')}`)
         console.log(error);
      }
   };
   /////////////////////////////////////////////////////////////////////////////////////
   useEffect(() => {
      fetchResStyleData();
      fetchCartData().then(() => {
         console.log("fetched cart item count successfully");
      });
   },[])
   return (
      <div className='flex flex-col items-stretch justify-center'>
         <div
            className='flex justify-center items-center px-[40px] max-md:px-[0px]'
            style={{
               backgroundImage: `url(${ContactUsCover})`,
               backgroundSize: 'cover',
            }}
         >
            <div className='py-[20px] flex justify-center items-center'>
               <div className='grid grid-cols-2 h-[100%] max-[860px]:flex max-[860px]:flex-col-reverse py-[80px] max-md:py-[60px] xl:max-w-[70%] max-[1200px]:w-[100%]'>
                  <div className='relative flex flex-col justify-center items-center max-[860px]:w-[85vw] space-y-14 shadow-lg bg-white p-8 max-[860px]:p-4 rounded-s-lg max-[860px]:rounded-b-lg max-[860px]:rounded-s-none '>
                     <div className='mt-6 w-[100%]'>
                        <MainText
                           Title={t('Create an account')}
                           classTitle='!text-[28px] !w-[50px] !h-[8px] bottom-[-10px] max-[1000px]:bottom-[0px] max-[500px]:bottom-[5px]'
                        />
                        <div className='w-[100%] flex items-center justify-center mt-4'>
                           <form
                              onSubmit={handleSubmit(onSubmit)}
                              className='w-[100%] flex flex-col gap-[14px] px-[15px]'
                           >
                              <div className='flex justify-stretch items-center gap-3 w-[100%]'>
                                 {/* First Input */}
                                 <div className='w-[100%]'>
                                    <h4 className='mb-2 ms-2 text-[13px] font-semibold'>
                                       {t('First name')} <span className="text-red-500">*</span>
                                    </h4>
                                    <input
                                       className={`w-[100%] mt-0 p-[10px] px-[16px] max-[540px]:py-[15px] boreder-none rounded-full bg-[var(--third)]`}
                                       placeholder={t('First name')}
                                       {...register('first_name', {
                                          required: true,
                                       })}
                                    />
                                    {errors.first_name && (
                                       <span className='text-red-500 text-xs mt-1 ms-2'>
                                          {errors.first_name.message || t('First name Error')}
                                       </span>
                                    )}
                                 </div>
                                 {/* Input 2 */}
                                 <div className='w-[100%]'>
                                    <h4 className='mb-2 ms-2 text-[13px] font-semibold'>
                                       {t('Last name')} <span className="text-red-500">*</span>
                                    </h4>
                                    <input
                                       className={`w-[100%] mt-0 p-[10px] px-[16px] max-[540px]:py-[15px] boreder-none rounded-full bg-[var(--third)]`}
                                       placeholder={t('Last name')}
                                       {...register('last_name', {
                                          required: true,
                                       })}
                                    />
                                    {errors.last_name && (
                                       <span className='text-red-500 text-xs mt-1 ms-2'>
                                          {errors.last_name.message || t('Last name Error')}
                                       </span>
                                    )}
                                 </div>
                              </div>
                              {/* Input 5 */}
                              <div>
                                 <h4 className='mb-2 ms-2 text-[13px] font-semibold'>
                                    {t('Phone')} <span className="text-red-500">*</span>
                                 </h4>
                                 <input
                                    type='number'
                                    className={`w-[100%] mt-0 p-[10px] px-[16px] max-[540px]:py-[15px] border-none rounded-full bg-[var(--third)]`}
                                    placeholder={t('e.g.') + ' +966 123456789'}
                                    {...register('phone', {
                                       required: true,
                                    })}
                                    style={{ direction: 'ltr' }}
                                    minLength={9}
                                    maxLength={13}
                                 />
                                 {errors.phone && (
                                    <span className='text-red-500 text-xs mt-1 ms-2'>
                                       {errors.phone.message || t('Phone Error')}
                                    </span>
                                 )}
                              </div>


                              {/* Input 6 */}

                              <div>
                                 <h4 className='mb-2 ms-2 text-[13px] font-semibold'>
                                    {t('Email')}
                                 </h4>
                                 <input
                                    type='email'
                                    className={`w-[100%] mt-0 p-[10px] px-[16px] max-[540px]:py-[15px] boreder-none rounded-full bg-[var(--third)]`}
                                    placeholder={t('Email')}
                                    {...register('email', { required: false })}
                                 />
                                 {errors.email && (
                                    <span className='text-red-500 text-xs mt-1 ms-2'>
                                       {errors.email.message || t('Email Error')}
                                    </span>
                                 )}
                              </div>
                              {/* Input 7 */}
                              {/* <div className='relative'>
                                 <h4 className='mb-2 ms-2 text-[13px] font-semibold'>
                                    {t('Password')}
                                 </h4>
                                 <input
                                    type={
                                       openEyePassword === false
                                          ? 'password'
                                          : 'text'
                                    }
                                    className={`w-[100%] mt-0 p-[10px] px-[16px] max-[540px]:py-[15px] boreder-none rounded-full bg-[var(--third)]`}
                                    placeholder={t('Password')}
                                    {...register('password', {
                                       required: true,
                                    })}
                                 />
                                 {errors.password && (
                                    <span className='text-red-500 text-xs mt-1 ms-2'>
                                       {errors.password.message ||   t('Password Error') }
                                    </span>
                                 )}
                                 <div
                                    className={`text-2xl absolute top-[38px] ${Language === 'en' ? 'right-5' : 'left-5'
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
                              </div> */}

                              {/* Input 8 */}
                              {/* <div className='relative'>
                                 <h4 className='mb-2 ms-2 text-[13px] font-semibold'>
                                    {t('Confirm password')}
                                 </h4>
                                 <input
                                    type={
                                       openEyeRePassword === false
                                          ? 'password'
                                          : 'text'
                                    }
                                    className={`w-[100%] mt-0 p-[10px] px-[16px] max-[540px]:py-[15px] boreder-none rounded-full bg-[var(--third)]`}
                                    placeholder={t('Confirm password')}
                                    {...register('c_password', {
                                       required: true,
                                    })}
                                 />
                                 {errors.c_password && (
                                    <span className='text-red-500 text-xs mt-1 ms-2'>
                                       {errors.c_password.message ||   t('Confirm password Error') }
                                    </span>
                                 )}
                                 <div
                                    className={`text-2xl absolute top-[38px] ${Language === 'en' ? 'right-5' : 'left-5'
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
                              </div> */}


                              {errors.terms_and_policies && (
                                 <span className='text-red-500 text-xs mt-1 ms-2'>
                                    {errors.terms_and_policies.message || t('Approval Error')}
                                 </span>
                              )}

                              <div className='flex flex-col justify-center items-center my-4'>
                                 <button
                                    type='submit'
                                    className={`hover:bg-[#d6eb16] font-bold bg-[var(--primary)] flex justify-center items-center gap-[3px] rounded-full transition-all delay-100  py-2 px-6 text-[18px] leading-6`}
                                 >
                                    {t('Create an account')}
                                 </button>
                                 <p className='text-sm font-semibold mt-1'>
                                    {t('You have an account?')}
                                    <Link to='/login'>
                                       <input
                                          type='submit'
                                          className='text-[var(--primary)] cursor-pointer hover:text-blue-300 py-2 px-2 text-md '
                                          value={t('Login')}
                                       />
                                    </Link>
                                 </p>
                              </div>
                           </form>
                        </div>
                     </div>
                     {spinner && (
                        <div
                           role='status'
                           className='rounded-s-md  max-[860px]:rounded-b-lg max-[860px]:rounded-s-none absolute -translate-x-1/2 -translate-y-1/2 top-[44.1%] left-1/2 w-[100%] h-[100%] '
                        >
                           <div className='rounded-s-md max-[860px]:rounded-b-lg max-[860px]:rounded-s-none relative bg-black opacity-25 flex justify-center items-center w-[100%] h-[100%] mt-[-24px]'></div>
                           <div className='absolute -translate-x-1/2 -translate-y-1/2 top-2/4 left-1/2 '>
                              <svg
                                 aria-hidden='true'
                                 className='w-8 h-8 mr-2 text-gray-200 animate-spin fill-[var(--primary)]'
                                 viewBox='0 0 100 101'
                                 fill='none'
                                 xmlns='http://www.w3.org/2000/svg'
                              >
                                 <path
                                    d='M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z'
                                    fill='currentColor'
                                 />
                                 <path
                                    d='M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z'
                                    fill='currentFill'
                                 />
                              </svg>
                           </div>
                        </div>
                     )}
                  </div>
                  <div className='flex flex-col justify-center items-center max-[860px]:w-[85vw] bg-[var(--primary)] p-8 space-y-10 shadow-lg rounded-e-lg max-[860px]:rounded-t-lg max-[860px]:rounded-e-none'>
                     <Link
                        to='/'
                        className='grid content-between space-y-6  transform transition-transform hover:-translate-y-2'
                     >
                        <div
                           className={` w-full ${restaurantStyle?.logo_alignment === t("Center") ||
                                 restaurantStyle?.logo_alignment === "center"
                                 ? " flex items-center justify-center"
                                 : restaurantStyle?.logo_alignment === t("Left") ||
                                    restaurantStyle?.logo_alignment === "left"
                                    ? "items-center justify-start"
                                    : "items-center justify-end"
                              }`}
                        >
                           <div
                              className={`w-[80px] h-[80px]  ${restaurantStyle?.logo_shape === "rounded" ||
                                    restaurantStyle?.logo_shape === t("Rounded")
                                    ? "rounded-full"
                                    : restaurantStyle?.logo_shape === "sharp" ||
                                       restaurantStyle?.logo_shape === t("Sharp")
                                       ? "rounded-none"
                                       : ""
                                 }`}
                           >
                              <img
                                 src={restaurantStyle?.logo ? restaurantStyle.logo : imgLogo}
                                 alt='logo'
                                 className={`w-full h-full object-cover ${restaurantStyle?.logo_shape === t("Sharp") ? "" : "rounded-full"
                                    }`}
                              />
                           </div>
                        </div>
                     </Link>
                     <div className='mt-6'>
                        <MainText
                           SubTitle={t('Register Details')}
                           classSubTitle='max-w-[380px] !text-[18px]  font-semibold !px-0'
                        />
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   )
}

export default Register
