import React, { useState } from "react";
import CartColumn from "./CartColumn";
import CashDeliveryIcon from "../../../assets/CashDelivery.svg";
import CardIcon from "../../../assets/Card.svg";
import BikeIcon from "../../../assets/bikeDeliveryIcon.svg";
import shopIcon from "../../../assets/shopIcon.svg";
import pinLocate from "../../../assets/pinLocate.svg";
import LocationIcon from "../../../assets/locationPin.svg";
import couponIcon from "../../../assets/coupon.svg";
import trashIcon from "../../../assets/trashBin.svg";
import orderIcon from "../../../assets/orderPlace.svg";
import { MdSend } from "react-icons/md";
import Feedback from "./Feedback";
import { useSelector } from "react-redux";
import AxiosInstance from "../../../axios/axios";
import { useNavigate } from "react-router-dom";
import { toast } from "react-toastify";
import { useTranslation } from "react-i18next";
import {  IoClose } from "react-icons/io5";


import { GoSellElements } from "@tap-payments/gosell";
import Places from "../../../components/Customers/CustomersEditor/components/Dashboard/components/Places";

const PaymentSection = ({
  styles,
  cartItems,
  tap,
  paymentMethods,
  deliveryTypes,
  deliveryAddress,
  isloading,
  setIsLoading,
  fetchCartData,
  cartCoupon,
  appliedCoupon,
}) => {
  const navigate = useNavigate();
  const { t } = useTranslation();
  const [notes, setNotes] = useState("");
  const [couponCode, setCouponCode] = useState("");
  const [deliveryType, setDeliveryType] = useState("");
  const [couponDiscountValue, setCouponDiscountValue] = useState(null);
  const isLoggedIn = useSelector((state) => state.auth.isLoggedIn);
  const [paymentMethod, setPaymentMethod] = useState(
    paymentMethods && paymentMethods[0] ? paymentMethods[0]?.name : ""
  );
  const [deliveryCost, setDeliveryCost] = useState(0);
  const [activeDeliveryType, setActiveDeliveryType] = useState("");
  const [showTAPClientCard, setShowTAPClientCard] = useState(false);
  const language = useSelector((state) => state.languageMode.languageMode);
  const [spinner, setSpinner] = useState(false);
  const callbackFunc = async (response) => {
    try {
      setSpinner(true);
      const redirect = await AxiosInstance.post(`/orders/payment/redirect`, {
        payment_method: paymentMethod,
        delivery_type: deliveryType,
        notes: notes,
        couponCode: couponCode,
        token_id: response.id,
      });

      if (redirect.data) {
        console.log("redirect ==>", redirect.data);
        window.location.href = redirect.data;
      }
    } catch (error) {
      setSpinner(false);
      toast.error(error.response);
    }
  };

  // TODO @todo  get total price from backend
  const getTotalPrice = () => {
    return cartItems
      ? parseFloat(
        cartItems.reduce(
          (total, item) =>
            total + (item.price + item.options_price) * item.quantity,
          0
        )
      ) +
      deliveryCost -
      (couponDiscountValue && couponDiscountValue.discount
        ? couponDiscountValue.discount
        : cartCoupon
          ? cartCoupon
          : 0)
      : 0;
  };
  const priceSummary = cartItems
    ? parseFloat(
      cartItems.reduce(
        (total, item) =>
          total + (item.price + item.options_price) * item.quantity,
        0
      )
    )
    : 0;

  const handlePaymentMethodChange = (method) => {
    setPaymentMethod(method.name);

    if (method?.name == "Online") {
      setShowTAPClientCard(true);
    } else {
      setShowTAPClientCard(false);
    }
  };

  const handleDeliveryTypeChange = async (type) => {
    setDeliveryType(type.name);
    setDeliveryCost(type?.cost);
    setActiveDeliveryType(type.name.toLowerCase());
  };

  const handlePlaceOrder = async () => {
    if (window.confirm(t("Are You sure you want to place the order?"))) {
      try {
        if (paymentMethod == "Cash on Delivery") {
          try {
            const cartResponse = await AxiosInstance.post(`/orders`, {
              payment_method: paymentMethod,
              delivery_type: deliveryType,
              notes: notes,
              couponCode: couponCode,
            });
            if (cartResponse.data) {
              toast.success(`${t("Order has been created successfully")}`);
              navigate(`/dashboard#orders`);
              // navigate(`/dashboard?OrderId=${cartResponse.data?.order?.id}#orders`);
            }
          } catch (error) {
            toast.error(error.response.data.message);
          }
        } else {
          const cartResponse = await AxiosInstance.post(`/orders/validate`, {
            payment_method: paymentMethod,
            delivery_type: deliveryType,
            notes: notes,
            couponCode: couponCode,
          });

          if (cartResponse.data) {
            // const extractedData = cartItems.map((cardItem) => ({
            //   id: cardItem.cart_id,
            //   name: cardItem.item.name[language],
            //   description: cardItem.item.description[language],
            //   quantity: cardItem.quantity,
            //   amount_per_unit: cardItem.price,
            //   total_amount: cardItem.total + deliveryCost,

            // }));

            document.getElementById("payment").showModal();

            //  <p id="msg"></p>

            // <button onClick={() => GoSellElements.submit()}>Submit</button>
          }
        }
      } catch (error) {
        toast.error(error.response.data.message);
        console.log(error);
      }
    }
  };

  const handleEmptyCart = async () => {
    if (isloading) return;

    if (!window.confirm(t("Are you sure to empty cart items?"))) {
      return;
    }

    try {
      setIsLoading(true);
      await AxiosInstance.delete(`/carts/trash`, {}).finally(async () => {
        await fetchCartData().then((r) => null);
      });
    } catch (error) { }
    setIsLoading(false);
  };

  if (!isLoggedIn) {
    window.confirm("You need to login first");
    navigate("/login");
    return;
  }

  // console.log("payment methods ", paymentMethods)
  // console.log("delivery methods", deliveryTypes)

  const handleCouponCodeValidity = async () => {
    try {
      setSpinner(true);
      const response = await AxiosInstance.post(`/validate/coupon`, {
        code: couponCode,
      });
      setCouponDiscountValue(response.data.data);
      toast.success(`${t("Coupon Applied successfully")}`);
      setSpinner(false);
      console.log(response);
    } catch (error) {
      setCouponDiscountValue(null)
      setCouponCode(null)
      setSpinner(false);
      toast.error(error.response.data.message);
      console.log(error);
    }
  };
  const removeCoupon = async () => {
    if((couponCode && couponDiscountValue.discount) || appliedCoupon?.code){
      try {
        setSpinner(true);
        const response = await AxiosInstance.post(`/remove/coupon`,);
        toast.success(`${t("Coupon Removed successfully")}`);
        setSpinner(false);
        console.log(response);
        window.location.reload(false)
      } catch (error) {
        setSpinner(false);
        toast.error(error.response.data.message);
        console.log(error);
      }
    } else{
      setCouponDiscountValue(null)
      setCouponCode(null)
    }
  };
  return (
    <div className="w-full laptopXL:w-[75%] mx-auto my-5">
      {spinner && (
        <div
          role="status"
          className="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-full h-full z-50"
        >
          <div className="absolute inset-0 bg-black opacity-25"></div>
          <div className="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
            <svg
              aria-hidden="true"
              className="w-8 h-8 mr-2 text-gray-200 animate-spin fill-[var(--primary)]"
              viewBox="0 0 100 101"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                fill="currentColor"
              />
              <path
                d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                fill="currentFill"
              />
            </svg>
            <span className="sr-only">Loading...</span>
          </div>
        </div>
      )}

      <p id="msg"></p>
      <div id={"tap_charge_element"} />

      <dialog id="payment" className="modal">
        {spinner && (
          <div
            role="status"
            style={{ zIndex: 1, height: "fit-content" }}
            className="rounded-s-md  max-[860px]:rounded-b-lg max-[860px]:rounded-s-none absolute -translate-x-1/2 -translate-y-1/2 top-[44.1%] left-1/2 w-[100%] h-[100%] "
          >
            <div className="rounded-s-md max-[860px]:rounded-b-lg max-[860px]:rounded-s-none relative bg-black opacity-25 flex justify-center items-center w-[100%] h-[100%]"></div>
            <div className="absolute -translate-x-1/2 -translate-y-1/2 top-2/4 left-1/2 ">
              <svg
                aria-hidden="true"
                className="w-8 h-8 mr-2 text-gray-200 animate-spin fill-[var(--primary)]"
                viewBox="0 0 100 101"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                  fill="currentColor"
                />
                <path
                  d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                  fill="currentFill"
                />
              </svg>
            </div>
          </div>
        )}
        <div style={{ width: "50%", padding: "34px !important" }}>
          <GoSellElements
            gateway={{
              publicKey: tap_public_key,
              language: "ar",
              supportedCurrencies: "all",
              supportedPaymentMethods: "all",
              notifications: "standard",
              callback: callbackFunc,
              labels: {
                cardNumber: "Card Number",
                expirationDate: "MM/YY",
                cvv: "CVV",
                cardHolder: "Name on Card",
                actionButton: "Pay",
              },
              style: {
                base: {
                  color: "#535353",
                  lineHeight: "18px",
                  fontFamily: "sans-serif",
                  fontSmoothing: "antialiased",
                  fontSize: "16px",
                  "::placeholder": {
                    color: "rgba(0, 0, 0, 0.26)",
                    fontSize: "15px",
                  },
                },
                invalid: {
                  color: "red",
                  iconColor: "#fa755a ",
                },
              },
            }}
          />
          <div
            onClick={() => GoSellElements.submit()}
            style={{
              backgroundColor: styles?.categoryDetail_cart_color,
              width: "100%",
              height: "45px",
              borderRadius: "1%",
            }}
            className={`w-full lg:w-1/2 h-full flex items-center cursor-pointer justify-center ${styles?.categoryDetail_cart_color ? "" : "bg-[var(--primary)]"
              }`}
          >
            <div className="flex items-center gap-4">
              <div className="w-7 h-7">
                <img
                  src={orderIcon}
                  alt=""
                  className="w-full h-full object-contain"
                />
              </div>

              <h3 className="text-[1rem] font-medium text-black">
                {t("Place Order")}
              </h3>
            </div>
          </div>
        </div>
      </dialog>

      <div className="w-full flex flex-col lg:flex-row items-start gap-8 my-4">
        <div className="w-full lg:w-1/2">
          <CartColumn headerTitle={t("Select Payment Method")} isRequired>
            <div
              style={{ borderColor: styles?.categoryDetail_cart_color }}
              className={`border ${styles?.categoryDetail_cart_color
                  ? ""
                  : "border-[var(--primary)]"
                }`}
            >
              {paymentMethods &&
                paymentMethods.map((method) => (
                  <div
                    key={method.id}
                    style={{ borderColor: styles?.categoryDetail_cart_color }}
                    className={`form-control w-fulll h-[62px] flex items-center justify-center border-b ${styles?.categoryDetail_cart_color
                        ? ""
                        : "border-[var(--primary)]"
                      }}last:border-none`}
                  >
                    <label className="label cursor-pointer w-[80%] mx-auto flex items-center justify-between ">
                      <div className="flex   w-full flex-row items-center justify-between px-3 ">
                        <img
                          src={CashDeliveryIcon}
                          alt={method.name}
                          className=""
                        />
                        <span className="label-text text-[1rem]">
                          {t(`${method.name}`)}
                        </span>
                        <input
                          id={"cash_delivery"}
                          type={"radio"}
                          name={"cash_delivery"}
                          style={{}}
                          checked={
                            paymentMethods.length < 2 ||
                            method?.name === paymentMethod
                          }
                          className={
                            "radio w-[1.38rem] h-[1.38rem] border-[3px] checked:bg-[var(--primary)] "
                          }
                          onChange={() => {
                            if (!method?.is_active) {
                              alert(t("Not available"));
                              return;
                            }
                            handlePaymentMethodChange(method);
                          }}
                        />
                        {!method?.is_active && (
                          <small style={{ color: "red" }}>
                            {t("Not available")}
                          </small>
                        )}
                      </div>
                    </label>
                  </div>
                ))}
            </div>
          </CartColumn>
        </div>
        <div className="w-full lg:w-1/2">
          <CartColumn headerTitle={t("Select Delivery Type")} isRequired>
            <div className="w-full flex items-start gap-2 py-2">
              {deliveryTypes &&
                deliveryTypes.map((deliveryType) => (
                  <div
                    key={deliveryType.id}
                    className={`w-1/2 h-[118px] flex items-center justify-center cursor-pointer  ${activeDeliveryType === deliveryType.name.toLowerCase()
                        ? " bg-neutral-200 border border-neutral-300"
                        : "border border-neutral-200"
                      }`}
                    onClick={() => {
                      if (!deliveryType?.is_active) {
                        alert(t("Not available"));
                        return;
                      }
                      handleDeliveryTypeChange(deliveryType);
                    }}
                  >
                    <div className="flex items-center gap-4">
                      <div
                        className={`w-[50px] h-[50px]  ${activeDeliveryType === deliveryType.name.toLowerCase()
                            ? "bg-[#D9D9D9]"
                            : "bg-[#C0D12330]"
                          } rounded-full p-2`}
                      >
                        <img
                          src={
                            deliveryType.name.toLowerCase().includes("delivery")
                              ? BikeIcon
                              : deliveryType.name
                                .toLowerCase()
                                .includes("pickup")
                                ? shopIcon
                                : ""
                          }
                          alt={deliveryType.name}
                          className="w-full h-full object-contain"
                        />
                      </div>
                      <div className="flex flex-col">
                        <h3 className="text-[16px] font-medium capitalize">
                          {t(`${deliveryType.name.toLowerCase()}`)}
                        </h3>
                        <p className="text-[14px]">
                          {deliveryType.cost > 0
                            ? `${t("SAR")} ${deliveryType.cost}`
                            : `${t("Free")}`}
                        </p>
                        {!deliveryType?.is_active && (
                          <small style={{ color: "red" }}>
                            {t("Not available")}
                          </small>
                        )}
                      </div>
                    </div>
                  </div>
                ))}
            </div>
          </CartColumn>
        </div>
      </div>
      {/* order notes */}
      <CartColumn headerTitle={t("Order Notes")}>
        <div
          className={`w-full border ${styles?.categoryDetail_cart_color ? "" : "border-[var(--primary)]"
            }}h-[80px] flex items-center justify-center mb-6`}
        >
          <div className="flex items-center gap-3 w-full p-3 lg:w-1/2 ">
            <div className="w-full">
              <Feedback
                value={notes}
                onChange={(e) => setNotes(e.target.value)}
              />
            </div>
            {/* <div className='w-[40px] h-[48px] border border-neutral-200 rounded-lg flex items-center justify-center'>
              <MdSend size={22} />
            </div> */}
          </div>
        </div>
      </CartColumn>
      {/* address and coupon */}
      <div className="flex flex-col md:flex-row items-start gap-6">
        <div className="w-full lg:w-1/2">
          <CartColumn headerTitle={t("Address")} isRequired>
            <div
              style={{ borderColor: styles?.categoryDetail_cart_color }}
              className={`w-full border ${styles?.categoryDetail_cart_color
                  ? ""
                  : "border-[var(--primary)]"
                }}h-[100px] flex items-center  py-4 justify-center mb-6`}
            >
              <div className="flex items-center gap-3 p-3 w-full lg:w-1/2 ">
                <div className="w-full">
                  <Feedback
                    imgUrl={pinLocate}
                    placeholder={"Jeddah xxxyyyzzzz street"}
                    value={deliveryAddress}
                    isDisabled
                    isReadOnly
                  />
                </div>
                <div
                  style={{
                    borderColor: styles?.categoryDetail_cart_color,
                    backgroundColor: styles?.categoryDetail_cart_color,
                  }}
                  // onClick={() => navigate("/dashboard#Profile")}
                  className={` w-[60px] h-[48px] border cursor-pointer ${
                    styles?.categoryDetail_cart_color
                      ? ""
                      : "border-[var(--primary)] bg-[var(--primary)]"
                  }}  rounded-lg flex items-center justify-center`}
                >
                  <img src={LocationIcon} alt="" />
                </div>


                {/* Open the modal using document.getElementById('ID').showModal() method */}
                {/* The button to open modal */}
                {/* <label htmlFor="my_modal_7" className="btn">open modal</label> */}

                {/* Put this part before </body> tag */}
                <input type="checkbox" id="my_modal_7" className="modal-toggle" />
                <div className="modal" role="dialog">
                  {/* <div className="modal-box "> */}
                  <div className="modal-box w-11/12 max-w-5xl overflow-hidden">
                  <Places inputStyle={
              "input border-[var(--customer)] !w-full lg:!w-1/3 hover:border-[var(--customer)] focus-visible:border-[var(--customer)] outline-0 outline-none focus-visible:outline-none w-full"
            } />
                  </div>
                  <label className="modal-backdrop" htmlFor="my_modal_7">Close</label>
                </div>






              </div>
            </div>{" "}
          </CartColumn>
        </div>
        <div className="w-full lg:w-1/2">
          <CartColumn headerTitle={t("Coupon")}>
            <div
              style={{ borderColor: styles?.categoryDetail_cart_color }}
              className={`w-full border ${styles?.categoryDetail_cart_color
                  ? ""
                  : "border-[var(--primary)]"
                }}h-[100px] flex items-center justify-center mb-6`}
            >
              <div className="flex items-center gap-3 w-full lg:w-1/2 ">
                <div className="w-full">
                  <Feedback
                    imgUrl={couponIcon}
                    placeholder={t("Type your coupon code here")}
                    defaultValue={
                      appliedCoupon?.code ? appliedCoupon?.code : couponCode
                    }
                    onChange={(e) => setCouponCode(e.target.value)}
                  />
                </div>
                {/* <MdSend onClick={() => handleCouponCodeValidity()} size={22} /> */}
                {/* <span className='loading loading-spinner text-[var(--customer)]'></span> */}
                <div
                  onClick={() => {
                    if (couponCode === "") {
                      toast.error(`${t("Please Enter Coupon Code")}`);
                    } else {
                      handleCouponCodeValidity();
                    }
                  }}
                  className="w-[40px] h-[48px] border border-neutral-200 rounded-lg flex items-center justify-center cursor-pointer"
                >
                  <MdSend size={22} />
                </div>
                {(appliedCoupon?.code || couponCode) && (<div
                  onClick={() => { removeCoupon() }}
                  className="w-[40px] h-[48px] border border-neutral-200 rounded-lg flex items-center justify-center cursor-pointer"
                ><IoClose size={25} className="cursor-pointer" />
                </div>
                )}
              </div>
            </div>{" "}
          </CartColumn>
        </div>
      </div>
      {/* payment summary */}
      <div className="w-full lg:w-1/2 mx-auto my-8">
        <CartColumn headerTitle={t("Payment Summary")}>
          <div className="p-6 flex flex-col gap-4 border border-[var(--primary)">
            <div
              style={{ borderColor: styles?.categoryDetail_cart_color }}
              className={`flex flex-col gap-4 border-b pb-4 ${styles?.categoryDetail_cart_color
                  ? ""
                  : "border-[var(--primary)]"
                }}`}
            >
              <div className="flex items-start justify-between">
                <h3 className="text-[16px] font-normal">{t("price")}</h3>
                <span className="text-[14px]">
                  {t("SAR")} {priceSummary}
                </span>
              </div>
              {couponDiscountValue && couponDiscountValue.discount ? (
                <div className="flex items-start justify-between">
                  <h3 className="text-[16px] font-normal">
                    {t("Coupon Discount")}
                  </h3>
                  <span className="text-[14px]">
                    {t("SAR")} {couponDiscountValue.discount}
                  </span>
                </div>
              ) : cartCoupon ? (
                <div className="flex items-start justify-between">
                  <h3 className="text-[16px] font-normal">
                    {t("Coupon Discount")}
                  </h3>
                  <span className="text-[14px]">
                    {t("SAR")} {cartCoupon}
                  </span>
                </div>
              ) : null}
              <div className="flex items-start justify-between">
                <h3 className="text-[16px] font-normal">{t("Delivery fee")}</h3>
                <span className="text-[14px]">
                  {t("SAR")} {deliveryCost}
                </span>
              </div>
            </div>
            <div className="">
              <div className="flex items-start justify-between">
                <h3 className="text-[1.125rem] font-bold">
                  {t("Total Payment")}
                </h3>
                <span className="text-[1.125rem] font-bold">
                  {t("SAR")} {getTotalPrice()}
                </span>
              </div>
            </div>
          </div>
          <div className="w-full h-[45px] flex items-center gap-2 my-2">
            <div
              onClick={handleEmptyCart}
              className="w-full lg:w-1/2 h-full flex cursor-pointer items-center justify-center bg-[var(--danger)]"
            >
              <div className="flex items-center gap-4">
                <div className="w-7 h-7">
                  <img
                    src={trashIcon}
                    alt=""
                    className="w-full h-full object-contain"
                  />
                </div>
                <h3 className="text-[1rem] font-medium text-white">
                  {t("Empty Cart")}
                </h3>
              </div>
            </div>
            {/*{showTAPClientCard && GoSell()}*/}
            <div
              onClick={handlePlaceOrder}
              style={{ backgroundColor: styles?.categoryDetail_cart_color }}
              className={`w-full lg:w-1/2 h-full flex items-center cursor-pointer justify-center ${styles?.categoryDetail_cart_color ? "" : "bg-[var(--primary)]"
                }`}
            >
              <div className="flex items-center gap-4">
                <div className="w-7 h-7">
                  <img
                    src={orderIcon}
                    alt=""
                    className="w-full h-full object-contain"
                  />
                </div>

                <h3 className="text-[1rem] font-medium text-black">
                  {t("Place Order")}
                </h3>
              </div>
            </div>
          </div>
        </CartColumn>
      </div>
    </div>
  );
};

export default PaymentSection;
