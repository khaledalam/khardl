
import { createSlice } from '@reduxjs/toolkit';

const initialState = {
  styleDataRestaurant: null
};

const styleDataRestaurantSlice = createSlice({
  name: 'styleDataRestaurant',
  initialState,
  reducers: {
      changeStyleDataRestaurant: (state, action) => {
      state.styleDataRestaurant = action.payload;
    },
  },
});

export const { changeStyleDataRestaurant } = styleDataRestaurantSlice.actions;
export default styleDataRestaurantSlice.reducer;
