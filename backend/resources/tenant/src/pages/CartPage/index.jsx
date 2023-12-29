import React from "react"
import CartHeader from "./components/CartHeader"
import CartSection from "./components/CartSection"
import CartColumn from "./components/CartColumn"

const CartPage = () => {
  return (
    <div className='w-full'>
      {/* // TODO:  work on the new cart page  */}
      <div className='w-5/6 mx-auto'>
        <CartHeader />
        <CartSection />
        <div className=''>
          <CartColumn>
            <div className=''></div>
          </CartColumn>
        </div>
        <CartColumn>
          <div className=''></div>
        </CartColumn>
        <div className=''>
          <CartColumn>
            <div className=''></div>
          </CartColumn>
        </div>
      </div>
    </div>
  )
}

export default CartPage
