import React, { useEffect, useState } from "react";
import { useTranslation } from "react-i18next";
import PrimarySelect from "./PrimarySelect";
import EditorSelect from "./EditorSelect";
import EditorAlignment from "./EditorAlignment";
import EditorPosition from "./EditorPosition";
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
                <h2 className="font-medium text-[14px] xl:text-[18px] leading-[18px] mt-[24px] pr-[10px]">
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
                                    item != "layoutOnChange" &&
                                    item != "contentPositionOnChange" &&
                                    item != "layoutInitialValues" &&
                                    item != "contentPositionInitialValues" &&
                                    item != "textInitialValues" &&
                                    item != "textOnChange" &&
                                    item != "textInitialValues_2" &&
                                    item != "textOnChange_2" &&
                                    navItems[activeSection].subItems[
                                        activeSubitem
                                    ][item].length > 0
                            )
                            .map((item, index) => (
                                <li key={index}>
                                    <button
                                        type="button"
                                        className="flex items-center justify-between w-[191px] lg:w-full py-3"
                                        onClick={() => handleItemClick(index)}
                                    >
                                        <span className="text-[12px] xl:text-[16px] leading-[16px] font-medium text-[#111827C4]/[.77]">
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
                                            return (
                                                <li
                                                    key={subIndex}
                                                    className="py-1 xl:py-3"
                                                >
                                                    {subItem ==
                                                    "positionLayout" ? (
                                                        <EditorSelect
                                                            label={t(
                                                                "Position"
                                                            )}
                                                            defaultValue={
                                                                headerPosition ===
                                                                "relative"
                                                                    ? t(
                                                                          "Relative"
                                                                      )
                                                                    : t("Fixed")
                                                            }
                                                            handleChange={(
                                                                value
                                                            ) =>
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
                                                            modalId={`${item}-color-modal`}
                                                            handleColorChange={
                                                                item ===
                                                                "layout"
                                                                    ? (
                                                                          color
                                                                      ) => {
                                                                          navItems[
                                                                              activeSection
                                                                          ].subItems[
                                                                              activeSubitem
                                                                          ]?.layoutOnChange[
                                                                              subIndex
                                                                          ](
                                                                              color
                                                                          );
                                                                      }
                                                                    : item ===
                                                                      "contentPosition"
                                                                    ? (
                                                                          color
                                                                      ) => {
                                                                          navItems[
                                                                              activeSection
                                                                          ].subItems[
                                                                              activeSubitem
                                                                          ]?.contentPositionOnChange[
                                                                              subIndex
                                                                          ](
                                                                              color
                                                                          );
                                                                      }
                                                                    : item ===
                                                                      "text"
                                                                    ? (
                                                                          color
                                                                      ) => {
                                                                          navItems[
                                                                              activeSection
                                                                          ].subItems[
                                                                              activeSubitem
                                                                          ]?.textOnChange[
                                                                              subIndex
                                                                          ](
                                                                              color
                                                                          );
                                                                      }
                                                                    : (
                                                                          color
                                                                      ) => {
                                                                          navItems[
                                                                              activeSection
                                                                          ].subItems[
                                                                              activeSubitem
                                                                          ]?.textOnChange_2[
                                                                              subIndex
                                                                          ](
                                                                              color
                                                                          );
                                                                      }
                                                            }
                                                            color={
                                                                item ===
                                                                "layout"
                                                                    ? navItems[
                                                                          activeSection
                                                                      ]
                                                                          .subItems[
                                                                          activeSubitem
                                                                      ]
                                                                          ?.layoutInitialValues[
                                                                          subIndex
                                                                      ]
                                                                    : item ===
                                                                      "contentPosition"
                                                                    ? navItems[
                                                                          activeSection
                                                                      ]
                                                                          .subItems[
                                                                          activeSubitem
                                                                      ]
                                                                          ?.contentPositionInitialValues[
                                                                          subIndex
                                                                      ]
                                                                    : item ===
                                                                      "text"
                                                                    ? navItems[
                                                                          activeSection
                                                                      ]
                                                                          .subItems[
                                                                          activeSubitem
                                                                      ]
                                                                          ?.textInitialValues[
                                                                          subIndex
                                                                      ]
                                                                    : navItems[
                                                                          activeSection
                                                                      ]
                                                                          .subItems[
                                                                          activeSubitem
                                                                      ]
                                                                          ?.textInitialValues_2[
                                                                          subIndex
                                                                      ]
                                                            }
                                                        />
                                                    ) : subItem ==
                                                      "positionContent" ? (
                                                        <EditorAlignment
                                                            modalId={`${item}-position-modal`}
                                                            defaultValue={
                                                                navItems[
                                                                    activeSection
                                                                ].subItems[
                                                                    activeSubitem
                                                                ]
                                                                    ?.contentPositionInitialValues[
                                                                    subIndex
                                                                ]
                                                            }
                                                            onChange={(
                                                                value
                                                            ) => {
                                                                navItems[
                                                                    activeSection
                                                                ].subItems[
                                                                    activeSubitem
                                                                ]?.contentPositionOnChange[
                                                                    subIndex
                                                                ](value);
                                                            }}
                                                        />
                                                    ) : subItem == "radius" ? (
                                                        <EditorPercentageInput
                                                            label={t(
                                                                "Border Radius"
                                                            )}
                                                            percentage={
                                                                item ===
                                                                "layout"
                                                                    ? navItems[
                                                                          activeSection
                                                                      ]
                                                                          .subItems[
                                                                          activeSubitem
                                                                      ]
                                                                          ?.layoutInitialValues[
                                                                          subIndex
                                                                      ]
                                                                    : navItems[
                                                                          activeSection
                                                                      ]
                                                                          .subItems[
                                                                          activeSubitem
                                                                      ]
                                                                          ?.contentPositionInitialValues[
                                                                          subIndex
                                                                      ]
                                                            }
                                                            handlePercentageChange={
                                                                item ===
                                                                "layout"
                                                                    ? (
                                                                          color
                                                                      ) => {
                                                                          navItems[
                                                                              activeSection
                                                                          ].subItems[
                                                                              activeSubitem
                                                                          ]?.layoutOnChange[
                                                                              subIndex
                                                                          ](
                                                                              color
                                                                          );
                                                                      }
                                                                    : navItems[
                                                                          activeSection
                                                                      ]
                                                                          .subItems[
                                                                          activeSubitem
                                                                      ]
                                                                          ?.contentPositionOnChange[
                                                                          subIndex
                                                                      ]
                                                            }
                                                        />
                                                    ) : subItem == "font" ? (
                                                        <EditorSelect
                                                            label={t("Font")}
                                                            defaultValue={
                                                                item === "text"
                                                                    ? navItems[
                                                                          activeSection
                                                                      ]
                                                                          .subItems[
                                                                          activeSubitem
                                                                      ]
                                                                          ?.textInitialValues[
                                                                          subIndex
                                                                      ]
                                                                    : navItems[
                                                                          activeSection
                                                                      ]
                                                                          .subItems[
                                                                          activeSubitem
                                                                      ]
                                                                          ?.textInitialValues_2[
                                                                          subIndex
                                                                      ]
                                                            }
                                                            handleChange={(
                                                                value
                                                            ) => {
                                                                item === "text"
                                                                    ? navItems[
                                                                          activeSection
                                                                      ].subItems[
                                                                          activeSubitem
                                                                      ]?.textOnChange[
                                                                          subIndex
                                                                      ](value)
                                                                    : navItems[
                                                                          activeSection
                                                                      ].subItems[
                                                                          activeSubitem
                                                                      ]?.textOnChange_2[
                                                                          subIndex
                                                                      ](value);
                                                            }}
                                                            options={[
                                                                {
                                                                    value: "cairo",
                                                                    text: "Cairo",
                                                                },
                                                                {
                                                                    value: "Poppins",
                                                                    text: "Poppins",
                                                                },
                                                                {
                                                                    value: "Roboto",
                                                                    text: "Roboto",
                                                                },
                                                                {
                                                                    value: "Plus Jakarta Sans",
                                                                    text: "Jakarta",
                                                                },
                                                            ]}
                                                        />
                                                    ) : subItem == "type" ? (
                                                        <EditorSelect
                                                            label={t("Type")}
                                                            defaultValue={t(
                                                                "Stack"
                                                            )}
                                                            handleChange={(
                                                                value
                                                            ) =>
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
                                                                    text: t(
                                                                        "Grid"
                                                                    ),
                                                                },
                                                            ]}
                                                        />
                                                    ) : subItem == "weight" ? (
                                                        <EditorSelect
                                                            label={t("Weight")}
                                                            defaultValue={
                                                                item === "text"
                                                                    ? navItems[
                                                                          activeSection
                                                                      ]
                                                                          .subItems[
                                                                          activeSubitem
                                                                      ]
                                                                          ?.textInitialValues[
                                                                          subIndex
                                                                      ]
                                                                    : navItems[
                                                                          activeSection
                                                                      ]
                                                                          .subItems[
                                                                          activeSubitem
                                                                      ]
                                                                          ?.textInitialValues_2[
                                                                          subIndex
                                                                      ]
                                                            }
                                                            handleChange={(
                                                                value
                                                            ) => {
                                                                item === "text"
                                                                    ? navItems[
                                                                          activeSection
                                                                      ].subItems[
                                                                          activeSubitem
                                                                      ]?.textOnChange[
                                                                          subIndex
                                                                      ](value)
                                                                    : navItems[
                                                                          activeSection
                                                                      ].subItems[
                                                                          activeSubitem
                                                                      ]?.textOnChange_2[
                                                                          subIndex
                                                                      ](value);
                                                            }}
                                                            options={[
                                                                {
                                                                    value: "thin",
                                                                    text: t(
                                                                        "Thin"
                                                                    ),
                                                                },
                                                                {
                                                                    value: "extralight",
                                                                    text: t(
                                                                        "Extra Light"
                                                                    ),
                                                                },
                                                                {
                                                                    value: "light",
                                                                    text: t(
                                                                        "Light"
                                                                    ),
                                                                },
                                                                {
                                                                    value: "normal",
                                                                    text: t(
                                                                        "Normal"
                                                                    ),
                                                                },
                                                                {
                                                                    value: "medium",
                                                                    text: t(
                                                                        "Medium"
                                                                    ),
                                                                },
                                                                {
                                                                    value: "semibold",
                                                                    text: t(
                                                                        "Semibold"
                                                                    ),
                                                                },
                                                                {
                                                                    value: "bold",
                                                                    text: t(
                                                                        "Bold"
                                                                    ),
                                                                },
                                                            ]}
                                                        />
                                                    ) : subItem == "size" ? (
                                                        <EditorSizeSelect
                                                            label={t("Size")}
                                                            defaultValue={
                                                                item === "text"
                                                                    ? navItems[
                                                                          activeSection
                                                                      ]
                                                                          .subItems[
                                                                          activeSubitem
                                                                      ]
                                                                          ?.textInitialValues[
                                                                          subIndex
                                                                      ]
                                                                    : navItems[
                                                                          activeSection
                                                                      ]
                                                                          .subItems[
                                                                          activeSubitem
                                                                      ]
                                                                          ?.textInitialValues_2[
                                                                          subIndex
                                                                      ]
                                                            }
                                                            handleChange={(
                                                                value
                                                            ) => {
                                                                item === "text"
                                                                    ? navItems[
                                                                          activeSection
                                                                      ].subItems[
                                                                          activeSubitem
                                                                      ]?.textOnChange[
                                                                          subIndex
                                                                      ](value)
                                                                    : navItems[
                                                                          activeSection
                                                                      ].subItems[
                                                                          activeSubitem
                                                                      ]?.textOnChange_2[
                                                                          subIndex
                                                                      ](value);
                                                            }}
                                                        />
                                                    ) : subItem == "linkTo" ? (
                                                        <EditorLink
                                                            label={t("Link")}
                                                            handleChange={(
                                                                value
                                                            ) =>
                                                                dispatch(
                                                                    setHeaderPosition(
                                                                        value
                                                                    )
                                                                )
                                                            }
                                                        />
                                                    ) : subItem ==
                                                      "positionLayoutGrid" ? (
                                                        <EditorPosition
                                                            modalId={`${item}-position`}
                                                            defaultValue={
                                                                navItems[
                                                                    activeSection
                                                                ].subItems[
                                                                    activeSubitem
                                                                ]
                                                                    ?.layoutInitialValues[
                                                                    subIndex
                                                                ]
                                                            }
                                                            onChange={(
                                                                value
                                                            ) => {
                                                                navItems[
                                                                    activeSection
                                                                ].subItems[
                                                                    activeSubitem
                                                                ]?.layoutOnChange[
                                                                    subIndex
                                                                ](value);
                                                            }}
                                                        />
                                                    ) : null}
                                                </li>
                                            );
                                        })}
                                    </ul>
                                </li>
                            ))}
                </ul>
            </div>
        </div>
    );
};
