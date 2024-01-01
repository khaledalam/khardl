import "slick-carousel/slick/slick.css"
import "slick-carousel/slick/slick-theme.css"
import {IoCloseOutline} from "react-icons/io5"
import ImageIcon from "../../../../assets/imageIcon.svg"
import {useCallback, useState} from "react"
import {useDispatch, useSelector} from "react-redux"
import {
  removeBannersUpload,
  setBannersUpload,
} from "../../../../redux/NewEditor/restuarantEditorSlice"
import ReactSlider from "react-slick"
import {FaCircleChevronLeft, FaCircleChevronRight} from "react-icons/fa6"

const Slider = ({banner_images}) => {
  const bannersUpload =
    useSelector((state) => state.restuarantEditorStyle.bannersUpload) || []
  const bannerBgColor =
    useSelector(
      (state) => state.restuarantEditorStyle.banner_background_color
    ) || ""

  const [sliderCount, setSliderCount] = useState(2)
  const dispatch = useDispatch()

  const handleImagesUpload = (event, idx) => {
    const selectedImage = event.target.files[0]
    //  setUploadImages([...uploadImages, URL.createObjectURL(selectedImage)])
    if (selectedImage) {
      dispatch(
        setBannersUpload({
          index: idx,
          image: URL.createObjectURL(selectedImage),
        })
      )
    }
  }

  const handleRemoveImages = (index) => {
    dispatch(removeBannersUpload({index}))
  }

  const addMoreSlider = useCallback(() => {
    setSliderCount((prev) => prev + 1)
  }, [])

  const settings = {
    dots: true,
    infinite: true,
    autoplay: true,
    speed: 500,
    slidesToShow: 1,
    slidesToScroll: 1,
  }

  return (
    <div style={{backgroundColor: bannerBgColor}} className='w-full p-5'>
      <div className='w-[92%] mx-auto'>
        <ReactSlider {...settings}>
          {Array(
            bannersUpload.length > sliderCount
              ? bannersUpload.length
              : sliderCount
          )
            .fill(1)
            .map((_, index) => (
              <div key={index} className={`h-[300px] !block`}>
                <div
                  style={{
                    backgroundRepeat: "no-repeat",
                    backgroundSize: "cover",
                    backgroundImage:
                      bannersUpload && bannersUpload?.length > 0
                        ? `url(${bannersUpload[index]})`
                        : banner_images && banner_images?.length > 0
                        ? `url(${banner_images[index]})`
                        : ``,
                  }}
                  className={`h-full w-full  rounded-md !flex items-center justify-center  relative  shadow-md `}
                >
                  <input
                    type='file'
                    accept='image/*'
                    id={"imageBanner" + index}
                    name={"imageBanner" + index}
                    onChange={(e) => handleImagesUpload(e, index)}
                    className='hidden'
                  />

                  <div
                    style={{
                      borderRadius: 12,
                    }}
                    className='w-[100px] h-[95px] rounded-lg p-2 bg-neutral-100 relative'
                  >
                    <label htmlFor={"imageBanner" + index}>
                      <img
                        src={
                          (bannersUpload[index] || banner_images[index]) ??
                          ImageIcon
                        }
                        alt={""}
                        className='w-full h-full object-cover'
                      />
                    </label>
                    {(bannersUpload[index] || banner_images[index]) && (
                      <div
                        onClick={() => handleRemoveImages(index)}
                        className='absolute top-[-0.8rem] right-[-1rem] cursor-pointer'
                      >
                        <div className='w-[20px] h-[20px] rounded-full p-1 bg-neutral-100 flex items-center justify-center'>
                          <IoCloseOutline
                            size={16}
                            className='text-red-500 cursor-pointer'
                          />
                        </div>
                      </div>
                    )}
                  </div>
                  <div
                    onClick={addMoreSlider}
                    className='btn btn-circle w-[1.3rem] h-[1.3rem] min-h-[1.3rem] inline-flex leading-[0px] items-center justify-center text-lg absolute bottom-7'
                  >
                    +
                  </div>
                </div>
              </div>
            ))}
        </ReactSlider>
      </div>
    </div>
  )
}

export default Slider
/* 



* */
