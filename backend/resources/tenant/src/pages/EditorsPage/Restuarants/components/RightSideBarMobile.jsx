import React, { useEffect, useState } from "react";
import { useTranslation } from "react-i18next";
import PrimarySelect from "./PrimarySelect";
import EditorSelect from "./EditorSelect";
import EditorAlignment from "./EditorAlignment";
import EditorPercentageInput from "./EditorPercentageInput";
import EditorSizeSelect from "./EditorSizeSelect";
import EditorLink from "./EditorLink";
import LogoAlignment from "./LogoAlignment";
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
      <div className="flex flex-row px-[16px]">
        <h2 className="font-medium text-[12px] leading-[16px] mt-[16px] mb-4 pr-[10px]">
          {t("Designs")}
        </h2>
        {activeSubitem != null && (
          <div className="flex flex-col">
            <div className="flex flex-row h-[24px] border-l pl-[8px] mt-[12px] space-x-[8px]">
              {Object.keys(navItems[activeSection].subItems[activeSubitem])
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
                    navItems[activeSection].subItems[activeSubitem][item]
                      .length > 0,
                )
                .map(
                  (key, index) =>
                    key != "title" &&
                    navItems[activeSection].subItems[activeSubitem][key]
                      .length > 0 && (
                      <div
                        key={key}
                        onClick={() => setActiveDesignSection(key)}
                        className={`text-[10px] h-[24px] font-light leading-[13px] rounded-[50px] pt-[5px] pb-[6px] pr-[11px] pl-[12px] ${
                          activeDesignSection === key
                            ? "font-medium bg-[#F3F3F3]"
                            : ""
                        }`}
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
        <div className="px-[16px]">
          {navItems[activeSection].subItems[activeSubitem][
            activeDesignSection
          ].map((subItem, subIndex) => (
            <div key={subIndex} className="py-1">
              {subItem == "positionLayout" ? (
                <EditorSelect
                  label={t("Position")}
                  defaultValue={
                    headerPosition === "relative" ? t("Relative") : t("Fixed")
                  }
                  handleChange={(value) => dispatch(setHeaderPosition(value))}
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
              ) : subItem == "color" ? (
                <EditorColorSelect
                  label={t("Color")}
                  modalId={`${activeDesignSection}-color-modal`}
                  handleColorChange={
                    activeDesignSection === "layout"
                      ? (color) => {
                          navItems[activeSection].subItems[
                            activeSubitem
                          ]?.layoutOnChange[subIndex](color);
                        }
                      : activeDesignSection === "contentPosition"
                        ? (color) => {
                            navItems[activeSection].subItems[
                              activeSubitem
                            ]?.contentPositionOnChange[subIndex](color);
                          }
                        : activeDesignSection === "text"
                          ? (color) => {
                              navItems[activeSection].subItems[
                                activeSubitem
                              ]?.textOnChange[subIndex](color);
                            }
                          : (color) => {
                              navItems[activeSection].subItems[
                                activeSubitem
                              ]?.textOnChange_2[subIndex](color);
                            }
                  }
                  color={
                    activeDesignSection === "layout"
                      ? navItems[activeSection].subItems[activeSubitem]
                          ?.layoutInitialValues[subIndex]
                      : activeDesignSection === "contentPosition"
                        ? navItems[activeSection].subItems[activeSubitem]
                            ?.contentPositionInitialValues[subIndex]
                        : activeDesignSection === "text"
                          ? navItems[activeSection].subItems[activeSubitem]
                              ?.textInitialValues[subIndex]
                          : navItems[activeSection].subItems[activeSubitem]
                              ?.textInitialValues_2[subIndex]
                  }
                />
              ) : subItem == "positionContent" ? (
                <EditorAlignment
                  modalId={`${activeDesignSection}-position-modal`}
                  defaultValue={
                    navItems[activeSection].subItems[activeSubitem]
                      ?.contentPositionInitialValues[subIndex]
                  }
                  onChange={(value) => {
                    navItems[activeSection].subItems[
                      activeSubitem
                    ]?.contentPositionOnChange[subIndex](value);
                  }}
                />
              ) : subItem == "radius" ? (
                <EditorPercentageInput
                  label={t("Border Radius")}
                  percentage={
                    activeDesignSection === "layout"
                      ? navItems[activeSection].subItems[activeSubitem]
                          ?.layoutInitialValues[subIndex]
                      : navItems[activeSection].subItems[activeSubitem]
                          ?.contentPositionInitialValues[subIndex]
                  }
                  handlePercentageChange={
                    activeDesignSection === "layout"
                      ? (color) => {
                          navItems[activeSection].subItems[
                            activeSubitem
                          ]?.layoutOnChange[subIndex](color);
                        }
                      : navItems[activeSection].subItems[activeSubitem]
                          ?.contentPositionOnChange[subIndex]
                  }
                />
              ) : subItem == "font" ? (
                <EditorSelect
                  label={t("Font")}
                  defaultValue={
                    activeDesignSection === "text"
                      ? navItems[activeSection].subItems[activeSubitem]
                          ?.textInitialValues[subIndex]
                      : navItems[activeSection].subItems[activeSubitem]
                          ?.textInitialValues_2[subIndex]
                  }
                  handleChange={(value) => {
                    activeDesignSection === "text"
                      ? navItems[activeSection].subItems[
                          activeSubitem
                        ]?.textOnChange[subIndex](value)
                      : navItems[activeSection].subItems[
                          activeSubitem
                        ]?.textOnChange_2[subIndex](value);
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
                  defaultValue={t("Stack")}
                  handleChange={(value) => dispatch(setHeaderPosition(value))}
                  options={[
                    {
                      value: "stack",
                      text: t("Stack"),
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
                  defaultValue={
                    activeDesignSection === "text"
                      ? navItems[activeSection].subItems[activeSubitem]
                          ?.textInitialValues[subIndex]
                      : navItems[activeSection].subItems[activeSubitem]
                          ?.textInitialValues_2[subIndex]
                  }
                  handleChange={(value) => {
                    activeDesignSection === "text"
                      ? navItems[activeSection].subItems[
                          activeSubitem
                        ]?.textOnChange[subIndex](value)
                      : navItems[activeSection].subItems[
                          activeSubitem
                        ]?.textOnChange_2[subIndex](value);
                  }}
                  options={[
                    {
                      value: "thin",
                      text: t("Thin"),
                    },
                    {
                      value: "extralight",
                      text: t("Extra Light"),
                    },
                    {
                      value: "light",
                      text: t("Light"),
                    },
                    {
                      value: "normal",
                      text: t("Normal"),
                    },
                    {
                      value: "medium",
                      text: t("Medium"),
                    },
                    {
                      value: "semibold",
                      text: t("Semibold"),
                    },
                    {
                      value: "bold",
                      text: t("Bold"),
                    },
                  ]}
                />
              ) : subItem == "size" ? (
                <EditorSizeSelect
                  label={t("Size")}
                  defaultValue={
                    activeDesignSection === "text"
                      ? navItems[activeSection].subItems[activeSubitem]
                          ?.textInitialValues[subIndex]
                      : navItems[activeSection].subItems[activeSubitem]
                          ?.textInitialValues_2[subIndex]
                  }
                  handleChange={(value) => {
                    activeDesignSection === "text"
                      ? navItems[activeSection].subItems[
                          activeSubitem
                        ]?.textOnChange[subIndex](value)
                      : navItems[activeSection].subItems[
                          activeSubitem
                        ]?.textOnChange_2[subIndex](value);
                  }}
                />
              ) : subItem == "linkTo" ? (
                <EditorLink
                  label={t("Link")}
                  handleChange={(value) => dispatch(setHeaderPosition(value))}
                />
              ) : subItem == "positionLayoutGrid" ? (
                <EditorPosition
                  modalId={`${activeDesignSection}-position`}
                  defaultValue={
                    navItems[activeSection].subItems[activeSubitem]
                      ?.layoutInitialValues[subIndex]
                  }
                  onChange={(value) => {
                    navItems[activeSection].subItems[
                      activeSubitem
                    ]?.layoutOnChange[subIndex](value);
                  }}
                />
              ) : null}
            </div>
          ))}
        </div>
      )}
    </div>
  );
};
