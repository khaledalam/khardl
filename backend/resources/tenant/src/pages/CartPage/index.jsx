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
  const [loading, setLoading] = useState(false)
  const [paymentMethod, setPaymentMethod] = useState(null)
  const [paymentMethodsData, setPaymentMethodsData] = useState(null)
  const [deliveryType, setDeliveryType] = useState(null)
  const [address, setAddress] = useState(null)
  const [deliveryTypesData, setDeliveryTypesData] = useState(null)
  const [notes, setNotes] = useState("")
  const [couponCode, setCouponCode] = useState("")
  const [couponDiscountValue, setCouponDiscountValue] = useState(0)

  const [deliveryCost, setDeliveryCost] = useState(0)

  const navigate = useNavigate()
  const dispatch = useDispatch()
  const {t} = useTranslation()
  const language = useSelector((state) => state.languageMode.languageMode)
  const cartItems = useSelector((state) => state.categoryAPI.cartItemsData)
  const isLoggedIn = useSelector((state) => state.auth.isLoggedIn)

  const fetchCartData = async () => {
    if (loading) return
    setLoading(true)

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
      setLoading(false)
    }
  }

  useEffect(() => {
    fetchCartData().then((r) => null)
  }, [])

  const handlePaymentMethodChange = (method) => {
    setPaymentMethod(method.name)
  }

  const handleDeliveryTypeChange = async (type) => {
    if (loading) return
    setLoading(true)

    console.log(type?.cost)
    setDeliveryType(type.name)
    setDeliveryCost(type?.cost)

    setLoading(false)
  }

  const handlePlaceOrder = async () => {
    if (window.confirm(t("Are You sure you want to place the order?"))) {
      if (loading) return
      setLoading(true)

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
        setLoading(false)
      } catch (error) {
        toast.error(error.response.data.message)
        setLoading(false)
      }
    }
  }

  const getTotalPrice = () => {
    return (
      parseFloat(
        cartItems.reduce(
          (total, item) =>
            total + (item.price + item.options_price) * item.quantity,
          0
        )
      ) +
      deliveryCost / 100
    )
  }

  const handleEmptyCart = async () => {
    if (loading) return

    if (!window.confirm(t("Are you sure to empty cart items?"))) {
      return
    }

    try {
      setLoading(true)
      await AxiosInstance.delete(`/carts/trash`, {}).finally(async () => {
        await fetchCartData().then((r) => null)
      })
    } catch (error) {}
    setLoading(false)
  }

  if (!isLoggedIn) {
    window.confirm("You need to login first")
    navigate("/login")
    return
  }

  const handleValidateCoupon = async () => {}

  if (loading) {
    return <LoadingSpinner />
  }

  console.log("cartItems", cartItems)

  return (
    <div className='w-full mt-14'>
      {/* // TODO:  work on the new cart page  */}
      <div className='w-[70%] laptopXL:w-[80%] mx-auto'>
        <CartHeader />
        <CartSection cartItems={cartItems} />
        <PaymentSection />
      </div>
    </div>
  )
}

export default CartPage
