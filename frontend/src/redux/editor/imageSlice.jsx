import { createSlice } from '@reduxjs/toolkit';

const imageSlice = createSlice({
  name: 'image',
  initialState: null,
  reducers: {
    setImage: (state, action) => {
      return action.payload;
    },
    clearImage: () => null,
  },
});

export const { setImage, clearImage } = imageSlice.actions;
export default imageSlice.reducer;