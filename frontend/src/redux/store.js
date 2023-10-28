import { configureStore } from "@reduxjs/toolkit";
import openReducer from "./features/openSlice";
import linkReducer from './features/linkSlice';
import drawerReducer from './features/drawerSlice';
import languageReducer from './features/languageSlice';

export default configureStore({
  reducer: {
    open: openReducer,
    link: linkReducer,
    drawer: drawerReducer,
    languageMode: languageReducer,
  },
});
