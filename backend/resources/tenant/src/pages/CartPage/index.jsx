import React, {Fragment, useCallback, useEffect, useState} from "react"
import CartHeader from "./components/CartHeader"
import CartSection from "./components/CartSection"
import PaymentSection from "./components/PaymentSection"
import LoadingSpinner from "./components/LoadingSpinner"
import AxiosInstance from "../../axios/axios"
import {useTranslation} from "react-i18next"
import {useDispatch, useSelector} from "react-redux"
import {useNavigate} from "react-router-dom"
import {Helmet} from "react-helmet"
import {setCartItemsData} from "../../redux/NewEditor/categoryAPISlice"
import {changeRestuarantEditorStyle} from "../../redux/NewEditor/restuarantEditorSlice"

const CartPage = () => {
  const [isloading, setIsLoading] = useState(false)
  const [paymentMethodsData, setPaymentMethodsData] = useState(null)
  const [address, setAddress] = useState(null)
  const [tap, setTap] = useState(null)
  const [deliveryTypesData, setDeliveryTypesData] = useState(null)
  const restuarantStyle = useSelector((state) => state.restuarantEditorStyle)

  const [cartCoupon, setCartCoupon] = useState(null)
  const [appliedCoupon, setAppliedCoupon] = useState(null)

  const navigate = useNavigate()
  const dispatch = useDispatch()
  const {t} = useTranslation()
  const language = useSelector((state) => state.languageMode.languageMode)
  const cartItems = useSelector((state) => state.categoryAPI.cartItemsData)

  const fetchCartData = async () => {
    if (isloading) return
    setIsLoading(true)

    try {
      const cartResponse = await AxiosInstance.get(`carts`)

      console.log("cart >>>", cartResponse.data)
      if (cartResponse.data) {
        
        if(cartResponse.data.data.discount && cartResponse.data.data.coupon.id){
          setCartCoupon(cartResponse.data.data.discount)
          setAppliedCoupon(cartResponse.data.data.coupon)
        }
        dispatch(setCartItemsData(cartResponse.data?.data.items))
        setPaymentMethodsData(cartResponse.data?.data?.payment_methods)
        setDeliveryTypesData(cartResponse.data?.data?.delivery_types)
        setAddress(cartResponse.data?.data?.address ?? t("N/A"))
        setTap(cartResponse.data?.data?.tap_information)
      }
    } catch (error) {
      // toast.error(`${t('Failed to send verification code')}`)
      console.log(error)
    } finally {
      setIsLoading(false)
    }
  }

  const fetchResStyleData = async () => {
    try {
      AxiosInstance.get(`restaurant-style`).then((response) =>
        dispatch(changeRestuarantEditorStyle(response.data?.data))
      )
    } catch (error) {
      // toast.error(`${t('Failed to send verification code')}`)
      console.log(error)
    }
  }

  useEffect(() => {
    fetchCartData().then((r) => null)
    fetchResStyleData().then(() => null)
  }, [])

  const handleValidateCoupon = async () => {}

  if (isloading) {
    return <LoadingSpinner />
  }



  return (
    <>
      <Helmet>
        <title>{t("Your Cart")}</title>
        <link
          rel='icon'
          type='image/png'
          href={restuarantStyle.logo}
          sizes='16x16'
        />
      </Helmet>
      <div className='w-[98%] mx-auto mt-14'>
        <div className='w-full lg:w-[70%] laptopXL:w-[80%] mx-auto'>
          <CartHeader styles={restuarantStyle} />
          {(!cartItems || cartItems.length === 0) && !isloading ? (
            <div className='h-[40vh] w-full flex items-center justify-center'>
              <div className='w-1/2 mx-auto flex flex-col items-center justify-center gap-6'>
                <h3 className='text-3xl text-center '>
                  {t("Your cart is empty")}
                </h3>
                <button
                  style={{
                    backgroundColor: restuarantStyle?.categoryDetail_cart_color,
                  }}
                  onClick={() => navigate("/")}
                  className={`btn w-1/2  `}
                >
                  {t("Continue Shopping")}
                </button>
              </div>
            </div>
          ) : (
            <Fragment>
              <CartSection cartItems={cartItems} />
              <PaymentSection
                styles={restuarantStyle}
                cartCoupon={cartCoupon}
                appliedCoupon={appliedCoupon}
                tap={tap}
                paymentMethods={paymentMethodsData}
                deliveryTypes={deliveryTypesData}
                cartItems={cartItems}
                fetchCartData={fetchCartData}
                deliveryAddress={address}
                isloading={isloading}
                setIsLoading={setIsLoading}
              />
            </Fragment>
          )}
        </div>
      </div>
    </>
  )
}

export default CartPage
