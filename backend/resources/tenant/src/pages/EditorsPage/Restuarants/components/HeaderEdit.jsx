import React, {
  useContext,
  useEffect,
  useReducer,
  useRef,
  useState,
} from "react";
import cartHeaderImg from "../../../../assets/cartBoldIcon.svg";
import { useNavigate } from "react-router-dom";
import { useDispatch, useSelector } from "react-redux";
import { RiMenuFoldFill } from "react-icons/ri";
import { IoCloseOutline } from "react-icons/io5";
import {
  logoUpload,
  SetSideBar,
} from "../../../../redux/NewEditor/restuarantEditorSlice";
import ImgPlaceholder from "../../../../assets/imgPlaceholder.png";
import HeaderSidebar from "../../../../assets/headerSidebar.svg";
import HeaderHomeIcon from "../../../../assets/headerHomeIcon.svg";
import HedaerIconCart from "../../../../assets/headerIconCart.svg";
import GreenDot from "../../../../assets/greenDot.png";

const HeaderEdit = ({
  restaurantStyle,
  toggleSidebarCollapse,
  isHighlighted,
  currentSubItem,
  handleLogoUpload,
}) => {
  const cartItemsCount = useSelector(
    (state) => state.categoryAPI.cartItemsCount
  );

  const fileInputRef = useRef();
  const {
    logo,
    logo_alignment,
    side_menu_position,
    order_cart_position,
    order_cart_color,
    order_cart_radius,
    logo_border_radius,
    logoUpload,
  } = restaurantStyle;

  return (
    <div
      style={{
        backgroundColor: restaurantStyle?.header_color,
        borderRadius: `${restaurantStyle?.header_radius}px`,
      }}
      className={`w-full h-[56px] z-10 grid grid-cols-3 px-[16px] md:mt-[8px] ${
        isHighlighted ? "shadow-inner border-[#C0D123] border-[2px]" : ""
      }`}
    >
      <div
        className={`flex justify-center items-center w-[30px] h-[30px] rounded-full self-center shadow-md ${
          side_menu_position == "left"
            ? "justify-self-start"
            : side_menu_position == "right"
            ? "justify-self-end"
            : "justify-self-center"
        }`}
      >
        <div
          // onClick={() => dispatch(SetSideBar(!isSideBarOpen))}
          style={{ fontWeight: restaurantStyle?.text_fontWeight }}
          className={`flex items-center gap-3 cursor-pointer relative`}
        >
          <img src={HeaderSidebar} alt="sidebar icon" />
          <img
            src={GreenDot}
            alt="green dot"
            className={`${
              currentSubItem == "Side Menu"
                ? "absolute w-[5px] h-[5px] right-[-4px] top-[-6px]"
                : "hidden"
            }`}
          />
        </div>
      </div>

      <div
        // onClick={
        //     categories && categories.length > 0
        //         ? handleGotoCart
        //         : () => {}
        // }
        style={{
          backgroundColor: order_cart_color ? order_cart_color : "#F3F3F3",
          borderRadius: order_cart_radius ? `${order_cart_radius}px` : "50px",
        }}
        className={`w-[30px] h-[30px] pl-[8px] pr-[7px] pb-[9px] pt-[6px] relative flex items-center justify-center cursor-pointer self-center shadow-md ${
          order_cart_position == "left"
            ? "justify-self-start"
            : order_cart_position == "right"
            ? "justify-self-end"
            : "justify-self-center"
        }`}
      >
        <img src={HedaerIconCart} alt={"cart"} className="" />
        {cartItemsCount > 0 && (
          <div className="absolute top-0 right-0">
            <div className="w-[10px] h-[10px] rounded-full bg-[#FF3D00] flex items-center justify-center"></div>
          </div>
        )}
        <img
          src={GreenDot}
          alt="green dot"
          className={`${
            currentSubItem == "Order Cart"
              ? "absolute w-[5px] h-[5px] right-[-1px] top-[-3px]"
              : "hidden"
          }`}
        />
      </div>
      <div
        style={{
          borderRadius: logo_border_radius ? `${logo_border_radius}px` : "50px",
        }}
        className={`w-[30px] h-[30px] rounded-full relative self-center cursor-pointer shadow-md ${
          logo_alignment == "left"
            ? "justify-self-start"
            : logo_alignment == "right"
            ? "justify-self-end"
            : "justify-self-center"
        }`}
      >
        <div className="overflow-hidden relative">
          <img
            src={logoUpload || logo}
            alt={"logo icon"}
            className="w-[30px] h-[30px] shadow-md"
            style={{
              borderRadius: logo_border_radius
                ? `${logo_border_radius}px`
                : "50px",
            }}
          />
          <input
            type="file"
            name="logo"
            id="logo"
            className="opacity-0 absolute top-0 object-cover cursor-pointer"
            ref={fileInputRef}
            accept="image/*"
            onChange={(event) => handleLogoUpload(event, fileInputRef)}
          />
        </div>
        <img
          src={GreenDot}
          alt="green dot"
          className={`${
            currentSubItem == "Logo"
              ? "absolute w-[5px] h-[5px] right-[-1px] top-[-3px]"
              : "hidden"
          }`}
        />
      </div>
    </div>
  );
};

export default HeaderEdit;
