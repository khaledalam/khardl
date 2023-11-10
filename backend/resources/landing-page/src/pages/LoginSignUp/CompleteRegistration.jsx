import React, { useState } from 'react'
import bgRegistration from '../../assets/bgRegistration.webp'
import { useTranslation } from 'react-i18next'
import MainText from '../../components/MainText'
import { FiUpload } from 'react-icons/fi'
import { useForm } from 'react-hook-form'
import { toast } from 'react-toastify'
import { useNavigate } from 'react-router-dom'
import { FaStarOfLife } from 'react-icons/fa'
// import { useApiContext } from '../context'
import AxiosInstance from "../../axios/axios";
import { useAuthContext } from '../../components/context/AuthContext'

function CompleteRegistration() {
   const { t } = useTranslation()
   const navigate = useNavigate()

   const { setStatusCode } = useAuthContext()
   const [files, setFiles] = useState()

   
   const [fileUploadSuccess, setFileUploadSuccess] = useState({
      commercial_registration: false,
      tax_registration_certificate: false,
      national_address: false,
      identity_of_owner_or_manager: false,
      bank_certificate: false,
   })
   const [selectedFileNames, setSelectedFileNames] = useState({
      commercial_registration: '',
      tax_registration_certificate: '',
      national_address: '',
      identity_of_owner_or_manager: '',
      bank_certificate: '',
   })
   const [selectedFiles, setSelectedFiles] = useState({
      commercial_registration: false,
      tax_registration_certificate: false,
      national_address: false,
      identity_of_owner_or_manager: false,
      bank_certificate: false,
   })
   const {
      handleSubmit,
      register,
      formState: { errors },
   } = useForm()
   // let user_info = JSON.parse(sessionStorage.getItem("user-info"));
   // const token = user_info ? user_info.access_token : "";
   // const process.env.REACT_APP_API_URL = useApiContext()

   // API POST REQUEST
   const onSubmit = async (data) => {
      console.log(data)
      try {
         const response =  await AxiosInstance.post(`/register-step2`,
            {
               commercial_registration: selectedFiles.commercial_registration,
               tax_registration_certificate: selectedFiles.tax_registration_certificate,
               bank_certificate:selectedFiles.bank_certificate,
               identity_of_owner_or_manager:selectedFiles.identity_of_owner_or_manager,
               national_address: selectedFiles.national_address,
               IBAN: data.IBAN,
               facility_name: data.facility_name,
         },{
            headers:{
               Accept: 'application/json',
      // * Don't remove *
               'Content-Type': 'multipart/form-data',
               'X-CSRF-TOKEN': window.csrfToken,
            }
         }
         );

         if (response.data) {
            
            toast.success(
               `${t('Account creation has been completed successfully')}`
            )
            setStatusCode(200)
            window.location.href = '/summary';
         } else {
            throw new Error(`${t('Account creation failed to complete')}`)
         }
      } catch (error) {
         toast.error(`${t('Account creation failed to complete')}`)
      }
   }

   return (
      <div className='flex flex-col items-stretch justify-center pt-[50px]'>
         <div
            className='flex justify-center items-center px-[40px] max-md:px-[0px]'
            style={{
               backgroundImage: `url(${bgRegistration})`,
               backgroundSize: 'cover',
            }}
         >
            <div className='min-w-[60%] max-sm:min-w-[100%] flex h-[100%] flex-col justify-start items-center max-[860px]:w-[80vw] space-y-6 p-8 max-[860px]:p-4 '>
               <div className='mt-6 w-[100%]'>
                  <MainText
                     Title={t('Complete registration')}
                     SubTitle={t('Complete registration Details')}
                     classTitle='!text-[28px] !w-[50px] !h-[8px] bottom-[-10px] max-[1000px]:bottom-[0px] max-[500px]:bottom-[5px]'
                     classSubTitle='max-w-[380px] !text-[14px] mb-4'
                  />
               </div>
               <form
                  onSubmit={handleSubmit(onSubmit)}
                  className='flex flex-col items-center gap-6 w-[80%] max-sm:w-[90%]'
                  encType='multipart/form-data' 
               >
                  {/* First Input */}
                  <div className='w-[100%]'>
                     <div className='mb-2 font-semibold'>
                        {t('Commercial Record')}
                     </div>
                     <input
                        type='file'
                        accept='application/pdf'
                        {...register('commercial_registration', {
                           required: true,
                        })}
                        id='Input(1)'
                        className='hidden'
                        onChange={(event) => {
                           setFileUploadSuccess({
                              ...fileUploadSuccess,
                              commercial_registration: true,
                           })
                           const selectedFileName = event.target.files[0];
                           setSelectedFiles({...selectedFiles,commercial_registration: selectedFileName})
                           setSelectedFileNames({
                              ...selectedFileNames,
                              commercial_registration: selectedFileName.name,
                           })
                        }}
                     />
                     <label
                        htmlFor='Input(1)'
                        className={`h-[130px] bg-[#ececec] hover:bg-[#dadada] text-[#04020550] rounded-xl flex flex-col items-center justify-center gap-2 cursor-pointer`}
                     >
                        <FiUpload size={24} />
                        <h1>{t('Attach a PDF file')}</h1>
                     </label>
                     {fileUploadSuccess.commercial_registration && (
                        <span className='text-green-500 text-xs mt-1 ms-2'>
                           {t('File uploaded successfully')}
                        </span>
                     )}
                     {selectedFileNames.commercial_registration && (
                        <span className='text-blue-500 text-xs mt-1 ms-2'>
                           {selectedFileNames.commercial_registration}
                        </span>
                     )}
                     {errors.commercial_registration &&
                        !fileUploadSuccess.commercial_registration &&
                        !selectedFileNames.commercial_registration && (
                           <span className='text-red-500 text-xs mt-1 ms-2'>
                              {t('Commercial Record Error')}
                           </span>
                        )}
                  </div>

                  {/* Input 2 */}
                  <div className='w-[100%]'>
                     <div className='mb-2 font-semibold'>
                        {t('Tax registration certificate')}
                     </div>
                     <input
                        type='file'
                        accept='application/pdf'
                        id='Input(2)'
                        {...register('tax_registration_certificate', {
                           required: true,
                        })}
                        className='hidden'
                        onChange={(event) => {
                           setFileUploadSuccess({
                              ...fileUploadSuccess,
                              tax_registration_certificate: true,
                           })
                           const selectedFileName = event.target.files[0]
                           setSelectedFiles({...selectedFiles,tax_registration_certificate: selectedFileName})
                           setSelectedFileNames({
                              ...selectedFileNames,
                              tax_registration_certificate: selectedFileName.name,
                           })
                        }}
                     />
                     <label
                        htmlFor='Input(2)'
                        className={`h-[130px] bg-[#ececec] hover:bg-[#dadada] text-[#04020550] rounded-xl flex flex-col items-center justify-center gap-2 cursor-pointer`}
                     >
                        <FiUpload size={24} />
                        <h1>{t('Attach a PDF file')}</h1>
                     </label>
                     {fileUploadSuccess.tax_registration_certificate && (
                        <span className='text-green-500 text-xs mt-1 ms-2'>
                           {t('File uploaded successfully')}
                        </span>
                     )}
                     {selectedFileNames.tax_registration_certificate && (
                        <span className='text-blue-500 text-xs mt-1 ms-2'>
                           {selectedFileNames.tax_registration_certificate}
                        </span>
                     )}
                     {errors.tax_registration_certificate &&
                        !fileUploadSuccess.tax_registration_certificate &&
                        !selectedFileNames.tax_registration_certificate && (
                           <span className='text-red-500 text-xs mt-1 ms-2'>
                              {t('Tax registration certificate Error')}
                           </span>
                        )}
                  </div>

                  {/* Input 3 */}
                  <div className='w-[100%]'>
                     <div className='mb-2 font-semibold'>
                        {t('National address')}
                     </div>
                     <input
                        type='file'
                        accept='application/pdf'
                        id='Input(3)'
                        {...register('national_address', { required: true })}
                        className='hidden'
                        onChange={(event) => {
                           setFileUploadSuccess({
                              ...fileUploadSuccess,
                              national_address: true,
                           })
                           const selectedFileName = event.target.files[0]
                           setSelectedFiles({...selectedFiles,national_address: selectedFileName})
                           setSelectedFileNames({
                              ...selectedFileNames,
                              national_address: selectedFileName.name,
                           })
                        }}
                     />
                     <label
                        htmlFor='Input(3)'
                        className={`h-[130px] bg-[#ececec] hover:bg-[#dadada] text-[#04020550] rounded-xl flex flex-col items-center justify-center gap-2 cursor-pointer`}
                     >
                        <FiUpload size={24} />
                        <h1>{t('Attach a PDF file')}</h1>
                     </label>
                     {fileUploadSuccess.national_address && (
                        <span className='text-green-500 text-xs mt-1 ms-2'>
                           {t('File uploaded successfully')}
                        </span>
                     )}
                     {selectedFileNames.national_address && (
                        <span className='text-blue-500 text-xs mt-1 ms-2'>
                           {selectedFileNames.national_address}
                        </span>
                     )}
                     {errors.national_address &&
                        !fileUploadSuccess.national_address &&
                        !selectedFileNames.national_address && (
                           <span className='text-red-500 text-xs mt-1 ms-2'>
                              {t('National address Error')}
                           </span>
                        )}
                  </div>

                  {/* Input 4 */}
                  <div className='w-[100%]'>
                     <div className='mb-2 font-semibold'>
                        {t('Identity of the owner or manager')}
                     </div>
                     <input
                        type='file'
                        accept='application/pdf'
                        id='Input(4)'
                        {...register('identity_of_owner_or_manager', {
                           required: true,
                        })}
                        className='hidden'
                        onChange={(event) => {
                           setFileUploadSuccess({
                              ...fileUploadSuccess,
                              identity_of_owner_or_manager: true,
                           })
                           const selectedFileName = event.target.files[0]
                           setSelectedFiles({...selectedFiles,identity_of_owner_or_manager: selectedFileName})

                           setSelectedFileNames({
                              ...selectedFileNames,
                              identity_of_owner_or_manager: selectedFileName.name,
                           })
                        }}
                     />
                     <label
                        htmlFor='Input(4)'
                        className={`h-[130px] bg-[#ececec] hover:bg-[#dadada] text-[#04020550] rounded-xl flex flex-col items-center justify-center gap-2 cursor-pointer`}
                     >
                        <FiUpload size={24} />
                        <h1>{t('Attach a PDF file')}</h1>
                     </label>
                     {fileUploadSuccess.identity_of_owner_or_manager && (
                        <span className='text-green-500 text-xs mt-1 ms-2'>
                           {t('File uploaded successfully')}
                        </span>
                     )}
                     {selectedFileNames.identity_of_owner_or_manager && (
                        <span className='text-blue-500 text-xs mt-1 ms-2'>
                           {selectedFileNames.identity_of_owner_or_manager}
                        </span>
                     )}
                     {errors.identity_of_owner_or_manager &&
                        !fileUploadSuccess.identity_of_owner_or_manager &&
                        !selectedFileNames.identity_of_owner_or_manager && (
                           <span className='text-red-500 text-xs mt-1 ms-2'>
                              {t('Identity of the owner or manager Error')}
                           </span>
                        )}
                  </div>

                  {/* Input 5 */}
                  <div className='w-[100%]'>
                     <div className='mb-2 font-semibold'>
                        {t('Bank certificate')}
                     </div>
                     <input
                        type='file'
                        accept='application/pdf'
                        id='Input(5)'
                        {...register('bank_certificate', { required: true })}
                        className='hidden'
                        onChange={(event) => {
                           setFileUploadSuccess({
                              ...fileUploadSuccess,
                              bank_certificate: true,
                           })
                           const selectedFileName = event.target.files[0]
                           setSelectedFiles({...selectedFiles,bank_certificate: selectedFileName})

                           setSelectedFileNames({
                              ...selectedFileNames,
                              bank_certificate: selectedFileName.name,
                           })
                        }}
                     />
                     <label
                        htmlFor='Input(5)'
                        className={`h-[130px] bg-[#ececec] hover:bg-[#dadada] text-[#04020550] rounded-xl flex flex-col items-center justify-center gap-2 cursor-pointer`}
                     >
                        <FiUpload size={24} />
                        <h1>{t('Attach a PDF file')}</h1>
                     </label>
                     {fileUploadSuccess.bank_certificate && (
                        <span className='text-green-500 text-xs mt-1 ms-2'>
                           {t('File uploaded successfully')}
                        </span>
                     )}
                     {selectedFileNames.bank_certificate && (
                        <span className='text-blue-500 text-xs mt-1 ms-2'>
                           {selectedFileNames.bank_certificate}
                        </span>
                     )}
                     {errors.bank_certificate &&
                        !fileUploadSuccess.bank_certificate &&
                        !selectedFileNames.bank_certificate && (
                           <span className='text-red-500 text-xs mt-1 ms-2'>
                              {t('Bank certificate Error')}
                           </span>
                        )}
                  </div>
                  {/* Input 6 */}
                  <div className='w-[100%] flex flex-col items-start gap-4'>
                  
                     <div className='w-[100%]'>
                        <div className='mb-2 font-semibold'>{t('IBAN')}</div>
                        <input
                           type='text'
                           className={`h-[50px] px-4 bg-[#ececec] hover:bg-[#dadada] rounded-xl flex flex-col items-start justify-center w-[100%]`}
                           {...register('IBAN', { required: true })}
                           placeholder={t('IBAN')}
                        />
                        {errors.IBAN && (
                           <span className='text-red-500 text-xs mt-1 ms-2'>
                              {t('IBAN Error')}
                           </span>
                        )}
                     </div>

                     {/* Input 7 */}
                     <div className='w-[100%]'>
                        <div className='mb-2 font-semibold'>
                           {t('Facility Name')}
                        </div>
                        <input
                           type='text'
                           className={`h-[50px] px-4 bg-[#ececec] hover:bg-[#dadada] rounded-xl flex flex-col items-start justify-center w-[100%]`}
                           {...register('facility_name', { required: true })}
                           placeholder={t('Facility Name')}
                        />
                        {errors.facility_name && (
                           <span className='text-red-500 text-xs mt-1 ms-2'>
                              {t('Facility Name Error')}
                           </span>
                        )}
                     </div>

                     <div className='flex justify-start items-center gap-2 text-start font-bold'>
                        <FaStarOfLife size={10} className='text-red-500' />
                        <h1>{t('Must match the bank certificate')}</h1>
                     </div>
                  </div>
                  <button
                     type='submit'
                     className={`font-bold hover:bg-[#d6eb16]  bg-[var(--primary)] flex justify-center items-center gap-[3px] rounded-full transition-all delay-100  py-2 px-6 mb-6 text-[18px] leading-6`}
                  >
                     {t('Complete registration')}
                  </button>
               </form>
            </div>
         </div>
      </div>
   )
}

export default CompleteRegistration
