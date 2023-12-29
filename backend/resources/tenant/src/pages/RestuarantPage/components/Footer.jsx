import React from "react"
import imgWhatsapp from "../../../assets/whatsappImg.svg"
import {useSelector} from "react-redux"

const FooterRestuarant = () => {
  const restaurantStyle = useSelector((state) => state.restuarantEditorStyle)

  return (
    <div className='w-full flex flex-col gap-4'>
      <div
        style={{background: restaurantStyle?.footer_color}}
        className='w-full b h-[85px] flex flex-col gap-4  items-center justify-center'
      >
        <div
          className={`flex flex-col gap-3 ${
            restaurantStyle?.socialMediaIcons_alignment === "center"
              ? "items-center justify-center"
              : restaurantStyle?.socialMediaIcons_alignment === "left"
              ? "items-center justify-start"
              : restaurantStyle?.socialMediaIcons_alignment === "right"
              ? "items-center justify-end"
              : ""
          }`}
        >
          <div className='flex items-center gap-3'>
            {restaurantStyle?.selectedSocialIcons?.map((socialMedia, idx) => (
              <div className='w-[30px] h-[30px]' key={idx + "icons"}>
                <img
                  src={socialMedia?.imgUrl ? socialMedia.imgUrl : imgWhatsapp}
                  alt='social media'
                  className='w-full h-full object-contain'
                />
              </div>
            ))}
          </div>
        </div>
        <div
          className={`flex flex-col gap-3 ${
            restaurantStyle?.phoneNumber_alignment === "center"
              ? "items-center justify-center"
              : restaurantStyle?.phoneNumber_alignment === "left"
              ? "items-center justify-start"
              : restaurantStyle?.phoneNumber_alignment === "right"
              ? "items-center justify-end"
              : ""
          }`}
        >
          {" "}
          <h3
            style={{color: restaurantStyle?.text_color}}
            className='font-semibol'
          >
            {restaurantStyle?.phoneNumber}
          </h3>
        </div>
      </div>
      <h3 className='pl-16 text-[1rem] text-black font-medium'>
        &copy; All Right Reserved.
      </h3>
    </div>
  )
}

export default FooterRestuarant
