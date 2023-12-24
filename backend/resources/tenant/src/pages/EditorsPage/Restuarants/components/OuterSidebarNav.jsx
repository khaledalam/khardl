import React from "react"
import homeIcon from "../../../../assets/homeIcon.svg"
import shopIcon from "../../../../assets/shopIcon.svg"
import deliveryIcon from "../../../../assets/bikeDeliveryIcon.svg"
import {IoMenuOutline} from "react-icons/io5"
import {FaLongArrowAltRight} from "react-icons/fa"

const OuterSidebarNav = ({id}) => {
  return (
    <div className='w-full h-[100vh] flex flex-col items-center justify-between'>
      <label htmlFor={id ? id : "my-drawer"} aria-label='close sidebar'>
        <IoMenuOutline size={42} className='text-neutral-400' />
      </label>
      <div className='w-full h-full flex flex-col items-center justify-center gap-6'>
        <div className='w-[90%] mx-auto flex flex-row gap-3 bg-neutral-100 rounded-lg border border-[#C0D123] items-center '>
          <div className='w-[60px] h-[50px] rounded-xl p-2  flex items-center justify-center'>
            <img src={homeIcon} alt='home' />
          </div>
          <h3 className=''>Home</h3>
        </div>
        <div className='w-[90%] mx-auto flex flex-row gap-3 bg-neutral-100 rounded-lg border border-[#C0D123] items-center '>
          <div className='w-[60px] h-[50px] rounded-xl p-2  flex items-center justify-center'>
            <img src={shopIcon} alt='shopping' />
          </div>
          <h3 className=''>Pick up</h3>
        </div>
        <div className='w-[90%] mx-auto flex flex-row gap-3 bg-neutral-100 rounded-lg border border-[#C0D123] items-center '>
          <div className='w-[60px] h-[50px] rounded-xl p-2  flex items-center justify-center'>
            <img src={deliveryIcon} alt='deliveryIcon' />
          </div>
          <h3 className=''>Delivery</h3>
        </div>
        <div
          role='button'
          className='w-[90%] mx-auto btn bg-neutral-100 hover:bg-neutral-100 active:bg-neutral-100 font-normal border border-[#C0D123]'
        >
          Login as Customer
        </div>
        <div
          role='button'
          className='w-[90%] mx-auto btn bg-neutral-100 hover:bg-neutral-100 active:bg-neutral-100 font-normal border border-[#C0D123]'
        >
          Login as Management Area{" "}
        </div>
        <div
          role='button'
          className='w-[90%] mx-auto btn bg-neutral-100 hover:bg-neutral-100 active:bg-neutral-100 font-normal !border !border-[#C0D123]'
        >
          AR{" "}
        </div>
      </div>
      <div className='w-full mb-20'>
        <div
          role='button'
          className='w-[90%] mx-auto btn bg-neutral-100 hover:bg-neutral-100 active:bg-neutral-100 font-normal border border-[#C0D123] flex items-center gap-3'
        >
          <span className=''>Logout </span>
          <span>
            <FaLongArrowAltRight size={20} />
          </span>
        </div>
      </div>
    </div>
  )
}

export default OuterSidebarNav
