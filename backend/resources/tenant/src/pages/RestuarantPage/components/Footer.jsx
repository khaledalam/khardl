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
    socialMediaIcons_alignment,
    social_media_radius,
    social_media_color,
    social_media_background_color,
    selectedSocialIcons,
  } = restaurantStyle;

  const { t } = useTranslation();
  const navigate = useNavigate();
  return (
    <div
      className={`w-full h-fit min-h-[56px] z-10 flex flex-wrap p-3 md:px-6 md:mt-[8px] rounded-xl items-center justify-between ${
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
        }`}
      style={{
        backgroundColor: footer_color,
        color: footer_text_color,
        // borderRadius: footer_radius,
      }}
    >
      <div className="flex flex-row gap-3 justify-center w-full md:w-[190px]">
        <span
          className="font-medium cursor-pointer relative"
          onClick={() => navigate("/privacy")}
        >
          {t("Privacy Policy")}
        </span>
        <span
          className="font-medium cursor-pointer relative"
          onClick={() => navigate("/policies")}
        >
          {t("Terms and Conditions")}
        </span>
      </div>
      <div
        // style={{ backgroundColor: social_media_color }}
        className={`flex justify-center py-3 w-full md:w-auto ${
          selectedSocialIcons?.length == 0 ? "hidden" : ""
        }`}
      >
        <div className="flex items-center gap-3 lg:gap-5 flex-wrap">
          {selectedSocialIcons?.map((socialMedia) => (
            <a
              key={socialMedia.id}
              href={socialMedia.link ? socialMedia.link : null}
              target="_blank"
              className="cursor-pointer"
            >
              <div
                className={`w-[35px] h-[35px] bg-[#F3F3F3] flex justify-center items-center relative shadow-md`}
                style={{
                  borderRadius: social_media_radius
                    ? social_media_radius + "%"
                    : "50%",
                  backgroundColor: social_media_background_color
                    ? social_media_background_color
                    : "#F3F3F3",
                }}
              >
                <img
                  src={socialMedia.imgUrl}
                  alt={"whatsapp"}
                  className="w-[20px] h-[20px] object-cover"
                  // onClick={() =>
                  //     handleSocialMediaSelect(socialMedia.id)
                  // }
                />
              </div>
            </a>
          ))}
        </div>
      </div>
      <div className="flex justify-center w-full md:w-[190px]">
        <h3 className={`leading-3 tracking-tight relative`}>
          <span className="font-light opacity-75">{t("Powered by")}</span>
          <a
            href="https://khardl.com/"
            className="font-medium hover:cursor-pointer text-lime-400"
          >
            {" "}
            {t("Khardl")}
          </a>
        </h3>
      </div>
    </div>
  );
};

export default Footer;
