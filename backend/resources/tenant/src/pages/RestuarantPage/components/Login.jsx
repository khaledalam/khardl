import React, {useEffect, useRef, useState} from "react";
import Logo from "../../../assets/Logo_White.svg";
import ContactUsCover from "../../../assets/ContactUsCover.webp";
import { useTranslation } from "react-i18next";
import MainText from "../../../components/MainText";
import { Link, useNavigate } from "react-router-dom";
import { useForm } from "react-hook-form";
import { AiFillEye, AiFillEyeInvisible } from "react-icons/ai";
import { toast } from "react-toastify";
import {
  PREFIX_KEY,
  HTTP_NOT_AUTHENTICATED,
  HTTP_NOT_VERIFIED,
  HTTP_OK,
} from "../../../config";
import { useSelector, useDispatch } from "react-redux";
import { changeLogState, changeUserState } from "../../../redux/auth/authSlice";
import { setIsOpen } from "../../../redux/features/drawerSlice";
import { useAuthContext } from "../../../components/context/AuthContext";
import AxiosInstance from "../../../axios/axios";
import {
  changeRestuarantEditorStyle,
  SetRegisterModal,
  SetLoginModal,
} from "../../../redux/NewEditor/restuarantEditorSlice";
import imgLogo from "../../../assets/Logo_White.svg";
import SA from "../../../assets/SA.png";
import Down from "../../../assets/down.svg";
import { getCartItemsCount } from "../../../redux/NewEditor/categoryAPISlice";
import { GrPowerReset } from "react-icons/gr";

