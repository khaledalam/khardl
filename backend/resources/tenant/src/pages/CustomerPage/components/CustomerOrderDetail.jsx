import React from "react"
import {BsArrowRight} from "react-icons/bs"
import imgBurger from "../../../assets/burger.png"

const CustomerOrderDetail = () => {
  return (
    <div className='p-5'>
      <div className='flex items-center gap-3'>
        <BsArrowRight />
        <h3 className=''>Display Order</h3>
      </div>
      <div className='w-full bg-red-500 pb-8 rounded-t-[80px]'>
        <div className='w-full rounded-t-[80px] flex flex-col items-center justify-center'>
          <div className='w-[216px] h-[182px] mt-[-5.8rem] mx-auto bg-neutral-100 rounded-full p-1'>
            <img
              src={imgBurger}
              alt='product'
              className='w-full h-full object-cover rounded-full'
            />
          </div>
        </div>
      </div>
    </div>
  )
}

export default CustomerOrderDetail
