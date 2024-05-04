import { useEffect, useState } from "react";

import Lang from "../assets/langSide.png";
import Login from "../assets/loginSide.png";
import Dashboard from "../assets/dashboardSide.png";
import Branch from "../assets/branchSide.png";

import { useAuthContext } from "./context/AuthContext";
import { useNavigate } from "react-router-dom";
import { useDispatch, useSelector } from "react-redux";
import { toast } from "react-toastify";
import { useTranslation } from "react-i18next";
import { changeLogState, logout } from "../redux/auth/authSlice";
import { HTTP_NOT_AUTHENTICATED } from "../config";
import AxiosInstance from "../axios/axios";
import { changeLanguage } from "../redux/languageSlice";
import {
  selectedCategoryAPI,
  setCategoriesAPI,
} from "../redux/NewEditor/categoryAPISlice";

import {
  SetLoginModal,
  SetRegisterModal,
} from "../redux/NewEditor/restuarantEditorSlice";

import Modal from "./Modal";
import XIcon from "../assets/xIcon.png";

const NewSideBar = ({ onClose, isBranchModelOpen, setIsBranchModelOpen }) => {
  const navigate = useNavigate();
  const dispatch = useDispatch();

  const { t } = useTranslation();
  const { setStatusCode } = useAuthContext();

  const isLoggedIn = useSelector((state) => state.auth.isLoggedIn);

  const handleLogout = async (e) => {
    dispatch(changeLogState(false));
    e.preventDefault();

    try {
      await dispatch(logout({ method: "POST" }))
        .unwrap()
        .then((res) => {
          setStatusCode(HTTP_NOT_AUTHENTICATED);
          // dispatch(getCartItemsCount(0));
          // navigate("/login", { replace: true });
          toast.success(t("You have been logged out successfully"));
          onClose();
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
        `categories?items&user&branch${id ? `&selected_branch_id=${id}` : ""}`
      );

      console.log(
        "editor rest restaurantCategoriesResponse OuterSidebarNav",
        restaurantCategoriesResponse.data
      );
      if (restaurantCategoriesResponse.data) {
        dispatch(setCategoriesAPI(restaurantCategoriesResponse.data?.data));
        dispatch(
          selectedCategoryAPI({
            name: restaurantCategoriesResponse.data?.data[0].name,
            id: restaurantCategoriesResponse.data?.data[0].id,
          })
        );

        if (!branch_id) {
          branch_id = restaurantCategoriesResponse.data?.data[0]?.branch?.id;
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
      <div className="w-[280px] h-[646px] bg-white flex flex-col items-center pt-[48px] pb-[16px] rounded-[10px] shadow border-r relative">
        <div className="flex flex-col items-center space-y-[24px]">
          <div
            onClick={() => setIsBranchModelOpen(true)}
            className="w-56 h-8 hover:cursor-pointer px-[10px] items-center bg-white hover:bg-orange-100 bg-opacity-30 rounded-[50px] border border-black border-opacity-10 hover:border-orange-100 text-gray-900 text-xs font-light flex justify-between"
          >
            <div className=" ">{t("Branches")}</div>
            <img className="w-2.5 h-2.5 opacity-80" src={Branch} />
          </div>
          {!isLoggedIn && (
            <div
              onClick={() => dispatch(SetLoginModal(true))}
              className="w-56 h-8 hover:cursor-pointer px-[10px] items-center bg-white hover:bg-orange-100 bg-opacity-30 rounded-[50px] border border-black border-opacity-10 hover:border-orange-100 text-gray-900 text-xs font-light flex justify-between"
            >
              <div className="">{t("Login")}</div>
              <img className="w-3 h-3 " src={Login} />
            </div>
          )}

          {isLoggedIn && (
            <div
              onClick={() => navigate("/profile-summary")}
              className="w-56 h-8 hover:cursor-pointer px-[10px] items-center bg-white hover:bg-orange-100 bg-opacity-30 rounded-[50px] border border-black border-opacity-10 hover:border-orange-100 text-gray-900 text-xs font-light flex justify-between"
            >
              <div className="">{t("Customer Dashboard")}</div>
              <img className="w-3 h-3 " src={Dashboard} />
            </div>
          )}

          <div
            onClick={handleLanguageChange}
            className="w-56 h-8 hover:cursor-pointer px-[10px] items-center bg-white hover:bg-orange-100 bg-opacity-30 rounded-[50px] border border-black border-opacity-10 hover:border-orange-100 text-gray-900 text-xs font-light flex justify-between"
          >
            <div>{buttonText}</div>
            <img className="w-3 h-3" src={Lang} />
          </div>
        </div>
        {isLoggedIn && (
          <div
            onClick={handleLogout}
            className="mt-auto w-56 h-8 hover:cursor-pointer px-[10px] items-center bg-white hover:bg-orange-100 bg-opacity-30 rounded-[50px] border border-black border-opacity-10 hover:border-orange-100 text-gray-900 text-xs font-light flex justify-between"
          >
            <div className="">{t("Log out")}</div>
            <img className="w-3 h-3 " src={Login} />
          </div>
        )}
      </div>
      <div
        onClick={() => onClose()}
        className={`w-[25px] h-[25px] bg-white flex justify-center items-center rounded-full border border-black border-opacity-30 absolute  top-0 ${
          currentLanguage == "ar" ? "left-[-30px]" : "right-[-30px]"
        }`}
      >
        <img src={XIcon} alt="x icon" className="w-[6.25px] h-[6.25px]" />
      </div>
    </>
  );
};

export default NewSideBar;
