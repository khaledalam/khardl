import React, {useEffect, useState} from "react"
import Herosection from "./components/Herosection"
import ProductSection from "./components/ProductSection"
import FooterRestuarant from "./components/Footer"
import AxiosInstance from "../../axios/axios"
import {useDispatch, useSelector} from "react-redux"
import {changeRestuarantEditorStyle} from "../../redux/NewEditor/restuarantEditorSlice"
import {
  getCartItemsCount,
  setCategoriesAPI,
} from "../../redux/NewEditor/categoryAPISlice"
import NavbarRestuarant from "./components/NavbarRestuarant"

export const RestuarantHomePage = () => {
  const dispatch = useDispatch()
  const [isMobile, setIsMobile] = useState(false)
  const categories = useSelector((state) => state.categoryAPI.categories)

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
    const isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent)

    setIsMobile(isMobile)
  }, [])

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
    fetchCategoriesData().then(() => {
      console.log("fetched restuarant style successfully")
    })

    fetchResStyleData()
    fetchCartData().then(() => {
      console.log("fetched cart item count successfully")
    })
  }, [])

  if (!restaurantStyle) {
    return
  }

  console.log("categories fetched", categories)

  const categoriesForBranch = categories.filter(
    (category) => category.branch.id === branch_id
  )

  return (
    <div
      style={{
        backgroundColor: restaurantStyle?.page_color,
        fontFamily: restaurantStyle.text_fontFamily,
      }}
    >
      <NavbarRestuarant />
      <Herosection isMobile={isMobile} categories={categories} />
      {/* <ProductSection alignment={"center"} categories={categories} /> */}
      <ProductSection
        alignment={"center"}
        categories={categories}
        isMobile={isMobile}
      />
      <FooterRestuarant />
    </div>
  )
}
