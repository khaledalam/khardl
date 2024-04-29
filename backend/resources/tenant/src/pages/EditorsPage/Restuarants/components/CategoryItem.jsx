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

  const { branches, menu_category_position } = useSelector(
    (state) => state.restuarantEditorStyle,
  );

  if (!branches) return;

  let selectedBranch = branches?.filter(
    (b) => b?.id == localStorage.getItem("selected_branch_id"),
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
      className={`flex w-full cursor-pointer hover:scale-110 transform transition-transform duration-300 ease-in-out ${
        isGrid ? "flex-row" : "flex-col"
      } gap-[16px] items-center ${isSide ? "w-full" : "max-w-[60px]"}`}
    >
      {selectedBranch?.display_category_icon == "1" && (
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
              ? "w-[60px] h-[60px]"
              : "w-[40px] h-[40px]"
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
          fontWeight,
          fontSize:
            fontSize && typeof fontSize == "string" && fontSize.includes("px")
              ? Number(fontSize.slice(0, 2)) - 2
              : typeof fontSize == "number"
                ? fontSize - 2
                : 14,
        }}
        className={`font-normal w-max ${
          textAlign === t("Center")
            ? "text-center"
            : textAlign === t("Left")
              ? "text-left"
              : textAlign === t("Right")
                ? "text-right"
                : ""
        }`}
      >
        {name}
      </h3>
    </div>
  );
};

export default CategoryItem;
