import React, { useEffect, useState } from "react";
import { useTranslation } from "react-i18next";
import {
  privacyPolicyEnText,
  privacyPolicyArText,
  termsAndConditionsEnText,
  termsAndConditionsArText,
} from "../../../../redux/NewEditor/restuarantEditorSlice";
import { useDispatch, useSelector } from "react-redux";
import ReactQuill from "react-quill";
import "react-quill/dist/quill.snow.css";
import { toast } from "react-toastify";

const FooterModal = ({ type, setModalOpened }) => {
  const { t } = useTranslation();
  const restuarantEditorStyle = useSelector(
    (state) => state.restuarantEditorStyle
  );
  const {
    privacy_policy_enText,
    privacy_policy_arText,
    terms_and_conditions_enText,
    terms_and_conditions_arText,
  } = restuarantEditorStyle;
  const language = useSelector((state) => state.languageMode.languageMode);
  const [text, setText] = useState("");
  const [languageType, setLanguageType] = useState(language);
  const dispatch = useDispatch();

  useEffect(() => {
    setLanguageType(language);
  }, [language]);

  useEffect(() => {
    if (type === "termsAndConditions") {
      languageType === "en"
        ? setText(terms_and_conditions_enText)
        : setText(terms_and_conditions_arText);
    } else if (type === "privacyPolicy") {
      languageType === "en"
        ? setText(privacy_policy_enText)
        : setText(privacy_policy_arText);
    }
  }, [type, languageType]);

  const handleChange = (content, delta, source, editor) => {
    setText(editor.getHTML());
  };
  const formats = [
    "font",
    "size",
    "bold",
    "italic",
    "underline",
    "strike",
    "color",
    "background",
    "script",
    "header",
    "blockquote",
    "code-block",
    "indent",
    "list",
    "direction",
    "align",
    "link",
    "image",
    "video",
    "formula",
  ];

  const onSave = () => {
    if (type === "termsAndConditions") {
      if (languageType === "en") {
        dispatch(termsAndConditionsEnText(text));
        terms_and_conditions_arText == ""
          ? toast.warn(
              t("You didn't define the terms and conditions in Arabic.")
            )
          : setModalOpened(false);
      } else {
        dispatch(termsAndConditionsArText(text));
        terms_and_conditions_enText == ""
          ? toast.warn(
              t("You didn't define the terms and conditions in English.")
            )
          : setModalOpened(false);
      }
    } else if (type === "privacyPolicy") {
      if (languageType === "en") {
        dispatch(privacyPolicyEnText(text));
        privacy_policy_arText == ""
          ? toast.warn(t("You didn't define the privacy and policy in Arabic."))
          : setModalOpened(false);
      } else {
        dispatch(privacyPolicyArText(text));
        privacy_policy_enText == ""
          ? toast.warn(
              t("You didn't define the privacy and policy in English.")
            )
          : setModalOpened(false);
      }
    }
  };

  return (
    <div
      class="modal fixed w-full h-full top-0 left-0 flex items-center justify-center"
      style={{ opacity: 1, pointerEvents: "all" }}
      onClick={() => setModalOpened(false)}
    >
      <div class="modal-container bg-white w-full md:!w-[700px] mx-auto rounded-[10px] shadow-lg z-50 relative">
        <div
          className="w-full flex flex-col items-center rounded-[10px] border-2 border-black border-opacity-30 gap-4 p-4"
          onClick={(e) => e.stopPropagation()}
        >
          <div className="my-4 px-4 flex justify-between w-full items-center flex-row">
            <div className="text-xl">
              {type === "termsAndConditions"
                ? t("Terms and Conditions")
                : t("Privacy Policy")}
            </div>
            <div className="text-sm">
              <button
                className={`${
                  language == "en" ? " rounded-l-lg" : "rounded-r-lg"
                } border py-1 px-2 transition-all duration-75 ${
                  languageType === language
                    ? "bg-red-900 text-white hover:bg-opacity-75"
                    : "bg-neutral-700 text-neutral-200 hover:bg-neutral-200 hover:text-neutral-700"
                }`}
                onClick={() =>
                  language == "en"
                    ? setLanguageType("en")
                    : setLanguageType("ar")
                }
              >
                {language == "en" ? t("EN") : t("AR")}
              </button>
              <button
                className={`${
                  language == "en" ? " rounded-r-lg" : "rounded-l-lg"
                } border py-1 px-2 transition-all duration-75 ${
                  languageType !== language
                    ? "bg-red-900 text-white hover:bg-opacity-75"
                    : "bg-neutral-700 text-neutral-200 hover:bg-neutral-200 hover:text-neutral-700"
                }`}
                onClick={() =>
                  language == "en"
                    ? setLanguageType("ar")
                    : setLanguageType("en")
                }
              >
                {language == "en" ? t("AR") : t("EN")}
              </button>
            </div>
          </div>
          <ReactQuill
            value={text}
            // bounds={".custom-quill-container"}
            theme="snow"
            onChange={handleChange}
            className="h-[300px] w-full px-2 max-h-[700px] overflow-y-scroll hide-scroll"
            formats={formats}
          />
          {/* <textarea
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
          /> */}
          <div className="w-full p-2 flex flex-row gap-4 justify-end">
            <button
              className="w-32 transition-all p-1 rounded-md hover:bg-red-900 bg-white border-red-900 border text-red-900 hover:text-white"
              onClick={onSave}
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
        </div>
      </div>
    </div>
  );
};

export default FooterModal;
