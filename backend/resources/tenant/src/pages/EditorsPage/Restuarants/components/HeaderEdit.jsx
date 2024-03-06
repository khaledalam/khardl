import React, { useContext, useState } from "react";
import cartHeaderImg from "../../../../assets/cartBoldIcon.svg";
import { useNavigate } from "react-router-dom";
import { useDispatch, useSelector } from "react-redux";
import { RiMenuFoldFill } from "react-icons/ri";
import { IoCloseOutline } from "react-icons/io5";
import { logoUpload } from "../../../../redux/NewEditor/restuarantEditorSlice";
import ImgPlaceholder from "../../../../assets/imgPlaceholder.png";
const HeaderEdit = ({ restaurantStyle, toggleSidebarCollapse }) => {
    const [isCropModalOpened, setIsCropModalOpened] = useState(false);
    const [uncroppedImage, setUncroppedImage] = useState(null);
    const [imgType, setImgType] = useState("");

    const navigate = useNavigate();
    const dispatch = useDispatch();

    const cartItemsCount = useSelector(
        (state) => state.categoryAPI.cartItemsCount
    );
    const categories = useSelector((state) => state.categoryAPI.categories);
    const restuarantEditorStyle = useSelector(
        (state) => state.restuarantEditorStyle
    );
    const handleGotoCart = () => {
        navigate("/cart");
    };

    const uploadLogo = useSelector(
        (state) => state.restuarantEditorStyle.logoUpload
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
            className="w-full min-h-[85px] z-10  rounded-xl flex items-center justify-between px-2"
        >
            <div
                onClick={toggleSidebarCollapse}
                style={{ fontWeight: restaurantStyle?.text_fontWeight }}
                className={`btn hover:bg-neutral-100 flex items-center gap-3 cursor-pointer`}
            >
                <RiMenuFoldFill size={30} className="text-neutral-400" />
            </div>

            {uploadLogo || logo ? (
                <div
                    style={{ backgroundColor: page_color }}
                    className={`w-full min-h-[100px]    rounded-xl flex ${
                        logo_alignment === "center"
                            ? "items-center justify-center"
                            : logo_alignment === "left"
                            ? "items-center justify-start"
                            : logo_alignment === "right"
                            ? "items-center justify-end"
                            : ""
                    } `}
                >
                    <div
                        style={{
                            borderRadius: logo_shape === "sharp" ? 0 : 12,
                        }}
                        className="w-[60px] h-[60px] p-2 bg-neutral-100 relative"
                    >
                        <input
                            type="file"
                            name="logo"
                            id={"logo"}
                            accept="image/*"
                            onChange={handleLogoUpload}
                            className="hidden"
                            hidden
                        />
                        <label htmlFor="logo">
                            <img
                                src={
                                    uploadLogo
                                        ? uploadLogo
                                        : logo
                                        ? logo
                                        : ImgPlaceholder
                                }
                                alt={""}
                                style={{
                                    borderRadius:
                                        logo_shape === "sharp" ? 0 : 12,
                                }}
                                className="w-full h-full object-cover"
                            />
                        </label>
                        {uploadLogo && (
                            <div className="absolute top-[-0.8rem] right-[-1rem] cursor-pointer">
                                <div className="w-[20px] h-[20px] rounded-full p-1 bg-neutral-100 flex items-center justify-center">
                                    <IoCloseOutline
                                        size={16}
                                        className="text-red-500 cursor-pointer"
                                        onClick={clearLogo}
                                    />
                                </div>
                            </div>
                        )}
                    </div>
                </div>
            ) : (
                <div className="skeleton w-16 h-16 rounded-full shrink-0"></div>
            )}

            <div
                onClick={
                    categories && categories.length > 0
                        ? handleGotoCart
                        : () => {}
                }
                className="w-[50px] h-[50px] rounded-lg bg-neutral-200 relative flex items-center justify-center cursor-pointer"
            >
                <img src={cartHeaderImg} alt={"cart"} className="" />
                {cartItemsCount > 0 && (
                    <div className="absolute top-[-0.5rem] right-[-0.5rem]">
                        <div className="w-[20px] h-[20px] rounded-full p-1 bg-red-500 flex items-center justify-center">
                            <span className="text-white font-bold text-xs">
                                {cartItemsCount}
                            </span>
                        </div>
                    </div>
                )}
            </div>
        </div>
    );
};

export default HeaderEdit;
