import React, {useEffect, useState} from "react"
import bgRegistration from "../../assets/register-bg.png"
import {useTranslation} from "react-i18next"
import MainText from "../../components/MainText"
import {FiUpload} from "react-icons/fi"
import {useForm} from "react-hook-form"
import {toast} from "react-toastify"
import {useNavigate} from "react-router-dom"
import {FaStarOfLife} from "react-icons/fa"
// import { useApiContext } from '../context'
import AxiosInstance from "../../axios/axios"
import {useAuthContext} from "../../components/context/AuthContext"

function CompleteRegistration() {
  const {t} = useTranslation()
  const navigate = useNavigate()

  const {setStatusCode} = useAuthContext()
  const [files, setFiles] = useState()
    const [loading, setLoading] = useState(false)

    const [needs, setNeeds] = useState([]);
    const [IBAN, setIBAN] = useState("");
    const [facilityName, setFacilityName] = useState("");

    const [fileUploadSuccess, setFileUploadSuccess] = useState({
    commercial_registration: false,
    tax_registration_certificate: false,
    national_address: false,
    identity_of_owner_or_manager: false,
    bank_certificate: false,
  })
  const [selectedFileNames, setSelectedFileNames] = useState({
    commercial_registration: "",
    tax_registration_certificate: "",
    national_address: "",
    identity_of_owner_or_manager: "",
    bank_certificate: "",
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
    formState: {errors},
  } = useForm()

    useEffect(() => {
        fetchStep2Data();
    }, []);

  // API POST REQUEST
  const onSubmit = async (data) => {
    if (loading) return
    setLoading(true)

    try {
        if(!selectedFiles.tax_registration_certificate){
            selectedFiles.tax_registration_certificate = null;
        }
      const response = await AxiosInstance.post(
        `/register-step2`,
        {
          commercial_registration: selectedFiles?.commercial_registration,
          tax_registration_certificate:
            selectedFiles?.tax_registration_certificate,
          bank_certificate: selectedFiles?.bank_certificate,
          identity_of_owner_or_manager:
            selectedFiles?.identity_of_owner_or_manager,
          national_address: selectedFiles?.national_address,
          IBAN: data?.IBAN,
          facility_name: data?.facility_name,
        },
        {
          headers: {
            Accept: "application/json",
            // * Don't remove *
            "Content-Type": "multipart/form-data",
            "X-CSRF-TOKEN": window.csrfToken,
          },
        }
      )

      if (response) {
        const responseData = await response?.data
        toast.success(
          `${t("Account creation has been completed successfully")}`
        )
        toast.info(
          `${t("You will be redirect to your new restaurant in 3 sec ...")}`
        )
        setTimeout(() => {
          setStatusCode(200)
          window.location.href = responseData.data.url
          // window.open(responseData.data.url, '_blank', 'noopener,noreferrer')
          // navigate('/');
        }, 5000)
      } else {
        throw new Error(`${t("Account creation failed to complete")}`)
      }
    } catch (error) {
      toast.error(`${t(error.response.data.message)}`)
    }
    setLoading(false)
  }


    const fetchStep2Data = async () => {
        if (loading) return
        setLoading(true)

        try {
            if(!selectedFiles.tax_registration_certificate){
                selectedFiles.tax_registration_certificate = null;
            }
            const response = await AxiosInstance.get(
                `/register-step2`,
                {
                    headers: {
                        Accept: "application/json",
                        // * Don't remove *
                        "Content-Type": "multipart/form-data",
                        "X-CSRF-TOKEN": window.csrfToken,
                    },
                }
            )

            if (response) {
                const responseData = await response?.data?.data

                setIBAN(responseData?.IBAN);
                setFacilityName(responseData?.facility_name);
                setNeeds(responseData?.needs)
                console.log("fetch: responseData", responseData);

            } else {

            }
        } catch (error) {
            toast.error(`${t(error.response.data.message)}`)
        }
        setLoading(false)
    }


    const getFileTitle = (field) => {
      return {
          'commercial_registration': 'Commercial Record',
          'tax_registration_certificate': 'Tax registration certificate',
          'bank_certificate': 'Bank certificate',
          'identity_of_owner_or_manager': 'Identity of the owner or manager',
          'national_address': 'National address'
      }[field] ?? 'file';
    }

  return (
    <div className='flex flex-col items-stretch justify-center '>
      <div
        className='flex justify-center items-center px-[40px] max-md:px-[0px]'
        style={{
          backgroundImage: `url(${bgRegistration})`,
          backgroundSize: "cover",
        }}
      >
        <div className='min-w-[60%] max-sm:min-w-[100%] flex h-[100%] flex-col justify-start items-center max-[860px]:w-[80vw] space-y-6 p-8 max-[860px]:p-4 bg-white m-6 rounded-2xl shadow-[0_-1px_8px_var(--primary)] '>
          <div className='mt-6 w-[100%]'>
            <MainText
              Title={t("Complete registration")}
              SubTitle={t("Complete registration Details")}
              classTitle='!text-[28px] !w-[50px] !h-[8px] bottom-[-10px] max-[1000px]:bottom-[0px] max-[500px]:bottom-[5px]'
              classSubTitle='max-w-[380px] !text-[14px] mb-4'
            />
          </div>
          <form
            onSubmit={handleSubmit(onSubmit)}
            className='flex flex-col items-center gap-6 w-[80%] max-sm:w-[90%]'
            encType='multipart/form-data'
          >

              {needs.map((fileField, idx) => {
                  return <div className='w-[100%]' key={idx}>
                      <div className='mb-2 font-semibold'>
                          {t(getFileTitle(fileField))} <span className='text-red-500'>*</span>
                          <p>
                              <small className='text-gray-500'>
                                  <i>
                                      {t("Accept")}: PDF, JPG, JPEG, PNG {t("size <= 16 MG")}
                                  </i>
                              </small>
                          </p>
                      </div>
                      <input
                          type='file'
                          accept='application/pdf,image/*'
                          {...register(fileField, {
                              required: true,
                          })}
                          id={`Input(${idx})`}
                          className='hidden'
                          onChange={(event) => {
                              setFileUploadSuccess({
                                  ...fileUploadSuccess,
                                  [fileField]: true,
                              })
                              const selectedFileName = event.target.files[0]
                              setSelectedFiles({
                                  ...selectedFiles,
                                  [fileField]: selectedFileName,
                              })
                              setSelectedFileNames({
                                  ...selectedFileNames,
                                  [fileField]: selectedFileName.name,
                              })
                          }}
                      />
                      <label
                          htmlFor={`Input(${idx})`}
                          className={`h-[130px] bg-[#ececec] hover:bg-[#dadada] text-[#04020550] rounded-xl flex flex-col items-center justify-center gap-2 cursor-pointer`}
                      >
                          <FiUpload size={24} />
                          <h1>{t("Attach a PDF file")}</h1>
                      </label>
                      {fileUploadSuccess[fileField] && (
                          <span className='text-green-500 text-xs mt-1 ms-2'>
                  {t("File uploaded successfully")}
                </span>
                      )}
                      {selectedFileNames[fileField] && (
                          <span className='text-blue-500 text-xs mt-1 ms-2'>
                  {selectedFileNames[fileField]}
                </span>
                      )}
                      {errors[fileField] &&
                      !fileUploadSuccess[fileField] &&
                      !selectedFileNames[fileField] && (
                          <span className='text-red-500 text-xs mt-1 ms-2'>
                    {t("File Error")}
                  </span>
                      )}
                  </div>
              })}


            {/* Input 6 */}
            <div className='w-[100%] flex flex-col items-start gap-4'>
              <div className='w-[100%]'>
                <div className='mb-2 font-semibold'>
                  {t("Bank IBAN")}
                  <span className='text-red-500'>*</span>
                </div>
                <input
                  type='text'
                  className={`h-[50px] px-4 bg-[#ececec] hover:bg-[#dadada] rounded-xl flex flex-col items-start justify-center w-[100%]`}
                  value={IBAN}
                  onChange={e => setIBAN(e.target.value)}
                  {...register("IBAN", {required: true})}
                  placeholder={t("IBAN")}
                />
                {errors.IBAN && (
                  <span className='text-red-500 text-xs mt-1 ms-2'>
                    {t("IBAN Error")}
                  </span>
                )}
              </div>

              {/* Input 7 */}
              <div className='w-[100%]'>
                <div className='mb-2 font-semibold'>
                  {t("Facility Name")}
                  <span className='text-red-500'>*</span>
                </div>
                <input
                  minLength={5}
                  type='text'
                  value={facilityName}
                  onChange={e => setFacilityName(e.target.value)}
                  className={`h-[50px] px-4 bg-[#ececec] hover:bg-[#dadada] rounded-xl flex flex-col items-start justify-center w-[100%]`}
                  {...register("facility_name", {required: true})}
                  placeholder={t("Facility Name")}
                />
                {errors.facility_name && (
                  <span className='text-red-500 text-xs mt-1 ms-2'>
                    {t("Facility Name Error")}
                  </span>
                )}
              </div>

              <div className='flex justify-start items-center gap-2 text-start font-bold'>
                <FaStarOfLife size={10} className='text-red-500' />
                <h1>{t("Must match the bank certificate")}</h1>
              </div>
            </div>
            <button
              disabled={loading}
              type='submit'
              className={`font-bold hover:bg-[#d6eb16]  bg-[var(--primary)] flex justify-center items-center gap-[3px] rounded-full transition-all delay-100  py-2 px-6 mb-6 text-[18px] leading-6`}
            >
              <span>
                {loading && (
                  <div
                    role='status'
                    className='fixed top-0 right-0 h-screen w-screen z-10'
                  >
                    <div className='rounded-s-md max-[860px]:rounded-b-lg max-[860px]:rounded-s-none relative bg-black opacity-25 flex justify-center items-center w-[100%] h-[100%]'/>
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
                      <span className='sr-only'>Loading...</span>
                    </div>
                  </div>
                )}{" "}
                {t("Complete registration")}
              </span>
            </button>
          </form>
        </div>
      </div>
    </div>
  )
}

export default CompleteRegistration
