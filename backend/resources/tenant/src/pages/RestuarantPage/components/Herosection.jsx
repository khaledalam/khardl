import React, { Fragment, useEffect } from "react";
import CategoryItem from "../../EditorsPage/Restuarants/components/CategoryItem";
import { useDispatch, useSelector } from "react-redux";
import { selectedCategoryAPI } from "../../../redux/NewEditor/categoryAPISlice";
import imgBanner from "../../../assets/bannerRestuarant.png";
import { useTranslation } from "react-i18next";
import ReactSlider from "react-slick";
import imgLogo from "../../../assets/Logo_White.svg";

const Herosection = ({ isMobile, categories, isCatLoading }) => {
  const dispatch = useDispatch();
  const { t } = useTranslation();
  const selectedCategory = useSelector(
    (state) => state.categoryAPI.selected_category,
  );
  const restaurantStyle = useSelector((state) => state.restuarantEditorStyle);

  const settings = {
    dots: true,
    infinite: true,
    autoplay: true,
    speed: 500,
    slidesToShow: 1,
    arrows: false,
    slidesToScroll: 1,
  };

  useEffect(() => {
    document.getElementById("vid") && document.getElementById("vid").play();
    document.getElementById("vidSlider") &&
      document.getElementById("vidSlider").play();
  }, []);

  return (
    <div className="flex flex-col items-center justify-center">
      <div
        style={{
          backgroundColor: restaurantStyle
            ? restaurantStyle?.banner_background_color
            : "inherit",
          paddingTop: restaurantStyle?.headerPosition === "fixed" ? 70 : 16,
        }}
        className={
          "w-full  flex flex-col py-4 items-center justify-center gap-8"
        }
      >
        <div
          className={` w-full ${
            restaurantStyle?.logo_alignment === t("Center") ||
            restaurantStyle?.logo_alignment === "center"
              ? " flex items-center justify-center"
              : restaurantStyle?.logo_alignment === t("Left") ||
                  restaurantStyle?.logo_alignment === "left"
                ? "items-center justify-start"
                : "items-center justify-end"
          }`}
        >
          <div
            className={`w-[60px] h-[60px]  ${
              restaurantStyle?.logo_shape === "rounded" ||
              restaurantStyle?.logo_shape === t("Rounded")
                ? "rounded-full"
                : restaurantStyle?.logo_shape === "sharp" ||
                    restaurantStyle?.logo_shape === t("Sharp")
                  ? "rounded-none"
                  : ""
            }`}
          >
            <img
              src={restaurantStyle?.logo ? restaurantStyle.logo : imgLogo}
              alt="logo"
              className={`w-full h-full object-cover ${
                restaurantStyle?.logo_shape === t("Sharp") ? "" : "rounded-full"
              }`}
            />
          </div>
        </div>
        {(restaurantStyle && restaurantStyle?.banner_type === "one-photo") ||
        (restaurantStyle && restaurantStyle?.banner_type === t("One-photo")) ? (
          <div
            className={`w-[85%] md:w-5/6 mx-auto  ${
              isMobile ? "" : " mb-8"
            } laptopXL:w-[75%]`}
          >
            <div
              className={` h-full w-full rounded-md flex items-center justify-center`}
              style={{
                height: "0",
                paddingTop: "25%",
                backgroundPosition: "center",
                backgroundRepeat: "no-repeat",
                backgroundSize: "contain",
                backgroundImage:
                  restaurantStyle?.banner_image &&
                  restaurantStyle?.banner_image?.url &&
                  `url(${restaurantStyle?.banner_image?.url})`,
              }}
            >
              {restaurantStyle?.banner_image &&
              restaurantStyle?.banner_image?.type === "video" ? (
                <video
                  controls
                  id="vid"
                  loop
                  autoPlay
                  className="z-[5] max-h-[250px] md:max-h-[350px] w-full"
                >
                  <source
                    src={
                      restaurantStyle?.banner_image &&
                      restaurantStyle?.banner_image?.url
                        ? restaurantStyle?.banner_image?.url
                        : ""
                    }
                    alt="banner"
                    className="w-full h-full object-cover"
                  />
                  Your browser does not support the video tag.
                </video>
              ) : (
                <></>
              )}
            </div>
          </div>
        ) : restaurantStyle?.banner_type === t("Slider") ||
          restaurantStyle?.banner_type === "slider" ? (
          <div className="w-full">
            <div
              className={`w-[85%] md:w-5/6 mx-auto  ${
                isMobile ? "" : " mb-8"
              } laptopXL:w-[75%]`}
            >
              <ReactSlider {...settings}>
                {Array(
                  restaurantStyle ? restaurantStyle?.banner_images?.length : 3,
                )
                  .fill(1)
                  .map((_, index) => (
                    <div key={index} className="h-[0px]!block">
                      {restaurantStyle?.banner_images &&
                      restaurantStyle?.banner_images?.length > 0 &&
                      restaurantStyle?.banner_images[index].type === "video" ? (
                        <video
                          controls
                          id="vidSlider"
                          loop
                          autoPlay
                          className="z-[5] max-h-[250px] md:max-h-[350px] w-full"
                        >
                          <source
                            src={
                              restaurantStyle?.banner_images &&
                              restaurantStyle.banner_images?.length > 0
                                ? restaurantStyle.banner_images[index]?.url
                                : ""
                            }
                            type="video/mp4"
                          />
                        </video>
                      ) : (
                        <>
                          {restaurantStyle?.banner_images &&
                            restaurantStyle?.banner_images?.length > 0 &&
                            restaurantStyle?.banner_images[index].url && (
                              <div
                                style={{
                                  width: "100%",
                                  height: "0",
                                  paddingTop: "25%",
                                  backgroundPosition: "center",
                                  backgroundRepeat: "no-repeat",
                                  backgroundSize: "contain",
                                  backgroundImage:
                                    restaurantStyle?.banner_images &&
                                    restaurantStyle?.banner_images?.length >
                                      0 &&
                                    restaurantStyle?.banner_images[index].url &&
                                    `url(${restaurantStyle?.banner_images[index].url})`,
                                }}
                                className={` h-full w-full rounded-md flex items-center justify-center`}
                              ></div>
                            )}
                        </>
                      )}
                    </div>
                  ))}
              </ReactSlider>
            </div>
          </div>
        ) : (
          <Fragment>Not a Slider</Fragment>
        )}
      </div>
      {(restaurantStyle?.category_alignment === t("Center") ||
        restaurantStyle?.category_alignment === "center" ||
        isMobile) && (
        <div
          style={{
            backgroundColor: restaurantStyle.page_category_color,
          }}
          className={` w-full flex items-center ${
            isMobile ? "overflow-x-scroll hide-scroll px-4" : ""
          } `}
        >
          <div
            className={`flex items-center w-full gap-8 my-5 category-scroller-section`}
          >
            {categories && categories.length > 0 ? (
              categories.map((category, i) => (
                <CategoryItem
                  key={i}
                  active={selectedCategory.id === category.id}
                  name={category.name}
                  imgSrc={category.photo}
                  alt={category.name}
                  hoverColor={restaurantStyle?.category_hover_color}
                  textColor={restaurantStyle?.text_color}
                  onClick={() =>
                    dispatch(
                      selectedCategoryAPI({
                        name: category.name,
                        id: category.id,
                      }),
                    )
                  }
                />
              ))
            ) : (
              <div className="w-full h-full items-center justify-center">
                {isCatLoading ? (
                  <div className="skeleton btn w-1/2 w-full shrink-0"></div>
                ) : (
                  <p className="text-2xl font-medium text-center">
                    {t("No categories to be found at the moment")}
                  </p>
                )}
              </div>
            )}
          </div>
        </div>
      )}
    </div>
  );
};

export default Herosection;
