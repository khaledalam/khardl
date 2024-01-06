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
  },
})

export const {setActiveNavItem, updateCustomerAddress, updateLatLng} =
  customerAPISlice.actions
export default customerAPISlice.reducer
