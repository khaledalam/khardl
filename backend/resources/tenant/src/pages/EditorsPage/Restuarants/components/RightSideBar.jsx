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

export const RightSideBar = ({
    activeSection,
    setActiveSection,
    activeSubitem,
    setActiveSubitem,
    navItems,
}) => {
    const { t } = useTranslation();
    const dispatch = useDispatch();
    const restuarantEditorStyle = useSelector(
        (state) => state.restuarantEditorStyle,
    );
    const [activeDesignSection, setActiveDesignSection] = useState(null);

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

    return (
        <div className="flex flex-col">
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
                            {/* {navItems[activeSection].subItems[activeSubitem].map(
                        (title) => (
                            <div className="text-[10px]">{title}</div>
                        ),
                    )} */}
                            {/* {navItems[activeSection].subItems[activeSubitem].layout
                        .length > 0 && <div className="">Layout</div>}
                    {navItems[activeSection].subItems[activeSubitem]
                        .contentPosition.length > 0 && (
                        <div>contentPosition</div>
                    )}
                    {navItems[activeSection].subItems[activeSubitem].text
                        .length > 0 && <div>text</div>}
                    {navItems[activeSection].subItems[activeSubitem].link
                        .length > 0 && <div>link</div>} */}
                        </div>
                    </div>
                )}
                {/* <div className="flex flex-col gap-4">
                {navItems.map((item, index) => (
                    <ul key={`item-${index}`} className="flex flex-col gap-2">
                        {item.subItems.map((subItem, subIndex) => (
                            <li key={`subIndex-${subIndex}`}>
                                {subItem.layout.length > 0 && <div>Layout</div>}
                                {subItem.contentPosition.length > 0 && (
                                    <div>contentPosition</div>
                                )}
                                {subItem.text.length > 0 && <div>text</div>}
                                {subItem.link.length > 0 && <div>link</div>}
                            </li>
                        ))}
                    </ul>
                ))} 
            </div> */}
            </div>
            {activeDesignSection != null && (
                <div className="px-[16px] space-y-[8px]">
                    {/* {navItems[activeSection].title == "Header" ? (
                        navItems[activeSection].subItems[activeSubitem].title ==
                        "Side Menu" ? (
                            <div>side menu</div>
                        ) : activeDesignSection == "Order Cart" ? (
                            <div>order Cart</div>
                        ) : activeDesignSection == "Home" ? (
                            <div>Home</div>
                        ) : (
                            <></>
                        )
                    ) : (
                        <></>
                    )} */}
                    {/* {t(activeDesignSection)}
                    {navItems[activeSection].title}
                    {navItems[activeSection].subItems[activeSubitem].title} */}
                    {/* <EditorSelect
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
                            { value: "fixed", text: t("Fixed") },
                            { value: "relative", text: t("Relative") },
                        ]}
                    />
                    <EditorColorSelect
                        label={t("Color")}
                        modalId={"page-modal"}
                        color={`${t(page_color)}`}
                        handleColorChange={(color) =>
                            dispatch(pageColor(color))
                        }
                    /> */}
                </div>
            )}
        </div>
    );
};
