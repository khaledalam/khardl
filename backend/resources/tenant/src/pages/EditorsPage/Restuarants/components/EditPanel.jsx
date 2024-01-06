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
  productBackgroundColor,
} from "../../../../redux/NewEditor/restuarantEditorSlice"
import PrimaryOriginSelect from "./PrimaryOriginSelect"
import {useTranslation} from "react-i18next"

const EditPanel = () => {
  const restuarantEditorStyle = useSelector(
    (state) => state.restuarantEditorStyle
  )
  const {
    page_color,
    page_category_color,
    product_background_color,
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
  const {t} = useTranslation()

  return (
    <div
      className='w-full h-full'
      style={{fontWeight: `${text_fontWeight}!important`}}
    >
      {/* shape  */}
      <div className='py-4 border-b border-neutral-300 px-2'>
        <h2 className='font-bold text-lg mb-4'>{t("Shape")}</h2>
        <div className='flex flex-col gap-4'>
          <div className='flex w-full justify-between items-center'>
            <h3 className='font-normal text-[14px] laptopXL:text-[1rem] '>
              {t("Logo")}
            </h3>
            <PrimarySelect
              widthStyle={"w-[50%]"}
              defaultValue={
                logo_shape === "rounded"
                  ? t("Rounded")
                  : logo_shape === "sharp"
                  ? t("Sharp")
                  : ""
              }
              handleChange={(value) => dispatch(logoShape(value))}
              options={[
                {value: "rounded", text: t("Rounded")},
                {value: "sharp", text: t("Sharp")},
              ]}
            />
          </div>
          <div className='flex w-full justify-between items-center'>
            <h3 className='font-normal text-[14px] laptopXL:text-[1rem] '>
              {t("Banner")}
            </h3>
            <PrimaryOriginSelect
              widthStyle={"w-[50%]"}
              defaultValue={
                banner_shape === "rounded"
                  ? t("Rounded")
                  : banner_shape === "sharp"
                  ? t("Sharp")
                  : ""
              }
              handleChange={(value) => dispatch(bannerShape(value))}
              options={[
                {value: "rounded", text: t("Rounded")},
                {value: "sharp", text: t("Sharp")},
              ]}
            />
          </div>
          <div className='flex w-full justify-between items-center'>
            <h3 className='font-normal text-[14px] laptopXL:text-[1rem] '>
              {t("Category")}
            </h3>
            <PrimarySelect
              widthStyle={"w-[50%]"}
              defaultValue={
                category_shape === "rounded"
                  ? t("Rounded")
                  : category_shape === "sharp"
                  ? t("Sharp")
                  : ""
              }
              handleChange={(value) => dispatch(categoryShape(value))}
              options={[
                {value: "rounded", text: t("Rounded")},
                {value: "sharp", text: t("Sharp")},
              ]}
            />
          </div>
          <div className='flex w-full justify-between items-center'>
            <h3 className='font-normal text-[14px] laptopXL:text-[1rem] '>
              {t("Category Detail")}
            </h3>
            <PrimarySelect
              widthStyle={"w-[50%]"}
              defaultValue={
                categoryDetail_shape === "rounded"
                  ? t("Rounded")
                  : categoryDetail_shape === "sharp"
                  ? t("Sharp")
                  : ""
              }
              handleChange={(value) => dispatch(categoryDetailShape(value))}
              options={[
                {value: "rounded", text: t("Rounded")},
                {value: "sharp", text: t("Sharp")},
              ]}
            />
          </div>
        </div>
      </div>
      {/* colors */}
      <div className='py-4 border-b border-neutral-300 px-2'>
        <h2 className='font-bold text-lg  mb-4'>{t("Color")}</h2>
        <div className='flex flex-col gap-4 w-full '>
          <div className='flex w-full justify-between items-center'>
            <h3 className='capitalize font-normal text-[14px] laptopXL:text-[1rem] '>
              {t("page")}
            </h3>
            <ColorPallete
              modalId={"page-modal"}
              color={page_color}
              handleColorChange={(color) => dispatch(pageColor(color))}
            />
          </div>
          <div className='flex w-full justify-between items-center'>
            <h3 className='font-normal text-[14px] laptopXL:text-[1rem] '>
              {t("page")} {t("Category")}
            </h3>
            <ColorPallete
              modalId={"page_category"}
              color={page_category_color}
              handleColorChange={(color) => dispatch(pageCategoryColor(color))}
            />
          </div>
          <div className='flex w-full justify-between items-center'>
            <h3 className='font-normal text-[14px] laptopXL:text-[1rem] '>
              {t("page")} {t("Banner")}
            </h3>
            <ColorPallete
              modalId={"page_banner"}
              color={banner_background_color}
              handleColorChange={(color) => dispatch(bannerBgColor(color))}
            />
          </div>
          <div className='flex w-full justify-between items-center'>
            <h3 className='font-normal text-[14px] laptopXL:text-[1rem] '>
              {t("Product Background")}
            </h3>
            <ColorPallete
              modalId={"product_background_color"}
              color={product_background_color}
              handleColorChange={(color) =>
                dispatch(productBackgroundColor(color))
              }
            />
          </div>
          <div className='flex w-full justify-between items-center'>
            <h3 className='font-normal text-[14px] laptopXL:text-[1rem] '>
              {t("Category Animation")}
            </h3>
            <ColorPallete
              modalId={"categoryAnimation"}
              color={category_hover_color}
              handleColorChange={(color) => dispatch(categoryHoverColor(color))}
            />
          </div>
          <div className='flex w-full justify-between items-center'>
            <h3 className='font-normal text-[14px] laptopXL:text-[1rem] '>
              {t("Category Detail Cart")}
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
              {t("price")}
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
              {t("Header")}
            </h3>
            <ColorPallete
              modalId={"header"}
              color={header_color}
              handleColorChange={(color) => dispatch(headerColor(color))}
            />
          </div>
          <div className='flex w-full justify-between items-center'>
            <h3 className='font-normal text-[14px] laptopXL:text-[1rem] '>
              {t("Footer_Color")}
            </h3>
            <ColorPallete
              modalId={"footer_modal"}
              color={footer_color}
              handleColorChange={(color) => dispatch(footerColor(color))}
            />
          </div>
        </div>
      </div>
      {/* Text */}
      <div className='py-4 border-b border-neutral-300 px-2'>
        <h2 className='font-bold text-lg mb-4'>{t("Text")}</h2>
        <div className='flex flex-col gap-4'>
          <div className='flex w-full justify-between items-center'>
            <h3 className='font-normal text-[14px] laptopXL:text-[1rem] '>
              {t("Fonts")}
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
              {t("Weight")}
            </h3>
            <PrimaryOriginSelect
              widthStyle={"w-[50%]"}
              defaultValue={text_fontWeight}
              handleChange={(e) => dispatch(textFontWeight(e.target.value))}
              options={[
                {value: 200, text: t("Thin")},
                {value: 300, text: t("Light")},
                {value: 400, text: t("Regular")},
                {value: 500, text: t("Medium")},
                {value: 600, text: t("Semibold")},
                {value: 700, text: t("Bold")},
              ]}
            />
          </div>
          <div className='flex w-full justify-between items-center'>
            <h3 className='font-normal text-[14px] laptopXL:text-[1rem] '>
              {t("Size")}
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
              {t("Alignment")}
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
              {t("Color")}
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
