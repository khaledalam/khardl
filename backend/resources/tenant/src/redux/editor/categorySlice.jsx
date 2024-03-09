import { createSlice } from "@reduxjs/toolkit";

const categorySlice = createSlice({
    name: "category",
    initialState: {
        selectedCategory: "Tabs",
    },
    reducers: {
        selectCategory: (state, action) => {
            state.selectedCategory = action.payload;
        },
    },
});

export const { selectCategory } = categorySlice.actions;
export const getSelectedCategory = (state) => state.category.selectedCategory;
export default categorySlice.reducer;
