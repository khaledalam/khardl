import React, {useState} from "react"
import pizzImg from "../../../../assets/pizza.png"
import pastaImg from "../../../../assets/pasta.png"
import burgerImg from "../../../../assets/burger.png"
import chickenImg from "../../../../assets/chicken.png"
import drinkImg from "../../../../assets/drink.png"
import cartHeaderImg from "../../../../assets/headerCartIcon.svg"
import ImageIcon from "../../../../assets/imageIcon.svg"
import WhatsappIcon from "../../../../assets/whatsappImg.svg"
import {IoCloseOutline} from "react-icons/io5"
import CategoryItem from "./CategoryItem"
import ProductItem from "./ProductItem"

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

  const productList = [
    {
      name: "Pizza Special",
      imgSrc: pizzImg,
      caloryInfo: "142 Calories",
      amount: "875.000",
    },
    {
      name: "Pasta Special",
      imgSrc: pastaImg,
      caloryInfo: "142 Calories",
      amount: "375.000",
    },
    {
      name: "Burger Special",
      imgSrc: burgerImg,
      caloryInfo: "142 Calories",
      amount: "875.000",
    },
  ]

  return (
    <div className='w-full h-full p-4 flex flex-col gap-6'>
      {/* Header cart */}
      <div className='w-full min-h-[85px] bg-white rounded-xl flex items-center justify-center'>
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
      <div className='w-full min-h-[100px] bg-white rounded-xl flex items-center justify-center '>
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
      <div className='w-full min-h-[180px] bg-white rounded-xl flex items-center justify-center'>
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
      <div className='w-full min-h-[180px] bg-white rounded-xl flex items-center justify-center'>
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
      {/* Products */}
      <div className='w-full h-fit bg-white rounded-xl flex items-center justify-center mx-auto'>
        <div className='flex items-center gap-6 h-fit   flex-wrap py-4 px-2'>
          {productList.map((product, i) => (
            <ProductItem
              key={i}
              name={product.name}
              imgSrc={product.imgSrc}
              amount={product.amount}
              caloryInfo={product.caloryInfo}
            />
          ))}
        </div>
      </div>
      {/* social media */}

      <div className='w-full min-h-[70px] bg-white rounded-xl flex items-center justify-center'>
        <div className='w-[30px] h-[30px] rounded-full relative'>
          <img
            src={WhatsappIcon}
            alt={"whatsapp"}
            className='w-full h-full object-cover'
          />
        </div>
      </div>
      <div className='w-full min-h-[70px] bg-white rounded-xl flex items-center justify-center mb-4'>
        <h3 className='font-semibold text-lg'>000000111</h3>
      </div>
    </div>
  )
}

export default MainBoardEditor
