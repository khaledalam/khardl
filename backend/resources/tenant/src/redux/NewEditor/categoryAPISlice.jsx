import {createSlice} from "@reduxjs/toolkit"

const categoryAPISlice = createSlice({
  name: "categoryAPI",
  initialState: {
    selected_category: {
      name: "first category",
      id: 1,
    },
    categories: [],
  },
  reducers: {
    selectedCategoryAPI: (state, action) => {
      state.selected_category = action.payload
    },
    setCategoriesAPI: (state, action) => {
      state.categories = action.payload
    },
  },
})

export const {selectedCategoryAPI, setCategoriesAPI} = categoryAPISlice.actions
export default categoryAPISlice.reducer
