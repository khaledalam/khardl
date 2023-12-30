import {createSlice} from "@reduxjs/toolkit"

const categoryAPISlice = createSlice({
  name: "categoryAPI",
  initialState: {
    selected_category: {
      name: "first category",
      id: 1,
    },
    categories: [],
    cartItemsCount: 0,
  },
  reducers: {
    selectedCategoryAPI: (state, action) => {
      state.selected_category = action.payload
    },
    setCategoriesAPI: (state, action) => {
      state.categories = action.payload
    },
    getCartItemsCount: (state, action) => {
      state.cartItemsCount = action.payload
    },
  },
})

export const {selectedCategoryAPI, setCategoriesAPI, getCartItemsCount} =
  categoryAPISlice.actions
export default categoryAPISlice.reducer
