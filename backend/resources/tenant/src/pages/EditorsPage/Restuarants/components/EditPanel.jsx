import React, {useState} from "react"
import PrimarySelect from "./PrimarySelect"
import ColorPallete from "./ColorPallete"
import PrimaryNumberCount from "./PrimaryNumberCount"
import LogoAlignment from "./LogoAlignment"
import {useSelector, useDispatch} from "react-redux"
import {
  pageColor,
  pageCategoryColor,
  categoryShape,
  bannerShape,
  bannerBgColor,
  logoShape,
  categoryHoverColor,
  categoryDetailCartColor,
  categoryDetailShape,
  headerColor,
  footerColor,
  priceColor,
  textColor,
  textFontSize,
  textFontFamily,
  textFontWeight,
  textAlignment,
} from "../../../../redux/NewEditor/restuarantEditorSlice"
import PrimaryOriginSelect from "./PrimaryOriginSelect"

const EditPanel = () => {
  const restuarantEditorStyle = useSelector(
    (state) => state.restuarantEditorStyle
  )
  const {
    page_color,
    page_category_color,
    category_hover_color,
    categoryDetail_cart_color,
    header_color,
    logo_shape,
    banner_shape,
    banner_background_color,
    categoryDetail_shape,
    category_shape,
    footer_color,
    price_color,
    text_color,
    text_fontFamily,
    text_fontWeight,
    text_alignment,
    text_fontSize,
  } = restuarantEditorStyle
  const dispatch = useDispatch()

  const [fontFamily, setfontFamily] = useState("Inter")
  const [weight, setWeight] = useState("Thin")

  return (
    <div
      className='w-full h-full'
      style={{fontWeight: `${text_fontWeight}!important`}}
    >
      {/* shape  */}
      <div className='py-4 border-b border-neutral-300 px-2'>
        <h2 className='font-bold text-lg mb-4'>Shape</h2>
        <div className='flex flex-col gap-4'>
          <div className='flex w-full justify-between items-center'>
            <h3 className='font-normal text-[14px] laptopXL:text-[1rem] '>
              Logo
            </h3>
            <PrimarySelect
              widthStyle={"w-[50%]"}
              defaultValue={logo_shape}
              handleChange={(value) => dispatch(logoShape(value))}
              options={[
                {value: "rounded", text: "Rounded"},
                {value: "sharp", text: "Sharp"},
              ]}
            />
          </div>
          <div className='flex w-full justify-between items-center'>
            <h3 className='font-normal text-[14px] laptopXL:text-[1rem] '>
              Banner
            </h3>
            <PrimarySelect
              widthStyle={"w-[50%]"}
              defaultValue={banner_shape}
              handleChange={(value) => dispatch(bannerShape(value))}
              options={[
                {value: "rounded", text: "Rounded"},
                {value: "sharp", text: "Sharp"},
              ]}
            />
          </div>
          <div className='flex w-full justify-between items-center'>
            <h3 className='font-normal text-[14px] laptopXL:text-[1rem] '>
              Category
            </h3>
            <PrimarySelect
              widthStyle={"w-[50%]"}
              defaultValue={category_shape}
              handleChange={(value) => dispatch(categoryShape(value))}
              options={[
                {value: "rounded", text: "Rounded"},
                {value: "sharp", text: "Sharp"},
              ]}
            />
          </div>
          <div className='flex w-full justify-between items-center'>
            <h3 className='font-normal text-[14px] laptopXL:text-[1rem] '>
              Category Detail
            </h3>
            <PrimarySelect
              widthStyle={"w-[50%]"}
              defaultValue={categoryDetail_shape}
              handleChange={(value) => dispatch(categoryDetailShape(value))}
              options={[
                {value: "rounded", text: "Rounded"},
                {value: "sharp", text: "Sharp"},
              ]}
            />
          </div>
        </div>
      </div>
      {/* colors */}
      <div className='py-4 border-b border-neutral-300 px-2'>
        <h2 className='font-bold text-lg  mb-4'>Color</h2>
        <div className='flex flex-col gap-4 w-full '>
          <div className='flex w-full justify-between items-center'>
            <h3 className='font-normal text-[14px] laptopXL:text-[1rem] '>
              Page
            </h3>
            <ColorPallete
              modalId={"page-modal"}
              color={page_color}
              handleColorChange={(color) => dispatch(pageColor(color))}
            />
          </div>
          <div className='flex w-full justify-between items-center'>
            <h3 className='font-normal text-[14px] laptopXL:text-[1rem] '>
              Page Category
            </h3>
            <ColorPallete
              modalId={"page_category"}
              color={page_category_color}
              handleColorChange={(color) => dispatch(pageCategoryColor(color))}
            />
          </div>
          <div className='flex w-full justify-between items-center'>
            <h3 className='font-normal text-[14px] laptopXL:text-[1rem] '>
              Page Banner
            </h3>
            <ColorPallete
              modalId={"page_banner"}
              color={banner_background_color}
              handleColorChange={(color) => dispatch(bannerBgColor(color))}
            />
          </div>
          <div className='flex w-full justify-between items-center'>
            <h3 className='font-normal text-[14px] laptopXL:text-[1rem] '>
              Category Animation
            </h3>
            <ColorPallete
              modalId={"categoryAnimation"}
              color={category_hover_color}
              handleColorChange={(color) => dispatch(categoryHoverColor(color))}
            />
          </div>
          <div className='flex w-full justify-between items-center'>
            <h3 className='font-normal text-[14px] laptopXL:text-[1rem] '>
              Category Detail Cart
            </h3>
            <ColorPallete
              modalId={"categoryDetails"}
              color={categoryDetail_cart_color}
              handleColorChange={(color) =>
                dispatch(categoryDetailCartColor(color))
              }
            />
          </div>
          <div className='flex w-full justify-between items-center'>
            <h3 className='font-normal text-[14px] laptopXL:text-[1rem] '>
              Price
            </h3>
            <ColorPallete
              modalId={"price"}
              color={price_color}
              defaultColor='red'
              handleColorChange={(color) => dispatch(priceColor(color))}
            />
          </div>
          <div className='flex w-full justify-between items-center'>
            <h3 className='font-normal text-[14px] laptopXL:text-[1rem] '>
              Header
            </h3>
            <ColorPallete
              modalId={"header"}
              color={header_color}
              defaultColor='#c0d123'
              handleColorChange={(color) => dispatch(headerColor(color))}
            />
          </div>
          <div className='flex w-full justify-between items-center'>
            <h3 className='font-normal text-[14px] laptopXL:text-[1rem] '>
              Footer
            </h3>
            <ColorPallete
              modalId={"footer_modal"}
              color={footer_color}
              defaultColor='#c0d123'
              handleColorChange={(color) => dispatch(footerColor(color))}
            />
          </div>
        </div>
      </div>
      {/* Text */}
      <div className='py-4 border-b border-neutral-300 px-2'>
        <h2 className='font-bold text-lg mb-4'>Text</h2>
        <div className='flex flex-col gap-4'>
          <div className='flex w-full justify-between items-center'>
            <h3 className='font-normal text-[14px] laptopXL:text-[1rem] '>
              Font
            </h3>
            <PrimarySelect
              widthStyle={"w-[50%]"}
              defaultValue={text_fontFamily}
              handleChange={(value) => dispatch(textFontFamily(value))}
              options={[
                {value: "cairo", text: "Cairo"},
                {value: "Poppins", text: "Poppins"},
                {value: "Roboto", text: "Roboto"},
              ]}
            />
          </div>
          <div className='flex w-full justify-between items-center'>
            <h3 className='font-normal text-[14px] laptopXL:text-[1rem] '>
              Weight
            </h3>
            {/* <PrimarySelect
              widthStyle={"w-[50%]"}
              defaultValue={text_fontWeight}
              handleChange={(value) => dispatch(textFontWeight(value))}
              options={[
                {value: 200, text: "Thin"},
                {value: 300, text: "Light"},
                {value: 400, text: "Regular"},
                {value: 500, text: "Medium"},
                {value: 600, text: "Semi Bold"},
                {value: 700, text: "Bold"},
                {value: 800, text: "Extra Bold"},
              ]}
            /> */}
            <PrimaryOriginSelect
              widthStyle={"w-[50%]"}
              defaultValue={text_fontWeight}
              handleChange={(e) => dispatch(textFontWeight(e.target.value))}
              options={[
                {value: 200, text: "Thin"},
                {value: 300, text: "Light"},
                {value: 400, text: "Regular"},
                {value: 500, text: "Medium"},
                {value: 600, text: "Semi Bold"},
                {value: 700, text: "Bold"},
                {value: 800, text: "Extra Bold"},
              ]}
            />
          </div>
          <div className='flex w-full justify-between items-center'>
            <h3 className='font-normal text-[14px] laptopXL:text-[1rem] '>
              Size
            </h3>
            <PrimaryNumberCount
              defaultValue={
                typeof text_fontSize == "string" ? 14 : text_fontSize
              }
              onChange={(value) => dispatch(textFontSize(value))}
            />
          </div>
          <div className='flex w-full justify-between items-center'>
            <h3 className='font-normal text-[14px] laptopXL:text-[1rem] '>
              Alignment
            </h3>
            <LogoAlignment
              iconSize={20}
              widthStyle={"w-[50%]"}
              defaultValue={text_alignment}
              onChange={(value) => dispatch(textAlignment(value))}
            />
          </div>
          <div className='flex w-full justify-between items-center'>
            <h3 className='font-normal text-[14px] laptopXL:text-[1rem] '>
              Color
            </h3>
            <ColorPallete
              modalId={"text_color"}
              color={text_color}
              defaultColor='black'
              handleColorChange={(color) => dispatch(textColor(color))}
            />
          </div>
        </div>
      </div>
    </div>
  )
}

export default EditPanel
