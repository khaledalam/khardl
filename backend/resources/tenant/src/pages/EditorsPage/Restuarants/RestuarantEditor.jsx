import React, {useEffect, useState} from "react"
import Navbar from "./components/Navbar"
import SidebarEditor from "./components/SidebarEditor"
import MainBoardEditor from "./components/MainBoardEditor"
import AxiosInstance from "../../../axios/axios"
import {useDispatch, useSelector} from "react-redux"
import {changeStyleDataRestaurant} from "../../../redux/editor/styleDataRestaurantSlice"
import {
  changeRestuarantEditorStyle,
  setSidebarCollapse,
} from "../../../redux/NewEditor/restuarantEditorSlice"
import {
  getCartItemsCount,
  setCategoriesAPI,
} from "../../../redux/NewEditor/categoryAPISlice"
import HeaderEdit from "./components/HeaderEdit"

export const RestuarantEditor = () => {
  const dispatch = useDispatch()
  const categories = useSelector((state) => state.categoryAPI.categories)

  const isSidebarCollapse = useSelector(
    (state) => state.restuarantEditorStyle.collapse_sidebar
  )
  const restaurantStyle = useSelector((state) => state.restuarantEditorStyle)
  const template = useSelector((state) => state.restuarantEditorStyle.template)

  const handleSidebarCollapse = () => {
    dispatch(setSidebarCollapse(!isSidebarCollapse))
  }

  const fetchResStyleData = async () => {
    try {
      const restaurantStyleResponse = await AxiosInstance.get(
        `restaurant-style`
      )

      if (restaurantStyleResponse.data) {
        dispatch(changeStyleDataRestaurant(restaurantStyleResponse.data?.data))
        dispatch(
          changeRestuarantEditorStyle(restaurantStyleResponse.data?.data)
        )
      }
    } catch (error) {
      // toast.error(`${t('Failed to send verification code')}`)
      console.log(error)
    }
  }
  let branch_id = localStorage.getItem("selected_branch_id")

  const fetchCategoriesData = async () => {
    try {
      const restaurantCategoriesResponse = await AxiosInstance.get(
        `categories?items&user&branch&selected_branch_id=${branch_id}`
      )

      console.log(
        "editor rest restaurantCategoriesResponse >>>",
        restaurantCategoriesResponse.data
      )
      if (restaurantCategoriesResponse.data) {
        dispatch(setCategoriesAPI(restaurantCategoriesResponse.data?.data))

        console.log(">> branch_id >>", branch_id)

        if (!branch_id) {
          branch_id = restaurantCategoriesResponse.data?.data[0]?.branch?.id
          localStorage.setItem("selected_branch_id", branch_id)
        }
      }
    } catch (error) {
      // toast.error(`${t('Failed to send verification code')}`)
      console.log(error)
    }
  }
  const fetchCartData = async () => {
    try {
      const cartResponse = await AxiosInstance.get(`carts`)
      if (cartResponse.data) {
        dispatch(getCartItemsCount(cartResponse.data?.data?.items?.length))
      }
    } catch (error) {
      // toast.error(`${t('Failed to send verification code')}`)
      console.log(error)
    }
  }

  useEffect(() => {
    fetchCategoriesData().then(() =>
      console.log("fetched categories successfully")
    )
    fetchResStyleData().then(() =>
      console.log("fetched restuarant style successfully")
    )
    fetchCartData().then(() => {
      console.log("fetched cart items count successfully")
    })
  }, [])

  return (
    <div className='block'>
      <Navbar toggleSidebarCollapse={handleSidebarCollapse} />
      <div className='flex bg-white h-[calc(100vh-75px)] w-full transition-all hide-scroll'>
        <div
          className={`transition-all ${
            isSidebarCollapse ? "flex-[0] hidden w-0" : "flex-[18%]"
          } xl:flex-[30%] laptopXL:flex-[25%] overflow-x-hidden bg-white h-full `}
        >
          <SidebarEditor />
        </div>
        <div
          className={` transition-all ${
            isSidebarCollapse ? "flex-[100%] w-full" : "flex-[82%]"
          } xl:flex-[70%] laptopXL:flex-[75%] overflow-x-hidden bg-neutral-200`}
        >
          {template === "template-1" && (
            <div className='w-full  flex flex-col gap-2'>
              {restaurantStyle?.headerPosition === "fixed" && (
                <div className='p-2'>
                  <HeaderEdit restaurantStyle={restaurantStyle} />
                </div>
              )}
              <div className='h-[calc(100vh-75px)] overflow-y-scroll hide-scroll'>
                <MainBoardEditor categories={categories} />
              </div>
            </div>
          )}
        </div>
      </div>
    </div>
  )
}
