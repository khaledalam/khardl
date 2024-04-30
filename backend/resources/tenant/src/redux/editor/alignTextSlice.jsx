import { createSlice } from "@reduxjs/toolkit";

const alignTextSlice = createSlice({
  name: "alignText",
  initialState: {
    selectedAlignText: "Center",
  },
  reducers: {
    selectAlignText: (state, action) => {
      state.selectedAlignText = action.payload;
    },
  },
});

export const { selectAlignText } = alignTextSlice.actions;
export default alignTextSlice.reducer;