const Login = ({ closingFunc }) => {
  const restaurantStyle = useSelector((state) => state.restuarantEditorStyle);
  const [openEyePassword, setOpenEyePassword] = useState(false);
  const [spinner, setSpinner] = useState(false);
  const [isLoading, setisLoading] = useState(true);
  const dispatch = useDispatch();
  const { setStatusCode } = useAuthContext();

  const { t } = useTranslation();
  const navigate = useNavigate();

  const loginFormRef = useRef();

  const {
    register: register,
    handleSubmit: handleSubmit,
    formState: { errors: errors },
  } = useForm();
  const {
    register: register2,
    handleSubmit: handleSubmit1,
    formState: { errors: errors2 },
  } = useForm();
  const { handleSubmit: handleSubmit2 } = useForm();
  const Language = useSelector((state) => state.languageMode.languageMode);

  const [showOTP, setShowOTP] = useState(false);

  const EyePassword = () => {
    setOpenEyePassword(!openEyePassword);
  };

  // **API POST REQUEST**
  const fetchResStyleData = async () => {
    try {
      AxiosInstance.get(`restaurant-style`).then((response) => {
        dispatch(changeRestuarantEditorStyle(response.data?.data));
      });
      setisLoading(false);
    } catch (error) {
      // toast.error(`${t('Failed to send verification code')}`)
      console.log(error);
      setisLoading(false);
    }
  };
  const onSubmit = async (data) => {
    try {
      setSpinner(true);

      let sms_id = {};
      if (localStorage.getItem("phone_sms_otp_id")?.length > 0) {
        sms_id["id_sms"] = localStorage.getItem("phone_sms_otp_id");
      }
      const response = await AxiosInstance.post(`/login-tenant`, {
        phone: data.phone,
        otp: otp,
        ...sms_id,
        // remember_me: data.remember_me, // used only in API token-based
      });

      if (response?.data?.success) {
        const responseData = response?.data;
        localStorage.setItem(
          "user-info",
          JSON.stringify(responseData?.data?.user)
        );
        if (responseData.data.user.status === "inactive") {
          sessionStorage.setItem(
            PREFIX_KEY + "phone",
            responseData?.data?.user?.phone
          );

          const userRole = responseData.data.user.roles[0]?.name || "Customer";
          localStorage.setItem("user-role", userRole);

          setStatusCode(HTTP_NOT_VERIFIED);
          // navigate("/verification-phone");
          setShowOTP(true);
        } else if (responseData.data.user.status === "active") {
          setStatusCode(HTTP_OK);
          dispatch(changeLogState(true));
          dispatch(changeUserState(responseData?.data?.user || null));
          dispatch(setIsOpen(false));
          toast.success(`${t("You have been logged in successfully")}`);
          closingFunc();
        } else {
          navigate("/error");
        }
      }
    } catch (error) {
      if (localStorage.getItem("phone_sms_otp_id")?.length > 0) {
        localStorage.setItem("phone_sms_otp_id", "");
      }

      if (error?.response?.status == 400) {
        setShowOTP(true);
        if (error?.response?.data?.data?.id) {
          localStorage.setItem(
            "phone_sms_otp_id",
            error?.response?.data?.data?.id
          );
        }
        toast.info(
          error?.response?.data?.message ||
            `${t("The code has been sent successfully")}`
        );
        return;
      } else if (error?.response?.status == 403) {
        toast.error(
          error?.response?.data?.message ||
            `${t("The code has been sent successfully")}`
        );
        return;
      }
      console.log("error response > ", error);
      setSpinner(false);
      dispatch(changeLogState(false));
      dispatch(changeUserState(null));
      setStatusCode(HTTP_NOT_AUTHENTICATED);
      if (error?.response?.data?.message === "Validation Error.") {
        toast.error(t("Please register yourself first."));
      } else {
        toast.error(error?.response?.data?.message);
      }
    }
  };

  const restuarantStyle = useSelector((state) => state.restuarantEditorStyle);

  let user_phone = sessionStorage.getItem(PREFIX_KEY + "phone") || "";

  const [showForm, setShowForm] = useState(false);
  const [countdown, setCountdown] = useState(90);
  const [canResend, setCanResend] = useState(false);
  const [showCountdownText, setShowCountdownText] = useState(true);
  const [otp, setOtp] = useState("");

  const resetTimer = () => {
    setCountdown(90);
    setCanResend(false);
    startTimer();
  };

  // if (!user_phone) {
  //   window.location.href = "/logout";
  // }

  // API POST REQUEST
  const ResendCode = async (data) => {
    try {
      setSpinner(true);
      resetTimer();
      const response = await AxiosInstance.post(`/phone/send-verify`, {
        phone: loginFormRef.current?.phone?.value,
      });
      if (response.data) {
        toast.success(`${t("The code has been re-sent successfully")}`);
      } else {
        throw new Error(`${t("Code resend failed")}`);
      }
    } catch (error) {
      toast.error(`${t("Code resend failed")}`);
    }
    setSpinner(false);
  };

  // API POST REQUEST
  // TODO @todo startTimer is still working after verification , look at console after verification
  const startTimer = () => {
    const timer = setInterval(() => {
      setCountdown((prevCountdown) => {
        if (prevCountdown === 1) {
          clearInterval(timer);
          setCanResend(true);
          setShowCountdownText(false);
          return 0;
        } else if (prevCountdown > 0) {
          setShowCountdownText(true);
          return prevCountdown - 1;
        } else {
          clearInterval(timer);
          setShowCountdownText(false);
          return 0;
        }
      });
    }, 1000);
    return timer;
  };

  useEffect(() => {
    if (showOTP) {
      resetTimer();
    }
  }, [showOTP]);


  const [lengthOfPhone, setLengthOfPhone] = useState(0);

  return (
    <div className="w-full max-w-[400px] bg-white p-[40px] rounded-[30px] flex flex-col items-center mx-auto">
      <div className="mb-[24px]">
        <img
          src={restaurantStyle?.logo ? restaurantStyle.logo : imgLogo}
          alt="logo"
          className={`w-[60px] h-[60px] object-cover`}
          style={{
            borderRadius: restaurantStyle?.logo_border_radius
              ? restaurantStyle?.logo_border_radius + "%"
              : "50%",
            border: `1px solid ${restaurantStyle?.logo_border_color}`,
          }}
        />
      </div>
      <div className="text-center text-neutral-700 text-3xl font-medium mb-[12px] leading-[38px]">
        {restaurantStyle?.restaurant_name}
      </div>
      <div className="text-center text-zinc-600 text-base font-normal leading-normal">
        {t("Login")}
      </div>
      <form
        ref={loginFormRef}
        onSubmit={handleSubmit(onSubmit)}
        className="w-[100%] flex flex-col items-center mt-[40px]"
      >
        <div className="flex mb-[20px] w-full" dir={"rtl"}>
          <div className="ml-[8px] w-full">
            <input
              type="tel"
              className={`w-[100%] h-[38px] px-4 py-[7px] bg-white rounded-[50px] border border-gray-200 justify-start items-center gap-1.5 inline-flex text-zinc-500 text-xs font-normal leading-[18px] outline-none`}
              placeholder={t("Your phone number")}
              {...register("phone", {
                required: true,
              })}
              onChange={(event) => {
                let temp = "";
                for (let i = 0; i < event.target.value.length; i += 1) {
                  if (
                    event.target.value[i] >= '0' &&
                    event.target.value[i] <= '9'
                  ) {
                    temp += event.target.value[i];
                  }
                }

                if (temp.length == 10 && temp[0] != '0') {
                  event.preventDefault();
                } else {
                  event.target.value = temp;
                  setLengthOfPhone(event.target.value.length);
                  // console.log(data.target.value.length);
                }


              }}
              minLength={10}
              maxLength={10}
              onKeyDown={(event) => {
                if (
                  event.ctrlKey &&
                  event.key === "v"
                ) {
                } else if (
                  (event.which < 48 || event.which > 57) &&
                  (event.which < 96 || event.which > 105) &&
                  event.which !== 8 &&
                  event.which !== 46 &&
                  event.which !== 37 &&
                  event.which !== 39 &&
                  !event.ctrlKey
                ) {
                  event.preventDefault();
                }



                console.log(event.target.value);



              }}
            />
            {errors.phone && (
              <span className="text-red-500 text-xs mt-1 ms-2">
                {t("Phone Error")}
              </span>
            )}
          </div>
          <div className="w-[84px] h-[38px] p-1 rounded-[50px] border border-gray-200 justify-start items-center gap-1 inline-flex relative">
            <div className="w-[15px] h-[15px] py-0.5 flex-col justify-center items-center gap-2.5 inline-flex" />

            <div
              dir={"ltr"}
              className="text-zinc-500 text-xs font-normal font-['Plus Jakarta Sans'] leading-[18px]"
            >
              +966
            </div>

            <div className="w-6 h-6 relative bg-[#6DA544] rounded-full">
              <div className="w-[13.83px] h-[10.43px] left-[5.09px] top-[6.78px] absolute">
                <img
                  src={SA}
                  alt="SA flag"
                  className="w-full h-full object-cover"
                />
              </div>
            </div>

            <div className="w-9 h-[11px] px-1 bg-white justify-start items-center gap-2.5 inline-flex absolute top-[-8px] left-[8px]">
              <div className="text-zinc-500 text-[9px] font-normal font-['Plus Jakarta Sans']">
                {t("Phone number")}
              </div>
            </div>
          </div>
        </div>

        {showOTP && (
          <>
            <div className="px-8 mb-3 flex flex-col items-center text-center">
              <h3 className="mb-3 text-[12px] font-normal leading-[18px]">
                {t("Enter your SMS OTP code")}
              </h3>
              <span className="text-[12px] text-[#3B3B3B]">
                {t("We sent a code to")}{" "}
                {user_phone ? (
                  <span className="text-[12px] text-[#3B3B3B]">
                    {user_phone}
                  </span>
                ) : (
                  <p></p>
                )}
              </span>
            </div>
            <div
              // onSubmit={handleSubmit1(onSubmitOTP)}
              className="w-full bg-white rounded"
            >
              <div className="text-center">
                <div className="w-[100%] h-[38px] mt-0 p-[7px] boreder-none rounded-full bg-white flex border border-gray-200 ">
                  <div className="w-[24px] h-[24px] bg-[#7D0A0A] flex justify-center items-center text-white text-[10px] rounded-full">
                    {`${countdown}s`}
                  </div>
                  <input
                    onChange={(e) => {
                      setOtp(e.target.value);
                    }}
                    minLength={4}
                    maxLength={4}
                    type="text"
                    className="bg-white w-full h-full outline-none px-[15px]"
                    placeholder={t("OTP")}
                    onKeyDown={(event) => {
                      if (
                        (event.which < 48 || event.which > 57) &&
                        (event.which < 96 || event.which > 105) &&
                        event.which !== 8 &&
                        event.which !== 46 &&
                        event.which !== 37 &&
                        event.which !== 39
                      ) {
                        event.preventDefault();
                      }
                    }}
                    // {...register2("otp", {
                    //     required: true,
                    // })}
                  />
                </div>

                {errors2.otp && (
                  <span className="text-red-500 text-xs mt-1 ms-2">
                    {t("Validation code Error")}
                  </span>
                )}
              </div>
            </div>
            <div className="mt-4 flex justify-between items-center gap-3">
              {/* {showCountdownText && (
                                <p className="text-sm px-8 pb-4">
                                    {t("Resend the code in")} {countdown}{" "}
                                    {t("seconds")}
                                </p>
                            )} */}
              <div className="px-8 pb-4 bg-white rounded">
                <div className="text-center flex items-center gap-2">
                  {!showCountdownText && (
                    <span className="text-[10px]">
                      {t("Still didn't get it? ")}
                      <span
                        onClick={ResendCode}
                        className="text-[#7D0A0A] text-[10px] font-semibold hover:cursor-pointer"
                      >
                        {t("Resend now.")}
                      </span>
                    </span>
                  )}
                </div>
              </div>
            </div>
          </>
        )}

        <div className="flex flex-col justify-center items-center mt-4 mb-10 w-full">
          <button
            type="submit"
            className={`w-full h-8 px-4 pt-1.5 pb-2 ${
              lengthOfPhone >= 9 ? "bg-red-900" : "bg-[#E7E8EA]"
            } rounded-[50px] border justify-center items-center gap-1 inline-flex text-white text-xs font-normal leading-[18px]`}
          >
            {t("Login")}
          </button>
          <p className="text-[12px] font-normal leading-[18px] mt-1">
            {t("Don't have an account?")}
            <input
              type="button"
              className="text-[#7D0A0A] cursor-pointer hover:text-blue-300 py-2 px-2 text-md "
              value={t("Register here")}
              onClick={() => {
                dispatch(SetLoginModal(false));
                dispatch(SetRegisterModal(true));
              }}
            />
          </p>
        </div>
      </form>
    </div>
  );
};

export default Login;
