import React from "react";
import { useTranslation } from "react-i18next";
import { useSelector } from "react-redux";
import { useNavigate } from "react-router-dom";

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
  } = restuarantEditorStyle;
  const navigate = useNavigate();
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
              className="border border-red-900 bg-red-900 text-white hover:bg-white hover:text-red-900 transition-all px-2 rounded-md py-1 h-fit"
              onClick={() => navigate("/")}
            >
              {t("Go to Home")}
            </button>
          </div>
          <div
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
