import { createSlice } from "@reduxjs/toolkit";

const customerAPISlice = createSlice({
  name: "customerAPI",
  initialState: {
    activeNavItem: "Dashboard",
    address: {
      lat: 26.39925,
      lng: 49.98436,
      addressValue: "",
    },
    ordersList: null,
    cardsList: [],
    currentPage: 0,
    totalCount: 30,
    ordersMetadata: null,
    saveProfileChanges: true,
  },
  reducers: {
    setActiveNavItem: (state, action) => {
      state.activeNavItem = action.payload;
    },
    updateCustomerAddress: (state, action) => {
      state.address = action.payload;
    },
    updateOrderList: (state, action) => {
      state.ordersList = action.payload;
    },
    updateCardsList: (state, action) => {
      state.cardsList = action.payload;
    },
    updateProfileSaveStatus: (state, action) => {
      state.saveProfileChanges = action.payload;
    },
    setCurrentPage: (state, action) => {
      state.currentPage = action.payload;
    },
    setTotalCount: (state, action) => {
      state.totalCount = action.payload;
    },
    updateOrdersMeta: (state, action) => {
      state.ordersMetadata = action.payload;
    },
  },
});

export const {
  setCurrentPage,
  setTotalCount,
  setActiveNavItem,
  updateCustomerAddress,
  updateOrderList,
  updateCardsList,
  updateProfileSaveStatus,
  updatePageLinks,
  updateOrdersMeta,
} = customerAPISlice.actions;
export default customerAPISlice.reducer;
