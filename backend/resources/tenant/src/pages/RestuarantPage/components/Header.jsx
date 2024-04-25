import React, { useContext, useEffect, useState } from "react";
import { useNavigate } from "react-router-dom";
import { useDispatch, useSelector } from "react-redux";
import HeaderSidebar from "../../../assets/headerSidebar.svg";
import HeaderHomeIcon from "../../../assets/headerHomeIcon.svg";
import HedaerIconCart from "../../../assets/headerIconCart.svg";

import { SetSideBar } from "../../../redux/NewEditor/restuarantEditorSlice";

const Header = ({ restaurantStyle, categories }) => {
    const navigate = useNavigate();
    const dispatch = useDispatch();

    const cartItemsCount = useSelector(
        (state) => state.categoryAPI.cartItemsCount
    );

    const handleGotoCart = () => {
        navigate("/cart");
    };

    const {
        side_menu_position,
        order_cart_position,
        order_cart_color,
        order_cart_radius,
        home_position,
        home_color,
        home_radius,
        isSideBarOpen,
    } = restaurantStyle;

    return (
        <div
            style={{
                backgroundColor: restaurantStyle?.header_color,
                borderRadius: `${restaurantStyle?.header_radius}px`,
            }}
            className={`w-full h-[56px] z-10 grid grid-cols-3 px-[16px] md:mt-[8px]`}
        >
            <div
                className={`flex cursor-pointer  justify-center items-center w-[30px] h-[30px] rounded-full self-center shadow-md ${
                    side_menu_position == "left"
                        ? "justify-self-start"
                        : side_menu_position == "right"
                        ? "justify-self-end"
                        : "justify-self-center"
                }`}
                onClick={() => dispatch(SetSideBar(!isSideBarOpen))}
            >
                <div
                    style={{ fontWeight: restaurantStyle?.text_fontWeight }}
                    className={`flex items-center gap-3 relative`}
                >
                    <img src={HeaderSidebar} alt="sidebar icon" />
                </div>
            </div>

            <div
                onClick={
                    categories && categories.length > 0
                        ? handleGotoCart
                        : () => {}
                }
                style={{
                    backgroundColor: order_cart_color
                        ? order_cart_color
                        : "#F3F3F3",
                    borderRadius: order_cart_radius
                        ? `${order_cart_radius}px`
                        : "50px",
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
            </div>

            <div
                style={{
                    backgroundColor: home_color ? home_color : "#F3F3F3",
                    borderRadius: home_radius ? `${home_radius}px` : "50px",
                }}
                onClick={() => {
                    navigate("/");
                }}
                className={`pt-[6px] pb-[9px] pr-[7px] pl-[8px] bg-[#F3F3F3] rounded-full relative self-center shadow-md ${
                    home_position == "left"
                        ? "justify-self-start"
                        : home_position == "right"
                        ? "justify-self-end"
                        : "justify-self-center"
                }`}
            >
                <img src={HeaderHomeIcon} alt={"home icon"} className="" />
            </div>
        </div>
    );
};

export default Header;
