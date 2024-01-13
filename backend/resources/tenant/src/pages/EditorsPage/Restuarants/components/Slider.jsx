import {IoCloseOutline} from "react-icons/io5"
import ImageIcon from "../../../../assets/imageIcon.svg"
import {useCallback, useState} from "react"
import {useDispatch, useSelector} from "react-redux"
import {
  removeBannersUpload,
  setBannersUpload,
} from "../../../../redux/NewEditor/restuarantEditorSlice"
import ReactSlider from "react-slick"
import bannerPlaceholder from "../../../../assets/banner-placeholder.jpg"
import {BiCloudUpload} from "react-icons/bi"

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
    if (selectedImage.type.includes("video")) {
      dispatch(
        setBannersUpload({
          index: idx,
          image: {
            type: "video",
            url: URL.createObjectURL(selectedImage),
          },
        })
      )
    } else {
      dispatch(
        setBannersUpload({
          index: idx,
          image: {
            type: "image",
            url: URL.createObjectURL(selectedImage),
          },
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

  const removeEachSlide = useCallback(() => {
    if (sliderCount > 2 || bannersUpload.length > 2) {
      setSliderCount((prev) => prev - 1)
    }
  }, [bannersUpload, sliderCount])

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
                        ? `url(${bannersUpload[index]?.url})`
                        : banner_images && banner_images?.length > 0
                        ? `url(${banner_images[index]?.url})`
                        : `url(${bannerPlaceholder})`,
                  }}
                  className={`h-full w-full  rounded-md !flex items-center  justify-center  relative  shadow-md `}
                >
                  <input
                    type='file'
                    accept='video/*, image/*'
                    id={"imageBanner" + index}
                    name={"imageBanner" + index}
                    onChange={(e) => handleImagesUpload(e, index)}
                    className='hidden'
                  />
                  {bannersUpload &&
                  bannersUpload.length > 0 &&
                  bannersUpload[index]?.type === "video" ? (
                    <>
                      <video
                        controls
                        className='absolute top-0 right-0 bottom-0 left-0 w-full max-h-[300px]'
                      >
                        <source
                          src={
                            bannersUpload[index]?.url
                              ? bannersUpload[index]?.url
                              : ""
                          }
                          type='video/mp4'
                        />
                        Your browser does not support the video tag.
                      </video>
                      <div
                        style={{
                          borderRadius: 12,
                        }}
                        className='w-14 h-14 rounded-lg p-2 flex z-10 items-center justify-center bg-neutral-100 relative'
                      >
                        <label htmlFor={"imageBanner" + index}>
                          {bannersUpload[index]?.url ||
                          banner_images[index]?.url ? (
                            <IoCloseOutline
                              size={28}
                              className='text-red-500'
                              onClick={() => handleRemoveImages(index)}
                            />
                          ) : (
                            <BiCloudUpload size={28} />
                          )}
                        </label>
                      </div>
                      <label htmlFor={"imageBanner" + index}>
                        <div className='w-1'></div>
                      </label>
                    </>
                  ) : (
                    <div
                      style={{
                        borderRadius: 12,
                      }}
                      className='w-[100px] h-[95px] rounded-lg p-2 bg-neutral-100 relative'
                    >
                      <label htmlFor={"imageBanner" + index}>
                        <img
                          src={
                            (bannersUpload[index]?.url ||
                              banner_images[index]?.url) ??
                            ImageIcon
                          }
                          alt={""}
                          className='w-full h-full object-cover'
                        />
                      </label>
                      {(bannersUpload[index]?.url ||
                        banner_images[index]?.url) && (
                        <div
                          onClick={() => handleRemoveImages(index)}
                          className='absolute top-[-0.8rem] right-[-1rem] cursor-pointer'
                        >
                          <div className='w-[20px] h-[20px] rounded-full p-1 bg-neutral-100 flex items-center cursor-pointer justify-center'>
                            <IoCloseOutline
                              size={16}
                              className='text-red-500 cursor-pointer'
                            />
                          </div>
                        </div>
                      )}
                    </div>
                  )}

                  <button
                    onClick={removeEachSlide}
                    disabled={sliderCount <= 2}
                    className='btn btn-circle w-[1.3rem] h-[1.3rem] min-h-[1.3rem] inline-flex disabled:cursor-not-allowed leading-[0px] items-center justify-center text-lg absolute left-[47%] bottom-7'
                  >
                    -
                  </button>
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
