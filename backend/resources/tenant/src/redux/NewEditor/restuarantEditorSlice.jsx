import { createSlice } from "@reduxjs/toolkit";
import ImgTelegram from "../../assets/imgTelgram.svg";
import ImgYoutube from "../../assets/imgYoutube.svg";
import ImgInstagram from "../../assets/ImgInstagram.svg";
import ImgFacebook from "../../assets/imgFB.svg";
import ImgLinkedin from "../../assets/Linkedin.svg";
import ImgTiktok from "../../assets/Tiktok.svg";
import ImgMsger from "../../assets/Msgner.svg";
import ImgX from "../../assets/Xtwitter.svg";
import ImgWhatsapp from "../../assets/whatsappImg.svg";

const restuarantEditorSlice = createSlice({
  name: "restuarantEditorSlice",
  initialState: {
    id: 1,
    user: null,
    logo: "",
    logoUpload: null,
    bannerUpload: null,
    bannersUpload: [],
    headerPosition: "relative",
    logo_alignment: "right",
    logo_shape: "rounded",
    banner_type: "one-photo",
    banner_shape: "rounded",
    banner_background_color: "white",

    category_type: "stack",
    category_alignment: "center",
    category_shape: "rounded",
    category_hover_color: "#F2FF00",

    categoryDetail_type: "stack",
    categoryDetail_alignment: "center",
    categoryDetail_shape: "rounded",
    categoryDetail_cart_color: "#FFFFFF",

    selectedSocialIcons: [
      {
        id: 1,
        name: "Whatsapp",
        imgUrl: "https://cdn-icons-png.flaticon.com/128/5968/5968841.png",
        link: "",
      },
    ],

    mediaCollection: [
      {
        id: 1,
        // name: "Whatsapp",
        imgUrl: "https://cdn-icons-png.flaticon.com/128/5968/5968841.png",
        link: "",
      },
      {
        id: 2,
        // name: "Telegram",
        imgUrl: "https://cdn-icons-png.flaticon.com/128/2111/2111646.png",
        link: "",
      },
      {
        id: 3,
        // name: "Youtube",
        imgUrl: "https://cdn-icons-png.flaticon.com/128/3670/3670147.png",
        link: "",
      },
      {
        id: 4,
        // name: "Instagram",
        imgUrl: "https://cdn-icons-png.flaticon.com/128/2111/2111463.png",
        link: "",
      },
      {
        id: 5,
        // name: "Facebook",
        imgUrl: "https://cdn-icons-png.flaticon.com/128/3670/3670032.png",
        link: "",
      },
      {
        id: 6,
        // name: "LinkedIn",
        imgUrl: "https://cdn-icons-png.flaticon.com/128/2504/2504923.png",
        link: "",
      },
      {
        id: 7,
        // name: "Tiktok",
        imgUrl: "https://cdn-icons-png.flaticon.com/128/3116/3116490.png",
        link: "",
      },
      {
        id: 8,
        // name: "Messenger",
        imgUrl: "https://cdn-icons-png.flaticon.com/128/5968/5968771.png",
        link: "",
      },
      {
        id: 9,
        // name: "X",
        imgUrl: "https://cdn-icons-png.flaticon.com/128/11823/11823292.png",
        link: "",
      },
    ],

    selectedMediaId: 1,
    socialMediaIcons_alignment: "center",
    social_media_color: "#FFFFFF",
    social_media_background_color: "#FFFFFF",
    social_media_radius: 25,
    phoneNumber: "",
    phoneNumber_alignment: "center",

    menu_card_background_color: "#FFECD61A",
    menu_card_text_font: "Inter",
    menu_card_text_weight: "light",
    menu_card_text_size: 13,
    menu_card_text_color: "#333",
    menu_card_radius: 20,

    menu_name_background_color: "#FFFFFF",
    menu_name_text_font: "Inter",
    menu_name_text_weight: "light",
    menu_name_text_size: 12,
    menu_name_text_color: "#000",

    total_calories_background_color: "#FFFFFF",
    total_calories_text_font: "Inter",
    total_calories_text_weight: "light",
    total_calories_text_size: 10,
    total_calories_text_color: "#000",

    price_background_color: "#7D0A0A",
    price_text_font: "Inter",
    price_text_weight: "light",
    price_text_size: 12,
    price_text_color: "#FFFFFF",

    header_position: "relative",
    header_color: "#ffffff",
    header_radius: 50,

    side_menu_position: "left",

    order_cart_position: "center",
    order_cart_color: "#ffffff",
    order_cart_radius: 50,

    home_position: "right",
    home_color: "#ffffff",
    home_radius: 50,

    menu_section_background_color: "#ffffff",
    menu_section_radius: 20,

    menu_category_background_color: "#ffffff",
    menu_category_font: "Inter",
    menu_category_weight: "light",
    menu_category_size: 13,
    menu_category_color: "#000000",
    menu_category_position: "center",
    menu_category_radius: 20,

    page_color: "#eee",
    category_background_color: "#4466ff",
    page_category_color: "#ffffff",
    product_background_color: "white",
    footer_color: "#ffffff",
    footer_alignment: "center",
    footer_text_fontFamily: "Inter",
    footer_text_fontWeight: "light",
    footer_text_fontSize: 10,
    footer_text_color: "#000000",
    price_color: "red",

    text_fontFamily: "Jakarta",
    text_fontWeight: 400,
    text_fontSize: 13,
    text_alignment: "center",
    text_color: "#333",
    banner_image: "",
    banner_images: [],
    logo_url: null,
    banner_image_url: null,
    banner_images_urls: null,
    collapse_sidebar: false,
    template: "template-1",

    logo_border_radius: 0,
    logo_border_color: "white",

    isSideBarOpen: false,
    isLoginModalOpen: false,
    isRegisterModalOpen: false,
  },
  reducers: {
    headerPosition: (state, action) => {
      state.headerPosition = action.payload;
    },
    logoAlignment: (state, action) => {
      state.logo_alignment = action.payload;
    },
    logoShape: (state, action) => {
      state.logo_shape = action.payload;
    },
    bannerType: (state, action) => {
      state.banner_type = action.payload;
    },
    bannerShape: (state, action) => {
      state.banner_shape = action.payload;
    },
    bannerBgColor: (state, action) => {
      state.banner_background_color = action.payload;
    },
    categoryType: (state, action) => {
      state.category_type = action.payload;
    },
    categoryAlignment: (state, action) => {
      state.category_alignment = action.payload;
    },

    categoryHoverColor: (state, action) => {
      state.category_hover_color = action.payload;
    },
    categoryShape: (state, action) => {
      state.category_shape = action.payload;
    },
    categoryDetailType: (state, action) => {
      state.categoryDetail_type = action.payload;
    },
    categoryDetailAlignment: (state, action) => {
      state.categoryDetail_alignment = action.payload;
    },

    categoryDetailCartColor: (state, action) => {
      state.categoryDetail_cart_color = action.payload;
    },
    categoryDetailShape: (state, action) => {
      state.categoryDetail_shape = action.payload;
    },
    selectedSocialMediaIcons: (state, action) => {
      state.selectedSocialIcons = action.payload;
    },
    socialMediaIconsAlignment: (state, action) => {
      state.socialMediaIcons_alignment = action.payload;
    },
    socialMediaColor: (state, action) => {
      state.social_media_color = action.payload;
    },
    socialMediaBackgroundColor: (state, action) => {
      state.social_media_background_color = action.payload;
    },
    socialMediaRadius: (state, action) => {
      state.social_media_radius = action.payload;
    },
    phoneNumber: (state, action) => {
      state.phoneNumber = action.payload;
    },
    phoneNumberAlignment: (state, action) => {
      state.phoneNumber_alignment = action.payload;
    },
    pageColor: (state, action) => {
      state.page_color = action.payload;
    },
    pageCategoryColor: (state, action) => {
      state.page_category_color = action.payload;
    },
    productBackgroundColor: (state, action) => {
      state.product_background_color = action.payload;
    },
    priceColor: (state, action) => {
      state.price_color = action.payload;
    },
    footerColor: (state, action) => {
      state.footer_color = action.payload;
    },
    textFontFamily: (state, action) => {
      state.text_fontFamily = action.payload;
    },
    textFontSize: (state, action) => {
      state.text_fontSize = action.payload;
    },
    textFontWeight: (state, action) => {
      state.text_fontWeight = action.payload;
    },
    textAlignment: (state, action) => {
      state.text_alignment = action.payload;
    },
    footerAlignment: (state, action) => {
      state.footer_alignment = action.payload;
    },
    footerTextFont: (state, action) => {
      state.footer_text_fontFamily = action.payload;
    },
    footerTextWeight: (state, action) => {
      state.footer_text_fontWeight = action.payload;
    },
    footerTextSize: (state, action) => {
      state.footer_text_fontSize = action.payload;
    },
    footerTextColor: (state, action) => {
      state.footer_text_color = action.payload;
    },
    textColor: (state, action) => {
      state.text_color = action.payload;
    },
    logoUpload: (state, action) => {
      state.logoUpload = action.payload;
    },

    MenuCardBackgroundColor: (state, action) => {
      state.menu_card_background_color = action.payload;
    },
    MenuCardTextFont: (state, action) => {
      state.menu_card_text_font = action.payload;
    },
    MenuCardTextWeight: (state, action) => {
      state.menu_card_text_weight = action.payload;
    },
    MenuCardTextSize: (state, action) => {
      state.menu_card_text_size = action.payload;
    },
    MenuCardTextColor: (state, action) => {
      state.menu_card_text_color = action.payload;
    },

    MenuNameBackgroundColor: (state, action) => {
      state.menu_name_background_color = action.payload;
    },
    MenuNameTextFont: (state, action) => {
      state.menu_name_text_font = action.payload;
    },
    MenuNameTextWeight: (state, action) => {
      state.menu_name_text_weight = action.payload;
    },
    MenuNameTextSize: (state, action) => {
      state.menu_name_text_size = action.payload;
    },
    MenuNameTextColor: (state, action) => {
      state.menu_name_text_color = action.payload;
    },

    TotalCaloriesBackgroundColor: (state, action) => {
      state.total_calories_background_color = action.payload;
    },
    TotalCaloriesTextFont: (state, action) => {
      state.total_calories_text_font = action.payload;
    },
    TotalCaloriesTextWeight: (state, action) => {
      state.total_calories_text_weight = action.payload;
    },
    TotalCaloriesTextSize: (state, action) => {
      state.total_calories_text_size = action.payload;
    },
    TotalCaloriesTextColor: (state, action) => {
      state.total_calories_text_color = action.payload;
    },

    PriceBackgroundColor: (state, action) => {
      state.price_background_color = action.payload;
    },
    PriceTextFont: (state, action) => {
      state.price_text_font = action.payload;
    },
    PriceTextWeight: (state, action) => {
      state.price_text_weight = action.payload;
    },
    PriceTextSize: (state, action) => {
      state.price_text_size = action.payload;
    },
    PriceTextColor: (state, action) => {
      state.price_text_color = action.payload;
    },
    HeaderPosition: (state, action) => {
      state.header_position = action.payload;
    },
    HeaderColor: (state, action) => {
      state.header_color = action.payload;
    },
    HeaderRadius: (state, action) => {
      state.header_radius = action.payload;
    },
    SideMenuPosition: (state, action) => {
      state.side_menu_position = action.payload;
    },
    OrderCartPosition: (state, action) => {
      state.order_cart_position = action.payload;
    },
    OrderCartColor: (state, action) => {
      state.order_cart_color = action.payload;
    },
    OrderCartRadius: (state, action) => {
      state.order_cart_radius = action.payload;
    },
    HomePosition: (state, action) => {
      state.home_position = action.payload;
    },
    HomeColor: (state, action) => {
      state.home_color = action.payload;
    },
    HomeRadius: (state, action) => {
      state.home_radius = action.payload;
    },
    MenuCategoryBackgroundColor: (state, action) => {
      state.menu_category_background_color = action.payload;
    },
    MenuCategoryFont: (state, action) => {
      state.menu_category_font = action.payload;
    },
    MenuCategoryWeight: (state, action) => {
      state.menu_category_weight = action.payload;
    },
    MenuCategorySize: (state, action) => {
      state.menu_category_size = action.payload;
    },
    MenuCategoryColor: (state, action) => {
      state.menu_category_color = action.payload;
    },
    MenuCategoryPosition: (state, action) => {
      state.menu_category_position = action.payload;
    },
    MenuCategoryRadius: (state, action) => {
      state.menu_category_radius = action.payload;
    },
    MenuSectionBackgroundColor: (state, action) => {
      state.menu_section_background_color = action.payload;
    },
    MenuSectionRadius: (state, action) => {
      state.menu_section_radius = action.payload;
    },
    MenuCardRadius: (state, action) => {
      state.menu_card_radius = action.payload;
    },

    SetSideBar: (state, action) => {
      state.isSideBarOpen = action.payload;
    },
    SetLoginModal: (state, action) => {
      state.isLoginModalOpen = action.payload;
    },
    SetRegisterModal: (state, action) => {
      state.isRegisterModalOpen = action.payload;
    },

    changeRestuarantEditorStyle: (state, action) => {
      // action.payload.page_color = "green";
      const root = document.querySelector(":root");
      root.style.setProperty("--myColor", action.payload.page_color);
      return (state = {
        ...state,
        ...action.payload,
      });
    },
    BannerImages: (state, action) => {
      state.banner_images = action.payload;
    },
    setBannerUpload: (state, action) => {
      state.bannerUpload = action.payload;
    },
    setBannersUpload: (state, action) => {
      const { index, image } = action.payload;
      state.bannersUpload[index] = image;
    },
    removeBannersUpload: (state, action) => {
      const { index } = action.payload;
      if (state.bannersUpload) {
        state.bannersUpload.splice(index, 1);
      }
      state.banner_images.splice(index, 1);
    },
    setSidebarCollapse: (state, action) => {
      state.collapse_sidebar = action.payload;
    },
    setSelectedSocialMediaId: (state, action) => {
      state.selectedMediaId = action.payload;
    },
    updateSelectedIconInput: (state, action) => {
      const { id, link } = action.payload;
      const iconToUpdate = state.selectedSocialIcons.find(
        (icon) => icon.id === id,
      );
      if (iconToUpdate) {
        iconToUpdate.link = link;
      }
    },
    mediaIconsToSelected: (state, action) => {
      const iconId = action.payload;
      const iconToMove = state.mediaCollection.find(
        (icon) => icon.id === iconId,
      );
      if (iconToMove) {
        state.mediaCollection = state.mediaCollection.filter(
          (icon) => icon.id !== iconToMove.id,
        );

        if (
          state.selectedSocialIcons.length === 0 ||
          state.selectedSocialIcons.some(
            (social) => social.id !== iconToMove.id,
          )
        ) {
          state.selectedSocialIcons.push(iconToMove);
        }
      }
    },
    moveSelectedIconsToMedia: (state, action) => {
      const iconIdToMove = action.payload;
      const iconToMove = state.selectedSocialIcons.find(
        (icon) => icon.id === iconIdToMove,
      );

      if (iconToMove) {
        state.selectedSocialIcons = state.selectedSocialIcons.filter(
          (icon) => icon.id !== iconIdToMove,
        );
      }
    },
    setTemplate: (state, action) => {
      state.template = action.payload;
    },
    pageBackgroundColor: (state, action) => {
      state.page_color = action.payload;
    },
    headerSideMenuIconPosition: (state, action) => {
      state.header_side_menu_icon_position = action.payload;
    },
    headerSideMenuIconLocation: (state, action) => {
      state.header_side_menu_icon_location = action.payload;
    },
    headerSideMenuIconBackgroundColor: (state, action) => {
      state.header_side_menu_icon_background_color = action.payload;
    },

    logoBorderRadius: (state, action) => {
      state.logo_border_radius = action.payload;
    },
    logoBorderColor: (state, action) => {
      state.logo_border_color = action.payload;
    },
  },
});

