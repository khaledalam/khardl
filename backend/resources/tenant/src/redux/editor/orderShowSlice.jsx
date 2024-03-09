import { createSlice } from "@reduxjs/toolkit";

const initialState = {
    orderShow: false,
};

const orderShowSlice = createSlice({
    name: "order",
    initialState,
    reducers: {
        setOrderShow: (state, action) => {
            state.orderShow = action.payload;
        },
    },
});

export const { setOrderShow } = orderShowSlice.actions;
export default orderShowSlice.reducer;
