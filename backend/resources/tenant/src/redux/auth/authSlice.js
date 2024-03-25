import { createSlice, createAsyncThunk } from "@reduxjs/toolkit";
import Axios from "../../axios/axios";
import { PREFIX_KEY } from "../../config";

export const logout = createAsyncThunk("auth/logout", async ({ method }) => {
    const response = await Axios({ url: "/logout", method });
    sessionStorage.removeItem(PREFIX_KEY + "email");
    localStorage.removeItem("user-info");
    return response?.data?.is_loggedin;
});

export const getIsLoggedIn = () => {
    console.log(
        "getIsLoggedIn",
        JSON.parse(localStorage.getItem("user-info"))?.phone,
    );
    return (
        JSON.parse(localStorage.getItem("user-info"))?.phone?.length > 0 ||
        false
    );
};

export const getUser = () => {

    return JSON.parse(localStorage.getItem("user-info")) || false;
};

const initialState = {
    isLoggedIn: getIsLoggedIn(),
    status: "idle",
    error: null,
    user: getUser(),
};

const authSlice = createSlice({
    name: "auth",
    initialState,
    reducers: {
        changeLogState: (state, action) => {
            state.isLoggedIn = action.payload;
            localStorage.setItem("isLoggedIn", JSON.stringify(action.payload));
        },
        changeUserState: (state, action) => {
            state.user = action.payload;
            localStorage.setItem("user-info", JSON.stringify(action.payload));
        },
    },
    extraReducers: (builder) => {
        builder
            .addCase(logout.pending, (state) => {
                state.status = "loading";
            })
            .addCase(logout.fulfilled, (state, action) => {
                state.status = "succeeded";
                state.isLoggedIn = action.payload;
                localStorage.removeItem("user-info");
                localStorage.removeItem("khardl-status-code");
            })
            .addCase(logout.rejected, (state, action) => {
                state.status = "failed";
                state.error = action.error.message;
            });
    },
});

export const { changeLogState, changeUserState } = authSlice.actions;
export default authSlice.reducer;
