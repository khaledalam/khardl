import React, {useState} from "react"
import PrimarySelect from "./PrimarySelect"
import ColorPallete from "./ColorPallete"

const EditPanel = () => {
  const [logoShape, setLogoShape] = useState("Rounded")
  const [pageColor, setPageColor] = useState({hex: "#ffffff"})
  const [categoryAnimeColor, setCategoryAnimeColor] = useState({hex: "#ffffff"})
  const [categoryDetailColor, setCategoryDetailColor] = useState({
    hex: "#ffffff",
  })
  const [headerColor, setHeaderColor] = useState({hex: "#ffffff"})
  const [footerColor, setFooterColor] = useState({hex: "#ffffff"})

  return (
    <div className='w-full h-full'>
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
              defaultValue={logoShape}
              handleChange={(value) => setLogoShape(value)}
              options={[
                {value: "rounded", text: "Rounded"},
                {value: "rounded", text: "Rounded"},
              ]}
            />
          </div>
          <div className='flex w-full justify-between items-center'>
            <h3 className='font-normal text-[14px] laptopXL:text-[1rem] '>
              Banner
            </h3>
            <PrimarySelect
              widthStyle={"w-[50%]"}
              defaultValue={logoShape}
              handleChange={(value) => setLogoShape(value)}
              options={[
                {value: "rounded", text: "Rounded"},
                {value: "rounded", text: "Rounded"},
              ]}
            />
          </div>
          <div className='flex w-full justify-between items-center'>
            <h3 className='font-normal text-[14px] laptopXL:text-[1rem] '>
              Category
            </h3>
            <PrimarySelect
              widthStyle={"w-[50%]"}
              defaultValue={logoShape}
              handleChange={(value) => setLogoShape(value)}
              options={[
                {value: "rounded", text: "Rounded"},
                {value: "rounded", text: "Rounded"},
              ]}
            />
          </div>
          <div className='flex w-full justify-between items-center'>
            <h3 className='font-normal text-[14px] laptopXL:text-[1rem] '>
              Category Detail
            </h3>
            <PrimarySelect
              widthStyle={"w-[50%]"}
              defaultValue={logoShape}
              handleChange={(value) => setLogoShape(value)}
              options={[
                {value: "rounded", text: "Rounded"},
                {value: "rounded", text: "Rounded"},
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
              color={pageColor}
              handleColorChange={(color) => setPageColor(color)}
            />
          </div>
          <div className='flex w-full justify-between items-center'>
            <h3 className='font-normal text-[14px] laptopXL:text-[1rem] '>
              Category Animation
            </h3>
            <ColorPallete
              modalId={"categoryAnimation"}
              color={categoryAnimeColor}
              handleColorChange={(color) => setCategoryAnimeColor(color)}
            />
          </div>
          <div className='flex w-full justify-between items-center'>
            <h3 className='font-normal text-[14px] laptopXL:text-[1rem] '>
              Category Detail Cart
            </h3>
            <ColorPallete
              modalId={"categoryDetails"}
              color={categoryDetailColor}
              handleColorChange={(color) => setCategoryDetailColor(color)}
            />
          </div>
          <div className='flex w-full justify-between items-center'>
            <h3 className='font-normal text-[14px] laptopXL:text-[1rem] '>
              Header
            </h3>
            <ColorPallete
              modalId={"header"}
              color={headerColor}
              handleColorChange={(color) => setHeaderColor(color)}
            />
          </div>
          <div className='flex w-full justify-between items-center'>
            <h3 className='font-normal text-[14px] laptopXL:text-[1rem] '>
              Footer
            </h3>
            <ColorPallete
              modalId={"footer_modal"}
              color={footerColor}
              handleColorChange={(color) => setFooterColor(color)}
            />
          </div>
        </div>
      </div>
    </div>
  )
}

export default EditPanel
