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

import CartDetailSection from "./components/CartDetailSection";
import CartAddress from "./components/CartAddress";
import { Divider } from "primereact/divider";
import { Button } from "primereact/button";
import { InputText } from "primereact/inputtext";
import { toast } from "react-toastify";
import { useNavigate } from "react-router-dom";
import NoDataImg from "../../assets/no-data.png";
import ClipLoader from "react-spinners/ClipLoader";

import PaymentCardGoSell from "./components/PaymentCardGoSell";
import { GoSellElements } from "@tap-payments/gosell";
import "./index.scss";
import OrderReviewSummary from "./components/OrderReviewSummary";
import {
    ApplePayButton,
    ThemeMode,
    SupportedNetworks,
    Scope,
    Environment,
    Locale,
    ButtonType,
    Edges
   } from '@tap-payments/apple-pay-button'
const CartPage = () => {
    const { t } = useTranslation();

    let [loading, setLoading] = useState(true);

    const dispatch = useDispatch();

    const navigate = useNavigate();

    const restaurantStyle = useSelector((state) => {
        return state.restuarantEditorStyle;
    });

    const cartItemsData = useSelector(
        (state) => state.categoryAPI.cartItemsData,
    );
    const [tap, setTap] = useState(null);
    console.log(tap);

    const customerAddress = useSelector((state) => state.customerAPI.address);

    const [paymentMethod, setPaymentMethod] = useState("Cash on Delivery");
    const [deliveryType, setDeliveryType] = useState("Delivery");
    const [deliveryAddress, setDeliveryAddress] = useState(0);
    const [userAddress, setUserAddress] = useState(null);
    const [orderNotes, setOrderNotes] = useState("");
    const [coupon, setCoupon] = useState("");
    const [cart, setCart] = useState(null);
    const [user, setUser] = useState(null);

    useEffect(() => {
        setLoading(true);
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
                setTap(cartResponse.data?.data?.tap_information);
            }
        } catch (error) {
            // toast.error(`${t('Failed to send verification code')}`)
            console.log(error);
        } finally {
            setLoading(false);
        }
    };

    const fetchProfileData = async () => {
        try {
            const profileResponse = await AxiosInstance.get(`user`);
            setUser(profileResponse.data.data);
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

    const handlePlaceOrder = async () => {
        let orderAddress = `${customerAddress.lat},${customerAddress.lng}`;
        if (paymentMethod === "Online") {
            GoSellElements.submit();
        } else {
            try {
                try {
                    const cartResponse = await AxiosInstance.post(`/orders`, {
                        payment_method: paymentMethod,
                        delivery_type: deliveryType,
                        notes: orderNotes,
                        couponCode: coupon,
                        address: orderAddress,
                    });
                    if (cartResponse.data) {
                        toast.success(
                            `${t("Order has been created successfully")}`,
                        );
                        navigate(`/dashboard#orders`);
                    }
                } catch (error) {
                    toast.error(error.response.data.message);
                }
            } catch (error) {
                toast.error(error.response.data.message);
                console.log(error);
            }
        }
    };

    const cardPaymentCallbackFunc = async (response) => {

        console.log("here inside callback");


        let orderAddress = `${customerAddress.lat},${customerAddress.lng}`;

        try {
            setLoading(true);
            const redirect = await AxiosInstance.post(
                `/orders/payment/redirect`,
                {
                    payment_method: paymentMethod,
                    delivery_type: deliveryType,
                    notes: orderNotes,
                    couponCode: coupon,
                    address: orderAddress,
                    token_id: response?.id,
                },
            );

            if (redirect.data) {
                console.log("redirect ==>", redirect.data);
                window.location.href = redirect.data;
            }
        } catch (error) {
            setLoading(false);
            toast.error(error.response.data.message);
        }
    };

    return (
        <div className="p-12">
            {loading && (
                <div className={"m-auto w-28 pt-28"}>
                    <ClipLoader
                        color={restaurantStyle.page_color}
                        loading={loading}
                        size={100}
                    />
                </div>
            )}
            {!loading && (
                <>
                    {cartItemsData && cartItemsData.length > 0 ? (
                        <>
                            <h1 className="font-bold text-xl">
                                {t("Your Cart")}
                            </h1>
                            <div className="grid grid-cols-12 gap-x-6 pt-8">
                                <div className="sm:col-span-7 col-span-12">
                                    <div className="flex flex-col gap-y-6">
                                        {cartItemsData &&
                                            cartItemsData.length > 0 &&
                                            cartItemsData.map((item, index) => {
                                                return (
                                                    <CartItem
                                                        key={"cartitem" + index}
                                                        cartitem={item}
                                                        onReload={() =>
                                                            fetchCartData()
                                                        }
                                                    />
                                                );
                                            })}
                                    </div>
                                </div>
                                <div className="sm:col-span-5 col-span-12 paymentDetails p-4 mt-6 sm:mt-0">
                                    <div className="cartDetailSection mt-6">
                                        <OrderReviewSummary cart={cart} />
                                    </div>
                                    <div className="cartDetailSection h-36xw mt-8">
                                        <h3>{t("Select Payment Method")}</h3>
                                        {cart.payment_methods.map((method) => {
                                            let name = method.name
                                            let displayName = method.name ;
                                            let img =
                                                method.name === "Online"
                                                    ? pmcc
                                                    : pmcod;

                                            return (
                                                <CartDetailSection
                                                    key={method.name}
                                                    name={method.name}
                                                    onChange={(e) =>
                                                        setPaymentMethod(name)
                                                    }
                                                    isChecked={
                                                        paymentMethod === name
                                                    }
                                                    img={img}
                                                    displayName={displayName}
                                                    callBackfn={
                                                        cardPaymentCallbackFunc
                                                    }
                                                />
                                            );
                                        })}
                                        {paymentMethod === "Online" && (
                                            <div className="mt-6">
                                                <PaymentCardGoSell
                                                    callBackWithToken={
                                                        cardPaymentCallbackFunc
                                                    }
                                                />
                                                 <ApplePayButton
                                                    // The public Key provided by Tap
                                                    publicKey={tap.tap_public_key}
                                                    //The environment of the SDK and it can be one of these environments
                                                    environment={Environment.Development}
                                                    //to enable the debug mode
                                                    debug
                                                    merchant={{
                                                        //  The merchant domain name
                                                        domain: window.location.hostname,
                                                        //  The merchant identifier provided by Tap
                                                        id: tap.merchant_id
                                                    }}
                                                    transaction={{
                                                        // The amount to be charged
                                                        amount: 1,
                                                        // The currency of the amount
                                                        currency: 'SAR'
                                                    }}
                                                    // The scope of the SDK and it can be one of these scopes:
                                                    // [TapToken,AppleToken], by default it is TapToken)
                                                    scope={Scope.TapToken}
                                                    acceptance={{
                                                        // The supported networks for the Apple Pay button and it
                                                        // can be one of these networks: [Mada,Visa,MasterCard], by default
                                                        // we bring all the supported networks from tap merchant configuration
                                                        supportedBrands: [SupportedNetworks.Mada, SupportedNetworks.Visa, SupportedNetworks.MasterCard],
                                                        supportedCards : "ALL",
                                                            supportedCardsWithAuthentications : ["3DS"]
                                                    }}
                                                    // The billing contact information
                                                    customer={{
                                                        id: tap.tap_customer_id,

                                                    }}
                                                    //for styling button
                                                    interface={{
                                                        //The locale of the Apple Pay button and it can be one of these locales:[EN,AR]
                                                        locale: Locale.EN,
                                                        // The theme of the Apple Pay button and it can be one of
                                                        // these values : [light,Dark], by default it is detected from user device
                                                        theme: ThemeMode.DARK,
                                                        // The type of the Apple Pay
                                                        type: ButtonType.BUY,
                                                        // The border of the Apple Pay button and it can be one of these values:[curved,straight]
                                                        edges: Edges.CURVED
                                                    }}
                                                    // optional (A callback function that will be called when you cancel
                                                    // the payment process)
                                                    onCancel={() => console.log('cancelled')}
                                                    // optional (A callback function that will be called when you have an error)
                                                    onError={(err) => console.error(err)}
                                                    // optional (A async function that will be called after creating the token
                                                    // successfully)
                                                    onSuccess={async (token) => {
                                                        // do your stuff here...

                                                        console.log("here inline");

                                                        cardPaymentCallbackFunc(token);

                                                    }}
                                                    // optional (A callback function that will be called when you button is clickable)
                                                    onReady={() => {
                                                        console.log('Ready')
                                                    }}
                                                    // optional (A callback function that will be called when the button clicked)
                                                    onClick={() => {
                                                        console.log('Clicked')
                                                    }}
                                                    />
                                            </div>
                                        )}
                                    </div>
                                    <div className="cartDetailSection h-36xw mt-8">
                                        <h3>{t("Select Delivery Type")}</h3>
                                        <CartDetailSection
                                            name="Delivery"
                                            onChange={(e) => {
                                                fetchProfileData();
                                                setDeliveryType("Delivery");
                                            }}
                                            isChecked={
                                                deliveryType === "Delivery"
                                            }
                                            img={dtdelivery}
                                            displayName="delivery"
                                        />

                                        <CartDetailSection
                                            name="PICKUP"
                                            onChange={(e) =>
                                                setDeliveryType("PICKUP")
                                            }
                                            isChecked={
                                                deliveryType === "PICKUP"
                                            }
                                            img={dtpickup}
                                            displayName="PICKUP"
                                        />
                                    </div>
                                    <div className="mt-8">
                                        {deliveryType === "Delivery" && (
                                            <CartAddress
                                                user={user}
                                                userAddress={userAddress}
                                                selectedDeliveryAddress={
                                                    deliveryAddress
                                                }
                                                onChange={(type) =>
                                                    setDeliveryAddress(type)
                                                }
                                            />
                                        )}
                                    </div>
                                    <div className="cartDetailSection h-32 mt-8">
                                        <h3 className="mb-2">
                                            {t("Order Notes")}
                                        </h3>
                                        <InputTextarea
                                            value={orderNotes}
                                            onChange={(e) =>
                                                setOrderNotes(e.target.value)
                                            }
                                            rows={5}
                                            cols={30}
                                            placeholder={t(
                                                "Say something nice...",
                                            )}
                                        />
                                    </div>
                                    <div className="cartDetailSection mt-8">
                                        <h3 className="mb-4">
                                            {t("Payment Summary")}
                                        </h3>
                                        <div className="flex justify-between">
                                            <div>{t("Subtotal")}</div>
                                            <div>
                                                {Number(cart?.total).toFixed(
                                                    2,
                                                ) + ` ${t("SAR")}`}
                                            </div>
                                        </div>
                                        {deliveryType === "Delivery" && (
                                            <div className="flex justify-between mt-4">
                                                <div>{t("Delivery fee")}</div>
                                                <div>
                                                    {cart?.delivery_fee +
                                                        ` ${t("SAR")}`}
                                                </div>
                                            </div>
                                        )}
                                        <div className="flex justify-between mt-4">
                                            <div>{t("Coupon Discount")}</div>
                                            <div>
                                                <InputText
                                                    value={coupon}
                                                    onChange={(e) =>
                                                        setCoupon(
                                                            e.target.value,
                                                        )
                                                    }
                                                    className="w-32"
                                                />
                                            </div>
                                        </div>
                                        <Divider />
                                        <div className="flex justify-between mt-1">
                                            <div>{t("Total Payment")}</div>
                                            <div>
                                                {`${Number(cart?.total + cart?.delivery_fee).toFixed(2)} ${t("SAR")}`}
                                            </div>
                                        </div>
                                    </div>

                                    <Button
                                        label={t("Place Order")}
                                        className="w-full placeOrderBtn"
                                        onClick={handlePlaceOrder}
                                    />
                                </div>
                            </div>
                        </>
                    ) : (
                        <div className="text-center">
                            <img
                                src={NoDataImg}
                                alt=" "
                                width={300}
                                className="m-auto"
                            />
                            <p className="text-xl my-6 font-semibold">
                                {t("thereAreNoData")}
                            </p>
                            <p className="mb-6 font-semibold text-gray-500">
                                {t(
                                    "Before proceeding to checkout you must add some products to cart",
                                )}
                            </p>

                            <Button
                                label={t("Continue Shopping")}
                                className="w-64 h-10 bg-[color:var(--myColor)] text-white text-sm mt-4"
                                onClick={() => navigate("/")}
                            />
                        </div>
                    )}
                </>
            )}
        </div>
    );
};

export default CartPage;
