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
    ordersList: [],
    cardsList: [],
    addressesList: [],
    pagelinks: {
      first: null,
      last: null,
      prev: null,
      next: null,
    },
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
    updateAddressesList: (state, action) => {
      state.addressesList = action.payload;
    },
    updateProfileSaveStatus: (state, action) => {
      state.saveProfileChanges = action.payload;
    },
    updatePageLinks: (state, action) => {
      state.pagelinks = action.payload;
    },
    updateOrdersMeta: (state, action) => {
      state.ordersMetadata = action.payload;
    },
  },
});

export const {
  setActiveNavItem,
  updateCustomerAddress,
  updateOrderList,
  updateCardsList,
  updateProfileSaveStatus,
  updatePageLinks,
  updateOrdersMeta,
  updateAddressesList,
} = customerAPISlice.actions;
export default customerAPISlice.reducer;
