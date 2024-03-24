import React, { Fragment, useCallback, useEffect, useState } from "react";
import { useTranslation } from "react-i18next";
import AxiosInstance from "../../axios/axios";
import { changeRestuarantEditorStyle } from "../../redux/NewEditor/restuarantEditorSlice";
import { InputTextarea } from "primereact/inputtextarea";
import { useDispatch, useSelector } from "react-redux";
import {
    setCartItemsData,
    getCartItemsCount,
} from "../../redux/NewEditor/categoryAPISlice";
import CartItem from "./components/CartItem";
import pmcc from "../../assets/pmcc.png";
import pmcod from "../../assets/pmcod.png";
import dtpickup from "../../assets/dtpickup.png";
import dtdelivery from "../../assets/dtdelivery.png";

import "./index.scss";
import CartDetailSection from "./components/CartDetailSection";
import CartAddress from "./components/CartAddress";
import { Divider } from "primereact/divider";
import { Button } from "primereact/button";

const CartPage = () => {
    const { t } = useTranslation();

    const dispatch = useDispatch();

    const restaurantStyle = useSelector((state) => {
        return state.restuarantEditorStyle;
    });

    const cartItemsData = useSelector(
        (state) => state.categoryAPI.cartItemsData,
    );
    const [paymentMethod, setPaymentMethod] = useState("pm-cod");
    const [deliveryType, setDeliveryType] = useState("dt-delivery");
    const [deliveryAddress, setDeliveryAddress] = useState(0);
    const [userAddress, setUserAddress] = useState(null);
    const [orderNotes, setOrderNotes] = useState("");
    const [cart, setCart] = useState(null);

    useEffect(() => {
        fetchResStyleData().then(() => null);
        fetchCartData().then(() => null);
        fetchProfileData().then(() => null);
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
            if (cartResponse.data) {
                if (
                    cartResponse.data.data.discount &&
                    cartResponse.data.data.coupon.id
                ) {
                    // setCartCoupon(cartResponse.data.data.discount);
                    // setAppliedCoupon(cartResponse.data.data.coupon);
                }
                dispatch(setCartItemsData(cartResponse.data?.data.items));
                dispatch(getCartItemsCount(cartResponse.data?.data.count));
                setCart(cartResponse.data?.data);
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

    const fetchProfileData = async () => {
        try {
            const profileResponse = await AxiosInstance.get(`user`);
            console.log("profileResponse >>>", profileResponse.data);
            if (profileResponse.data.data.address) {
                let userAddress = profileResponse.data.data.address;
                setUserAddress(userAddress);
                if (!userAddress.addressValue) {
                    setDeliveryAddress(1);
                }
            }
        } catch (error) {
            console.log(error);
        } finally {
            //setIsLoading(false);
        }
    };

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
                                        onReload={() => fetchCartData()}
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
                        <CartDetailSection
                            name="pm-cc"
                            onChange={(e) => setPaymentMethod("pm-cc")}
                            isChecked={paymentMethod === "pm-cc"}
                            img={pmcc}
                            displayName="Credit Card"
                        />
                        <CartDetailSection
                            name="pm-cod"
                            onChange={(e) => setPaymentMethod("pm-cod")}
                            isChecked={paymentMethod === "pm-cod"}
                            img={pmcod}
                            displayName="Cash on Delivery"
                        />
                    </div>
                    <div className="cartDetailSection h-36xw mt-8">
                        <h3>{t("Select Delivery Type")}</h3>
                        <CartDetailSection
                            name="dt-delivery"
                            onChange={(e) => {
                                fetchProfileData();
                                setDeliveryType("dt-delivery");
                            }}
                            isChecked={deliveryType === "dt-delivery"}
                            img={dtdelivery}
                            displayName="delivery"
                        />

                        <CartDetailSection
                            name="dt-pickup"
                            onChange={(e) => setDeliveryType("dt-pickup")}
                            isChecked={deliveryType === "dt-pickup"}
                            img={dtpickup}
                            displayName="pickup"
                        />
                    </div>
                    <div className="mt-8">
                        <CartAddress
                            userAddress={userAddress}
                            selectedDeliveryAddress={deliveryAddress}
                            onChange={(type) => setDeliveryAddress(type)}
                        />
                    </div>
                    <div className="cartDetailSection h-32 mt-8">
                        <h3 className="mb-2">{t("Order Notes")}</h3>
                        <InputTextarea
                            value={orderNotes}
                            onChange={(e) => setOrderNotes(e.target.value)}
                            rows={5}
                            cols={30}
                            placeholder={t("Say something nice...")}
                        />
                    </div>
                    <div className="cartDetailSection h-56 mt-8">
                        <h3 className="mb-2">{t("Payment Summary")}</h3>
                        <div className="flex justify-between">
                            <div>{t("Total Payment")}</div>
                            <div>{Number(cart?.total) + ` ${t("SAR")}`}</div>
                        </div>
                        <div className="flex justify-between mt-2">
                            <div>{t("Delivery fee")}</div>
                            <div>{cart?.delivery_fee + ` ${t("SAR")}`}</div>
                        </div>
                        <div className="flex justify-between mt-2">
                            <div>{t("Coupon Discount")}</div>
                            <div></div>
                        </div>
                        <Divider />
                        <div className="flex justify-between mt-1">
                            <div>{t("Total Payment")}</div>
                            <div>
                                {`${Number(cart?.total + cart?.delivery_fee)} ${t("SAR")}`}
                            </div>
                        </div>
                    </div>

                    <Button
                        label={t("Place Order")}
                        className="w-full placeOrderBtn"
                    />
                </div>
            </div>
        </div>
    );
};

export default CartPage;
