import {Fragment, useContext} from "react"
import {FaPlay} from "react-icons/fa"
import {IoMenuOutline} from "react-icons/io5"
import {MenuContext} from "react-flexible-sliding-menu"
import {useSelector} from "react-redux"
import AxiosInstance from "../../../../axios/axios"
import {toast} from "react-toastify"

const Navbar = () => {
  const {toggleMenu} = useContext(MenuContext)
  const restuarantStyle = useSelector((state) => state.restuarantEditorStyle)

  const toggleTheMenu = () => {
    toggleMenu()
  }

  const handleSubmitResStyle = async (e) => {
    e.preventDefault()
    let inputs = {}
    inputs.logo_alignment = restuarantStyle.logo_alignment
    inputs.logo_shape = restuarantStyle.logo_shape
    inputs.banner_shape = restuarantStyle.banner_shape
    inputs.banner_type = restuarantStyle.banner_type
    inputs.banner_background_color = restuarantStyle.banner_background_color
    inputs.category_alignment = restuarantStyle.category_alignment
    inputs.category_shape = restuarantStyle.category_shape
    inputs.category_hover_color = restuarantStyle.category_hover_color
    inputs.categoryDetail_alignmnent = restuarantStyle.categoryDetail_alignmnent
    inputs.categoryDetail_shape = restuarantStyle.categoryDetail_shape
    inputs.categoryDetail_type = restuarantStyle.categoryDetail_type
    inputs.categoryDetail_cart_color = restuarantStyle.categoryDetail_cart_color
    inputs.selectedSocialIcons = restuarantStyle.selectedSocialIcons
    inputs.socialMediaIcons_alignment =
      restuarantStyle.socialMediaIcons_alignment
    inputs.phoneNumber = restuarantStyle.phoneNumber
    inputs.phoneNumber_alignment = restuarantStyle.phoneNumber_alignment
    inputs.page_color = restuarantStyle.page_color
    inputs.page_category_color = restuarantStyle.page_category_color
    inputs.header_color = restuarantStyle.header_color
    inputs.footer_color = restuarantStyle.footer_color
    inputs.price_color = restuarantStyle.price_color
    inputs.text_fontFamily = restuarantStyle.text_fontFamily
    inputs.text_fontWeight = restuarantStyle.text_fontWeight
    inputs.text_fontSize = restuarantStyle.text_fontSize
    inputs.text_alignment = restuarantStyle.text_alignment
    inputs.text_color = restuarantStyle.text_color
    inputs.banner_image = restuarantStyle?.bannerUpload
      ? await fetch(restuarantStyle?.bannerUpload).then((r) => r.blob())
      : ""

    if (
      restuarantStyle?.bannersUpload &&
      restuarantStyle?.bannersUpload.length > 0
    ) {
      const imagePromises = restuarantStyle?.bannersUpload.map(
        async (image) => {
          return await fetch(image).then((r) => r.blob())
        }
      )
      inputs.banner_images = await Promise.all(imagePromises)
    } else {
      inputs.banner_images = ""
    }
    inputs.logo = restuarantStyle?.logoUpload
      ? await fetch(restuarantStyle?.logoUpload).then((r) => r.blob())
      : ""

    try {
      const response = await AxiosInstance.post(`restaurant-style`, inputs, {
        headers: {
          "Content-Type": "multipart/form-data",
        },
      })
      if (response) {
        toast.success(response.data.message)
      }
    } catch (error) {
      console.log(error.response.data.message)
      toast.error(error.response?.data?.message)
    }
  }

  return (
    <Fragment>
      <div className='h-[70px] w-full bg-white flex items-center justify-between px-8'>
        <IoMenuOutline
          size={42}
          className='text-neutral-400'
          onClick={toggleTheMenu}
        />
        <div className='flex items-center gap-4'>
          <button
            onClick={() => window.open("/")}
            className='btn btn-active p-3 bg-neutral-200 hover:bg-neutral-200 active:bg-neutral-200 flex items-center justify-center'
          >
            <FaPlay size={22} />
          </button>
          <button
            onClick={handleSubmitResStyle}
            className='btn btn-active w-[100px] bg-neutral-200 hover:bg-neutral-200 active:bg-neutral-200'
          >
            Save
          </button>
        </div>
      </div>
    </Fragment>
  )
}

export default Navbar
