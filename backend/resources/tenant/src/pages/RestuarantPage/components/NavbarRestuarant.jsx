import React, {Fragment, useContext, useEffect,useState} from "react"
import cartHeaderImg from "../../../assets/cartBoldIcon.svg"
import {IoMenuOutline} from "react-icons/io5"
import {MenuContext} from "react-flexible-sliding-menu"
import {useDispatch,useSelector} from "react-redux"
import {useNavigate,useSearchParams} from "react-router-dom"
import {toast} from "react-toastify"
import imgLogo from "../../../assets/khardl_Logo.png"
import { useTranslation } from "react-i18next"
import {getCartItemsCount,} from "../../../redux/NewEditor/categoryAPISlice"
import AxiosInstance from "../../../axios/axios"


const NavbarRestuarant = () => {
  const {toggleMenu} = useContext(MenuContext)
  const {t} = useTranslation()
  const navigate = useNavigate()
  const dispatch = useDispatch()

  const restaurantStyle = useSelector((state) => state.restuarantEditorStyle)
  const [searchParams, setSearchParams] = useSearchParams();
  const [cartItemsCount, setCartItemsCount] = useState(0);

  const toggleTheMenu = () => {
    toggleMenu()
  }
  // const cartItemsCount = useSelector(
  //   (state) => state.categoryAPI.cartItemsCount
  // )
  const fetchCartData = async () => {
    try {
      const cartResponse = await AxiosInstance.get(`carts`)
      if (cartResponse.data) {
        const count = cartResponse.data?.data?.items?.length || 0;
        dispatch(getCartItemsCount(count));
        setCartItemsCount(count);
      }
    } catch (error) {
      // toast.error(`${t('Failed to send verification code')}`)
      console.log(error)
    }
  }
  useEffect(() => {
  
    fetchCartData().then(() => {
      console.log("fetched cart items count successfully")
    })
  }, [])
  const {header_color, headerPosition, categoryDetail_cart_color} = restaurantStyle
  console.log("restaurantStyle", restaurantStyle)
  useEffect(() => {
    const checkOrderQueryParam = () => {


      if (searchParams.has("message")) {
        if (searchParams.get("status") == 1) {
          toast.success(searchParams.get("message"))
        } else {
          toast.error(searchParams.get("message"))
        }
        searchParams.delete('message');
        searchParams.delete('status');
        setSearchParams(searchParams);
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
          style={{backgroundColor: categoryDetail_cart_color}}
          className='w-[40px] h-[40px]   rounded-lg cursor-pointer p-1 flex items-center justify-center'
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
