import { createSlice } from '@reduxjs/toolkit';

const initialState = {
  images: [],
};

const imagesSlice = createSlice({
  name: 'images',
  initialState,
  reducers: {
    addImage: (state, action) => {
      state.image = action.payload; 
    },
    removeImage: (state, action) => {
      const { index } = action.payload;
      state.image.splice(index, 1); // إزالة الصورة بناءً على الفهرس
    },
  },
});

export const { addImage, removeImage } = imagesSlice.actions;
export default imagesSlice.reducer;