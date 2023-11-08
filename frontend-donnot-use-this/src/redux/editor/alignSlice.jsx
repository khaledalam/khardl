import { createSlice } from '@reduxjs/toolkit';

const alignSlice = createSlice({
  name: 'align',
  initialState: {
    selectedAlign: 'Center',
  },
  reducers: {
    selectAlign: (state, action) => {
      state.selectedAlign = action.payload;
    },
  },
});

export const { selectAlign } = alignSlice.actions;
export const getSelectedAlign = state => state.align.selectedAlign;
export default alignSlice.reducer;
