import React, { useContext } from "react";
import { useSelector, useDispatch } from "react-redux";
import { changeLanguage } from "../redux/languageSlice";
import AxiosInstance from "../axios/axios";
import worldLangIcon from "../assets/worldLang.svg";
import { MenuContext } from "react-flexible-sliding-menu";
import {
  selectedCategoryAPI,
  setCategoriesAPI,
} from "../redux/NewEditor/categoryAPISlice";

const LanguageButton = ({ id }) => {
  const { closeMenu } = useContext(MenuContext);
  const dispatch = useDispatch();

  const restuarantStyle = useSelector((state) => {
    return state.restuarantEditorStyle;
  });
  const currentLanguage = useSelector(
    (state) => state.languageMode.languageMode,
  );
  const buttonText =
    currentLanguage === "en" ? (
      <span title="Arabic">AR</span>
    ) : (
      <span title="English">EN</span>
    );

  const newLanguage = currentLanguage === "en" ? "ar" : "en";

  let branch_id = localStorage.getItem("selected_branch_id");

  const fetchCategoriesData = async (id) => {
    try {
      const restaurantCategoriesResponse = await AxiosInstance.get(
        `categories?items&user&branch${id ? `&selected_branch_id=${id}` : ""}`,
      );

      if (restaurantCategoriesResponse.data) {
        dispatch(setCategoriesAPI(restaurantCategoriesResponse.data?.data));
        dispatch(
          selectedCategoryAPI({
            name: restaurantCategoriesResponse.data?.data[0].name,
            id: restaurantCategoriesResponse.data?.data[0].id,
          }),
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

  const handleLanguageChange = async () => {
    AxiosInstance.get(`/change-language/${newLanguage}`, {}).then(() => {
      dispatch(changeLanguage(newLanguage));
      fetchCategoriesData(branch_id);
      closeMenu();
    });
  };

  return (
    <label
      htmlFor={id}
      aria-label="close sidebar"
      className="w-[90%] mx-auto drawer-button rounded-lg p-1 flex items-center justify-center cursor-pointer"
    >
      <div
        onClick={handleLanguageChange}
        className="w-full mx-auto flex flex-row gap-1 bg-transparent rounded-lg items-center text-black text-lg"
        style={{
          // borderColor: restuarantStyle?.categoryDetail_cart_color,
        }}
      >
        <div className="w-[50px] h-[50px] rounded-xl p-2  flex items-center justify-center">
          <img src={worldLangIcon} alt="language" />
        </div>
        <h3 className=""> {buttonText}</h3>
      </div>
    </label>
  );
};

export default LanguageButton;
