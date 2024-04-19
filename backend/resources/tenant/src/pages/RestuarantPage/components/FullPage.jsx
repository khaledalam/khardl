import { useDispatch, useSelector } from "react-redux";
import { useTranslation } from "react-i18next";

import Header from "./Header";
import Logo from "./Logo";
import Banner from "./Banner";
import Category from "./Category";
import SocialMedia from "./SocialMedia";
import Footer from "./Footer";

const FullPage = ({ categories }) => {
    const dispatch = useDispatch();
    const { t } = useTranslation();
    const restaurantStyle = useSelector((state) => state.restuarantEditorStyle);

    const {
        logo_alignment,
        banner_type,
        socialMediaIcons_alignment,
        social_media_color,
        social_media_background_color,
        social_media_radius,
        selectedSocialIcons,
        page_color,
        menu_card_background_color,
        menu_card_text_font,
        menu_card_text_weight,
        menu_card_text_size,
        menu_card_text_color,
        menu_name_background_color,
        menu_name_text_font,
        menu_name_text_weight,
        menu_name_text_size,
        menu_name_text_color,
        total_calories_background_color,
        total_calories_text_font,
        total_calories_text_weight,
        total_calories_text_size,
        total_calories_text_color,
        price_background_color,
        price_text_font,
        price_text_weight,
        price_text_size,
        price_text_color,
        logo_border_radius,
        logo_border_color,
        header_color,
        header_radius,
        side_menu_position,
        order_cart_position,
        order_cart_color,
        order_cart_radius,
        home_position,
        home_color,
        home_radius,
        menu_category_background_color,
        menu_category_font,
        menu_category_weight,
        menu_category_size,
        menu_category_color,
        menu_category_position,
        menu_category_radius,
        menu_section_background_color,
        menu_section_radius,
        menu_card_radius,
    } = restaurantStyle;

    return (
        <div
            style={{
                backgroundColor: page_color,
            }}
            className=" h-full overflow-y-scroll hide-scroll"
        >
            <div
                style={{
                    backgroundColor: page_color,
                }}
                className="w-full h-full p-4 flex flex-col gap-[16px] relative mx-auto max-w-[1200px]"
            >
                <Header
                    restaurantStyle={restaurantStyle}
                    categories={categories}
                />
                <Logo restaurantStyle={restaurantStyle} />
                <Banner restaurantStyle={restaurantStyle} />
                <Category
                    restaurantStyle={restaurantStyle}
                    categories={categories}
                />
                <SocialMedia restaurantStyle={restaurantStyle} />
                <Footer restaurantStyle={restaurantStyle} />
            </div>
        </div>
    );
};

export default FullPage;
