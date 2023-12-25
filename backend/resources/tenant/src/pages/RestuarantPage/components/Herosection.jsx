import React from "react"
import CategoryItem from "../../EditorsPage/Restuarants/components/CategoryItem"
import {useDispatch, useSelector} from "react-redux"
import {selectedCategoryAPI} from "../../../redux/NewEditor/categoryAPISlice"
import imgBanner from "../../../assets/bannerRestuarant.png"

const Herosection = ({alignment, categories}) => {
  const dispatch = useDispatch()
  const selectedCategory = useSelector(
    (state) => state.categoryAPI.selected_category
  )
  const restaurantStyle = useSelector(
    (state) => state.styleDataRestaurant.styleDataRestaurant
  )

  console.log("restaurantStyle", restaurantStyle)

  return (
    <div className='flex flex-col items-center justify-center'>
      <div
        className={
          "w-full bg-[#2A6E4F] flex flex-col py-4 items-center justify-center gap-8"
        }
      >
        <div
          className={` w-full ${
            restaurantStyle && restaurantStyle?.logo_alignment === "Center"
              ? " flex items-center justify-center"
              : restaurantStyle && restaurantStyle?.logo_alignment === "Left"
              ? "items-center justify-start"
              : "items-center justify-end"
          }`}
        >
          <div className='w-[60px] h-[60px]'>
            <img
              src={restaurantStyle && restaurantStyle?.logo}
              alt='logo'
              className='w-full h-full object-contain rounded-xl'
            />
          </div>
        </div>
        {restaurantStyle?.banner_style === "One Photo" && (
          <div
            className='w-5/6 overflow-hidden h-[471px] laptopXL:w-[75%]'
            style={{
              boxShadow: "0px 6px 4px 0px rgba(0, 0, 0, 0.43)",
              borderRadius: 12,
            }}
          >
            <img
              src={restaurantStyle ? restaurantStyle.banner_image : imgBanner}
              alt='banner'
              className='w-full h-full object-cover'
            />
          </div>
        )}
      </div>
      {alignment === "center" && (
        <div className='bg-[#2A6E4F] w-full flex items-center justify-center'>
          <div className='flex items-center  gap-8 my-5 '>
            {categories?.map((category, i) => (
              <CategoryItem
                key={i}
                active={selectedCategory === category.name.toLowerCase()}
                name={category.name}
                imgSrc={category.imgSrc}
                alt={category.name}
                hoverColor={"red"}
                textColor={"white"}
                onClick={() =>
                  dispatch(selectedCategoryAPI(category.name.toLowerCase()))
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
