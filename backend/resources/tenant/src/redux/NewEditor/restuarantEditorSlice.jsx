import {createSlice} from "@reduxjs/toolkit"
import ImgTelegram from "../../assets/imgTelgram.svg"
import ImgYoutube from "../../assets/imgYoutube.svg"
import ImgInstagram from "../../assets/ImgInstagram.svg"
import ImgFacebook from "../../assets/imgFB.svg"
import ImgLinkedin from "../../assets/Linkedin.svg"
import ImgTiktok from "../../assets/Tiktok.svg"
import ImgMsger from "../../assets/Msgner.svg"
import ImgX from "../../assets/Xtwitter.svg"
import ImgWhatsapp from "../../assets/whatsappImg.svg"

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
    logo_alignment: "center",
    logo_shape: "rounded",
    banner_type: "one-photo",
    banner_shape: "rounded",
    banner_background_color: "green",

    category_type: "stack",
    category_alignment: "center",
    category_shape: "rounded",
    category_hover_color: "#F2FF00",

    categoryDetail_type: "stack",
    categoryDetail_alignment: "center",
    categoryDetail_shape: "rounded",
    categoryDetail_cart_color: "#F2FF00",

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
    phoneNumber: "+96600000000",
    phoneNumber_alignment: "center",

    page_color: "#fafafa",
    category_background_color: "#4466ff",
    page_category_color: "#ffffff",
    product_background_color: "white",
    header_color: "#ffffff",
    footer_color: "#ffffff",
    price_color: "#ffffff",

    text_fontFamily: "Inter",
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
  },
  reducers: {
    headerPosition: (state, action) => {
      state.headerPosition = action.payload
    },
    logoAlignment: (state, action) => {
      state.logo_alignment = action.payload
    },
    logoShape: (state, action) => {
      state.logo_shape = action.payload
    },
    bannerType: (state, action) => {
      state.banner_type = action.payload
    },
    bannerShape: (state, action) => {
      state.banner_shape = action.payload
    },
    bannerBgColor: (state, action) => {
      state.banner_background_color = action.payload
    },
    categoryType: (state, action) => {
      state.category_type = action.payload
    },
    categoryAlignment: (state, action) => {
      state.category_alignment = action.payload
    },

    categoryHoverColor: (state, action) => {
      state.category_hover_color = action.payload
    },
    categoryShape: (state, action) => {
      state.category_shape = action.payload
    },
    categoryDetailType: (state, action) => {
      state.categoryDetail_type = action.payload
    },
    categoryDetailAlignment: (state, action) => {
      state.categoryDetail_alignment = action.payload
    },

    categoryDetailCartColor: (state, action) => {
      state.categoryDetail_cart_color = action.payload
    },
    categoryDetailShape: (state, action) => {
      state.categoryDetail_shape = action.payload
    },
    selectedSocialMediaIcons: (state, action) => {
      state.selectedSocialIcons = action.payload
    },
    socialMediaIconsAlignment: (state, action) => {
      state.socialMediaIcons_alignment = action.payload
    },
    phoneNumber: (state, action) => {
      state.phoneNumber = action.payload
    },
    phoneNumberAlignment: (state, action) => {
      state.phoneNumber_alignment = action.payload
    },
    pageColor: (state, action) => {
      state.page_color = action.payload
    },
    pageCategoryColor: (state, action) => {
      state.page_category_color = action.payload
    },
    productBackgroundColor: (state, action) => {
      state.product_background_color = action.payload
    },
    priceColor: (state, action) => {
      state.price_color = action.payload
    },
    headerColor: (state, action) => {
      state.header_color = action.payload
    },
    footerColor: (state, action) => {
      state.footer_color = action.payload
    },
    textFontFamily: (state, action) => {
      state.text_fontFamily = action.payload
    },
    textFontSize: (state, action) => {
      state.text_fontSize = action.payload
    },
    textFontWeight: (state, action) => {
      state.text_fontWeight = action.payload
    },
    textAlignment: (state, action) => {
      state.text_alignment = action.payload
    },
    textColor: (state, action) => {
      state.text_color = action.payload
    },
    logoUpload: (state, action) => {
      state.logoUpload = action.payload
    },

    changeRestuarantEditorStyle: (state, action) => {
      return (state = {
        ...state,
        ...action.payload,
      })
    },
    setBannerUpload: (state, action) => {
      state.bannerUpload = action.payload
    },
    setBannersUpload: (state, action) => {
      const {index, image} = action.payload
      state.bannersUpload[index] = image
    },
    removeBannersUpload: (state, action) => {
      const {index} = action.payload
      if (state.bannersUpload) {
        state.bannersUpload.splice(index, 1)
      }
      state.banner_images.splice(index, 1)
    },
    setSidebarCollapse: (state, action) => {
      state.collapse_sidebar = action.payload
    },
    setSelectedSocialMediaId: (state, action) => {
      state.selectedMediaId = action.payload
    },
    updateSelectedIconInput: (state, action) => {
      const {id, link} = action.payload
      const iconToUpdate = state.selectedSocialIcons.find(
        (icon) => icon.id === id
      )
      if (iconToUpdate) {
        iconToUpdate.link = link
      }
    },
    mediaIconsToSelected: (state, action) => {
      const iconId = action.payload
      const iconToMove = state.mediaCollection.find(
        (icon) => icon.id === iconId
      )
      if (iconToMove) {
        state.mediaCollection = state.mediaCollection.filter(
          (icon) => icon.id !== iconToMove.id
        )

        if (
          state.selectedSocialIcons.some(
            (social) => social.id !== iconToMove.id
          )
        ) {
          state.selectedSocialIcons.push(iconToMove)
        }
      }
    },
    moveSelectedIconsToMedia: (state, action) => {
      const iconIdToMove = action.payload
      const iconToMove = state.selectedSocialIcons.find(
        (icon) => icon.id === iconIdToMove
      )
      if (iconToMove) {
        state.selectedSocialIcons = state.selectedSocialIcons.filter(
          (icon) => icon.id !== iconIdToMove
        )
        state.mediaCollection.push(iconToMove)
      }
    },
    setTemplate: (state, action) => {
      state.template = action.payload
    },
  },
})

export const {
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
} = restuarantEditorSlice.actions
export default restuarantEditorSlice.reducer
