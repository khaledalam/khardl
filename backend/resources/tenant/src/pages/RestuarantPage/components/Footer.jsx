import React from "react";
import { useTranslation } from "react-i18next";
import { useNavigate } from "react-router-dom";

const Footer = ({ restaurantStyle }) => {
  const {
    footer_color,
    footer_alignment,
    footer_text_fontFamily = "Plus Jakarta Sans",
    footer_text_fontWeight = "normal",
    footer_text_fontSize = 10,
    footer_text_color,
    socialMediaIcons_alignment,
    social_media_radius = 50,
    social_media_color,
    social_media_background_color = "#F3F3F3",
    selectedSocialIcons = [],
  } = restaurantStyle;

  const { t } = useTranslation();
  const navigate = useNavigate();

  const footerStyle = {
    backgroundColor: footer_color,
    color: footer_text_color,
  };

  return (
    <div
      className={`w-full h-fit min-h-[56px] z-10 flex flex-wrap p-3 md:px-6 md:mt-[8px] rounded-xl items-center justify-between font-['${footer_text_fontFamily}'] text-[${footer_text_fontSize}px] font-${footer_text_fontWeight}`}
      style={footerStyle}
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
      {selectedSocialIcons.length > 0 && (
        <div className={`flex justify-center py-3 w-full md:w-auto`}>
          <div className="flex items-center gap-3 lg:gap-5 flex-wrap">
            {selectedSocialIcons.map((socialMedia) => (
              <a
                key={socialMedia.id}
                href={socialMedia.link || "#"}
                target="_blank"
                className="cursor-pointer"
                rel="noopener noreferrer"
              >
                <div
                  className="w-[35px] h-[35px] flex justify-center items-center relative shadow-md"
                  style={{
                    borderRadius: `${social_media_radius}%`,
                    backgroundColor: social_media_background_color,
                  }}
                >
                  <img
                    src={socialMedia.imgUrl}
                    alt={socialMedia.id}
                    className="w-[20px] h-[20px] object-cover"
                  />
                </div>
              </a>
            ))}
          </div>
        </div>
      )}
      <div className="flex justify-center w-full md:w-[190px]">
        <h3 className="leading-3 tracking-tight relative">
          <span className="font-light opacity-75">{t("Powered by")}</span>
          <span className="font-medium text-lime-400"> {t("Khardl")}</span>
        </h3>
      </div>
    </div>
  );
};

export default React.memo(Footer);
