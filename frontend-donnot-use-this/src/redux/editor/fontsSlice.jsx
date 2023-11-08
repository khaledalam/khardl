import { createSlice } from '@reduxjs/toolkit';

const fontsSlice = createSlice({
    name: 'fonts',
    initialState: {
        fontsList: [],
        selectedFontFamily: 'cairo',
        selectedFontWeight: 'normal',
    },
    reducers: {
        setFontsList: (state, action) => {
            state.fontsList = action.payload;
        },
        setSelectedFontFamily: (state, action) => {
            state.selectedFontFamily = action.payload;
        },
        setSelectedFontWeight: (state, action) => {
            state.selectedFontWeight = action.payload;
        },
    },
});

export const { setSelectedFontFamily, setSelectedFontWeight, setFontsList } = fontsSlice.actions;
export default fontsSlice.reducer;
