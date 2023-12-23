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
    selectedIcons: [
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
    selectAlign: (state, action) => {
      state.selectedAlign = action.payload
    },
  },
})

export const {selectAlign} = restuarantEditorSlice.actions
export const getSelectedAlign = (state) => state.align.selectedAlign
export default restuarantEditorSlice.reducer
