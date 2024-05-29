import React from "react";
import { useDispatch, useSelector } from "react-redux";
import HeaderSidebar from "../../../assets/headerSidebar.svg";
import HedaerIconCart from "../../../assets/headerIconCart.svg";
import Skeleton from "react-loading-skeleton";
import { useTranslation } from "react-i18next";
import { SetSideBar } from "../../../redux/NewEditor/restuarantEditorSlice";

const Header = React.memo(({ restaurantStyle, categories, handleGotoCart }) => {
  const dispatch = useDispatch();
  const cartItemsCount = useSelector(
    (state) => state.categoryAPI.cartItemsCount
  );
  const { t } = useTranslation();

  const {
    side_menu_position,
    order_cart_position,
    order_cart_color,
    order_cart_radius,
    isSideBarOpen,
    logo_alignment,
    logo_border_radius,
    logo,
  } = restaurantStyle;

  const handleSidebarClick = () => {
    dispatch(SetSideBar(!isSideBarOpen));
  };

  const handleCartClick = () => {
    if (categories && categories.length > 0) {
      handleGotoCart();
    }
  };

  return (
    <div
      style={{
        backgroundColor: restaurantStyle?.header_color,
        borderRadius: `${restaurantStyle?.header_radius}px`,
      }}
      className="w-full h-[56px] z-10 grid grid-cols-3 px-[16px] md:mt-[8px]"
    >
      <div
        className={`flex cursor-pointer justify-center items-center w-[30px] h-[30px] rounded-full self-center shadow-md ${
          side_menu_position === "left"
            ? "justify-self-start"
            : side_menu_position === "right"
            ? "justify-self-end"
            : "justify-self-center"
        }`}
        onClick={handleSidebarClick}
      >
        <img
          src={HeaderSidebar}
          alt="sidebar icon"
          className="flex items-center gap-3 relative"
        />
      </div>

      <div
        onClick={handleCartClick}
        style={{
          backgroundColor: order_cart_color || "#F3F3F3",
          borderRadius: order_cart_radius ? `${order_cart_radius}px` : "50px",
        }}
        className={`w-[30px] h-[30px] pl-[8px] pr-[7px] pb-[9px] pt-[6px] relative flex items-center justify-center cursor-pointer self-center shadow-md ${
          order_cart_position === "left"
            ? "justify-self-start"
            : order_cart_position === "right"
            ? "justify-self-end"
            : "justify-self-center"
        }`}
      >
        <img src={HedaerIconCart} alt="cart" />
        {cartItemsCount > 0 && (
          <div className="absolute top-0 right-0">
            <div className="w-[10px] h-[10px] rounded-full bg-[#FF3D00] flex items-center justify-center"></div>
          </div>
        )}
      </div>

      {logo ? (
        <div
          className={`w-[30px] h-[30px] relative rounded-full flex items-center justify-center cursor-pointer self-center shadow-md ${
            logo_alignment === "left"
              ? "justify-self-start"
              : logo_alignment === "right"
              ? "justify-self-end"
              : "justify-self-center"
          }`}
          style={{
            borderRadius: logo_border_radius
              ? `${logo_border_radius}px`
              : "50px",
          }}
        >
          <img
            src={logo}
            className="w-[30px] h-[30px] rounded-full shadow-md"
            style={{
              borderRadius: logo_border_radius
                ? `${logo_border_radius}px`
                : "50px",
            }}
          />
        </div>
      ) : (
        <div
          className={`w-[30px] h-[30px] relative -top-[2px] rounded-full shadow-md self-center ${
            logo_alignment === "left"
              ? "justify-self-start"
              : logo_alignment === "right"
              ? "justify-self-end"
              : "justify-self-center"
          }`}
        >
          <Skeleton className="w-full h-full" />
        </div>
      )}
    </div>
  );
});

export default Header;
