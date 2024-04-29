import React, { useEffect, useState } from "react";
import CartItem from "./CartItem";
import { useSelector } from "react-redux";
import {
  setCartItemsData,
  getCartItemsCount,
} from "../../../redux/NewEditor/categoryAPISlice";
import AxiosInstance from "../../../axios/axios";
import { useDispatch } from "react-redux";

const CartSection = ({ cartItems }) => {
  const language = useSelector((state) => state.languageMode.languageMode);
  const restuarantStyle = useSelector((state) => state.restuarantEditorStyle);
  const dispatch = useDispatch();

  const [isMobile, setIsMobile] = useState(false);
  useEffect(() => {
    const isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);

    setIsMobile(isMobile);
  }, []);

  const fetchCartData = async () => {
    try {
      const cartResponse = await AxiosInstance.get(`carts`);
      console.log("cart >>>", cartResponse.data?.data.items);
      if (cartResponse.data) {
        dispatch(setCartItemsData(cartResponse.data?.data.items));
        dispatch(getCartItemsCount(cartResponse.data?.data.count));
      }
    } catch (error) {
      console.log(error);
    }
  };
  return (
    <div
      style={{ borderColor: restuarantStyle?.categoryDetail_cart_color }}
      className={`${
        restuarantStyle?.categoryDetail_cart_color
          ? ""
          : "border-[var(--primary)]"
      } border rounded-lg w-full laptopXL:w-[75%] mx-auto my-5`}
    >
      {cartItems &&
        cartItems.map((cartItem) => (
          <CartItem
            styles={restuarantStyle}
            key={cartItem.item_id}
            cartItem={cartItem}
            cartItems={cartItems}
            language={language}
            isMobile={isMobile}
            fetchCartData={fetchCartData}
          />
        ))}
    </div>
  );
};

export default CartSection;
