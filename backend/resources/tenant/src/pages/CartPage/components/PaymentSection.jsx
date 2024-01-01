import React, {useState} from "react"
import CartColumn from "./CartColumn"
import CashDeliveryIcon from "../../../assets/CashDelivery.svg"
import CardIcon from "../../../assets/Card.svg"
import BikeIcon from "../../../assets/bikeDeliveryIcon.svg"
import shopIcon from "../../../assets/shopIcon.svg"
import pinLocate from "../../../assets/pinLocate.svg"
import LocationIcon from "../../../assets/locationPin.svg"
import couponIcon from "../../../assets/coupon.svg"
import trashIcon from "../../../assets/trashBin.svg"
import orderIcon from "../../../assets/orderPlace.svg"
import {MdSend} from "react-icons/md"
import Feedback from "./Feedback"
import {useSelector} from "react-redux"
import AxiosInstance from "../../../axios/axios"
import {useNavigate} from "react-router-dom"
import {toast} from "react-toastify"
import {useTranslation} from "react-i18next"

const PaymentSection = ({
  styles,
  cartItems,
  paymentMethods,
  deliveryTypes,
  deliveryAddress,
  isloading,
  setIsLoading,
  fetchCartData,
}) => {
  const navigate = useNavigate()
  const {t} = useTranslation()
  const [notes, setNotes] = useState("")
  const [couponCode, setCouponCode] = useState("")
  const [deliveryType, setDeliveryType] = useState(deliveryTypes[1].name)
  const [couponDiscountValue, setCouponDiscountValue] = useState(0)
  const isLoggedIn = useSelector((state) => state.auth.isLoggedIn)
  const [paymentMethod, setPaymentMethod] = useState(paymentMethods[0].name)
  const [deliveryCost, setDeliveryCost] = useState(0)
  const [activeDeliveryType, setActiveDeliveryType] = useState("pickup")

  const getTotalPrice = () => {
    return cartItems
      ? parseFloat(
          cartItems.reduce(
            (total, item) =>
              total + (item.price + item.options_price) * item.quantity,
            0
          )
        ) + deliveryCost
      : 0
  }
  const priceSummary = cartItems
    ? parseFloat(
        cartItems.reduce(
          (total, item) =>
            total + (item.price + item.options_price) * item.quantity,
          0
        )
      )
    : 0

  const handlePaymentMethodChange = (method) => {
    setPaymentMethod(method.name)
  }

  const handleDeliveryTypeChange = async (type) => {
    setDeliveryType(type.name)
    setDeliveryCost(type?.cost)
    setActiveDeliveryType(type.name.toLowerCase())
  }

  const handlePlaceOrder = async () => {
    if (window.confirm(t("Are You sure you want to place the order?"))) {
      try {
        const cartResponse = await AxiosInstance.post(`/orders`, {
          payment_method: paymentMethod,
          delivery_type: deliveryType,
          notes: notes,
          couponCode: couponCode,
        })
        if (cartResponse.data) {
          toast.success(`${t("Order has been created successfully")}`)
          navigate(`/dashboard#orders`)
          // navigate(`/dashboard?OrderId=${cartResponse.data?.order?.id}#orders`);
        }
      } catch (error) {
        toast.error(error.response.data.message)
      }
    }
  }

  const handleEmptyCart = async () => {
    if (isloading) return

    if (!window.confirm(t("Are you sure to empty cart items?"))) {
      return
    }

    try {
      setIsLoading(true)
      await AxiosInstance.delete(`/carts/trash`, {}).finally(async () => {
        await fetchCartData().then((r) => null)
      })
    } catch (error) {}
    setIsLoading(false)
  }

  if (!isLoggedIn) {
    window.confirm("You need to login first")
    navigate("/login")
    return
  }

  console.log("payment methods ", paymentMethods)
  console.log("delivery methods", deliveryTypes)

  return (
    <div className='w-full laptopXL:w-[75%] mx-auto my-5'>
      <div className='w-full flex flex-col lg:flex-row items-start gap-8 my-4'>
        <div className='w-full lg:w-1/2'>
          <CartColumn headerTitle={"Select Payment Method"} isRequired>
            <div
              style={{borderColor: styles?.categoryDetail_cart_color}}
              className={`border ${
                styles?.categoryDetail_cart_color
                  ? ""
                  : "border-[var(--primary)]"
              }`}
            >
              {paymentMethods &&
                paymentMethods.map((method) => (
                  <div
                    key={method.id}
                    style={{borderColor: styles?.categoryDetail_cart_color}}
                    className={`form-control w-fulll h-[62px] flex items-center justify-center border-b ${
                      styles?.categoryDetail_cart_color
                        ? ""
                        : "border-[var(--primary)]"
                    }}last:border-none`}
                  >
                    <label className='label cursor-pointer w-[80%] mx-auto flex items-center justify-between '>
                      <div className='flex   w-full flex-row items-center justify-between px-3 '>
                        <img
                          src={CashDeliveryIcon}
                          alt={method.name}
                          className=''
                        />
                        <span className='label-text text-[1rem]'>
                          {method.name}
                        </span>
                        <input
                          id={"cash_delivery"}
                          type={"radio"}
                          name={"cash_delivery"}
                          style={{}}
                          checked={
                            paymentMethods.length < 2 ||
                            method.name === paymentMethod
                          }
                          className={
                            "radio w-[1.38rem] h-[1.38rem] border-[3px] checked:bg-[var(--primary)] "
                          }
                          onChange={() => handlePaymentMethodChange(method)}
                        />
                      </div>
                    </label>
                  </div>
                ))}
            </div>
          </CartColumn>
        </div>
        <div className='w-full lg:w-1/2'>
          <CartColumn headerTitle={"Select Delivery Type"} isRequired>
            <div className='w-full flex items-start gap-2 py-2'>
              {deliveryTypes &&
                deliveryTypes.map((deliveryType) => (
                  <div
                    key={deliveryType.id}
                    className={`w-1/2 h-[118px] flex items-center justify-center cursor-pointer  ${
                      activeDeliveryType === deliveryType.name.toLowerCase()
                        ? " bg-neutral-200 border border-neutral-300"
                        : "border border-neutral-200"
                    }`}
                    onClick={() => handleDeliveryTypeChange(deliveryType)}
                  >
                    <div className='flex items-center gap-4'>
                      <div
                        className={`w-[50px] h-[50px]  ${
                          activeDeliveryType === deliveryType.name.toLowerCase()
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
                          className='w-full h-full object-contain'
                        />
                      </div>
                      <div className='flex flex-col'>
                        <h3 className='text-[16px] font-medium capitalize'>
                          {deliveryType.name.toLowerCase()}
                        </h3>
                        <p className='text-[14px]'>
                          {deliveryType.cost > 0
                            ? `${t("SAR")} ${deliveryType.cost}`
                            : `${t("Free")}`}
                        </p>
                      </div>
                    </div>
                  </div>
                ))}
            </div>
          </CartColumn>
        </div>
      </div>
      {/* order notes */}
      <CartColumn headerTitle={"Order Notes"}>
        <div
          className={`w-full border ${
            styles?.categoryDetail_cart_color ? "" : "border-[var(--primary)]"
          }}h-[80px] flex items-center justify-center mb-6`}
        >
          <div className='flex items-center gap-3 w-full p-3 lg:w-1/2 '>
            <div className='w-full'>
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
      <div className='flex flex-col md:flex-row items-start gap-6'>
        <div className='w-full  '>
          <CartColumn headerTitle={"Address"} isRequired>
            <div
              style={{borderColor: styles?.categoryDetail_cart_color}}
              className={`w-full border ${
                styles?.categoryDetail_cart_color
                  ? ""
                  : "border-[var(--primary)]"
              }}h-[100px] flex items-center  py-4 justify-center mb-6`}
            >
              <div className='flex items-center gap-3 p-3 w-full lg:w-1/2 '>
                <div className='w-full'>
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
                  onClick={() => navigate("/dashboard#Profile")}
                  className={` w-[60px] h-[48px] border cursor-pointer ${
                    styles?.categoryDetail_cart_color
                      ? ""
                      : "border-[var(--primary)] bg-[var(--primary)]"
                  }}  rounded-lg flex items-center justify-center`}
                >
                  <img src={LocationIcon} alt='' />
                </div>
              </div>
            </div>{" "}
          </CartColumn>
        </div>
        <div className='w-full lg:w-1/2 hidden'>
          <CartColumn headerTitle={"Coupon"}>
            <div
              style={{borderColor: styles?.categoryDetail_cart_color}}
              className={`w-full border ${
                styles?.categoryDetail_cart_color
                  ? ""
                  : "border-[var(--primary)]"
              }}h-[100px] flex items-center justify-center mb-6`}
            >
              <div className='flex items-center gap-3 w-full lg:w-1/2 '>
                <div className='w-full'>
                  <Feedback
                    imgUrl={couponIcon}
                    placeholder={"Type your coupon code here"}
                  />
                </div>
                <div className='w-[40px] h-[48px] border border-neutral-200 rounded-lg flex items-center justify-center'>
                  <MdSend size={22} />
                </div>
              </div>
            </div>{" "}
          </CartColumn>
        </div>
      </div>
      {/* payment summary */}
      <div className='w-full lg:w-1/2 mx-auto my-8'>
        <CartColumn headerTitle={"Payment Summary"}>
          <div className='p-6 flex flex-col gap-4 border border-[var(--primary)'>
            <div
              style={{borderColor: styles?.categoryDetail_cart_color}}
              className={`flex flex-col gap-4 border-b pb-4 ${
                styles?.categoryDetail_cart_color
                  ? ""
                  : "border-[var(--primary)]"
              }}`}
            >
              <div className='flex items-start justify-between'>
                <h3 className='text-[16px] font-normal'>Price</h3>
                <span className='text-[14px]'>
                  {t("SAR")} {priceSummary}
                </span>
              </div>
              <div className='flex items-start justify-between'>
                <h3 className='text-[16px] font-normal'>Delivery fee</h3>
                <span className='text-[14px]'>
                  {t("SAR")} {deliveryCost}
                </span>
              </div>
            </div>
            <div className=''>
              <div className='flex items-start justify-between'>
                <h3 className='text-[1.125rem] font-bold'>Total Payment</h3>
                <span className='text-[1.125rem] font-bold'>
                  {t("SAR")} {getTotalPrice()}
                </span>
              </div>
            </div>
          </div>
          <div className='w-full h-[45px] flex items-center gap-2 my-2'>
            <div
              onClick={handleEmptyCart}
              className='w-full lg:w-1/2 h-full flex cursor-pointer items-center justify-center bg-[var(--danger)]'
            >
              <div className='flex items-center gap-4'>
                <div className='w-7 h-7'>
                  <img
                    src={trashIcon}
                    alt=''
                    className='w-full h-full object-contain'
                  />
                </div>
                <h3 className='text-[1rem] font-medium text-white'>
                  Empty Cart
                </h3>
              </div>
            </div>
            <div
              onClick={handlePlaceOrder}
              style={{backgroundColor: styles?.categoryDetail_cart_color}}
              className={`w-full lg:w-1/2 h-full flex items-center cursor-pointer justify-center ${
                styles?.categoryDetail_cart_color ? "" : "bg-[var(--primary)]"
              }`}
            >
              <div className='flex items-center gap-4'>
                <div className='w-7 h-7'>
                  <img
                    src={orderIcon}
                    alt=''
                    className='w-full h-full object-contain'
                  />
                </div>
                <h3 className='text-[1rem] font-medium text-black'>
                  Place Order
                </h3>
              </div>
            </div>
          </div>
        </CartColumn>
      </div>
    </div>
  )
}

export default PaymentSection
