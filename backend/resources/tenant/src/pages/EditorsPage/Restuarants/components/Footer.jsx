import React, { useEffect } from "react";
import { useSelector } from "react-redux";
import { useTranslation } from "react-i18next";
import GreenDot from "../../../../assets/greenDot.png";

const Footer = ({
  activeSubitem,
  navItems,
  activeSection,
  onTermsAndConditionsClick,
  onPrivacyPolicyClick,
}) => {
  const restuarantEditorStyle = useSelector(
    (state) => state.restuarantEditorStyle
  );

  const {
    footer_color,
    footer_alignment,
    footer_text_fontFamily,
    footer_text_fontWeight,
    footer_text_fontSize,
    footer_text_color,
    terms_and_conditions_color,
    terms_and_conditions_alignment,
    terms_and_conditions_text_fontFamily,
    terms_and_conditions_text_fontWeight,
    terms_and_conditions_text_fontSize,
    terms_and_conditions_text_color,
    privacy_policy_color,
    privacy_policy_alignment,
    privacy_policy_text_fontFamily,
    privacy_policy_text_fontWeight,
    privacy_policy_text_fontSize,
    privacy_policy_text_color,
  } = restuarantEditorStyle;

  const { t } = useTranslation();

  useEffect(() => {
    console.log(
      "ACTIVESECTION",
      activeSection,
      ", ACTIVESUBITEM",
      activeSubitem,
      ", NAVITEMS",
      navItems
    );
  }, [activeSection, activeSubitem, navItems]);

  return (
    <div
      className={`w-full h-[56px] z-10 grid grid-cols-3 px-[16px] md:mt-[8px] rounded-xl items-center ${
        footer_text_fontFamily
          ? `font-['${footer_text_fontFamily}']`
          : "font-['Plus Jakarta Sans']"
      }
          ${
            footer_text_fontSize
              ? `text-[${footer_text_fontSize}px]`
              : "text-[10px]"
          }
          ${
            footer_text_fontWeight
              ? `font-${footer_text_fontWeight}`
              : "font-normal"
          } ${
        navItems[activeSection]?.title === t("Footer")
          ? "shadow-inner border-[#C0D123] border-[2px]"
          : ""
      }`}
      style={{
        backgroundColor: footer_color,
        color: footer_text_color,
        // borderRadius: footer_radius,
      }}
    >
      <div
        className={`px-1 flex ${
          footer_alignment == "right"
            ? "justify-end"
            : footer_alignment == "left"
            ? "justify-start"
            : "justify-center"
        }`}
      >
        <h3 className={`leading-3 tracking-tight relative`}>
          <span>{t("Powered by")}</span>
          <a
            href="https://khardl.com/"
            className="text-[#7D0A0A] font-medium hover:cursor-pointer"
          >
            {" "}
            {t("Khardl")}
          </a>
          <img
            src={GreenDot}
            alt="green dot"
            className={`${
              activeSubitem != null &&
              navItems[activeSection]?.subItems[activeSubitem]?.title ==
                t("Footer")
                ? "absolute w-[5px] h-[5px] right-[-7px] top-[-3px]"
                : "hidden"
            }`}
          />
        </h3>
      </div>
      <div
        style={{
          color: terms_and_conditions_text_color,
        }}
        className={`px-1 flex ${
          terms_and_conditions_alignment == "right"
            ? "justify-end"
            : terms_and_conditions_alignment == "left"
            ? "justify-start"
            : "justify-center"
        }`}
      >
        <span
          className="text-[#7D0A0A] font-medium cursor-pointer relative"
          onClick={onTermsAndConditionsClick}
        >
          {t("Terms and Conditions")}
          <img
            src={GreenDot}
            alt="green dot"
            className={`${
              activeSubitem != null &&
              navItems[activeSection]?.subItems[activeSubitem]?.title ==
                t("Terms and Conditions")
                ? "absolute w-[5px] h-[5px] right-[-7px] top-[-3px]"
                : "hidden"
            }`}
          />
        </span>
      </div>
      <div
        style={{
          color: privacy_policy_text_color,
        }}
        className={`px-1 flex ${
          privacy_policy_alignment == "right"
            ? "justify-end"
            : privacy_policy_alignment == "left"
            ? "justify-start"
            : "justify-center"
        }`}
      >
        <span
          className="text-[#7D0A0A] font-medium cursor-pointer relative"
          onClick={onPrivacyPolicyClick}
        >
          {t("Privacy Policy")}
          <img
            src={GreenDot}
            alt="green dot"
            className={`${
              activeSubitem != null &&
              navItems[activeSection]?.subItems[activeSubitem]?.title ==
                t("Privacy Policy")
                ? "absolute w-[5px] h-[5px] right-[-7px] top-[-3px]"
                : "hidden"
            }`}
          />
        </span>
      </div>
    </div>
  );
};

export default Footer;
