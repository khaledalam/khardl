import React, {Fragment} from "react"
import cartHeaderImg from "../../../assets/cartBoldIcon.svg"
import {IoMenuOutline} from "react-icons/io5"
import OuterSidebarNav from "../../EditorsPage/Restuarants/components/OuterSidebarNav"

const NavbarRestuarant = () => {
  return (
    <Fragment>
      <div className='w-full bg-white flex flex-row items-center justify-between px-12 py-2'>
        <label
          htmlFor='resNavHome'
          className='w-[40px] h-[40px] drawer-button bg-[#2A6E4F] rounded-lg p-1 flex items-center justify-center'
        >
          <IoMenuOutline size={38} className='text-white' />
        </label>
        <div className='w-[50px] h-[50px] relative flex items-center justify-center'>
          <img src={cartHeaderImg} alt={"cart"} className='' />
          {true && (
            <div className='absolute top-0 right-0'>
              <div className='w-[18px] h-[18px] rounded-full p-1 bg-red-500 flex items-center justify-center'>
                <span className='text-white font-bold text-xs'>0</span>
              </div>
            </div>
          )}
        </div>
      </div>
      <div className='drawer z-50'>
        <input id='resNavHome' type='checkbox' className='drawer-toggle' />
        <div className='drawer-side'>
          <label
            htmlFor='resNavHome'
            aria-label='close sidebar'
            className='drawer-overlay'
          ></label>
          <div className='menu p-4 laptopXL:w-[25%] w-[30%] min-h-full bg-white text-base-content'>
            {/* Sidebar content here */}
            <OuterSidebarNav id={"resNavHome"} />
          </div>
        </div>
      </div>
    </Fragment>
  )
}

export default NavbarRestuarant
