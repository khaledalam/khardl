import { createSlice } from '@reduxjs/toolkit';

const bannerSlice = createSlice({
  name: 'banner',
  initialState: {
    selectedBanner: 'One Photo',
  },
  reducers: {
    selectBanner: (state, action) => {
      state.selectedBanner = action.payload;
    },
  },
});

export const { selectBanner } = bannerSlice.actions;
export const getSelectedBanner = state => state.banner.selectedBanner;
export default bannerSlice.reducer;
