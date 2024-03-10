import { createSlice } from "@reduxjs/toolkit";

const initialState = {
    idOrder: null,
};

const idOrderSlice = createSlice({
    name: "id",
    initialState,
    reducers: {
        setIdOrder: (state, action) => {
            state.idOrder = action.payload;
        },
    },
});

export const { setIdOrder } = idOrderSlice.actions;
export default idOrderSlice.reducer;
