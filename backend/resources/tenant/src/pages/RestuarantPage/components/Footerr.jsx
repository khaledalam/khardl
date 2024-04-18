import React from "react";
import imgWhatsapp from "../../../assets/whatsappImg.svg";
import { useSelector } from "react-redux";
import { WEBSITE_URL } from "../../../config";
import { useTranslation } from "react-i18next";

const FooterRestuarant = () => {
    const language = useSelector((state) => state.languageMode.languageMode);
    const { t } = useTranslation();
    const restaurantStyle = useSelector((state) => state.restuarantEditorStyle);
    const {
        footer_alignment,
        footer_text_color,
        text_fontFamily,
        footer_text_fontSize,
        footer_text_fontWeight,
    } = restaurantStyle;

    return (
        <div className="w-full flex flex-col gap-4">
            <div
                style={{ background: restaurantStyle?.footer_color }}
                className="w-full b h-[85px] flex flex-col gap-4  items-center justify-center"
            >
                <div
                    className={`flex flex-col gap-3 ${
                        restaurantStyle?.socialMediaIcons_alignment === "center"
                            ? "items-center justify-center"
                            : restaurantStyle?.socialMediaIcons_alignment ===
                              "left"
                            ? "items-center justify-start"
                            : restaurantStyle?.socialMediaIcons_alignment ===
                              "right"
                            ? "items-center justify-end"
                            : ""
                    }`}
                >
                    <div className="flex items-center gap-3">
                        {restaurantStyle?.selectedSocialIcons?.map(
                            (socialMedia, idx) => (
                                <a
                                    href={socialMedia?.link}
                                    rel="noreferrer"
                                    target="_blank"
                                    className="cursor-pointer"
                                    key={idx + "icon"}
                                >
                                    <div className="w-[30px] h-[30px]">
                                        <img
                                            src={
                                                socialMedia?.imgUrl
                                                    ? socialMedia.imgUrl
                                                    : imgWhatsapp
                                            }
                                            alt={
                                                socialMedia?.name ??
                                                "social media"
                                            }
                                            className="w-full h-full object-contain"
                                        />
                                    </div>
                                </a>
                            )
                        )}
                    </div>
                </div>
                {restaurantStyle?.phoneNumber && (
                    <div
                        className={`flex flex-col gap-3 ${
                            restaurantStyle?.phoneNumber_alignment === "center"
                                ? "items-center justify-center"
                                : restaurantStyle?.phoneNumber_alignment ===
                                  "left"
                                ? "items-center justify-start"
                                : restaurantStyle?.phoneNumber_alignment ===
                                  "right"
                                ? "items-center justify-end"
                                : ""
                        }`}
                    >
                        {" "}
                        <a
                            href={`tel:${restaurantStyle?.phoneNumber}`}
                            // style={{ color: restaurantStyle?.text_color }}
                            className="font-semibold cursor-pointer text-white"
                        >
                            {restaurantStyle?.phoneNumber}
                        </a>
                    </div>
                )}
            </div>
            {/* <div className="h-7 flex bg-white items-center justify-between p-2">
                {language === "en" ? (
                    <h3 className="pl-16 text-[1rem] text-neutral-700 font-medium">
                        Powered by{" "}
                        <a
                            href={WEBSITE_URL}
                            className="text-neutral-400 text-sm cursor-pointer"
                        >
                            Khardl
                        </a>
                    </h3>
                ) : (
                    <h3 className="pl-16 text-[1rem] text-neutral-700 font-medium">
                        مشغل بواسطة{" "}
                        <a
                            href={WEBSITE_URL}
                            className="text-neutral-400 text-sm cursor-pointer"
                        >
                            خردل
                        </a>
                    </h3>
                )}
            </div> */}
            <div
                style={{ backgroundColor: "white" }}
                className={`w-full min-h-[30px]  rounded-xl flex  ${
                    footer_alignment === "center"
                        ? "items-center justify-center"
                        : footer_alignment === "left"
                        ? "items-center justify-start"
                        : footer_alignment === "right"
                        ? "items-center justify-end"
                        : ""
                }`}
            >
                <h3
                    style={{ color: footer_text_color }}
                    className={`${
                        text_fontFamily
                            ? `font-['${text_fontFamily}']`
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
                     leading-3 tracking-tight relative`}
                >
                    <span>{t("Powered by @Khardl")}</span>
                </h3>
            </div>
        </div>
    );
};

export default FooterRestuarant;
