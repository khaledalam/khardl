import React, {useState} from "react"
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

const SocialMediaCollection = () => {
  const [selectedMedia, setSelectedMedia] = useState(null)
  return (
    <div>
      <div className='flex items-center gap-6 flex-wrap w-[70%] p-3 rounded-xl bg-neutral-100'>
        {mediaCollection.map((media) => (
          <img
            src={media.imageSrc}
            alt={media.id}
            key={media.id}
            className='cursor-pointer'
            onClick={() => setSelectedMedia(media)}
          />
        ))}
      </div>
      {selectedMedia && (
        <div className='bg-neutral-100 w-[35px] h-[35px] rounded-md p-1 my-3 flex items-center justify-center'>
          <img src={selectedMedia.imageSrc} alt={selectedMedia.id} />
        </div>
      )}
      {selectedMedia && (
        <div className=''>
          <input
            type='text'
            placeholder={`Write ${selectedMedia.name.toLowerCase()} link`}
            className='input input-bordered w-full max-w-[70%]'
          />
        </div>
      )}
    </div>
  )
}

export default SocialMediaCollection
