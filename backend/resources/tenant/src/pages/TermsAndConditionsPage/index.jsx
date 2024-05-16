import React, { useEffect, useState } from "react";
import { useTranslation } from "react-i18next";
import { MdOutlineArrowBack } from "react-icons/md";
import { useDispatch, useSelector } from "react-redux";
import { useNavigate } from "react-router-dom";
import { changeRestuarantEditorStyle } from "../../redux/NewEditor/restuarantEditorSlice";
import AxiosInstance from "../../axios/axios";

const PrivacyPolicyPage = () => {
  const { t } = useTranslation();
  const language = useSelector((state) => state.languageMode.languageMode);
  const restuarantEditorStyle = useSelector(
    (state) => state.restuarantEditorStyle
  );
  const {
    terms_and_conditions_enText,
    terms_and_conditions_arText,
    page_color,
    price_background_color,
  } = restuarantEditorStyle;
  const navigate = useNavigate();
  const [isLoading, setIsLoading] = useState(false);
  const [isMouseHover, setIsMouseHover] = useState(false);
  const dispatch = useDispatch();
  const restaurantStyleVersion = useSelector(
    (state) => state.styleDataRestaurant.restaurantStyleVersion
  );
  const fetchResStyleData = async () => {
    try {
      if (
        localStorage.getItem("restaurantStyleVersion") == restaurantStyleVersion
      ) {
        dispatch(
          changeRestuarantEditorStyle(
            JSON.parse(localStorage.getItem("restaurantStyle"))
          )
        );
      } else {
        localStorage.setItem("restaurantStyleVersion", restaurantStyleVersion);
        AxiosInstance.get(`restaurant-style`).then((response) => {
          localStorage.setItem(
            "restaurantStyle",
            JSON.stringify(response.data?.data)
          );
          dispatch(changeRestuarantEditorStyle(response.data?.data));
        });
      }
      setIsLoading(false);
    } catch (error) {
      // toast.error(`${t('Failed to send verification code')}`)
      console.log(error);
      setIsLoading(false);
    }
  };

  useEffect(() => {
    fetchResStyleData();
  }, []);

  if (isLoading || !restuarantEditorStyle) {
    return (
      <div className="w-screen h-screen flex items-center justify-center">
        <span className="loading loading-spinner text-primary"></span>
      </div>
    );
  }

  return (
    <div
      style={{
        backgroundColor: page_color,
      }}
      className=" h-full min-h-screen overflow-y-scroll hide-scroll"
    >
      <div className="w-full h-full min-h-max p-4 flex flex-col gap-[16px] relative mx-auto max-w-[1200px] my-4">
        <div
          className="bg-white rounded-lg pt-12 px-8"
          style={{ minHeight: "calc(100vh - 60px)" }}
        >
          <div className="flex justify-between flex-row items-center mb-3">
            <div className="text-3xl">{t("Terms and Conditions")}</div>
            <button
              onMouseEnter={() => setIsMouseHover(true)}
              onMouseLeave={() => setIsMouseHover(false)}
              className="border border-red-900 bg-red-900 text-white hover:bg-white hover:text-red-900 transition-all px-4 rounded-md py-1 h-fit justify-center flex items-center gap-3"
              onClick={() => navigate("/")}
              style={{
                borderColor: price_background_color,
                backgroundColor: isMouseHover
                  ? "white"
                  : price_background_color,
                color: isMouseHover ? price_background_color : "white",
              }}
            >
              <MdOutlineArrowBack
                className="w-3 h-3"
                style={{
                  transform:
                    language == "en" ? "rotate(0deg)" : "rotate(180deg)",
                }}
              />
              {t("Back")}
            </button>
          </div>
          <div
            className="ql-content"
            dangerouslySetInnerHTML={{
              __html:
                language == "en"
                  ? terms_and_conditions_enText
                  : terms_and_conditions_arText,
            }}
          />
        </div>
      </div>
    </div>
  );
};

export default PrivacyPolicyPage;
