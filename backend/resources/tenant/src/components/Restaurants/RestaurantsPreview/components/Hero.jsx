import React, { useState } from 'react';
import { setImage } from '../../../../redux/editor/imageSlice';
import {useDispatch, useSelector} from 'react-redux';
import { BsFillImageFill } from 'react-icons/bs';
import { Swiper, SwiperSlide } from 'swiper/react';
import { Pagination } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/pagination';

function Hero() {

    const styleData = useSelector((state) => state.styleDataRestaurant?.styleDataRestaurant);

    if (!styleData) {
        return;
    }

    const image = styleData?.banner_image || sessionStorage.getItem('previewImage');
    const shapeImageShape = styleData?.images_style || sessionStorage.getItem('shapeImageShape');
    const selectBanner = styleData?.banner_style || sessionStorage.getItem('selectBanner');
    const images = styleData?.banner_images || JSON.parse(sessionStorage.getItem('images'));
    const [uploadedImages, setUploadedImages] = useState(images);

    const dispatch = useDispatch();
    const handleImageChange = event => {
        const selectedImage = event.target.files[0];
        if (selectedImage) {
            dispatch(setImage(URL.createObjectURL(selectedImage)));
        }
    };


    return (
        <div className='w-[100%]'>
            {selectBanner === "Slider" || selectBanner === "سلايدر" ?
                <Swiper modules={[Pagination]} pagination={{ clickable: true }} slideClass="swiper-slide">
                    {[...Array(uploadedImages?.length)].map((_, index) => (
                        <SwiperSlide key={index}>
                            <div
                                className={`h-[280px] rounded-md bg-center bg-cover shadow-md`}
                                style={
                                    shapeImageShape === '14px'
                                        ? { backgroundImage: `url(${uploadedImages[index]})`, margin: '12px', borderRadius: shapeImageShape }
                                        : { backgroundImage: `url(${uploadedImages[index]})`, color: '#fff', borderRadius: shapeImageShape }
                                }
                            ></div>
                        </SwiperSlide>
                    ))}
                </Swiper>
                :
                image ? (
                    <div
                        className={`relative h-[280px] bg-center bg-cover shadow-md bg-slate-600`}
                        style={shapeImageShape === "14px" ? { backgroundImage: `url(${image})`, margin: "12px", borderRadius: shapeImageShape } : { backgroundImage: `url(${image})`, color: '#fff', borderRadius: shapeImageShape }}
                    ></div>
                ) : (
                    <>
                        <input type="file" accept="image/*" id="image" onChange={() => handleImageChange()} className="hidden" />
                        <label
                            htmlFor="image"
                            className={`h-[280px] bg-slate-600 hover:bg-slate-800 text-white shadow-md flex flex-col items-center justify-center cursor-pointer`}
                            style={shapeImageShape === "14px" ? { margin: "12px", borderRadius: shapeImageShape } : { borderRadius: shapeImageShape }}
                        >
                            <BsFillImageFill size={120} />
                        </label>
                    </>
                )}
        </div>
    );
}

export default Hero;
