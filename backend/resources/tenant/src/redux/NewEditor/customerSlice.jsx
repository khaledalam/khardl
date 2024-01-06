import {createSlice} from "@reduxjs/toolkit"

const customerAPISlice = createSlice({
  name: "customerAPI",
  initialState: {
    activeNavItem: "Dashboard",
  },
  reducers: {
    setActiveNavItem: (state, action) => {
      state.activeNavItem = action.payload
    },
  },
})

export const {setActiveNavItem} = customerAPISlice.actions
export default customerAPISlice.reducer
