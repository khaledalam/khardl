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

export const RestuarantEditor = () => {
  const dispatch = useDispatch()
  const [categories, setCategories] = useState([])

  const isSidebarCollapse = useSelector(
    (state) => state.restuarantEditorStyle.collapse_sidebar
  )

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
        setCategories(restaurantCategoriesResponse.data?.data)

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

  useEffect(() => {
    fetchCategoriesData().then(() =>
      console.log("fetched categories successfully")
    )
    fetchResStyleData().then(() =>
      console.log("fetched restuarant style successfully")
    )
  }, [])

  return (
    <div className='block'>
      <Navbar />
      <div className='flex bg-white h-[calc(100vh-75px)] w-full transition-all'>
        <div
          className={`transition-all ${
            isSidebarCollapse ? "flex-[0] hidden w-0" : "flex-[18%]"
          } xl:flex-[30%] laptopXL:flex-[25%] overflow--hidden bg-white h-full `}
        >
          <SidebarEditor />
        </div>
        <div
          className={` transition-all ${
            isSidebarCollapse ? "flex-[100%] w-full" : "flex-[82%]"
          } xl:flex-[70%] laptopXL:flex-[75%] overflow-x-hidden bg-neutral-200 h-full overflow-y-scroll hide-scroll`}
        >
          <MainBoardEditor
            categories={categories}
            toggleSidebarCollapse={handleSidebarCollapse}
          />
        </div>
      </div>
    </div>
  )
}
