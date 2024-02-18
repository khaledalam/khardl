import React, { useState } from 'react'
import Logo from '../../assets/Logo.webp'
import ContactUsCover from '../../assets/ContactUsCover.webp'
import { useTranslation } from 'react-i18next'
import MainText from '../../components/MainText'
import { Link } from 'react-router-dom'
import { useForm } from 'react-hook-form'
import { toast } from 'react-toastify'
import { useNavigate } from 'react-router-dom'
import { AiFillEyeInvisible, AiFillEye } from 'react-icons/ai'
import { useSelector } from 'react-redux'
import AxiosInstance from "../../axios/axios";
import { Button } from '../../components/ButtonComponent'
import TermsPolicies from '../TermsPoliciesPrivacy/TermsPolicies';
import Privacy from '../TermsPoliciesPrivacy/Privacy';
import infog from '../../assets/infog.svg'

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
   const [showTerms, setShowTerms] = useState(false);
   const [showPrivacy, setShowPrivacy] = useState(false);

   function showTermsModal() {
      if (!showTerms) {
         setShowTerms(true);
      } else {
         setShowTerms(false);
      }
   }
   function showPrivacyModal() {
      if (!showPrivacy) {
         setShowPrivacy(true);
      } else {
         setShowPrivacy(false);
      }
   }
   const Language = useSelector((state) => state.languageMode.languageMode)
   const [spinner, setSpinner] = useState(false)

   const [showTooltip, setShowTooltip] = useState(false);
   const handleInputFocus = () => { setShowTooltip(true); };
   const handleInputBlur = () => { setShowTooltip(false); };
   const [restaurantName, setRestaurantName] = useState('');
   const [err, setErr] = useState();



   const EyePassword = () => {
      setOpenEyePassword(!openEyePassword)
   }
   const EyeRePassword = () => {
      setOpenEyeRePassword(!openEyeRePassword)
   }

   const slugify = (text) => {
      return text.toString().toLowerCase()
         .replace(/\s+/g, '-')
         .replace(/[^\w-]+/g, '')
         .replace(/--+/g, '-')
         .replace(/^-+/, '')
         .replace(/-+$/, '');
   };

   const onChangeHandler = (event) => {
      const { value } = event.target;
      const slugifiedName = slugify(value);
      setRestaurantName(slugifiedName);

      // Validation
      if (!/^(?!.*--)[a-z0-9]+(?:[-\s][a-z0-9]+)*$/i.test(value)) {
         setErr(t('Restaurant name Error'));
      } else {
         setErr("");
      }
   };
   /////////////////////////////////////////////////////////////////////////////////////
   // API POST REQUEST
   const onSubmit = async (data) => {
      try {
         if(err){setErr(t('Restaurant name Error'));
      return
      }
         setSpinner(true);
         const response = await AxiosInstance.post(`/register`, {
            first_name: data.first_name,
            last_name: data.last_name,
            restaurant_name: restaurantName,
            position: data.position,
            email: data.email,
            phone: data.phone,
            password: data.password,
            c_password: data.c_password,
            terms_and_policies: data.terms_and_policies,
         });
         console.log(response.data);
         toast.success(`${t('Account successfully created')}`)
         sessionStorage.setItem('email', data.email)
         window.location.href = '/verification-email';
      } catch (error) {
         setSpinner(false);
         console.log(error);
         console.log(errors);

         // if (error.response.data.errors?.length > 0) {
         //     setError(error.response.data.errors);
         // }
         //
         // Object.keys(error.response.data.errors).forEach((field) => {
         //    console.log(error.response.data.errors[field][0]);
         //    setError(field, {'message':error.response.data.errors[field][0]});
         // });
         toast.error(error.response.data.message);
      }

   }
   /////////////////////////////////////////////////////////////////////////////////////
   const direction = localStorage.getItem("i18nextLng") === "en" ? "ltr" : "rtl";
   return (
      <div className='flex flex-col items-stretch justify-center'>
         <div
            className='flex justify-center items-center px-[40px] max-md:px-[0px]'
            style={{
               backgroundImage: `url(${ContactUsCover})`,
               backgroundSize: 'cover',
            }}
         >
            {showTerms && <TermsPolicies onClose={showTermsModal} />}
            {showPrivacy && <Privacy onClose={showPrivacyModal} />}
            {!showTerms && !showPrivacy &&
               <div className='py-[20px] flex justify-center items-center'>
                  <div className='grid grid-cols-2 h-[100%] max-[860px]:flex max-[860px]:flex-col-reverse my-[80px] rounded-lg shadow-lg max-md:my-[60px] xl:max-w-[70%] max-[1200px]:w-[100%] bg-white'>
                     <div className='relative flex justify-center items-center max-[860px]:w-[85vw] space-y-14  bg-white p-8 max-[860px]:p-4 rounded-s-lg max-[860px]:rounded-b-lg max-[860px]:rounded-s-none '>
                        <div className='mt-6 w-[100%]'>

                           <MainText
                              Title={t('Create an account')}
                              classTitle='!text-[28px] !w-[50px] !h-[8px] bottom-[-10px] max-[1000px]:bottom-[0px] max-[500px]:bottom-[5px]'
                           />
                           <div className='w-[100%] flex items-center justify-center mt-4'>
                              <form
                                 onSubmit={handleSubmit(onSubmit)}
                                 className='w-[100%] flex flex-col gap-[14px] px-[15px] new-form-ui'
                              >
                                 <div className='flex justify-stretch items-center gap-3 w-[100%]'>
                                    {/* First Input */}
                                    <div className='w-[100%]'>
                                       <h4 className='mb-2 ms-2 text-[13px] font-semibold'>
                                          {t('First name')} <span className="text-red-500">*</span>
                                       </h4>
                                       <input
                                          minLength={3}
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
                                          minLength={3}
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
                                 {/* Input 3 */}
                                 <div>
                                    <h4 className='ms-2 text-[13px] font-semibold'>
                                       {t('Restaurant name')} <span className="text-red-500">*</span>
                                    </h4>

                                    {Language === 'en' ? (<div className='joined-input-group flex items-center justify-between'>
                                       <input
                                          className={`w-[100%] mt-0 p-[10px] px-[16px] max-[540px]:py-[15px] boreder-none rounded-full bg-[var(--third)]`}
                                          placeholder={t('Restaurant name')}
                                          style={{ marginBottom: 0 }}
                                          // {...register('restaurant_name', {
                                          //    required: true,
                                          //    validate: validateRestaurantName,
                                          // })}
                                          onChange={onChangeHandler}
                                          onFocus={handleInputFocus}
                                          onBlur={handleInputBlur}
                                       />
                                       <span>.khardl.com</span>
                                    </div>) : (<div className='joined-input-group flex items-center justify-between'>
                                       <span>.khardl.com</span>
                                       <input
                                          className={`w-[100%] mt-0 p-[10px] px-[16px] max-[540px]:py-[15px] boreder-none rounded-full bg-[var(--third)]`}
                                          placeholder={t('Restaurant name')}
                                          style={{ marginBottom: 0 }}
                                          onChange={onChangeHandler}
                                          onFocus={handleInputFocus}
                                          onBlur={handleInputBlur}
                                       />
                                    </div>
                                    )}

                                    <span className='text-[#00000080] text-[10px] ms-2' style={{ marginBottom: '20px' }}>
                                       <img src={infog} alt="InfoIcon" className="inline-block align-middle" />
                                       {' '}{t('* If your restaurant name is ABC the domain will be')}{' '}{restaurantName ? restaurantName : 'abc'}.khardl.com
                                    </span>
                                    {showTooltip && (
                                       <div className="relative">
                                          <div className={`absolute ${Language === "ar" ? "right-full" : "left-full"}`}>
                                             <div id="tooltip3" role="tooltip" className={`z-20 -mt-20 w-64 absolute transition duration-150 ease-in-out ${Language === "ar" ? "right-0" : "left-0"} ml-8 shadow-lg rounded p-3 text-white bg-[#000000]`}>
                                                <svg className={`absolute ${Language === "ar" ? "right-0 rotate-180 right-[-0.5rem]" : "left-0"} -ml-2 bottom-0 top-0 h-full`} width="9px" height="16px" viewBox="0 0 9 16" version="1.1" xmlns="http://www.w3.org/2000/svg" >
                                                   <g id="Page-1" stroke="none" strokeWidth="1" fill="black" fillRule="evenodd">
                                                      <g id="Tooltips-" transform="translate(-874.000000, -1029.000000)" fill="black">
                                                         <g id="Group-3-Copy-16" transform="translate(850.000000, 975.000000)">
                                                            <g id="Group-2" transform="translate(24.000000, 0.000000)">
                                                               <polygon id="Triangle" transform="translate(4.500000, 62.000000) rotate(-90.000000) translate(-4.500000, -62.000000) " points="4.5 57.5 12.5 66.5 -3.5 66.5"></polygon>
                                                            </g>
                                                         </g>
                                                      </g>
                                                   </g>
                                                </svg>
                                                <div className="ms-2 text-[13px] font-new text-[var(--customer)]">
                                                   <p>{t('* Your restaurant name will  be your domain')}</p>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    )}
                                     {err && (
                                       <span className='text-red-500 text-xs mt-1 ms-2'>
                                          {err || t('Restaurant name Error')}
                                       </span>
                                    )}
                                    {errors.restaurant_name && (
                                       <span className='text-red-500 text-xs mt-1 ms-2'>
                                          {errors.restaurant_name.message || t('Restaurant name Error')}
                                       </span>
                                    )}
                                 </div>

                                 {/* Input 4 */}
                                 <div>
                                    <h4 className='mb-2 ms-2 text-[13px] font-semibold'>
                                       {t('Position')} <span className="text-red-500">*</span>
                                    </h4>
                                    <input
                                       className={`w-[100%] mt-0 p-[10px] px-[16px] max-[540px]:py-[15px] boreder-none rounded-full bg-[var(--third)]`}
                                       placeholder={t('Position')}
                                       {...register('position', {
                                          required: true,
                                       })}
                                    />
                                    {errors.position && (
                                       <span className='text-red-500 text-xs mt-1 ms-2'>
                                          {errors.position.message || t('Position Error')}
                                       </span>
                                    )}
                                 </div>

                                 {/* Input 5 */}
                                 <div>
                                    <h4 className='mb-2 ms-2 text-[13px] font-semibold'>
                                       {t('Email')} <span className="text-red-500">*</span>
                                    </h4>
                                    <input
                                       type='email'
                                       className={`w-[100%] mt-0 p-[10px] px-[16px] max-[540px]:py-[15px] boreder-none rounded-full bg-[var(--third)]`}
                                       placeholder={t('Email')}
                                       {...register('email', { required: true })}
                                    />
                                    {errors?.email && (
                                       <span className='text-red-500 text-xs mt-1 ms-2'>
                                          {errors?.email[0] || t('Email Error')}
                                       </span>
                                    )}
                                 </div>

                                 {/* Input 6 */}
                                 <div>
                                    <h4 className='mb-2 ms-2 text-[13px] font-semibold'>
                                       {t('Phone')}  <span className="text-red-500">*</span>
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

                                 {/* Input 7 */}
                                 <div className='relative'>
                                    <h4 className='mb-2 ms-2 text-[13px] font-semibold'>
                                       {t('Password')} <span className="text-red-500">*</span>
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
                                          {errors.password.message || t('Password Error')}
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
                                 </div>

                                 {/* Input 8 */}
                                 <div className='relative'>
                                    <h4 className='mb-2 ms-2 text-[13px] font-semibold'>
                                       {t('Confirm password')} <span className="text-red-500">*</span>
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
                                          {errors.c_password.message || t('Confirm password Error')}
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
                                 </div>

                                 <div className='flex justify-start items-center gap-2'>
                                    <input
                                       id={`checkbox-1`}
                                       type='checkbox'
                                       {...register('terms_and_policies', {
                                          required: true,
                                       })}
                                       style={{ margin: '0' }}
                                       className='accent-black w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500  focus:ring-2'
                                    />
                                    <label
                                       htmlFor={`checkbox-1`}
                                       className='text-sm font-medium text-gray-900'
                                    >
                                       {t('Approval')}
                                       <span
                                          onClick={() => showTermsModal()}

                                          className='text-[var(--primary)]'
                                       >
                                          {t('terms_and_policies')}
                                       </span>
                                       {t('and')}
                                       <span
                                          onClick={() => showPrivacyModal()}
                                          className='text-[var(--primary)]'
                                       >
                                          {t('Privacy')}
                                       </span>
                                    </label>
                                    <span className="text-red-500">*</span>
                                 </div>
                                 {errors.terms_and_policies && (
                                    <span className='text-red-500 text-xs mt-1 ms-2'>
                                       {errors.terms_and_policies.message || t('Approval Error')}
                                    </span>
                                 )}

                                 <div className='flex-col flex justify-center items-center my-4'>
                                    <button
                                       type='submit'
                                       className={`hover:bg-[#d6eb16] font-bold bg-[var(--primary)] flex justify-center items-center gap-[3px] rounded-full transition-all delay-100  py-2 px-6 text-[18px] leading-6 submit-btn`}
                                    >
                                       {t('Create an account')}
                                    </button>
                                    <p className='text-sm font-semibold font-new mt-1'>
                                       {t('You have an account?')}
                                       <Link to='/login'>
                                          <button
                                             type='submit'
                                             className='text-[var(--primary)] cursor-pointer hover:text-blue-300 py-2 px-2 text-md '

                                          >{t('Login')}</button>
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
                              <div className='rounded-s-md max-[860px]:rounded-b-lg max-[860px]:rounded-s-none relative bg-black opacity-25 flex justify-center items-center w-[100%] h-[100%]'></div>
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

                     <div className={`flex justify-center  max-[860px]:w-[85vw] bg-[var(--primary)] p-8 space-y-10  rounded-e-lg max-[860px]:rounded-t-lg max-[860px]:rounded-e-none new-register-bg ${direction}`}>

                        <div className='mt-11'>
                           <MainText
                              SubTitle={t('Register Details')}
                              classSubTitle='max-w-[380px] !text-[18px]  font-semibold !px-0'
                           />
                        </div>
                     </div>
                  </div>
               </div>}

         </div>
      </div>
   )
}

export default Register
