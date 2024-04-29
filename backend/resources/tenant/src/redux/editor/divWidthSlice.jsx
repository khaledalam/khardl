import { createSlice } from "@reduxjs/toolkit";

const divWidthSlice = createSlice({
  name: "divWidth",
  initialState: {
    value: window.innerWidth <= 768 ? 768 : window.innerWidth,
  },
  reducers: {
    setDivWidth: (state, action) => {
      state.value = action.payload;
    },
  },
});

export const { setDivWidth } = divWidthSlice.actions;
export default divWidthSlice.reducer;