export const {
  pageBackgroundColor,

  logoBorderRadius,
  logoBorderColor,

  headerPosition,
  logoAlignment,
  logoShape,
  categoryType,
  categoryHoverColor,
  categoryShape,
  categoryAlignment,
  categoryDetailType,
  categoryDetailAlignment,
  categoryDetailCartColor,
  categoryDetailShape,
  socialMediaIcons,
  selectedSocialMediaIcons,
  socialMediaIconsAlignment,
  pageColor,
  pageCategoryColor,
  productBackgroundColor,
  priceColor,
  headerColor,
  footerColor,
  footerAlignment,
  footerTextFont,
  footerTextWeight,
  footerTextSize,
  footerTextColor,
  textFontFamily,
  textFontWeight,
  textFontSize,
  textAlignment,
  textColor,
  bannerBgColor,
  bannerType,
  bannerShape,
  phoneNumber,
  phoneNumberAlignment,
  changeRestuarantEditorStyle,
  logoUpload,
  setBannerUpload,
  setBannersUpload,
  removeBannersUpload,
  setSidebarCollapse,
  updateSelectedIconInput,
  mediaIconsToSelected,
  moveSelectedIconsToMedia,
  setSelectedSocialMediaId,
  setTemplate,
  socialMediaColor,
  socialMediaBackgroundColor,
  socialMediaRadius,
  MenuCardBackgroundColor,
  MenuCardTextFont,
  MenuCardTextWeight,
  MenuCardTextSize,
  MenuCardTextColor,
  MenuNameBackgroundColor,
  MenuNameTextFont,
  MenuNameTextWeight,
  MenuNameTextSize,
  MenuNameTextColor,
  TotalCaloriesBackgroundColor,
  TotalCaloriesTextFont,
  TotalCaloriesTextWeight,
  TotalCaloriesTextSize,
  TotalCaloriesTextColor,
  PriceBackgroundColor,
  PriceTextFont,
  PriceTextWeight,
  PriceTextSize,
  PriceTextColor,
  HeaderPosition,
  HeaderColor,
  HeaderRadius,
  SideMenuPosition,
  OrderCartPosition,
  OrderCartColor,
  OrderCartRadius,
  HomePosition,
  HomeColor,
  HomeRadius,
  MenuCategoryBackgroundColor,
  MenuCategoryFont,
  MenuCategoryWeight,
  MenuCategorySize,
  MenuCategoryColor,
  MenuCategoryPosition,
  MenuCategoryRadius,
  MenuSectionBackgroundColor,
  MenuSectionRadius,
  MenuCardRadius,
  BannerImages,
  SetSideBar,
  SetLoginModal,
  SetRegisterModal,
} = restuarantEditorSlice.actions;
export default restuarantEditorSlice.reducer;
