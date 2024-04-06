import React, { useEffect, useState } from "react";
import { useTranslation } from "react-i18next";
import PrimarySelect from "./PrimarySelect";
import EditorSelect from "./EditorSelect";
import LogoAlignment from "./LogoAlignment";
import SocialMediaCollection from "./SocialMediaCollection";
import { IoAdd } from "react-icons/io5";
import PhoneInput from "react-phone-input-2";
import { useSelector, useDispatch } from "react-redux";
import {
    bannerType,
    categoryAlignment,
    logoAlignment,
    headerPosition as setHeaderPosition,
    socialMediaIconsAlignment,
    phoneNumber as setPhoneNumber,
    phoneNumberAlignment,
    pageColor,
    pageCategoryColor,
    categoryShape,
    bannerShape,
    bannerBgColor,
    logoShape,
    categoryHoverColor,
    categoryDetailCartColor,
    categoryDetailShape,
    headerColor,
    footerColor,
    priceColor,
    textColor,
    textFontSize,
    textFontFamily,
    textFontWeight,
    textAlignment,
    productBackgroundColor,
} from "../../../../redux/NewEditor/restuarantEditorSlice";
import EditorColorSelect from "./EditorColorSelect";

export const RightSideBarMobile = ({
    activeSection,
    setActiveSection,
    activeSubitem,
    setActiveSubitem,
    navItems,
    activeDesignSection,
    setActiveDesignSection,
}) => {
    const { t } = useTranslation();
    const dispatch = useDispatch();
    const restuarantEditorStyle = useSelector(
        (state) => state.restuarantEditorStyle,
    );

    useEffect(() => {
        activeSubitem != null &&
            console.log(
                "now : ",
                navItems[activeSection].subItems[activeSubitem],
            );
    }, [activeSection, activeSubitem]);

    const {
        headerPosition,
        logo_alignment,
        banner_type,
        category_alignment,
        socialMediaIcons_alignment,
        selectedSocialIcons,
        phoneNumber,
        phoneNumber_alignment,
        page_color,
        page_category_color,
        product_background_color,
        category_hover_color,
        categoryDetail_cart_color,
        header_color,
        logo_shape,
        banner_shape,
        banner_background_color,
        categoryDetail_shape,
        category_shape,
        footer_color,
        price_color,
        text_color,
        text_fontFamily,
        text_fontWeight,
        text_alignment,
        text_fontSize,
    } = restuarantEditorStyle;

    let actSecTitle = navItems[activeSection]?.title || null;
    let actSubTitle =
        navItems[activeSection]?.subItems[activeSubitem]?.title || null;

    return (
        <div className="flex flex-col">
            Mobile
            <div className="flex flex-row px-[16px]">
                <h2 className="font-medium text-[12px] leading-[16px] mt-[16px] mb-4 pr-[10px]">
                    {t("Designs")}
                </h2>
                {activeSubitem != null && (
                    <div className="flex flex-col">
                        <div className="flex flex-row h-[24px] border-l pl-[8px] mt-[12px] space-x-[8px]">
                            {Object.keys(
                                navItems[activeSection].subItems[activeSubitem],
                            ).map(
                                (key, index) =>
                                    key != "title" &&
                                    navItems[activeSection].subItems[
                                        activeSubitem
                                    ][key].length > 0 && (
                                        <div
                                            key={key}
                                            onClick={() =>
                                                setActiveDesignSection(key)
                                            }
                                            className={`text-[10px] h-[24px] font-light leading-[13px] rounded-[50px] pt-[5px] pb-[6px] pr-[11px] pl-[12px] ${activeDesignSection === key ? "font-medium bg-[#F3F3F3]" : ""}`}
                                        >
                                            {t(key)}
                                        </div>
                                    ),
                            )}
                        </div>
                    </div>
                )}
            </div>
            {activeDesignSection != null && (
                <div className="">
                    {/* {actSecTitle == "Header" ? (
                        actSubTitle == "Side Menu" ? (
                            activeDesignSection == "layout" ? (
                                <div className="px-[16px] space-y-[8px]">
                                    <EditorSelect
                                        label={t("Position")}
                                        defaultValue={
                                            headerPosition === "relative"
                                                ? t("Relative")
                                                : t("Fixed")
                                        }
                                        handleChange={(value) =>
                                            dispatch(setHeaderPosition(value))
                                        }
                                        options={[
                                            {
                                                value: "fixed",
                                                text: t("Fixed"),
                                            },
                                            {
                                                value: "relative",
                                                text: t("Relative"),
                                            },
                                        ]}
                                    />
                                    <EditorColorSelect
                                        label={t("Color")}
                                        modalId={"page-modal"}
                                        color={`${t(page_color)}`}
                                        handleColorChange={(color) =>
                                            dispatch(headerColor(color))
                                        }
                                    />
                                </div>
                            ) : activeDesignSection == "contentPosition" ? (
                                <div>contentPosition 2</div>
                            ) : activeDesignSection == "text" ? (
                                <div>text 2</div>
                            ) : activeDesignSection == "link" ? (
                                <div>link 2</div>
                            ) : (
                                <></>
                            )
                        ) : actSubTitle == "Order Cart" ? (
                            activeDesignSection == "layout" ? (
                                <div>layout 2</div>
                            ) : activeDesignSection == "contentPosition" ? (
                                <div>contentPosition 2</div>
                            ) : activeDesignSection == "text" ? (
                                <div>text 2</div>
                            ) : activeDesignSection == "link" ? (
                                <div>link 2</div>
                            ) : (
                                <></>
                            )
                        ) : actSubTitle == "Home" ? (
                            activeDesignSection == "layout" ? (
                                <div>layout 2</div>
                            ) : activeDesignSection == "contentPosition" ? (
                                <div>contentPosition 2</div>
                            ) : activeDesignSection == "text" ? (
                                <div>text 2</div>
                            ) : activeDesignSection == "link" ? (
                                <div>link 2</div>
                            ) : (
                                <></>
                            )
                        ) : (
                            <></>
                        )
                    ) : (
                        <></>
                    )} */}
                </div>
            )}
        </div>
    );
};
