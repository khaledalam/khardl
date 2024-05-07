import React, { useEffect, useState } from "react";
import { useTranslation } from "react-i18next";
import {
  privacyPolicyEnText,
  privacyPolicyArText,
  termsAndConditionsEnText,
  termsAndConditionsArText,
} from "../../../../redux/NewEditor/restuarantEditorSlice";
import { useDispatch, useSelector } from "react-redux";

const FooterModal = ({ type, setModalOpened, edit = false }) => {
  const { t } = useTranslation();
  const restuarantEditorStyle = useSelector(
    (state) => state.restuarantEditorStyle
  );
  const {
    privacy_policy_color,
    privacy_policy_enText,
    privacy_policy_arText,
    privacy_policy_text_fontFamily,
    privacy_policy_text_fontWeight,
    privacy_policy_text_fontSize,
    privacy_policy_text_color,
    terms_and_conditions_color,
    terms_and_conditions_enText,
    terms_and_conditions_arText,
    terms_and_conditions_text_fontFamily,
    terms_and_conditions_text_fontWeight,
    terms_and_conditions_text_fontSize,
    terms_and_conditions_text_color,
  } = restuarantEditorStyle;
  const language = useSelector((state) => state.languageMode.languageMode);
  const [backgroundColor, setBackgroundColor] = useState(
    terms_and_conditions_color
  );
  const [fontFamily, setFontFamily] = useState(
    terms_and_conditions_text_fontFamily
  );
  const [color, setColor] = useState(terms_and_conditions_text_color);
  const [fontWeight, setFontWeight] = useState(
    terms_and_conditions_text_fontWeight
  );
  const [size, setSize] = useState(terms_and_conditions_text_fontSize);
  const [text, setText] = useState("");
  const [languageType, setLanguageType] = useState(language);
  const dispatch = useDispatch();

  useEffect(() => {
    setLanguageType(language);
  }, [language]);

  useEffect(() => {
    if (type === "termsAndConditions") {
      setBackgroundColor(terms_and_conditions_color);
      setFontFamily(terms_and_conditions_text_fontFamily);
      setColor(terms_and_conditions_text_color);
      setFontWeight(terms_and_conditions_text_fontWeight);
      setSize(terms_and_conditions_text_fontSize);
      language === "en"
        ? setText(terms_and_conditions_enText)
        : setText(terms_and_conditions_arText);
    } else if (type === "privacyPolicy") {
      setBackgroundColor(privacy_policy_color);
      setFontFamily(privacy_policy_text_fontFamily);
      setColor(privacy_policy_text_color);
      setFontWeight(privacy_policy_text_fontWeight);
      setSize(privacy_policy_text_fontSize);
      language === "en"
        ? setText(privacy_policy_enText)
        : setText(privacy_policy_arText);
    }
  }, [type]);

  return (
    <div
      class="modal fixed w-full h-full top-0 left-0 flex items-center justify-center"
      style={{ opacity: 1, pointerEvents: "all" }}
      onClick={() => setModalOpened(false)}
    >
      <div class="modal-container bg-white !w-[500px] mx-auto rounded-[10px] shadow-lg z-50 relative">
        <div
          className="w-[500px] flex flex-col items-center rounded-[10px] border-2 border-black border-opacity-30 gap-4 p-2"
          onClick={(e) => e.stopPropagation()}
          style={{
            backgroundColor,
          }}
        >
          <div>{}</div>
          <div
            className="my-4"
            style={{
              fontFamily,
              color,
              fontWeight,
              fontSize: "20px",
            }}
          >
            {type === "termsAndConditions"
              ? t("Terms and Conditions")
              : t("Privacy Policy")}
          </div>
          <textarea
            disabled={!edit}
            rows={7}
            className="border outline-none rounded-md w-full h-min-[120px] p-2 mx-2 disabled:border-none disabled:bg-transparent disabled:resize-none"
            style={{
              fontFamily,
              color,
              size,
              fontWeight,
            }}
            value={text}
            onChange={(e) => setText(e.target.value)}
          />
          {edit && (
            <div className="w-full p-2 flex flex-row gap-4 justify-end">
              <button
                className="w-32 transition-all p-1 rounded-md hover:bg-red-900 bg-white border-red-900 border text-red-900 hover:text-white"
                onClick={() => {
                  setModalOpened(false);
                  if (type === "termsAndConditions") {
                    languageType === "en"
                      ? dispatch(termsAndConditionsEnText(text))
                      : dispatch(termsAndConditionsArText(text));
                  } else if (type === "privacyPolicy") {
                    languageType === "en"
                      ? dispatch(privacyPolicyEnText(text))
                      : dispatch(privacyPolicyArText(text));
                  }
                }}
              >
                {t("Ok")}
              </button>
              <button
                className="w-32 transition-all p-1 rounded-md hover:bg-neutral-900 bg-white border-neutral-900 border text-neutral-900 hover:text-white"
                onClick={() => setModalOpened(false)}
              >
                {t("Cancel")}
              </button>
            </div>
          )}
        </div>
      </div>
    </div>
  );
};

export default FooterModal;
