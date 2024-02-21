import React, { useCallback, useEffect, useState } from "react";
import { BiMinusCircle } from "react-icons/bi";
import { IoAddCircleOutline, IoClose } from "react-icons/io5";
import Feedback from "./Feedback";
import AxiosInstance from "../../../axios/axios";
import { useDispatch } from "react-redux";
import { setCartItemsData } from "../../../redux/NewEditor/categoryAPISlice";
import { toast } from "react-toastify";
import { useTranslation } from "react-i18next";

const CartItem = ({ cartItem, cartItems, language, isMobile, styles, fetchCartData }) => {
  const [feedback, setFeedback] = useState(
    cartItem.notes !== null ? cartItem.notes : ""
  );
  const [qtyCount, setQtyCount] = useState(cartItem.quantity);
  const [loading, setLoading] = useState(false);

  const dispatch = useDispatch();
  const { t } = useTranslation();


  const checkbox_options_names =
    cartItem && cartItem?.checkbox_options !== null
      ? cartItem?.checkbox_options
          .map((option, key) => {
            const namesArray =
              language === "en"
                ? Object.values(option?.en)
                : Object.values(option?.ar);
            return namesArray;
          })[0][0]
          .map((option, idx) => option)
      : [];
  const selection_options_names =
    cartItem && cartItem?.selection_options !== null
      ? cartItem?.selection_options
          .map((option, key) => {
            
            const namesArray =
              language === "en"
                ? Object.values(option?.en)
                : Object.values(option?.ar);
            return namesArray;
          })[0]
          .map((option, idx) => ({ name: option[0] }))
      : [];
      const selection_dropdown_names =
      cartItem && cartItem?.dropdown_options !== null
        ? cartItem?.dropdown_options
            .map((option, key) => {
              console.log(option, 'oooooooooooooooooo',Object.values(option?.en))

              const namesArray =
                language === "en"
                  ? Object.values(option?.en)
                  : Object.values(option?.ar);
              return namesArray;
            })[0]
            .map((option, idx) => ({ name: option }))
        : [];
  console.log("checkbox_options name", checkbox_options_names);
  console.log("selection_options name", selection_options_names);
  console.log("selection_dropdown name", selection_dropdown_names);

  const handleQuantityChange = async newQuantity => {
    if (loading) return;
    setLoading(true);
    try {

      await AxiosInstance.put(`/carts/${cartItem.id}`, {
        quantity: newQuantity
      })
        .then((e) => {
          // toast.success(`${t("Item quantity updated")}`)
          console.log("successfully", e);
        })
        .finally(async () => {
          setLoading(false);
          await fetchCartData().then((r) => null);
        });
    } catch (error) {
      console.log("error: ", error);
    }
  };
  const incrementQty = () => {
    const newQuantity = qtyCount + 1;
  setQtyCount(newQuantity);
    handleQuantityChange(newQuantity).then(r => null)
};

const decrementQty = () => {
  if (qtyCount > 1) {
      const newQuantity = qtyCount - 1;
      setQtyCount(newQuantity);
      handleQuantityChange(newQuantity).then(r => null)
  }
};


  // useEffect(() => {
  //   handleQuantityChange().then(r => null);
  // }, [qtyCount]);



  const handleRemoveItem = async (cartItemId) => {
    try {
      const response = await AxiosInstance.delete(`/carts/` + cartItemId, {});
      if (response?.data) {
        const updatedCart = cartItems.filter((item) => item.id !== cartItemId);
        dispatch(setCartItemsData(updatedCart));
        toast.success(`${t("Item removed from cart")}`);
      }
    } catch (error) {
      console.log("err removing item from cart", error);
    }
  };

  return (
    <div className="h-[200px] laptopXL:h-[220px] w-full flex items-center gap-4 p-2  lg:p-5 border-b border-b-[var(--primary)]">
      <div className="w-[28%] lg:w-[20%] h-full flex flex-col xl:flex-row items-start justify-center">
        <div className="flex h-full flex-col justify-between">
          <div className="w-[90px] h-[90px] lg:w-[120px] laptopXL:w-[140px] lg:h-[120px] laptopXL:h-[140px] p-2 rounded-full bg-neutral-100">
            <img
              src={cartItem?.item?.photo}
              alt=""
              className="w-full h-full object-cover rounded-full"
              />
          </div>
          <div className="flex items-center justify-between w-[90px] lg:w-[120px] cursor-pointer laptopXL:w-[150px]">
            <BiMinusCircle size={25} color={loading ? "gray" : "black"} onClick={e => !loading && decrementQty()} />
            <span>{cartItem.quantity}</span>
            <IoAddCircleOutline size={25} color={loading ? "gray" : "black"} onClick={e => !loading && incrementQty()} />
          </div>
        </div>
      </div>
      <div className="w-[72%] lg:w-[80%] flex flex-col h-full  justify-between relative">
        <h3 className="text-lg">
          {language === "en" ? cartItem.item.name.en : cartItem.item.name.ar}
          {(checkbox_options_names.length > 0 ||
            selection_options_names.length > 0 || selection_dropdown_names.length > 0) && (
            <span>
              <span className="mx-4">+</span>
              <span className="text-[15px]">
                ( Extras:{"  "}
                {checkbox_options_names.length > 0 &&
                  checkbox_options_names.map((option, i) => (
                    <span className="font-normal" key={i}>
                      <span>{option[0]}</span>
                      {i < checkbox_options_names.length - 1 && (
                        <span className="mx-3">+</span>
                      )}
                    </span>
                  ))}
                {selection_options_names.length > 0 &&
                  checkbox_options_names.length > 0 && (
                    <span className="mx-3">+</span>
                  )}
                {selection_options_names.length > 0 &&
                  selection_options_names.map((option, i) => (
                    <span key={i} className="font-normal">
                      <span>{option.name}</span>
                      {i > 0 && i < checkbox_options_names.length - 1 && (
                        <span className="mx-3">+</span>
                      )}
                    </span>
                  ))}{" "}
                   {selection_options_names.length > 0 &&
                  checkbox_options_names.length > 0 && selection_dropdown_names.length > 0 &&  (
                    <span className="mx-3">+</span>
                  )}
                {selection_dropdown_names.length > 0 &&
                  selection_dropdown_names.map((option, i) => (
                    <span key={i} className="font-normal">
                      <span>{option.name}</span>
                      {i > 0 && i < checkbox_options_names.length - 1 && (
                        <span className="mx-3">+</span>
                      )}
                    </span>
                  ))}{" "}
                )
              </span>
            </span>
          )}
        </h3>
        <p className="">
          {t("SAR")} {cartItem.price}{" "}
          {cartItem.options_price > 0 &&
            ` + ${cartItem.options_price} ${t("SAR")}  ${t("Options")}`}
        </p>
        <div className="flex items-center justify-between">
          <div className="w-full lg:w-5/6">
            <Feedback
              value={feedback}
              placeholder={t("Item notes : e.g. Please make the meat medium cook")}
              onChange={(e) => setFeedback(e.target.value)}
            />
          </div>
          <div
            style={{
              backgroundColor: styles?.categoryDetail_cart_color,
            }}
            onClick={() => handleRemoveItem(cartItem.id)}
            className={` ${
              styles?.categoryDetail_cart_color ? "" : "bg-[var(--primary)]"
            } ${
              isMobile ? "absolute top-[2rem] right-[.6rem]" : "relative"
            } relative flex items-center justify-center cursor-pointer rounded-lg w-[40px] h-[35px]`}
          >
            <IoClose size={25} className="cursor-pointer" />
          </div>
        </div>
        <h3 className="font-bold">
        {t("Total")}:{t("SAR")}{" "}
        {/* {cartItems? parseFloat(cartItems.reduce((total, item) =>total + (item.price + item.options_price) * item.quantity,0)): 0} */}
          {cartItem.price * cartItem.quantity + cartItem.options_price}
        </h3>
      </div>
    </div>
  );
};

export default CartItem;
