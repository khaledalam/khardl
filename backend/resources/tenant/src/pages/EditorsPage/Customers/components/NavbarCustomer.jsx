import React from "react"
import {IoMenuOutline} from "react-icons/io5"
import {useNavigate} from "react-router-dom"
import cartHeaderImg from "../../../../assets/cartBoldIcon.svg"

const NavbarCustomer = () => {
  const navigate = useNavigate()
  const cartItemsCount = 0
  return (
    <div className='h-[70px] w-full bg-white flex items-center justify-between px-8'>
      <IoMenuOutline
        size={42}
        className='text-neutral-400 cursor-pointer ml-16'
        // onClick={toggleSidebarCollapse}
      />
      <div
        onClick={() => navigate("/cart")}
        className='w-[50px] h-[50px] rounded-lg bg-neutral-200 relative flex items-center justify-center cursor-pointer'
      >
        <img src={cartHeaderImg} alt={"cart"} className='' />
        {true && (
          <div className='absolute top-[-0.5rem] right-[-0.5rem]'>
            <div className='w-[20px] h-[20px] rounded-full p-1 bg-red-500 flex items-center justify-center'>
              <span className='text-white font-bold text-xs'>
                {cartItemsCount}
              </span>
            </div>
          </div>
        )}
      </div>
    </div>
  )
}

export default NavbarCustomer
