import React from "react";
// import { Swiper, SwiperSlide } from "swiper/react";
// import "swiper/css";
// import "swiper/css/navigation";
// import "swiper/css/pagination";
// import SwiperCore from "swiper";
// import { Navigation } from "swiper/modules";
// import { useSwiper } from "swiper/react";
// import RightIcon from "../../../../assets/rightIcon.png";
// import LeftIcon from "../../../../assets/leftIcon.png";

// Install Swiper modules
// SwiperCore.use([Navigation]);

function EditorSlider() {
    // const items = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]; // Your data array
    // const swiper = useSwiper();

    return (
        <div>hello</div>
        //     <div className="container mx-auto max-w-md">
        //         <Swiper slidesPerView={3} spaceBetween={10} loop={true}>
        //             <SlidePrevButton />
        //             {items.map((item, index) => (
        //                 <SwiperSlide key={index}>
        //                     <div className="p-4 border rounded-md shadow-md">
        //                         Item {item}
        //                     </div>
        //                 </SwiperSlide>
        //             ))}
        //             <SlideNextButton />
        //         </Swiper>
        //     </div>
    );
}

export default EditorSlider;

// function SlideNextButton() {
//     const swiper = useSwiper();

//     return (
//         <button
//             onClick={() => swiper.slideNext()}
//             className="w-[25px] h-[25px] bg-black/10 rounded-full flex justify-center items-center"
//         >
//             <img src={RightIcon} alt="right icon" />
//         </button>
//     );
// }

// function SlidePrevButton() {
//     const swiper = useSwiper();

//     return (
//         <button
//             onClick={() => swiper.slidePrev()}
//             className="w-[25px] h-[25px] bg-black/10 rounded-full flex justify-center items-center"
//         >
//             <img src={LeftIcon} alt="left icon" />
//         </button>
//     );
// }
