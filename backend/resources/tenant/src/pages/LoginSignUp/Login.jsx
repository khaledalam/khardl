import React, { useEffect, useState } from "react";
import Logo from "../../assets/Logo.webp";
import ContactUsCover from "../../assets/ContactUsCover.webp";
import { useTranslation } from "react-i18next";
import MainText from "../../components/MainText";
import { Link, useNavigate } from "react-router-dom";
import { useForm } from "react-hook-form";
import { AiFillEye, AiFillEyeInvisible } from "react-icons/ai";
import { toast } from "react-toastify";
import {
    PREFIX_KEY,
    HTTP_NOT_AUTHENTICATED,
    HTTP_NOT_VERIFIED,
    HTTP_OK,
} from "../../config";
import { useSelector, useDispatch } from "react-redux";
import { changeLogState, changeUserState } from "../../redux/auth/authSlice";
import { setIsOpen } from "../../redux/features/drawerSlice";
import { useAuthContext } from "../../components/context/AuthContext";
import AxiosInstance from "../../axios/axios";
import { changeRestuarantEditorStyle } from "../../redux/NewEditor/restuarantEditorSlice";
import imgLogo from "../../assets/khardl_Logo.png";
import SA from "../../assets/SA.png";
import Down from "../../assets/down.svg";
import { getCartItemsCount } from "../../redux/NewEditor/categoryAPISlice";

const Login = () => {
    const restaurantStyle = useSelector((state) => state.restuarantEditorStyle);
    const [openEyePassword, setOpenEyePassword] = useState(false);
    const [spinner, setSpinner] = useState(false);
    const [isLoading, setisLoading] = useState(true);
    const dispatch = useDispatch();
    const { setStatusCode } = useAuthContext();

    const { t } = useTranslation();
    const navigate = useNavigate();
    const {
        register,
        handleSubmit,
        formState: { errors },
    } = useForm();
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
            const response = await AxiosInstance.post(`/login`, {
                phone: data.phone,

                // remember_me: data.remember_me, // used only in API token-based
            });

            if (response?.data?.success) {
                const responseData = response?.data;
                console.log("login-response", responseData);
                localStorage.setItem(
                    "user-info",
                    JSON.stringify(responseData?.data?.user)
                );
                localStorage.setItem(
                    "i18nextLng",
                    response?.data?.user?.default_lang ?? "ar"
                );
                if (responseData.data.user.status === "inactive") {
                    sessionStorage.setItem(
                        PREFIX_KEY + "phone",
                        responseData?.data?.user?.phone
                    );

                    const userRole =
                        responseData.data.user.roles[0]?.name || "Customer";
                    localStorage.setItem("user-role", userRole);

                    setStatusCode(HTTP_NOT_VERIFIED);
                    navigate("/verification-phone");
                } else if (responseData.data.user.status === "active") {
                    setStatusCode(HTTP_OK);
                } else {
                    navigate("/error");
                }
                dispatch(changeLogState(true));
                dispatch(changeUserState(responseData?.data?.user || null));

                dispatch(setIsOpen(false));
                toast.success(`${t("You have been logged in successfully")}`);
            } else {
                console.log("response?.data?.success false");
                setSpinner(false);
                throw new Error(`${t("Login failed")}`);
            }
        } catch (error) {
            console.log("error response > ", error?.response);
            setSpinner(false);
            dispatch(changeLogState(false));
            dispatch(changeUserState(null));
            setStatusCode(HTTP_NOT_AUTHENTICATED);
            toast.error(
                `${
                    error?.response?.data?.data ||
                    error?.response?.data?.message ||
                    t("Login failed")
                }`
            );
        }
    };

    /////////////////////////////////////////////////////////////////////////////////////
    useEffect(() => {
        fetchResStyleData();
    }, []);

    const [lengthOfPhone, setLengthOfPhone] = useState(0);

    return (
        <div className="flex flex-col items-stretch justify-center">
            <div
                className="flex justify-center items-center px-[40px] max-md:px-[0px] login-background"
                style={{
                    backgroundImage: `url(${ContactUsCover})`,
                    backgroundSize: "cover",
                }}
            >
                <div className="w-full max-w-[400px] bg-white p-[40px] rounded-[30px] flex flex-col items-center ">
                    <div className="mb-[24px]">
                        <img
                            src={
                                // restaurantStyle?.logo
                                //     ? restaurantStyle.logo
                                //     :
                                imgLogo
                            }
                            alt="logo"
                            className={`w-[60px] h-[60px] object-cover`}
                            style={{
                                borderRadius:
                                    restaurantStyle?.logo_border_radius
                                        ? restaurantStyle?.logo_border_radius +
                                          "%"
                                        : "50%",
                                border: `1px solid ${restaurantStyle?.logo_border_color}`,
                            }}
                        />
                    </div>
                    <div className="text-center text-neutral-700 text-3xl font-medium mb-[12px] leading-[38px]">
                        Your Burger Queen
                    </div>
                    <div className="text-center text-zinc-600 text-base font-normal leading-normal">
                        {t("Login")}
                    </div>
                    <form
                        onSubmit={handleSubmit(onSubmit)}
                        className="w-[100%] flex flex-col items-center mt-[40px]"
                    >
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
                                    <img
                                        src={Down}
                                        alt="down"
                                        className="w-[8.17px] h-[4.67px] object-cover"
                                    />
                                </div>
                                <div className="w-9 h-[11px] px-1 bg-white justify-start items-center gap-2.5 inline-flex absolute top-[-8px] left-[8px]">
                                    <div className="text-zinc-500 text-[9px] font-normal font-['Plus Jakarta Sans']">
                                        {t("Phone number")}
                                    </div>
                                </div>
                            </div>
                            <div className="ml-[8px] w-full">
                                <input
                                    type="tel"
                                    className={`w-[100%] h-8 px-4 py-[7px] bg-white rounded-[50px] border border-gray-200 justify-start items-center gap-1.5 inline-flex text-zinc-500 text-xs font-normal leading-[18px] outline-none`}
                                    placeholder={"Your phone number"}
                                    {...register("phone", {
                                        required: true,
                                    })}
                                    onChange={(data) => {
                                        setLengthOfPhone(
                                            data.target.value.length
                                        );
                                        console.log(data.target.value.length);
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
                        <div className="flex flex-col justify-center items-center mt-4 mb-10 w-full">
                            <button
                                type="submit"
                                className={`w-full h-8 px-4 pt-1.5 pb-2 ${
                                    lengthOfPhone == 9
                                        ? "bg-red-900"
                                        : "bg-[#E7E8EA]"
                                } rounded-[50px] border justify-center items-center gap-1 inline-flex text-white text-xs font-normal leading-[18px]`}
                            >
                                {t("Login")}
                            </button>
                            <p className="text-[12px] font-normal leading-[18px] mt-1">
                                {t("Don't have an account?")}
                                <Link to="/register">
                                    <input
                                        type="button"
                                        className="text-[#7D0A0A] cursor-pointer hover:text-blue-300 py-2 px-2 text-md "
                                        value={t("Register here!")}
                                    />
                                </Link>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    );
};

export default Login;
