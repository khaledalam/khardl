import {createSlice} from "@reduxjs/toolkit"

const restuarantEditorSlice = createSlice({
  name: "restuarantEditorSlice",
  initialState: {
    headerPosition: "relative",
    logo_alignment: "center",
    logo_shape: "rounded",
    banner_type: "one-page",
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
        imgUrl: "",
        link: "",
      },
    ],
    socialMediaIcons_alignment: "center",
    phoneNumber: "+96600000000",
    phoneNumber_alignment: "center",

    page_color: "#fafafa",
    category_background_color: "#4466ff",
    page_category_color: "#ffffff",
    header_color: "#ffffff",
    footer_color: "#ffffff",
    price_color: "#ffffff",

    text_fontFamily: "Inter",
    text_fontWeight: "bold",
    text_fontSize: 13,
    text_alignment: "center",
    text_color: "#333",
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
} = restuarantEditorSlice.actions
export default restuarantEditorSlice.reducer
