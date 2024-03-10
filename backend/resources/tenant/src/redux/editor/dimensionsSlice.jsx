import { createSlice } from "@reduxjs/toolkit";

const dimensionsSlice = createSlice({
    name: "dimensions",
    initialState: { width: 0, height: 0 },
    reducers: {
        setDimensions: (state, action) => {
            state.width = action.payload.width;
            state.height = action.payload.height;
        },
    },
});

export const { setDimensions } = dimensionsSlice.actions;
export default dimensionsSlice.reducer;
