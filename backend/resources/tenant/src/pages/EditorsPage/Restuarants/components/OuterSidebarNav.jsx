import React from "react"
import homeIcon from "../../../../assets/homeIcon.svg"
import shopIcon from "../../../../assets/shopIcon.svg"
import deliveryIcon from "../../../../assets/bikeDeliveryIcon.svg"
import {IoMenuOutline} from "react-icons/io5"

const OuterSidebarNav = () => {
  return (
    <div className='w-full h-full flex flex-col items-center justify-center gap-16'>
      <label htmlFor='my-drawer' aria-label='close sidebar'>
        <IoMenuOutline size={42} className='text-neutral-400' />
      </label>
      <div className='w-full h-full flex flex-col items-center justify-center gap-6'>
        <div className='flex flex-col gap-3 items-center justify-center'>
          <div className='w-[60px] h-[50px] rounded-xl p-2 bg-neutral-100 flex items-center justify-center'>
            <img src={homeIcon} alt='home' />
          </div>
          <h3 className=''>Home</h3>
        </div>
        <div className='flex flex-col gap-3 items-center justify-center'>
          <div className='w-[60px] h-[50px] rounded-xl p-2 bg-neutral-100 flex items-center justify-center'>
            <img src={shopIcon} alt='shopping' />
          </div>
          <h3 className=''>Shopping</h3>
        </div>
        <div className='flex flex-col gap-3 items-center justify-center'>
          <div className='w-[60px] h-[50px] rounded-xl p-2 bg-neutral-100 flex items-center justify-center'>
            <img src={deliveryIcon} alt='deliveryIcon' />
          </div>
          <h3 className=''>Delivery</h3>
        </div>
        <button className='btn bg-neutral-100 hover:bg-neutral-100 active:bg-neutral-100'>
          Logout
        </button>
        <button className='btn bg-neutral-100 hover:bg-neutral-100 active:bg-neutral-100'>
          Language
        </button>
      </div>
    </div>
  )
}

export default OuterSidebarNav
