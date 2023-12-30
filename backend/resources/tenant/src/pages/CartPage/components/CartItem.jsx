import React, {useCallback, useState} from "react"
import {BiMinusCircle} from "react-icons/bi"
import {IoAddCircleOutline, IoClose} from "react-icons/io5"
import Feedback from "./Feedback"
import AxiosInstance from "../../../axios/axios"
import {useDispatch} from "react-redux"
import {setCartItemsData} from "../../../redux/NewEditor/categoryAPISlice"
import {toast} from "react-toastify"
import {useTranslation} from "react-i18next"

const CartItem = ({cartItem, cartItems, language}) => {
  const [feedback, setFeedback] = useState(
    cartItem.notes !== null ? cartItem.notes : ""
  )
  const dispatch = useDispatch()
  const {t} = useTranslation()

  const fetchCartData = async () => {
    try {
      const cartResponse = await AxiosInstance.get(`carts`)

      console.log("cart >>>", cartResponse.data)
      if (cartResponse.data) {
        dispatch(setCartItemsData(cartResponse.data?.data.items))
      }
    } catch (error) {
      console.log(error)
    }
  }

  const incrementQty = useCallback(async (cartId, branchId) => {
    try {
      await AxiosInstance.post(`/carts`, {
        item_id: cartId,
        quantity: cartItem.quantity + 1,
        branch_id: branchId,
        notes: feedback,
      })
        .then((e) => {
          toast.success(`${t("Item quantity updated")}`)
          console.log("successfully", e)
        })
        .finally(async () => {
          await fetchCartData().then((r) => null)
        })
    } catch (error) {
      console.log("error: ", error)
    }
  }, [])

  const decrementQty = useCallback(async (cartId, branchId) => {
    try {
      await AxiosInstance.post(`/carts`, {
        item_id: cartId,
        quantity: cartItem.quantity - 1,
        branch_id: branchId,
        notes: feedback,
      })
        .then((e) => {
          toast.success(`${t("Item quantity updated")}`)
          console.log("successfully", e)
        })
        .finally(async () => {
          await fetchCartData().then((r) => null)
        })
    } catch (error) {
      console.log("error: ", error)
    }
  }, [])

  const handleRemoveItem = async (cartItemId) => {
    try {
      const response = await AxiosInstance.delete(`/carts/` + cartItemId, {})
      if (response?.data) {
        const updatedCart = cartItems.filter(
          (item) => item.item_id !== cartItemId
        )
        dispatch(setCartItemsData(updatedCart))
        toast.success(`${t("Item removed from cart")}`)
      }
    } catch (error) {
      console.log("err removing item from cart", error)
    }
  }

  return (
    <div className='h-[200px] laptopXL:h-[220px] w-full flex items-center gap-4 p-5 border-b border-b-[var(--primary)]'>
      <div className='w-[20%] h-full flex items-start justify-center'>
        <div className='flex h-full flex-col justify-between'>
          <div className='w-[120px] laptopXL:w-[140px] h-[120px] laptopXL:h-[140px] p-2 rounded-full bg-neutral-100'>
            <img
              src={cartItem?.item?.photo}
              alt=''
              className='w-full h-full object-cover rounded-full'
            />
          </div>
          <div className='flex items-center justify-between w-[120px] cursor-pointer laptopXL:w-[150px]'>
            <BiMinusCircle
              size={25}
              onClick={() =>
                decrementQty(cartItem.item_id, cartItem.item.branch_id)
              }
            />
            <span>{cartItem.quantity}</span>
            <IoAddCircleOutline
              size={25}
              onClick={() =>
                incrementQty(cartItem.item_id, cartItem.item.branch_id)
              }
            />
          </div>
        </div>
      </div>
      <div className='w-[80%] flex flex-col h-full  justify-between'>
        <h3 className='text-lg'>
          {language === "en" ? cartItem.item.name.en : cartItem.item.name.ar}
        </h3>
        <p className=''>
          {t("SAR")} {cartItem.price}{" "}
          {cartItem.options_price > 0 &&
            ` + ${cartItem.options_price} ${t("SAR")}  ${t("Options")}`}
        </p>
        <div className='flex items-center justify-between'>
          <div className='w-5/6'>
            <Feedback
              value={feedback}
              placeholder={"Item notes : e.g. Please make the meat medium cook"}
              onChange={(e) => setFeedback(e.target.value)}
            />
          </div>
          <div
            onClick={() => handleRemoveItem(cartItem.item_id)}
            className='bg-[var(--primary)] flex items-center justify-center cursor-pointer rounded-lg w-[40px] h-[35px]'
          >
            <IoClose size={25} className='cursor-pointer' />
          </div>
        </div>
        <h3 className='font-bold'>
          Total: SAR {cartItem.price * cartItem.quantity}
        </h3>
      </div>
    </div>
  )
}

export default CartItem
