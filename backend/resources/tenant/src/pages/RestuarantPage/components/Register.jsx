import React, { useEffect, useState } from "react";
import Logo from "../../../assets/Logo.webp";
import ContactUsCover from "../../../assets/ContactUsCover.webp";
import { useTranslation } from "react-i18next";
import MainText from "../../../components/MainText";
import { Link } from "react-router-dom";
import { set, useForm } from "react-hook-form";
import { toast } from "react-toastify";
import { useNavigate } from "react-router-dom";
import { AiFillEyeInvisible, AiFillEye } from "react-icons/ai";
import { useDispatch, useSelector } from "react-redux";
import AxiosInstance from "../../../axios/axios";
import { PREFIX_KEY } from "../../../config";
import imgLogo from "../../../assets/khardl_Logo.png";
import SA from "../../../assets/SA.png";
import Down from "../../../assets/down.svg";
import { getCartItemsCount } from "../../../redux/NewEditor/categoryAPISlice";
import {
    changeRestuarantEditorStyle,
    SetRegisterModal,
    SetLoginModal,
} from "../../../redux/NewEditor/restuarantEditorSlice";

import { useAuthContext } from "../../../components/context/AuthContext";
import { HTTP_OK } from "../../../config";

const Register = ({ closingFunc }) => {
    const navigate = useNavigate();
    const { t } = useTranslation();

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

    const { setStatusCode } = useAuthContext();

    const [openEyePassword, setOpenEyePassword] = useState(false);
    const [openEyeRePassword, setOpenEyeRePassword] = useState(false);
    const [isLoading, setisLoading] = useState(true);
    const Language = useSelector((state) => state.languageMode.languageMode);
    const [spinner, setSpinner] = useState(false);
    const restaurantStyle = useSelector((state) => state.restuarantEditorStyle);
    const dispatch = useDispatch();
    const EyePassword = () => {
        setOpenEyePassword(!openEyePassword);
    };
    const EyeRePassword = () => {
        setOpenEyeRePassword(!openEyeRePassword);
    };

    /////////////////////////////////////////////////////////////////////////////////////
    // API POST REQUEST
    const onSubmit = async (data) => {
        try {
            setSpinner(true);
            const response = await AxiosInstance.post(`/phone/verify`, {
                otp: otp,
            });

            if (response.data || response.is_loggedin) {
                setStatusCode(HTTP_OK);
                // navigate("/");
                const res = await AxiosInstance.post(`/register`, {
                    first_name: data.first_name,
                    last_name: data.last_name,
                    email: data.email,
                    phone: data.phone,
                    // terms_and_policies: data.terms_and_policies,
                });
                sessionStorage.setItem(PREFIX_KEY + "phone", data.phone);
                toast.success(
                    `${t("The code has been verified successfully")}`
                );
                toast.success(`${t("Account successfully created")}`);
                setSpinner(false);
                closingFunc();
            } else {
                throw new Error(`${t("Code verification failed")}`);
            }
            // setSpinner(false);
            // toast.success(`${t("Account successfully created")}`);
            // sessionStorage.setItem(PREFIX_KEY + "phone", data.phone);
            // window.location.href = "/verification-phone";
            // setShowOTP(true);
        } catch (error) {
            setSpinner(false);
            console.log(error);

            // if (error.response.data.errors?.length > 0) {
            //     setError(error.response.data.errors);
            // }

            // Object.keys(error.response.data.errors).forEach((field) => {
            //    setError(field, {'message':error.response.data.errors[field][0]});
            // });
            toast.error(`${t(error.response.data.message)}`);
        }
    };
    /////////////////////////////////////////////////////////////////////////////////////
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

    const restuarantStyle = useSelector((state) => state.restuarantEditorStyle);

    let user_phone = sessionStorage.getItem(PREFIX_KEY + "phone") || "";

    const [showForm, setShowForm] = useState(false);
    const [countdown, setCountdown] = useState(30);
    const [canResend, setCanResend] = useState(false);
    const [showCountdownText, setShowCountdownText] = useState(true);
    const [showOTP, setShowOTP] = useState(false);
    const [otp, setOtp] = useState("");

    const resetTimer = () => {
        setCountdown(30);
        setCanResend(false);
        startTimer();
    };

    // if (!user_phone) {
    //     window.location.href = "/logout";
    // }

    // API POST REQUEST
    const ResendCode = async (data) => {
        try {
            setSpinner(true);
            resetTimer();
            const response = await AxiosInstance.post(`/phone/send-verify`, {});
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
    // const onSubmitOTP = async (data) => {
    //     try {
    //         const response = await AxiosInstance.post(`/phone/verify`, {
    //             otp: otp,
    //         });

    //         console.log("otp, response: ", response.data);

    //         if (response.data) {
    //             setStatusCode(HTTP_OK);
    //             // navigate("/");
    //             toast.success(
    //                 `${t("The code has been verified successfully")}`
    //             );
    //             toast.success(`${t("Account successfully created")}`);
    //             closingFunc();
    //         } else {
    //             throw new Error(`${t("Code verification failed")}`);
    //         }
    //     } catch (error) {
    //         // TODO @todo print error message
    //         toast.error(`${t("Code verification failed")}`);
    //     }
    // };
    // TODO @todo startTimer is still working after verification , look at console after verification
    const startTimer = () => {
        const timer = setInterval(() => {
            // console.log(3);
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
        resetTimer();
        let timer = startTimer();
        // fetchResStyleData();
    }, [showOTP]);

    /////////////////////////////////////////////////////////////////////////////////////
    useEffect(() => {
        fetchResStyleData();
    }, []);

    const [lengthOfPhone, setLengthOfPhone] = useState(0);

    return (
        <div className="w-full max-w-[400px] bg-white p-[40px] rounded-[30px] flex flex-col items-center ">
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
                {t("Register")}
            </div>
            <form
                onSubmit={handleSubmit(onSubmit)}
                className="w-[100%] flex flex-col items-center mt-[40px]"
            >
                <div className="flex mb-[20px] w-full relative">
                    <input
                        type="text"
                        className="w-full h-8 px-4 py-[7px] bg-white rounded-[50px] border border-gray-200 justify-start items-center gap-1.5 inline-flex text-zinc-500 text-xs font-normal leading-[18px] outline-none"
                        placeholder={t("Write your first name here...")}
                        {...register("first_name", { required: true })}
                    />
                    <div className="h-[11px] px-1 bg-white justify-start items-center gap-2.5 inline-flex absolute top-[-8px] left-[8px]">
                        <div className="text-zinc-500 text-[9px] font-normal">
                            {t("First name")}
                            <span className="text-red-500">*</span>
                        </div>
                    </div>
                </div>
                <div className="flex mb-[20px] w-full relative">
                    <input
                        type="text"
                        className="w-full h-8 px-4 py-[7px] bg-white rounded-[50px] border border-gray-200 justify-start items-center gap-1.5 inline-flex text-zinc-500 text-xs font-normal leading-[18px] outline-none"
                        placeholder={t("Write your last name here....")}
                        {...register("last_name", { required: true })}
                    />
                    <div className="h-[11px] px-1 bg-white justify-start items-center gap-2.5 inline-flex absolute top-[-8px] left-[8px]">
                        <div className="text-zinc-500 text-[9px] font-normal">
                            {t("Last name")}
                            <span className="text-red-500">*</span>
                        </div>
                    </div>
                </div>
                <div className="flex mb-[20px] w-full">
                    <div className="w-[84px] h-8 p-1 rounded-[50px] border border-gray-200 justify-start items-center gap-1 inline-flex relative">
                        <div className="w-6 h-6 relative bg-[#6DA544] rounded-full">
                            <div className="w-[13.83px] h-[10.43px] left-[5.09px] top-[6.78px] absolute">
                                <img
                                    src={SA}
                                    alt="SA flag"
                                    className="w-full h-full object-cover"
                                />
                            </div>
                        </div>
                        <div className="text-zinc-500 text-xs font-normal font-['Plus Jakarta Sans'] leading-[18px]">
                            +966
                        </div>
                        <div className="w-[15px] h-[15px] py-0.5 flex-col justify-center items-center gap-2.5 inline-flex">
                            {/* <img
                                src={Down}
                                alt="down"
                                className="w-[8.17px] h-[4.67px] object-cover"
                            /> */}
                        </div>
                        <div className="w-9 h-[11px] px-1 bg-white justify-start items-center gap-2.5 inline-flex absolute top-[-8px] left-[8px]">
                            <div className="text-zinc-500 text-[9px] font-normal font-['Plus Jakarta Sans']">
                                {t("Phone number")}
                                <span className="text-red-500">*</span>
                            </div>
                        </div>
                    </div>
                    <div className="ml-[8px] w-full">
                        <input
                            type="tel"
                            className={`w-[100%] h-8 px-4 py-[7px] bg-white rounded-[50px] border border-gray-200 justify-start items-center gap-1.5 inline-flex text-zinc-500 text-xs font-normal leading-[18px] outline-none`}
                            placeholder={t("Your phone number")}
                            {...register("phone", {
                                required: true,
                            })}
                            onChange={(data) => {
                                setLengthOfPhone(data.target.value.length);
                                // console.log(data.target.value.length);
                            }}
                            minLength={9}
                            maxLength={13}
                        />
                        {errors.phone && (
                            <span className="text-red-500 text-xs mt-1 ms-2">
                                {t("Phone Error")}
                            </span>
                        )}
                    </div>
                </div>
                <div className="flex mb-[20px] w-full relative">
                    <input
                        type="email"
                        className="w-full h-8 px-4 py-[7px] bg-white rounded-[50px] border border-gray-200 justify-start items-center gap-1.5 inline-flex text-zinc-500 text-xs font-normal leading-[18px] outline-none"
                        placeholder={t("Write your email address here...")}
                        {...register("email", { required: true })}
                    />
                    <div className="h-[11px] px-1 bg-white justify-start items-center gap-2.5 inline-flex absolute top-[-8px] left-[8px]">
                        <div className="text-zinc-500 text-[9px] font-normal">
                            {t("Email")}
                            <span className="text-red-500">*</span>
                        </div>
                    </div>
                </div>
                {showOTP && (
                    <>
                        <div className="px-8 mb-3 flex flex-col items-center text-center">
                            <h3 className="pt-8 mb-3 text-[12px] font-normal leading-[18px]">
                                {t("Enter your SMS OTP code")}
                            </h3>
                            <span className="text-[10px] text-[#3B3B3B]">
                                {t("We sent a code to")}{" "}
                                {user_phone ? (
                                    <span className="text-[10px] text-[#3B3B3B]">
                                        {user_phone}
                                    </span>
                                ) : (
                                    <p></p>
                                )}
                            </span>
                        </div>
                        <div className="w-full bg-white rounded">
                            <div className="text-center">
                                <div className="w-[100%] h-[38px] mt-0 p-[7px] boreder-none rounded-full bg-white flex border border-gray-200 ">
                                    <div className="w-[24px] h-[24px] bg-[#7D0A0A] flex justify-center items-center text-white text-[10px] rounded-full">
                                        {`${countdown}s`}
                                    </div>
                                    <input
                                        onChange={(e) => {
                                            setOtp(e.target.value);
                                        }}
                                        type="text"
                                        className="bg-white w-full h-full outline-none ml-[15px]"
                                        placeholder={t("")}
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
                    {showOTP ? (
                        <button
                            type="submit"
                            className={`w-full h-8 px-4 pt-1.5 pb-2 ${
                                lengthOfPhone == 9
                                    ? "bg-red-900"
                                    : "bg-[#E7E8EA]"
                            } rounded-[50px] border justify-center items-center gap-1 inline-flex text-white text-xs font-normal leading-[18px]`}
                        >
                            {t("Register")}
                        </button>
                    ) : (
                        <button
                            onClick={() => {
                                setShowOTP(true);
                            }}
                            className={`w-full h-8 px-4 pt-1.5 pb-2 ${
                                lengthOfPhone == 9
                                    ? "bg-red-900"
                                    : "bg-[#E7E8EA]"
                            } rounded-[50px] border justify-center items-center gap-1 inline-flex text-white text-xs font-normal leading-[18px]`}
                        >
                            {t("Register")}
                        </button>
                    )}
                    <p className="text-[12px] font-normal leading-[18px] mt-1">
                        {t("Have an account?")}
                        <input
                            type="button"
                            className="text-[#7D0A0A] cursor-pointer hover:text-blue-300 py-2 px-2 text-md "
                            value={t("Login here.")}
                            onClick={() => {
                                dispatch(SetRegisterModal(false));
                                dispatch(SetLoginModal(true));
                            }}
                        />
                    </p>
                </div>
            </form>
        </div>
    );
};

export default Register;
