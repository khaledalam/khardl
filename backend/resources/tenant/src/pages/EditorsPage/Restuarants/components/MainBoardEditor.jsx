import React, {Fragment, useContext, useEffect, useState} from "react"
import {useNavigate} from "react-router-dom"
import cartHeaderImg from "../../../../assets/cartBoldIcon.svg"
import ImgPlaceholder from "../../../../assets/imgPlaceholder.png"
import bannerPlaceholder from "../../../../assets/banner-placeholder.jpg"
import {IoCloseOutline, IoMenuOutline} from "react-icons/io5"
import CategoryItem from "./CategoryItem"
import ProductItem from "./ProductItem"
import {useSelector, useDispatch} from "react-redux"
import {MenuContext} from "react-flexible-sliding-menu"
import Slider from "./Slider"
import {selectedCategoryAPI} from "../../../../redux/NewEditor/categoryAPISlice"
import {
  logoUpload,
  setBannerUpload,
} from "../../../../redux/NewEditor/restuarantEditorSlice"
import {useTranslation} from "react-i18next"
import HeaderEdit from "./HeaderEdit"

const MainBoardEditor = ({categories}) => {
  const restuarantEditorStyle = useSelector(
    (state) => state.restuarantEditorStyle
  )
  const {t} = useTranslation()
  const language = useSelector((state) => state.languageMode.languageMode)

  const dispatch = useDispatch()
  const navigate = useNavigate()
  const {toggleMenu} = useContext(MenuContext)

  const {
    page_color,
    page_category_color,
    product_background_color,
    category_hover_color,
    category_alignment,
    category_shape,

    categoryDetail_cart_color,
    categoryDetail_type,
    categoryDetail_alignment,
    categoryDetail_shape,

    price_color,
    logo,
    banner_image,
    banner_images,
    header_color,
    banner_background_color,
    footer_color,
    headerPosition,
    logo_alignment,
    logo_shape,
    banner_type,
    banner_shape,
    text_fontFamily,
    text_fontWeight,
    text_fontSize,
    text_alignment,
    phoneNumber,
    phoneNumber_alignment,
    socialMediaIcons_alignment,
    selectedSocialIcons,
    text_color,
  } = restuarantEditorStyle
  console.log("restuarantEditorStyle", restuarantEditorStyle)

  const selectedCategory = useSelector(
    (state) => state.categoryAPI.selected_category
  )
  const cartItemsCount = useSelector(
    (state) => state.categoryAPI.cartItemsCount
  )
  const uploadLogo = useSelector(
    (state) => state.restuarantEditorStyle.logoUpload
  )

  const [uploadSingleBanner, setUploadSingleBanner] = useState(null)

  const handleLogoUpload = (event) => {
    event.preventDefault()

    const selectedLogo = event.target.files[0]
    if (selectedLogo) {
      dispatch(logoUpload(URL.createObjectURL(selectedLogo)))
    }
  }

  const handleBannerUpload = (event) => {
    event.preventDefault()

    const selectedBanner = event.target.files[0]

    if (selectedBanner) {
      setUploadSingleBanner(URL.createObjectURL(selectedBanner))
      dispatch(setBannerUpload(URL.createObjectURL(selectedBanner)))
    }
  }

  useEffect(() => {
    if (language !== "en") {
      if (categories && categories.length > 0) {
        dispatch(
          selectedCategoryAPI({
            name: categories[0]?.name,
            id: categories && categories[0]?.id,
          })
        )
      }
    } else {
      dispatch(
        selectedCategoryAPI({
          name: categories[0]?.name,
          id: categories && categories[0]?.id,
        })
      )
    }
  }, [language, dispatch, categories])

  const clearLogo = () => {
    dispatch(logoUpload(null))
  }
  const clearBanner = () => {
    setUploadSingleBanner(null)
    dispatch(setBannerUpload(null))
  }

  const categoriesPlaceHolders = [
    {
      id: 1,
      name: "category 1",
      photo: ImgPlaceholder,
    },
    {
      id: 2,
      name: "category 2",
      photo: ImgPlaceholder,
    },
    {
      id: 3,
      name: "category 3",
      photo: ImgPlaceholder,
    },
    {
      id: 4,
      name: "category 2",
      photo: ImgPlaceholder,
    },
    {
      id: 5,
      name: "category 3",
      photo: ImgPlaceholder,
    },
  ]
  const productPlaceHolders = [
    {
      id: 1,
      description: "descriptiomn 1",
      photo: ImgPlaceholder,
      price: 176,
      calories: 245,
      availability: 1,
    },
    {
      id: 2,
      description: "descriptiomn 2",
      photo: ImgPlaceholder,
      price: 176,
      calories: 245,
      availability: 1,
    },
    {
      id: 3,
      description: "descriptiomn 3",
      photo: ImgPlaceholder,
      price: 176,
      calories: 245,
      availability: 1,
    },
  ]

  const filterCategory =
    categories && categories.length > 0
      ? categories?.filter((category) => category.id === selectedCategory.id)
      : [{name: "Product", items: productPlaceHolders}]

  console.log("bannner shape", banner_shape)
  console.log("font weight", text_fontWeight)

  console.log("filterCategory", filterCategory)

  return (
    <div
      style={{
        backgroundColor: page_color,
        fontFamily: text_fontFamily,
        fontWeight: text_fontWeight,
      }}
      className='w-full p-4 flex flex-col gap-6 relative'
    >
      {/* Header cart */}
      {headerPosition !== "fixed" && (
        <HeaderEdit restaurantStyle={restuarantEditorStyle} />
      )}
      {/* logo */}
      <div
        style={{backgroundColor: page_color}}
        className={`w-full min-h-[100px]    rounded-xl flex ${
          logo_alignment === "center"
            ? "items-center justify-center"
            : logo_alignment === "left"
            ? "items-center justify-start"
            : logo_alignment === "right"
            ? "items-center justify-end"
            : ""
        } `}
      >
        <div
          style={{borderRadius: logo_shape === "sharp" ? 0 : 12}}
          className='w-[60px] h-[60px] p-2 bg-neutral-100 relative'
        >
          <input
            type='file'
            name='logo'
            id={"logo"}
            accept='*/image'
            onChange={handleLogoUpload}
            className='hidden'
            hidden
          />
          <label htmlFor='logo'>
            <img
              src={uploadLogo ? uploadLogo : logo ? logo : ImgPlaceholder}
              alt={""}
              style={{borderRadius: logo_shape === "sharp" ? 0 : 12}}
              className='w-full h-full object-cover'
            />
          </label>
          {uploadLogo && (
            <div className='absolute top-[-0.8rem] right-[-1rem] cursor-pointer'>
              <div className='w-[20px] h-[20px] rounded-full p-1 bg-neutral-100 flex items-center justify-center'>
                <IoCloseOutline
                  size={16}
                  className='text-red-500 cursor-pointer'
                  onClick={clearLogo}
                />
              </div>
            </div>
          )}
        </div>
      </div>
      {/* banner */}
      {banner_type === "slider" ? (
        <div className='w-full'>
          <Slider banner_images={banner_images} />
        </div>
      ) : (
        <div
          style={{
            backgroundColor: banner_background_color,
            backgroundImage: uploadSingleBanner
              ? `url(${uploadSingleBanner})`
              : banner_image
              ? `url(${banner_image})`
              : `url(${bannerPlaceholder})`,
            borderRadius: banner_shape === "sharp" ? 0 : 12,
            backgroundSize: "cover",
            backgroundRepeat: "no-repeat",
          }}
          className={`w-full min-h-[180px]   flex items-center justify-center`}
        >
          <div
            style={{
              borderRadius: banner_shape === "sharp" ? 0 : 12,
            }}
            className='w-[100px] h-[95px] rounded-lg p-2 bg-neutral-100 relative'
          >
            <label htmlFor='banner'>
              <input
                type='file'
                name='banner'
                id={"banner"}
                accept='*/image'
                onChange={handleBannerUpload}
                className='hidden'
                hidden
              />
              <img
                src={
                  uploadSingleBanner
                    ? uploadSingleBanner
                    : banner_image
                    ? banner_image
                    : ImgPlaceholder
                }
                alt={""}
                className='w-full h-full object-cover'
              />
            </label>
            {uploadSingleBanner && (
              <div className='absolute top-[-0.8rem] right-[-1rem]'>
                <div className='w-[20px] h-[20px] rounded-full p-1 bg-neutral-100 flex items-center justify-center'>
                  <IoCloseOutline
                    size={16}
                    className='text-red-500'
                    onClick={clearBanner}
                  />
                </div>
              </div>
            )}
          </div>
        </div>
      )}
      {/* Category */}

      <div
        className={`w-full h-[500px] flex ${
          category_alignment === "center"
            ? "flex-col justify-center"
            : "flex-row"
        } items-center gap-8`}
      >
        <div
          className={`h-full overflow-x-hidden overflow-y-scroll hide-scroll ${
            category_alignment === "left"
              ? "order-1 w-[25%]"
              : category_alignment === "right"
              ? "order-2 w-[25%]"
              : category_alignment === "center"
              ? "w-full"
              : "w-[25%]"
          } `}
        >
          <div
            style={{
              backgroundColor: page_category_color,
              borderRadius: category_shape === "sharp" ? 0 : 12,
            }}
            className='w-full py-3 flex items-center justify-center'
          >
            <div
              className={`flex ${
                category_alignment === "center"
                  ? "flex-row gap-10 "
                  : "flex-col gap-6"
              } items-center `}
            >
              {categories && categories.length > 0
                ? categories?.map((category, i) => (
                    <CategoryItem
                      key={i}
                      active={selectedCategory.id === category.id}
                      name={category.name}
                      imgSrc={category.photo}
                      alt={category.name}
                      hoverColor={category_hover_color}
                      onClick={() =>
                        dispatch(
                          selectedCategoryAPI({
                            name: category.name,
                            id: category.id,
                          })
                        )
                      }
                      textColor={text_color}
                      textAlign={text_alignment}
                      fontWeight={text_fontWeight}
                      shape={category_shape}
                      isGrid={category_alignment === "center" ? false : true}
                      fontSize={text_fontSize}
                    />
                  ))
                : categoriesPlaceHolders.map((category, i) => (
                    <CategoryItem
                      key={i}
                      active={selectedCategory.id === category.id}
                      name={category.name}
                      imgSrc={category.photo}
                      alt={category.name}
                      hoverColor={category_hover_color}
                      onClick={() =>
                        dispatch(
                          selectedCategoryAPI({
                            name: category.name,
                            id: category.id,
                          })
                        )
                      }
                      textColor={text_color}
                      textAlign={text_alignment}
                      fontWeight={text_fontWeight}
                      shape={category_shape}
                      isGrid={category_alignment === "center" ? false : true}
                      fontSize={text_fontSize}
                    />
                  ))}
            </div>
          </div>
        </div>
        <div
          style={{backgroundColor: product_background_color}}
          className={`h-full overflow-x-hidden overflow-y-scroll hide-scroll  ${
            category_alignment === "left"
              ? "order-2 w-[75%]"
              : category_alignment === "right"
              ? "order-1 w-[75%]"
              : category_alignment === "center"
              ? "w-full"
              : "w-[75%]"
          } ${
            categoryDetail_shape === "sharp" ? "" : "rounded-lg"
          } bg-white p-8`}
        >
          <div
            className={`w-full h-full flex flex-col items-center justify-center `}
          >
            <h3
              style={{fontWeight: text_fontWeight}}
              className={`${
                text_fontFamily ? text_fontFamily : "font-semibold"
              } text-[1.5rem] text-center my-4 relative capitalize`}
            >
              <span className='custom-underline capitalize'>
                {selectedCategory.name}
              </span>{" "}
            </h3>

            <div
              className={`flex  ${
                category_alignment === "center"
                  ? "flex-row flex-wrap gap-12"
                  : "flex-col gap-6"
              }  h-fit  p-4`}
            >
              {filterCategory &&
                filterCategory[0]?.items
                  .filter((item) => item.availability === 1)
                  .slice(0, 2)
                  .map((product, idx) => (
                    <ProductItem
                      key={idx + "prdt"}
                      id={product.id}
                      name={product.description}
                      imgSrc={product.photo}
                      amount={product.price}
                      caloryInfo={product.calories}
                      checkbox_required={
                        product?.checkbox_required ?? ["true", "false"]
                      }
                      checkbox_input_titles={
                        product?.checkbox_input_titles ?? [[]]
                      }
                      checkbox_input_names={
                        product?.checkbox_input_names ?? [[]]
                      }
                      checkbox_input_prices={
                        product?.checkbox_input_prices ?? [[]]
                      }
                      selection_required={
                        product?.selection_required ?? ["true", "false"]
                      }
                      selection_input_titles={
                        product?.selection_input_titles ?? [[]]
                      }
                      selection_input_names={
                        product?.selection_input_names ?? [[]]
                      }
                      selection_input_prices={
                        product?.selection_input_prices ?? [[]]
                      }
                      dropdown_required={
                        product?.dropdown_required ?? ["true", "false"]
                      }
                      dropdown_input_titles={
                        product?.dropdown_input_titles ?? [[]]
                      }
                      dropdown_input_names={
                        product?.dropdown_input_names ?? [[]]
                      }
                      cartBgcolor={categoryDetail_cart_color}
                      amountColor={price_color}
                      textColor={text_color}
                      textAlign={text_alignment}
                      fontWeight={text_fontWeight}
                      shape={categoryDetail_shape}
                      fontSize={text_fontSize}
                    />
                  ))}
            </div>
          </div>
        </div>
      </div>

      {/* social media */}

      <div
        style={{backgroundColor: footer_color}}
        className={`w-full min-h-[70px] px-3  rounded-xl flex ${
          socialMediaIcons_alignment === "center"
            ? "items-center justify-center"
            : socialMediaIcons_alignment === "left"
            ? "items-center justify-start"
            : socialMediaIcons_alignment === "right"
            ? "items-center justify-end"
            : ""
        }`}
      >
        <div className='flex items-center gap-5'>
          {selectedSocialIcons?.map((socialMedia) => (
            <a
              href={socialMedia.link ? socialMedia.link : "javascript:void(0)"}
              key={socialMedia.id}
              className='cursor-pointer'
            >
              <div className='w-[30px] h-[30px] rounded-full relative'>
                <img
                  src={socialMedia.imgUrl}
                  alt={"whatsapp"}
                  className='w-full h-full object-cover'
                />
              </div>
            </a>
          ))}
        </div>
      </div>
      <div
        style={{backgroundColor: footer_color}}
        className={`w-full min-h-[70px]  rounded-xl flex  ${
          phoneNumber_alignment === "center"
            ? "items-center justify-center"
            : phoneNumber_alignment === "left"
            ? "items-center justify-start"
            : phoneNumber_alignment === "right"
            ? "items-center justify-end"
            : ""
        }`}
      >
        <h3
          className={`${
            text_fontFamily ? text_fontFamily : "font-semibold"
          } text-lg`}
        >
          {phoneNumber}
        </h3>
      </div>
    </div>
  )
}

export default MainBoardEditor
