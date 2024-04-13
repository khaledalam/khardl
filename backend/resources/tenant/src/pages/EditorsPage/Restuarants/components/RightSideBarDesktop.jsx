import React, { useEffect, useState } from "react";
import { useTranslation } from "react-i18next";
import PrimarySelect from "./PrimarySelect";
import EditorSelect from "./EditorSelect";
import EditorAlignment from "./EditorAlignment";
import EditorPercentageInput from "./EditorPercentageInput";
import EditorSizeSelect from "./EditorSizeSelect";
import EditorLink from "./EditorLink";
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
        (state) => state.restuarantEditorStyle
    );

    useEffect(() => {
        activeSubitem != null &&
            console.log(
                "now : ",
                navItems[activeSection].subItems[activeSubitem]
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

        logo_border_radius,
        logo_border_color,
    } = restuarantEditorStyle;

    let actSecTitle = navItems[activeSection]?.title || null;
    let actSubTitle =
        navItems[activeSection]?.subItems[activeSubitem]?.title || null;

    const [openItems, setOpenItems] = useState([0]); // Manage open sub-items

    const handleItemClick = (index) => {
        setOpenItems((prev) =>
            prev.includes(index)
                ? prev.filter((item) => item !== index)
                : [...prev, index]
        );
    };

    return (
        <div className="flex flex-col px-[16px] h-full">
            <div className="flex flex-row">
                <h2 className="font-medium text-[14px] leading-[18px] mt-[24px] pr-[10px]">
                    {t("Designs")}
                </h2>
            </div>
            <div className="h-full">
                <ul className="flex flex-col py-4 divide-y divide-black/[0.2] h-full">
                    {activeSubitem != null &&
                        Object.keys(
                            navItems[activeSection].subItems[activeSubitem]
                        )
                            .filter(
                                (item) =>
                                    item != "title" &&
                                    navItems[activeSection].subItems[
                                        activeSubitem
                                    ][item].length > 0
                            )
                            .filter(i => i !== 'layoutOnChange'
                                && i !== 'contentPositionOnChange'
                                && i !== 'layoutInitialValues'
                                && i !== 'contentPositionInitialValues')
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
                                                ? "max-h-96 pb-[16px]"
                                                : "max-h-0"
                                        }`}
                                    >
                                        {navItems[activeSection].subItems[
                                            activeSubitem
                                            ][item].map((subItem, subIndex) => {
                                                return <li key={subIndex} className="py-1">
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
                                                                        value
                                                                    )
                                                                )
                                                            }
                                                            options={[
                                                                {
                                                                    value: "fixed",
                                                                    text: t(
                                                                        "Fixed"
                                                                    ),
                                                                },
                                                                {
                                                                    value: "relative",
                                                                    text: t(
                                                                        "Relative"
                                                                    ),
                                                                },
                                                            ]}
                                                        />
                                                    ) : subItem == "color" ? (
                                                        <EditorColorSelect
                                                            label={t("Color")}
                                                            modalId={"page-modal"}
                                                            color={navItems[activeSection].subItems[
                                                                activeSubitem
                                                                ]?.layoutInitialValues[subIndex]}
                                                            handleColorChange={(
                                                                color
                                                            ) => {
                                                                navItems[activeSection].subItems[
                                                                    activeSubitem
                                                                    ]?.layoutOnChange[subIndex](color)
                                                            }
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
                                                                        value
                                                                    )
                                                                )
                                                            }
                                                        />
                                                    ) : subItem == "radius" ? (
                                                        <EditorPercentageInput
                                                            label={t(
                                                                "Border Radius"
                                                            )}
                                                            percentage={logo_border_radius}
                                                            handlePercentageChange={navItems[activeSection].subItems[
                                                                activeSubitem
                                                                ]?.contentPositionOnChange[subIndex]}
                                                        />
                                                    ) : subItem == "font" ? (
                                                        <EditorSelect
                                                            label={t("Font")}
                                                            defaultValue={t(
                                                                "Inter"
                                                            )}
                                                            handleChange={(value) =>
                                                                dispatch(
                                                                    setHeaderPosition(
                                                                        value
                                                                    )
                                                                )
                                                            }
                                                            options={[
                                                                {
                                                                    value: "inter",
                                                                    text: t(
                                                                        "Inter"
                                                                    ),
                                                                },
                                                                {
                                                                    value: "jakarta",
                                                                    text: t(
                                                                        "Jakarta"
                                                                    ),
                                                                },
                                                            ]}
                                                        />
                                                    ) : subItem == "type" ? (
                                                        <EditorSelect
                                                            label={t("Type")}
                                                            defaultValue={t(
                                                                "Stack"
                                                            )}
                                                            handleChange={(value) =>
                                                                dispatch(
                                                                    setHeaderPosition(
                                                                        value
                                                                    )
                                                                )
                                                            }
                                                            options={[
                                                                {
                                                                    value: "stack",
                                                                    text: t(
                                                                        "Stack"
                                                                    ),
                                                                },
                                                                {
                                                                    value: "grid",
                                                                    text: t("Grid"),
                                                                },
                                                            ]}
                                                        />
                                                    ) : subItem == "weight" ? (
                                                        <EditorSelect
                                                            label={t("Weight")}
                                                            defaultValue={t(
                                                                "Regular"
                                                            )}
                                                            handleChange={(value) =>
                                                                dispatch(
                                                                    setHeaderPosition(
                                                                        value
                                                                    )
                                                                )
                                                            }
                                                            options={[
                                                                {
                                                                    value: "regular",
                                                                    text: t(
                                                                        "Regular"
                                                                    ),
                                                                },
                                                                {
                                                                    value: "light",
                                                                    text: t(
                                                                        "Light"
                                                                    ),
                                                                },
                                                            ]}
                                                        />
                                                    ) : subItem == "size" ? (
                                                        <EditorSizeSelect
                                                            label={t("Size")}
                                                            defaultValue={t(
                                                                "Regular"
                                                            )}
                                                            handleChange={(value) =>
                                                                dispatch(
                                                                    setHeaderPosition(
                                                                        value
                                                                    )
                                                                )
                                                            }
                                                        />
                                                    ) : subItem == "linkTo" ? (
                                                        <EditorLink
                                                            label={t("Link")}
                                                            handleChange={(value) =>
                                                                dispatch(
                                                                    setHeaderPosition(
                                                                        value
                                                                    )
                                                                )
                                                            }
                                                        />
                                                    ) : null}
                                                </li>
                                            }
                                        )}
                                    </ul>
                                </li>
                            ))}
                </ul>
            </div>
        </div>
    );
};
