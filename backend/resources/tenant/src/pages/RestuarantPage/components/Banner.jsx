import React, { useEffect, useState } from "react";
import { useTranslation } from "react-i18next";
import Sliderr from "../../EditorsPage/Restuarants/components/Sliderr";

import EmptyBackground from "../../../assets/emptyBackground.png";
import UploadIcon from "../../../assets/uploadIcon.png";
import Skeleton from "react-loading-skeleton";

const Banner = ({ restaurantStyle }) => {
  const { t } = useTranslation();

  const {
    banner_image,
    banner_images,
    banner_background_color,
    logo_shape,
    banner_type,
    banner_shape,
  } = restaurantStyle;

  const [listofBannerImages, setListofBannerImages] = useState([]);
  const [uploadedSingleBanner, setUploadedSingleBanner] = useState(null);

  useEffect(() => {
    if (banner_type == "slider" && banner_images.length > 0) {
      setListofBannerImages(
        banner_images.map((image) => {
          return {
            croppedImage: `${image.url}`,
          };
        }),
      );
    }
    if (banner_type == "one-photo" && banner_image) {
      setListofBannerImages([{ croppedImage: `${banner_image.url}` }]);
      setUploadedSingleBanner(`${banner_image.url}`);
    }
  }, [restaurantStyle]);

  return listofBannerImages?.length > 1 ? (
    <>
      <div className={`w-full aspect-[2/1]`}>
        <Sliderr
          banner_images={listofBannerImages}
          setIsBannerModalOpened={() => {}}
        />
      </div>
    </>
  ) : (
    <div
      style={{
        backgroundColor: banner_background_color,
        backgroundImage: uploadedSingleBanner
          ? `url(${uploadedSingleBanner})`
          : `url(${EmptyBackground})`,
        borderRadius: banner_shape === "sharp" ? 0 : 12,
        backgroundSize: "cover",
        backgroundRepeat: "no-repeat",
      }}
      className={`w-full min-h-[180px] aspect-[2/1] flex pt-[56px] md:pt-[80px] justify-center relative`}
    >
      <Skeleton />
      {/* <div
        className={`${
          uploadedSingleBanner ? "hidden" : "flex flex-col items-center"
        } `}
      >
        <span className="uppercase text-[24px] leading-[30px] font-semibold text-black/[.54] mb-[8px]">
          {t("Banner")}
        </span>

        <img
          src={UploadIcon}
          alt={""}
          style={{
            borderRadius: logo_shape === "sharp" ? 0 : 12,
          }}
          className="w-[18px] h-[18px] object-cover"
        />
      </div> */}
    </div>
  );
};

export default Banner;
