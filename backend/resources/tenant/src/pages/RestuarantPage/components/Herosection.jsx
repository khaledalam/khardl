import React from "react"
import imgLogo from "../../../assets/khardl_Logo.png"
import imgBanner from "../../../assets/bannerRestuarant.png"
import pizzImg from "../../../assets/pizza.png"
import pastaImg from "../../../assets/pasta.png"
import burgerImg from "../../../assets/burger.png"
import chickenImg from "../../../assets/chicken.png"
import drinkImg from "../../../assets/drink.png"
import CategoryItem from "../../EditorsPage/Restuarants/components/CategoryItem"
import {useDispatch, useSelector} from "react-redux"
import {selectedCategoryAPI} from "../../../redux/NewEditor/categoryAPISlice"

const Herosection = ({alignment, categories}) => {
  const dispatch = useDispatch()
  const selectedCategory = useSelector(
    (state) => state.categoryAPI.selected_category
  )

  const categoryList = [
    {
      name: "Pizza",
      imgSrc: pizzImg,
    },
    {
      name: "Pasta",
      imgSrc: pastaImg,
    },
    {
      name: "Burger",
      imgSrc: burgerImg,
    },
    {
      name: "chicken",
      imgSrc: chickenImg,
    },
    {
      name: "drink",
      imgSrc: drinkImg,
    },
  ]

  return (
    <div className='flex flex-col items-center justify-center'>
      <div className='w-full bg-[#2A6E4F] flex flex-col py-4 items-center justify-center gap-8'>
        <div className='w-[60px] h-[60px]'>
          <img
            src={imgLogo}
            alt='logo'
            className='w-full h-full object-contain rounded-xl'
          />
        </div>
        <div className='w-5/6 laptopXL:w-[75%]'>
          <img
            src={imgBanner}
            alt='logo'
            className='w-full h-full object-contain'
          />
        </div>
      </div>
      {alignment === "center" && (
        <div className='bg-[#2A6E4F] w-full flex items-center justify-center'>
          <div className='flex items-center  gap-8 my-5 '>
            {categories.map((category, i) => (
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
