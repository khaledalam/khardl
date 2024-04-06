import React, { useContext, useState } from "react";
import cartHeaderImg from "../../../../assets/cartBoldIcon.svg";
import { useNavigate } from "react-router-dom";
import { useDispatch, useSelector } from "react-redux";
import { RiMenuFoldFill } from "react-icons/ri";
import { IoCloseOutline } from "react-icons/io5";
import { logoUpload } from "../../../../redux/NewEditor/restuarantEditorSlice";
import ImgPlaceholder from "../../../../assets/imgPlaceholder.png";
import HeaderSidebar from "../../../../assets/headerSidebar.svg";
import HeaderHomeIcon from "../../../../assets/headerHomeIcon.svg";
import HedaerIconCart from "../../../../assets/headerIconCart.svg";
const HeaderEdit = ({ restaurantStyle, toggleSidebarCollapse }) => {
    const [isCropModalOpened, setIsCropModalOpened] = useState(false);
    const [uncroppedImage, setUncroppedImage] = useState(null);
    const [imgType, setImgType] = useState("");

    const navigate = useNavigate();
    const dispatch = useDispatch();

    const cartItemsCount = useSelector(
        (state) => state.categoryAPI.cartItemsCount,
    );
    const categories = useSelector((state) => state.categoryAPI.categories);
    const restuarantEditorStyle = useSelector(
        (state) => state.restuarantEditorStyle,
    );
    const handleGotoCart = () => {
        navigate("/cart");
    };

    const uploadLogo = useSelector(
        (state) => state.restuarantEditorStyle.logoUpload,
    );
    const clearLogo = () => {
        dispatch(logoUpload(null));
    };
    const {
        page_color,
        page_category_color,
        product_background_color,
        category_hover_color,
        category_alignment,
        category_shape,

        categoryDetail_cart_color,
        categoryDetail_type,
        categoryDetail_alignment,
        categoryDetail_shape,

        price_color,
        logo,
        banner_image,
        banner_images,
        header_color,
        banner_background_color,
        footer_color,
        headerPosition,
        logo_alignment,
        logo_shape,
        banner_type,
        banner_shape,
        text_fontFamily,
        text_fontWeight,
        text_fontSize,
        text_alignment,
        phoneNumber,
        phoneNumber_alignment,
        socialMediaIcons_alignment,
        selectedSocialIcons,
        text_color,
    } = restuarantEditorStyle;
    const handleLogoUpload = (event) => {
        event.preventDefault();

        const selectedLogo = event.target.files[0];
        if (selectedLogo) {
            setUncroppedImage(URL.createObjectURL(selectedLogo));
            setIsCropModalOpened(true);
            setImgType("logoUpload");
            dispatch(logoUpload(URL.createObjectURL(selectedLogo)));
        }
    };
    return (
        <div
            style={{
                backgroundColor: restaurantStyle?.header_color,
            }}
            className="w-full h-[56px] z-10 rounded-[50px] flex items-center justify-between px-[16px] md:mt-[8px]"
        >
            <div className="flex justify-start w-[30px]">
                <div
                    onClick={toggleSidebarCollapse}
                    style={{ fontWeight: restaurantStyle?.text_fontWeight }}
                    className={`flex items-center gap-3 cursor-pointer`}
                >
                    <img src={HeaderSidebar} alt="sidebar icon" />
                </div>
            </div>

            <div
                onClick={
                    categories && categories.length > 0
                        ? handleGotoCart
                        : () => {}
                }
                className="w-[30px] h-[30px] pl-[8px] pr-[7px] pb-[9px] pt-[6px] rounded-full bg-[#F3F3F3] relative flex items-center justify-center cursor-pointer"
            >
                <img src={HedaerIconCart} alt={"cart"} className="" />
                {cartItemsCount > 0 && (
                    <div className="absolute top-0 right-0">
                        <div className="w-[10px] h-[10px] rounded-full bg-[#FF3D00] flex items-center justify-center"></div>
                    </div>
                )}
            </div>

            <div className="pt-[6px] pb-[9px] pr-[7px] pl-[8px] bg-[#F3F3F3] rounded-full">
                <img src={HeaderHomeIcon} alt={"home icon"} className="" />
            </div>
        </div>
    );
};

export default HeaderEdit;
