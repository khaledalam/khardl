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
  },
})

export const {
  setActiveNavItem,
  updateCustomerAddress,
  updateLatLng,
  updateOrderList,
} = customerAPISlice.actions
export default customerAPISlice.reducer
