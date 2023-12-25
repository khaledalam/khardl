import React, {Fragment, useContext, useState} from "react"
import pizzImg from "../../../../assets/pizza.png"
import pastaImg from "../../../../assets/pasta.png"
import burgerImg from "../../../../assets/burger.png"
import chickenImg from "../../../../assets/chicken.png"
import drinkImg from "../../../../assets/drink.png"
import cartHeaderImg from "../../../../assets/cartBoldIcon.svg"
import ImageIcon from "../../../../assets/imageIcon.svg"
import WhatsappIcon from "../../../../assets/whatsappImg.svg"
import {IoCloseOutline, IoMenuOutline} from "react-icons/io5"
import CategoryItem from "./CategoryItem"
import ProductItem from "./ProductItem"
import {useSelector, useDispatch} from "react-redux"
import {MenuContext} from "react-flexible-sliding-menu"

const MainBoardEditor = () => {
  const [activeItem, setActiveItem] = useState({name: "", imgSrc: ""})
  const restuarantEditorStyle = useSelector(
    (state) => state.restuarantEditorStyle
  )
  const {toggleMenu} = useContext(MenuContext)

  const toggleTheMenu = () => {
    toggleMenu()
  }
  const {
    page_color,
    page_category_color,
    category_hover_color,
    category_type,
    category_alignment,
    category_shape,

    categoryDetail_cart_color,
    categoryDetail_type,
    categoryDetail_alignment,
    categoryDetail_shape,

    price_color,
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
    text_color,
  } = restuarantEditorStyle
  console.log("restuarantEditorStyle", restuarantEditorStyle)

  const [selectedCategory, setSelectedCategory] = useState("burger")

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
      name: "Chicken",
      imgSrc: chickenImg,
    },
    {
      name: "Drink",
      imgSrc: drinkImg,
    },
  ]

  const productList = [
    {
      category: "pizza",
      name: "Pizza Special",
      imgSrc: pizzImg,
      caloryInfo: "142 Calories",
      amount: "875.000",
    },
    {
      category: "pizza",
      name: "Pizza Special",
      imgSrc: pizzImg,
      caloryInfo: "142 Calories",
      amount: "875.000",
    },
    {
      category: "burger",
      name: "Burger Special",
      imgSrc: burgerImg,
      caloryInfo: "142 Calories",
      amount: "875.000",
    },
    {
      category: "burger",
      name: "Burger Special",
      imgSrc: burgerImg,
      caloryInfo: "142 Calories",
      amount: "875.000",
    },
    {
      category: "pasta",
      name: "Pasta Special",
      imgSrc: pastaImg,
      caloryInfo: "142 Calories",
      amount: "875.000",
    },
    {
      category: "pasta",
      name: "Pasta Special",
      imgSrc: pastaImg,
      caloryInfo: "142 Calories",
      amount: "875.000",
    },
    {
      category: "chicken",
      name: "Chicken Special",
      imgSrc: chickenImg,
      caloryInfo: "142 Calories",
      amount: "875.000",
    },
    {
      category: "chicken",
      name: "Chicken Special",
      imgSrc: chickenImg,
      caloryInfo: "142 Calories",
      amount: "875.000",
    },
    {
      category: "drink",
      name: "Drink Special",
      imgSrc: drinkImg,
      caloryInfo: "142 Calories",
      amount: "875.000",
    },
    {
      category: "drink",
      name: "Drink Special",
      imgSrc: drinkImg,
      caloryInfo: "142 Calories",
      amount: "875.000",
    },
  ]

  const filterProductList = productList.filter(
    (product) => product.category === selectedCategory
  )

  console.log("bannner shape", banner_shape)

  return (
    <div
      style={{backgroundColor: page_color}}
      className='w-full p-4 flex flex-col gap-6 relative'
    >
      {/* Header cart */}
      <div
        style={{
          backgroundColor: header_color,
          position: headerPosition === "fixed" ? "absolute" : headerPosition,
          top: 0,
          left: 0,
          right: 0,
          width: "100%",
        }}
        className='w-full min-h-[85px]   rounded-xl flex items-center justify-between px-2'
      >
        <div
          onClick={toggleTheMenu}
          className='btn hover:bg-neutral-100 flex items-center gap-3'
        >
          <IoMenuOutline size={40} className='text-neutral-400' />
          <span className='font-normal text-sm'>
            Show Navigation Bar To Edit
          </span>
        </div>
        <div className='w-[50px] h-[50px] rounded-lg bg-neutral-200 relative flex items-center justify-center'>
          <img src={cartHeaderImg} alt={"cart"} className='' />
          {true && (
            <div className='absolute top-[-0.5rem] right-[-0.5rem]'>
              <div className='w-[20px] h-[20px] rounded-full p-1 bg-red-500 flex items-center justify-center'>
                <span className='text-white font-bold text-xs'>0</span>
              </div>
            </div>
          )}
        </div>
      </div>
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
          <img
            src={ImageIcon}
            alt={""}
            style={{borderRadius: logo_shape === "sharp" ? 0 : 12}}
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
      {banner_type === "slider" ? (
        <div>slider</div>
      ) : (
        <div
          style={{
            backgroundColor: banner_background_color,
            borderRadius: banner_shape === "sharp" ? 0 : 12,
          }}
          className={`w-full min-h-[180px]   flex items-center justify-center`}
        >
          <div
            style={{
              borderRadius: banner_shape === "sharp" ? 0 : 12,
            }}
            className='w-[100px] h-[95px] rounded-lg p-2 bg-neutral-100 relative'
          >
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
      )}
      {/* Category */}
      {category_type === "grid" ? (
        <div
          className={` w-full flex  p-2  ${
            category_alignment === "center"
              ? "items-center justify-center"
              : category_alignment === "left"
              ? "items-center justify-start"
              : category_alignment === "right"
              ? "items-center justify-end"
              : ""
          }`}
        >
          <div
            style={{
              backgroundColor: page_category_color,
              borderRadius: category_shape === "sharp" ? 0 : 12,
            }}
            className='w-[30%] py-3'
          >
            <div className='flex flex-col items-center gap-6'>
              {categoryList.map((category, i) => (
                <CategoryItem
                  key={i}
                  active={selectedCategory === category.name.toLowerCase()}
                  name={category.name}
                  imgSrc={category.imgSrc}
                  alt={category.name}
                  hoverColor={category_hover_color}
                  onClick={() =>
                    setSelectedCategory(category.name.toLowerCase())
                  }
                  textColor={text_color}
                  shape={category_shape}
                  isGrid={true}
                />
              ))}
            </div>
          </div>
        </div>
      ) : (
        <Fragment>
          <div
            style={{
              backgroundColor: page_category_color,
              // borderRadius: category_shape === "sharp" ? 0 : 12,
            }}
            className={`w-full min-h-[180px]  flex   ${
              category_alignment === "center"
                ? "items-center justify-center"
                : category_alignment === "left"
                ? "items-center justify-start"
                : category_alignment === "right"
                ? "items-center justify-end"
                : ""
            }`}
          >
            <div className='flex items-center gap-6'>
              {categoryList.map((category, i) => (
                <CategoryItem
                  key={i}
                  active={selectedCategory === category.name.toLowerCase()}
                  name={category.name}
                  imgSrc={category.imgSrc}
                  alt={category.name}
                  hoverColor={category_hover_color}
                  onClick={() =>
                    setSelectedCategory(category.name.toLowerCase())
                  }
                  textColor={text_color}
                  shape={category_shape}
                />
              ))}
            </div>
          </div>
        </Fragment>
      )}
      {/* Products/ category details */}
      {categoryDetail_type === "grid" ? (
        <div
          className={`w-full flex bg-white ${
            categoryDetail_alignment === "center"
              ? "items-center justify-center"
              : categoryDetail_alignment === "left"
              ? "items-center justify-start"
              : categoryDetail_alignment === "right"
              ? "items-center justify-end"
              : ""
          }
        `}
        >
          <div className={`relative`}>
            <h3 className='font-semibold text-[1.5rem] mb-4 relative capitalize'>
              <span className='custom-underline'>{selectedCategory}</span>{" "}
            </h3>

            <div className={`flex flex-col gap-6 h-fit  py-4 px-2`}>
              {filterProductList.map((product, i) => (
                <ProductItem
                  key={i}
                  id={product.name + i}
                  name={product.name}
                  imgSrc={product.imgSrc}
                  amount={product.amount}
                  caloryInfo={product.caloryInfo}
                  cartBgcolor={categoryDetail_cart_color}
                  amountColor={price_color}
                  shape={categoryDetail_shape}
                />
              ))}
            </div>
          </div>
        </div>
      ) : (
        <div
          style={{
            borderRadius: categoryDetail_shape === "sharp" ? 0 : 12,
          }}
          className={`w-full h-fit bg-white   flex ${
            categoryDetail_alignment === "center"
              ? "items-center justify-center"
              : categoryDetail_alignment === "left"
              ? "items-center justify-start"
              : categoryDetail_alignment === "right"
              ? "items-center justify-end"
              : ""
          }  `}
        >
          <div className='flex flex-col items-center justify-center'>
            <h3 className='font-semibold text-[1.5rem] mb-4 relative capitalize'>
              <span className='custom-underline'>{selectedCategory}</span>{" "}
            </h3>

            <div
              className={`flex items-center gap-6 h-fit   flex-wrap py-4 px-2`}
            >
              {filterProductList.map((product, i) => (
                <ProductItem
                  key={i}
                  id={product.name + i}
                  name={product.name}
                  imgSrc={product.imgSrc}
                  amount={product.amount}
                  caloryInfo={product.caloryInfo}
                  cartBgcolor={categoryDetail_cart_color}
                  amountColor={price_color}
                  shape={categoryDetail_shape}
                />
              ))}
            </div>
          </div>
        </div>
      )}
      {/* social media */}

      <div
        style={{backgroundColor: footer_color}}
        className={`w-full min-h-[70px]  rounded-xl flex items-center justify-center`}
      >
        <div className='w-[30px] h-[30px] rounded-full relative'>
          <img
            src={WhatsappIcon}
            alt={"whatsapp"}
            className='w-full h-full object-cover'
          />
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
        <h3 className='font-semibold text-lg'>{phoneNumber}</h3>
      </div>
    </div>
  )
}

export default MainBoardEditor
