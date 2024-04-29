import { createSlice } from "@reduxjs/toolkit";

const logoSlice = createSlice({
  name: "logo",
  initialState: null,
  reducers: {
    setLogo: (state, action) => {
      return action.payload;
    },
    clearLogo: () => null,
  },
});

export const { setLogo, clearLogo } = logoSlice.actions;
export default logoSlice.reducer;
