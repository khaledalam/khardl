import React, {useEffect, useLayoutEffect, useState} from "react"
import NavbarRestuarant from "./components/Navbar"
import Herosection from "./components/Herosection"
import ProductSection from "./components/ProductSection"
import FooterRestuarant from "./components/Footer"
import AxiosInstance from "../../axios/axios"
import {useDispatch, useSelector} from "react-redux"
import {changeStyleDataRestaurant} from "../../redux/editor/styleDataRestaurantSlice"

export const RestuarantHomePage = () => {
  const dispatch = useDispatch()
  const [categories, setCategories] = useState([])

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
  const fetchResStyleData = async () => {
    try {
      const restaurantStyleResponse = await AxiosInstance.get(
        `restaurant-style`
      )

      if (restaurantStyleResponse.data) {
        dispatch(changeStyleDataRestaurant(restaurantStyleResponse.data?.data))
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

  console.log("categories fetched", categories)

  const categoriesForBranch = categories.filter(
    (category) => category.branch.id === branch_id
  )

  return (
    <div>
      <NavbarRestuarant />
      <Herosection alignment={"center"} categories={categories} />
      <ProductSection alignment={"center"} categories={categories} />
      <FooterRestuarant />
    </div>
  )
}
