import React, {Fragment, useContext} from "react"
import cartHeaderImg from "../../../assets/cartBoldIcon.svg"
import {IoMenuOutline} from "react-icons/io5"
import {MenuContext} from "react-flexible-sliding-menu"
import {useSelector} from "react-redux"

const NavbarRestuarant = () => {
  const {toggleMenu} = useContext(MenuContext)
  const restaurantStyle = useSelector((state) => state.restuarantEditorStyle)
  const toggleTheMenu = () => {
    toggleMenu()
  }
  const {header_color} = restaurantStyle
  console.log("restuarant styles header", restaurantStyle)
  return (
    <Fragment>
      <div
        style={{backgroundColor: header_color ? header_color : "white"}}
        className='w-full  flex flex-row items-center justify-between px-12 py-2'
      >
        <div
          onClick={toggleTheMenu}
          className='w-[40px] h-[40px]  bg-[#2A6E4F] rounded-lg p-1 flex items-center justify-center'
        >
          <IoMenuOutline size={38} className='text-white' />
        </div>
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
    </Fragment>
  )
}

export default NavbarRestuarant
