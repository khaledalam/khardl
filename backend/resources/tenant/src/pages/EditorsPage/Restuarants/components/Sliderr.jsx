import React, { Fragment, useContext, useEffect, useState } from "react";
import RightIcon from "../../../../assets/rightIcon.png";
import LeftIcon from "../../../../assets/leftIcon.png";

const Sliderr = ({ banner_images, setIsBannerModalOpened }) => {
    console.log("banner_images: ", banner_images);

    const [imageIndex, setImageIndex] = useState(0);

    const showNextImage = () => {
        setImageIndex((index) => {
            if (index === banner_images.length - 1) {
                return 0;
            }
            return index + 1;
        });
    };

    const showPreviousImage = () => {
        setImageIndex((index) => {
            if (index === 0) {
                return banner_images.length - 1;
            }
            return index - 1;
        });
    };
    return (
        <div className="h-[300px] rounded-[10px] relative flex flex-col justify-center">
            <div className="flex w-full h-full rounded-[10px] overflow-x-hidden">
                {banner_images.map((image, index) => (
                    <img
                        key={index}
                        src={image.croppedImage}
                        alt="banner"
                        className="h-[300px] w-full rounded-[10px] object-cover block shrink-0 grow-0 ease-in-out duration-300"
                        style={{ translate: `${-100 * imageIndex}%` }}
                        onClick={() => setIsBannerModalOpened(true)}
                    />
                ))}
            </div>

            <button className="w-[25px] h-[25px] bg-white rounded-full flex justify-center items-center absolute left-[16px] hover:cursor-pointer">
                <img src={LeftIcon} alt="left" onClick={showPreviousImage} />
            </button>
            <button className="w-[25px] h-[25px] bg-white rounded-full flex justify-center items-center absolute right-[16px] hover:cursor-pointer">
                <img src={RightIcon} alt="right" onClick={showNextImage} />
            </button>
            <div className="absolute bottom-[8px] left-[50%] translate-x-[-50%] flex gap-[3px] bg-black/[0.1] rounded-[50px] px-[35px] py-[6px]">
                {banner_images.map((image, index) => (
                    <button onClick={() => setImageIndex(index)} key={index}>
                        {index == imageIndex ? (
                            <div className="w-[5px] h-[5px] bg-black/[0.3] rounded-full" />
                        ) : (
                            <div className="w-[3px] h-[3px] bg-white rounded-full" />
                        )}
                    </button>
                ))}
            </div>
        </div>
    );
};

export default Sliderr;
