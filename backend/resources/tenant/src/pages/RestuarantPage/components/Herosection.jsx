import React, {Fragment} from "react"
import CategoryItem from "../../EditorsPage/Restuarants/components/CategoryItem"
import {useDispatch, useSelector} from "react-redux"
import {selectedCategoryAPI} from "../../../redux/NewEditor/categoryAPISlice"
import imgBanner from "../../../assets/bannerRestuarant.png"
import {Swiper, SwiperSlide} from "swiper/react"
import {Navigation, Pagination} from "swiper/modules"
import {useTranslation} from "react-i18next"

const Herosection = ({isMobile, categories}) => {
  const dispatch = useDispatch()
  const {t} = useTranslation()
  const selectedCategory = useSelector(
    (state) => state.categoryAPI.selected_category
  )
  const restaurantStyle = useSelector((state) => state.restuarantEditorStyle)

  console.log("restaurantStyle", restaurantStyle)

  return (
    <div className='flex flex-col items-center justify-center'>
      <div
        style={{
          backgroundColor: restaurantStyle
            ? restaurantStyle?.banner_background_color
            : "inherit",
        }}
        className={
          "w-full  flex flex-col py-4 items-center justify-center gap-8"
        }
      >
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
            className={`w-[60px] h-[60px]  ${
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
              src={restaurantStyle?.logo}
              alt='logo'
              className={`w-full h-full object-cover ${
                restaurantStyle?.logo_shape === t("Sharp") ? "" : "rounded-full"
              }`}
            />
          </div>
        </div>
        {(restaurantStyle && restaurantStyle?.banner_type === "one-photo") ||
        (restaurantStyle && restaurantStyle?.banner_type === t("One-photo")) ? (
          <div
            className='w-5/6 overflow-hidden h-[471px] laptopXL:w-[75%]'
            style={{
              boxShadow: "0px 6px 4px 0px rgba(0, 0, 0, 0.43)",
              borderRadius: 12,
            }}
          >
            <img
              src={restaurantStyle ? restaurantStyle?.banner_image : imgBanner}
              alt='banner'
              className='w-full h-full object-cover'
            />
          </div>
        ) : restaurantStyle?.banner_type === t("Slider") ||
          restaurantStyle?.banner_type === "slider" ? (
          <div className='w-5/6 overflow-hidden h-[471px] laptopXL:w-[75%]'>
            <Swiper
              modules={[Pagination, Navigation]}
              pagination={{clickable: true}}
              navigation={true}
              slideClass='swiper-slide'
            >
              {Array(
                restaurantStyle ? restaurantStyle?.banner_images?.length : 3
              )
                .fill(1)
                .map((_, index) => (
                  <SwiperSlide key={index}>
                    <div
                      style={{
                        backgroundRepeat: "no-repeat",
                        backgroundSize: "cover",
                        backgroundImage:
                          restaurantStyle?.banner_images &&
                          restaurantStyle?.banner_images?.length > 0
                            ? `url(${restaurantStyle?.banner_images[index]})`
                            : "",
                      }}
                      className={`h-[470px] rounded-md flex items-center justify-center   shadow-md`}
                    ></div>
                  </SwiperSlide>
                ))}
            </Swiper>{" "}
          </div>
        ) : (
          <Fragment>Not a Slider</Fragment>
        )}
      </div>
      {(restaurantStyle?.category_alignment === t("Center") ||
        restaurantStyle?.category_alignment === "center" ||
        isMobile) && (
        <div
          style={{
            backgroundColor: restaurantStyle.page_category_color,
          }}
          className={` w-full flex items-center ${
            isMobile ? "overflow-x-scroll hide-scroll px-4" : ""
          } `}
        >
          <div className={`flex items-center w-full  gap-8 my-5  `}>
            {categories?.map((category, i) => (
              <CategoryItem
                key={i}
                active={selectedCategory.id === category.id}
                name={category.name}
                imgSrc={category.imgSrc}
                alt={category.name}
                hoverColor={"red"}
                textColor={"white"}
                onClick={() =>
                  dispatch(
                    selectedCategoryAPI({name: category.name, id: category.id})
                  )
                }
              />
            ))}
          </div>
        </div>
      )}
    </div>
  )
}

export default Herosection
