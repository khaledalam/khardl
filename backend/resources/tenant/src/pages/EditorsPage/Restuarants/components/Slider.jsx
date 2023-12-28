import "swiper/css"
import "swiper/css/navigation"
import "swiper/css/pagination"
import {Swiper, SwiperSlide} from "swiper/react"
import {Navigation, Pagination} from "swiper/modules"
import {IoCloseOutline} from "react-icons/io5"
import ImageIcon from "../../../../assets/imageIcon.svg"
import ImgRestBanner from "../../../../assets/bannerRestuarant.png"
import {useCallback, useEffect, useRef, useState} from "react"
import {useDispatch} from "react-redux"
import {setBannersUpload} from "../../../../redux/NewEditor/restuarantEditorSlice"
import {FaCircleChevronLeft, FaCircleChevronRight} from "react-icons/fa6"

const Slider = ({banner_images}) => {
  const [uploadImages, setUploadImages] = useState([])
  const [sliderCount, setSliderCount] = useState(2)
  const dispatch = useDispatch()

  const navigationPrevRef = useRef(null)
  const navigationNextRef = useRef(null)

  const handleImagesUpload = (event, idx) => {
    const selectedImage = event.target.files[0]
    dispatch(
      setBannersUpload([...uploadImages, URL.createObjectURL(selectedImage)])
    )
    setUploadImages([...uploadImages, URL.createObjectURL(selectedImage)])
  }

  const addMoreSlider = useCallback(() => {
    setSliderCount((prev) => prev + 1)
  }, [])

  return (
    <Swiper
      modules={[Pagination, Navigation]}
      pagination={{clickable: true}}
      navigation={true}
      slideClass='swiper-slide'
    >
      {Array(sliderCount)
        .fill(1)
        .map((_, index) => (
          <SwiperSlide key={index}>
            <div
              style={{
                backgroundImage:
                  uploadImages && uploadImages?.length > 0
                    ? `url(${uploadImages[index]})`
                    : banner_images && banner_images?.length > 0
                    ? `url(${banner_images[index]})`
                    : `url(${ImgRestBanner})`,
              }}
              className={`h-[280px] rounded-md flex items-center justify-center  relative  shadow-md`}
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
                      (uploadImages[index] || banner_images[index]) ?? ImageIcon
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
              <div
                onClick={addMoreSlider}
                className='btn btn-circle w-[1.3rem] h-[1.3rem] min-h-[1.3rem] inline-flex leading-[0px] items-center justify-center text-lg absolute bottom-7'
              >
                +
              </div>
            </div>
          </SwiperSlide>
        ))}
      {/* <div className='prev-btn' ref={navigationPrevRef}>
        <FaCircleChevronLeft size={25} />
      </div>
      <span className='next-btn' ref={navigationNextRef}>
        <FaCircleChevronRight size={25} />
      </span> */}
    </Swiper>
  )
}

export default Slider
