import React, { useContext, useEffect, useState } from "react";
import cartHeaderImg from "../../../../assets/cartBoldIcon.svg";
import { useNavigate } from "react-router-dom";
import { useDispatch, useSelector } from "react-redux";
import { RiMenuFoldFill } from "react-icons/ri";
import { IoCloseOutline } from "react-icons/io5";
import {
  logoUpload,
  SetSideBar,
} from "../../../../redux/NewEditor/restuarantEditorSlice";
import ImgPlaceholder from "../../../../assets/imgPlaceholder.png";
import HeaderSidebar from "../../../../assets/headerSidebar.svg";
import HeaderHomeIcon from "../../../../assets/headerHomeIcon.svg";
import HedaerIconCart from "../../../../assets/headerIconCart.svg";
import GreenDot from "../../../../assets/greenDot.png";

const HeaderEdit = ({
  restaurantStyle,
  toggleSidebarCollapse,
  isHighlighted,
  currentSubItem,
}) => {
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
    side_menu_position,
    order_cart_position,
    order_cart_color,
    order_cart_radius,
    home_position,
    home_color,
    home_radius,
    isSideBarOpen,
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
        borderRadius: `${restaurantStyle?.header_radius}px`,
      }}
      className={`w-full h-[56px] z-10 grid grid-cols-3 px-[16px] md:mt-[8px] ${
        isHighlighted && "shadow-inner border-[#C0D123] border-[2px]"
      }`}
    >
      <div
        className={`flex justify-center items-center w-[30px] h-[30px] rounded-full self-center shadow-md ${
          side_menu_position == "left"
            ? "justify-self-start"
            : side_menu_position == "right"
              ? "justify-self-end"
              : "justify-self-center"
        }`}
      >
        <div
          // onClick={() => dispatch(SetSideBar(!isSideBarOpen))}
          style={{ fontWeight: restaurantStyle?.text_fontWeight }}
          className={`flex items-center gap-3 cursor-pointer relative`}
        >
          <img src={HeaderSidebar} alt="sidebar icon" />
          <img
            src={GreenDot}
            alt="green dot"
            className={`${
              currentSubItem == "Side Menu"
                ? "absolute w-[5px] h-[5px] right-[-4px] top-[-6px]"
                : "hidden"
            }`}
          />
        </div>
      </div>

      <div
        // onClick={
        //     categories && categories.length > 0
        //         ? handleGotoCart
        //         : () => {}
        // }
        style={{
          backgroundColor: order_cart_color ? order_cart_color : "#F3F3F3",
          borderRadius: order_cart_radius ? `${order_cart_radius}px` : "50px",
        }}
        className={`w-[30px] h-[30px] pl-[8px] pr-[7px] pb-[9px] pt-[6px] relative flex items-center justify-center cursor-pointer self-center shadow-md ${
          order_cart_position == "left"
            ? "justify-self-start"
            : order_cart_position == "right"
              ? "justify-self-end"
              : "justify-self-center"
        }`}
      >
        <img src={HedaerIconCart} alt={"cart"} className="" />
        {cartItemsCount > 0 && (
          <div className="absolute top-0 right-0">
            <div className="w-[10px] h-[10px] rounded-full bg-[#FF3D00] flex items-center justify-center"></div>
          </div>
        )}
        <img
          src={GreenDot}
          alt="green dot"
          className={`${
            currentSubItem == "Order Cart"
              ? "absolute w-[5px] h-[5px] right-[-1px] top-[-3px]"
              : "hidden"
          }`}
        />
      </div>

      <div
        style={{
          backgroundColor: home_color ? home_color : "#F3F3F3",
          borderRadius: home_radius ? `${home_radius}px` : "50px",
        }}
        // onClick={() => navigate("/")}
        className={`pt-[6px] pb-[9px] pr-[7px] pl-[8px] rounded-full relative self-center hover:cursor-pointer shadow-md ${
          home_position == "left"
            ? "justify-self-start"
            : home_position == "right"
              ? "justify-self-end"
              : "justify-self-center"
        }`}
      >
        <img src={HeaderHomeIcon} alt={"home icon"} className="" />
        <img
          src={GreenDot}
          alt="green dot"
          className={`${
            currentSubItem == "Home"
              ? "absolute w-[5px] h-[5px] right-[-1px] top-[-3px]"
              : "hidden"
          }`}
        />
      </div>
    </div>
  );
};

export default HeaderEdit;
