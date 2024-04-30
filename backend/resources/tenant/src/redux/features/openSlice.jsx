import { createSlice } from "@reduxjs/toolkit";

const initialState = {
  open: false,
};

const openSlice = createSlice({
  name: "open",
  initialState,
  reducers: {
    changeOpen: (state, action) => {
      state.open = action.payload;
    },
  },
});

export const { changeOpen } = openSlice.actions;
export default openSlice.reducer;
