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
    return (
        <div className="flex flex-col items-stretch justify-center">
            <div
                className="flex justify-center items-center px-[40px] max-md:px-[0px] login-background"
                style={{
                    backgroundImage: `url(${ContactUsCover})`,
                    backgroundSize: "cover",
                }}
            >
                <div className="py-[20px] flex justify-center items-center">
                    <div className="grid grid-cols-2 h-[100%] max-[860px]:flex max-[860px]:flex-col-reverse py-[80px] max-md:py-[60px] xl:max-w-[80%] max-[1200px]:w-[100%]">
                        <div className="relative flex flex-col justify-center items-center max-[860px]:w-[85vw] space-y-14 shadow-lg bg-white p-8 max-[860px]:p-4 rounded-s-lg max-[860px]:rounded-b-lg max-[860px]:rounded-s-none ">
                            <div className="mt-6 w-[100%]">
                                <MainText
                                    Title={t("Login")}
                                    classTitle="!text-[28px] !w-[50px] !h-[8px] bottom-[-10px] max-[1000px]:bottom-[0px] max-[500px]:bottom-[5px]"
                                />
                                <div className="w-[100%] flex items-center justify-center mt-4">
                                    <form
                                        onSubmit={handleSubmit(onSubmit)}
                                        className="w-[100%] flex flex-col gap-[14px] px-[15px]"
                                    >
                                        {/* Input 1 */}

                                        <div>
                                            <h4 className="mb-2 ms-2 text-[13px] font-semibold">
                                                {t("Phone")}
                                            </h4>
                                            <input
                                                type="tel"
                                                className={`w-[100%] mt-0 p-[10px] px-[16px] max-[540px]:py-[15px] border-none rounded-full bg-[var(--third)]`}
                                                placeholder={
                                                    "e.g. +966 123456789"
                                                }
                                                {...register("phone", {
                                                    required: true,
                                                })}
                                                minLength={9}
                                                maxLength={13}
                                            />
                                            {errors.phone && (
                                                <span className="text-red-500 text-xs mt-1 ms-2">
                                                    {t("Phone Error")}
                                                </span>
                                            )}
                                        </div>

                                        {/* Input 2 */}
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
                                       {t('Password Error')}
                                    </span>
                                 )}
                                 <div
                                    className={`text-2xl absolute top-[38px] ${
                                       Language === 'en' ? 'right-5' : 'left-5'
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

                                        <div className="flex flex-col justify-center items-center mt-4 mb-10">
                                            <button
                                                type="submit"
                                                className={`font-bold bg-[var(--primary)] flex justify-center items-center gap-[3px] rounded-full transition-all delay-100  py-2 px-6 text-[18px] leading-6`}
                                            >
                                                {t("Login")}
                                            </button>
                                            <p className="text-sm font-semibold  mt-1">
                                                {t("Don't have an account?")}
                                                <Link to="/register">
                                                    <input
                                                        type="button"
                                                        className="text-[var(--primary)] cursor-pointer hover:text-blue-300 py-2 px-2 text-md "
                                                        value={t(
                                                            "Create an account"
                                                        )}
                                                    />
                                                </Link>
                                            </p>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            {spinner && (
                                <div
                                    role="status"
                                    className="rounded-s-md  max-[860px]:rounded-b-lg max-[860px]:rounded-s-none absolute -translate-x-1/2 -translate-y-1/2 top-[39%] max-[860px]:top-[39.5%] left-1/2 w-[100%] h-[100%] "
                                >
                                    <div className="rounded-s-md max-[860px]:rounded-b-lg max-[860px]:rounded-s-none relative bg-black opacity-25 flex justify-center items-center w-[100%] h-[100%] mt-[-11px]" />
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
                                        <span className="sr-only">
                                            Loading...
                                        </span>
                                    </div>
                                </div>
                            )}
                        </div>
                        <div className="flex flex-col justify-center items-center max-[860px]:w-[85vw] bg-[var(--primary)] p-8 space-y-10 shadow-lg rounded-e-lg max-[860px]:rounded-t-lg max-[860px]:rounded-e-none">
                            <Link
                                to="/"
                                className="grid content-between space-y-6  transform transition-transform hover:-translate-y-2"
                            >
                                <div
                                    className={` w-full ${
                                        restaurantStyle?.logo_alignment ===
                                            t("Center") ||
                                        restaurantStyle?.logo_alignment ===
                                            "center"
                                            ? " flex items-center justify-center"
                                            : restaurantStyle?.logo_alignment ===
                                                  t("Left") ||
                                              restaurantStyle?.logo_alignment ===
                                                  "left"
                                            ? "items-center justify-start"
                                            : "items-center justify-end"
                                    }`}
                                >
                                    <div
                                        className={`w-[80px] h-[80px]  ${
                                            restaurantStyle?.logo_shape ===
                                                "rounded" ||
                                            restaurantStyle?.logo_shape ===
                                                t("Rounded")
                                                ? "rounded-full"
                                                : restaurantStyle?.logo_shape ===
                                                      "sharp" ||
                                                  restaurantStyle?.logo_shape ===
                                                      t("Sharp")
                                                ? "rounded-none"
                                                : ""
                                        }`}
                                    >
                                        <img
                                            src={
                                                restaurantStyle?.logo
                                                    ? restaurantStyle.logo
                                                    : imgLogo
                                            }
                                            alt="logo"
                                            className={`w-full h-full object-cover ${
                                                restaurantStyle?.logo_shape ===
                                                t("Sharp")
                                                    ? ""
                                                    : "rounded-full"
                                            }`}
                                        />
                                    </div>
                                </div>
                                {/* <img
                           loading='lazy'
                           className='w-[120px]'
                           src={restaurantStyle?.logo ? restaurantStyle.logo : Logo}
                           alt='Logo'
                        /> */}
                            </Link>
                            {/* <div className='mt-6'>
                        <MainText
                           SubTitle={t('Login Details')}
                           classSubTitle='max-w-[380px] !text-[18px] !px-0'
                        />
                     </div> */}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default Login;
