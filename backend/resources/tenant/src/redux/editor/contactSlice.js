import { createSlice } from "@reduxjs/toolkit";

const initialState = {
    icons: [
        {
            id: 1,
            name: "Whatsapp",
            icon: "BsWhatsapp",
            color: "Whatsapp",
            Link: "",
        },
    ],
    more_icons: [
        {
            id: 4,
            name: "Telegram",
            icon: "BsTelegram",
            color: "Telegram",
            Link: "",
        },
        {
            id: 5,
            name: "Youtube",
            icon: "FaYoutube",
            color: "Youtube",
            Link: "",
        },
        {
            id: 6,
            name: "Instagram",
            icon: "BsInstagram",
            color: "Instagram",
            Link: "",
        },
        {
            id: 7,
            name: "Facebook",
            icon: "BsFacebook",
            color: "Facebook",
            Link: "",
        },
        {
            id: 8,
            name: "LinkedIn",
            icon: "BsLinkedin",
            color: "LinkedIn",
            Link: "",
        },
        { id: 9, name: "TikTok", icon: "BsTiktok", color: "TikTok", Link: "" },
    ],
    selectedIconId: 1,
    phoneNumber: "+96600000000",
};

const contactSlice = createSlice({
    name: "contact",
    initialState,
    reducers: {
        updateIconInput: (state, action) => {
            const { id, Link } = action.payload;
            const iconToUpdate = state.icons.find((icon) => icon.id === id);
            if (iconToUpdate) {
                iconToUpdate.Link = Link;
            }
        },
        setSelectedIconId: (state, action) => {
            state.selectedIconId = action.payload;
        },
        updatePhoneNumber: (state, action) => {
            state.phoneNumber = action.payload;
        },
        addIcon: (state, action) => {
            const newIcon = action.payload;
            state.icons.push(newIcon);
        },
        removeIcon: (state, action) => {
            const iconIdToRemove = action.payload;
            state.icons = state.icons.filter(
                (icon) => icon.id !== iconIdToRemove,
            );
        },
        moveFromMoreToIcons: (state, action) => {
            const iconIdToMove = action.payload;
            const iconToMove = state.more_icons.find(
                (icon) => icon.id === iconIdToMove,
            );
            if (iconToMove) {
                state.more_icons = state.more_icons.filter(
                    (icon) => icon.id !== iconIdToMove,
                );
                state.icons.push(iconToMove);
            }
        },
        moveFromIconsToMore: (state, action) => {
            const iconIdToMove = action.payload;
            const iconToMove = state.icons.find(
                (icon) => icon.id === iconIdToMove,
            );
            if (iconToMove) {
                state.icons = state.icons.filter(
                    (icon) => icon.id !== iconIdToMove,
                );
                state.more_icons.push(iconToMove);
            }
        },
    },
});

export const {
    updateIconInput,
    setSelectedIconId,
    updatePhoneNumber,
    addIcon,
    removeIcon,
    moveFromMoreToIcons,
    moveFromIconsToMore,
} = contactSlice.actions;
export default contactSlice.reducer;
