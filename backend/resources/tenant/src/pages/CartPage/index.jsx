import React, { Fragment, useCallback, useEffect, useState } from "react";
import { useTranslation } from "react-i18next";
import AxiosInstance from "../../axios/axios";
import { changeRestuarantEditorStyle } from "../../redux/NewEditor/restuarantEditorSlice";
import { useDispatch, useSelector } from "react-redux";
import {
    setCartItemsData,
    getCartItemsCount,
} from "../../redux/NewEditor/categoryAPISlice";
import CartItem from "./components/CartItem";
import { RadioButton } from "primereact/radiobutton";
import pmcc from "../../assets/pmcc.png";
import pmcod from "../../assets/pmcod.png";

import "./index.scss";

const CartPage = () => {
    const dispatch = useDispatch();
    const cartItemsData = useSelector(
        (state) => state.categoryAPI.cartItemsData,
    );
    const [paymentMethod, setPaymentMethod] = useState("pm-cod");

    useEffect(() => {
        fetchResStyleData().then(() => null);
        fetchCartData().then(() => null);
    }, []);

    const fetchResStyleData = async () => {
        try {
            AxiosInstance.get(`restaurant-style`).then((response) =>
                dispatch(changeRestuarantEditorStyle(response.data?.data)),
            );
        } catch (error) {
            // toast.error(`${t('Failed to send verification code')}`)
            console.log(error);
        }
    };

    const fetchCartData = async () => {
        try {
            const cartResponse = await AxiosInstance.get(`carts`);

            console.log("cart >>>", cartResponse.data);
            if (cartResponse.data) {
                if (
                    cartResponse.data.data.discount &&
                    cartResponse.data.data.coupon.id
                ) {
                    // setCartCoupon(cartResponse.data.data.discount);
                    // setAppliedCoupon(cartResponse.data.data.coupon);
                }
                console.log(cartResponse.data?.data.items);
                dispatch(setCartItemsData(cartResponse.data?.data.items));
                dispatch(getCartItemsCount(cartResponse.data?.data.count));
                // setPaymentMethodsData(cartResponse.data?.data?.payment_methods);
                // setDeliveryTypesData(cartResponse.data?.data?.delivery_types);
                // setAddress(cartResponse.data?.data?.address ?? t("N/A"));
                // setTap(cartResponse.data?.data?.tap_information);
            }
        } catch (error) {
            // toast.error(`${t('Failed to send verification code')}`)
            console.log(error);
        } finally {
        }
    };

    const { t } = useTranslation();
    return (
        <div className="p-12">
            <h1 className="font-bold text-xl">{t("Your Cart")}</h1>
            <div className="grid grid-cols-12 gap-x-6 pt-8">
                <div className="col-span-7">
                    <div className="flex flex-col gap-y-6">
                        {cartItemsData &&
                            cartItemsData.length > 0 &&
                            cartItemsData.map((item, index) => {
                                return (
                                    <CartItem
                                        key={"cartitem" + index}
                                        cartitem={item}
                                    />
                                );
                            })}
                    </div>
                </div>
                <div className="col-span-5 paymentDetails p-4">
                    <h2>{t("Review Order Details")}</h2>
                    <div className="cartDetailSection h-24 mt-8"></div>
                    <div className="cartDetailSection h-36xw mt-8">
                        <h3>{t("Select Payment Method")}</h3>
                        <div
                            key="pm-cc"
                            className="flex align-items-center mt-4"
                        >
                            <RadioButton
                                inputId="pm-cc"
                                name="category"
                                value="pm-cc"
                                onChange={(e) => setPaymentMethod("pm-cc")}
                                checked={paymentMethod === "pm-cc"}
                            />
                            <div htmlFor="pm-cc" className="flex mx-2">
                                <img
                                    src={pmcc}
                                    alt=""
                                    width={25}
                                    height={25}
                                    className="mx-2"
                                ></img>
                                {t("Credit Card")}
                            </div>
                        </div>
                        <div
                            key="pm-cod"
                            className="flex align-items-center mt-4"
                        >
                            <RadioButton
                                inputId="pm-cod"
                                name="category"
                                value="pm-cod"
                                onChange={(e) => setPaymentMethod("pm-cod")}
                                checked={paymentMethod === "pm-cod"}
                            />
                            <div htmlFor="pm-cod" className="flex mx-2">
                                <img
                                    src={pmcod}
                                    alt=""
                                    width={25}
                                    height={25}
                                    className="mx-2"
                                ></img>
                                {t("Cash on Delivery")}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default CartPage;
