import { createSlice } from "@reduxjs/toolkit";

const initialState = {
  shapeImageShape: "0px",
};

const shapeImageSlice = createSlice({
  name: "shapeImage",
  initialState,
  reducers: {
    changeImageShape: (state, action) => {
      state.shapeImageShape = action.payload;
    },
  },
});

export const { changeImageShape } = shapeImageSlice.actions;
export default shapeImageSlice.reducer;
