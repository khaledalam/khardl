import React, { Fragment, useContext, useEffect, useState } from "react";
import RightIcon from "../../../../assets/rightIcon.png";
import LeftIcon from "../../../../assets/leftIcon.png";

const Sliderr = ({ banner_images, setIsBannerModalOpened }) => {
  const [imageIndex, setImageIndex] = useState(0);

  const showNextImage = () => {
    setImageIndex((imageIndex + 1) % banner_images.length);
  };

  const showPreviousImage = () => {
    setImageIndex(
      (imageIndex - 1 + banner_images.length) % banner_images.length
    );
  };

  return (
    <div className="h-full rounded-[10px] relative flex flex-col justify-center">
      <div className="flex w-full h-full rounded-[10px] overflow-x-hidden">
        {banner_images.map((image, index) => (
          <img
          key={index}
          src={image.croppedImage}
          alt="banner"
          className="flex aspect-[2/1] w-full rounded-[10px] object-cover shrink-0 grow-0 transition-transform duration-500 ease-in-out"
          style={{ transform: `translateX(-${imageIndex * 100}%)` }}
          onClick={() => setIsBannerModalOpened(true)}
          />
        ))}
      </div>

      <div
        className="w-8 h-8 bg-gray-300 rounded-full bg-opacity-50 flex justify-center items-center absolute left-[16px] cursor-pointer hover:shadow-md hover:bg-opacity-100 transition-all"
        onClick={showPreviousImage}
      >
        <img src={LeftIcon} className=" scale-125" alt="left" />
      </div>
      <div
        className="w-8 h-8 bg-gray-300 rounded-full bg-opacity-50 flex justify-center items-center absolute right-[16px] cursor-pointer hover:shadow-md hover:bg-opacity-100 transition-all"
        onClick={showNextImage}
      >
        <img src={RightIcon} className=" scale-125" alt="right" />
      </div>
      <div className="absolute bottom-[8px] left-[50%] translate-x-[-50%] flex gap-[3px] bg-black/[0.1] rounded-[50px] px-[35px] py-[6px] scale-150 hover:bg-opacity-50 transition-all">
        {banner_images.map((_, index) => (
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
