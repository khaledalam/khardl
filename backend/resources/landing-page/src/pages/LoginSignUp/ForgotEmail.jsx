import React, { useState } from "react";
import Logo from "../../assets/Logo_White.svg";
import ContactUsCover from "../../assets/ContactUsCover.webp";
import { useTranslation } from "react-i18next";
import { useNavigate } from "react-router-dom";
import { useForm } from "react-hook-form";
import { toast } from "react-toastify";
import AxiosInstance from "../../axios/axios";
import { CgSpinner } from "react-icons/cg";
import MainText from "../../components/MainText";
import { AiOutlineTeam, AiOutlineVerticalAlignMiddle } from "react-icons/ai";
import { useSelector } from "react-redux";
import { AiFillEyeInvisible, AiFillEye } from "react-icons/ai";

const ForgotEmail = () => {
  const { t } = useTranslation();
  const navigate = useNavigate();
  const [loading, setLoading] = useState(false);
  const [token, setToken] = useState(null);
 
  const Language = useSelector((state) => state.languageMode.languageMode);

  const [showOTP, setShowOTP] = useState(false); 

  const {
    register,
    handleSubmit,
    formState: { errors },
    resetField,
  } = useForm();

  // **API POST REQUEST**
  const onSubmit = async (data) => {
    if (loading) return;
    setLoading(true);

    try {
      const response = await AxiosInstance.post(`/password/forgot`, {
        emailOrPhone: data.email,
        otp: data.otp ?? null,
        token : token,
   
      });
      if (response.data.success) {
       

        toast.success(
          `${t("The verification code has been sent to your email")}`,
        );
        sessionStorage.setItem("email", data.email);
        navigate('/')
      } else {
        throw new Error(`${t("Failed to send verification code")}`);
      }
    } catch (error) {
      if (error.response && error.response.status === 423) {
        sessionStorage.setItem("email", data.email);
        toast.success(
          `${t("If phone number is registered with us, an OTP SMS will be sent")}`,
        );
        setShowOTP(true); 
        setToken(error.response?.data?.data?.id);
        resetField("email"); 
      } else {
        toast.error(error.response?.data?.message);

      }
    }
    setLoading(false);
  };
  /////////////////////////////////////////////////////////////////////////////////////

  return (
    <div className="flex flex-col items-stretch justify-center h-screen">
      <div
        className="flex justify-center items-center px-[40px] max-md:px-[0px]"
        style={{
          backgroundImage: `url(${ContactUsCover})`,
          backgroundSize: "cover",
        }}
      >
        <div className="py-[20px] flex justify-center items-center">
          <div className="py-[80px] max-md:py-[60px]">
            <div className="max-[860px]:w-[80vw] w-[450px] bg-white py-10 max-[860px]:px-2 shadow-lg rounded-2xl shadow-[#C0D123]">
              <div className="px-8 mb-6 flex flex-col items-center text-center">
                <MainText
                  Title={t("Forgot your email?")}
                  classTitle="!text-[28px] !w-[50px] !h-[8px] bottom-[-10px] max-[1000px]:bottom-[0px] max-[500px]:bottom-[5px] new-form-ui"
                />

                <p className="text-sm text-gray-700 mt-5">{t("Don't worry, just enter your phone number below and re-enter your new email!")}</p>
              </div>
              <form
                onSubmit={handleSubmit(onSubmit)}
                className="px-8 pt-2 pb-2 bg-white rounded new-form-ui"
              >
                  {showOTP && (
                  <div className="mb-6 text-center">
                    <label
                      className="block mb-4 text-sm text-start font-bold text-gray-700"
                      htmlFor="otp"
                    >
                      {t("Enter your SMS OTP code")}
                      <span className="text-red-500">*</span>
                    </label>
                    <input
                      type="text"
                      className={`w-[100%] mt-0 p-[10px] px-[16px] max-[540px]:py-[15px] boreder-none rounded-full bg-[var(--third)]`}
                      placeholder={t("Enter your SMS OTP code")}
                      {...register("otp", { required: true })}
                    />
                    {errors.otp && (
                      <span className="text-red-500 text-xs mt-1 ms-2">
                        {t("Maybe phone number is not registered or OTP code is wrong")}
                      </span>
                    )}
                  </div>
                )}
                <div className="mb-6 text-center">
                  <label
                    className="block mb-4 text-sm text-start font-bold text-gray-700"
                    htmlFor="email"
                  >
                    
                   {showOTP
                      ? t("Enter your new email address")
                      : t("Enter your Phone number")}
                  </label>
                  <input
                    type="text"
                    className={`w-[100%] mt-0 p-[10px] px-[16px] max-[540px]:py-[15px] boreder-none rounded-full bg-[var(--third)]`}
                    
                    {...register("email", { required: true })}
                  />
                  {errors.email && (
                    <span className="text-red-500 text-xs mt-1 ms-2">
                      {t("Email Error")}
                    </span>
                  )}
                </div>
               
             
             
                <div className="text-center">
                  <button
                    disabled={loading}
                    type="submit"
                    className={`submit-btn hover:bg-[#d6eb16] w-fit font-bold bg-[var(--primary)] rounded-full transition-all delay-100  py-2 px-6 text-[15px]`}
                  >
                    <span>
                      {loading && (
                        <div
                          role="status"
                          className="rounded-s-md  max-[860px]:rounded-b-lg max-[860px]:rounded-s-none absolute -translate-x-1/2 -translate-y-1/2 top-[39%] max-[860px]:top-[39.5%] left-1/2 w-[100%] h-[100%] "
                        >
                          <div className="rounded-s-md max-[860px]:rounded-b-lg max-[860px]:rounded-s-none relative bg-black opacity-25 flex justify-center items-center w-[100%] h-[100%]"></div>
                          <div className="absolute -translate-x-1/2 -translate-y-1/2 top-2/4 left-1/2 ">
                            <svg
                              aria-hidden="true"
                              className="w-8 h-8 mr-2 text-gray-200 animate-spin fill-[var(--primary)]"
                              viewBox="0 0 100 101"
                              fill="none"
                              xmlns="http://www.w3.org/2000/svg"
                            >
                              <path
                                d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                fill="currentColor"
                              />
                              <path
                                d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                fill="currentFill"
                              />
                            </svg>
                            <span className="sr-only">Loading...</span>
                          </div>
                        </div>
                      )}{" "}
                       {showOTP
                      ? t("Reset your account")
                      : t("Send verification code")}
                 
                    </span>
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default ForgotEmail;
