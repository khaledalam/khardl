import React, { useState } from "react";
import ImgBurger from "../../../../assets/burger.png";
import { useTranslation } from "react-i18next";
import { useSelector } from "react-redux";
import GreenDot from "../../../../assets/greenDot.png";

const CategoryItem = ({
  active,
  imgSrc,
  alt,
  name,
  onClick,
  hoverColor,
  textColor,
  textAlign,
  fontWeight,
  shape,
  isGrid,
  fontSize,
  textFontFamily,
  valuekey,
  currentSubItem,
  isSide,
}) => {
  const [isHover, setIsHover] = useState(false);
  const { t } = useTranslation();

  const { branches, menu_category_position, menu_category_item_layout } =
    useSelector((state) => state.restuarantEditorStyle);

  if (!branches) return;

  let selectedBranch = branches?.filter(
    (b) => b?.id == localStorage.getItem("selected_branch_id")
  )[0];

  const handleMouseEnter = () => {
    setIsHover((prev) => !prev);
  };

  const handleMouseLeave = () => {
    setIsHover((prev) => !prev);
  };

  return (
    <div
      onMouseEnter={handleMouseEnter}
      onMouseLeave={handleMouseLeave}
      onClick={onClick}
      key={valuekey}
      className={`flex w-full mx-3 justify-center cursor-pointer hover:scale-110 transform transition-transform duration-300 ease-in-out ${
        menu_category_item_layout != "center" ? "flex-row" : "flex-col"
      } items-center ${
        menu_category_item_layout == "sides"
          ? "max-w-full gap-[4px]"
          : "max-w-full gap-[16px]"
      }`}
    >
      {menu_category_item_layout != "hide" && (
        <div
          style={{
            backgroundColor: isHover
              ? hoverColor
              : active
              ? hoverColor
              : "#F5F5F5",
          }}
          className={` ${
            menu_category_position == "center"
              ? "min-w-[60px] max-w-[60px] w-[60px] h-[60px]"
              : "min-w-[40px] max-w-[40px] w-[40px] h-[40px]"
          } ${
            shape === "sharp" ? "" : "rounded-full"
          }  flex items-center justify-center transition-all duration-300  bg-neutral-100  `}
        >
          <div
            className={`w-full h-full flex items-center ${
              shape === "sharp" ? "" : "rounded-full"
            } justify-center relative`}
          >
            <img
              src={imgSrc ? imgSrc : ImgBurger}
              alt={alt}
              className={`w-full h-full object-cover ${
                shape === "sharp" ? "" : "rounded-full"
              } `}
            />
            <img
              src={GreenDot}
              alt="green dot"
              className={`${
                currentSubItem == "Category"
                  ? "absolute w-[5px] h-[5px] right-0 top-0 z-[30]"
                  : "hidden"
              }`}
            />
          </div>
        </div>
      )}
      <h3
        style={{
          color: textColor,
          fontFamily: textFontFamily,
          fontSize:
            fontSize && typeof fontSize == "string" && fontSize.includes("px")
              ? Number(fontSize.slice(0, 2)) - 2
              : typeof fontSize == "number"
              ? fontSize - 2
              : 14,
        }}
        className={`max-w-full h-full break-words text-center ${
          textAlign === t("Center")
            ? "text-center"
            : textAlign === t("Left")
            ? "text-left"
            : textAlign === t("Right")
            ? "text-right"
            : ""
        } font-${fontWeight}`}
      >
        {name}
      </h3>
    </div>
  );
};

export default CategoryItem;
