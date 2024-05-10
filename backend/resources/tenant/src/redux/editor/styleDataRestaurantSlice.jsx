import { createSlice } from "@reduxjs/toolkit";

const initialState = {
  styleDataRestaurant: null,
  restaurantStyleVersion: 0,
};

const styleDataRestaurantSlice = createSlice({
  name: "styleDataRestaurant",
  initialState,
  reducers: {
    changeStyleDataRestaurant: (state, action) => {
      state.styleDataRestaurant = action.payload;
    },
    changeRestaurantStyleVersion: (state, action) => {
      state.restaurantStyleVersion = action.payload;
    },
  },
});

export const { changeStyleDataRestaurant, changeRestaurantStyleVersion } =
  styleDataRestaurantSlice.actions;
export default styleDataRestaurantSlice.reducer;
