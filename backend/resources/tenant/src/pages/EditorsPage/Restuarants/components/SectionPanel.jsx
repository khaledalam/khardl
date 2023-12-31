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
import {BiMinus} from "react-icons/bi"
import {useTranslation} from "react-i18next"
import PrimaryOriginSelect from "./PrimaryOriginSelect"

const SectionPanel = () => {
  const dispatch = useDispatch()
  const {t} = useTranslation()
  const restuarantEditorStyle = useSelector(
    (state) => state.restuarantEditorStyle
  )
  const [showSocialMedia, setShowSocialMedia] = useState(false)

  const {
    headerPosition,
    logo_alignment,
    banner_type,
    category_alignment,
    categoryDetail_alignment,
    socialMediaIcons_alignment,
    selectedSocialIcons,
    phoneNumber,
    phoneNumber_alignment,
    categoryDetail_type,
    category_type,
  } = restuarantEditorStyle

  return (
    <div className='p-2 w-full'>
      <div className='pb-4 border-b border-neutral-300'>
        <h2 className='font-bold text-lg mb-4'>{t("Header")}</h2>
        <PrimarySelect
          label={t("Position")}
          defaultValue={
            headerPosition === "relative" ? t("Relative") : t("Fixed")
          }
          handleChange={(value) => dispatch(setHeaderPosition(value))}
          options={[
            {value: "fixed", text: t("Fixed")},
            {value: "relative", text: t("Relative")},
          ]}
        />
      </div>
      <div className='py-4 border-b border-neutral-300'>
        <div className='flex items-center justify-between w-[70%] px-2'>
          <h2 className='font-bold text-lg'>{t("Logo")}</h2>
          <LogoAlignment
            defaultValue={logo_alignment}
            onChange={(value) => dispatch(logoAlignment(value))}
          />
        </div>
      </div>
      <div className='py-4 border-b border-neutral-300'>
        <h2 className='font-bold text-lg mb-4'>{t("Banner")}</h2>
        <PrimarySelect
          defaultValue={
            banner_type === "one-photo"
              ? t("One-photo")
              : banner_type === "slider"
              ? t("Slider")
              : banner_type
          }
          handleChange={(value) => dispatch(bannerType(value))}
          options={[
            {value: "slider", text: t("Slider")},
            {value: "one-photo", text: t("One-photo")},
          ]}
        />
      </div>
      <div className='py-4 border-b border-neutral-300'>
        <h2 className='font-bold text-lg mb-4'>{t("Category")}</h2>
        {/* <CategoryAlign
          label={"Type"}
          defaultValue={category_type}
          onChange={(value) => dispatch(categoryType(value))}
        /> */}
        <div className='mt-3'>
          <PrimarySelect
            label={t("Content")}
            defaultValue={
              category_alignment === "center"
                ? t("Center")
                : category_alignment === "left"
                ? t("Left")
                : category_alignment === "right"
                ? t("Right")
                : ""
            }
            handleChange={(value) => dispatch(categoryAlignment(value))}
            options={[
              {value: "left", text: t("Left")},
              {value: "center", text: t("Center")},
              {value: "right", text: t("Right")},
            ]}
          />
        </div>
      </div>
      {/* <div className='py-4 border-b border-neutral-300'>
        <h2 className='font-bold text-lg mb-4'>Category Details</h2>
        <CategoryAlign
          label={"Type"}
          defaultValue={categoryDetail_type}
          onChange={(value) => dispatch(categoryDetailType(value))}
        />
        <div className='mt-3'>
          <PrimarySelect
            label={t("Content")}
            defaultValue={categoryDetail_alignment}
            handleChange={(value) => dispatch(categoryDetailAlignment(value))}
            options={[
              {value: t('left'), text: t('left')},
              {value: "center", text: "Center"},
              {value: t('Right'), text: t('Right')},
            ]}
          />
        </div>
      </div> */}

      <div className='py-4 border-b border-neutral-300 '>
        <div className='flex items-center justify-between p-2 w-[70%] mb-4 '>
          <h2 className='font-bold text-lg '>{t("Social Media")}</h2>
          {showSocialMedia ? (
            <BiMinus
              size={25}
              className='cursor-pointer'
              onClick={() => setShowSocialMedia((prev) => !prev)}
            />
          ) : (
            <IoAdd
              size={25}
              className='cursor-pointer'
              onClick={() => setShowSocialMedia((prev) => !prev)}
            />
          )}
        </div>
        <SocialMediaCollection
          showMedia={showSocialMedia}
          selectedSocialIcons={selectedSocialIcons}
        />
        <div className='mt-3'>
          <PrimarySelect
            label={t("Content")}
            defaultValue={
              socialMediaIcons_alignment === "center"
                ? t("Center")
                : socialMediaIcons_alignment === "left"
                ? t("Left")
                : socialMediaIcons_alignment === "right"
                ? t("Right")
                : ""
            }
            handleChange={(value) => dispatch(socialMediaIconsAlignment(value))}
            options={[
              {value: "left", text: t("Left")},
              {value: "center", text: t("Center")},
              {value: "right", text: t("Right")},
            ]}
          />
        </div>
      </div>

      <div className='py-4 border-b border-neutral-300'>
        <h2 className='font-bold text-lg mb-4'>{t("Phone")}</h2>
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
            label={t("Content")}
            defaultValue={
              phoneNumber_alignment === "center"
                ? t("Center")
                : phoneNumber_alignment === "left"
                ? t("Left")
                : phoneNumber_alignment === "right"
                ? t("Right")
                : ""
            }
            handleChange={(value) => dispatch(phoneNumberAlignment(value))}
            options={[
              {value: "left", text: t("Left")},
              {value: "center", text: t("Center")},
              {value: "right", text: t("Right")},
            ]}
          />
        </div>
      </div>
    </div>
  )
}

export default SectionPanel
