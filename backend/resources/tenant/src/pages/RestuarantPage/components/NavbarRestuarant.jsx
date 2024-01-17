import React, {Fragment, useContext, useEffect} from "react"
import cartHeaderImg from "../../../assets/cartBoldIcon.svg"
import {IoMenuOutline} from "react-icons/io5"
import {MenuContext} from "react-flexible-sliding-menu"
import {useSelector} from "react-redux"
import {useNavigate} from "react-router-dom"
import {toast} from "react-toastify"
import imgLogo from "../../../assets/khardl_Logo.png"
import { useTranslation } from "react-i18next"
const NavbarRestuarant = () => {
  const {toggleMenu} = useContext(MenuContext)
  const {t} = useTranslation()
  const navigate = useNavigate()
  const restaurantStyle = useSelector((state) => state.restuarantEditorStyle)
  const toggleTheMenu = () => {
    toggleMenu()
  }
  const cartItemsCount = useSelector(
    (state) => state.categoryAPI.cartItemsCount
  )
  const {header_color, headerPosition} = restaurantStyle
  console.log("restaurantStyle", restaurantStyle)
  useEffect(() => {
    const checkOrderQueryParam = () => {
      const queryParams = new URLSearchParams(window.location.search)

      if (queryParams.has("message")) {
        if (queryParams.get("status") == 1) {
          toast.success(queryParams.get("message"))
        } else {
          toast.error(queryParams.get("message"))
        }
      } else {
      }
    }
    checkOrderQueryParam()
  }, [])
  return (
    <Fragment>
      <div
        style={{
          backgroundColor: header_color ? header_color : "white",
          position: headerPosition,
          top: 0,
          left: 0,
          right: 0,
          width: "100%",
        }}
        className='w-full  flex flex-row items-center justify-between px-7 xl:px-12 py-2'
      >
        <div
          onClick={toggleTheMenu}
          className='w-[40px] h-[40px]  bg-[#2A6E4F] rounded-lg cursor-pointer p-1 flex items-center justify-center'
        >
          <IoMenuOutline size={38} className='text-white' />
        </div>
        <div
          className={` w-full ${
            restaurantStyle?.logo_alignment === t("Center") ||
            restaurantStyle?.logo_alignment === "center"
              ? " flex items-center justify-center"
              : restaurantStyle?.logo_alignment === t("Left") ||
                restaurantStyle?.logo_alignment === "left"
              ? "items-center justify-start"
              : "items-center justify-end"
          }`}
        >
          <div
            className={`w-[80px] h-[80px]  ${
              restaurantStyle?.logo_shape === "rounded" ||
              restaurantStyle?.logo_shape === t("Rounded")
                ? "rounded-full"
                : restaurantStyle?.logo_shape === "sharp" ||
                  restaurantStyle?.logo_shape === t("Sharp")
                ? "rounded-none"
                : ""
            }`}
          >
            <img
              src={restaurantStyle?.logo ? restaurantStyle.logo : imgLogo}
              alt='logo'
              className={`w-full h-full object-cover ${
                restaurantStyle?.logo_shape === t("Sharp") ? "" : "rounded-full"
              }`}
            />
          </div>
        </div>
        
        <div
          onClick={() => navigate("/cart")}
          className='w-[50px] h-[50px] relative flex items-center justify-center cursor-pointer'
        >
          
          <img src={cartHeaderImg} alt={"cart"} className='' />
          {cartItemsCount > 0 && (
            <div className='absolute top-0 right-0'>
              <div className='w-[18px] h-[18px] rounded-full p-1 bg-red-500 flex items-center justify-center'>
                <span className='text-white font-bold text-xs'>
                  {cartItemsCount}
                </span>
              </div>
            </div>
          )}
        </div>
      </div>
    </Fragment>
  )
}

export default NavbarRestuarant
