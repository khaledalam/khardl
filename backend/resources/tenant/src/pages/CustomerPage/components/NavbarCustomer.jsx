import React, {useContext} from "react"
import {IoMenuOutline} from "react-icons/io5"
import {useNavigate} from "react-router-dom"
import cartHeaderImg from "../../../assets/cartBoldIcon.svg"
import {MenuContext} from "react-flexible-sliding-menu"
import {useSelector} from "react-redux"


const NavbarCustomer = () => {
  const navigate = useNavigate()
  const {toggleMenu} = useContext(MenuContext)
  const restaurantStyle = useSelector((state) => state.restuarantEditorStyle)

  const cartItemsCount = useSelector(
    (state) => state.categoryAPI.cartItemsCount
  )
  console.log("cartItemsCount",cartItemsCount)
  return (
    <div className='h-[70px] w-full bg-white flex items-center justify-between px-4 xl:px-8'>
      <IoMenuOutline
        size={42}
        className='text-neutral-400 cursor-pointer  xl:ml-16'
        onClick={toggleMenu}
      />
      <div
        onClick={() => navigate("/cart")}
        className='w-[50px] h-[50px] rounded-lg bg-neutral-200 relative flex items-center justify-center cursor-pointer'
      >
        <img src={cartHeaderImg} alt={"cart"} className='' />
        {cartItemsCount > 0 &&  (
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
