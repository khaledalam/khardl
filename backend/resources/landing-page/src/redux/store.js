import { configureStore } from '@reduxjs/toolkit'
import openReducer from './features/openSlice'
import linkReducer from './features/linkSlice'
import drawerReducer from './features/drawerSlice'
import languageReducer from './languageSlice'
import authReducer from './auth/authSlice'

const store = configureStore({
   reducer: {
      open: openReducer,
      link: linkReducer,
      drawer: drawerReducer,
      languageMode: languageReducer,
      auth: authReducer,
   },
})

export default store
