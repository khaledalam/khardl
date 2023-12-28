import {createSlice} from "@reduxjs/toolkit"

const categoryAPISlice = createSlice({
  name: "categoryAPI",
  initialState: {
    selected_category: {
      name: "first category",
      id: 1,
    },
  },
  reducers: {
    selectedCategoryAPI: (state, action) => {
      state.selected_category = action.payload
    },
  },
})

export const {selectedCategoryAPI} = categoryAPISlice.actions
export default categoryAPISlice.reducer
