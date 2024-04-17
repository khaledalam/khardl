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

// Install Swiper modules
SwiperCore.use([Navigation]);

function EditorSlider({
    items,
    scrollToSection,
    isHighlighted,
    currentSubItem,
}) {
    const restuarantEditorStyle = useSelector(
        (state) => state.restuarantEditorStyle
    );
    const selectedCategory = useSelector(
        (state) => state.categoryAPI.selected_category
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

    // const swiper = useSwiper();

    const [swiper, setSwiper] = useState(null);

    return (
        <div
            // style={{
            //     backgroundColor: page_category_color,
            //     borderRadius: category_shape === "sharp" ? 0 : 12,
            // }}
            style={{
                backgroundColor: menu_category_background_color
                    ? menu_category_background_color
                    : "#F3F3F3",
                borderRadius: menu_category_radius
                    ? `${menu_category_radius}px`
                    : "50px",
            }}
            className={`${
                menu_category_position == "center" ? "h-40" : "h-full"
            } w-full  py-3 flex items-center justify-between ${
                isHighlighted && "shadow-inner border-[#C0D123] border-[2px]"
            }`}
        >
            {menu_category_position == "center" ? (
                <div
                    className={`flex items-center justify-between w-full px-[16px] ${
                        Language == "ar" && "flex-row-reverse"
                    }`}
                >
                    <div>
                        <SlidePrevButton swiper={swiper} />
                    </div>
                    <Swiper
                        slidesPerView={width > 1024 ? 5 : width > 768 ? 3 : 1}
                        spaceBetween={0}
                        loop={true}
                        modules={[Navigation]}
                        onSwiper={setSwiper}
                        className="flex flex-row w-full h-full !justify-center"
                    >
                        <div
                            className={`flex ${
                                menu_category_position === "center"
                                    ? "flex-row gap-[30px] "
                                    : "flex-col gap-6"
                            } items-center !justify-center w-full`}
                        >
                            {items.map((category, i) => (
                                <SwiperSlide
                                    key={i}
                                    className="flex justify-center items-center"
                                >
                                    <CategoryItem
                                        key={i}
                                        active={
                                            selectedCategory.id === category.id
                                        }
                                        name={category.name}
                                        imgSrc={category.photo}
                                        alt={category.name}
                                        hoverColor={category_hover_color}
                                        onClick={() =>
                                            scrollToSection(category.name)
                                        }
                                        textColor={menu_category_color}
                                        textAlign={text_alignment}
                                        textFontFamily={menu_category_font}
                                        fontWeight={menu_category_weight}
                                        shape={category_shape}
                                        isGrid={
                                            menu_category_position === "center"
                                                ? false
                                                : true
                                        }
                                        fontSize={menu_category_size}
                                        currentSubItem={currentSubItem}
                                    />
                                </SwiperSlide>
                            ))}
                        </div>
                    </Swiper>
                    <div>
                        <SlideNextButton swiper={swiper} />
                    </div>
                </div>
            ) : (
                <div className="flex flex-col items-center justify-between w-full h-full px-[16px]">
                    {items.map((category, i) => (
                        <CategoryItem
                            key={i}
                            active={selectedCategory.id === category.id}
                            name={category.name}
                            imgSrc={category.photo}
                            alt={category.name}
                            hoverColor={category_hover_color}
                            onClick={() => scrollToSection(category.name)}
                            textColor={text_color}
                            textAlign={text_alignment}
                            fontWeight={text_fontWeight}
                            shape={category_shape}
                            isGrid={
                                menu_category_position === "center"
                                    ? false
                                    : true
                            }
                            fontSize={text_fontSize}
                            currentSubItem={currentSubItem}
                        />
                    ))}
                </div>
            )}
        </div>
    );
}

export default EditorSlider;

function SlideNextButton({ swiper }) {
    return (
        <button
            onClick={() => swiper.slideNext()}
            className="w-[25px] h-[25px] bg-black/10 rounded-full flex justify-center items-center"
        >
            <img src={RightIcon} alt="right icon" />
        </button>
    );
}

function SlidePrevButton({ swiper }) {
    return (
        <button
            onClick={() => swiper.slidePrev()}
            className="w-[25px] h-[25px] bg-black/10 rounded-full flex justify-center items-center"
        >
            <img src={LeftIcon} alt="left icon" />
        </button>
    );
}
