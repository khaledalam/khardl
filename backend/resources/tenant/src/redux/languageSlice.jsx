import { createSlice } from "@reduxjs/toolkit";
import i18n from "../translation/i18next";

const initialState = {
  languageMode: localStorage.getItem("i18nextLng") || "ar",
};

const languageSlice = createSlice({
  name: "languageMode",
  initialState,
  reducers: {
    changeLanguage: (state, action) => {
      state.languageMode = action.payload;
      localStorage.setItem("i18nextLng", state.languageMode);
      i18n.changeLanguage(state.languageMode);
      document.body.dir = i18n.dir();
    },
  },
});

export const { changeLanguage } = languageSlice.actions;
export default languageSlice.reducer;
