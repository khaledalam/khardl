// drawerSlice.js
import { createSlice } from '@reduxjs/toolkit';

const drawerSlice = createSlice({
  name: 'drawer',
  initialState: {
    isOpen: false,
  },
  reducers: {
    setIsOpen: (state, action) => {
      state.isOpen = action.payload; 
    },
  },
});

export const { setIsOpen } = drawerSlice.actions;
export default drawerSlice.reducer;