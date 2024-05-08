import React, { useEffect, useState } from "react";
import { useTranslation } from "react-i18next";
import { useNavigate } from "react-router-dom";

const Footer = ({ restaurantStyle }) => {
  const {
    footer_color,
    footer_alignment,
    footer_text_fontFamily,
    footer_text_fontWeight,
    footer_text_fontSize,
    footer_text_color,
  } = restaurantStyle;

  const { t } = useTranslation();
  const navigate = useNavigate();
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
          }
      }`}
      style={{
        backgroundColor: footer_color,
        color: footer_text_color,
        // borderRadius: footer_radius,
      }}
    >
      <div className={`flex justify-end`}>
        <span
          className="text-[#7D0A0A] font-medium cursor-pointer relative"
          onClick={() => navigate("/restaurant/privacy-policy")}
        >
          {t("Privacy Policy")}
        </span>
      </div>
      <div
        className={`flex ${
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
        </h3>
      </div>
      <div className={`flex justify-start`}>
        <span
          className="text-[#7D0A0A] font-medium cursor-pointer relative"
          onClick={() => navigate("/restaurant/terms-and-conditions")}
        >
          {t("Terms and Conditions")}
        </span>
      </div>
    </div>
  );
};

export default Footer;
