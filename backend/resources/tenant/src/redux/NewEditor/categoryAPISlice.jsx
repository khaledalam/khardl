import {createSlice} from "@reduxjs/toolkit"

const categoryAPISlice = createSlice({
  name: "categoryAPI",
  initialState: {
    selected_category: "first category",
  },
  reducers: {
    selectedCategoryAPI: (state, action) => {
      state.selected_category = action.payload
    },
  },
})

export const {selectedCategoryAPI} = categoryAPISlice.actions
export default categoryAPISlice.reducer
