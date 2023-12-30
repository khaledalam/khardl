import React, {useCallback, useEffect, useState} from "react"
import CartHeader from "./components/CartHeader"
import CartSection from "./components/CartSection"
import PaymentSection from "./components/PaymentSection"
import LoadingSpinner from "./components/LoadingSpinner"
import AxiosInstance from "../../axios/axios"
import {useTranslation} from "react-i18next"
import {useDispatch, useSelector} from "react-redux"
import {useNavigate} from "react-router-dom"
import {toast} from "react-toastify"
import {setCartItemsData} from "../../redux/NewEditor/categoryAPISlice"

const CartPage = () => {
  const [isloading, setIsLoading] = useState(false)
  const [paymentMethodsData, setPaymentMethodsData] = useState(null)
  const [address, setAddress] = useState(null)
  const [deliveryTypesData, setDeliveryTypesData] = useState(null)

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
        dispatch(setCartItemsData(cartResponse.data?.data.items))
        setPaymentMethodsData(cartResponse.data?.data?.payment_methods)
        setDeliveryTypesData(cartResponse.data?.data?.delivery_types)
        setAddress(cartResponse.data?.data?.address ?? t("N/A"))
      }
    } catch (error) {
      // toast.error(`${t('Failed to send verification code')}`)
      console.log(error)
    } finally {
      setIsLoading(false)
    }
  }

  useEffect(() => {
    fetchCartData().then((r) => null)
  }, [])

  const handleValidateCoupon = async () => {}

  if (isloading) {
    return <LoadingSpinner />
  }

  console.log("cartItems", cartItems)
  console.log("address", address)

  return (
    <div className='w-full mt-14'>
      {/* // TODO:  work on the new cart page  */}
      <div className='w-[70%] laptopXL:w-[80%] mx-auto'>
        <CartHeader />
        <CartSection cartItems={cartItems} />
        <PaymentSection
          paymentMethods={paymentMethodsData}
          deliveryTypes={deliveryTypesData}
          cartItems={cartItems}
          fetchCartData={fetchCartData}
          deliveryAddress={address}
          isloading={isloading}
          setIsLoading={setIsLoading}
        />
      </div>
    </div>
  )
}

export default CartPage
