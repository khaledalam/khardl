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
        })
      );
    }
    if (banner_type == "one-photo" && banner_image) {
      setListofBannerImages([{ croppedImage: `${banner_image.url}` }]);
      setUploadedSingleBanner(`${banner_image.url}`);
    }
  }, [restaurantStyle]);

  return listofBannerImages?.length >= 1 ? (
    <>
      <div className={`w-full aspect-[2/1]`}>
        <Sliderr
          banner_images={listofBannerImages}
          setIsBannerModalOpened={() => {}}
        />
      </div>
    </>
  ) : (
    <div class="w-full aspect-[2/1]">
      <Skeleton className="h-full w-full" />
    </div>
  );
};

export default Banner;
