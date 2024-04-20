import { useEffect, useState } from "react";

import Lang from "../assets/langSide.png";
import Login from "../assets/loginSide.png";
import Branch from "../assets/branchSide.png";

import { useAuthContext } from "./context/AuthContext";
import { useNavigate } from "react-router-dom";
import { useDispatch, useSelector } from "react-redux";
import { toast } from "react-toastify";
import { useTranslation } from "react-i18next";
import { logout } from "../redux/auth/authSlice";
import { HTTP_NOT_AUTHENTICATED } from "../config";
import AxiosInstance from "../axios/axios";
import { changeLanguage } from "../redux/languageSlice";
import {
    selectedCategoryAPI,
    setCategoriesAPI,
} from "../redux/NewEditor/categoryAPISlice";

import Modal from "./Modal";
import XIcon from "../assets/xIcon.png";

const NewSideBar = ({ onClose, isBranchModelOpen, setIsBranchModelOpen }) => {
    const navigate = useNavigate();
    const dispatch = useDispatch();

    const { t } = useTranslation();
    const { setStatusCode } = useAuthContext();

    const handleLogout = async (e) => {
        e.preventDefault();

        try {
            await dispatch(logout({ method: "POST" }))
                .unwrap()
                .then((res) => {
                    setStatusCode(HTTP_NOT_AUTHENTICATED);
                    // dispatch(getCartItemsCount(0));
                    navigate("/login", { replace: true });
                    toast.success(t("You have been logged out successfully"));
                });
        } catch (err) {
            console.error(err.message);
            toast.error(`${t("Logout failed")}`);
        }
    };

    const currentLanguage = useSelector(
        (state) => state.languageMode.languageMode
    );

    const newLanguage = currentLanguage === "en" ? "ar" : "en";
    let branch_id = localStorage.getItem("selected_branch_id");

    const fetchCategoriesData = async (id) => {
        try {
            const restaurantCategoriesResponse = await AxiosInstance.get(
                `categories?items&user&branch${
                    id ? `&selected_branch_id=${id}` : ""
                }`
            );

            console.log(
                "editor rest restaurantCategoriesResponse OuterSidebarNav",
                restaurantCategoriesResponse.data
            );
            if (restaurantCategoriesResponse.data) {
                dispatch(
                    setCategoriesAPI(restaurantCategoriesResponse.data?.data)
                );
                dispatch(
                    selectedCategoryAPI({
                        name: restaurantCategoriesResponse.data?.data[0].name,
                        id: restaurantCategoriesResponse.data?.data[0].id,
                    })
                );

                if (!branch_id) {
                    branch_id =
                        restaurantCategoriesResponse.data?.data[0]?.branch?.id;
                    localStorage.setItem("selected_branch_id", branch_id);
                }
            }
        } catch (error) {
            // toast.error(`${t('Failed to send verification code')}`)
            console.log(error);
        }
    };

    const buttonText =
        currentLanguage === "en" ? (
            <span title="Arabic">{t("AR")}</span>
        ) : (
            <span title="English">{t("EN")}</span>
        );

    const handleLanguageChange = async () => {
        AxiosInstance.get(`/change-language/${newLanguage}`, {}).then(() => {
            dispatch(changeLanguage(newLanguage));
            fetchCategoriesData(branch_id);
            onClose();
        });
    };

    return (
        <>
            <div className="w-[280px] h-[646px] relative bg-white rounded-[10px] shadow border-r">
                <div
                    onClick={() => setIsBranchModelOpen(true)}
                    className="w-56 h-8 left-[24px] top-[48px] absolute hover:cursor-pointer"
                >
                    <div className="w-56 h-8 left-0 top-0 absolute bg-white hover:bg-orange-100 bg-opacity-30 rounded-[50px] border border-black border-opacity-10 hover:border-orange-100" />
                    <div className="left-[35px] top-[8px] absolute text-gray-900 text-xs font-light font-['Plus Jakarta Sans']">
                        {t("Branches")}
                    </div>
                </div>
                <div
                    onClick={() => navigate("/dashboard#Dashboard")}
                    className="w-56 h-8 left-[24px] top-[104px] absolute hover:cursor-pointer"
                >
                    <div className="w-56 h-8 left-0 top-0 absolute bg-white hover:bg-orange-100 rounded-[50px] border border-black border-opacity-10 hover:border-orange-100" />
                    <div className="left-[35px] top-[9px] absolute text-gray-900 text-xs font-light font-['Plus Jakarta Sans']">
                        {t("Login as a customer")}
                    </div>
                </div>
                <div
                    onClick={handleLanguageChange}
                    className="w-56 h-8 left-[24px] top-[160px] absolute hover:cursor-pointer"
                >
                    <div className="w-56 h-8 left-0 top-0 absolute bg-white hover:bg-orange-100 rounded-[50px] border border-black border-opacity-10 hover:border-orange-100" />
                    <div className="left-[38px] top-[8px] absolute text-gray-900 text-xs font-light font-['Plus Jakarta Sans']">
                        {buttonText}
                    </div>
                </div>
                <div
                    onClick={handleLogout}
                    className="w-56 h-8 left-[24px] top-[598px] absolute hover:cursor-pointer"
                >
                    <div className="w-56 h-8 left-0 top-0 absolute bg-white hover:bg-orange-100 rounded-[50px] border border-black border-opacity-10 hover:border-orange-100" />
                    <div className="left-[33px] top-[8px] absolute text-gray-900 text-xs font-light font-['Plus Jakarta Sans']">
                        {t("Log out")}
                    </div>
                </div>
                <img
                    className="w-2.5 h-2.5 left-[34px] top-[59px] absolute opacity-80"
                    src={Branch}
                />
                <div className="w-3 h-3 left-[36px] top-[126px] absolute origin-top-left -rotate-180 opacity-80" />
                <div className="w-3 h-3 left-[36px] top-[182px] absolute origin-top-left -rotate-180 opacity-80" />
                <img
                    className="w-3 h-3 left-[32px] top-[170px] absolute"
                    src={Lang}
                />
                <img
                    className="w-3 h-3 left-[44px] top-[620px] absolute origin-top-left -rotate-180 opacity-80"
                    src={Login}
                />
                <img
                    className="w-3 h-3 left-[32px] top-[115px] absolute"
                    src={Login}
                />
                <div
                    onClick={() => onClose()}
                    className="w-[25px] h-[25px] bg-white flex justify-center items-center rounded-full border border-black border-opacity-30 absolute right-[-30px] top-0"
                >
                    <img
                        src={XIcon}
                        alt="x icon"
                        className="w-[6.25px] h-[6.25px]"
                    />
                </div>
            </div>
        </>
    );
};

export default NewSideBar;
