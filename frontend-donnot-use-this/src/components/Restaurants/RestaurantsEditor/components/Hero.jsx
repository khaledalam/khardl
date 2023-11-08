import React, { useState } from 'react';
import { setImage, clearImage } from '../../../../redux/editor/imageSlice';
import { addImage, removeImage } from '../../../../redux/editor/imagesSlice';
import { useDispatch, useSelector } from 'react-redux';
import { BiImageAdd } from "react-icons/bi";
import { getSelectedBanner } from '../../../../redux/editor/bannerSlice';
import { Swiper, SwiperSlide } from 'swiper/react';
import { Pagination } from 'swiper/modules';
import 'swiper/css';
import { AiOutlineClose } from 'react-icons/ai';

function Hero() {
  const shapeImageType = useSelector(state => state.shapeImage.shapeImageShape);
  const image = useSelector(state => state.image);
  const images = useSelector(state => state.images);
  const [uploadedImages, setUploadedImages] = useState([]);

  const dispatch = useDispatch();
  const handleImageChange = event => {
    const selectedImage = event.target.files[0];
    if (selectedImage) {
      dispatch(setImage(URL.createObjectURL(selectedImage)));
    }
  };
  const handleRemoveImage = () => {
    dispatch(clearImage());
  };
  const handleRemoveImageSlider = (index) => {
    dispatch(removeImage({ index }));
    const newImages = uploadedImages.filter((_, i) => i !== index);
    setUploadedImages(newImages);
  };
  const handleImagesChange = (event) => {
    const { files } = event.target;
    const image = files[0];
    dispatch(addImage([...uploadedImages, URL.createObjectURL(image)]));
    setUploadedImages([...uploadedImages, URL.createObjectURL(image)]);

  };
  const selectBanner = useSelector(getSelectedBanner);

  return (
    <div className='w-[100%]'>
      {selectBanner === "Slider" || selectBanner === "سلايدر" ?
        <Swiper modules={[Pagination]} pagination={{ clickable: true }} slideClass="swiper-slide">
          {[...Array(uploadedImages.length + 2)].map((_, index) => (
            <SwiperSlide key={index}>
              {index < uploadedImages.length ? (
                <div className="relative h-[280px] rounded-md bg-center bg-cover shadow-md">
                  <button
                    className={`absolute ${shapeImageType === "14px" ? "top-[8px] right-[18px]" : "top-[8px] right-[8px]"} bg-white text-black shadow-md w-fit h-fit p-2 rounded-full hover:bg-red-400 hover:text-white`}
                    onClick={() => handleRemoveImageSlider(index)}
                  >
                    <AiOutlineClose size={20} />
                  </button>
                  <div
                    className={`h-[280px] rounded-md bg-center bg-cover shadow-md`}
                    style={
                      shapeImageType === '14px'
                        ? { backgroundImage: `url(${uploadedImages[index]})`, margin: '12px', borderRadius: shapeImageType }
                        : { backgroundImage: `url(${uploadedImages[index]})`, color: '#fff', borderRadius: shapeImageType }
                    }
                  ></div>
                </div>
              ) : (
                <div>
                  <input
                    type="file"
                    accept="images/*"
                    id={`image-[${index}]`}
                    onChange={handleImagesChange}
                    className="hidden"
                  />
                  <label
                    htmlFor={`image-[${index}]`}
                    className={`h-[280px] bg-slate-600 hover:bg-slate-800 text-white shadow-md flex flex-col items-center justify-center cursor-pointer`}
                    style={shapeImageType === '14px' ? { margin: '12px', borderRadius: shapeImageType } : { borderRadius: shapeImageType }}
                  >
                    <BiImageAdd size={120} />
                  </label>
                </div>
              )}
            </SwiperSlide>
          ))}
        </Swiper>
        :
        image ? (
          <div className="relative h-[280px] rounded-md bg-center bg-cover shadow-md">
            <button
              className={`absolute ${shapeImageType === "14px" ? "top-[8px] right-[18px]" : "top-[8px] right-[8px]"} bg-white text-black shadow-md w-fit h-fit p-2 rounded-full hover:bg-red-400 hover:text-white`}
              onClick={handleRemoveImage}
            >
              <AiOutlineClose size={20} />
            </button>
            <div
              className={`h-[280px] rounded-md bg-center bg-cover shadow-md`}
              style=
              {
                shapeImageType === "14px"
                  ? { backgroundImage: `url(${image})`, margin: "12px", borderRadius: shapeImageType }
                  : { backgroundImage: `url(${image})`, color: '#fff', borderRadius: shapeImageType }
              }
            ></div>
          </div>
        ) : (
          <>
            <input
              type="file"
              accept="image/*"
              id="image"
              onChange={handleImageChange}
              className="hidden"
            />
            <label
              htmlFor="image"
              className="h-[280px] bg-slate-600 hover:bg-slate-800 text-white shadow-md flex flex-col items-center justify-center cursor-pointer"
            >
              <BiImageAdd size={120} />
            </label>
          </>
        )
      }
    </div>
  );
}

export default Hero;
