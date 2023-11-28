import { createSlice } from '@reduxjs/toolkit';

const fontsSlice = createSlice({
    name: 'fonts',
    initialState: {
        fontsList: [],
        selectedFontFamily: 'cairo',
        selectedFontWeight: 'normal',
        selectedFontSize: '15px',
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
        setSelectedFontSize: (state, action) => {
            state.selectedFontSize = action.payload;
        },
    },
});

export const { setSelectedFontFamily, setSelectedFontWeight, setFontsList ,setSelectedFontSize} = fontsSlice.actions;
export default fontsSlice.reducer;
