import {configureStore} from "@reduxjs/toolkit"
import openReducer from "./features/openSlice"
import linkReducer from "./features/linkSlice"
import drawerReducer from "./features/drawerSlice"
import languageReducer from "./languageSlice"
import editorReducer from "./editor/editorSlice"
import shapeImageReducer from "./editor/shapeImageSlice"
import buttonReducer from "./editor/buttonSlice"
import imageReducer from "./editor/imageSlice"
import logoReducer from "./editor/logoSlice"
import categoryReducer from "./editor/categorySlice"
import contactReducer from "./editor/contactSlice"
import bannerReducer from "./editor/bannerSlice"
import imagesReducer from "./editor/imagesSlice"
import alignReducer from "./editor/alignSlice"
import alignTextReducer from "./editor/alignTextSlice"
import cartReducer from "./editor/cartSlice"
import uiReducer from "./editor/uiSlice"
import dimensionsReducer from "./editor/dimensionsSlice"
import divWidthReducer from "./editor/divWidthSlice"
import fontsReducer from "./editor/fontsSlice"
import dashboardTabReducer from "./editor/dashboardTabSlice"
import idOrderReducer from "./editor/idOrderSlice"
import OrderShowReducer from "./editor/orderShowSlice"
import authReducer from "./auth/authSlice"
import styleDataRestaurantReducer from "./editor/styleDataRestaurantSlice"
import restuarantEditorReducer from "./NewEditor/restuarantEditorSlice"
import categoryAPIReducer from "./NewEditor/categoryAPISlice"
import customerAPIReducer from "./NewEditor/customerSlice"

const store = configureStore({
  reducer: {
    open: openReducer,
    link: linkReducer,
    drawer: drawerReducer,
    editor: editorReducer,
    shapeImage: shapeImageReducer,
    button: buttonReducer,
    image: imageReducer,
    images: imagesReducer,
    logo: logoReducer,
    category: categoryReducer,
    contact: contactReducer,
    banner: bannerReducer,
    align: alignReducer,
    alignText: alignTextReducer,
    languageMode: languageReducer,
    cart: cartReducer,
    ui: uiReducer,
    dimensions: dimensionsReducer,
    divWidth: divWidthReducer,
    fonts: fontsReducer,
    tab: dashboardTabReducer,
    id: idOrderReducer,
    order: OrderShowReducer,
    auth: authReducer,
    styleDataRestaurant: styleDataRestaurantReducer,
    restuarantEditorStyle: restuarantEditorReducer,
    categoryAPI: categoryAPIReducer,
    customerAPI: customerAPIReducer,
  },
})

export default store
