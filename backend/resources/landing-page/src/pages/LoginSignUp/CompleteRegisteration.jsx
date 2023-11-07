import React, { useState } from 'react'
import bgRegisteration from '../../assets/bgRegisteration.webp';
import { useTranslation } from "react-i18next";
import MainText from "../../components/MainText";
import { FiUpload } from 'react-icons/fi'
import { useForm } from 'react-hook-form';
import { toast } from 'react-toastify';
import { useNavigate } from 'react-router-dom';
import { useSelector } from 'react-redux';

function CompleteRegisteration() {
  const { t } = useTranslation();
  const navigate = useNavigate();
  const { handleSubmit,register, formState: { errors } } = useForm();
  const [enabled, setEnabled] = useState(true);
  const Language = useSelector((state) => state.languageMode.languageMode);

  /////////////////////////////////////////////////////////////////////////////////////
  // API POST REQUEST 
  const onSubmit = async (data) => {
    try {
      const formData = new FormData();
      formData.append('commercial_record', data.commercial_record);
      formData.append('tax_number', data.tax_number);
      formData.append('bank_certificate', data.bank_certificate);
      formData.append('national_address', data.national_address);
      formData.append('Identity_of_the_owner_or_manager', data.Identity_of_the_owner_or_manager);
      formData.append('delivery_company', data.delivery_company);

      let response = await fetch('http://127.0.0.1:8000/api/register', {
        method: 'POST',
        body: formData,
      });

      if (response.ok) {
        const responseData = await response.json();
        console.log(responseData);
        toast.success(`${t("Account successfully created")}`);
        navigate('/login');
        sessionStorage.setItem('user-info', JSON.stringify(responseData));
      } else {
        throw new Error(`${t("Account creation failed")}`);
      }
    } catch (error) {
      toast.error(`${t("Account creation failed")}`)
    }
  };
  /////////////////////////////////////////////////////////////////////////////////////

  return (
    <div className="flex justify-center items-center px-[40px] max-[400px]:px-[20px] py-[40px]"
      style={{
        backgroundImage: `url(${bgRegisteration})`,
        backgroundSize: "cover",
      }}>
      <div className="min-w-[60%] flex flex-col justify-start items-center max-[860px]:w-[80vw] space-y-6 p-8 max-[860px]:p-4 ">
        <div className='mt-6'>
          <MainText
            Title={t("Complete registration")}
            SubTitle={t("Default Text")}
            classTitle="!text-[28px] !w-[50px] !h-[8px] bottom-[-10px] max-[1000px]:bottom-[0px] max-[500px]:bottom-[5px]"
            classSubTitle="max-w-[380px] !text-[14px] my-4"
          />
        </div>
        <form onSubmit={handleSubmit(onSubmit)} className='flex flex-col items-center gap-6 w-[80%]'>
          {/* First Input */}
          <div className="w-[100%]">
            <div className='mb-2 font-semibold'>{t("Commercial Record")}</div>
            <input
              type="file"
              accept="image/*, application/pdf"
              {...register("commercial_record", { required: true })}
              id="Input(1)"
              className="hidden"
            />
            <label
              data-tooltip-target="tooltip-light"
              data-tooltip-style="light"
              htmlFor="Input(1)"
              className={`h-[130px] bg-[#ececec] hover:bg-[#dadada] text-[#04020550] rounded-xl flex flex-col items-center justify-center gap-2 cursor-pointer`}
            >
              <FiUpload size={24} />
              <h1>{t("Attach an image/PDF file")}</h1>
            </label>
            {errors.commercial_record && <span className='text-red-500 text-xs mt-1 ms-2'>{t("Commercial Record Error")}</span>}
          </div>

          {/* Input 1 */}
          <div className="w-[100%]">
            <div className='mb-2 font-semibold'>{t("Tax Number")}</div>
            <input
              type="file"
              accept="image/*, application/pdf"
              id="Input(2)"
              {...register("tax_number", { required: true })}
              className="hidden"
            />
            <label
              data-tooltip-target="tooltip-light"
              data-tooltip-style="light"
              htmlFor="Input(2)"
              className={`h-[130px] bg-[#ececec] hover:bg-[#dadada] text-[#04020550] rounded-xl flex flex-col items-center justify-center gap-2 cursor-pointer`}
            >
              <FiUpload size={24} />
              <h1>{t("Attach an image/PDF file")}</h1>
            </label>
            {errors.tax_number && <span className='text-red-500 text-xs mt-1 ms-2'>{t("Tax Number Error")}</span>}
          </div>

          {/* Input 2 */}
          <div className="w-[100%]">
            <div className='mb-2 font-semibold'>{t("Bank certificate")}</div>
            <input
              type="file"
              accept="image/*, application/pdf"
              id="Input(3)"
              {...register("bank_certificate", { required: true })}
              className="hidden"
            />
            <label
              data-tooltip-target="tooltip-light"
              data-tooltip-style="light"
              htmlFor="Input(3)"
              className={`h-[130px] bg-[#ececec] hover:bg-[#dadada] text-[#04020550] rounded-xl flex flex-col items-center justify-center gap-2 cursor-pointer`}
            >
              <FiUpload size={24} />
              <h1>{t("Attach an image/PDF file")}</h1>
            </label>
            {errors.bank_certificate && <span className='text-red-500 text-xs mt-1 ms-2'>{t("Bank certificate Error")}</span>}
          </div>

          {/* Input 3 */}
          <div className="w-[100%]">
            <div className='mb-2 font-semibold'>{t("National address")}</div>
            <input
              type="file"
              accept="image/*, application/pdf"
              id="Input(4)"
              {...register("national_address", { required: true })}
              className="hidden"
            />
            <label
              data-tooltip-target="tooltip-light"
              data-tooltip-style="light"
              htmlFor="Input(4)"
              className={`h-[130px] bg-[#ececec] hover:bg-[#dadada] text-[#04020550] rounded-xl flex flex-col items-center justify-center gap-2 cursor-pointer`}
            >
              <FiUpload size={24} />
              <h1>{t("Attach an image/PDF file")}</h1>
            </label>
            {errors.national_address && <span className='text-red-500 text-xs mt-1 ms-2'>{t("National address Error")}</span>}
          </div>

          {/* Input 4 */}
          <div className="w-[100%]">
            <div className='mb-2 font-semibold'>{t("Identity of the owner or manager")}</div>
            <input
              type="file"
              accept="image/*, application/pdf"
              id="Input(5)"
              {...register("Identity_of_the_owner_or_manager", { required: true })}
              className="hidden"
            />
            <label
              data-tooltip-target="tooltip-light"
              data-tooltip-style="light"
              htmlFor="Input(5)"
              className={`h-[130px] bg-[#ececec] hover:bg-[#dadada] text-[#04020550] rounded-xl flex flex-col items-center justify-center gap-2 cursor-pointer`}
            >
              <FiUpload size={24} />
              <h1>{t("Attach an image/PDF file")}</h1>
            </label>
            {errors.Identity_of_the_owner_or_manager && <span className='text-red-500 text-xs mt-1 ms-2'>{t("Identity of the owner or manager Error")}</span>}
          </div>

          {/* Toggle Switch */}
          <div className='flex flex-col justify-stert items-start gap-3 self-start'>
          <h2 className='text-start'>{t("delivery company?")}</h2>
          <div className="relative flex flex-col items-center justify-center overflow-hidden">
            <div className="flex">
              <label className="inline-flex relative items-center ml-5 cursor-pointer">
                <input type="checkbox"
                  {...register("delivery_company")}
                  value={t("yes")} className="sr-only peer"  checked={!enabled} readOnly />
                <button
                  onClick={() => {
                    setEnabled(!enabled);
                  }}
                  value={t("yes")}
                  className={`w-[150px] h-[35px] bg-white rounded-full peer  peer-focus:ring-green-300 peer-checked:after:border-white border-gray-300 border ${Language === "en" ? "peer-checked:after:-translate-x-full" : "peer-checked:after:translate-x-full"} ${Language === "en" ? (enabled ? "after:content-['yes'] after:rounded-e-full" : "after:content-['Later'] after:rounded-s-full") : (enabled ? "after:content-['نعم'] after:rounded-e-full" : "after:content-['لاحقاً'] after:rounded-s-full")} after:absolute after:top-[0px] after:right-[50%] after:left-[50%] after:font-bold after:pt-[5px] after:bg-[var(--primary)] after:border-gray-300 after:border after:h-[35px] after:w-[50%] after:transition-all peer-checked:!bg-white`} >
                  <div className='flex justify-between items-center px-4'>
                    <div>{t("yes")}</div>
                    <div>{t("Later")}</div>
                  </div>
                </button>
              </label>
            </div>
          </div>
          </div>

          <button
            type="submit"
            className={`font-bold bg-[var(--primary)] flex justify-center items-center gap-[3px] rounded-full transition-all delay-100  py-2 px-6 text-[18px] leading-6`}
          >
            {t("Complete registration")}
          </button>
        </form>
      </div>
    </div>
  )
}

export default CompleteRegisteration;
