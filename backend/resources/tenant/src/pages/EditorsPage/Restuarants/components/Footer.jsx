import React, { useEffect } from "react";
import { useDispatch, useSelector } from "react-redux";
import { useTranslation } from "react-i18next";
import GreenDot from "../../../../assets/greenDot.png";
import { AiOutlineClose } from "react-icons/ai";

import { moveSelectedIconsToMedia } from "../../../../redux/NewEditor/restuarantEditorSlice";

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
  const dispatch = useDispatch();

  const handleRemoveMediaSelect = (id) => {
    dispatch(moveSelectedIconsToMedia(id));
  };

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
      <div className="flex flex-row gap-3 justify-center w-full md:w-[190px]">
        <span
          className="font-medium cursor-pointer relative"
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
        <span
          className="font-medium cursor-pointer relative"
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
        // style={{ backgroundColor: social_media_color }}
        className={`flex justify-center py-3 w-full md:w-auto ${
          selectedSocialIcons?.length == 0 ? "hidden" : ""
        }`}
      >
        <div className="flex items-center gap-3 lg:gap-5 flex-wrap ">
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
                {
                  <button
                    key={socialMedia.id}
                    className="absolute top-[-5px] right-[-4px] text-[10px] text-bold h-fit w-fit rounded-full bg-red-500 p-[3px] text-white"
                    onClick={(e) => {
                      e.stopPropagation();
                      e.preventDefault();
                      handleRemoveMediaSelect(socialMedia.id);
                    }}
                  >
                    <AiOutlineClose size={7} />
                  </button>
                }
                <img
                  src={GreenDot}
                  alt="green dot"
                  className={`${
                    activeSubitem != null &&
                    navItems[activeSection].subItems[activeSubitem].title ==
                      "Social Media"
                      ? "absolute w-[5px] h-[5px] right-[-8px] top-[-8px]"
                      : "hidden"
                  }`}
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
            className="font-medium cursor-pointer text-green-950"
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
