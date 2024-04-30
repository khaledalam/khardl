import { IoCloseOutline } from "react-icons/io5";
import ImageIcon from "../../../../assets/imageIcon.svg";
import { useCallback, useState } from "react";
import { useDispatch, useSelector } from "react-redux";
import {
  removeBannersUpload,
  setBannersUpload,
} from "../../../../redux/NewEditor/restuarantEditorSlice";
import ReactSlider from "react-slick";
import bannerPlaceholder from "../../../../assets/banner-placeholder.jpg";
import { BiCloudUpload } from "react-icons/bi";
import Cropper from "react-easy-crop";
import getCroppedImg from "./cropImage";
import { toast } from "react-toastify";
import { useTranslation } from "react-i18next";

const Slider = ({ banner_images }) => {
  const bannersUpload =
    useSelector((state) => state.restuarantEditorStyle.bannersUpload) || [];
  const bannerBgColor =
    useSelector(
      (state) => state.restuarantEditorStyle.banner_background_color,
    ) || "";
  const { t } = useTranslation();

  const [sliderCount, setSliderCount] = useState(2);
  const [crop, setCrop] = useState({ x: 0, y: 0 });
  const [rotation, setRotation] = useState(0);
  const [zoom, setZoom] = useState(1);
  const [croppedAreaPixels, setCroppedAreaPixels] = useState(null);
  const [croppedImage, setCroppedImage] = useState(null);
  const [uncroppedImage, setUncroppedImage] = useState(null);
  const [isCropModalOpened, setIsCropModalOpened] = useState(false);
  const [idxselected, setIdxselected] = useState(false);

  const dispatch = useDispatch();

  const handleImagesUpload = (event, idx) => {
    const selectedImage = event.target.files[0];
    //  setUploadImages([...uploadImages, URL.createObjectURL(selectedImage)])
    if (selectedImage.type.includes("video")) {
      dispatch(
        setBannersUpload({
          index: idx,
          image: {
            type: "video",
            url: URL.createObjectURL(selectedImage),
          },
        }),
      );
    } else {
      setUncroppedImage(URL.createObjectURL(selectedImage));
      setIsCropModalOpened(true);
      setIdxselected(idx);
      dispatch(
        setBannersUpload({
          index: idx,
          image: {
            type: "image",
            url: URL.createObjectURL(selectedImage),
          },
        }),
      );
    }
  };

  const handleRemoveImages = (index) => {
    dispatch(removeBannersUpload({ index }));
    toast.success(`${t("Image Removed")}`);
  };

  const addMoreSlider = useCallback(() => {
    setSliderCount((prev) => prev + 1);
    toast.success(`${t("Slide Added")}`);
  }, []);

  const removeEachSlide = useCallback(() => {
    if (sliderCount > 2 || bannersUpload.length > 2) {
      setSliderCount((prev) => prev - 1);
    }
  }, [bannersUpload, sliderCount]);

  const onCropComplete = (croppedArea, croppedAreaPixels) => {
    setCroppedAreaPixels(croppedAreaPixels);
  };
  const showCroppedImage = async () => {
    try {
      const croppedImage = await getCroppedImg(
        uncroppedImage,
        croppedAreaPixels,
        rotation,
      );
      console.log("donee", { croppedImage });
      setUncroppedImage(null);
      setIsCropModalOpened(false);

      dispatch(
        setBannersUpload({
          index: idxselected,
          image: {
            type: "image",
            url: croppedImage,
          },
        }),
      );
      toast.success(`${t("Done")}`);

      // setCroppedImage(croppedImage)
    } catch (e) {
      console.error(e);
    }
  };
  const settings = {
    dots: true,
    infinite: true,
    autoplay: true,
    speed: 500,
    slidesToShow: 1,
    slidesToScroll: 1,
  };

  return (
    <div
      style={{ backgroundColor: bannerBgColor }}
      className="w-full h-full rounded-[10px]"
    >
      {/* <p
                style={{
                    fontSize: "12px",
                    textAlign: "left",
                    marginBottom: "10px",
                }}
            >
                {t("SliderHintUpload")}
            </p> */}
      <div className="mx-auto">
        <ReactSlider {...settings}>
          {Array(
            bannersUpload.length > sliderCount
              ? bannersUpload.length
              : sliderCount,
          )
            .fill(1)
            .map((_, index) => (
              <div key={index} className={`h-full !block`}>
                <div
                  style={{
                    backgroundPosition: "center",
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
                    type="file"
                    accept="video/*, image/*"
                    id={"imageBanner" + index}
                    name={"imageBanner" + index}
                    onChange={(e) => handleImagesUpload(e, index)}
                    className="hidden"
                  />
                  <div
                    style={{
                      borderRadius: 12,
                    }}
                    className="w-[100px] h-[95px] rounded-lg p-2 bg-neutral-100 relative"
                  >
                    <label htmlFor={"imageBanner" + index}>
                      <img
                        src={
                          (bannersUpload[index]?.url ||
                            banner_images[index]?.url) ??
                          ImageIcon
                        }
                        alt={""}
                        className="w-full h-full object-cover"
                      />
                    </label>
                    {(bannersUpload[index]?.url ||
                      banner_images[index]?.url) && (
                      <div
                        onClick={() => handleRemoveImages(index)}
                        className="absolute top-[-0.8rem] right-[-1rem] cursor-pointer"
                      >
                        <div className="w-[20px] h-[20px] rounded-full p-1 bg-neutral-100 flex items-center cursor-pointer justify-center">
                          <IoCloseOutline
                            size={16}
                            className="text-red-500 cursor-pointer"
                          />
                        </div>
                      </div>
                    )}
                  </div>
                  <button
                    onClick={removeEachSlide}
                    disabled={sliderCount <= 2}
                    className="btn btn-circle w-[1.3rem] h-[1.3rem] min-h-[1.3rem] inline-flex disabled:cursor-not-allowed leading-[0px] items-center justify-center text-lg absolute left-[45%] laptopXL:left-[47%] bottom-7"
                  >
                    -
                  </button>

                  {bannersUpload.length > 0 ? (
                    <div
                      onClick={addMoreSlider}
                      disabled={bannersUpload.length == 0}
                      className="btn btn-circle w-[1.3rem] h-[1.3rem] min-h-[1.3rem] inline-flex leading-[0px] items-center justify-center text-lg absolute bottom-7"
                    >
                      +
                    </div>
                  ) : banner_images.length > 0 ? (
                    <div
                      onClick={addMoreSlider}
                      className="btn btn-circle w-[1.3rem] h-[1.3rem] min-h-[1.3rem] inline-flex leading-[0px] items-center justify-center text-lg absolute bottom-7"
                    >
                      +
                    </div>
                  ) : (
                    <div
                      onClick={addMoreSlider}
                      disabled={true}
                      className="btn btn-circle w-[1.3rem] h-[1.3rem] min-h-[1.3rem] inline-flex leading-[0px] items-center justify-center text-lg absolute bottom-7"
                    >
                      +
                    </div>
                  )}
                </div>
              </div>
            ))}
        </ReactSlider>
      </div>
      {isCropModalOpened && (
        <div
          class="modal  fixed w-full h-full top-0 left-0 flex items-center justify-center"
          style={{ opacity: 1, pointerEvents: "all" }}
        >
          <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

          <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
            <div class="modal-content py-4 text-left px-6">
              <div class="flex justify-between items-center pb-3">
                <p class="text-2xl font-bold">Crop Image!</p>
                <div class="modal-close cursor-pointer z-50">
                  <svg
                    class="fill-current text-black"
                    xmlns="http://www.w3.org/2000/svg"
                    width="18"
                    height="18"
                    viewBox="0 0 18 18"
                  >
                    <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                  </svg>
                </div>
              </div>
              <div className={"cropper-container"}>
                <Cropper
                  image={uncroppedImage}
                  crop={crop}
                  rotation={rotation}
                  zoom={zoom}
                  aspect={2 / 1}
                  onCropChange={setCrop}
                  onRotationChange={setRotation}
                  onCropComplete={onCropComplete}
                  onZoomChange={setZoom}
                />
              </div>

              <div class="flex justify-end pt-2">
                <button
                  class="modal-close px-4 bg-indigo-500 p-3 rounded-lg text-white hover:bg-indigo-400"
                  onClick={() => showCroppedImage()}
                >
                  Save
                </button>
              </div>
            </div>
          </div>
        </div>
      )}
    </div>
  );
};

export default Slider;
