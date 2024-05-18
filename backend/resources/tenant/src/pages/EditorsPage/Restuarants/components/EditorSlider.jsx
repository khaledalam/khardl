import React, { useState } from "react";
import { Swiper, SwiperSlide } from "swiper/react";
import "swiper/css";
import "swiper/css/navigation";
import "swiper/css/pagination";
import SwiperCore from "swiper";
import { Navigation } from "swiper/modules";
import { useSwiper } from "swiper/react";
import RightIcon from "../../../../assets/rightIcon.png";
import LeftIcon from "../../../../assets/leftIcon.png";
import CategoryItem from "./CategoryItem";
import { selectedCategoryAPI } from "../../../../redux/NewEditor/categoryAPISlice";
import { useSelector, useDispatch } from "react-redux";
import useWindowSize from "../../../../hooks/useWindowSize";
import GreenDot from "../../../../assets/greenDot.png";
import Carousel from "react-multi-carousel";
import "react-multi-carousel/lib/styles.css";

// Install Swiper modules
SwiperCore.use([Navigation]);

function EditorSlider({
  items,
  scrollToSection,
  isHighlighted,
  currentSubItem,
}) {
  const responsive = {
    superLargeDesktop: {
      breakpoint: { max: 4000, min: 3000 },
      items: 5,
    },
    desktop: {
      breakpoint: { max: 3000, min: 1024 },
      items: 5,
    },
    tablet: {
      breakpoint: { max: 1024, min: 464 },
      items: 3,
    },
    mobile: {
      breakpoint: { max: 464, min: 0 },
      items: 2,
    },
  };

  const restuarantEditorStyle = useSelector(
    (state) => state.restuarantEditorStyle,
  );
  const selectedCategory = useSelector(
    (state) => state.categoryAPI.selected_category,
  );

  const dispatch = useDispatch();
  const { width } = useWindowSize();
  const Language = useSelector((state) => state.languageMode.languageMode);
  console.log("Language", Language);

  const {
    category_hover_color,
    category_shape,
    text_fontWeight,
    text_fontSize,
    text_alignment,
    text_color,
    page_category_color,
    menu_category_background_color,
    menu_category_font,
    menu_category_weight,
    menu_category_size,
    menu_category_color,
    menu_category_position,
    menu_category_radius,
  } = restuarantEditorStyle;

  return (
    <div
      style={{
        backgroundColor: menu_category_background_color
          ? menu_category_background_color
          : "#F3F3F3",
        borderRadius: menu_category_radius
          ? `${menu_category_radius}px`
          : "50px",
      }}
      className={`${
        menu_category_position == "center" ? "h-30 md:h-fit" : "h-full"
      } w-full  py-3 flex items-center justify-between ${
        isHighlighted && "shadow-inner border-[#C0D123] border-[2px]"
      } relative`}
    >
      {menu_category_position == "center" ? (
        <Carousel
          swipeable={true}
          draggable={true}
          showDots={false}
          responsive={responsive}
          ssr={false}
          infinite={true}
          autoPlay={false}
          autoPlaySpeed={1000}
          keyBoardControl={true}
          customTransition="all .5"
          transitionDuration={500}
          containerClass="carousel-container h-full w-full sm:justify-center"
          dotListClass="custom-dot-list-style"
          sliderClass=""
          itemClass="flex items-center justify-center w-full h-full"
          customLeftArrow={<CustomLeftArrow />}
          customRightArrow={<CustomRightArrow />}
        >
          {items.map((category, i) => (
            <CategoryItem
              key={i}
              active={selectedCategory.id === category.id}
              name={category.name}
              imgSrc={category.photo}
              alt={category.name}
              hoverColor={null}
              onClick={() => scrollToSection(category.name)}
              textColor={menu_category_color}
              textAlign={text_alignment}
              textFontFamily={menu_category_font}
              fontWeight={menu_category_weight}
              shape={category_shape}
              isGrid={menu_category_position === "center" ? false : true}
              fontSize={menu_category_size}
              currentSubItem={currentSubItem}
            />
          ))}
        </Carousel>
      ) : (
        <div className="flex flex-col items-center justify-between w-full h-full px-[16px] space-y-[16px]">
          {items.map((category, i) => (
            <CategoryItem
              key={i}
              active={selectedCategory.id === category.id}
              name={category.name}
              imgSrc={category.photo}
              alt={category.name}
              hoverColor={null}
              onClick={() => scrollToSection(category.name)}
              textColor={menu_category_color}
              textAlign={text_alignment}
              textFontFamily={menu_category_font}
              fontWeight={menu_category_weight}
              shape={category_shape}
              isGrid={menu_category_position === "center" ? false : true}
              fontSize={menu_category_size}
              currentSubItem={currentSubItem}
              isSide={true}
            />
          ))}
        </div>
      )}
    </div>
  );
}

export default EditorSlider;

const CustomRightArrow = ({ onClick, ...rest }) => {
  const {
    onMove,
    carouselState: { currentSlide, deviceType },
  } = rest;
  return (
    <button
      onClick={() => onClick()}
      className="w-[25px] h-[25px] bg-black/10 rounded-full flex justify-center items-center absolute right-[16px]"
    >
      <img src={RightIcon} alt="right icon" />
    </button>
  );
};

const CustomLeftArrow = ({ onClick, ...rest }) => {
  const {
    onMove,
    carouselState: { currentSlide, deviceType },
  } = rest;
  return (
    <button
      onClick={() => onClick()}
      className="w-[25px] h-[25px] bg-black/10 rounded-full flex justify-center items-center absolute left-[16px]"
    >
      <img src={LeftIcon} alt="left icon" />
    </button>
  );
};
