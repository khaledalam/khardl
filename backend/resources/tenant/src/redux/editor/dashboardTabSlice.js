import { createSlice } from "@reduxjs/toolkit";

const initialState = {
  activeTab: "Dashboard",
};

const dashboardTabSlice = createSlice({
  name: "tab",
  initialState,
  reducers: {
    setActiveTab: (state, action) => {
      state.activeTab = action.payload;
    },
  },
});

export const { setActiveTab } = dashboardTabSlice.actions;
export default dashboardTabSlice.reducer;
