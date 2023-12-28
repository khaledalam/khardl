import React, {useEffect, useState} from "react"
import NavbarRestuarant from "./components/Navbar"
import Herosection from "./components/Herosection"
import ProductSection from "./components/ProductSection"
import FooterRestuarant from "./components/Footer"
import AxiosInstance from "../../axios/axios"
import {useDispatch, useSelector} from "react-redux"
import {changeRestuarantEditorStyle} from "../../redux/NewEditor/restuarantEditorSlice"

export const RestuarantHomePage = () => {
  const dispatch = useDispatch()
  const [categories, setCategories] = useState([])
  const restaurantStyle = useSelector((state) => state.restuarantEditorStyle)

  let branch_id = localStorage.getItem("selected_branch_id")
  // let branch_id = 2

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
      AxiosInstance.get(`restaurant-style`).then((response) =>
        dispatch(changeRestuarantEditorStyle(response.data?.data))
      )
    } catch (error) {
      // toast.error(`${t('Failed to send verification code')}`)
      console.log(error)
    }
  }

  useEffect(() => {
    fetchCategoriesData().then((result) => {
      console.log("fetched restuarant style successfully")
    })

    fetchResStyleData()
  }, [])

  console.log("categories fetched", categories)

  const categoriesForBranch = categories.filter(
    (category) => category.branch.id === branch_id
  )

  return (
    <div style={{backgroundColor: restaurantStyle?.page_color}}>
      <NavbarRestuarant />
      <Herosection alignment={"center"} categories={categories} />
      {/* <ProductSection alignment={"center"} categories={categories} /> */}
      {categories && categories.length > 0 && (
        <ProductSection alignment={"center"} categories={categories} />
      )}
      <FooterRestuarant />
    </div>
  )
}
