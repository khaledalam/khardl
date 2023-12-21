import React, {useState} from "react"
import pizzImg from "../../../../assets/pizza.png"
import pastaImg from "../../../../assets/pasta.png"
import burgerImg from "../../../../assets/burger.png"
import chickenImg from "../../../../assets/chicken.png"
import drinkImg from "../../../../assets/drink.png"
import cartHeaderImg from "../../../../assets/headerCartIcon.svg"
import ImageIcon from "../../../../assets/imageIcon.svg"
import penEditIcon from "../../../../assets/penEdit.svg"
import {IoCloseOutline} from "react-icons/io5"
import CategoryItem from "./CategoryItem"

const MainBoardEditor = () => {
  const [activeItem, setActiveItem] = useState({name: "", imgSrc: ""})
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
    <div className='w-full h-full p-4 flex flex-col gap-6'>
      {/* Header cart */}
      <div className='w-full h-[85px] bg-white rounded-xl flex items-center justify-center'>
        <div className='w-[40px] h-[40px] rounded-sm p-2 bg-neutral-100 relative'>
          <img
            src={cartHeaderImg}
            alt={"cart"}
            className='w-full h-full object-cover'
          />
          {false && (
            <div className='absolute top-[-0.8rem] right-[-1rem]'>
              <div className='w-[20px] h-[20px] rounded-full p-1 bg-neutral-100 flex items-center justify-center'>
                <span className='text-red-500 text-xs'>0</span>
              </div>
            </div>
          )}
        </div>
      </div>
      {/* logo */}
      <div className='w-full h-[100px] bg-white rounded-xl flex items-center justify-center '>
        <div className='w-[60px] h-[60px] rounded-sm p-2 bg-neutral-100 relative'>
          <img
            src={ImageIcon}
            alt={""}
            className='w-full h-full object-cover'
          />
          {false && (
            <div className='absolute top-[-0.8rem] right-[-1rem]'>
              <div className='w-[20px] h-[20px] rounded-full p-1 bg-neutral-100 flex items-center justify-center'>
                <IoCloseOutline size={16} className='text-red-500' />
              </div>
            </div>
          )}
        </div>
      </div>
      {/* banner */}
      <div className='w-full h-[180px] bg-white rounded-xl flex items-center justify-center'>
        <div className='w-[100px] h-[95px] rounded-sm p-2 bg-neutral-100 relative'>
          <img
            src={ImageIcon}
            alt={""}
            className='w-full h-full object-cover'
          />
          {false && (
            <div className='absolute top-[-0.8rem] right-[-1rem]'>
              <div className='w-[20px] h-[20px] rounded-full p-1 bg-neutral-100 flex items-center justify-center'>
                <IoCloseOutline size={16} className='text-red-500' />
              </div>
            </div>
          )}
        </div>
      </div>
      {/* Category */}
      <div className='w-full h-[150px] bg-white rounded-xl flex items-center justify-center'>
        <div className='flex items-center gap-6'>
          {categoryList.map((category, i) => (
            <CategoryItem
              key={i}
              active={activeItem?.name === category.name}
              name={category.name}
              imgSrc={category.imgSrc}
              alt={category.name}
              onClick={() => setActiveItem(category)}
            />
          ))}
        </div>
      </div>
    </div>
  )
}

export default MainBoardEditor
