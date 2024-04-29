// linkSlice.js
import { createSlice } from "@reduxjs/toolkit";

const linkSlice = createSlice({
  name: "link",
  initialState: {
    activeLink: "/",
  },
  reducers: {
    setActiveLink: (state, action) => {
      state.activeLink = action.payload;
    },
  },
});

export const { setActiveLink } = linkSlice.actions;
export default linkSlice.reducer;
