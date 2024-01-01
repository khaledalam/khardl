import React from "react"
import CartItem from "./CartItem"
import {useSelector} from "react-redux"

const CartSection = ({cartItems}) => {
  const language = useSelector((state) => state.languageMode.languageMode)

  return (
    <div className='border-[var(--primary)] border rounded-lg w-full laptopXL:w-[75%] mx-auto my-5'>
      {cartItems &&
        cartItems.map((cartItem) => (
          <CartItem
            key={cartItem.item_id}
            cartItem={cartItem}
            cartItems={cartItems}
            language={language}
          />
        ))}
    </div>
  )
}

export default CartSection
