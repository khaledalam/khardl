import { createSlice } from "@reduxjs/toolkit";

const initialState = {
    GlobalColor: "var(--primary)",
    GlobalShape: "0px",
    buttons: [
        { id: 1, text: "delivery", color: "var(--primary)", shape: "8px" },
        { id: 2, text: "receipt", color: "var(--primary)", shape: "8px" },
        { id: 3, text: "login", color: "var(--primary)", shape: "8px" },
    ],
};

const buttonSlice = createSlice({
    name: "button",
    initialState,
    reducers: {
        updateButton: (state, action) => {
            const { id, newText, newColor, newShape } = action.payload;
            const selectedButton = state.buttons.find(
                (button) => button.id === id,
            );
            if (selectedButton) {
                selectedButton.text = newText;
                selectedButton.color = newColor;
                selectedButton.shape = newShape;
            }
        },
        updateGlobalButtons: (state, action) => {
            const { newGlobalColor, newGlobalShape } = action.payload;
            state.GlobalColor = newGlobalColor;
            state.GlobalShape = newGlobalShape;
        },
    },
});

export const { updateButton, updateGlobalButtons } = buttonSlice.actions;
export const selectButtons = (state) => state.button.buttons;
export const globalColor = (state) => state.button.GlobalColor;
export const globalShape = (state) => state.button.GlobalShape;

export default buttonSlice.reducer;
