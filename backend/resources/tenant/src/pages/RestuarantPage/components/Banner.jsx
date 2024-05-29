import React, { useEffect, useState, useMemo } from "react";
import { useTranslation } from "react-i18next";
import Sliderr from "../../EditorsPage/Restuarants/components/Sliderr";
import Skeleton from "react-loading-skeleton";

const Banner = React.memo(({ restaurantStyle }) => {
  const { t } = useTranslation();

  const { banner_image, banner_images, banner_type } = restaurantStyle;

  const [listofBannerImages, setListofBannerImages] = useState([]);

  useEffect(() => {
    if (banner_type === "slider" && banner_images?.length > 0) {
      setListofBannerImages(
        banner_images.map((image) => ({
          croppedImage: image.url,
        }))
      );
    } else if (banner_type === "one-photo" && banner_image) {
      setListofBannerImages([{ croppedImage: banner_image.url }]);
    } else {
      setListofBannerImages([]);
    }
  }, [banner_type, banner_images, banner_image]);

  if (listofBannerImages.length === 0) {
    return (
      <div className="w-full aspect-[2/1]">
        <Skeleton className="h-full w-full" />
      </div>
    );
  }

  return (
    <div className="w-full aspect-[2/1]">
      <Sliderr
        banner_images={listofBannerImages}
        setIsBannerModalOpened={() => {}}
      />
    </div>
  );
});

export default Banner;
