import React, { useEffect, useState } from "react";
import { useTranslation } from "react-i18next";
import PrimarySelect from "./PrimarySelect";
import EditorSelect from "./EditorSelect";
import EditorAlignment from "./EditorAlignment";
import SocialMediaCollection from "./SocialMediaCollection";
import { IoAdd } from "react-icons/io5";
import PhoneInput from "react-phone-input-2";
import { useSelector, useDispatch } from "react-redux";
import Down from "../../../../assets/down.svg";
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

export const RightSideBarDesktop = ({
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

    const [openItems, setOpenItems] = useState([]); // Manage open sub-items

    const handleItemClick = (index) => {
        setOpenItems((prev) =>
            prev.includes(index)
                ? prev.filter((item) => item !== index)
                : [...prev, index],
        );
    };

    const sidebarData = [
        {
            title: "Item 1",
            subItems: ["Sub Item 1.1", "Sub Item 1.2", "Sub Item 1.3"],
        },
        {
            title: "Item 2",
            subItems: ["Sub Item 2.1", "Sub Item 2.2", "Sub Item 2.3"],
        },
        {
            title: "Item 3",
            subItems: ["Sub Item 3.1", "Sub Item 3.2", "Sub Item 3.3"],
        },
    ];

    return (
        <div className="flex flex-col px-[16px]">
            <div className="flex flex-row">
                <h2 className="font-medium text-[14px] leading-[18px] mt-[24px] pr-[10px]">
                    {t("Designs")}
                </h2>
            </div>
            <div>
                <ul className="flex flex-col py-4 divide-y divide-black/[0.2]">
                    {activeSubitem != null &&
                        Object.keys(
                            navItems[activeSection].subItems[activeSubitem],
                        )
                            .filter(
                                (item) =>
                                    item != "title" &&
                                    navItems[activeSection].subItems[
                                        activeSubitem
                                    ][item].length > 0,
                            )
                            .map((item, index) => (
                                <li key={index}>
                                    <button
                                        type="button"
                                        className="flex items-center justify-between w-[191px] py-3"
                                        onClick={() => handleItemClick(index)}
                                    >
                                        <span className="text-[12px] leading-[16px] font-medium text-[#111827C4]/[.77]">
                                            {t(item)}
                                        </span>
                                        <span
                                            className={`transition duration-300 ${
                                                openItems.includes(index)
                                                    ? "rotate-180"
                                                    : ""
                                            }`}
                                        >
                                            <img src={Down} alt="down" />
                                        </span>
                                    </button>
                                    <ul
                                        className={`overflow-hidden transition-all duration-300 ${
                                            openItems.includes(index)
                                                ? "max-h-40"
                                                : "max-h-0"
                                        }`}
                                    >
                                        {navItems[activeSection].subItems[
                                            activeSubitem
                                        ][item].map((subItem, subIndex) => (
                                            <li key={subIndex} className="py-1">
                                                {subItem == "positionLayout" ? (
                                                    <EditorSelect
                                                        label={t("Position")}
                                                        defaultValue={
                                                            headerPosition ===
                                                            "relative"
                                                                ? t("Relative")
                                                                : t("Fixed")
                                                        }
                                                        handleChange={(value) =>
                                                            dispatch(
                                                                setHeaderPosition(
                                                                    value,
                                                                ),
                                                            )
                                                        }
                                                        options={[
                                                            {
                                                                value: "fixed",
                                                                text: t(
                                                                    "Fixed",
                                                                ),
                                                            },
                                                            {
                                                                value: "relative",
                                                                text: t(
                                                                    "Relative",
                                                                ),
                                                            },
                                                        ]}
                                                    />
                                                ) : subItem == "color" ? (
                                                    <EditorColorSelect
                                                        label={t("Color")}
                                                        modalId={"page-modal"}
                                                        color={`${t(page_color)}`}
                                                        handleColorChange={(
                                                            color,
                                                        ) =>
                                                            dispatch(
                                                                headerColor(
                                                                    color,
                                                                ),
                                                            )
                                                        }
                                                    />
                                                ) : subItem ==
                                                  "positionContent" ? (
                                                    <EditorAlignment
                                                        defaultValue={
                                                            logo_alignment
                                                        }
                                                        onChange={(value) =>
                                                            dispatch(
                                                                logoAlignment(
                                                                    value,
                                                                ),
                                                            )
                                                        }
                                                    />
                                                ) : (
                                                    <></>
                                                )}
                                            </li>
                                        ))}
                                    </ul>
                                </li>
                            ))}
                </ul>
            </div>
        </div>
    );
};
