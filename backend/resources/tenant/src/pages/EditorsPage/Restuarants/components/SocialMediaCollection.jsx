import React, {useEffect, useState} from "react"
import ImgTelegram from "../../../../assets/imgTelgram.svg"
import ImgYoutube from "../../../../assets/imgYoutube.svg"
import ImgInstagram from "../../../../assets/ImgInstagram.svg"
import ImgFacebook from "../../../../assets/imgFB.svg"
import ImgLinkedin from "../../../../assets/Linkedin.svg"
import ImgTiktok from "../../../../assets/Tiktok.svg"
import ImgMsger from "../../../../assets/Msgner.svg"
import ImgX from "../../../../assets/Xtwitter.svg"

const mediaCollection = [
  {
    id: 1,
    name: "Telegram",
    imageSrc: ImgTelegram,
  },
  {
    id: 2,
    name: "Youtube",
    imageSrc: ImgYoutube,
  },
  {
    id: 3,
    name: "Instagram",
    imageSrc: ImgInstagram,
  },
  {
    id: 4,
    name: "Facebook",
    imageSrc: ImgFacebook,
  },
  {
    id: 5,
    name: "LinkedIn",
    imageSrc: ImgLinkedin,
  },
  {
    id: 6,
    name: "Tiktok",
    imageSrc: ImgLinkedin,
  },
  {
    id: 7,
    name: "Messenger",
    imageSrc: ImgMsger,
  },
  {
    id: 8,
    name: "X",
    imageSrc: ImgX,
  },
]

const SocialMediaCollection = ({onChange, showMedia, selectedSocialIcons}) => {
  const [selectedMedia, setSelectedMedia] = useState([])
  const [selectedSingleMedia, setSelectedSingleMedia] = useState()
  const [socialUrl, setSocialUrl] = useState("")

  useEffect(() => {
    onChange({
      name: selectedSingleMedia ? selectedSingleMedia?.name : "",
      imageUrl: selectedSingleMedia ? selectedSingleMedia?.imageSrc : "",
      link: socialUrl,
    })
  }, [selectedSingleMedia, socialUrl])

  return (
    <div>
      {showMedia && (
        <div className='flex items-center gap-6 flex-wrap w-[70%] p-3 rounded-xl bg-neutral-100'>
          {mediaCollection.map((media) => (
            <img
              src={media.imageSrc}
              alt={media.id}
              key={media.id}
              className='cursor-pointer'
              onClick={() => {
                setSelectedMedia((prev) => [...prev, media])
              }}
            />
          ))}
        </div>
      )}
      <div className='flex items-center gap-3 flex-wrap'>
        {selectedSocialIcons
          ? selectedSocialIcons.map((socialMedia) => (
              <div
                key={socialMedia.id}
                onClick={() => {
                  setSocialUrl("")
                  setSelectedSingleMedia(socialMedia)
                }}
                className='bg-neutral-100 w-[35px] h-[35px] rounded-md p-1 my-3 flex items-center justify-center'
              >
                <img src={socialMedia.imgUrl} alt={"social icon"} />
              </div>
            ))
          : selectedMedia.map((socialMedia) => (
              <div
                key={socialMedia.id}
                onClick={() => {
                  setSocialUrl("")
                  setSelectedSingleMedia(socialMedia)
                }}
                className='bg-neutral-100 w-[35px] h-[35px] rounded-md p-1 my-3 flex items-center justify-center'
              >
                <img src={socialMedia.imageSrc} alt={socialMedia.name} />
              </div>
            ))}
      </div>
      {selectedSingleMedia && (
        <div className=''>
          <input
            type='text'
            value={
              selectedSingleMedia.link ? selectedSingleMedia.link : socialUrl
            }
            placeholder={`Write ${
              selectedSingleMedia?.name?.toLowerCase() ?? "social media"
            } link`}
            className='input input-bordered w-full max-w-[70%]'
            onChange={(e) => setSocialUrl(e.target.value)}
          />
        </div>
      )}
    </div>
  )
}

export default SocialMediaCollection
