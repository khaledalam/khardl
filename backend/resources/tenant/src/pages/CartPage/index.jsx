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
import coins from "../../assets/coins.png";
import pmcod from "../../assets/pmcod.png";
import apple from "../../assets/apple-logo.png";
import applePay from "../../assets/apple-pay.png";
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
import { isSafari } from "react-device-detect";
import LeftArrow from "../../assets/leftIcon.png";
import BackArrow from "../../assets/backArrow.svg";
import {
  ApplePayButton,
  ThemeMode,
  SupportedNetworks,
  Scope,
  Environment,
  Locale,
  ButtonType,
  Edges,
} from "@tap-payments/apple-pay-button";

const CartPage = () => {
  const { t } = useTranslation();

  let [loading, setLoading] = useState(true);

  const dispatch = useDispatch();

  const navigate = useNavigate();

  const restaurantStyle = useSelector((state) => {
    return state.restuarantEditorStyle;
  });

  const { price_background_color } = restaurantStyle;
  const cartItemsData = useSelector((state) => state.categoryAPI.cartItemsData);
  const [tap, setTap] = useState(null);

  const customerAddress = useSelector((state) => state.customerAPI.address);
  const [isHovered, setIsHovered] = useState(false);

  const [paymentMethod, setPaymentMethod] = useState(null);
  const [deliveryType, setDeliveryType] = useState("Delivery");
  const [deliveryTypesData, setDeliveryTypesData] = useState([]);
  const [deliveryAddress, setDeliveryAddress] = useState(0);
  const [userAddress, setUserAddress] = useState(null);
  const [orderNotes, setOrderNotes] = useState("");
  const [coupon, setCoupon] = useState("");
  const [cart, setCart] = useState(null);
  const [user, setUser] = useState(null);
  let branch_id = localStorage.getItem("selected_branch_id");

  useEffect(() => {
    setLoading(true);
    fetchResStyleData().then(() => null);
    fetchCartData().then(() => null);
    fetchProfileData().then(() => null);
  }, []);

  useEffect(() => {
    if (typeof document !== "undefined") {
      const elements = document.getElementsByClassName("p-radiobutton-box");
      Array.from(elements).forEach((element) => {
        element.style.cssText = `background-color: ${
          price_background_color || "green"
        } !important;`;
      });
    }
  }, [price_background_color]);

  useEffect(() => {
    if (paymentMethod === "Loyalty points" && deliveryType != "PICKUP") {
      toast.error(t("Loyalty points option can be used with pickup only"));
      setPaymentMethod(null);
    }
  }, [paymentMethod, deliveryType]);

  const validateCoupon = async () => {
    if (coupon === "") {
      return;
    }

    try {
      await AxiosInstance.post(`/validate/${branch_id}/coupon`, {
        code: coupon,
      });
      await fetchCartData();
      toast.success(`${t("Coupon Applied successfully")}`);
    } catch (error) {
      console.log(error);
      toast.error(error.response.data.message);
    }
  };

  const removeCoupon = async () => {
    try {
      await AxiosInstance.post(`/remove/coupon`);
      await fetchCartData();
      toast.success(`${t("Coupon Removed successfully")}`);
      setCoupon("");
    } catch (error) {
      console.log(error);
      toast.error(error.response.data.message);
    }
  };

  const fetchResStyleData = async () => {
    try {
      AxiosInstance.get(`restaurant-style`).then((response) =>
        dispatch(changeRestuarantEditorStyle(response.data?.data))
      );
    } catch (error) {
      // toast.error(`${t('Failed to send verification code')}`)
      console.log(error);
    }
  };

  const fetchCartData = async () => {
    try {
      setLoading(true);
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
        setDeliveryTypesData(cartResponse.data?.data?.delivery_types);
        // setAddress(cartResponse.data?.data?.address ?? t("N/A"));
        setTap(cartResponse.data?.data?.tap_information);
      }
      setLoading(false);
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
            toast.success(`${t("Order has been created successfully")}`);
            navigate(`/profile-summary#orders`);
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
    let orderAddress = `${customerAddress.lat},${customerAddress.lng}`;

    try {
      setLoading(true);
      const redirect = await AxiosInstance.post(`/orders/payment/redirect`, {
        payment_method: paymentMethod == "Apple Pay" ? "Online" : paymentMethod,
        delivery_type: deliveryType,
        notes: orderNotes,
        couponCode: coupon,
        address: orderAddress,
        token_id: response?.id,
      });

      if (redirect.data) {
        window.location.href = redirect.data;
      }
    } catch (error) {
      setLoading(false);
      toast.error(error.response.data.message);
    }
  };

  const getTotalPrice = () =>
    Number(
      parseFloat(cart?.total) +
        (deliveryType === "PICKUP" ? 0.0 : parseFloat(cart?.delivery_fee))
    ).toFixed(2);

  return (
    <div className="p-4 sm:p-6 md:p-12">
      {loading && (
        <div className={"m-auto w-28 pt-28"}>
          <ClipLoader
            color={restaurantStyle?.page_color}
            loading={loading}
            size={100}
          />
        </div>
      )}
      {!loading && (
        <>
          {cartItemsData && cartItemsData.length > 0 ? (
            <>
              <Button
                className="w-12 h-10 text-white shadow-md rounded-full text-sm mt-4 mb-4 flex justify-center items-center"
                onClick={() => navigate("/")}
              >
                <img
                  src={BackArrow}
                  className="w-full h-full"
                  alt="left arrow"
                />
              </Button>
              <h1 className="font-bold text-xl">{t("Your Cart")}</h1>

              <div className="flex flex-wrap md:grid md:grid-cols-12 gap-x-6 pt-8">
                <div className="md:col-span-6 w-full">
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
                <div className="md:col-span-6 w-full paymentDetails p-4 mt-6 sm:mt-0">
                  <div className="cartDetailSection mt-6">
                    {Array.isArray(cart.items) && (
                      <OrderReviewSummary cart={cart} />
                    )}
                  </div>
                  <div className="cartDetailSection h-36xw mt-8">
                    <h3>{t("Select Payment Method")}</h3>

                    {cart?.allow_buy_with_loyalty_points && (
                      <CartDetailSection
                        key={"Loyalty points"}
                        name={"Loyalty points"}
                        onChange={(e) => setPaymentMethod("Loyalty points")}
                        isChecked={paymentMethod === "Loyalty points"}
                        img={coins}
                        displayName={"Loyalty points"}
                        callBackfn={cardPaymentCallbackFunc}
                        disabled={deliveryType != "PICKUP"}
                      />
                    )}

                    {cart.payment_methods.some(
                      (obj) => obj.name === "Online"
                    ) && (
                      <CartDetailSection
                        key={"Online"}
                        name={"Online"}
                        onChange={(e) => setPaymentMethod("Online")}
                        isChecked={paymentMethod === "Online"}
                        img={pmcc}
                        displayName="Card"
                        callBackfn={cardPaymentCallbackFunc}
                      />
                    )}
                    {cart.payment_methods.some(
                      (obj) => obj.name === "Online"
                    ) &&
                      isSafari && (
                        <CartDetailSection
                          key={"Apple Pay"}
                          name={"ApplePay"}
                          onChange={(e) => setPaymentMethod("Apple Pay")}
                          isChecked={paymentMethod === "Apple Pay"}
                          img={apple}
                          displayName={"Apple Pay"}
                          callBackfn={cardPaymentCallbackFunc}
                        />
                      )}
                    {cart.payment_methods.some(
                      (obj) => obj.name === "Cash on Delivery"
                    ) && (
                      <CartDetailSection
                        key={"Cash"}
                        name={"Cash"}
                        onChange={(e) => setPaymentMethod("Cash on Delivery")}
                        isChecked={paymentMethod === "Cash on Delivery"}
                        img={pmcod}
                        displayName="Cash"
                        callBackfn={cardPaymentCallbackFunc}
                      />
                    )}
                    {paymentMethod === "Online" && (
                      <div className="mt-6 space-y-3">
                        <PaymentCardGoSell
                          callBackWithToken={cardPaymentCallbackFunc}
                        />
                        {/*<button className="bg-black text-white w-full rounded-[12px] flex justify-center items-center">*/}
                        {/*    <div className="font-semibold text-[20px] py-3">*/}
                        {/*        {t("Buy with Card")}*/}
                        {/*    </div>*/}
                        {/*</button>*/}
                      </div>
                    )}
                    {paymentMethod === "Apple Pay" && (
                      <div className="mt-6">
                        <ApplePayButton
                          // The public Key provided by Tap
                          publicKey={tap.tap_public_key}
                          //The environment of the SDK and it can be one of these environments
                          environment={Environment.Beta}
                          //to enable the debug mode
                          debug
                          merchant={{
                            //  The merchant domain name
                            domain: window.location.hostname,
                            //  The merchant identifier provided by Tap
                            id: tap.merchant_id,
                          }}
                          transaction={{
                            // The amount to be charged
                            amount: getTotalPrice(),
                            // The currency of the amount
                            currency: "SAR",
                          }}
                          // The scope of the SDK and it can be one of these scopes:
                          // [TapToken,AppleToken], by default it is TapToken)
                          scope={Scope.TapToken}
                          acceptance={{
                            // The supported networks for the Apple Pay button and it
                            // can be one of these networks: [Mada,Visa,MasterCard], by default
                            // we bring all the supported networks from tap merchant configuration
                            supportedBrands: [
                              SupportedNetworks.Mada,
                              SupportedNetworks.Visa,
                              SupportedNetworks.MasterCard,
                            ],
                            supportedCards: "ALL",
                            supportedCardsWithAuthentications: ["3DS"],
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
                            edges: Edges.CURVED,
                          }}
                          // optional (A callback function that will be called when you cancel
                          // the payment process)
                          /* onCancel={() => console.log("cancelled")} */
                          // optional (A callback function that will be called when you have an error)
                          onError={(err) => console.error(err)}
                          // optional (A async function that will be called after creating the token
                          // successfully)
                          onSuccess={async (token) => {
                            // do your stuff here...

                            cardPaymentCallbackFunc(token);
                          }}
                          // optional (A callback function that will be called when you button is clickable)
                          onReady={() => {
                          }}
                          // optional (A callback function that will be called when the button clicked)
                          onClick={() => {
                          }}
                        />
                      </div>
                    )}
                  </div>
                  <div className="cartDetailSection h-36xw mt-8">
                    <h3>{t("Select Delivery Type")}</h3>
                    {deliveryTypesData.some((obj) => obj.name === "Delivery") &&
                      paymentMethod !== "Loyalty points" && (
                        <CartDetailSection
                          name="Delivery"
                          onChange={(e) => {
                            fetchProfileData();
                            setDeliveryType("Delivery");
                          }}
                          isChecked={deliveryType === "Delivery"}
                          img={dtdelivery}
                          displayName="delivery"
                        />
                      )}

                    {deliveryTypesData.some((obj) => obj.name === "PICKUP") && (
                      <CartDetailSection
                        name="PICKUP"
                        onChange={(e) => setDeliveryType("PICKUP")}
                        isChecked={deliveryType === "PICKUP"}
                        img={dtpickup}
                        displayName="PICKUP"
                      />
                    )}
                  </div>
                  <div className="mt-8">
                    {deliveryType === "Delivery" && (
                      <CartAddress
                        addresses={cart?.address || []}
                        userAddress={userAddress}
                        selectedDeliveryAddress={deliveryAddress}
                        onChange={(type) => setDeliveryAddress(type)}
                      />
                    )}
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
                  <div className="cartDetailSection mt-8">
                    <h3 className="mb-4">{t("Payment Summary")}</h3>
                    <div className="flex justify-between">
                      <div>{t("Subtotal")}</div>
                      <div>
                        {Number(cart?.sub_total).toFixed(2) + ` ${t("SAR")}`}
                      </div>
                    </div>
                    {deliveryType === "Delivery" && (
                      <div className="flex justify-between mt-4">
                        <div>{t("Delivery fee")}</div>
                        <div>{cart?.delivery_fee + ` ${t("SAR")}`}</div>
                      </div>
                    )}
                    
                    <div className="flex justify-between mt-4">
                      <div className="flex flex-col">
                        <span>{t("Coupon Discount")}</span>
                      </div>
                      <div>
                        {cart.coupon ? (
                          <>
                            <div className="text-right">
                              -{Number(cart.discount).toFixed(2)} {t("SAR")}
                              <br />
                              <button
                                className="text-sm font-bold text-red-700 hover:underline"
                                onClick={removeCoupon}
                              >
                                Remove coupon
                              </button>
                            </div>
                          </>
                        ) : (
                          <InputText
                            value={coupon}
                            onChange={(e) => setCoupon(e.target.value)}
                            onBlur={() => validateCoupon(coupon)}
                            className="w-32 px-2"
                          />
                        )}
                      </div>
                    </div>
                    <Divider />
                    <div className="flex justify-between mt-1">
                      <div>{t("Total Payment")}</div>
                      <div className={"flex-column"}>
                        {paymentMethod !== "Loyalty points" && (
                          <div>{`${getTotalPrice()} ${t("SAR")}`}</div>
                        )}
                        {paymentMethod === "Loyalty points" &&
                        cart?.allow_buy_with_loyalty_points ? (
                          <div>
                            {cart?.total_price_with_loyalty_points +
                              " " +
                              t("points-price")}
                          </div>
                        ) : null}
                      </div>
                    </div>
                  </div>
                  <Button
                    onMouseEnter={() => setIsHovered(true)}
                    onMouseLeave={() => setIsHovered(false)}
                    style={{
                      backgroundColor: isHovered
                        ? "white"
                        : restaurantStyle?.price_background_color || "",
                      color: isHovered
                        ? restaurantStyle?.price_background_color || ""
                        : "white",
                      borderColor:
                        restaurantStyle?.price_background_color || "",
                    }}
                    label={t("Place Order")}
                    className="mt-[15px] w-full cursor-pointer text-white bg-red-900 rounded-lg px-4 py-2.5 border  leading-[18px] hover:bg-white hover:border-red-900 hover:text-red-900 transition-all shadow-md"
                    onClick={handlePlaceOrder}
                  />
                </div>
              </div>
            </>
          ) : (
            <div className="text-center">
              <img src={NoDataImg} alt=" " width={300} className="m-auto" />
              <p className="text-xl my-6 font-semibold">
                {t("thereAreNoData")}
              </p>
              <p className="mb-6 font-semibold text-gray-500">
                {t(
                  "Before proceeding to checkout you must add some products to cart"
                )}
              </p>

              <Button
                onMouseEnter={() => setIsHovered(true)}
                onMouseLeave={() => setIsHovered(false)}
                label={t("Continue Shopping")}
                className="w-64 h-10 bg-red-900 hover:bg-white hover:text-red-900 hover:border-red-900 text-white text-sm mt-4 border transition-all shadow-md  leading-[18px]"
                style={{
                  backgroundColor: isHovered
                    ? "white"
                    : restaurantStyle?.price_background_color || "",
                  color: isHovered
                    ? restaurantStyle?.price_background_color || ""
                    : "white",
                  borderColor: restaurantStyle?.price_background_color || "",
                }}
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
