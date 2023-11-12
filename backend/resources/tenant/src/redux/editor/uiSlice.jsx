import { createSlice } from '@reduxjs/toolkit';

const uiSlice = createSlice({
  name: 'ui',
  initialState: {
    screenSize: 'desktop',
  },
  reducers: {
    setScreenSize: (state, action) => {
      state.screenSize = action.payload;
    },
  },
});

export const { setScreenSize } = uiSlice.actions;

export default uiSlice.reducer;