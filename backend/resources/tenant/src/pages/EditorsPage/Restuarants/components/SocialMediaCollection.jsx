import React, {useEffect, useState} from "react"
import {useDispatch, useSelector} from "react-redux"
import {
  mediaIconsToSelected,
  moveSelectedIconsToMedia,
  setSelectedSocialMediaId,
  updateSelectedIconInput,
} from "../../../../redux/NewEditor/restuarantEditorSlice"
import {useTranslation} from "react-i18next"
import {AiOutlineClose} from "react-icons/ai"

const SocialMediaCollection = ({showMedia}) => {
  const dispatch = useDispatch()
  const {t} = useTranslation()

  const mediaCollection = useSelector(
    (state) => state.restuarantEditorStyle.mediaCollection
  )
  const selectedMediaId = useSelector(
    (state) => state.restuarantEditorStyle.selectedMediaId
  )

  const selectedSocialIcons = useSelector(
    (state) => state.restuarantEditorStyle.selectedSocialIcons
  )

  const handleMediaToSelected = (iconId) => {
    dispatch(mediaIconsToSelected(iconId))
  }
  const handleSocialMediaSelect = (id) => {
    dispatch(setSelectedSocialMediaId(id))
  }
  const handleRemoveMediaSelect = (id) => {
    dispatch(moveSelectedIconsToMedia(id))
  }

  return (
    <div>
      {showMedia && (
        <div className='flex items-center gap-6 flex-wrap w-[70%] p-3 rounded-xl bg-neutral-100'>
          {mediaCollection.map((media) => (
            <div
              className='bg-neutral-100 w-[30px] h-[30px] rounded-md p-1 flex items-center justify-center'
              key={media.id}
            >
              <img
                src={media.imgUrl}
                alt={media?.name ?? "social media"}
                className='cursor-pointer w-full h-full object-cover'
                onClick={() => handleMediaToSelected(media.id)}
              />
            </div>
          ))}
        </div>
      )}
      <div className='flex items-center gap-3 flex-wrap'>
        {selectedSocialIcons.map(
          (socialMedia) =>
            socialMedia.imgUrl !== "" && (
              <div
                onClick={() => handleSocialMediaSelect(socialMedia.id)}
                className='bg-neutral-100 w-[30px] h-[30px] rounded-md p-1 my-3 flex items-center justify-center relative'
              >
                <img
                  src={socialMedia?.imgUrl}
                  alt={socialMedia?.name ?? "social media"}
                  className='w-full h-full object-cover'
                />
                {socialMedia.id === selectedMediaId && (
                  <button
                    key={socialMedia.id}
                    className='absolute top-[-5px] right-[-4px] text-[10px] text-bold h-fit w-fit rounded-full bg-red-500 p-[3px] text-white'
                    onClick={() => handleRemoveMediaSelect(socialMedia.id)}
                  >
                    <AiOutlineClose size={7} />
                  </button>
                )}
              </div>
            )
        )}
      </div>
      {selectedSocialIcons &&
        selectedSocialIcons.map((socialMedia) => (
          <div className='' key={socialMedia.id}>
            {socialMedia.id === selectedMediaId && (
              <input
                type='text'
                value={socialMedia?.link}
                placeholder={`${socialMedia.name ?? "social media"} ${t(
                  "Link"
                )}`}
                className='input input-bordered w-full max-w-[70%]'
                onChange={(e) =>
                  dispatch(
                    updateSelectedIconInput({
                      id: socialMedia.id,
                      link: e.target.value,
                    })
                  )
                }
              />
            )}
          </div>
        ))}
    </div>
  )
}

export default SocialMediaCollection
