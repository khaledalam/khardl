import React from "react"
import BigCart from "../../../assets/cartLgIcon.svg"

const CartHeader = () => {
  return (
    <div className='w-full laptopXL:w-[75%] mx-auto h-[85px] rounded-lg bg-[var(--primary)] flex items-center justify-center'>
      <div className='flex items-center gap-4'>
        <img src={BigCart} alt='cart' />
        <h3 className='text-2xl'>Your Cart</h3>
      </div>
    </div>
  )
}

export default CartHeader
