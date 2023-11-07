import React,{Suspense,lazy} from 'react';
import ReactDOM from 'react-dom/client';
import { BrowserRouter } from "react-router-dom";
import { Provider } from "react-redux";
import './index.css';
import 'react-toastify/dist/ReactToastify.css';
import store from "./redux/store";
const App = lazy(() => import('./App'));
const ScrollToTop = lazy(() => import("./ScrollToTop"));
const Loading = lazy(() => import('./pages/Loading'));

const root = ReactDOM.createRoot(document.getElementById('root'));
root.render(
  <BrowserRouter>
  <Suspense fallback={<Loading />}>
    <ScrollToTop />
    <Suspense fallback={<Loading />}>
      <Provider store={store}>
        <App />
      </Provider>
    </Suspense>
  </Suspense>
</BrowserRouter>
);