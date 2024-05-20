import React, { Fragment, useContext, useEffect, useState } from "react";
import { useSelector } from "react-redux";

const Sliderr = ({ banner_images, setIsBannerModalOpened }) => {
  const [imageIndex, setImageIndex] = useState(0);

  const language = useSelector((state) => state.languageMode.languageMode);
  const banner_radius = useSelector(
    (state) => state.restuarantEditorStyle.banner_radius
  );
  const imageChange = () => {
    setImageIndex((prevIndex) => (prevIndex + 1) % banner_images?.length);
  };
  useEffect(() => {
    const intervalId = setInterval(imageChange, 3000);
    return () => clearInterval(intervalId);
  }, [banner_images]);

  useEffect(() => {
    if (language === "en") {
      setImageIndex(0);
    } else {
      setImageIndex(banner_images?.length - 1);
    }
  }, [language]);

  return (
    <div
      className="h-full rounded-[10px] relative flex flex-col justify-center"
      style={{ borderRadius: banner_radius + "px" }}
    >
      <div
        style={{ borderRadius: banner_radius + "px" }}
        className="flex w-full h-full rounded-[10px] overflow-x-hidden"
      >
        {banner_images?.map((image, index) => (
          <img
            key={index}
            src={image.croppedImage}
            alt="banner"
            className="flex aspect-[2/1] w-full rounded-[10px] object-cover shrink-0 grow-0 transition-transform duration-500 ease-in-out"
            style={{
              transform: `translateX(${language === "en" ? "-" : ""}${
                imageIndex * 100
              }%)`,
              borderRadius: banner_radius + "px",
            }}
            onClick={() => setIsBannerModalOpened(true)}
          />
        ))}
      </div>
      <div className="absolute bottom-[8px] left-[50%] translate-x-[-50%] flex gap-[3px] bg-opacity-0 rounded-[50px] px-[35px] py-[6px] scale-150 hover:bg-opacity-50 transition-all">
        {banner_images?.map((_, index) => (
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
