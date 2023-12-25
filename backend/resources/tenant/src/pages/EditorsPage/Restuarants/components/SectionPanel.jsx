import React, {Fragment, useCallback, useState} from "react"
import PrimarySelect from "./PrimarySelect"
import LogoAlignment from "./LogoAlignment"
import CategoryAlign from "./CategoryAlign"
import SocialMediaCollection from "./SocialMediaCollection"
import {IoAdd} from "react-icons/io5"
import PhoneInput from "react-phone-input-2"
import {useSelector, useDispatch} from "react-redux"
import {
  bannerType,
  categoryAlignment,
  categoryDetailAlignment,
  logoAlignment,
  headerPosition as setHeaderPosition,
  socialMediaIconsAlignment,
  phoneNumber as setPhoneNumber,
  phoneNumberAlignment,
  categoryType,
  categoryDetailType,
} from "../../../../redux/NewEditor/restuarantEditorSlice"

const SectionPanel = () => {
  const dispatch = useDispatch()
  const restuarantEditorStyle = useSelector(
    (state) => state.restuarantEditorStyle
  )

  const {
    headerPosition,
    logo_alignment,
    banner_type,
    category_alignment,
    categoryDetail_alignment,
    socialMediaIcons_alignment,
    phoneNumber,
    phoneNumber_alignment,
    categoryDetail_type,
    category_type,
  } = restuarantEditorStyle

  return (
    <div className='p-2 w-full'>
      <div className='pb-4 border-b border-neutral-300'>
        <h2 className='font-bold text-lg mb-4'>Header</h2>
        <PrimarySelect
          label={"Position"}
          defaultValue={headerPosition}
          handleChange={(value) => dispatch(setHeaderPosition(value))}
          options={[
            {value: "fixed", text: "Fixed"},
            {value: "relative", text: "Relative"},
          ]}
        />
      </div>
      <div className='py-4 border-b border-neutral-300'>
        <div className='flex items-center justify-between w-[70%] px-2'>
          <h2 className='font-bold text-lg'>Logo</h2>
          <LogoAlignment
            defaultValue={logo_alignment}
            onChange={(value) => dispatch(logoAlignment(value))}
          />
        </div>
      </div>
      <div className='py-4 border-b border-neutral-300'>
        <h2 className='font-bold text-lg mb-4'>Banner</h2>
        <PrimarySelect
          defaultValue={banner_type}
          handleChange={(value) => dispatch(bannerType(value))}
          options={[
            {value: "slider", text: "Slider"},
            {value: "one-page", text: "One-Page"},
          ]}
        />
      </div>
      <div className='py-4 border-b border-neutral-300'>
        <h2 className='font-bold text-lg mb-4'>Category</h2>
        <CategoryAlign
          label={"Type"}
          defaultValue={category_type}
          onChange={(value) => dispatch(categoryType(value))}
        />
        <div className='mt-3'>
          <PrimarySelect
            label={"Content"}
            defaultValue={category_alignment}
            handleChange={(value) => dispatch(categoryAlignment(value))}
            options={[
              {value: "left", text: "Left"},
              {value: "center", text: "Center"},
              {value: "right", text: "Right"},
            ]}
          />
        </div>
      </div>
      <div className='py-4 border-b border-neutral-300'>
        <h2 className='font-bold text-lg mb-4'>Category Details</h2>
        <CategoryAlign
          label={"Type"}
          defaultValue={categoryDetail_type}
          onChange={(value) => dispatch(categoryDetailType(value))}
        />
        <div className='mt-3'>
          <PrimarySelect
            label={"Content"}
            defaultValue={categoryDetail_alignment}
            handleChange={(value) => dispatch(categoryDetailAlignment(value))}
            options={[
              {value: "left", text: "Left"},
              {value: "center", text: "Center"},
              {value: "right", text: "Right"},
            ]}
          />
        </div>
      </div>

      <div className='py-4 border-b border-neutral-300 '>
        <div className='flex items-center justify-between p-2 w-[70%] mb-4 '>
          <h2 className='font-bold text-lg '>Social Media</h2>
          <IoAdd size={25} />
        </div>
        <SocialMediaCollection />
        <div className='mt-3'>
          <PrimarySelect
            label={"Content"}
            defaultValue={socialMediaIcons_alignment}
            handleChange={(value) => dispatch(socialMediaIconsAlignment(value))}
            options={[
              {value: "left", text: "Left"},
              {value: "center", text: "Center"},
              {value: "right", text: "Right"},
            ]}
          />
        </div>
      </div>

      <div className='py-4 border-b border-neutral-300'>
        <h2 className='font-bold text-lg mb-4'>Phone Number</h2>
        <div className='w-[70%]'>
          <PhoneInput
            country={"sa"}
            value={phoneNumber}
            onChange={(phone) => dispatch(setPhoneNumber(phone))}
            containerClass='!w-full'
            inputClass='!w-full !h-[48px] !text-[1rem]'
          />{" "}
        </div>
        <div className='mt-3'>
          <PrimarySelect
            label={"Content"}
            defaultValue={phoneNumber_alignment}
            handleChange={(value) => dispatch(phoneNumberAlignment(value))}
            options={[
              {value: "left", text: "Left"},
              {value: "center", text: "Center"},
              {value: "right", text: "Right"},
            ]}
          />
        </div>
      </div>
    </div>
  )
}

export default SectionPanel
