import "swiper/css"
import "swiper/css/navigation"
import "swiper/css/pagination"
import {Swiper, SwiperSlide} from "swiper/react"
import {Navigation, Pagination} from "swiper/modules"
import {IoCloseOutline} from "react-icons/io5"
import ImageIcon from "../../../../assets/imageIcon.svg"
import {useCallback, useState} from "react"

const Slider = ({banner_images}) => {
  const [uploadImages, setUploadImages] = useState([])

  const handleImagesUpload = useCallback((event, idx) => {
    const selectedImage = event.target.files[0]
    const selectedImages = []
    if (selectedImage) {
      selectedImages.push(selectedImage)
      setUploadImages(selectedImages)
    }
    if (selectedImages[idx]) {
      selectedImages.splice(idx, 1)
      selectedImages[idx] = selectedImage
      setUploadImages(selectedImages)
    }
  }, [])

  console.log("uploaded images", uploadImages)

  return (
    <Swiper
      modules={[Pagination, Navigation]}
      pagination={{clickable: true}}
      navigation={true}
      slideClass='swiper-slide'
    >
      {Array(10)
        .fill(1)
        .map((_, index) => (
          <SwiperSlide key={index}>
            <div
              style={{
                backgroundImage:
                  uploadImages.length > 0
                    ? `url(${URL.createObjectURL(uploadImages[index])})`
                    : `url(${
                        banner_images.length > 0 && banner_images[index]
                      })`,
              }}
              className={`h-[280px] rounded-md flex items-center justify-center   shadow-md`}
            >
              <input
                type='file'
                accept='image/*'
                id='imageBanner'
                onChange={(e) => handleImagesUpload(e, index)}
                className='hidden'
              />

              <label htmlFor='imageBanner'>
                <div
                  style={{
                    borderRadius: 12,
                  }}
                  className='w-[100px] h-[95px] rounded-lg p-2 bg-neutral-100 relative'
                >
                  <img
                    src={
                      banner_images[index] ? banner_images[index] : ImageIcon
                    }
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
              </label>
            </div>
          </SwiperSlide>
        ))}
    </Swiper>
  )
}

export default Slider
