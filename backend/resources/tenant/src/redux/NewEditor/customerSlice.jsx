import {createSlice} from "@reduxjs/toolkit"

const customerAPISlice = createSlice({
  name: "customerAPI",
  initialState: {
    activeNavItem: "Dashboard",
    address: "",
    addressLatLng: {
      lat: 28.45,
      lng: 45.45,
    },
    ordersList: [],
    cardsList: [],
    saveProfileChanges: true,
  },
  reducers: {
    setActiveNavItem: (state, action) => {
      state.activeNavItem = action.payload
    },
    updateCustomerAddress: (state, action) => {
      state.address = action.payload
    },
    updateLatLng: (state, action) => {
      state.addressLatLng = action.payload
    },
    updateOrderList: (state, action) => {
      state.ordersList = action.payload
    },
    updateCardsList: (state, action) => {
      state.cardsList = action.payload
    },
    updateProfileSaveStatus: (state, action) => {
      state.saveProfileChanges = action.payload
    },
  },
})

export const {
  setActiveNavItem,
  updateCustomerAddress,
  updateLatLng,
  updateOrderList,
  updateCardsList,
  updateProfileSaveStatus,
} = customerAPISlice.actions
export default customerAPISlice.reducer
