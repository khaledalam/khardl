import {createSlice} from "@reduxjs/toolkit"

const restuarantEditorSlice = createSlice({
  name: "restuarantEditorSlice",
  initialState: {
    headerPosition: "relative",

    logo_alignment: "center",
    logo_shape: "rounded",
    banner_type: "one-page",
    banner_shape: "rounded",

    category_type: "stack",
    category_alignment: "center",
    category_shape: "rounded",
    category_hover_color: "#ffffff",

    categoryDetail_type: "stack",
    categoryDetail_alignment: "center",
    categoryDetail_shape: "rounded",
    categoryDetail_cart_color: "#ffffff",

    socialMediaIcons: [
      {
        id: 4,
        name: "Telegram",
        icon: "BsTelegram",
        color: "Telegram",
        Link: "",
      },
      {id: 5, name: "Youtube", icon: "FaYoutube", color: "Youtube", Link: ""},
      {
        id: 6,
        name: "Instagram",
        icon: "BsInstagram",
        color: "Instagram",
        Link: "",
      },
      {
        id: 7,
        name: "Facebook",
        icon: "BsFacebook",
        color: "Facebook",
        Link: "",
      },
      {
        id: 8,
        name: "LinkedIn",
        icon: "BsLinkedin",
        color: "LinkedIn",
        Link: "",
      },
      {id: 9, name: "TikTok", icon: "BsTiktok", color: "TikTok", Link: ""},
    ],
    selectedSocialIcons: [
      {
        id: 1,
        name: "Whatsapp",
        icon: "BsWhatsapp",
        color: "Whatsapp",
        Link: "",
      },
    ],
    phoneNumber: "+96600000000",
    phoneNumber_alignment: "center",

    page_color: "#ffffff",
    header_color: "#ffffff",
    footer_color: "#ffffff",
    price_color: "#ffffff",

    text_fontFamily: "Inter",
    text_fontWeight: "bold",
    text_fontSize: 13,
    text_alignment: "center",
    text_color: "#ffffff",
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
    socialMediaIcons: (state, action) => {
      state.socialMediaIcons = action.payload
    },
    selectedSocialMediaIcons: (state, action) => {
      state.selectedSocialIcons = action.payload
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
    priceColor: (state, action) => {
      state.price_color = action.payload
    },
    headerColor: (state, action) => {
      state.header_color = action.payload
    },
    footerColor: (state, action) => {
      state.footer_color = action.payload
    },
  },
})

export const {selectAlign} = restuarantEditorSlice.actions
export const getSelectedAlign = (state) => state.align.selectedAlign
export default restuarantEditorSlice.reducer
